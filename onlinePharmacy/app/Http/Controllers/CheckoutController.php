<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Medicines;
use App\Models\Products;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;

class CheckoutController extends Controller
{
    private const SESSION_PENDING_ORDER = 'checkout.pending_order';
    private const SESSION_PENDING_TRANSACTION = 'checkout.pending_transaction_id';

    /**
     * Display the checkout page
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Process the order
     */
    public function processOrder(Request $request)
    {
        $validated = $request->validate([
            'receiver_name' => 'nullable|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'region' => 'required|string',
            'city' => 'required|string',
            'area' => 'nullable|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'coupon_code' => 'nullable|string',
            'cart_items' => 'required|string',
            'cart_totals' => 'nullable|string',
        ]);

        $cartItemsPayload = json_decode($validated['cart_items'], true);

        if (!is_array($cartItemsPayload) || empty($cartItemsPayload)) {
            return back()->withInput()->with('error', 'Your cart appears to be empty. Please add items before placing an order.');
        }

        $cartItems = collect($cartItemsPayload)
            ->map(function ($item) {
                $table = strtolower($item['table'] ?? $item['tableType'] ?? '');
                $idRaw = $item['id'] ?? null;
                $id = is_numeric($idRaw) ? (int) $idRaw : ($idRaw ?: null);
                $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;
                $price = isset($item['price']) ? (float) $item['price'] : null;

                return [
                    'id' => $id,
                    'table' => $table,
                    'quantity' => max(0, $quantity),
                    'price' => $price,
                ];
            })
            ->filter(function ($item) {
                return $item['id'] !== null
                    && in_array($item['table'], ['products', 'medicines'], true)
                    && $item['quantity'] > 0;
            })
            ->values();

        if ($cartItems->isEmpty()) {
            return back()->withInput()->with('error', 'We could not process the items in your cart. Please try again.');
        }

        $totals = [];
        if (!empty($validated['cart_totals'])) {
            $decodedTotals = json_decode($validated['cart_totals'], true);
            if (is_array($decodedTotals)) {
                $totals = $decodedTotals;
            }
        }

        unset($validated['cart_items'], $validated['cart_totals']);

        $calculatedSubtotal = $cartItems->reduce(function ($carry, $item) {
            $price = isset($item['price']) ? (float) $item['price'] : 0;
            return $carry + ($price * $item['quantity']);
        }, 0.0);

        $grandTotal = $totals['total'] ?? $calculatedSubtotal;
        $grandTotal = (float) $grandTotal;

        if ($grandTotal <= 0) {
            return back()->withInput()->with('error', 'Unable to determine the payable amount for this order.');
        }

        $customerData = [
            'receiver_name' => $validated['receiver_name'] ?? null,
            'receiver_phone' => $validated['receiver_phone'],
            'region' => $validated['region'],
            'city' => $validated['city'],
            'area' => $validated['area'] ?? null,
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'coupon_code' => $validated['coupon_code'] ?? null,
        ];

        $sanitisedItems = $cartItems->map(function ($item) {
            return [
                'id' => $item['id'],
                'table' => $item['table'],
                'quantity' => (int) $item['quantity'],
                'price' => isset($item['price']) ? (float) $item['price'] : 0.0,
            ];
        })->toArray();

        session()->put(self::SESSION_PENDING_ORDER, [
            'customer' => $customerData,
            'items' => $sanitisedItems,
            'totals' => $totals,
        ]);

        $transactionId = 'ORD_' . strtoupper(Str::random(8)) . '_' . time();
        session()->put(self::SESSION_PENDING_TRANSACTION, $transactionId);

        try {
            $response = Http::post(route('paymentGateway'), [
                'amount' => $grandTotal,
                'transaction_id' => $transactionId,
                'customer_name' => $customerData['receiver_name'] ?? 'Guest Customer',
                'customer_phone' => $customerData['receiver_phone'],
                'customer_email' => $request->input('receiver_email', 'guest@example.com'),
                'customer_address' => $customerData['address'],
                'customer_city' => $customerData['city'],
                'customer_postcode' => $request->input('customer_postcode', '1207'),
                'customer_country' => $request->input('customer_country', 'Bangladesh'),
                'product_name' => 'Online pharmacy order',
                'product_category' => 'pharmacy',
                'success_url' => route('checkout.payment.success', [], true),
                'fail_url' => route('checkout.payment.fail', [], true),
                'cancel_url' => route('checkout.payment.cancel', [], true),
            ]);
        } catch (\Throwable $exception) {
            Log::error('Payment gateway request failed', [
                'error' => $exception->getMessage(),
            ]);

            session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

            return back()->withInput()->with('error', 'Payment gateway error: ' . $exception->getMessage());
        }

        if (!$response->successful()) {
            session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

            return back()->withInput()->with('error', 'Failed to connect to payment gateway. Status: ' . $response->status());
        }

        $data = $response->json();

        if (isset($data['status']) && strtoupper($data['status']) === 'SUCCESS' && !empty($data['GatewayPageURL'])) {
            return redirect()->away($data['GatewayPageURL']);
        }

        session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

        $message = $data['failedreason'] ?? $data['message'] ?? ($data['status'] ?? 'Unknown status');

        return back()->with('error', 'Payment gateway returned: ' . $message);
    }

    public function paymentSuccess(Request $request): RedirectResponse
    {
        $status = strtoupper($request->input('status', ''));
        $validStatuses = ['VALID', 'VALIDATED', 'SUCCESS'];

        if ($status && !in_array($status, $validStatuses, true)) {
            session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

            return redirect()->route('checkout')->with('error', 'Payment verification failed.');
        }

        $pendingOrder = session(self::SESSION_PENDING_ORDER);

        if (!$pendingOrder || empty($pendingOrder['items'])) {
            return redirect()->route('checkout')->with('error', 'No pending order found to finalize.');
        }

        try {
            $this->finalizeOrder($pendingOrder['customer'] ?? [], $pendingOrder['items'] ?? [], $pendingOrder['totals'] ?? []);
        } catch (\RuntimeException $runtimeException) {
            session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

            Log::warning('Checkout failed due to business rule', [
                'error' => $runtimeException->getMessage(),
            ]);

            return redirect()->route('checkout')->with('error', $runtimeException->getMessage());
        } catch (\Throwable $transactionException) {
            session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

            Log::error('Checkout transaction failed', [
                'error' => $transactionException->getMessage(),
            ]);

            return redirect()->route('checkout')->with('error', 'Unable to finalize your order at this moment. Please try again.');
        }

        session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

        return redirect()
            ->route('home')
            ->with('success', 'Order placed successfully!')
            ->with('clear_cart', true);
    }

    public function paymentFail(): RedirectResponse
    {
        session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

        return redirect()->route('checkout')->with('error', 'Payment failed. Please try again.');
    }

    public function paymentCancel(): RedirectResponse
    {
        session()->forget([self::SESSION_PENDING_ORDER, self::SESSION_PENDING_TRANSACTION]);

        return redirect()->route('checkout')->with('error', 'Payment was cancelled.');
    }

    private function finalizeOrder(array $customer, array $cartItems, array $totals): void
    {
        if (empty($cartItems)) {
            throw new \RuntimeException('Cart items were missing when attempting to finalize the order.');
        }

        DB::transaction(function () use ($customer, $cartItems, $totals) {
            $order = CustomerOrder::create([
                'receiver_name' => $customer['receiver_name'] ?? null,
                'receiver_phone' => $customer['receiver_phone'] ?? null,
                'region' => $customer['region'] ?? '',
                'city' => $customer['city'] ?? '',
                'area' => $customer['area'] ?? null,
                'address' => $customer['address'] ?? '',
                'payment_method' => $customer['payment_method'] ?? 'unknown',
                'cart_totals' => $totals,
                'status' => 'paid',
            ]);

            foreach ($cartItems as $item) {
                $table = $item['table'] ?? null;
                $itemId = $item['id'] ?? null;
                $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 0;
                $price = isset($item['price']) ? (float) $item['price'] : null;

                if (!$table || !$itemId || $quantity <= 0) {
                    throw new \RuntimeException('Invalid cart item data encountered.');
                }

                switch ($table) {
                    case 'products':
                        $product = Products::lockForUpdate()->find($itemId);
                        if (!$product) {
                            throw new \RuntimeException('A product in your cart could not be found.');
                        }

                        if ($product->quantity !== null) {
                            $remainingQuantity = (int) $product->quantity - $quantity;
                            if ($remainingQuantity < 0) {
                                throw new \RuntimeException("Insufficient stock for {$product->name}.");
                            }
                            $product->quantity = $remainingQuantity;
                        }

                        $product->save();
                        break;

                    case 'medicines':
                        $medicine = Medicines::lockForUpdate()->find($itemId);
                        if (!$medicine) {
                            throw new \RuntimeException('A medicine in your cart could not be found.');
                        }

                        if ($medicine->stock !== null) {
                            $remainingStock = (int) $medicine->stock - $quantity;
                            if ($remainingStock < 0) {
                                throw new \RuntimeException("Insufficient stock for {$medicine->name}.");
                            }
                            $medicine->stock = $remainingStock;
                        }

                        $medicine->save();
                        break;

                    default:
                        throw new \RuntimeException('Unsupported item type encountered while finalizing the order.');
                }

                CustomerOrderItem::create([
                    'customer_order_id' => $order->id,
                    'item_id' => $itemId,
                    'item_type' => $table,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }
        });
    }

    /**
     * Apply coupon code
     */
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        
        // TODO: Implement coupon validation logic
        // For now, return a simple response
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid coupon code'
        ]);
    }
}
