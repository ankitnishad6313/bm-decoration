@extends('front-layout')
@push('title')
    <title>Shipping Policy</title>
@endpush

@section('main-section')
<main>
  <div class="breadCrumbs">
      <a href="{{ route('index') }}">Home</a>
      <p>Shipping Policy</p>
  </div>
  <div class="categoryName">
      <h1>Shipping Policy</h1>
  </div>
  <section class="seoContent">
      <p>&nbsp;</p>
      <h3>Shipping Policy for https://bmdecoration.com/</h3>
      <h4>Introduction</h4>
      <p>At bndecorations.com, we specialize in providing high-quality event planning and management services. As our
          offerings are services rather than physical goods, we do not engage in shipping or delivery of tangible
          products. This policy clarifies our stance on shipping and what clients can expect regarding service
          delivery.</p>
      <h4>Service Delivery</h4>
      <p>All services provided by bndecorations.com are conducted either on-site at the event location or virtually,
          depending on the nature of the service and the client's requirements. Here’s what you can expect in terms of
          service delivery:</p>
      <p><strong>On-Site Services:</strong></p>
      <ul>
          <li>Our team will arrive at the designated event location as per the agreed-upon schedule.</li>
          <li>We ensure punctuality and professionalism in all aspects of our service.</li>
          <li>Any materials or equipment necessary for the service will be transported by our team and set up on-site.
          </li>
      </ul>
      <p><strong>Virtual Services:</strong></p>
      <ul>
          <li>For services that can be delivered remotely, we will use appropriate virtual communication tools as
              agreed upon with the client.</li>
          <li>Detailed instructions and support will be provided to ensure seamless virtual service delivery.</li>
      </ul>
      <h4>Booking and Confirmation</h4>
      <ul>
          <li>Once you book a service with us, you will receive a confirmation email detailing the service, date,
              time, and location (if applicable).</li>
          <li>We will also provide any necessary instructions or preparations needed from your end to ensure smooth
              service delivery.</li>
      </ul>
      <h4>Changes and Cancellations</h4>
      <ul>
          <li>If you need to change or cancel your booking, please refer to our Cancellation Policy for detailed
              instructions.</li>
          <li>We understand that plans can change, and we strive to accommodate reasonable requests for changes to
              service dates and times.</li>
      </ul>
      <h4>No Physical Shipping</h4>
      <ul>
          <li>As our services do not involve the sale or shipping of physical products, there are no shipping fees or
              delivery charges associated with our services.</li>
          <li>Any materials or equipment used during on-site services are the responsibility of bndecorations.com and will
              be managed entirely by our team.</li>
      </ul>
      <h4>Contact Us</h4>
      <p>If you have any questions or require further clarification regarding our service delivery process, please do
          not hesitate to contact us:</p>
      <ul>
          <li>By email: info@example.com</li>
          <li>By visiting this page on our website: https://bmdecoration.com/</li>
          <li>By phone number: +91 9914925565</li>
      </ul>
      <p>This shipping policy aims to clearly communicate to clients that example.com does not engage in shipping
          physical products and outlines how we handle service delivery. Be sure to review this with a legal
          professional to ensure it meets all necessary legal standards and requirements.</p>
  </section>
</main>

@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
