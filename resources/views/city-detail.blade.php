@extends('front-layout')
@push('title')
    <title>Welcome in&apos;s No.1 Decoration Website in {{ $city->city }}</title>
@endpush

@section('meta-section')
    <meta name="title" content="{{ $city->title }}">
    <meta name="keywords" content="{{ $city->meta_keywords }}">
    <meta name="description" content="{{ $city->meta_description }}">
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style4.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/category.min.css" />
    <style>
        #breadcumb-bg {
            background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url("{{ url('/assets/images/breadcumb-bg.jpg') }}");
            background-origin: content-box;
            background-size: 100% 100%;
        }

        .city {
            display: flex;
            flex-direction: column;
            /* Default for mobile */
            margin: 20px;
            padding: 10px;
            gap: 15px;
        }

        .city-img img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .city-about {
            display: flex;
            flex-direction: column;
        }

        .seoContent {
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Desktop View */
        @media (min-width: 768px) {
            .city {
                flex-direction: row;
                /* Arrange content horizontally */
                align-items: center;
            }

            .city-img,
            .city-about {
                flex: 1;
                /* Equal width */
            }

            .city-img {
                margin-right: 20px;
                /* Space between image and content */
            }

            .seoContent {
                font-size: 1.2rem;
                /* Slightly larger text for desktop */
            }
        }



        .call-btn>img,
        .whatsapp-btn>img {
            height: 2.5rem;
            width: 2.5rem;
            vertical-align: bottom;
            margin-right: .8rem;
        }

        .call-btn {
            border: .2rem solid #0071e3 !important;
            color: #0071e3;
        }

        .call-btn,
        .whatsapp-btn {
            padding: 1rem;
            border-radius: 10rem;
            text-align: center;
            font: 600 1.7rem var(--bold);
            background-color: var(--white);
        }

        .map {
            margin: 50px 0px;
            padding: 0px 20px;
        }

        .map iframe {
            width: 100% !important;
        }

        .viewall-category:hover {
            background-color: #d9bf6d;
        }
    </style>
@endsection
@section('slider')
    <div class="container-fluid" id="breadcumb-bg">
        <div class="breadcumb-area">
            <div class="breadcumb-heading">
                <h2>Our Services are available in {{ $city->city }}
                    {{-- @php
                    $text = '';
                @endphp
                @foreach (getMenuCity() as $item)
                    @php
                        $text .= $item->city . ', ';
                    @endphp
                @endforeach
                {{ substr($text, 0, -2) }} --}}
                </h2>
                <h1>Balloon Decoration <br> in {{ $city->city }}</h1>
            </div>
            <div>
                <a href="tel:+91 {{ $city->phone ?? getAdminDetail()->phone }}" class="viewall-category"
                    style="margin-left:50px">
                    <span>+91 {{ $city->phone ?? getAdminDetail()->phone }}</span>
                    {{-- <img src="{{ url('/') }}/assets/icons/telephone-outbound.svg" style="color:#0071e3" alt="call-icon" height="25" width="50"
                        decoding="async" loading="lazy" /> --}}
                    {{-- <i class="bi bi-telephone-outbound"></i> --}}
                </a>
            </div>
        </div>
    </div>
@endsection
@section('main-section')
    <section class="quickLinks">
        @foreach ($category as $item)
            <p><a href="{{ route('show-products', ['category_slug' => $item->category_slug]) }}">{{ $item->cat_name }}</a>
            </p>
        @endforeach
        <p>&nbsp;</p>
    </section>



    {{-- Product Section Start --}}
    <h1 style="text-align: center; font-size:3rem; margin:20px 0px 0px 0px">Our Popular Products</h1>

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
                    <span class="price">&#x20B9; {{ $item->price }}</span>
                    <span class="beforePrice">&#x20B9; {{ $item->discount_price }}</span>
                    <span class="discount">({{ $item->discount_percentage }}% Off)</span>
                </div>
            </a>
        @endforeach
    </section>
    {{-- Product Section End --}}

    <div class="container-fluid">
        <h1 style="text-align: center; font-size:3rem; margin:20px 0px">About B.M. Decoration</h1>
        <div class="city">
            <div class="city-img">
                <img src="{{ url("/uploads/city/$city->image") }}" alt="">
            </div>
            <div class="city-about">
                <div class="seoContent">
                    {!! $city->description !!}
                </div>
            </div>
        </div>
    </div>

    <section class="map">
        {!! $city->map !!}
    </section>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
    <script>
        $(document).ready(function() {
            var city = "{{ $city->city }}";
            $('.locationBtn span').text(`${city}`)
        })
    </script>
@endsection
