{{-- @dd($section) --}}
@extends('admin.layouts.main')
    @section('main.container')
        <main id="main" class="main">
{{-- @dd($countries) --}}
            <div class="pagetitle">
                <h1>Add Sections</h1>
            </div><!-- End Page Title -->
            <div class="row">
                <div class="card col-9"style="border: 3px dashed blue;">
                        <div class="card-body">
                            <h5 class="card-title">{{$title}}</h5>
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
                            @if(empty($section['id']))
                            action="{{ url('admin/add-edit-section') }}"
                            @else
                            action="{{ url('admin/add-edit-section/'.$section['id']) }}"
                            @endif >
                            @csrf
                                <div class="col-12">
                                    <label for="section_name" class="form-label">Name</label>
                                    <input type="text" name="section_name" class="form-control" id="section_name"
                                      @if(empty($section['name']))
                                      value="{{ $section['name'] }}"
                                      @else
                                      value="{{ $section['name']}}"                                          
                                      @endif >
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