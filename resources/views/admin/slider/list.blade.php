@extends('admin.layout')
@push('title')
    <title>Slider</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">All Slider</h6>
                <a href="#" data-bs-toggle="modal" data-bs-target="#add-slider">Add new Slider</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Sr. No.</th>
                            <th scope="col">Image</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $data->firstItem() + $key }}</td>
                                <td><img src="{{ url("uploads/slider/$item->image") }}" style="height:100px; width:100%"
                                        alt=""></td>
                                <td class="text-center">{{ $item->status }}</td>
                                <td class="text-center">
                                    {{-- <a class="btn btn-sm btn-warning me-1" href="#" data-id="{{ $item->id }}"><i
                                            class="bi bi-pencil-square"></i></a> --}}
                                    <form action="{{ route('slider-destroy', ['id' => $item->id]) }}" method="post"
                                        class="d-inline-block" onsubmit="return window.confirm('Are you sure to Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-primary ms-1">
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

    <!-- Add Modal -->
    <div class="modal fade" id="add-slider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="add-sliderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h1 class="modal-title fs-5" id="add-sliderLabel">Add Slider</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-secondary">
                    <form action="{{ route('slider-store') }}" method="POST" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-3">
                            <label for="image">Upload Slider</label>
                            <input type="file" name="image" id="image" class="form-control bg-transparent"
                                required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="" selected disabled>Select Status</option>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                        <div class="col-12 mb-3 text-center">
                            <button class="btn btn-outline-primary w-25">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--End -->

    <!-- Edit Modal -->
    <!-- End -->
@endsection

@section('script')
@endsection
