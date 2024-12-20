@extends('front-layout')
@push('title')
    <title>Orders</title>
@endpush
@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/category1.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/common10.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/order.css" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/css/bootstrap.min.css" />
@endsection

@section('slider')
    <div class="container">
        <div>
            <div class="menu-links">
                <a href="{{ route('user-dashboard') }}" class="active-nav">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 md:w-[22px] h-5 md:h-[22px]">
                        <path
                            d="M20.9001 10.9996C20.9001 5.52799 16.4723 1.09961 11.0001 1.09961C5.52848 1.09961 1.1001 5.52739 1.1001 10.9996C1.1001 16.4227 5.49087 20.8996 11.0001 20.8996C16.4867 20.8996 20.9001 16.4477 20.9001 10.9996ZM11.0001 2.25977C15.8193 2.25977 19.7399 6.18043 19.7399 10.9996C19.7399 12.7625 19.2156 14.457 18.2432 15.8922C14.3386 11.6921 7.66873 11.6845 3.75698 15.8922C2.78459 14.457 2.26025 12.7625 2.26025 10.9996C2.26025 6.18043 6.18092 2.25977 11.0001 2.25977ZM4.48056 16.8197C7.95227 12.9256 14.0488 12.9266 17.5195 16.8197C14.0361 20.7168 7.96541 20.718 4.48056 16.8197Z"
                            fill="#8C969F" stroke="#8C969F" stroke-width="0.2"></path>
                        <path
                            d="M11 11.5801C12.9191 11.5801 14.4805 10.0187 14.4805 8.09961V6.93945C14.4805 5.02036 12.9191 3.45898 11 3.45898C9.08091 3.45898 7.51953 5.02036 7.51953 6.93945V8.09961C7.51953 10.0187 9.08091 11.5801 11 11.5801ZM8.67969 6.93945C8.67969 5.65996 9.7205 4.61914 11 4.61914C12.2795 4.61914 13.3203 5.65996 13.3203 6.93945V8.09961C13.3203 9.3791 12.2795 10.4199 11 10.4199C9.7205 10.4199 8.67969 9.3791 8.67969 8.09961V6.93945Z"
                            fill="#8C969F" stroke="#8C969F" stroke-width="0.2"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('user-orders') }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 md:w-[22px] h-5 md:h-[22px]">
                        <g clip-path="url(#clip0)">
                            <path
                                d="M19.8001 19.0172L18.5403 4.8319C18.5133 4.51697 18.2479 4.27853 17.9375 4.27853H15.3461C15.3101 1.91207 13.3755 0 11.0001 0C8.6246 0 6.69003 1.91207 6.65404 4.27853H4.06263C3.7477 4.27853 3.48676 4.51697 3.45977 4.8319L2.20006 19.0172C2.20006 19.0352 2.19556 19.0532 2.19556 19.0712C2.19556 20.6863 3.67572 22 5.49781 22H16.5023C18.3244 22 19.8046 20.6863 19.8046 19.0712C19.8046 19.0532 19.8046 19.0352 19.8001 19.0172ZM11.0001 1.21472C12.7052 1.21472 14.0954 2.58241 14.1313 4.27853H7.86877C7.90476 2.58241 9.29494 1.21472 11.0001 1.21472ZM16.5023 20.7853H5.49781C4.35507 20.7853 3.42828 20.0294 3.41028 19.0982L4.61601 5.49775H6.64954V7.34233C6.64954 7.67975 6.91948 7.94969 7.25691 7.94969C7.59433 7.94969 7.86427 7.67975 7.86427 7.34233V5.49775H14.1313V7.34233C14.1313 7.67975 14.4013 7.94969 14.7387 7.94969C15.0761 7.94969 15.3461 7.67975 15.3461 7.34233V5.49775H17.3796L18.5898 19.0982C18.5718 20.0294 17.6405 20.7853 16.5023 20.7853Z"
                                fill="#8C969F" stroke="#8C969F" stroke-width="0.1"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="22" height="22" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    Orders
                </a>
                <a href="{{ route('user-change-passowrd') }}">
                    <svg stroke="#BCBEC3" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                        class="w-5 md:w-[22px] h-5 md:h-[22px] text-[#8C969F]" height="22" width="22">
                        <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                            d="M262.29 192.31a64 64 0 1 0 57.4 57.4 64.13 64.13 0 0 0-57.4-57.4zM416.39 256a154.34 154.34 0 0 1-1.53 20.79l45.21 35.46a10.81 10.81 0 0 1 2.45 13.75l-42.77 74a10.81 10.81 0 0 1-13.14 4.59l-44.9-18.08a16.11 16.11 0 0 0-15.17 1.75A164.48 164.48 0 0 1 325 400.8a15.94 15.94 0 0 0-8.82 12.14l-6.73 47.89a11.08 11.08 0 0 1-10.68 9.17h-85.54a11.11 11.11 0 0 1-10.69-8.87l-6.72-47.82a16.07 16.07 0 0 0-9-12.22 155.3 155.3 0 0 1-21.46-12.57 16 16 0 0 0-15.11-1.71l-44.89 18.07a10.81 10.81 0 0 1-13.14-4.58l-42.77-74a10.8 10.8 0 0 1 2.45-13.75l38.21-30a16.05 16.05 0 0 0 6-14.08c-.36-4.17-.58-8.33-.58-12.5s.21-8.27.58-12.35a16 16 0 0 0-6.07-13.94l-38.19-30A10.81 10.81 0 0 1 49.48 186l42.77-74a10.81 10.81 0 0 1 13.14-4.59l44.9 18.08a16.11 16.11 0 0 0 15.17-1.75A164.48 164.48 0 0 1 187 111.2a15.94 15.94 0 0 0 8.82-12.14l6.73-47.89A11.08 11.08 0 0 1 213.23 42h85.54a11.11 11.11 0 0 1 10.69 8.87l6.72 47.82a16.07 16.07 0 0 0 9 12.22 155.3 155.3 0 0 1 21.46 12.57 16 16 0 0 0 15.11 1.71l44.89-18.07a10.81 10.81 0 0 1 13.14 4.58l42.77 74a10.8 10.8 0 0 1-2.45 13.75l-38.21 30a16.05 16.05 0 0 0-6.05 14.08c.33 4.14.55 8.3.55 12.47z">
                        </path>
                    </svg>
                    Change Password
                </a>
            </div>
        </div>
        <div class="tabel-details">
            <div class="table-heading">
                <h1>My order list</h1>
                <form action="" method="post">
                    <input type="text" placeholder="Search order list" id="searchOrderInput" onkeyup="filterOrders()" />
                </form>
            </div>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table text-start text-nowrap align-middle table-bordered table-hover mb-0 fs-4">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">Customer Detail</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Decoration Date/Decoration Time</th>
                                <th scope="col">Addon Products</th>
                                <th scope="col">Address</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Order Date/Time</th>
                                <th scope="col">Write Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $item)
                                <tr>
                                    <th>{{ ++$key }}</th>
                                    <th>
                                        <span class="d-block"><b>{{ $item->name }}</b></span>
                                        <span class="d-block"><a
                                                href="mailto:{{ $item->email }}">{{ $item->email }}</a></span>
                                        <span class="d-block"><a
                                                href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a></span>
                                    </th>
                                    <td><img src="{{ url('/uploads/products/' .$item->product->thumb_img) }}" alt="" height="100" width="100"></td>
                                    <td>
                                        <span class="d-block">{{ $item->product->name }}</span>
                                        <span class="d-block">Price : {{ $item->product->discount_price }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block">Date:<b class="text-danger">{{ $item->date }}</b></span>
                                        <span class="d-block">Time:<b class="text-danger">{{ $item->time }}</b></span>
                                    </td>
                                    <td>
                                        @if (!empty($item->addon_id))
                                            <table class="table table-borderd">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No</th>
                                                        <th>Name</th>
                                                        <th>Image</th>
                                                        <th>Quantity / Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item->addon_id as $sr => $addon)
                                                        @php
                                                            $addondata = getAddonItem($addon);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $sr + 1 }}</td>
                                                            <td>{{ $addondata->name }}</td>
                                                            <td><img src="{{ url('/uploads/addon/' . $addondata->image) }}"
                                                                    alt="" height="80" width="80"></td>
                                                            <td>{{ $item->addon_quantity[$sr] . ' / ' . $item->addon_price[$sr] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-block">City:<b class="text-danger">{{ $item->city }}</b></span>
                                        <span class="d-block">State:<b class="text-danger">{{ $item->user->state }}</b></span>
                                        <span class="d-block">Pincode:<b class="text-danger">{{ $item->pincode }}</b></span>
                                        <span class="d-block">Address:
                                            <b class="text-danger">
                                                {{ $item->current_address }}
                                            </b>
                                        </span>
                                        <span class="d-block">Landmark:
                                            <b class="text-danger">
                                                {{ $item->landmark }}
                                            </b>
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($item->payment_status) }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ formateDate('d-M-Y h:i A', $item->updated_at) }}</td>
                                    <td>
                                        <form action="{{ route('user-review-add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->product->id }}">
                                            <button class="btn btn-primary" type="submit">Write a Review</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
