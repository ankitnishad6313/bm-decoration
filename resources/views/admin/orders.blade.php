@extends('admin.layout')
@push('title')
    <title>All Orders</title>
@endpush
@section('main-section')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">All Orders</h6>
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
                    @foreach ($data as $key => $item)
                        <tr>
                            <th>{{ ++$key }}</th>
                            <th>
                                <span class="d-block"><b>{{ $item->user->name }}</b></span>
                                <span class="d-block"><a
                                        href="mailto:{{ $item->user->email }}">{{ $item->user->email }}</a></span>
                                <span class="d-block"><a
                                        href="tel:+91 {{ $item->user->phone }}">{{ $item->user->phone }}</a></span>
                            </th>
                            <td><img src="{{ url('/uploads/products/' .$item->product->thumb_img) }}" alt="" height="100" width="100"></td>
                            <td>
                                <span class="d-block">{{ $item->product->name }}</span>
                                <span class="d-block">Price : ₹ {{ $item->product->discount_price }}</span>
                            </td>
                            <td>
                                <span class="d-block">Date: <b class="text-danger">{{ formateDate('d-F-Y',$item->date) }}</b></span>
                                <span class="d-block">Time: <b class="text-danger">{{ $item->time }}</b></span>
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
                                                    <td>{{ $item->addon_quantity[$sr] . ' / ₹ ' . $item->addon_price[$sr] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </td>
                            <td>
                                <span class="d-block">City: <b class="text-danger">{{ $item->user->city }}</b></span>
                                <span class="d-block">State: <b class="text-danger">{{ $item->user->state }}</b></span>
                                <span class="d-block">Pincode: <b class="text-danger">{{ $item->user->pincode }}</b></span>
                                <span class="d-block">Address:
                                    <b class="text-danger">
                                        {{ $item->other_address ?? $item->user->current_address }}
                                    </b>
                                </span>
                            </td>
                            <td>{{ ucfirst($item->payment_status) }}</td>
                            <td>₹ {{ $item->total_amount }}</td>
                            <td>{{ formateDate('d-M-Y h:i A', $item->updated_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-3">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
