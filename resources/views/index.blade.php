@extends('front-layout')
@push('title')
    <title>Home Page</title>
@endpush
@section('meta-section')
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style4.css" />
@endsection
@section('slider')
    <section style="background-color: red">
        <div class="" style="margin-top: 3px; width:100%">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $item)
                        <div class="swiper-slide">
                            <img src="{{ url("/uploads/slider/$item->image") }}" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next" style="color:white"></div>
                <div class="swiper-button-prev" style="color:white"></div>
            </div>
        </div>
    </section>
@endsection
@section('main-section')
    <h1 class="hero-heading">Our Popular Categories</h1>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 12" width="100"
        height="12" preserveAspectRatio="xMidYMid meet">
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
    <div class="category-routes">
        @foreach ($categories as $category)
            <a class="category-route" href="{{ route('show-products', ['category_slug' => $category->category_slug]) }}">
                <picture>
                    <source srcset="{{ $category->cat_image }}" type="image/jpeg">
                    <img src="{{ $category->cat_image }}" alt="category image" height="50" width="50"
                        decoding="async" />
                </picture>
                <p>{{ $category->cat_name }}</p>
            </a>
        @endforeach

    </div>
    <a class="viewall-category" href="{{ route('categories') }}">All Categories</a>


    @foreach ($data as $category)
        @php
            if ($category->products->count() == 0) {
                continue;
            }
        @endphp
        <section class="container">
            <div class="products-heading">
                <h2>{{ $category->title }}</h2>
                <a href="{{ route('show-products', ['category_slug' => $category->category_slug]) }}">View All</a>
            </div>
            <div class="products">
                @foreach ($category->products as $key => $item)
                    <a href="{{ route('decoration-detail', ['product_slug' => $item->product_slug]) }}" class="link">
                        <div class="imageHolder">
                            <img src="{{ url("/uploads/products/$item->thumb_img") }}" alt="{{ $item->name }}"
                                height="50" width="50" decoding="async" loading="lazy" />
                        </div>
                        <p class="productName d-inline-block text-truncate">{{ $item->name }}</p>
                        <div class="details">
                            <span class="price">&#x20B9;
                                {{ $item->discount_price ? $item->discount_price : $item->price }}</span>
                            <span class="beforePrice">&#x20B9; {{ $item->price }}</span>
                            <span class="discount">({{ $item->discount_percentage ? $item->discount_percentage : 0 }}%
                                Off)</span>
                        </div>
                    </a>
                    @php
                        if ($key == 3) {
                            break;
                        }
                    @endphp
                @endforeach
            </div>
        </section>
    @endforeach

    <section class="seoContent">
        <h3>About BM Decoration - Book Now on B.M. Decoration</h3>

        <p>
            Welcome to BM Decoration, your one-stop destination for all your decoration needs! Established with a passion
            for creativity and style, BM Decoration has been serving the community with high-quality decorative items that
            add charm and elegance to every event. Whether you're planning a wedding, birthday, corporate event, or any
            special occasion, we have a wide variety of products to suit your theme and vision.
        </p>

        <p>
            At BM Decoration, we believe in turning ordinary spaces into extraordinary experiences. Our carefully curated
            collection of items includes everything from vibrant florals, stylish centerpieces, and unique party accessories
            to elegant lighting solutions and custom decorations. We pride ourselves on offering top-notch products at
            affordable prices, ensuring that your event stands out without breaking the bank.
        </p>
        <p>
            With a commitment to customer satisfaction, our team is always ready to assist you in choosing the right décor
            elements for your event. BM Decoration is not just about products; it's about creating memories that last a
            lifetime. Let us be a part of your next celebration and help you bring your dream event to life!
        </p>

        <h3>Why Choose B.M. Decoration for Online Balloon Decorations?</h3>
        <ul>
            <li><strong>Stress-Free Experience: </strong>We handle everything from the beginning to the end to make sure
                everything runs smoothly and is enjoyable for you.&nbsp;</li>
            <li><strong>Exceptional Customer Service:</strong> Our team members are dedicated to exceeding your
                expectations by carefully working with you to fully understand your ideas before creating balloon
                decorations that are ideal for any occasion.&nbsp;</li>
            <li><strong>Top-Notch Balloons with Safety Measures:</strong> We put safety first and use only the best
                materials to make sure that our clients can relax and enjoy themselves during these celebrations.&nbsp;
            </li>
            <li><strong>Budget-Friendly Prices:</strong> We offer a range of options to fit different budgets, making
                amazing designs accessible to everyone.</li>
        </ul>
        <p><strong>Reliable and Trustworthy:</strong> From timely execution to high-quality decorations, you can rely on
            us to handle your event with care and precision. We’re committed to making your celebrations stress-free and
            enjoyable.<br><strong>B.M. Decoration is Available All India</strong><br>

            @foreach (getPopularCity() as $key => $city)
                @if ($key != 0)
                    <strong> | </strong>
                @endif
                <a href="#">
                    <strong>{{ $city->city }}</strong>
                </a>
            @endforeach

            <strong> and 100+ cities</strong>
        </p>
    </section>
    <section class="faqContainer" itemscope="" itemtype="https://schema.org/FAQPage">
        <h2>
            Frequently asked questions
            <img src="/assets/icons/faq-home.svg" alt="question icon" height="25" width="25" loading="eager" />
        </h2>
        <div class="faqQnAs">
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: What types of events do you specialize in? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">We specialize in balloon and home decoration services for a variety of small
                        events, including birthday parties, anniversaries, baby showers, engagements, and other intimate
                        celebrations. We also specialize in flower backdrop decorations for haldi & mehndi, wedding
                        night and other ceremonies.</span>
                </div>
            </div>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: What is the starting price of balloon decoration at home?
                    <img src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">The starting price of simple balloon decoration is Rs.1499. We pride
                        ourselves on offering budget-friendly balloon decoration packages without compromising on
                        quality. Check out our website for affordable options that suit various occasions and
                        budgets.</span>
                </div>
            </div>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: Can I customize my event decoration package? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Yes, all our decoration packages are customizable to meet your specific
                        needs and preferences. Discuss your requirements with our team to create the perfect setup for
                        your event.</span>
                </div>
            </div>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: Do you offer same-day balloon decoration services? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Yes, we provide same-day balloon decoration services to accommodate
                        last-minute event planning. Contact us to ensure availability and timely service.</span>
                </div>
            </div>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: How can I book balloon decorations online from your website?
                    <img src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Booking balloon decorations with B.M. Decoration is easy. Simply visit our
                        website,
                        browse through our available packages, customize your selection, and book online. We offer a
                        user-friendly booking process to ensure convenience.</span>
                </div>
            </div>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: How do I contact B.M. Decoration for more information? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">You can contact us through our website at B.M. Decoration.com or call us directly
                        at 7450960060. Follow us on social media for the latest updates and decoration ideas.</span>
                </div>
            </div>
            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: How far in advance should I book balloon decoration
                    services? <img src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">For the best availability and to ensure we can meet all your specific
                        requirements, we recommend booking your balloon decoration services at least 2-3 days in
                        advance. However, we also offer same-day decoration services for last-minute events, subject to
                        availability.</span>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
