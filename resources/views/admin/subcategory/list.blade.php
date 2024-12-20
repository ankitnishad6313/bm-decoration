@extends('admin.layout')
@push('title')
    <title>Sub Category List</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Sub Category</h6>
                <a href="{{ route('sub-category-create') }}">Add new Sub Category</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Sr. No.</th>
                            <th scope="col">Sub Category Name</th>
                            <th scope="col" class="text-center">Category Name</th>
                            <th scope="col" class="text-center">Total Products</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                <td>{{ $item->sub_cat_name }}</td>
                                <td class="text-center">{{ $item->category->cat_name }}</td>
                                <td class="text-center">{{ $item->products->count() }}</td>
                                <td class="text-center">{{ $item->status }}</td>
                                <td class="d-flex justify-content-center align-items-center py-3">
                                    <a class="btn btn-sm btn-warning me-1"
                                        href="{{ route('sub-category-edit', ['id' => $item->id]) }}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('sub-category-destroy', ['id' => $item->id]) }}" method="post" onsubmit="return window.confirm('Are you sure to Delete? This will delete all releted data like Products, Orders.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-primary ms-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
