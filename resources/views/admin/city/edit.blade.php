@extends('admin.layout')
@push('title')
    <title>Edit City</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="row g-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Edit City</h6>
                    <div>
                        <a class="btn btn-outline-primary me-1" href="{{ route('city-create') }}">Create New City</a>
                        <a class="btn btn-outline-primary ms-1" href="{{ route('city-list') }}">All Cities</a>
                    </div>
                </div>
                <hr>

                <div class="col-12">
                    <div class="bg-secondary rounded h-100 px-4">
                        <div class="row g-4">
                            <form class="row" action="{{ route('city-update', ['id' => $data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $data->title) }}"
                                        class="form-control" id="title" placeholder="Enter title" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Active"
                                            {{ old('status', $data->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive"
                                            {{ old('status', $data->status) == 'Inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
    
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="city" class="form-label">City Name</label>
                                    <input type="text" name="city" value="{{ old('city', $data->city) }}"
                                        class="form-control" id="city" placeholder="Enter City Name" required>
                                </div>
    
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="city_slug" class="form-label">City Slug</label>
                                    <input type="text" name="city_slug"
                                        value="{{ old('city_slug', $data->city_slug) }}" class="form-control"
                                        id="city_slug" placeholder="Enter City Slug" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="image" class="form-label">City Image</label>
                                    <input type="file" name="image" id="image" class="form-control bg-transparent">
                                </div>
    
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="phone" class="form-label">City Phone</label>
                                    <input type="number" minlength="10" maxlength="10" name="phone" value="{{ old('phone', $data->phone) }}"
                                        class="form-control" id="phone" placeholder="Enter Phone Number" required>
                                </div>
    
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="is_popular" class="form-label">Popular City</label>
                                    <select name="is_popular" id="is_popular" class="form-select">
                                        <option value="" selected disabled>Select Choice</option>
                                        <option value="1"
                                            {{ old('is_popular', $data->is_popular) == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ old('is_popular', $data->is_popular) == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="is_menu" class="form-label">Show in Menu</label>
                                    <select name="is_menu" id="is_menu" class="form-select">
                                        <option value="" selected disabled>Select Choice</option>
                                        <option value="1"
                                            {{ old('is_menu', $data->is_menu) == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ old('is_menu', $data->is_menu) == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="map" class="form-label">City Map Link</label>
                                    <textarea name="map" cols="30" id="map" rows="4" class="form-control">{{ old('map', $data->map) }}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">City Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control editor">{!! old('description', $data->description) !!}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <textarea name="meta_keywords" id="meta_keywords" class="form-control">{!! old('meta_keywords', $data->meta_keywords) !!}</textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control">{!! old('meta_description', $data->meta_description) !!}</textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" id="submit" class="btn btn-primary w-25">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#city').keyup(function() {
                var city = $(this).val().trim();
                var city_slug = city.toLowerCase().replaceAll(' ', '-');
                $('#city_slug').val(city_slug);

                $.ajax({
                    url: "{{ route('check-city-slug') }}",
                    type: 'GET',
                    data: {
                        'city_slug': city_slug
                    },
                    dataType: 'JSON',

                    success: function(response, status) {
                        if (response.data) {
                            var count = Array.isArray(response.data) ? response.data.length :
                                Object.keys(response.data).length;

                            if (count > 1) {
                                alert("Error: More than one category found. Please choose a different slug.");

                                $('#city_slug').css('outline', '2px solid red');
                                $('#submit').prop('disabled', true);
                            } else {
                                $('#city_slug').css('outline', '2px solid green');
                                $('#submit').prop('disabled', false); 
                            }
                        } else {
                            $('#city_slug').css('outline', '2px solid green');
                            $('#submit').prop('disabled', false); 
                        }
                    },
                })
            })
        });
    </script>
@endsection
