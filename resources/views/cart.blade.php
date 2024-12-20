<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cart.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/toast.css">
    <style>
        .proceed-to-buy button {
            position: relative;
            padding: 1.5rem;
            display: block;
            width: 100%;
            background-color: var(--website);
            color: var(--white);
            font: 400 1.7rem var(--bold);
            text-align: center;
            cursor: pointer;
            border: none;
            border-radius: 1rem;
        }

        .proceed-to-buy button::before {
            content: "";
            height: 100%;
            width: 5%;
            background-color: #f8dfba5e;
            position: absolute;
            bottom: 0;
            left: 0;
            transform: rotate(3deg);
            animation: 2s ease-in-out infinite forwards buyshadow;
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
</head>

<body>
    <header class="header">
        <div class="navbar">
            <a href="{{ url()->previous() ?? route('home') }}" class="checkout-text">
                <img src="{{ url('/') }}/assets/icons/back-icon.svg" alt="back icon" height="25"
                    width="25" />
                Checkout <span>(1 / 3)</span>
            </a>

            <div>
                <p class="navbar-text">
                    <img src="{{ url('/') }}/assets/icons/assistant.webp" alt="assistant img" height="25"
                        width="25" />
                    Need Asistance?
                </p>
                <a href="https://wa.me/{{ getAdminDetail()->phone }}" class="whatsapp-btn">
                    <img src="{{ url('/') }}/assets/icons/whatsapp.svg" alt="whatsapp icon" height="20"
                        width="20" />
                    Whatsapp
                </a>
                <a href="tel:+91 {{ getAdminDetail()->phone }}" class="whatsapp-btn">
                    <img src="{{ url('/') }}/assets/icons/phone-icon.svg" alt="phone icon" height="20"
                        width="20" />
                    Call
                </a>
            </div>
        </div>
    </header>
    <main id="step-cart">
        @php
            $base_total = 0;
            $addon_total = 0;
        @endphp
        @if (empty($data))
            <div class="empty-container">
                <img src="{{ url('/') }}/assets/images/empty-cart.webp" alt="empty cart image" height="50"
                    width="50" decoding="async" loading="lazy" />
                <h1>You don't have any items :&#40;</h1>
                <p>
                    Add a few items to your cart and come back here for an express
                    checkout process!
                </p>
                <a href="{{ route('categories') }}">Browse Category</a>
            </div>
        @else
            <section class="container">
                <div class="product">
                    <div class="steps-container">
                        <p>Steps:</p>

                        <div class="steps-count">
                            <div class="steps-ruler">
                                <div class="filler"></div>
                            </div>
                            <div class="step-box">
                                <span class="active-step"></span>
                                <p>Cart</p>
                            </div>
                            <div class="step-box">
                                <span></span>
                                <p>Address</p>
                            </div>
                            <div class="step-box">
                                <span></span>
                                <p>Confirm</p>
                            </div>
                        </div>
                    </div>
                    <div class="cart-item-heading">
                        <p>Your Cart ({{ count($data) }} Item) </p>
                    </div>

                    @foreach ($data as $product)
                        @php
                            $item = getProductDetail($product['product_id']);
                        @endphp
                        <span id="{{ $product['product_id'] }}">
                            <div class="cart-item-heading">
                                <p></p>
                                <img onclick="window.location.href='{{ route('cart.remove', ['id' => $product['product_id']]) }}'"
                                    src="{{ url('/') }}/assets/icons/trash.svg" height="20" width="20"
                                    alt="Trash Icons" id="{{ $product['product_id'] }}" class="trash-icons" />
                            </div>
                            <div class="cart-item-container">
                                <div class="product-container">
                                    <img src="{{ url("/uploads/products/{$item->thumb_img}") }}"
                                        alt="{{ $item->name }}" height="50" width="50" unoptimized priority />
                                    <div class="product-details">
                                        <div class="p-heading">
                                            <h1>{{ $item->name }}</h1>
                                        </div>
                                        <div class="details-holder">
                                            <div>
                                                <p class="date">
                                                    <img src="{{ url('/') }}/assets/icons/calendar-icon.svg"
                                                        alt="calendar icon" height="20" width="20" />&nbsp;
                                                    <span>{{ formateDate('d-M-Y', $product['date']) }}</span>
                                                </p>
                                                <p class="date">
                                                    <img src="{{ url('/') }}/assets/icons/clock-icon.svg"
                                                        alt="clock icon" height="20" width="20" />&nbsp;
                                                    <span>{{ $product['time'] }}</span>
                                                </p>

                                                <div class="price-holder">
                                                    <div class="priceproducts">
                                                        @php
                                                            $base_total += $item->discount_price * $product['quantity'];
                                                        @endphp
                                                        <p class="additions">₹{{ $item->discount_price }}</p>
                                                        <p class="before-price">₹{{ $item->price }}</p>
                                                        <p class="discount">({{ $item->discount_percentage }}%
                                                            OFF)</p>
                                                    </div>

                                                    <div class="ammount">
                                                        <p>Qty</p>
                                                        <select class="productquantity" name="productquantity"
                                                            id="productquantity"
                                                            data-cart-id="{{ $product['product_id'] }}">
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ $i == $product['quantity'] ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="addon-heading">

                                <p class="addon-txt">Add-Ons <span
                                        class="addon-count">{{ count($product['addon_ids']) }}</span></p>
                                <button class="add-modal-btn" id="{{ $product['product_id'] }}" onclick="viewAddon()">
                                    Add more item
                                    <span class="btn-icon">
                                        <img src="{{ url('/') }}/assets/icons/grey-plus.svg"
                                            alt="grey plus icon" height="20" width="20" />
                                    </span>
                                </button>
                            </div>

                            <div class="added-addon-container">
                                <div class="added-addon">

                                    @foreach ($product['addon_ids'] as $qua_id => $addon_id)
                                        @php
                                            $cart_addon = getAddonData($addon_id);
                                        @endphp
                                        @if ($cart_addon)
                                            <span id="{{ $cart_addon->id }}">
                                                <div class="added-product">
                                                    <img src="{{ url("uploads/addon/{$cart_addon->image}") }}"
                                                        alt="addon img" height="50" width="50" />
                                                    <div class="added-product-details">
                                                        <p>{{ $cart_addon->name }}</p>
                                                        @php
                                                            $addon_total +=
                                                                (int) $cart_addon->price *
                                                                (int) $product['addon_quantitys'][$qua_id];
                                                        @endphp
                                                        <div class="price">
                                                            ₹{{ number_format($cart_addon->price) }} X
                                                            {{ number_format((int) $product['addon_quantitys'][$qua_id]) }}
                                                            =
                                                            ₹{{ number_format((int) $cart_addon->price * (int) $product['addon_quantitys'][$qua_id]) }}
                                                        </div>
                                                        <div class="controller">
                                                            <p>Qty</p>
                                                            <select class="addonquantity" name="addonquantity"
                                                                id="addonquantity"
                                                                data-addon-id="{{ $cart_addon->id }}"
                                                                data-addon-price="{{ number_format($cart_addon->price) }}"
                                                                data-product-id="{{ $product['product_id'] }}">
                                                                @for ($i = 1; $i <= 30; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ $i == $product['addon_quantitys'][$qua_id] ? 'selected' : '' }}>
                                                                        {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <button class="delete-btn">
                                                            <img onclick="window.location.href='{{ route('delete-addon', ['index' => $qua_id, 'product_id' => $product['product_id']]) }}'"
                                                                src="{{ url('/') }}/assets/icons/trash.svg"
                                                                id="{{ $qua_id }}" class="trash-icon"
                                                                alt="trash icon" height="20" width="20" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </span>
                    @endforeach
                </div>
                <div class="payment">
                    <div class="price-details-container">
                        <h4>Price Details</h4>
                        <p>
                            <span>Base Total</span>
                            <span>
                                <b>₹ {{ $base_total }}</b>

                            </span>
                        </p>
                        <p>
                            <span>Add On Total

                            </span>
                            <span>
                                <b>₹ {{ $addon_total }}</b>
                            </span>
                        </p>
                        <p>
                            <span>
                                Convenience Charge
                            </span>
                            <span>
                                <b>₹ 0</b>
                            </span>

                        </p>
                        <p>
                            <span>Total Amount</span>
                            <span>
                                <b>₹ {{ $base_total + $addon_total }}</b>

                            </span>
                        </p>
                        {{-- <p>
                        <span class="coupon-text"><img src="{{ url('/') }}/assets/icons/discount-icon.webp"
                                alt="discount-icon" height="25" width="25" decoding="async"
                                loading="lazy" /> Coupon Discount <b>[APPLIED]</b></span>
                        <span>₹ 100</span>
                    </p> --}}
                        <p>
                            <span>
                                <b>Amount To Pay</b>
                            </span>
                            <span>
                                <b>₹ {{ $base_total + $addon_total }}</b>
                            </span>
                        </p>
                    </div>
                    <div class="proceed-to-buy">

                        @auth
                            <form action="{{ route('checkout') }}" method="post">
                                @csrf
                                @foreach ($data as $item)
                                    <input type="hidden" name="cart_id[]" value="{{ $item['product_id'] }}">
                                    <input type="hidden" name="product_quantity[]" value="{{ $item['quantity'] }}">
                                @endforeach
                                <button id="proceed-to-buy">Proceed To Buy</button>
                            </form>
                        @endauth
                        @guest
                            <button onclick="viewSignin()">Proceed To Buy</button>
                        @endguest
                    </div>
                    <div class="assurance-container">
                        <div class="assurance">
                            <img src="{{ url('/') }}/assets/icons/nohidden.webp" alt="no hidden charges"
                                height="30" width="30" />
                            <p>No Hidden Charges</p>
                        </div>
                        <div class="assurance">
                            <img src="{{ url('/') }}/assets/icons/smile.svg" alt="no hidden charges"
                                height="30" width="30" />
                            <p>5M+ Happy Clients</p>
                        </div>
                        <div class="assurance">
                            <img src="{{ url('/') }}/assets/icons/secure.svg" alt="no hidden charges"
                                height="30" width="30" />
                            <p>100% Secure</p>
                        </div>
                    </div>
                </div>
            </section>
            <div class="addon-modal">
                <div class="modal" onclick="viewAddon()"></div>
                <div class="addon-container">
                    <div class="heading-container">
                        <p class="addonn-heading">Add on something to make it special!</p>
                        <span class="close-addon" onclick="viewAddon()"> ✕ </span>
                        <input type="hidden" name="cart_id" id="cart_id" value="">
                    </div>
                    <div class="addon-categories">
                        <button id="popular-btn" class="active-addon">Popular</button>
                        <button id="general-btn">General</button>
                    </div>
                    <div class="addon-items">
                        {{-- Dynamic Items --}}
                    </div>
                </div>
            </div>
            {{-- <div class="instruction-modal">
                <div class="modal" onclick="viewInstructions()"></div>

                <div class="instruction-dialouge">
                    <div class="instruction-headings">
                        <div class="instruction-nested-heading">
                            <span class="instruction-image-holder">
                                <image src="{{ url('/') }}/assets/icons/red-info.svg" alt="info icon"
                                    height="25" width="25" class="info-icon" />
                            </span>
                            <div>
                                <p>Instructions</p>
                                <span>Write all the instructions down below</span>
                            </div>
                        </div>
                        <span class="close-icon" onclick="viewInstructions()">
                            <image src="{{ url('/') }}/assets/icons/close.svg" alt="close svg" height="25"
                                width="25" />
                        </span>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="instruction_cart_id" id="instruction_cart_id" value="" />
                        <textarea name="instruction_text" id="instruction_text" cols="30" rows="5"
                            placeholder="Type Instructions..."></textarea>
                    </form>
                    <div class="instruction-controllers">
                        <button class="instruction-cancle">Cancel</button>
                        <button class="instruction-save">Save</button>
                    </div>
                </div>
            </div> --}}

            <div class="sign-in-modal">
                <div class="modal" onclick="viewSignin()"></div>

                <div class="sign-in-dialogue">
                    <h2>Sign in</h2>
                    <p>
                        Enjoy the convenience of a single account across all participating
                        brands
                    </p>

                    <button class="close-signin" onclick="viewSignin()">
                        <img src="{{ url('/') }}/assets/icons/close.svg" alt="close icon" height="25"
                            width />
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
        @endif

    </main>

    <script src="{{ url('/') }}/assets/js/jquery-3.7.1.js"></script>
    <script defer src="{{ url('/') }}/assets/js/cart.js"></script>
    <script src="{{ url('/') }}/assets/js/toast.js"></script>
    <script src="{{ url('/') }}/assets/js/captcha.js"></script>

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
            // $('#step-address').hide();

            // $('#proceed-to-buy').click(function() {
            //     $('#step-cart').hide();
            //     $('header').hide();
            //     $('#step-address').show();
            // })


            $(document).on('change', '.productquantity', function() {
                var product_id = parseInt($(this).data('cart-id'));
                // alert(product_id);
                var product_quantity = parseInt($(this).val());
                // console.log(`Product Id:${product_id+ ", Product Quantity:" + product_quantity}`);

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id,
                        quantity: product_quantity
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response.message);
                        if (response.status === true) {
                            window.location.reload();
                        }
                    },

                    error: function(xhr, status, error) {
                        console.log("Error", xhr);
                    },
                });

            });

            $(document).on("change", ".addonquantity", function() {
                var addon_id = parseInt($(this).data('addon-id'));
                var product_id = parseInt($(this).data('product-id'));
                var addon_quantity = $(this).val();

                console.log(addon_id, product_id, addon_quantity);


                $.ajax({
                    url: "{{ route('addonquantity') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: product_id,
                        addon_id: addon_id,
                        quantity: addon_quantity
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response.message);
                        if (response.status === true) {
                            window.location.reload();
                        }
                    },

                    error: function(xhr, status, error) {
                        console.log("Error", xhr);
                    },
                });
            });

            // Cart
            $(".close-addon").click(function() {
                let addon_ids = "";
                let addon_quantitys = "";
                $(".add-addon-added").map(function() {
                    addon_ids += $(this).data("custom-value3") + ",";
                    addon_quantitys += $(this).data("custom-value2") + ",";
                });
                console.log(addon_ids);
                console.log(addon_quantitys);
                cart_id = $("#cart_id").val();


                addon_ids = addon_ids.replace(/,\s*$/, '');
                addon_quantitys = addon_quantitys.replace(/,\s*$/, '');

                console.log(cart_id);
                console.log(addon_ids);
                console.log(addon_quantitys);

                if (addon_ids != '' && addon_quantitys != '') {

                    $.ajax({
                        url: "{{ route('cart.update') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: cart_id,
                            addon_ids: addon_ids,
                            addon_quantitys: addon_quantitys
                        },
                        dataType: "JSON",
                        success: function(response) {
                            // console.log(response);
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr);
                        }
                    });
                }
            })


            $('#proceed-to-buy').click(function() {
                let products = [];

                // Loop through each product to collect IDs and quantities
                $('input[name="product_id[]"]').each(function(index) {
                    let product_id = parseInt($(this).val());
                    let product_quantity = parseInt($('input[name="product_quantity[]"]').eq(index)
                        .val());

                    products.push({
                        id: product_id,
                        quantity: product_quantity,
                    });
                });

                console.log(products); // For debugging, displays product data

                // Send data to the backend via AJAX
                $.ajax({
                    url: "{{ route('payment') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        products: products
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log("Success");

                    },
                    error: function(xhr, status, error) {
                        console.log("Error", xhr);
                    }
                });
            });


            function viewAddon() {
                var cartid = parseInt($("#cart_id").val());
                document.querySelector(".addon-modal").classList.toggle("block");
            }

            $(".add-modal-btn").click(function() {
                var cart_id = parseInt($(this).attr("id"));
                $("#cart_id").val(cart_id);
                console.log(cart_id);
                $.ajax({
                    url: "{{ route('set-addon') }}",
                    type: "GET",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: cart_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        $('.addon-items').html(res);
                        console.log(res);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        console.log(xhr);

                    }
                })
            });


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
