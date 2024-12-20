@extends('admin.layout')
@push('title')
    <title>Edit Product</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="row g-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Edit Product</h6>
                    <div>
                        <a class="btn btn-outline-primary ms-1" href="{{ route('product-list') }}">All Products</a>
                    </div>
                </div>
                <hr>

                <div class="col-12">
                    <div class="bg-secondary rounded h-100 px-4">
                        <div class="row g-4">
                            <form class="row" action="{{ route('product-update', ['id' => $data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $data->title) }}"
                                        class="form-control" id="title" placeholder="Enter title" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="thumb_img" class="form-label">Thumbnail Image</label>
                                    <input type="file" name="thumb_img" class="form-control bg-dark" id="thumb_img">
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="category_id" class="form-label">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('category_id', $data->category_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->cat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="sub_category_id" class="form-label">Select Sub Category</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-select">
                                        <option value="" selected disabled>Select Sub Category</option>
                                        @foreach ($subcategory as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('sub_category_id', $data->sub_category_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->sub_cat_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" name="name" value="{{ old('name', $data->name) }}"
                                        class="form-control" id="name" placeholder="Enter Product Name" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="product_slug" class="form-label">Product Slug</label>
                                    <input type="text" name="product_slug"
                                        value="{{ old('product_slug', $data->product_slug) }}" class="form-control"
                                        id="product_slug" placeholder="Enter Product Slug" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3 product-img">
                                    <label for="images" class="form-label">Product Image</label>
                                    <div class="d-flex justify-content-start mb-2 gap-1">
                                        @foreach ($data->productImages as $item)
                                            <div class="position-relative bg-info " height="100" width="100">
                                                <img src="{{ url("/uploads/products/$item->image") }}" alt=""
                                                    height="100" width="100">
                                                <button data-id="{{ $item->id }}" type="button"
                                                    class="delete-img btn btn-danger position-absolute top-0 start-50 p-1 text-white"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-items-center">
                                        <input type="file" name="images[]" class="form-control bg-dark" id="images">
                                        <button type="button" class="add-image btn btn-success ms-2">+</button>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="Active"
                                            {{ old('status', $data->status) == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive"
                                            {{ old('status', $data->status) == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" value="{{ old('price', $data->price) }}"
                                        min="0" class="form-control" id="price" placeholder="Enter Price"
                                        required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="discount_percentage" class="form-label">Discount Percentage</label>
                                    <input type="number" name="discount_percentage"
                                        value="{{ old('discount_percentage', $data->discount_percentage) }}"
                                        min="0" max="100" class="form-control" id="discount_percentage"
                                        placeholder="Discount Percentage" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3 dynamic-data">
                                    <label for="inclusion" class="form-label">Inclusion</label>
                                    @if (!empty($data->inclusion))
                                        @foreach ($data->inclusion as $key => $item)
                                            <div class="d-flex justify-items-center mt-3">
                                                <input type="text" name="inclusion[]" value="{{ $item }}"
                                                    class="form-control" placeholder="Inclusion">
                                                @if ($key == 0)
                                                    <button type="button"
                                                        class="add-inclusion btn btn-success ms-2">+</button>
                                                @else
                                                    <button type="button"
                                                        class="remove-input btn btn-danger ms-2">-</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- In case there are no inclusions, provide one empty input field -->
                                        <div class="d-flex justify-items-center mt-3">
                                            <input type="text" name="inclusion[]" value="" class="form-control"
                                                placeholder="Inclusion">
                                            <button type="button" class="add-inclusion btn btn-success ms-2">+</button>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 col-lg-6 mb-3 dynamic-data">
                                    <label for="exclusion" class="form-label">Exclusion</label>
                                    @if (!empty($data->exclusion))
                                        @foreach ($data->exclusion as $key => $item)
                                            <div class="d-flex justify-items-center mt-3">
                                                <input type="text" name="exclusion[]" value="{{ $item }}"
                                                    class="form-control" placeholder="Exclusion">
                                                @if ($key == 0)
                                                    <button type="button"
                                                        class="add-exclusion btn btn-success ms-2">+</button>
                                                @else
                                                    <button type="button"
                                                        class="remove-input btn btn-danger ms-2">x</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <!-- In case there are no exclusions, provide one empty input field -->
                                        <div class="d-flex justify-items-center mt-3">
                                            <input type="text" name="exclusion[]" value="" class="form-control"
                                                placeholder="Exclusion">
                                            <button type="button" class="add-exclusion btn btn-success ms-2">+</button>
                                        </div>
                                    @endif
                                </div>


                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="is_trending" class="form-label">Trending Product</label>
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
                                    <label for="is_popular" class="form-label">Popular Product</label>
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

                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Product Description</label>
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
                                    <button type="submit" class="btn btn-primary w-25">Update</button>
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
            $('#category_id').change(function() {
                var sub_category_id = $('#sub_category_id');
                sub_category_id.html('');
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('get-sub-category') }}",
                    type: 'GET',
                    data: {
                        cat_id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'JSON',

                    success: function(response) {
                        if (response.data.length > 0) {
                            sub_category_id.append(
                                '<option value="" selected disabled>Select Sub Category</option>'
                            );
                            response.data.forEach(element => {
                                sub_category_id.append(`
                            <option value="${element.id}">
                                ${element.sub_cat_name}
                            </option>
                            `);
                            });
                        } else {
                            sub_category_id.append(
                                '<option value="" selected disabled>No Sub Category Found</option>'
                            );

                        }
                    },

                    error: function(xhr, status, error) {

                    }
                })
            });

            $('#name').keyup(function() {
                var cat_name = $(this).val().trim();
                var product_slug = cat_name.toLowerCase().replaceAll(' ', '-');
                $('#product_slug').val(product_slug);

                $.ajax({
                    url: "{{ route('check-product-slug') }}",
                    type: 'GET',
                    data: {
                        'product_slug': product_slug
                    },
                    dataType: 'JSON',

                    success: function(response, status) {
                        if (response.data) {
                            var count = Array.isArray(response.data) ? response.data.length :
                                Object.keys(response.data).length;

                            if (count > 1) {
                                alert(
                                    "Error: More than one product found. Please choose a different slug."
                                );

                                $('#product_slug').css('outline', '2px solid red');
                                $('#submit').prop('disabled', true);
                            } else {
                                $('#product_slug').css('outline', '2px solid green');
                                $('#submit').prop('disabled', false);
                            }
                        } else {
                            $('#product_slug').css('outline', '2px solid green');
                            $('#submit').prop('disabled', false);
                        }
                    },
                })
            })


            $('.add-inclusion').click(function() {
                $(this).closest('.dynamic-data').append(`
                    <div class="d-flex justify-items-center mt-3">
                        <input type="text" name="inclusion[]" class="form-control" placeholder="Inclusion">
                        <button type="button" class="remove-input btn btn-danger ms-2">x</button>
                    </div>
               `);
            });

            $('.add-exclusion').click(function() {
                $(this).closest('.dynamic-data').append(`
                    <div class="d-flex justify-items-center mt-3">
                        <input type="text" name="exclusion[]" class="form-control" placeholder="Exclusion">
                        <button type="button" class="remove-input btn btn-danger ms-2">x</button>
                    </div>
               `);
            });

            $('.add-image').click(function() {
                $(this).closest('.product-img').append(`
                    <div class="d-flex justify-items-center mt-3">
                        <input type="file" name="images[]" class="form-control bg-dark" id="images" required>
                        <button type="button" class="remove-input btn btn-danger ms-2">x</button>
                    </div>
               `);
            });

            $(document).on('click', '.remove-input', function() {
                $(this).closest('div').remove();
            })


            $(document).on("click", '.delete-img', function() {
                let img_id = $(this).data('id');
                $.ajax({
                    url: "{{ route('product-img-destroy') }}",
                    type: 'GET',
                    data: {
                        id : img_id,
                        _token : "{{ csrf_token() }}"

                    },
                    dataType: 'JSON',

                    success: function(response, status) {
                        Swal.fire({
                            title: "Success!",
                            text: "Image has been Deleted!",
                            icon: "success"
                        });
                        location.reload();
                    },

                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.log(error);
                        
                    }
                });

            });
        });
    </script>
@endsection
