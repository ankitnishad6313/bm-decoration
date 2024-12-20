<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/checkout.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/css/toast.css">
</head>

<body>
    <header class="header">
        <div class="navbar">
            <a href="{{ url()->previous() ?? route('home') }}" class="checkout-text">
                <img src="{{ url('/') }}/assets/icons/back-icon.svg" alt="back icon" height="25"
                    width="25" />
                Address <span>(2 / 3)</span>
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
    <main>
        <form method="post" class="container" action="{{ route('payment') }}">
            @csrf
            <div class="input-fields">
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
                            <span class="active-step"></span>
                            <p>Address</p>
                        </div>
                        <div class="step-box">
                            <span></span>
                            <p>Payment</p>
                        </div>
                    </div>
                </div>
                <div class="checkout-fields">
                    <h2>Checkout</h2>
                    {{-- <p>Note: Coupon Code Not Applicable for 50% Advance Payment</p> --}}

                    <div class="input_wrapper">
                        <label for="username">Name <span>*</span></label>
                        <input type="text" placeholder="Enter name" required id="username" name="name"
                            value="{{ old('name', auth()->user()->name) }}" />
                    </div>
                    <div class="input_wrapper">
                        <label for="email_id">Email <span>*</span></label>
                        <input type="text" placeholder="Enter email" required id="email_id" name="email"
                            value="{{ old('email', auth()->user()->email) }}" />

                    </div>
                    <div class="input_wrapper">
                        <label for="address">Address <span>*</span></label>
                        <textarea name="current_address" id="address" cols="30" rows="5" placeholder="Enter address" required>{{ old('current_address', auth()->user()->current_address) }}</textarea>
                    </div>
                    <div class="input_wrapper">
                        <label for="land_mark">Land Mark(If any)</label>
                        <input type="text" placeholder="Enter landmark" id="land_mark" name="landmark"
                            value="{{ old('landmark', auth()->user()->landmark) }}" />

                    </div>
                    <div class="input_wrapper">
                        <label for="pincode">Pincode <span>*</span></label>
                        <input type="tel" placeholder="Enter pincode" required id="pincode" maxlength="6"
                            name="pincode" value="{{ old('pincode', auth()->user()->pincode) }}" />
                    </div>
                    <div class="input_wrapper">
                        <label for="city">City <span>*</span></label>
                        <input type="text" placeholder="Enter city name" required id="city" name="city"
                            value="{{ old('city', auth()->user()->city) }}" />

                    </div>
                    <div class="other-details">
                        <div class="input_wrapper">
                            <label for="occasion">Occasion <span>*</span></label>
                            <select name="occasion" id="occasion" required>
                                <option value="" disabled selected>Select Decoration Type</option>
                                <option value="Birthday">Birthday</option>
                                <option value="Anniversary">Anniversary</option>
                                <option value="Baby Shower">Baby Shower</option>
                                <option value="Welcome">Welcome</option>
                                <option value="Bachelorette Party">Bachelorette Party</option>
                                <option value="Wedding Night">Wedding Night</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="input_wrapper">
                            <label for="location">Location <span>*</span></label>
                            <select name="location" id="location" required>
                                <option value="" disabled selected>Select Decoration Location</option>
                                <option value="Home">Home</option>
                                <option value="Building">Building</option>
                                <option value="Banquet Hall">Banquet Hall</option>
                                <option value="Outdoor Garden">Outdoor Garden</option>
                                <option value="Terrace">Terrace</option>
                                <option value="Hotel Rooms">Hotel Rooms</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="input_wrapper">
                            <label for="mobile_number">Mobile Number <span>*</span></label>
                            <input type="tel" placeholder="Enter mobile number" required id="mobile_number"
                                maxlength="10" name="phone" value="{{ old('phone', auth()->user()->phone) }}" />

                        </div>
                        <div class="input_wrapper">
                            <label for="alternative_number">Alternative Number(If Any)</label>
                            <input type="tel" placeholder="Enter alternative number" id="alternative_number"
                                maxlength="10" name="alternate_phone"
                                value="{{ old('alternate_phone', auth()->user()->alternate_phone) }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-payment">

                <div class="order-details">
                    <a href="{{ route('cart') }}" class="goto-cart"><img
                            src="{{ url('/') }}/assets/icons/back-icon.svg" alt="back icon" height="25"
                            width="25">Go To Cart</a>
                    <h2>
                        Order Details
                        <img src="{{ url('/') }}/assets/icons/order-details-icon.svg" alt="Order details icon"
                            height="25" width="25" />
                    </h2>
                    @php
                        $base_total = 0;
                        $addon_total = 0;
                    @endphp

                    @foreach ($finaldata as $item)
                        @php
                            $product = getProductDetail($item['product_id']);
                        @endphp
                        <div class="all-details">
                            <div class="img-holder">
                                <img src="{{ url("/uploads/products/$product->thumb_img") }}"
                                    alt="product small image" height="70" width="70" />
                            </div>
                            <div class="list-details">
                                <h4>{{ $product->name }}</h4>
                                <p>
                                    <img src="{{ url('/') }}/assets/icons/calendar-icon.svg" alt="calendar icon"
                                        height="20" width="20" />&nbsp; {{ $item['date'] }}
                                </p>
                                <p>
                                    <img src="{{ url('/') }}/assets/icons/clock-icon.svg" alt="clock icon"
                                        height="20" width="20" />&nbsp; {{ $item['time'] }}
                                </p>
                                <p>
                                    @php
                                        $base_total += $item['product_price'] * $item['product_quantity'];
                                    @endphp

                                    @foreach ($item['addon_id'] as $qua_id => $addon_id)
                                        @php
                                            
                                            $cart_addon = getAddonData($addon_id);
                                        @endphp
                                        @if ($cart_addon)
                                            @php
                                                $addon_total +=
                                                    (int) $cart_addon->price *
                                                    (int) $item['addon_quantity'][$qua_id];
                                            @endphp
                                        @endif
                                    @endforeach
                                    <img src="{{ url('/') }}/assets/icons/credit-card.svg" alt="credit card"
                                        height="20" width="20" />&nbsp;
                                    Package Amount: ₹
                                    <span id="total_ammount1">
                                        {{ $item['product_price'] * $item['product_quantity'] + $addon_total }}
                                    </span>

                                    
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <div class="payment-controller-wrapper">

                        <button type="submit" name="submit" value="add" class="prePayBtn">Proceed to Pay |
                            ₹<span id="total_ammount">{{ $base_total + $addon_total }}</span>
                        </button>
                        <p>
                            100% Safe & Secure Payments
                            <img src="{{ url('/') }}/assets/icons/verified-payment.webp" alt="verified payments"
                                height="15" width="15" />
                        </p>
                    </div>
                </div>
                <div class="payment-details">
                    <h2>Price Details</h2>
                    <p><span>Base Total</span> <b>₹ <span id="base_total_price">{{ $base_total }}</span> </b></p>
                    <p><span>Add On Total</span> <b>₹ <span id="addon_total_price">{{ $addon_total }}</span></b></p>
                    <p>
                        <span>Convenience Charge</span>
                        <b>₹ <span id="convenience_charge_price">0</span></b>
                    </p>
                    <p><span>Total Amount</span> <b>₹ <span
                                id="total_ammount2">{{ $base_total + $addon_total }}</span></b></p>

                    <p class="nocoupondiscount2"><b>Amount To Pay</b> <b>₹ <span
                                id="total_ammount3">{{ $base_total + $addon_total }}</span></b>
                    </p>
                    <p class="amountdueclass" style="display:none;color:red;"><b>Amount Due</b> <b>₹ <span
                                id="amountdue">{{ $base_total + $addon_total }}</span></b></p>
                </div>
            </div>
        </form>
    </main>
    <script src="{{ url('/') }}/assets/js/jquery-3.7.1.js"></script>
    <script src="{{ url('/') }}/assets/js/toast.js"></script>
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
</body>

</html>
