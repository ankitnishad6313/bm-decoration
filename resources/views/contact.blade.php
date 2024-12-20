@extends('front-layout')
@push('title')
    <title>Contact Us</title>
@endpush
@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/contact.css" />
@endsection

@section('main-section')
    <main>
        <section class="container">
            <h1>Contact our team</h1>
            <p>Got any question about the decoration? We're here to help.</p>
            <div class="nested-container">
                <form class="user-details" action="{{ route('contact-post') }}" method="post">
                    @csrf
                    <div class="name-holder">
                        <div class="input-fields">
                            <label for="fname">First Name *</label>
                            <input type="text" id="fname" name="first_name" required="true" />
                        </div>
                        <div class="input-fields">
                            <label for="lname">Last Name *</label>
                            <input type="text" id="lname" name="last_name" required="true" />
                        </div>
                    </div>
                    <div class="input-fields">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" title="Please Enter Your gmail email address"
                            required="true" pattern="[a-z0-9]+@gmail.com">

                    </div>
                    <div class="input-fields">
                        <label for="phone">Phone number *</label>
                        <input type="text" id="phone" name="phone" title="Please Enter 10 digit Mobile Number"
                            required="true" pattern="[1-9]{1}[0-9]{9}" />
                    </div>
                    <div class="input-fields">
                        <label for="message">Message *</label>
                        <textarea name="message" rows=2 cols=50 maxlength=250 required></textarea>
                    </div>
                    <div>
                        <span id="captcha-error" style="color:red;font-size:1.5rem;font-weight:700;"></span>
                        <br />
                        <span id="loggin-error" style="color:red;font-size:1.5rem;font-weight:700;"></span>
                    </div>
                    <button class="submit-btn text-center">Submit message</button>
                </form>
                <div class="contact-details">
                    <h2 class="h2">Chat with us</h2>
                    <p class="para">Speak to our friendly team via live chat.</p>
                    <a href="whatsapp://send?phone=+91 9914925565&amp;text=Hey-B.M. Decoration-I-have-a-query!"
                        class="chat-link">
                        <i class="bi bi-chat-dots"></i>
                        Start a live chat
                    </a>

                    <div class="details-box">
                        <h2 class="h2">Call us</h2>
                        <p class="para">Call out team Mon-Sat 10.30am to 07.30pm</p>

                        <a href="tel:+91 9914925565" class="chat-link">
                            <i class="bi bi-telephone-outbound"></i>
                            +91 9914925565
                        </a>
                    </div>
                    <div class="details-box">
                        <h2 class="h2">Email us</h2>
                        <a href="mailto:rajpartyplanner@gmail.com" class="chat-link">
                            <i class="bi bi-envelope-at-fill"></i>
                            rajpartyplanner@gmail.com
                        </a>
                    </div>
                    <div class="details-box">
                        <h2 class="h2">Visit us</h2>
                        <a href="#" class="chat-link">
                            <i class="bi bi-geo-alt"></i>
                            Shop No 27, Highland Marg, Bhabat, Nabha, Punjab 140603
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
