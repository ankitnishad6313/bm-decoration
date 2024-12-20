@extends('front-layout')
@push('title')
    <title>{{ $title ?? $category->title }}</title>
@endpush

@section('meta-section')
    <meta name="title" content="{{ $category->title }}">
    <meta name="keywords" content="{{ $category->meta_keywords }}">
    <meta name="description" content="{{ $category->meta_description }}">
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/category.min.css" />
@endsection

@section('main-section')
    <div class="breadCrumbs">
        <a href="{{ route('index') }}">Home</a>
        <p>{{ $category->cat_name }}</p>
    </div>
    <div class="categoryName">
        <h1>{{ $title ?? $category->title }}</h1>
    </div>
    <section class="sorting">
        <p>Sort By: </p>
        <div class="optionSlider">
            <button id="1" >Popular</button>
            <button id="2" onclick="window.location.href='?sort=high-to-low'">Price: High to Low</button>
            <button id="3" onclick="window.location.href='?sort=low-to-high'">Price: Low to High</button>
        </div>
    </section>
    <section class="quickLinks">
        @foreach ($category->subCategory as $item)
            <p>
                <a href="{{ route('show-products', ['category_slug' => $item->category->category_slug, 'sub_category_slug' => $item->sub_category_slug]) }}">{{ $item->sub_cat_name }}</a>
            </p>
        @endforeach
        <p>&nbsp;</p>
    </section>

    {{-- Product Section Start --}}
    <section class="container">
        @foreach ($products as $item)
            <a href="{{ route('decoration-detail', ['product_slug' => $item->product_slug]) }}" class="link">
                <div class="imageHolder">
                    <picture>
                        <source srcset="{{ url("/uploads/products/$item->thumb_img") }}" type="image/webp">
                        <img src="{{ url("/uploads/products/$item->thumb_img") }}" alt="{{ $item->name }}"
                            height="50" width="50" decoding="async" />
                    </picture>

                </div>
                <p class="productName">{{ $item->name }}</p>
                <div class="details">
                    <span class="price">&#x20B9; {{ $item->discount_price }}</span>
                    <span class="beforePrice">&#x20B9; {{ $item->price }}</span>
                    <span class="discount">({{ $item->discount_percentage }}% Off)</span>
                </div>
            </a>
        @endforeach
    </section>
    {{-- Product Section End --}}


    <section class="seoContent">
        <p>{!! $category->description !!}</p>
    </section>
    <section class="faqContainer" itemscope="" itemtype="https://schema.org/FAQPage">
        <h2>
            Frequently asked questions
            <img src="/assets/icons/faq-home.svg" alt="question icon" height="25" width="25" loading="eager" />
        </h2>
        <div class="faqQnAs">

            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: What is the starting price for your basic baby shower decoration
                    package? <img src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Our simple baby shower decoration package at home starts at Rs.1499. Visit our
                        website B.M. Decoration.com to choose from a wide range of decoration for baby shower.</span>
                </div>
            </div>

            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: Can I customize my baby shower as per Indian theme? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Yes, you can customize your baby shower as per Indian Theme, such as, Godh
                        Bharai, Valaikappu, Srimantha, Seemantham, Puli Kudi, Dohale Jevan, etc. To get ideas for baby
                        shower decoration, visit B.M. Decoration.com. We also offer services at reasonable prices all over
                        India.</span>
                </div>
            </div>

            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: Can you suggest some ideas for baby shower decoration with
                    flowers? <img src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Baby shower ceremony can be beautifully organized with natural fresh flower.
                        Visit our website to choose from a huge variety of flower decoration options for baby shower. Book
                        and enjoy the best quality service hassle free at budget friendly rates from B.M. Decoration at your
                        desired location across India.</span>
                </div>
            </div>

            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: How to book for baby shower decoration at home online from your
                    website? <img src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">Booking baby shower decoration is easier than ever with services like B.M.
                        Decoration,
                        a trustworthy event organizer that provides same-day decoration services. To book baby shower
                        decoration, reach out to us, discuss your requirements, confirm the booking by deciding on day,
                        time, place, make the payment and sit back and relax.</span>
                </div>
            </div>

            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: How can I contact your team for baby shower decoration? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">You can contact our team directly through call or whatsapp us on 7450960060 or
                        visit our website B.M. Decoration.com.</span>
                </div>
            </div>

            <div itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <p class="questions" itemprop="name">Q: In which cities in India are your services available? <img
                        src="/assets/icons/plus.svg" alt="plus icon" height="20" width="20" />
                </p>
                <div class="answers" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <span itemprop="text">We provide our services in major cities across India, including Bangalore,
                        Chennai, Lucknow, Kolkata, Hyderabad, Pune, Mumbai, Delhi, Indore, Bhopal, Ahmedabad, and many more!
                    </span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
