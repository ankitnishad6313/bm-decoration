@extends('admin.layout')
@push('title')
    <title>Reviews</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Reviews</h6>
                <a href="{{ route('review-create') }}" class="btn btn-outline-primary">Add Review</a>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">User Detail</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name / Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $data->firstItem() + $key }}</td>
                                <td><img src="{{ url("/uploads/profile/". $item->user->profile_pic) }}" alt="User Image"
                                        class="img-fluid"></td>
                                <td>
                                    <span class="d-block">Name : <b>{{ $item->user->name }}</b></span>
                                    <span class="d-block">Email : <a
                                            href="mailto:{{ $item->user->email }}">{{ $item->user->email }}</a></span>
                                    <span class="d-block">Phone : <a
                                            href="tel:+91 {{ $item->user->phone }}">{{ $item->user->phone }}</a></span>
                                    <span class="d-block">Alternate Phone : <a
                                            href="tel:+91 {{ $item->user->alternate_phone }}">{{ $item->user->alternate_phone }}</a></span>
                                    <span class="d-block">Gender : {{ $item->user->gender }}</span>
                                </td>
                                <td><img src="{{ url("/uploads/products/". $item->product->thumb_img) }}" alt="Product Image"
                                    class="img-fluid"></td>
                                <td>
                                    <span class="d-block">Product Name : <b>{{ $item->product->name }}</b></span>
                                    <span class="d-block">Rating : <b>{{ $item->star }}</b></span>
                                    
                                </td>
                                <td>
                                    {{ $item->comment }}
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center py-3">
                                        <a class="btn btn-sm btn-warning me-1"
                                            href="{{ route('review-edit', ['id' => $item->id]) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('review-destroy', ['id' => $item->id]) }}" method="post" onsubmit="return window.confirm('Are you sure to Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-primary ms-1"><i
                                                    class="bi bi-trash"></i></button>
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
