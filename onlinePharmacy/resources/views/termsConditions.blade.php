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
</style>

<div class="policy-container">
    <div class="policy-header">
        <h1><i class="fas fa-file-contract"></i> Terms & Conditions</h1>
        <p>Last Updated: {{ date('F d, Y') }}</p>
    </div>

    <div class="policy-content">
        <h2>1. Acceptance of Terms</h2>
        <p>
            By accessing and using the Online Pharmacy website, you accept and agree to be bound by the 
            terms and conditions of this agreement.
        </p>

        <h2>2. Use of Service</h2>
        <p>
            You agree to use this service only for lawful purposes. You must not:
        </p>
        <ul>
            <li>Use the service in any way that violates any applicable laws</li>
            <li>Attempt to gain unauthorized access to our systems</li>
            <li>Transmit any harmful or malicious code</li>
            <li>Impersonate any person or entity</li>
        </ul>

        <h2>3. Product Information</h2>
        <p>
            We strive to provide accurate product information, but we do not warrant that product descriptions 
            or other content is accurate, complete, or error-free.
        </p>

        <h2>4. Pricing and Payment</h2>
        <p>
            All prices are in Bangladeshi Taka (BDT) and are subject to change without notice. Payment must 
            be made at the time of order placement.
        </p>

        <h2>5. Delivery</h2>
        <p>
            We aim to deliver orders within the estimated timeframe, but delivery times may vary. We are 
            not responsible for delays caused by factors beyond our control.
        </p>

        <h2>6. Limitation of Liability</h2>
        <p>
            Online Pharmacy shall not be liable for any indirect, incidental, special, or consequential 
            damages arising out of or in connection with the use of our service.
        </p>

        <h2>7. Modifications</h2>
        <p>
            We reserve the right to modify these terms at any time. Continued use of the service after 
            changes constitutes acceptance of the new terms.
        </p>

        <h2>8. Contact Information</h2>
        <p>
            For questions about these Terms & Conditions, contact us at:
            <br><strong>Email:</strong> info@onlinepharmacy.com
            <br><strong>Phone:</strong> +880 1234-567890
        </p>
    </div>
</div>
@endsection
