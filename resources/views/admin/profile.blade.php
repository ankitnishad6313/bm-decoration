@extends('admin.layout')
@push('title')
    <title>Admin Profile</title>
@endpush
@section('main-section')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="row g-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Profile</h6>
                </div>
                <hr>
                <div class="col-sm-12 col-xl-3">
                    <div class="bg-secondary rounded h-100 px-4">
                        <h5 class="mb-4 text-center">Profile</h5>
                        <div class="owl-carousel testimonial-carousel">
                            <div class="testimonial-item text-center">
                                <img src="{{ url('/uploads/profile/'. $user->profile_pic) }}" class="img-fluid rounded-circle mx-auto mb-4"
                                    style="width: 100px; height: 100px;">
                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p>{{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-9">
                    <div class="bg-secondary rounded h-100 px-4">
                        <div class="row g-4">
                            <h6 class="mb-4">Update Profile</h6>
                            <form class="row" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="name"
                                        placeholder="Enter Name" required>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email"
                                        aria-describedby="emailHelp" placeholder="Enter Email address" required>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="phone" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="10" class="form-control" id="phone"
                                        placeholder="Enter Your Phone Number" required>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="profile_pic" class="form-label">Profile Pic <small style="font-size: 10px">(Max Height:200, Max Width:200, Max Size:512KB)</small></label>
                                    <input type="file" name="profile_pic" class="form-control bg-dark" id="profile_pic" accept="image/jpeg,image/png,image/jpg,image/webp">
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="Male" {{ $user->gender == "Male" ? "selected" : "" }}>Male</option>
                                        <option value="Female" {{ $user->gender == "Female" ? "selected" : "" }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="current_address" class="form-label">Address</label>
                                    <input type="text" name="current_address" value="{{ old('current_address', $user->current_address) }}" class="form-control" id="current_address">
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary w-50">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
