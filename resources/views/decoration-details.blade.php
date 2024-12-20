@extends('front-layout')
@push('title')
    <title>{{ $product->name }}</title>
@endpush
@section('meta-section')
    <meta name="title" content="{{ $product->title }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
    <meta name="description" content="{{ $product->meta_description }}">
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/common10.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/productdetails1.css" />
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper {
            width: 100%;
            height: auto;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }
        
        .main-sweeper {
            height: 80%;
            width: 100%;
        }
        
        .swiper-slide img {
            display: block;
            width: 550px;
            height: 550px;
            object-fit: cover;
        }

        .sub-sweeper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .sub-sweeper .swiper-slide {
            width: 25%;
            height: 100px;
            opacity: 0.4;
        }

        .sub-sweeper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .sub-sweeper .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection
@section('main-section')
    <div class="breadCrumbs">
        <a href="{{ route('index') }}">Home</a> >
        <a href="{{ route('show-products', ['category_slug' => $product->category->category_slug]) }}">
            <p>{{ $product->category->cat_name }}</p>
        </a>
        <p>{{ $product->name }}</p>
    </div>
    <section class="container">
        <div class="productImages">
            <div id="slider" class="slider">
                <div class="wrapper">
                    {{-- <div class="slides" id="slides">
                        <span class="slide">
                            <img src="{{ url("/uploads/products/$product->thumb_img") }}" alt="{{ $product->name }}"
                                height="50" width="50" loading="eager" decoding="async" />
                        </span>
                    </div> --}}

                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper main-sweeper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ url("/uploads/products/$product->thumb_img") }}" />
                            </div>
                            @foreach ($product->productImages as $img)
                                <div class="swiper-slide">
                                    <img src="{{ url("/uploads/products/$img->image") }}" />
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div thumbsSlider="" class="swiper sub-sweeper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ url("/uploads/products/$product->thumb_img") }}" />
                            </div>
                            @foreach ($product->productImages as $img)
                                <div class="swiper-slide">
                                    <img src="{{ url("/uploads/products/$img->image") }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                {{-- <div class="pagination" id="pagination"></div> --}}
                <button class="view-similar-btn" onclick="viewSimilar()">
                    <div>
                        <span> View Similar </span>
                        <img src="{{ url('/') }}/assets/icons/sparkling.svg" alt="ai search icon" height="20"
                            width="20" decoding="async" loading="lazy" />
                    </div>
                </button>

            </div>
        </div>
        <div class="product-details">
            <div class="detailsContainer">
                <h1 class="product-name">{{ $product->name }}</h1>
                <div class="priceContainer">
                    <div class="priceContain">
                        <p class="product-price">₹{{ $product->discount_price }}</p>
                        <div>
                            <span class="prevPrice">{{ $product->price }}</span>
                            <span class="discount">{{ $product->discount_percentage }}% OFF</span>
                            <p>Inclusive of all taxes</p>
                        </div>
                    </div>
                    <p class="text">
                        <span class="rating">&#9733;{{ number_format($product->reviews->avg('star'), 1) }}</span>
                        <span class="reviews">{{ $product->reviews->count() }} Reviews</span>
                    </p>
                </div>
            </div>
            <form id="order-form">
                <div class="detailsContainer">
                    <div class="inputController">
                        <p class="controller-heading">
                            <img src="{{ url('/') }}/assets/icons/red_location.svg" alt="location icon" height="25"
                                width="25" decoding="async" loading="lazy" />Select City
                        </p>
                        <input type="hidden" name="product_id" value="{{ $product->id }}" required />
                        <select name="city_id" id="city" class="form-select btn" required>
                            <option value="" disabled selected>
                                Select your city
                            </option>
                            @foreach (getAllCity() as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->city }}
                                </option>
                            @endforeach
                        </select>
                        <div class="dateNtime">
                            <div>
                                <label class="controller-heading" for="date">
                                    <img src="{{ url('/') }}/assets/icons/red_calendar.svg" alt="calendar icon"
                                        height="25" width="25" decoding="async" loading="lazy" />
                                    Select Date
                                </label>
                                <input type="date" name="date" class="btn" min="{{ date('Y-m-d') }}"
                                    id="" required />
                            </div>
                            <div>
                                <label for="time-slots1" class="controller-heading">
                                    <img src="{{ url('/') }}/assets/icons/clock.svg" alt="clock icon"
                                        height="25" width="25" decoding="async" loading="lazy" />Select Time
                                </label>
                                <input type="time" name="time" class="btn" id="time" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detailsContainer stick-bottom">
                    <div class="bookings">
                        <button id="addcart-btn" type="button" class="booknow-btn addtocart-btn">
                            <img src="{{ url('/') }}/assets/icons/wishlist-icon.svg" alt="cart-icon" height="25"
                                width="25" decoding="async" loading="lazy" />
                            Add to Cart
                        </button>

                        <div class="floating-price">
                            <span class="floating-before-price">₹{{ $product->price }}</span>
                            <span class="floating-current-price">₹{{ $product->discount_price }}</span>
                            <button id="go-inclusion">
                                View Package Inclusion <span>*</span>
                            </button>
                        </div>

                        <button id="booknow-btn" type="button" class="booknow-btn">
                            <img src="{{ url('/') }}/assets/icons/white-cart-icon.svg" alt="cart-icon"
                                height="25" width="25" decoding="async" loading="lazy" />
                            Book Now
                        </button>
                    </div>
                </div>
            </form>

            
        {{-- <div class="fixed-bottom">
            <h2 class="product-name">{{ $product->name }}</h2>
            <div class="bookings">
                <div class="priceContainer">
                    <div class="priceContain">
                        <p class="product-price">
                            ₹{{ $product->discount_price }}
                        </p>
                    </div>
                </div>

                <button class="booknow-btn addtocart-btn">
                    <img
                        src="{{ url('/') }}/assets/icons/wishlist-icon.svg"
                        alt="cart-icon"
                        height="25"
                        width="25"
                        decoding="async"
                        loading="lazy"
                    />
                    Add to Cart
                </button>

                <div class="floating-price">
                    <span class="floating-before-price"
                        >₹ {{ $product->price }}</span
                    >
                    <span class="floating-current-price"
                        >₹ {{ $product->discount_price }}</span
                    >
                    <button id="go-inclusion">
                        View Package Inclusion <span>*</span>
                    </button>
                </div>

                <button class="booknow-btn">
                    <img
                        src="{{ url('/') }}/assets/icons/white-cart-icon.svg"
                        alt="cart-icon"
                        height="25"
                        width="25"
                        decoding="async"
                        loading="lazy"
                    />
                    Book Now
                </button>
            </div>
        </div> --}}
       

            <div class="detailsContainer">
                <div class="inclusion-exclusion-holder">
                    <button class="inclusion active" onclick="activeInclusion(`inclusion`)">
                        Inclusion
                        <img src="{{ url('/') }}/assets/icons/included.webp" alt="included icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </button>
                    <button class="exclusion" onclick="activeInclusion(`exclusion`)">
                        Exclusion
                        <img src="{{ url('/') }}/assets/icons/excluded.webp" alt="excluded icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </button>
                </div>
                <div class="inclusion-exclusion-container">
                    <ul class="inclusion-content">
                        @foreach ($product->inclusion as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <ul class="exclusion-content">
                        @foreach ($product->exclusion as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="detailsContainer light-red">
                <h2>
                    <img src="{{ url('/') }}/assets/icons/support-icon.webp" alt="support-icon" height="30"
                        width="30" decoding="async" loading="lazy" />
                    Want to <span>customize</span> this decoration?
                </h2>
                <p>Talk with our Experts!</p>
                <div class="product-details-controllers">
                    <a href="whatsapp://send?phone=+91 {{ getAdminDetail()->phone }}&text=`Hi, I want to Order Your {{ $product->name }} Decoration worth ₹ {{ $product->discount_price }}  -  {{ Request::url() }}`"
                        class="whatsapp-btn">
                        <img src="{{ url('/') }}/assets/icons/whatsapp-icon.svg" alt="whatsapp-icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                        <span>WhatsApp</span>
                    </a>
                    <a href="tel:+91 {{ getAdminDetail()->phone }}" class="call-btn">
                        <img src="{{ url('/') }}/assets/icons/phone-blue.svg" alt="call-icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                        <span>Call Us</span>
                    </a>
                </div>
            </div>
            <div class="detailsContainer">
                <div class="policies">
                    <button class="faq-btn active-policy" onclick="policiesHandler('faq')">
                        FAQ
                    </button>
                    <button class="info-btn" onclick="policiesHandler('info')">
                        Info
                    </button>
                    <button class="cancellation-policy-btn" onclick="policiesHandler('cancellation')">
                        Cancellation Policy
                    </button>
                </div>
                <div class="cancellation-container">
                    <p>
                        Book 7-10 days in advance to secure your spot, or up to 12
                        hours before the event if space permits. Confirm last-minute
                        bookings by calling us.
                    </p>
                    <p><strong>Cancellation Policy:</strong></p>
                    <p>• Less than 24 hours: No refund.&nbsp;</p>
                    <p>
                        • 24 to 72 hours: Rs.1000 or 50% cancellation fee, whichever
                        is lower.&nbsp;
                    </p>
                    <p>• 3 to 7 days: Rs.500 cancellation charge.&nbsp;</p>
                    <p>• More than 7 days: No charge.</p>
                    <p>
                        Weather or unavoidable circumstances? Reschedule only.
                        Special days and perishable items have special rules.
                    </p>
                    <p>Cancellation Policy Highlights:</p>
                    <p>
                        • Valentine's Day, New Year's Eve, and select dates have no
                        cancellations.&nbsp;
                    </p>
                    <p>• Special packages incur 100% forfeiture.</p>
                    <p><strong>Reschedule Policy:</strong></p>
                    <p>• Less than 24 hours: Generally not permitted.&nbsp;</p>
                    <p>• 24 hours to 3 days: Free rescheduling.&nbsp;</p>
                    <p>• More than 3 days: Free rescheduling.</p>
                    <p>
                        No rescheduling on Valentine's Day, Christmas, and other
                        special dates.
                    </p>
                    <p><strong>Other Info:</strong></p>
                    <p>• No same-day cancellations for cakes and bouquets.&nbsp;</p>
                    <p>• Hotel stays: 18+, max 2 guests per room.&nbsp;</p>
                    <p>
                        • We operate Monday to Saturday, 10:30 am to 8 pm. Closed
                        Sundays.
                    </p>
                    <p><strong>Contact Us:</strong></p>
                    <p>Email: info@B.M. Decoration.com Phone: {{ getAdminDetail()->phone }}</p>
                </div>
                <div class="faq-container">
                    <p class="questions">
                        Q. How far in advance should I book your decoration?
                        <img src="{{ url('/') }}/assets/icons/plus.svg" alt="plus icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </p>
                    <div class="answers">
                        We recommend booking our services at least 2 to 3 days in
                        advance. However, we also offer same-day delivery, subject
                        to availability. Feel free to contact us for inquiries.
                    </div>
                    <p class="questions">
                        Q. Can I customize the decoration according to my
                        preference?
                        <img src="{{ url('/') }}/assets/icons/plus.svg" alt="plus icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </p>
                    <div class="answers">
                        Yes, we provide customizations based on your preferences.
                        You can change balloon colors, add name and age foils, and
                        more. Simply reach out to us to discuss your specific
                        requirements
                    </div>
                    <p class="questions">
                        Q. What do you mean by time slots?
                        <img src="{{ url('/') }}/assets/icons/plus.svg" alt="plus icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </p>
                    <div class="answers">
                        Time slots are set times when you can book our services. If
                        you choose the time slot of 2-4pm, then our decorators will
                        be coming to your location by 2pm and the decoration will be
                        getting ready by 4pm.
                    </div>
                    <p class="questions">
                        Q. Do you offer same-day decoration service?
                        <img src="{{ url('/') }}/assets/icons/plus.svg" alt="plus icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </p>
                    <div class="answers">
                        Yes, we offer same-day decoration service. Please contact us
                        to check slot availability.
                    </div>
                    <p class="questions">
                        Q. Do you only provide materials, or do you also decorate?
                        <img src="{{ url('/') }}/assets/icons/plus.svg" alt="plus icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </p>
                    <div class="answers">
                        We provide materials and also handle the decoration. Our
                        team will come at your given location with all the materials
                        and complete the decoration on-time.
                    </div>
                    <p class="questions">
                        Q. How much time do you take to setup the decoration?
                        <img src="{{ url('/') }}/assets/icons/plus.svg" alt="plus icon" height="25"
                            width="25" decoding="async" loading="lazy" />
                    </p>
                    <div class="answers">
                        The time needed depends on factors like the decor's
                        complexity and the venue size. Simple setups take 1-2 hours,
                        while larger installations may need several hours. We ensure
                        timely and efficient setup for every event.
                    </div>
                </div>
                <div class="info-container">
                    <ul>
                        <li>
                            Metal Stands, Lights and any other Equipment's are on
                            Rental Basis and will be taken back next day of event
                        </li>
                        <li>
                            You'll need to provide a stool to reach the ceiling.
                        </li>
                        <li>
                            The balloons will be hung using cello tape as we don’t
                            use helium due to its asphyxiation properties.
                        </li>
                        <li>
                            Remove the cello tape immediately after the event is
                            over. In case if the cello tape is causing damage to the
                            wall, use a hair dryer to blow hot air on the tape as it
                            will prevent the damage
                        </li>
                    </ul>
                </div>
            </div>
            <div class="detailsContainer">
                <h2 class="rating-header">Rating</h2>
                <div class="reviews-content">
                    <div class="ratingPoint">
                        <p>
                            {{ number_format($product->reviews->avg('star'), 1) }}
                            <img src="{{ url('/') }}/assets/icons/green-star.svg" alt="green star icon"
                                height="25" width="25" decoding="async" loading="lazy" />
                        </p>
                    </div>
                    <div class="ratingNumbers">
                        <p>{{ $product->reviews->count() }} Ratings</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="reviews-section">
        <h2>What Customer Say&apos;s</h2>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 12"
            width="100" height="12" preserveAspectRatio="xMidYMid meet">
            <defs>
                <clipPath id="__lottie_element_6">
                    <rect width="100" height="12" x="0" y="0"></rect>
                </clipPath>
            </defs>
            <g clip-path="url(#__lottie_element_6)">
                <g transform="matrix(1,0,0,1,86.5,6)" opacity="1" style="display: block">
                    <g opacity="1" transform="matrix(1,0,0,1,0,0)">
                        <path stroke-linecap="round" stroke-linejoin="miter" fill-opacity="0" stroke-miterlimit="4"
                            stroke="var(--website)" stroke-opacity="1" stroke-width="5"
                            d="M-77.5,1 C-77.5,1 -22.75,-3.75 -4,-3.75 C14.75,-3.75 70.75,-0.5 70.75,-0.5"></path>
                    </g>
                </g>
            </g>
        </svg>
        <img src="{{ url('/') }}/assets/icons/chev-left-reviews.svg" height="30" width="30"
            decoding="async" loading="lazy" class="review-chev-left" onclick="reviewLeftClick()" />
        <img src="{{ url('/') }}/assets/icons/chev-right-reviews.svg" height="30" width="30"
            decoding="async" loading="lazy" class="review-chev-right" onclick="reviewRightClick()" />
        <div class="reviews-slider">
            @foreach ($product->reviews as $review)
                <div class="user-review">
                    <p>
                        {{ $review->user->name }}
                        <span
                            style="
                        font: 500 1.4rem var(--medium);
                        color: #515151;
                        line-height: 2rem;
                        margin-left: 1.5rem;
                    ">
                            <img src="{{ url('/') }}/assets/icons/gps.svg" height="25" width="25"
                                decoding="async" loading="lazy" style="vertical-align: middle" />
                            {{ $review->user->city }}
                        </span>
                    </p>
                    <span>
                        @for ($i = 1; $i <= $review->str; $i++)
                            <img src="{{ url('/') }}/assets/icons/rating-star.svg" height="15" width="15"
                                decoding="async" loading="lazy" />
                        @endfor
                    </span>
                    <article>
                        {{ $review->comment }}
                    </article>
                    <div class="review-imgholder">
                        <img src="{{ url('/uploads/profile/' . $review->user->profile_pic) }}" height="30"
                            width="30" decoding="async" loading="lazy" />
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="similar-products">
        <h2>Similar Products</h2>
        <button onclick="movePrev()" class="similar-prev">
            <img src="{{ url('/') }}/assets/icons/chevron-left.svg" alt="chevron icon" height="25"
                width="25" decoding="async" loading="lazy" />
        </button>
        <button onclick="moveNext()" class="similar-next">
            <img src="{{ url('/') }}/assets/icons/chevron-right.svg" alt="chevron icon" height="25"
                width="25" decoding="async" loading="lazy" />
        </button>

        <div class="similar-products-slider">
            @foreach ($similar_products as $item)
                <a href="{{ route('decoration-detail', ['product_slug' => $item->product_slug]) }}" class="link">
                    <div class="imageHolder">
                        <img src="{{ url("/uploads/products/$item->thumb_img") }}" alt="{{ $item->name }}"
                            height="50" width="50" decoding="async" loading="lazy" />
                    </div>
                    <p class="productName">{{ $item->name }}</p>
                    <div class="details">
                        <span class="price">&#x20B9; {{ $item->discount_price }}</span>
                        <span class="beforePrice">&#x20B9; {{ $item->price }}</span>
                        <span class="discount">({{ $item->discount_percentage }}% Off)</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>


    <div class="modal-holder">
        <div class="modal" onclick="viewSimilar()"></div>
        <div class="view-similar-container">
            <div class="view-similar-heading">
                <h2>
                    Ai Suggested
                    <img src="{{ url('/') }}/assets/icons/sparkling.svg" alt="ai image" height="30"
                        width="30" />
                </h2>
                <p>Similar to your selected Products</p>
            </div>
            <button class="close-view-similar" onclick="viewSimilar()">✕</button>
            <div class="view-similar-products">
                @foreach ($similar_products as $item)
                    <a href="{{ route('decoration-detail', ['product_slug' => $item->product_slug]) }}" class="link">
                        <div class="imageHolder">
                            <img src="{{ url("/uploads/products/$item->thumb_img") }}" alt="{{ $item->name }}"
                                height="50" width="50" decoding="async" loading="lazy" />
                        </div>
                        <p class="productName">{{ $item->name }}</p>
                        <div class="details">
                            <span class="price">₹{{ $item->discount_price }}</span>
                            <span class="beforePrice">₹{{ $item->price }}</span>
                            <span class="discount">({{ $item->discount_percentage }}% Off)</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="addon-modal">
        <div class="modal" onclick="viewAddon()"></div>
        <div class="addon-container">
            <div class="heading-container">
                <p class="addon-heading">Add on something to make it special!</p>
                <input type="hidden" name="product_id" id="product_id" value="18" />
                <span class="close-addon" onclick="viewAddon()"> &#x2715; </span>
            </div>
            <div class="addon-categories">
                <button id="popular-btn" class="active-addon">Popular</button>
                <button id="general-btn">General</button>
            </div>
            <div class="addon-items">
                @foreach ($addon as $item)
                    <div class="addon-item {{ $item->is_popular == 1 ? 'populardiv' : 'generaldiv' }}">
                        <div class="addon-image">
                            <img src="{{ url("/uploads/addon/$item->image") }}" alt="{{ $item->name }}"
                                height="50" width="50" decoding="async" loading="lazy" />
                        </div>
                        <p class="addon-item-name">{{ $item->name }}</p>
                        <p class="addon-item-price">₹{{ $item->price }}</p>
                        <div class="addon-item-controller">
                            <div class="addon-item-btns">
                                <button class="addon-item-btn minus">&#8722;</button>
                                <span class="addon-count">0</span>
                                <button class="addon-item-btn plus">&#43;</button>
                            </div>
                            <button id="{{ $item->id }}" data-custom-value="{{ $item->price }}"
                                data-custom-value2="" data-custom-value3="{{ $item->id }}" class="add-addon-btn">
                                ADD
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="addon-pricing">
                <div class="all-prices">
                    <p class="price-text"><b>Base Price:</b> ₹{{ $product->discount_price }}</p>
                    <input type="hidden" name="base_price" id="base_price" value="{{ $product->discount_price }}" />
                    <p class="price-text" id="total_addon_price">
                        <b>Addon Price:</b> ₹0
                    </p>
                    <p class="price-text" id="total_addon_number">
                        <b>Total Addons:</b>
                    </p>
                    <p class="price-text" id="total_price">
                        <b>Total Price:</b> ₹{{ $product->discount_price }}
                    </p>
                </div>
                <div class="addon-controllers">
                    <button class="skip-btn">Skip</button>
                    <!-- <a href="javascript:void(0);" class="proceed-btn"> Proceed </a> -->
                    <button class="proceed-btn">Proceed</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script defer src="{{ url('/') }}/assets/js/script-13.js"></script> --}}
    <script defer src="{{ url('/') }}/assets/js/scriptproduct13.js"></script>
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
    <script>
        $(document).ready(function() {
            function isValidDate(selectedDate) {
                const today = new Date();
                const inputDate = new Date(selectedDate);
                today.setHours(0, 0, 0, 0); // Set to midnight to compare just the dates
                return inputDate >= today; // Return true if selected date is today or later
            }

            // function isValidTime(selectedTime) {
            //     const currentTime = new Date();
            //     currentTime.setHours(currentTime.getHours() + 5); // Add 5 hours to current time

            //     const [hours, minutes] = selectedTime.split(":");
            //     const inputTime = new Date();
            //     inputTime.setHours(parseInt(hours), parseInt(minutes), 0, 0);

            //     return inputTime >= currentTime; // Return true if selected time is 5 hours from now or later
            // }

            function validateForm() {
                let isValid = true;
                // Validate City
                if ($("#city").val() === null) {
                    alert("Please select your city.");
                    isValid = false;
                }

                // Validate Date
                const selectedDate = $('input[name="date"]').val();
                if (selectedDate === "") {
                    alert("Please select a date.");
                    isValid = false;
                } else if (!isValidDate(selectedDate)) {
                    alert("The selected date must be today or later.");
                    isValid = false;
                }

                // // Validate Time
                // const selectedTime = $('input[name="time"]').val();
                // if (selectedTime === "") {
                //     alert("Please select a time.");
                //     isValid = false;
                // } else if (!isValidTime(selectedTime)) {
                //     alert("The selected time must be at least 5 hours from the current time.");
                //     isValid = false;
                // }

                return isValid;
            }

            $(".booknow-btn").on("click", function(event) {
                event.preventDefault();

                if (validateForm()) {
                    let formData = $('#order-form').serialize();
                    formData += '&_token={{ csrf_token() }}';
                    $.ajax({
                        url: "{{ route('cart.store') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'JSON',
                        success: function(response) {
                            console.log(response);
                            viewAddon();
                        },
                        error: function(xhr, status, error) {
                            triggerAlert(xhr.statusText, 'error')
                        }
                    });
                }
            });

            $("#general-btn").click(function() {
                $("#popular-btn").removeClass("active-addon");
                $(this).addClass("active-addon");
                $(".populardiv").css("display", "none");
                $(".generaldiv").css("display", "block");
            });

            $("#popular-btn").click(function() {
                $("#general-btn").removeClass("active-addon");
                $(this).addClass("active-addon");
                $(".generaldiv").css("display", "none");
                $(".populardiv").css("display", "block");
            });


            $(document).on('click', '.add-addon-btn', function() {
                let addon_count_with_price = 0;
                var product_id = "{{ $product->id }}";
                var addon_product_id = [];
                var addon_product_price = [];

                var countitem = $(this).closest("div").find("span.addon-count").text();
                $(this)
                    .closest("div")
                    .find("span.addon-count")
                    .text(parseInt(countitem) + 1);
                $(this).addClass("add-addon-added");
                $(this).data("custom-value2", parseInt(countitem) + 1);

                $(".add-addon-added").each(function(item) {
                    addon_count_with_price +=
                        parseInt($(this).data("custom-value")) *
                        parseInt($(this).data("custom-value2"));
                    console.log(addon_count_with_price);
                    $("#total_addon_price").html(
                        "<b>Addon Price:</b> ₹" + addon_count_with_price
                    );
                    var total_price = parseInt($("#base_price").val()) + addon_count_with_price;
                    $("#total_price").html("<b>Total Price:</b> ₹" + total_price);
                    var total_items = parseInt(item) + parseInt(1);
                    $("#total_addon_number").html("<b>Total Addons:</b> " + total_items);
                });
            });

            $(document).on('click', '.plus', function() {
                let addon_count_with_price = 0;
                var countitem = $(this).closest("div").find("span.addon-count").text();
                $(this)
                    .closest("div")
                    .find("span.addon-count")
                    .text(parseInt(countitem) + 1);
                $(this).closest("div").next("button").addClass("add-addon-added");
                $(this)
                    .closest("div")
                    .next("button")
                    .data("custom-value2", parseInt(countitem) + 1);

                $(".add-addon-added").each(function(item) {
                    addon_count_with_price +=
                        parseInt($(this).data("custom-value")) *
                        parseInt($(this).data("custom-value2"));
                    console.log(addon_count_with_price);
                    $("#total_addon_price").html(
                        "<b>Addon Price:</b> ₹" + addon_count_with_price
                    );
                    var total_price = parseInt($("#base_price").val()) + addon_count_with_price;
                    $("#total_price").html("<b>Total Price:</b> ₹" + total_price);
                    var total_items = parseInt(item) + parseInt(1);
                    $("#total_addon_number").html("<b>Total Addons:</b> " + total_items);
                });
            });

            $(document).on('click', '.minus', function() {
                let addon_count_with_price = 0;
                var countitem = $(this).closest("div").find("span.addon-count").text();

                if (parseInt(countitem) == 0) {
                    $(this).closest("div").next("button").removeClass("add-addon-added");
                    $(this).closest("div").next("button").data("custom-value2", parseInt(0));
                }

                if (parseInt(countitem) > 0) {
                    $(this)
                        .closest("div")
                        .find("span.addon-count")
                        .text(parseInt(countitem) - 1);
                    $(this)
                        .closest("div")
                        .next("button")
                        .data("custom-value2", parseInt(countitem) - 1);
                    if (parseInt($(this).closest("div").find("span.addon-count").text()) == 0) {
                        $(this).closest("div").next("button").removeClass("add-addon-added");
                        $(this).closest("div").next("button").data("custom-value2", parseInt(0));
                        $("#total_addon_price").html("<b>Addon Price:</b> ₹0");
                        var total_price = parseInt($("#base_price").val());
                        $("#total_price").html("<b>Total Price:</b> ₹" + total_price);
                    }
                }

                $(".add-addon-added").each(function(item) {
                    addon_count_with_price +=
                        parseInt($(this).data("custom-value")) *
                        parseInt($(this).data("custom-value2"));
                    console.log(addon_count_with_price);
                    $("#total_addon_price").html(
                        "<b>Addon Price:</b> ₹" + addon_count_with_price
                    );
                    var total_price = parseInt($("#base_price").val()) + addon_count_with_price;
                    $("#total_price").html("<b>Total Price:</b> ₹" + total_price);
                    var total_items = parseInt(item) + parseInt(1);
                    $("#total_addon_number").html("<b>Total Addons:</b> " + total_items);
                });
            });


            $(".proceed-btn").click(function() {
                let addon_ids = "";
                let addon_quantity = "";
                let product_id = "{{ $product->id }}";
                $(".add-addon-added").map(function() {
                    addon_ids += $(this).data("custom-value3") + ",";
                    addon_quantity += $(this).data("custom-value2") + ",";
                });
                addon_ids = addon_ids.replace(/,\s*$/, '');
                addon_quantity = addon_quantity.replace(/,\s*$/, '');

                console.log(addon_ids);
                console.log(addon_quantity);
                console.log(product_id);

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id,
                        addon_ids: addon_ids,
                        addon_quantitys: addon_quantity,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        window.location.href = "{{ route('cart') }}";
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: ", error);

                    }
                })

            });

            $(".skip-btn").click(function() {
                window.location.href = "{{ route('cart') }}";
            });

        });

        var swiper = new Swiper(".sub-sweeper", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".main-sweeper", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endsection
