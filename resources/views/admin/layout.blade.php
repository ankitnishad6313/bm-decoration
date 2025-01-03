<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @stack('title')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.html" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;family=Roboto:wght@500;700&amp;display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('/') }}/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('/') }}/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ url('/') }}/admin/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

    <style>
        table img {
            max-height: 100px;
            max-width: 100px;
            /* object-fit: contain; */
            display: block;
            margin: auto
        }

        .note-dropdown-menu .note-btn,
        .note-dropdown-menu .dropdown-item {
            color: black !important;
        }

        .note-dropdown-menu .note-btn:hover,
        .note-dropdown-menu .dropdown-item:hover {
            background-color: #f0f0f0;
            color: black !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="{{ route('admin-dashboard') }}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Dashboard</h3>
                </a>
                {{-- <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ auth()->user()->profile_pic }}" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                        <span>Admin</span>
                    </div>
                </div> --}}
                <div class="navbar-nav w-100">
                    <a href="{{ route('admin-dashboard') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/dashboard') }}">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        
                    <a href="{{ route('category-list') }}"
                        class="nav-item nav-link {{ active_if_match('admin/category') }}"><i
                            class="fa fa-list me-2"></i>Category</a>

                    <a href="{{ route('sub-category-list') }}"
                        class="nav-item nav-link {{ active_if_match('admin/sub-category') }}">
                        <i class="fa fa-list me-2"></i>Sub Category</a>

                    <a href="{{ route('product-list') }}"
                        class="nav-item nav-link {{ active_if_match('admin/product') }}">
                        <i class="fa fa-keyboard me-2"></i>Product</a>

                    <a href="{{ route('slider-list') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/slider/list') }}">
                        <i class="fa fa-table me-2"></i>Sliders</a>

                    <a href="{{ route('addon-list') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/addon/list') }}">
                        <i class="fa fa-chart-bar me-2"></i>Addon Products</a>

                    <a href="{{ route('city-list') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/city/list') }}">
                        <i class="fa fa-table me-2"></i>City</a>

                    <a href="{{ route('admin-contacts') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/contacts') }}">
                        <i class="fa fa-table me-2"></i>Contacts</a>

                    <a href="{{ route('admin-users') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/users-list') }}">
                        <i class="fa fa-table me-2"></i>Users</a>

                    <a href="{{ route('admin-orders') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/orders') }}">
                        <i class="fa fa-table me-2"></i>Orders</a>

                    <a href="{{ route('review-list') }}"
                        class="nav-item nav-link {{ active_if_full_match('admin/reviews') }}">
                        <i class="fa fa-table me-2"></i>Reviews</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="{{ route('admin-dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ url('/uploads/profile/'. auth()->user()->profile_pic) }}"
                                alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}</span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('admin-profile') }}" class="dropdown-item">My Profile</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#password-change"
                                class="dropdown-item">Settings</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            @yield('main-section')


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">B.M. Decoration</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By: <a href="https://eucoders.org/" target="_blank">Eucoders</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Modal -->
        <div class="modal fade" id="password-change" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="password-changeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="password-changeLabel">Change Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row" action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12 mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" id="current_password">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                            </div>
                            
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-75">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="{{ url('/') }}/admin/js/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/chart/chart.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/easing/easing.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ url('/') }}/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ url('/') }}/admin/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script src="{{ url('/') }}/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.editor', // Target the textarea(s)
            plugins: 'lists link image code', // Add required plugins
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code', // Customize the toolbar

            // Add H1-H6 and Paragraph in the format dropdown
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',

            // Optional: Image and link settings
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function() {
                            callback(reader.result, {
                                alt: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}!",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}!",
                icon: "error"
            });
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    title: "Error!",
                    text: "{{ $error }}!",
                    icon: "error"
                });
            </script>
        @endforeach
    @endif

    @yield('script')
</body>

</html>
