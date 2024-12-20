@extends('front-layout')
@push('title')
    <title>Categories</title>
@endpush
@section('style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/category-routes.css" />
@endsection

@section('main-section')
    <main>
        <section class="category-routes-container">
            <div class="breadCrumbs">
                <a href="{{ route('index') }}">Home</a>
                <p>Categories</p>
            </div>
            <h1>All Categories</h1>
            <div class="category-routes">
                @foreach ($categories as $category)
                    <a class="category-route" href="{{ route('show-products', ['category_slug' => $category->category_slug]) }}">
                        <img src="{{ $category->cat_image }}"
                            alt="category image" height="50" width="50" decoding="async" loading="lazy">
                        <p>{{ $category->cat_name }}</p>
                    </a>
                @endforeach
            </div>
        </section>

    </main>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
