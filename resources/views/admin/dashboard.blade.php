@extends('admin.layout')
@push('title')
    <title>Admin Dashboard</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin-users') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Users</p>
                            <h6 class="mb-0">{{ $data['user'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin-users') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today's User</p>
                            <h6 class="mb-0">{{ $data['today_user'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin-contacts') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-envelope fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Contacts</p>
                            <h6 class="mb-0">{{ $data['contact'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin-contacts') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-envelope fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today's Contacts</p>
                            <h6 class="mb-0">{{ $data['today_contact'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('category-list') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-list fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Category</p>
                            <h6 class="mb-0">{{ $data['category'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('category-list') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-list fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Active Category</p>
                            <h6 class="mb-0">{{ $data['active_category'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('product-list') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-layer-group fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Products</p>
                            <h6 class="mb-0">{{ $data['product'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('product-list') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-layer-group fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Active Products</p>
                            <h6 class="mb-0">{{ $data['active_product'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin-orders') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-list fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Orders</p>
                            <h6 class="mb-0">{{ $data['order'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('admin-orders') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-list fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today's Orders</p>
                            <h6 class="mb-0">{{ $data['today_order'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('city-list') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-map-marker-alt fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Cities</p>
                            <h6 class="mb-0">{{ $data['city'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ route('review-list') }}">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-star fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Reviews</p>
                            <h6 class="mb-0">{{ $data['review'] }}</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Orders</h6>
                <a href="{{ route('admin-orders') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start text-nowrap align-middle table-bordered table-hover mb-0">
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['recent_orders'] as $key => $item)
                            <tr>
                                <th>{{ ++$key }}</th>
                                <th>
                                    <span class="d-block"><b>{{ $item->name }}</b></span>
                                    <span class="d-block"><a
                                            href="mailto:{{ $item->email }}">{{ $item->email }}</a></span>
                                    <span class="d-block"><a
                                            href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a></span>
                                </th>
                                <td><img src="{{ url('/uploads/products/' .optional($item->product)->thumb_img) }}" alt="" height="100" width="100"></td>
                                <td>
                                    <span class="d-block">{{ optional($item->product)->name }}</span>
                                    <span class="d-block">Price : {{ optional($item->product)->discount_price }}</span>
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
                                                                alt=""></td>
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
                                            {{ $item->current_address }}
                                        </b>
                                    </span>
                                </td>
                                <td>{{ ucfirst($item->payment_status) }}</td>
                                <td>{{ $item->total_amount }}</td>
                                <td>{{ formateDate('d-M-Y h:i A', $item->updated_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Contacts</h6>
                        <a href="{{ route('admin-contacts') }}">Show All</a>
                    </div>
                    @foreach ($data['recent_contacts'] as $item)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <div>
                                        <h5 class="mb-0">{{ $item->first_name . ' ' . $item->last_name }}</h5>
                                        <a href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a>
                                    </div>
                                    <small>{{ getTimeDifference($item->created_at) }}</small>
                                </div>
                                <span>{{ $item->message }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-4">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calender</h6>
                        <a href="#">Show All</a>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
