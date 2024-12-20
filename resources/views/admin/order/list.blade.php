@extends('admin.layout')
@push('title')
    <title>Orders List</title>
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
                            <th scope="col">Total</th>
                            <th scope="col">Order Date/Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th>{{ ++$key }}</th>
                                <th>
                                    <p><b>{{ $item->name }}</b></p>
                                    <p><a
                                            href="mailto:{{ $item->email }}">{{ $item->email }}</a></p>
                                    <p><a
                                            href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a></p>
                                </th>
                                <td><img src="{{ url('/uploads/products/' .$item->product->thumb_img) }}" alt="" height="100" width="100"></td>
                                <td>
                                    <p>{{ $item->product->name }}</p>
                                    <p>Price : ₹ {{ $item->product->discount_price }}</p>
                                </td>
                                <td>
                                    <p>Date: <b class="text-danger">{{ formateDate('d-F-Y',$item->date) }}</b></p>
                                    <p>Time: <b class="text-danger">{{ $item->time }}</b></p>
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
                                    <p>City: <b class="text-danger">{{ $item->city }}</b></p>
                                    <p>State: <b class="text-danger">{{ $item->user->state }}</b></p>
                                    <p>Pincode: <b class="text-danger">{{ $item->pincode }}</b></p>
                                    <p>Address:
                                        <b class="text-danger">
                                            {{ $item->current_address }}
                                        </b>
                                    </p>
                                    <p>Landmark:
                                        <b class="text-danger">
                                            {{ $item->landmark }}
                                        </b>
                                    </p>
                                </td>
                                <td>₹ {{ $item->total_amount }}</td>
                                <td>{{ formateDate('d-M-Y h:i A', $item->updated_at) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center py-3">
                                        
                                        {{-- <a class="btn btn-sm btn-success me-1"
                                            href="{{ route('product-view', ['id' => $item->id]) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a> --}}
                                        <form action="{{ route('admin-order-delete', ['id' => $item->id]) }}" method="post" onsubmit="return window.confirm('Are you sure to Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-primary ms-1"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
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

@section('script')
@endsection
