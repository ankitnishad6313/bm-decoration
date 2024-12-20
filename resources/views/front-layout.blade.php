<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('meta-section')
    {{-- @stack('title') --}}
    <link rel="preload" href="{{ url('/') }}/assets/fonts/Nunito-Light.ttf" as="font" type="font/ttf"
        crossorigin="anonymous">
    <link rel="preload" href="{{ url('/') }}/assets/fonts/Nunito-Medium.ttf" as="font" type="font/ttf"
        crossorigin="anonymous">
    <link rel="preload" href="{{ url('/') }}/assets/fonts/Nunito-Bold.ttf" as="font" type="font/ttf"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/toast.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/assets/images/favicon.ico">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/sweeper.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/common4.css" />
    <style>
        .header {
            position: sticky;
            top: 0px;
        }

        .captcha-div {
            display: flex;
            align-items: center
        }
        .captcha-div img{
            margin-left: 30px;
        }
        .captcha-div img:hover{
            cursor: pointer;
        }
    </style>
    @yield('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/common10.css" />
</head>

<body>
    <header class="header mb-2">
        <nav class="navbar">
            <div class="logo">
                <button class="menuBtn" onclick="viewSidebar()">
                    <img src="{{ url('/') }}/assets/icons/menu.svg" alt="menu icon" height="25"
                        width="25" />
                </button>
                <a href="{{ route('index') }}">
                    <img src="{{ url('/') }}/assets/images/logo.png" alt="logo image" decoding="async"
                        loading="lazy" />
                </a>
            </div>
            <button class="locationBtn" onclick="viewCityPopup()">
                <img src="{{ url('/') }}/assets/icons/navigation.svg" alt="navigation icon" height="25"
                    width="25" />
                <span style="font-weight: bold">Select Location</span>
            </button>
            <div class="searchHolder">
                <input type="text" placeholder="Search..." onkeyup="filterDecorationsDesktop()"
                    onclick="filterDecorationShow()" />
                <div class="desktop-searcg-results">
                    <p class="trending-text">
                        Trendings
                        <img src="{{ url('/') }}/assets/icons/fire.svg" alt="fire icon" height="20"
                            width="20">
                    </p>
                    <div class="trending-container">
                        @foreach (getTrendingCategory() as $key => $item)
                            <a href="{{ route('show-products', ['category_slug' => $item->category_slug]) }}"
                                class="trending-btn">
                                {{ $item->cat_name }}
                                <img src="{{ url('/') }}/assets/icons/trending.svg" alt="trending icon"
                                    height="20" width="20" />
                            </a>
                            @php
                                if ($key == 9) {
                                    break;
                                }
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex1"></div>
            <div class="navbarLinks">
                @guest
                    <button onclick="viewSignin()">
                        <img src="{{ url('/') }}/assets/icons/user.svg" alt="user icon" height="20"
                            width="20" />
                        <span>Log in</span>
                    </button>
                @endguest
                @auth
                    @php
                        $route = auth()->user()->role == 'user' ? 'user-dashboard' : 'admin-dashboard';
                    @endphp
                    <button class="footer-menu-link" onclick="window.location.href='{{ route($route) }}'">
                        <img src="{{ url('/') }}/assets/icons/user.svg" alt="category image" height="40"
                            width="40" class="footer-menu-icon" />
                        <span>Profile</span>
                    </button>
                    <button onclick="window.location.href='{{ route('logout') }}'">
                        <img src="{{ url('/') }}/assets/icons/arrow-right-circle.svg" alt="user icon"
                            style="height:15px !important; width:15px !important" />
                        <span>Logout</span>
                    </button>
                @endauth

                <button onclick="window.location.href='{{ route('cart') }}'" class="footer-menu-link">
                    <img src="{{ url('/') }}/assets/icons/cart.svg" alt="cart image" height="40" width="40"
                        class="footer-menu-icon" />
                    <span>Cart</span>
                    <span class="addon-count">{{ cartCount() }}</span>
                </button>

                <!--</button>-->
                <a href="{{ route('contact-us') }}">
                    <img src="{{ url('/') }}/assets/icons/contact-icon.svg" alt="cart icon" height="20"
                        width="20" />
                    <span>Contact</span>
                </a>
            </div>
        </nav>
        @php
            $isTrue = request()->routeIs('decoration-detail');
        @endphp

        @if (!$isTrue)
            <div class="footer-menu">
                <a href="{{ route('index') }}" class="footer-menu-link">
                    <img src="{{ url('/') }}/assets/icons/active-home.svg" alt="home image" height="40"
                        width="40" class="footer-menu-icon" />
                    <img src="{{ url('/') }}/assets/icons/circle-fill.svg" alt="circle fill image"
                        height="5" width="5" class="circle-fill" />
                </a>

                <a href="{{ route('categories') }}" class="footer-menu-link">
                    <img src="{{ url('/') }}/assets/icons/category.svg" alt="category image" height="40"
                        width="40" class="footer-menu-icon" />
                    <span>Category</span>
                </a>
                <button class="footer-menu-link" onclick="viewSearchbar()">
                    <img src="{{ url('/') }}/assets/icons/search.svg" alt="search image" height="40"
                        width="40" class="footer-menu-icon" />
                    <span>Search</span>
                </button>
                @guest
                    <button class="footer-menu-link" onclick="viewSignin()">
                        <img src="{{ url('/') }}/assets/icons/user.svg" alt="sign in image" height="40"
                            width="40" class="footer-menu-icon" />
                        <span>Sign In</span>
                    </button>
                @endguest

                @auth
                    <button class="footer-menu-link" onclick="window.location.href='{{ route($route) }}'">
                        <img src="{{ url('/') }}/assets/icons/user.svg" alt="profile image" height="40"
                            width="40" class="footer-menu-icon" />
                        <span>Profile</span>
                    </button>
                    <button class="footer-menu-link" onclick="window.location.href='{{ route('logout') }}'">
                        <img src="{{ url('/') }}/assets/icons/user.svg" alt="logout image" height="40"
                            width="40" class="footer-menu-icon" />
                        <span>Logout</span>
                    </button>
                @endauth
                <button onclick="window.location.href='{{ route('cart') }}'" class="footer-menu-link">
                    <img src="{{ url('/') }}/assets/icons/cart.svg" alt="cart image" height="40"
                        width="40" class="footer-menu-icon" />
                    <span>Cart</span>
                    <span class="addon-count">{{ cartCount() }}</span>
                </button>
            </div>
        @endif

    </header>
    <div class="sidemenu-wrapper">
        <div class="sidemenu-modal" onclick="viewSidebar()"></div>
        <div class="dynamicLinks">
            <div class="user-controlls">
                <img src="{{ url('/') }}/assets/icons/user.svg" alt="user image" height="30"
                    width="30" />
                <span class="close-sidemenu" onclick="viewSidebar()">✕</span>
                <div class="name-sign-options">
                    <div class="supportsignin-holder">
                        <button onclick="viewSignin()">Log In</button>
                        <a href="{{ route('contact-us') }}">Contact</a>
                    </div>
                </div>
            </div>
            <div class="dynamicLinks-holder">
                @foreach (getMenuCategory() as $category)
                    <div class="dynamiclink-wrapper">
                        <div class="alink-holder">
                            <a class="dynamic-link"
                                href="{{ route('show-products', ['category_slug' => $category->category_slug]) }}">{{ $category->cat_name }}</a>
                            <img src="{{ url('/') }}/assets/icons/plus.svg" class="plus-icon" alt="plus icon"
                                height="25" width="25" decoding="async" loading="lazy">
                        </div>

                        @if ($category->subCategory->count() != 0)
                            <div class="sub-dynamiclinks">
                                @foreach ($category->subCategory as $item)
                                    <a class="sub-links"
                                        href="{{ route('show-products', ['category_slug' => $category->category_slug, 'sub_category_slug' => $item->sub_category_slug]) }}">{{ $item->sub_cat_name }}</a>
                                @endforeach
                            </div>
                        @endif

                    </div>
                @endforeach

                <div class="dynamiclink-wrapper">
                    <div class="alink-holder">
                        <a class="dynamic-link" href="#">Cities</a>
                        <img src="{{ url('/') }}/assets/icons/plus.svg" class="plus-icon" alt="plus icon"
                            height="25" width="25" decoding="async" loading="lazy">
                    </div>
                    <div class="sub-dynamiclinks">
                        @foreach (getMenuCity() as $city)
                            <a class="sub-links"
                                href="{{ route('city-detail', ['city_slug' => $city->city_slug]) }}">{{ $city->city }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="connect-div">
                <p>Connect With Us</p>
                <div class="connect-controllers">
                    <a href="https://wa.me/+919914925565" class="connect-whatsapp">
                        <img src="{{ url('/') }}/assets/icons/whatsapp-icon.svg" alt="whatsapp icon"
                            height="30" width="30" decoding="async" loading="lazy">
                        Whatsapp</a>
                    <a href="tel:+919914925565" class="connect-call">
                        <img src="{{ url('/') }}/assets/icons/phone-blue.svg" alt="phone icon" height="30"
                            width="30" decoding="async" loading="lazy">
                        Call Us</a>
                </div>
                <ul>
                    <li><b>Calling Hours:</b>&nbsp;&nbsp;Mon to Sat&nbsp;(10:30 AM - 07:30 PM)</li>
                    <li><b>*All day&apos;s available on WhatsApp</b></li>
                </ul>
            </div>
        </div>
    </div>
    @yield('slider')
    @yield('main-section')
    <footer>
        <div class="nestedFooter">
            <div class="footerLinks">
                <div>
                    <h2 class="footerHeading">Important Links</h2>
                    <div class="linkHolder">
                        <a href="{{ route('about-us') }}" class="footerLink">About Us</a>
                    </div>

                    <div class="linkHolder">
                        <a href="{{ route('terms-and-conditions') }}" class="footerLink">Terms And
                            Conditions</a>
                    </div>
                    <div class="linkHolder">
                        <a href="{{ route('privacy-policy') }}" class="footerLink">Privacy Policy</a>
                    </div>
                    <div class="linkHolder">
                        <a href="{{ route('return-and-refund') }}" class="footerLink">Return And
                            Refund</a>
                    </div>
                    <div class="linkHolder">
                        <a href="{{ route('contact-us') }}" class="footerLink">Contact Us</a>
                    </div>
                    <div class="linkHolder">
                        <a href="{{ route('disclaimer') }}" class="footerLink">Disclaimer</a>
                    </div>
                    <div class="linkHolder">
                        <a href="{{ route('shipping-policy') }}" class="footerLink">Shipping and Delivery Policy</a>
                    </div>
                    <div class="linkHolder">
                        <a href="#" class="footerLink">Blogs</a>
                    </div>

                </div>
                <div>
                    <h2 class="footerHeading">Top Cities</h2>

                    @foreach (getMenuCity() as $city)
                        <div class="linkHolder">
                            <a class="footerLink"
                                href="{{ route('city-detail', ['city_slug' => $city->city_slug]) }}">{{ $city->city }}</a>
                        </div>
                    @endforeach

                </div>
                <div>
                    <h2 class="footerHeading">Contact Info</h2>
                    <div class="linkHolder">
                        <a href="tel:+919914925565" class="footerLink">+919914925565</a>
                    </div>
                    <div class="linkHolder">
                        <a href="mailto:rajpartyplanner@gmail.com" class="footerLink">rajpartyplanner@gmail.com</a>
                    </div>
                    <div class="linkHolder">
                        <a href="#" class="footerLink">Shop No 27, Highland Marg, Bhabat, <br> Nabha, Punjab
                            140603</a>
                    </div>
                </div>
                <div>
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ url('/') }}/assets/images/logo.png" alt="logo image" height="25"
                                width="25" decoding="async" loading="lazy" />
                        </a>
                    </div>
                    <p class="followus-txt">Follow Us</p>
                    <div class="socials">
                        <a href="https://www.facebook.com/">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/i/flow/login?redirect_after_login=#">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="https://www.instagram.com/">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="https://in.linkedin.com/">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://www.pinterest.com/">
                            <i class="bi bi-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="paymentMethods">
                <div class="paymentPortals">
                    <img src="{{ url('/') }}/assets/icons/visa.webp" alt="Visa" height="50"
                        width="50" loading="eager" />
                    <img src="{{ url('/') }}/assets/icons/mastercard.webp" alt="Master Card" height="50"
                        width="50" loading="eager" />
                    <img src="{{ url('/') }}/assets/icons/american_express.webp" alt="American Express"
                        height="50" width="50" loading="eager" />
                    <img src="{{ url('/') }}/assets/icons/google_pay.webp" alt="Google Pay" height="50"
                        width="50" loading="eager" />
                </div>
                <p>&copy; 2024 B.M. Decorations - All Rights Reserved</p>
            </div>
        </div>
    </footer>
    <!--<div class="sub-footer">-->
    <!--    <p>Design & Developed by <a href="" target="_blank"></a></p>-->
    <!--</div>-->
    <div class="modal-wrapper">
        <div class="modal" onclick="viewCityPopup()"></div>
        <div class="city-popup">
            <div class="city-header">
                <p>
                    <img src="{{ url('/') }}/assets/icons/gps.webp" alt="location icon" height="25"
                        width="25" />
                    Select your location
                </p>
                <span onclick="viewCityPopup()">✕</span>
            </div>
            <div class="city-search">
                <input type="text" placeholder="Searchg city..." onkeyup="filterCities()" />
            </div>
            <div class="city-search-list">

                {{-- City List Start  --}}
                @foreach (getAllCity() as $city)
                    <button class="citybtn" id="{{ $city->id }}" data-city="{{ $city->city }}"
                        onclick="window.location.href='{{ route('city-detail', ['city_slug' => $city->city_slug]) }}'">
                        <span>
                            <img alt="navigation image" loading="lazy" width="20" height="20"
                                decoding="async" data-nimg="1"
                                src="{{ url('/') }}/assets/icons/navigation.svg" style="color: transparent" />
                            {{ $city->city }}
                        </span>
                        <img alt="trending image" loading="lazy" width="20" height="20" decoding="async"
                            data-nimg="1" src="{{ url('/') }}/assets/icons/trending.svg"
                            style="color: transparent" />
                    </button>
                @endforeach
                {{-- City List End --}}

            </div>
        </div>
    </div>
    <div class="sign-in-modal">
        <div class="modal" onclick="viewSignin()"></div>

        <div class="sign-in-dialogue">
            <h2>Sign in</h2>
            <p>
                Enjoy the convenience of a single account across all participating
                brands
            </p>

            <button class="close-signin" onclick="viewSignin()">
                <img src="{{ url('/') }}/assets/icons/close.svg" alt="close icon" height="25" width />
            </button>

            <div class="signin-form-holder">
                {{-- Login Form --}}
                <form class="signin-form" action="{{ route('login') }}" onsubmit="return checkLoginCaptcha()"
                    method="POST">
                    @csrf
                    <label for="number">Enter Email</label>
                    <div class="input-fields">
                        <input type="email" placeholder="Enter your Email" id="number" name="email"
                            class="number" required />
                    </div>

                    <label for="password" class="password_label">Password</label>
                    <div class="input-fields">
                        <input type="password" name="password" placeholder="Enter your password" id="password"
                            required />
                    </div>
                    <div class="input-fields">
                        <div class="captcha-div">
                            <div class="captcha" id="log_captcha"></div>
                            <img alt="reload image" title="Reload Captcha" onclick="drawLoginCaptcha()" loading="lazy" width="20"
                                height="20" decoding="async" data-nimg="1"
                                src="{{ url('/') }}/assets/icons/reload.png" style="color: transparent" />
                        </div>
                        <input type="text" class="form-control" name="captcha_input" id="login_captcha_input"
                            placeholder="Enter Captcha" required>
                        <input type="hidden" name="original_captcha" id="login_captcha">

                    </div>
                    <div class="d-flex justify-content around">
                        <button type="submit" style="text-align: center">Login</button>
                        <p class="mt-2">Not an account? <a href="#" class="switch-form">Sign Up</a></p>
                    </div>
                </form>

                {{-- Register Form --}}
                <form class="signin-form hidden" action="{{ route('register') }}"
                    onsubmit="return checkRegisterCaptcha()" method="POST">
                    @csrf
                    <label for="name">Name</label>
                    <div class="input-fields">
                        <input type="text" placeholder="Enter your name" id="name" name="name"
                            required />
                    </div>
                    <label for="email">Email</label>
                    <div class="input-fields">
                        <input type="email" placeholder="Enter your Email" id="email" name="email"
                            required />
                    </div>
                    <label for="phone">Phone</label>
                    <div class="input-fields">
                        <input type="number" maxlength="10" placeholder="Enter your Phone" id="phone"
                            name="phone" required />
                    </div>
                    <label for="password" class="password_label">Create Password</label>
                    <div class="input-fields">
                        <input type="password" placeholder="Enter your password" name="password" id="passwordnew"
                            required />
                    </div>
                    <div class="input-fields">
                        <div class="captcha-div">
                            <div class="captcha" id="reg_captcha"></div>
                            <img alt="reload image" title="Reload Captcha" onclick="drawRegisterCaptcha()" loading="lazy" width="20"
                                height="20" decoding="async" data-nimg="1"
                                src="{{ url('/') }}/assets/icons/reload.png" style="color: transparent" />
                        </div>
                        <input type="text" class="form-control" name="captcha_input" id="register_captcha_input"
                            placeholder="Enter Captcha" required>
                        <input type="hidden" name="original_captcha" id="register_captcha">

                    </div>
                    <div>
                        <button type="submit" style="text-align: center">Register</button>
                        <p class="mt-2">Already have an account? <a href="#" class="switch-form">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="search-container">
        <div class="search-container-heading">
            <h2>Search</h2>
            <button onclick="viewSearchbar()">✕</button>
        </div>
        <form action="" method="post" class="search-holder">
            <input type="text" placeholder="Search decorations..." onkeyup="filterDecorations()" />
        </form>
        <p class="trending-text">
            Trendings
            <img src="{{ url('/') }}/assets/icons/fire.svg" alt="fire icon" height="20" width="20" />
        </p>

        <div class="trending-container">
            @foreach (getTrendingCategory() as $key => $item)
                <a href="{{ route('show-products', ['category_slug' => $item->category_slug]) }}"
                    class="trending-btnm">
                    {{ $item->cat_name }}
                    <img src="{{ url('/') }}/assets/icons/trending.svg" alt="trending icon" height="20"
                        width="20" />
                </a>
                @php
                    if ($key == 7) {
                        break;
                    }
                @endphp
            @endforeach

        </div>
    </div>


    <div class="wg-help-circle wg-help-call">
        <a role="link" aria-label="telephone" href="tel:+91 9914925565"><img style="width: 100%;"
                src="{{ url('/') }}/assets/icons/call-icon-2.webp" alt="tel.png" width="54"
                height="54"></a>
    </div>
    <div class="wg-help-circle wg-help-whatsapp">
        <a role="link" aria-label="whatsapp" target="_blank"
            href="whatsapp://send?phone=+91 9914925565&amp;text=Hey-BM-Decorations-I-have-a-query"><img
                style="width: 100%;" src="{{ url('/') }}/assets/icons/whatsapp-icon2.webp" alt="wa.png"
                width="54" height="54"></a>
    </div>

    <script src="{{ url('/') }}/assets/js/jquery-3.7.1.js"></script>
    <script src="{{ url('/') }}/assets/js/toast.js"></script>
    <script src="{{ url('/') }}/assets/js/captcha.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        $(document).on('click', '.citybtn', function() {
            // event.preventDefault();
            console.log("success");

            var cityid = $(this).data("id");
            var cityname = $(this).data('city');
            console.log(cityname);

            $('.locationBtn span').text(`${cityname}`)
            $('.modal-wrapper').toggleClass('blocked');
        });
    </script>

    @if (Auth::user())
        <script>
            $(document).ready(function() {
                function cartCount() {
                    $.ajax({
                        url: "{{ route('cart-count') }}",
                        type: "GET",
                        success: function(response) {
                            console.log(response.message);
                            console.log(response.status);

                            if (response.status === true) {
                                $('a > .addon-count').text(response.count);
                            }
                        },

                        error: function(xhr, status, error) {
                            // console.log("Error", xhr);

                        },
                    });
                }
                cartCount();
            });
        </script>
    @endif

    @yield('script')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                triggerAlert('{{ $error }}', 'error')
            </script>
        @endforeach
    @endif
    @if (session('success'))
        <script>
            triggerAlert("{{ session('success') }}", 'success')
        </script>
    @endif

    @if (session('error'))
        <script>
            triggerAlert("{{ session('error') }}", 'error')
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.switch-form').click(function() {
                $('.signin-form').toggleClass('hidden')
            });

            $('#phone').keyup(function() {
                let phone = $(this).val();

                phone = phone.replace(/\D/g, '');

                if (phone.length > 10) {
                    phone = phone.substring(0, 10);
                }

                $(this).val(phone);
            });

        });
    </script>
</body>

</html>
