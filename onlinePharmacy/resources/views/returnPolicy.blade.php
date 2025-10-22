@extends('layouts.app')

@section('content')
<style>
    .policy-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .policy-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        border-radius: 15px;
        margin-bottom: 30px;
        text-align: center;
    }

    .policy-header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .policy-content {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .policy-content h2 {
        color: #667eea;
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 24px;
    }

    .policy-content p {
        line-height: 1.8;
        margin-bottom: 15px;
        color: #555;
    }

    .policy-content ul {
        margin-left: 30px;
        margin-bottom: 20px;
    }

    .policy-content li {
        margin-bottom: 10px;
        color: #555;
    }

    .highlight-box {
        background: #f8f9fa;
        border-left: 4px solid #667eea;
        padding: 20px;
        margin: 20px 0;
        border-radius: 8px;
    }
</style>

<div class="policy-container">
    <div class="policy-header">
        <h1><i class="fas fa-undo-alt"></i> Return Policy</h1>
        <p>Last Updated: {{ date('F d, Y') }}</p>
    </div>

    <div class="policy-content">
        <h2>1. Return Eligibility</h2>
        <p>
            We accept returns within 7 days of delivery for items that meet the following conditions:
        </p>
        <ul>
            <li>The product is unused and in its original packaging</li>
            <li>The product is not expired or damaged</li>
            <li>You have the original receipt or proof of purchase</li>
            <li>The product is not a prescription medicine</li>
        </ul>

        <div class="highlight-box">
            <strong><i class="fas fa-exclamation-circle"></i> Important:</strong> Prescription medicines, 
            opened packages, and used products cannot be returned due to health and safety regulations.
        </div>

        <h2>2. How to Return</h2>
        <p>
            To initiate a return, please follow these steps:
        </p>
        <ul>
            <li>Contact our customer service within 7 days of delivery</li>
            <li>Provide your order number and reason for return</li>
            <li>Wait for return authorization and instructions</li>
            <li>Pack the item securely in its original packaging</li>
            <li>Ship the item back to us (or schedule a pickup)</li>
        </ul>

        <h2>3. Refund Process</h2>
        <p>
            Once we receive and inspect your return:
        </p>
        <ul>
            <li>Approved returns will be refunded within 7-10 business days</li>
            <li>Refunds will be processed to the original payment method</li>
            <li>Shipping costs are non-refundable</li>
            <li>You will receive an email confirmation when the refund is processed</li>
        </ul>

        <h2>4. Damaged or Defective Items</h2>
        <p>
            If you receive a damaged or defective product:
        </p>
        <ul>
            <li>Contact us immediately with photos of the damage</li>
            <li>We will arrange for a replacement or full refund</li>
            <li>Return shipping will be covered by us</li>
        </ul>

        <h2>5. Wrong Item Received</h2>
        <p>
            If you received the wrong item, please contact us within 48 hours. We will arrange for the 
            correct item to be delivered and collect the wrong item at no cost to you.
        </p>

        <h2>6. Contact Us</h2>
        <p>
            For return requests or questions, contact us at:
            <br><strong>Email:</strong> returns@onlinepharmacy.com
            <br><strong>Phone:</strong> +880 1234-567890
            <br><strong>Hours:</strong> 9 AM - 9 PM (7 days a week)
        </p>
    </div>
</div>
@endsection
