@extends('admin.layout')
@push('title')
    <title>City List</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All City</h6>
                <a href="{{ route('city-create') }}">Add new City</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Sr. No.</th>
                            <th scope="col">City Name</th>
                            <th scope="col">City Image</th>
                            <th scope="col">City Phone</th>
                            <th scope="col" class="text-center">Popular</th>
                            <th scope="col" class="text-center">In Menu</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                <td>{{ $item->city }}</td>
                                <td><img src="{{ url("uploads/city/$item->image") }}" style="height:100px; width:100%"
                                        alt=""></td>
                                <td><a href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a></td>
                                <td class="text-center">{{ $item->is_popular ? 'Yes' : 'No' }}</td>
                                <td class="text-center">{{ $item->is_menu ? 'Yes' : 'No' }}</td>
                                <td class="text-center">{{ $item->status }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center py-3">
                                        <a class="btn btn-sm btn-warning me-1"
                                            href="{{ route('city-edit', ['id' => $item->id]) }}"><i
                                                class="bi bi-pencil-square"></i></a>

                                        <form action="{{ route('city-destroy', ['id' => $item->id]) }}" method="post" onsubmit="return window.confirm('Are you sure to Delete?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-primary ms-1">
                                                <i class="bi bi-trash"></i>
                                            </button>
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
