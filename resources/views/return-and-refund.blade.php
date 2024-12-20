@extends('front-layout')
@push('title')
    <title>Return and Refund</title>
@endpush

@section('main-section')
<main>
  <div class="breadCrumbs">
      <a href="{{ route('index') }}">Home</a>
      <p>Return and Refund</p>
  </div>
  <div class="categoryName">
      <h1>Return and Refund</h1>
  </div>
  <section class="seoContent">
      <p><strong>Booking Policy:</strong></p>
      <p>We recommend booking our services 7-10 days before your event to secure your slot. Our availability fills up
          fast, so reserving in advance is ideal. However, we do accommodate last-minute bookings up to 12 hours
          before the event if slots are available. To confirm a last-minute booking, please contact us at
          <strong>+91 9914925565</strong>.</p>
      <p><strong>Cancellation Policy:</strong></p>
      <p><strong>Less than 24 hours before the Event:</strong> No refund will be provided.</p>
      <p><strong>24 to 72 hours before the Event:</strong> A cancellation fee of Rs 1000 or 50%, whichever is lower.
      </p>
      <p><strong>3-7 Days before the Event:</strong> A flat cancellation charge of Rs 500.</p>
      <p><strong>7 Days or more before the Event:</strong> No cancellation charges apply.</p>
      <p>In the case of adverse weather conditions or unforeseen circumstances (acts of nature), we only entertain
          rescheduling requests. Perishable items are non-refundable, non-cancellable, and non-reschedulable.</p>
      <p>For experiences booked on Valentine's Day (13th and 14th February), Christmas (25th December), New Year's Eve
          (31st December), and other special event days, cancellations are not possible due to their special package
          nature.</p>
      <p>For Room &amp; Decoration Packages or Candle Light Packages, 100% of the package cost will be forfeited for
          any cancellations.</p>
      <p><strong>Reschedule Policy:</strong></p>
      <p><strong>Less than 24 hours before the experience:</strong> Rescheduling is subject to approval in certain
          cases.</p>
      <p><strong>24 hours to 3 days before the experience:</strong> Rescheduling at zero fee.</p>
      <p><strong>3 days or more before the experience:</strong> Rescheduling at zero fee.</p>
      <p>Rescheduling is not possible for experiences booked on Valentine's Day (13th and 14th February), Christmas
          (25th December), New Year's Eve (31st December), and other special event days.</p>
      <p><strong>Other Information:</strong></p>
      <p>Cake and Bouquet orders cannot be canceled on the same day of your experience.</p>
      <p>For hotel stays, only guests aged 18 and above are allowed. A maximum of 2 people are permitted in the hotel
          room.</p>
      <p><strong>Operating Hours:</strong></p>
      <p>We operate from Monday to Sunday, 11 am - 8 pm. Please note that we are closed on Thursdays.</p>
      <p><strong>Contact Us:</strong></p>
      <p>If you have any inquiries or concerns about our policies, please feel free to contact us via email at <a
              href="mailto:rajpartyplanner@gmail.com"><strong>rajpartyplanner@gmail.com</strong></a> or call us at
          <strong>+91 9914925565</strong>.</p>
  </section>
</main>

@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
