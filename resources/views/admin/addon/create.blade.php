@extends('admin.layout')
@push('title')
    <title>Add Addon Product</title>
@endpush
@section('main-section')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="row g-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="mb-0">Add Addon Product</h6>
                <div>
                    <a class="btn btn-outline-primary ms-1" href="{{ route('addon-list') }}">All Addon Product</a>
                </div>
            </div>
            <hr>

            <div class="col-12">
                <div class="bg-secondary rounded h-100 px-4">
                    <div class="row g-4">
                        <form class="row" action="{{ route('addon-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control bg-dark" id="image">
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control" id="name" placeholder="Enter Name" required>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" value="{{ old('price') }}"
                                    class="form-control" id="price" placeholder="Enter Price" required>
                            </div>
                            
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="is_popular" class="form-label">Popular Addon Product</label>
                                <select name="is_popular" id="is_popular" class="form-select">
                                    <option value="" selected disabled>Select Choice</option>
                                    <option value="1"
                                        {{ old('is_popular') == '1' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0"
                                        {{ old('is_popular') == '0' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary w-25">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
