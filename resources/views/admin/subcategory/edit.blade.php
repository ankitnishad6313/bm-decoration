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
                        <a class="btn btn-outline-primary me-1" href="{{ route('sub-category-create') }}">Create New Categoies</a>
                        <a class="btn btn-outline-primary ms-1" href="{{ route('sub-category-list') }}">All Sub Categoies</a>
                    </div>
                </div>
                <hr>

                <div class="col-12">
                    <div class="bg-secondary rounded h-100 px-4">
                        <div class="row g-4">
                            <form class="row" action="{{ route('sub-category-update', ['id' => $data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-12 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $data->title) }}"
                                        class="form-control" id="title" placeholder="Enter title" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="category_id" class="form-label">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ old('category_id', $data->category_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->cat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Active" {{ old('status', $data->status) == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ old('status', $data->status) == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="sub_cat_name" class="form-label">Sub Category Name</label>
                                    <input type="text" name="sub_cat_name" value="{{ old('sub_cat_name', $data->sub_cat_name) }}"
                                        class="form-control" id="sub_cat_name" placeholder="Enter Sub Category Name"
                                        required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="sub_category_slug" class="form-label">Sub Category Slug</label>
                                    <input type="text" name="sub_category_slug" value="{{ old('sub_category_slug', $data->sub_category_slug) }}"
                                        class="form-control" id="sub_category_slug" placeholder="Enter Sub Category Slug"
                                        required>
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
