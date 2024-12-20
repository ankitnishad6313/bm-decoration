@extends('admin.layout')
@push('title')
    <title>{{ $data->name }}</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4">
        <div class="bg-secondary rounded p-2">
            <div class="row g-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Product Detail</h6>
                </div>
                <hr>
                <div class="col-sm-12 col-xl-5">
                    <div class="card bg-secondary rounded">
                        <div class="card-body text-center border-0">
                            <img src="{{ url('/uploads/products/' . $data->thumb_img) }}" class="img-fluid mx-auto"
                                style="width: 200px; height: 200px;">
                            <h4 class="mb-1">({{ $data->name }})</h4>
                            <p class="fw-bold"><strike>₹ {{ $data->price }}</strike> ₹ {{ $data->discount_price }}</p>
                            <p class="fw-bold">{{ $data->discount_percentage }} % OFF</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-7">
                    <div class="bg-secondary rounded p-4">
                        <div class="card border-0">
                            <p>Category Name: {{ $data->category->cat_name }}</p>
                            <p>Sub Category Name: {{ $data->subcategory->sub_cat_name ?? '------' }}</p>
                            <p>Rating: {{ number_format($data->reviews->avg('star'), 1) ?? '------' }}</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Inclusion</th>
                                        <th>Exclusion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <ul>
                                                @foreach ($data->inclusion as $item)
                                                    <li>
                                                        {{ $item }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($data->exclusion as $item)
                                                    <li>
                                                        {{ $item }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
