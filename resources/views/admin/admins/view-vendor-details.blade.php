@extends('admin.layouts.main')
@section('main.container')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Vendor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ url('admin/admins/vendor') }}"><i
                                class="bi bi-house-door-fill"></i></a></li>
                    <li class="breadcrumb-item active">Personel</li>
                    <li class="breadcrumb-item active">Business</li>
                    <li class="breadcrumb-item active">Bank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <div
                class="card col-4 pr-4"style="border-left: 3px dashed blue;border-top: 3px dashed blue;border-right:none;border-bottom:3px dashed blue;">
                {{-- @dd($vendorDetails) --}}
                <div class="card-body">
                    <h5 class="card-title"> Vendor Personel Details</h5>
                    <div class="col-12">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personel']['name'] }}"
                            readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_personel']['address'] }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personel']['city'] }}"
                            readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personel']['state'] }}"
                            readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_personel']['country'] }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Pincode</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_personel']['pincode'] }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Mobile</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personel']['mobile'] }}"
                            readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personel']['email'] }}"
                            readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Staus</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personel']['status'] }}"
                            readonly>
                    </div>
                    <br>
                    <div class="col-md-8 col-lg-9">
                        @if (!empty($vendorDetails['image']))
                            <div><img src="{{ url('admin/assets/image/' . $vendorDetails['image']) }}" readonly
                                    width="80px" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- Bussiness Details --}}
            <div class="card col-4 pr-4"style="border: 3px dashed blue;">
                {{-- @dd($vendorDetails) --}}
                <div class="card-body">
                    <h5 class="card-title">Vendor Business Details</h5>
                    <div class="col-12">
                        <label class="form-label">Shop Name</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_name'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop Address</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_address'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop City</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_city'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop State</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_state'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop Country</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_country'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop Pincode</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_pincode'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop Mobile</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_mobile'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop Website</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_website'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shop Email</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['shop_email'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address Proofs</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['address_proof'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Business_Licens_Number</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['business_licens_number'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">GST Number</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['gst_number'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Pan Number</label>
                        <input type="text" class="form-control"
                            value="{{ $vendorDetails['vendor_business']['pan_number'] ?? '' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address Proof Image</label>
                    </div>
                    <br>
                    <div class="col-md-8 col-lg-9">
                        @if (!empty($vendorDetails['vendor_business']['address_proof_image'] ?? ''))
                            <div><img
                                    src="{{ url('admin/assets/proofs/' . $vendorDetails['vendor_business']['address_proof_image'] ?? '') }}"
                                    readonly width="80px" />
                            </div>
                        @endif


                    </div>


                </div>
            </div>
            {{-- Bank Details --}}
            <div class="card col-4 pl-4 "style="border: 3px dashed blue;">
                {{-- @dd($vendorDetails) --}}
                <div class="card-body">
                    <h5 class="card-title">Vendor Bank Details</h5>
                    <div class="col-12">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control"
                            @if (isset($vendorDetails['vendor_bank']['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" readonly @endif>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Account Holder Address</label>
                        <input type="text" class="form-control"
                            @if (isset($vendorDetails['vendor_bank']['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" readonly @endif>
                    </div>
                    <div class="col-12">
                        <label class="form-label"> Account Number </label>
                        <input type="text" class="form-control"
                            @if (isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['account_number'] }}" readonly @endif>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Bank Ifsc Code</label>
                        <input type="text" class="form-control"
                            @if (isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" readonly @endif>
                    </div>

                </div>
            </div>
        </div>
    </main><!-- End #main -->
@endsection
@section('custom.js')
@endsection
