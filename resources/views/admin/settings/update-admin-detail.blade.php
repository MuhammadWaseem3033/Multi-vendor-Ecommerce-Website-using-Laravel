@extends('admin.layouts.main')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('admin/assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ url('admin/assets/js/Jquery.js') }}"></script>
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @section('main.container')
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Settings</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Details</li>
                        <li class="breadcrumb-item active">Update-Admin-details</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                @if (!empty(Auth::guard('admin')->user()->image))
                                    <div><img src="{{ url('admin/assets/image/' . Auth::guard('admin')->user()->image) }}"
                                            width="100px" alt="Profile" class="rounded-circle" /></div>
                                @endif

                                <h2>{{ Auth::guard('admin')->user()->name }}</h2>
                                <h3>{{ Auth::guard('admin')->user()->type }}</h3>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                            Profile</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Change Password</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                            <div class="col-lg-9 col-md-8">{{ Auth::guard('admin')->user()->name }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Mobile</div>
                                            <div class="col-lg-9 col-md-8">{{ Auth::guard('admin')->user()->mobile }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8">{{ Auth::guard('admin')->user()->email }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Company</div>
                                            <div class="col-lg-9 col-md-8">Freelancer</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Job</div>
                                            <div class="col-lg-9 col-md-8">Web Developer</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Country</div>
                                            <div class="col-lg-9 col-md-8">Punjab , Pakistan</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8">Distt DgKhan Khanpur , </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <!-- Profile Edit Form -->
                                        @if (session()->has('error_massage'))
                                            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                                role="alert">
                                                {{ session()->get('error_massage') }}
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session()->has('success_massage'))
                                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                                role="alert">
                                                {{ session()->get('success_massage') }}
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                                    role="alert">
                                                    <li>{{ $error }}</li>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endforeach
                                        @endif

                                        <form method="post" action="{{ url('admin/update-admin-detail') }}"
                                            enctype="multipart/form-data">@csrf
                                            <div class="row mb-3">
                                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                    Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    @if (!empty(Auth::guard('admin')->user()->image))
                                                        <div><img
                                                                src="{{ url('admin/assets/image/' . Auth::guard('admin')->user()->image) }}"
                                                                width="100px" /></div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Admin Type</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ ucfirst(Auth::guard('admin')->user()->type) }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="admin_name" type="text"
                                                        class="form-control"id="admin_name"
                                                        value="{{ ucfirst(Auth::guard('admin')->user()->name) }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Mobile</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="admin_mobile" type="text" class="form-control"
                                                        id="admin_mobile"
                                                        value="{{ ucfirst(Auth::guard('admin')->user()->mobile) }}"
                                                        maxlength="13" minlength="11">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="admin_image" type="file" class="form-control"
                                                        id="admin_image">
                                                    <input type="hidden" name="current_admin_image"
                                                        value="{{ Auth::guard('admin')->user()->image }}">
                                                </div>
                                            </div>


                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                <button type="reset" class="btn btn-primary">cancel</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->

                                    </div>
                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        @if (session()->has('error_massage'))
                                            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                                role="alert">
                                                {{ session()->get('error_massage') }}
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session()->has('success_massage'))
                                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                                role="alert">
                                                {{ session()->get('success_massage') }}
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <form method="post" action="{{ url('admin/update-admin-password') }}">@csrf
                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Email / Username</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ $adminDetails['email'] }} " readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Admin Type</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control"
                                                        value="{{ ucfirst($adminDetails['type']) }} " readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="current_password" type="password" class="form-control"
                                                        id="current_password">
                                                    <span id="check-password"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">New
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="new_password" type="password" class="form-control"
                                                        id="new_password">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-4 col-lg-3 col-form-label">Confirm
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="confirm_password" type="password" class="form-control"
                                                        id="confirm_password">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>
                                        </form><!-- End Change Password Form -->

                                    </div>

                                </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main><!-- End #main -->
    @endsection
    <br><br><br><br>
     <script>
        $(document).ready(function() {
            $('#current_password').keyup(function() {
                var current_password = $('#current_password').val();
                // alert(currentPassword);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/admin/check-current-password",
                    data: {
                        current_password: current_password
                    },
                    success: function(reps) {
                        // alert(reps);
                        if (reps == "false") {
                            $('#check-password').html(
                                "<font color='red'>Current Password is Invalid</font>");
                        } else if (reps == "true") {
                            $('#check-password').html(
                                "<font color='green'>Current Password is Valid</font>");
                        }
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            })
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
    <!-- Vendor JS Files -->
    <script src="{{ url('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('admin/assets/js/main.js') }}"></script>
    {{-- custom js for current change password --}}

</body>

</html>
