@extends('admin.layout')
@push('title')
    <title>Edit Review</title>
@endpush
@section('main-section')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="row g-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="mb-0">Edit Review</h6>
            </div>
            <hr>

            <div class="col-12">
                <div class="bg-secondary rounded h-100 px-4">
                    <div class="row g-4">
                        <form class="row" action="{{ route('review-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="product_id" class="form-label">Select Product</label>
                                <select name="product_id" id="product_id" class="form-select">
                                    <option value="" selected disabled>Select Product</option>
                                    @foreach ($products as $item)
                                    <option value="{{ $item->id }}"
                                    {{ old('product_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="star" class="form-label">Star</label>
                                <input type="number" name="star" min="1" max="5" value="{{ old('star') }}"
                                    class="form-control" id="star" placeholder="Enter star" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea name="comment" cols="30" id="comment" rows="3" class="form-control" placeholder="Write Your Review">{!! old('comment') !!}</textarea>
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

