@extends('admin.layout')
@push('title')
    <title>Add Category</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="row g-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Add Sub Category</h6>
                    <div>
                        <a class="btn btn-outline-primary ms-1" href="{{ route('sub-category-list') }}">All Sub Category</a>
                    </div>
                </div>
                <hr>

                <div class="col-12">
                    <div class="bg-secondary rounded h-100 px-4">
                        <div class="row g-4">
                            <form class="row" action="{{ route('sub-category-store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-12 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                        id="title" placeholder="Enter Title" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="category_id" class="form-label">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->cat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="sub_cat_name" class="form-label">Sub Category Name</label>
                                    <input type="text" name="sub_cat_name" value="{{ old('sub_cat_name') }}"
                                        class="form-control" id="sub_cat_name" placeholder="Enter Sub Category Name"
                                        required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="sub_category_slug" class="form-label">Sub Category Slug</label>
                                    <input type="text" name="sub_category_slug" value="{{ old('sub_category_slug') }}"
                                        class="form-control" id="sub_category_slug" placeholder="Enter Sub Category Slug"
                                        required>
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#sub_cat_name').keyup(function() {
                var sub_cat_name = $(this).val().trim();
                var sub_category_slug = sub_cat_name.toLowerCase().replaceAll(' ', '-');
                $('#sub_category_slug').val(sub_category_slug);

                $.ajax({
                    url: "{{ route('check-category-slug') }}",
                    type: 'GET',
                    data: {
                        'sub_category_slug': sub_category_slug
                    },
                    dataType: 'JSON',

                    success: function(response, status) {
                        if (response.data) {
                            var count = Array.isArray(response.data) ? response.data.length :
                                Object.keys(response.data).length;

                            if (count > 1) {
                                alert(
                                    "Error: More than one category found. Please choose a different slug."
                                    );

                                $('#sub_category_slug').css('outline', '2px solid red');
                                $('#submit').prop('disabled', true);
                            } else {
                                $('#sub_category_slug').css('outline', '2px solid green');
                                $('#submit').prop('disabled', false);
                            }
                        } else {
                            $('#sub_category_slug').css('outline', '2px solid green');
                            $('#submit').prop('disabled', false);
                        }
                    },
                })
            })
        });
    </script>
@endsection
