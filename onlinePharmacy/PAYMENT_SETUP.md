# Payment Gateway Setup Guide

## SSLCommerz Integration

This project uses SSLCommerz payment gateway for processing online payments in Bangladesh.

### Configuration

#### 1. Get SSLCommerz Credentials

**For Testing (Sandbox):**
1. Visit: https://developer.sslcommerz.com/registration/
2. Register for a sandbox account
3. Get your Store ID and Store Password

**For Production (Live):**
1. Visit: https://sslcommerz.com/
2. Apply for a merchant account
3. Complete verification process
4. Get your live credentials

#### 2. Update Environment Variables

Open `.env` file and update these values:

```env
# SSLCommerz Payment Gateway Configuration
SSLCOMMERZ_STORE_ID=your_actual_store_id_here
SSLCOMMERZ_STORE_PASSWORD=your_actual_store_password_here
SSLCOMMERZ_SANDBOX=true  # Set to false for production
```

**Important:** Replace `your_actual_store_id_here` and `your_actual_store_password_here` with your real credentials.

#### 3. Clear Configuration Cache

After updating `.env`, run:
```bash
php artisan config:clear
php artisan config:cache
```

### Payment Flow

1. **Customer Places Order** → Fills checkout form with delivery details
2. **Selects Payment Method** → Either "Cash on Delivery" or "Online Payment"
3. **Order Created** → System saves order to database with unique Order ID
4. **Payment Processing:**
   - **Cash on Delivery:** Redirects to order confirmation page
   - **Online Payment:** Redirects to SSLCommerz payment gateway
5. **Payment Gateway** → Customer completes payment on SSLCommerz
6. **Callback Routes:**
   - **Success:** `/payment/success` → Order confirmed, payment marked as paid
   - **Fail:** `/payment/fail` → Order cancelled, customer notified
   - **Cancel:** `/payment/cancel` → Order cancelled, customer can retry

### Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/checkout` | GET | Display checkout page |
| `/checkout/process` | POST | Process order and create records |
| `/sslcommerz/test` | GET | Initialize payment gateway |
| `/payment/success` | POST | SSLCommerz success callback |
| `/payment/fail` | POST | SSLCommerz failure callback |
| `/payment/cancel` | POST | SSLCommerz cancel callback |
| `/order/confirmation/{order_id}` | GET | Order confirmation page |

### Testing Payment Gateway

#### Test with Sandbox Credentials:

1. Place an order with "Online Payment" selected
2. You'll be redirected to SSLCommerz sandbox gateway
3. Use test card numbers provided by SSLCommerz:
   - **Test Card:** 4111 1111 1111 1111
   - **CVV:** Any 3 digits
   - **Expiry:** Any future date

#### Test Cash on Delivery:

1. Place an order with "Cash on Delivery" selected
2. Order will be created immediately
3. Redirects to order confirmation page

### Database Tables

**customer_orders:**
- `order_id` - Unique order identifier (ORD-20251021-ABC123)
- `transaction_id` - Payment transaction ID
- `payment_status` - paid, unpaid, failed, cancelled
- `status` - pending, confirmed, cancelled

**customer_order_items:**
- Order line items with product/medicine details
- Quantity, price, and total for each item

### Security Notes

1. **Never commit `.env` file** to version control
2. **Always use HTTPS** in production
3. **Validate payment callbacks** using SSLCommerz validation API
4. **Store credentials securely** using environment variables
5. **Test thoroughly** in sandbox before going live

### Troubleshooting

**Issue:** Payment gateway returns error
- **Solution:** Check if SSLCOMMERZ_STORE_ID and SSLCOMMERZ_STORE_PASSWORD are correct

**Issue:** Callback routes not working
- **Solution:** Ensure routes are defined in `web.php` and controller methods exist

**Issue:** Order not updating after payment
- **Solution:** Check if transaction_id matches between order and callback

**Issue:** "Configuration cache" errors
- **Solution:** Run `php artisan config:clear`

### Production Checklist

Before going live:

- [ ] Update `.env` with live SSLCommerz credentials
- [ ] Set `SSLCOMMERZ_SANDBOX=false`
- [ ] Test all payment scenarios (success, fail, cancel)
- [ ] Enable HTTPS on your domain
- [ ] Configure proper error logging
- [ ] Add email notifications for orders
- [ ] Test callback URLs are publicly accessible
- [ ] Implement order tracking system
- [ ] Add customer order history page

### Support

For SSLCommerz support:
- **Email:** operation@sslcommerz.com
- **Phone:** +880 9612 001 010
- **Documentation:** https://developer.sslcommerz.com/

---

**Last Updated:** October 21, 2025
