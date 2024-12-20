@extends('admin.layout')
@push('title')
    <title>Contacts</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">All Contacts</h6>
                    </div>
                    @foreach ($contacts as $item)
                        <div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <div>
                                        <h5 class="mb-0">{{ $item->first_name . ' ' . $item->last_name }}</h5>
                                        <a href="tel:+91 {{ $item->phone }}">{{ $item->phone }}</a>
                                    </div>
                                    <div>
                                        <small>{{ getTimeDifference($item->created_at) }}</small>
                                        <a href="{{ route('admin-contact-delete', ['id' => $item->id]) }}" class="btn btn-outline-primary ms-3">Delete</a>
                                    </div>
                                </div>
                                <span>{{ $item->message }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
