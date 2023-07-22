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
{{-- @dd($countries) --}}
            <div class="pagetitle">
                <h1>Vendor</h1>
                <nav>
                    <ol class="breadcrumb">
                        
                            <li class="breadcrumb-item active"><a href="{{url('admin/update-vendor-detail/personel')}}">Personel Details Update</a></li>                   
                            <li class="breadcrumb-item active"><a href="{{url('admin/update-vendor-detail/business')}}"> Business Details Update </a></li>                     
                            <li class="breadcrumb-item active"><a href="{{url('admin/update-vendor-detail/bank')}}"> Bank Details Update</a></li>
                        
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <div class="row">
                <div class="card col-9"style="border: 3px dashed blue;">
                    @if ($slug == 'personel')
                        <div class="card-body">
                            <h5 class="card-title">Personel Details</h5>
                            <!-- Personel Details -->
                            @if (session()->has('error_massage'))
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session()->get('error_massage') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('massage'))
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session()->get('massage') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                        role="alert">
                                        <li>{{ $error }}</li>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif
                            {{-- @dd($vendorDetails) --}}
                            <form class="row g-3" method="post" action="{{ url('admin/update-vendor-detail/personel') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="vendor_name" class="form-label">Name</label>
                                    <input type="text" name="vendor_name" class="form-control" id="vendor_name"
                                        value="{{ $vendorDetails['name'] }}">
                                </div>
                                <div class="col-12">
                                    <label for="vendor_address" class="form-label">Address</label>
                                    <input type="text" name="vendor_address" class="form-control" id="vendor_address"
                                        value="{{ $vendorDetails['address'] }}">
                                </div>
                                <div class="col-12">
                                    <label for="vendor_city" class="form-label">City</label>
                                    <input type="text" name="vendor_city" class="form-control" id="vendor_city"
                                        value="{{ $vendorDetails['city'] }}">
                                </div>
                                <div class="col-12">
                                    <label for="vendor_state" class="form-label">State</label>
                                    <input type="text" name="vendor_state" class="form-control" id="vendor_state"
                                        value="{{ $vendorDetails['state'] }}">
                                </div>
                                <div class="col-12">
                                    <label for="vendor_country" class="form-label">Country</label>
                                    {{-- <input type="text" name="vendor_country" class="form-control" id="vendor_country"
                                        value="{{ $vendorDetails['country'] }}"> --}}
                                        <select name="vendor_country" id="vendor_country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country['country_name']}}" @if ($country['country_name']==$vendorDetails['country']) selected @endif>{{$country['country_name']}}</option>                                                
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-12">
                                    <label for="vendor_pincode" class="form-label">Pincode</label>
                                    <input type="text" name="vendor_pincode" class="form-control" id="vendor_pincode"
                                        value="{{ $vendorDetails['pincode'] }}">
                                </div>
                                <div class="col-12">
                                    <label for="vendor_mobile" class="form-label">Mobile</label>
                                    <input type="text" name="vendor_mobile" class="form-control"
                                        id="vendor_mobile" value="{{ $vendorDetails['mobile'] }}">
                                </div>
                                <div class="col-12">
                                    <label for="vendor_email" class="form-label">Email</label>
                                    <input type="email" name="vendor_email"class="form-control" id="vendor_email"
                                        value="{{ $vendorDetails['email'] }}">
                                </div>
                                <div class="col-md-8 col-lg-9">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <div><img
                                                src="{{ url('admin/assets/image/' . Auth::guard('admin')->user()->image) }}"
                                                width="80px" /></div>
                                    @endif
                                    <div class="col-12">
                                        <label for="vendor_image" class="form-label">Image</label>
                                        <input type="file" name="vendor_image" class="form-control" id="vendor_image"
                                            value="">
                                        <input type="hidden" name="current_vendor_image"
                                            value="{{ Auth::guard('admin')->user()->image }}">
                                    </div>
                                </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                            </form><!-- Vertical Form -->

                        </div>
                    @elseif($slug == 'business')
                        <div class="card-body">
                            <h5 class="card-title">Business Details</h5>

                            <!-- Business Details -->
                            @if (session()->has('error_massage'))
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session()->get('error_massage') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('massage'))
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session()->get('massage') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                        role="alert">
                                        <li>{{ $error }}</li>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif

                            <form class="row g-3" method="post"
                                action="{{ url('admin/update-vendor-detail/business') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="shop_name" class="form-label">Name shop</label>
                                    <input type="text" name="shop_name" class="form-control" id="shop_name"
                                    @if (isset($vendorDetails['shop_name']))
                                    value="{{ $vendorDetails['shop_name'] }}" readonly
                                    @endif
                                         >
                                </div>
                                <div class="col-12">
                                    <label for="shop_address" class="form-label">Shop Address</label>
                                    <input type="text" name="shop_address" class="form-control" id="shop_address"
                                    @if(isset($vendorDetials['shop_address']))
                                        value="{{ $vendorDetails['shop_address'] }}"
                                        @endif
                                    >
                                </div>
                                <div class="col-12">
                                    <label for="shop_city" class="form-label">Shop City</label>
                                    <input type="text" name="shop_city" class="form-control" id="shop_city"
                                    @if(isset($vendorDetials['shop_city']))
                                        value="{{ $vendorDetails['shop_city'] }}"
                                        @endif>
                                </div>
                                <div class="col-12">
                                    <label for="shop_state" class="form-label">Shop State</label>
                                    <input type="text" name="shop_state" class="form-control" id="shop_state"
                                    @if(isset($vendorDetials['shop_state']))
                                        value="{{ $vendorDetails['shop_state'] }}"
                                        @endif 
                                        >
                                </div>
                                <div class="col-12">
                                    <label for="shop_country" class="form-label">Shop Country</label>
                                    <input type="text" name="shop_country" class="form-control" id="shop_country"
                                    @if(isset($vendorDetials['shop_country']))
                                        value="{{ $vendorDetails['shop_country'] }}"
                                        @endif>
                                </div>
                                <div class="col-12">
                                    <label for="shop_pincode" class="form-label">Pincode</label>
                                    <input type="text" name="shop_pincode" class="form-control" id="shop_pincode"
                                    @if(isset($vendorDetials['shop_pincode']))

                                        value="{{ $vendorDetails['shop_pincode'] }}"
                                        @endif>
                                </div>
                                <div class="col-12">
                                    <label for="shop_mobile" class="form-label">Mobile</label>
                                    <input type="number" name="shop_mobile" class="form-control" id="shop_mobile"
                                    @if(isset($vendorDetials['shop_mobile']))

                                        value="{{ $vendorDetails['shop_mobile'] }}"
                                        @endif>
                                </div>
                                <div class="col-12">
                                    <label for="shop_email" class="form-label">Email</label>
                                    <input type="email" name="shop_email"class="form-control" id="shop_email"
                                    @if(isset($vendorDetials['shop_email']))
                                        value="{{ $vendorDetails['shop_email'] }}"
                                        @endif
                                        >
                                </div>
                                <div class="col-12">
                                    <label for="shop_address_prof" class="form-label">Address Proof</label>
                                    <select name="address_proof" id="address_proof" class="form-select">
                                        @if(isset($vendorDetails['address_proof']))
                                        <option value="Passport" @if ($vendorDetails['address_proof'] == 'Passport') selected @endif>
                                            Passport</option>
                                        <option value="Vote Card" @if ($vendorDetails['address_proof'] == 'Vote Card') selected @endif>Vote
                                            Card</option>
                                        <option value="Pan" @if ($vendorDetails['address_proof'] == 'Pan') selected @endif>Pan
                                        </option>
                                        <option value="Driving License" @if ($vendorDetails['address_proof'] == 'Driving License') selected @endif>
                                            Driving License</option>
                                        <option value="CNIC" @if ($vendorDetails['address_proof'] == 'CNIC') selected @endif>Identy
                                            Card</option>
                                            @endif
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="shop_business_licens_number" class="form-label">Business Licens
                                        Number</label>
                                    <input type="text" name="shop_business_licens_number"class="form-control"
                                        id="shop_business_licens_number" 
                                        @if(isset($vendorDetails['business_licens_number']))
                                        value="{{ $vendorDetails['business_licens_number'] }}"                                            
                                        @endif >
                                </div>
                                <div class="col-12">
                                    <label for="shop_gst_number" class="form-label">GST Number</label>
                                    <input type="text" name="shop_gst_number"class="form-control"
                                        id="shop_gst_number"
                                        @if(isset($vendorDetails['gst_number']))
                                         value="{{ $vendorDetails['gst_number'] }}"@endif>
                                </div>
                                <div class="col-12">
                                    <label for="shop_pan_number" class="form-label">PAN Number</label>
                                    <input type="text" name="shop_pan_number"class="form-control"
                                        id="shop_pan_number"
                                        @if(isset($vendorDetails['pan_number']))
                                         value="{{ $vendorDetails['pan_number'] }}"
                                         @endif>
                                </div>
                                <div class="col-md-8 col-lg-9">
                                    @if (!empty($vendorDetails['address_proof_image']))
                                        <div><img
                                                src="{{ url('admin/assets/proofs/' . $vendorDetails['address_proof_image']) }}"
                                                width="80px" /></div>
                                        <input type="hidden" name="current_address_proof_image"
                                            value="{{ $vendorDetails['address_proof_image'] }}">
                                    @endif
                                    <div class="col-12">
                                        <label for="address_proof_image" class="form-label">Address Image Proof</label>
                                        <input type="file" name="address_proof_image" class="form-control"
                                            id="address_proof_image" value="">

                                    </div><br>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                            </form><!-- Vertical Form -->

                        </div>
                    @elseif($slug == 'bank')
                        <div class="card-body">
                            <h5 class="card-title">Bank Details</h5>

                            <!-- Bank Details -->
                            @if (session()->has('error_massage'))
                            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                role="alert">
                                {{ session()->get('error_massage') }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('massage'))
                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                role="alert">
                                {{ session()->get('massage') }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    <li>{{ $error }}</li>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                            <form class="row g-3" method="post" action="{{ url('admin/update-vendor-detail/bank') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="bank_name"  class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                                    @if (isset($vendorDetails['bank_name']))
                                    value="{{ $vendorDetails['bank_name'] }}"                                        
                                    @endif  >
                                </div>
                                <div class="col-12">
                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name"
                                    @if (isset($vendorDetails['account_holder_name']))
                                     value="{{$vendorDetails['account_holder_name']}}"
                                     @endif>
                                </div>
                                <div class="col-12">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number"
                                    @if (isset($vendorDetails['account_number']))
                                     value="{{$vendorDetails['account_number']}}"
                                     @endif>
                                </div>
                                <div class="col-12">
                                    <label for="bank_ifsc_code" class="form-label">Account ifsc Code</label>
                                    <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code"
                                    @if (isset($vendorDetails['bank_ifsc_code']))
                                     value="{{$vendorDetails['bank_ifsc_code']}}" @endif >
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    @endif

                </div>
            </div>

        </main><!-- End #main -->
    @endsection

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
