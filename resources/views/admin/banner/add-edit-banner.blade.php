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
                    <form class="row g-3" method="post" enctype="multipart/form-data"
                        @if (empty($banner['id'])) 
                        action="{{ url('admin/add-edit-banner') }}"
                        @else
                        action="{{ url('admin/add-edit-banner/' . $banner['id']) }}" @endif>
                        @csrf
                        <div class="col-12">
                            <label for="images_banner" class="form-label">image</label>
                            <input type="file" name="images_banner" class="form-control" id="images_banner"
                                @if (empty($banner['images_banner'])) value="{{ $banner['images_banner'] }}"
                                      @else
                                      value="{{ $banner['images_banner'] }}" 
                                      @endif>
                        </div> 
                        <div class="col-12">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" name="link" class="form-control" id="link"
                                @if (empty($banner['link'])) value="{{ $banner['link'] }}"
                                      @else
                                      value="{{ $banner['link'] }}" @endif>
                        </div> 
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                @if (empty($banner['title'])) value="{{ $banner['title'] }}"
                                      @else
                                      value="{{ $banner['title'] }}" @endif>
                        </div> 
                        <div class="col-12">
                            <label for="alt" class="form-label">Alt</label>
                            <input type="text" name="alt" class="form-control" id="alt"
                                @if (empty($banner['alt'])) value="{{ $banner['alt'] }}"
                                      @else
                                      value="{{ $banner['alt'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" name="status" class="form-control" id="status"
                                @if (empty($banner['status'])) value="{{ $banner['status'] }}"
                                      @else
                                      value="{{ $banner['status'] }}" @endif>
                        </div>
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
