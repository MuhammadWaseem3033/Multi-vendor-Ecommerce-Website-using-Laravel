{{-- @dd($section) --}}
@extends('admin.layouts.main')
@section('main.container')
    <main id="main" class="main">
        {{-- @dd($countries) --}}
        <div class="pagetitle">
        </div><!-- End Page Title -->
        <div class="row">
            <div class="card col-9"style="border: 3px dashed blue;">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <!-- Personel Details -->
                    @if (session()->has('massage'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            {{ session()->get('massage') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- @dd($vendorDetails) --}}
                    <form class="row g-3" method="post"
                        @if (empty($brand['id'])) 
                        action="{{ url('admin/add-edit-brand') }}"
                        @else
                        action="{{ url('admin/add-edit-brand/' . $brand['id']) }}" @endif>
                        @csrf
                        <div class="col-12">
                            <label for="brand_name" class="form-label">Name</label>
                            <input type="text" name="brand_name" class="form-control" id="brand_name"
                                @if (empty($brand['name'])) value="{{ $brand['name'] }}"
                                      @else
                                      value="{{ $brand['name'] }}" @endif>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>


            </div>
        </div>

    </main><!-- End #main -->
@endsection
@section('custom.js')
@endsection
