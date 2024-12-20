@extends('admin.layout')
@push('title')
    <title>User List</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Users</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Image</th>
                            <th scope="col">User Detail</th>
                            <th scope="col">Address 1</th>
                            <th scope="col">Address 2 </th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $data->firstItem() + $key }}</td>
                                <td><img src="{{ url("/uploads/profile/$item->profile_pic") }}" alt="Product Image"
                                        class="img-fluid"></td>
                                <td>
                                    <span class="d-block">Name : <b>{{ $item->name }}</b></span>
                                    <span class="d-block">Email : <a
                                            href="mailto:{{ $item->email }}">{{ $item->email }}</a></span>
                                    <span class="d-block">Phone : <a
                                            href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a></span>
                                    <span class="d-block">Alternate Phone : <a
                                            href="tel:+91 {{ $item->alternate_phone }}">{{ $item->alternate_phone }}</a></span>
                                    <span class="d-block">Gender : {{ $item->gender }}</span>
                                </td>
                                <td>
                                    <span class="d-block">City : <b>{{ $item->city }}</b></span>
                                    <span class="d-block">State : <b>{{ $item->state }}</b></span>
                                    <span class="d-block">Pincode : <b>{{ $item->pincode }}</b></span>
                                    <span class="d-block">Country : <b>{{ $item->country }}</b></span>
                                </td>
                                <td>
                                    <span class="d-block">Current Address : <b>{{ $item->current_address }}</b></span>
                                    <span class="d-block">Permanent Address : <b>{{ $item->permanent_address }}</b></span>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center align-items-center py-3">

                                        {{-- <a class="btn btn-sm btn-warning me-1"
                                            href="#"><i
                                                class="bi bi-pencil-square"></i></a> --}}
                                        <form action="{{ route('admin-user-delete', ['id' => $item->id]) }}" method="post" onsubmit="return window.confirm('Are you sure to Delete? This will delete all releted Orders.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-primary ms-1" ><i
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
