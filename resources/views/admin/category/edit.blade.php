@extends('admin.layout')
@push('title')
    <title>Edit Category</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="row g-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Edit Category</h6>
                    <div>
                        <a class="btn btn-outline-primary me-1" href="{{ route('category-create') }}">Create New Categoies</a>
                        <a class="btn btn-outline-primary ms-1" href="{{ route('category-list') }}">All Categoies</a>
                    </div>
                </div>
                <hr>

                <div class="col-12">
                    <div class="bg-secondary rounded h-100 px-4">
                        <div class="row g-4">
                            <form class="row" action="{{ route('category-update', ['id' => $data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $data->title) }}"
                                        class="form-control" id="title" placeholder="Enter title" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="cat_image" class="form-label">Category Image <small style="font-size: 10px">(Max Height:200, Max Width:200, Max Size:512KB)</small></label>
                                    <input type="file" name="cat_image" class="form-control bg-dark" id="cat_image" accept="image/jpeg,image/png,image/jpg,image/webp">
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="cat_name" class="form-label">Category Name</label>
                                    <input type="text" name="cat_name" value="{{ old('cat_name', $data->cat_name) }}"
                                        class="form-control" id="cat_name" placeholder="Enter Category Name" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="category_slug" class="form-label">Category Slug</label>
                                    <input type="text" name="category_slug"
                                        value="{{ old('category_slug', $data->category_slug) }}" class="form-control"
                                        id="category_slug" placeholder="Enter Category Slug" required>
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
                                    <label for="is_trending" class="form-label">Trending Category</label>
                                    <select name="is_trending" id="is_trending" class="form-select">
                                        <option value="" selected disabled>Select Choice</option>
                                        <option value="1"
                                            {{ old('is_trending', $data->is_trending) == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ old('is_trending', $data->is_trending) == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="is_popular" class="form-label">Popular Category</label>
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
                                    <label for="description" class="form-label">Category Description</label>
                                    <textarea name="description" id="description" class="form-control editor">{{ old('description', $data->description) }}</textarea>
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
            $('#cat_name').keyup(function() {
                var cat_name = $(this).val().trim();
                var category_slug = cat_name.toLowerCase().replaceAll(' ', '-');
                $('#category_slug').val(category_slug);

                $.ajax({
                    url: "{{ route('check-category-slug') }}",
                    type: 'GET',
                    data: {
                        'category_slug': category_slug
                    },
                    dataType: 'JSON',

                    success: function(response, status) {
                        if (response.data) {
                            var count = Array.isArray(response.data) ? response.data.length :
                                Object.keys(response.data).length;

                            if (count > 1) {
                                alert("Error: More than one category found. Please choose a different slug.");

                                $('#category_slug').css('outline', '2px solid red');
                                $('#submit').prop('disabled', true);
                            } else {
                                $('#category_slug').css('outline', '2px solid green');
                                $('#submit').prop('disabled', false); 
                            }
                        } else {
                            $('#category_slug').css('outline', '2px solid green');
                            $('#submit').prop('disabled', false); 
                        }
                    },
                })
            })
        });
    </script>
@endsection
