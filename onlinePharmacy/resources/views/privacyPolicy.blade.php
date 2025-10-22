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
        <h1><i class="fas fa-shield-alt"></i> Privacy Policy</h1>
        <p>Last Updated: {{ date('F d, Y') }}</p>
    </div>

    <div class="policy-content">
        <h2>1. Information We Collect</h2>
        <p>
            We collect information that you provide directly to us, including when you create an account, 
            place an order, or contact us for support. This information may include:
        </p>
        <ul>
            <li>Name and contact information</li>
            <li>Phone number and email address</li>
            <li>Delivery address</li>
            <li>Payment information</li>
            <li>Purchase history</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <p>
            We use the information we collect to:
        </p>
        <ul>
            <li>Process and fulfill your orders</li>
            <li>Communicate with you about your orders</li>
            <li>Improve our services and customer experience</li>
            <li>Send you promotional offers (with your consent)</li>
            <li>Comply with legal obligations</li>
        </ul>

        <h2>3. Information Sharing</h2>
        <p>
            We do not sell or rent your personal information to third parties. We may share your information 
            with service providers who help us operate our business, such as payment processors and delivery services.
        </p>

        <h2>4. Data Security</h2>
        <p>
            We implement appropriate security measures to protect your personal information from unauthorized 
            access, alteration, disclosure, or destruction.
        </p>

        <h2>5. Your Rights</h2>
        <p>
            You have the right to:
        </p>
        <ul>
            <li>Access your personal information</li>
            <li>Correct inaccurate information</li>
            <li>Request deletion of your information</li>
            <li>Opt-out of marketing communications</li>
        </ul>

        <h2>6. Contact Us</h2>
        <p>
            If you have any questions about this Privacy Policy, please contact us at:
            <br><strong>Email:</strong> info@onlinepharmacy.com
            <br><strong>Phone:</strong> +880 1234-567890
        </p>
    </div>
</div>
@endsection
