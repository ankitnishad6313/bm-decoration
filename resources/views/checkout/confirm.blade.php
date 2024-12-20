@extends('front-layout')

@push('title')
    <title>Confirm Order</title>
@endpush

@section('main-section')
<div class="container">
    <div class="row">
        <p>Order ID: <strong>{{ $data['notes']['order_id'] }}</strong></p>
        <p>Amount: <strong>{{ number_format($data['amount']/100,2) }}</strong></p>
    </div>
</div>
@endsection