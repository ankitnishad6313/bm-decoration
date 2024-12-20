@extends('front-layout')

@push('title')
    <title>Checkout</title>
@endpush

@section('main-section')
<div class="container">
    <form action="{{ route('payment') }}" method="post" class="row">
        @csrf
        Amount : <input type="number" name="amount" id=""> <br> <br>
        <input type="submit" value="Pay">
    </form>
</div>
@endsection