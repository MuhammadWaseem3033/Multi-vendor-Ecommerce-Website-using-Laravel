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
                        <li class="breadcrumb-item active">Update-Admin-Password</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pt-3">
                                <div class="tab-content pt-2">
                                    <!-- Change Password Form -->
                                    @if (session()->has('error_massage'))
                                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                            role="alert">
                                            {{ session()->get('error_massage') }}
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session()->has('success_massage'))
                                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                            role="alert">
                                            {{ session()->get('success_massage') }}
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
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
