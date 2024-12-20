@extends('admin.layout')
@push('title')
    <title>Product List</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Product</h6>
                <a href="{{ route('product-create') }}" class="btn btn-outline-primary">Add new Product</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Sr. No.</th>
                            <th scope="col" class="text-center">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Category</th>
                            <th scope="col" class="text-center">Sub Categories</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                <td class="text-center"><img src="{{ url("/uploads/products/$item->thumb_img") }}"
                                        alt="Product Image" class="img-fluid"></td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->category->cat_name }}</td>
                                <td class="text-center">{{ $item->subCategory->sub_cat_name ?? '--------------' }}</td>
                                <td class="text-center">{{ $item->price }}</td>
                                <td class="text-center">{{ $item->status }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center py-3">
                                        <a class="btn btn-sm btn-warning me-1"
                                            href="{{ route('product-edit', ['id' => $item->id]) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a class="btn btn-sm btn-success me-1"
                                            href="{{ route('product-view', ['id' => $item->id]) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <form action="{{ route('product-destroy', ['id' => $item->id]) }}" method="post" onsubmit="return window.confirm('Are you sure to Delete? This will delete all releted Orders.')">
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
