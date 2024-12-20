@extends('front-layout')
@push('title')
    <title>Terms and conditions</title>
@endpush


@section('main-section')
<main>
    <div class="breadCrumbs">
        <a href="{{ route('index') }}">Home</a>
        <p>Terms and conditions</p>
    </div>
    <div class="categoryName">
        <h1>Terms and conditions</h1>
    </div>
    <section class="seoContent">
        <p>These Terms and Conditions govern the use of our services provided by BN Decorations. By accessing our
            services, you accept these terms in full. If you disagree with any part of these terms, you must not use
            our services.</p>
        <p><strong>Service Provision:</strong></p>
        <ul>
            <li>Our services are offered based on availability and are subject to confirmation. We reserve the right
                to refuse service to anyone for any reason at any time.</li>
        </ul>
        <p><strong>Booking and Payment:</strong></p>
        <ul>
            <li>Booking confirmation is subject to availability. Payment is required in full at the time of booking
                to secure your reservation.</li>
        </ul>
        <p><strong>Customer Responsibility:</strong></p>
        <ul>
            <li>The customer is responsible for providing accurate and up-to-date information for bookings.</li>
            <li>The customer is responsible for the conduct of their guests and adherence to our policies during the
                event or experience.</li>
        </ul>
        <p><strong>Liability:</strong></p>
        <ul>
            <li>We shall not be liable for any loss, injury, or damage to any person or property arising from or in
                connection with the use of our services.</li>
        </ul>
        <p><strong>Intellectual Property:</strong></p>
        <ul>
            <li>All content, trademarks, and intellectual property on our website are owned by BN Decorations. Any use,
                including but not limited to reproduction or distribution, requires explicit permission.</li>
        </ul>
        <p><strong>Privacy Policy:</strong></p>
        <ul>
            <li>Please refer to our privacy policy for information on how we collect, use, and disclose personal
                information.</li>
        </ul>
        <p><strong>Modifications:</strong></p>
        <ul>
            <li>We reserve the right to modify, amend, or change any part of these terms and conditions at any time
                without prior notice.</li>
        </ul>
        <p><strong>Governing Law:</strong></p>
        <ul>
            <li>These terms and conditions are governed by and construed in accordance with the laws of Kolkata High
                Court and any disputes will be subject to the exclusive jurisdiction of the courts of&nbsp;Kolkata
                High Court.</li>
        </ul>
        <p><strong>Contact Information:</strong></p>
        <ul>
            <li>For any inquiries, concerns, or additional information, please reach out to us at <a
                    href="mailto:rajpartyplanner@gmail.com">rajpartyplanner@gmail.com</a> or call us at
                <strong>+91 9914925565</strong>.
            </li>
        </ul>
        <p><strong>Acceptance of Terms:</strong></p>
        <ul>
            <li>By using our services, you confirm that you have read, understood, and agree to abide by these Terms
                and Conditions.</li>
        </ul>
    </section>
</main>

@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
