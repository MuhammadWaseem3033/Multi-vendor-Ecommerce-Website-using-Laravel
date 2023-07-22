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
                        @if (empty($filter['id'])) action="{{ url('admin/add-edit-filter') }}"
                        @else
                        action="{{ url('admin/add-edit-filter/' . $filter['id']) }}" @endif>
                        @csrf
                        <div class="col-12">
                            <label for="cat_ids" class="form-label">Category Select</label>
                            <select name="cat_ids[]" id="cat_ids" class="form-control text-dark" multiple>
                                <option value="">Select</option>
                                @foreach ($categroies as $section)
                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                    @foreach ($section['categroies'] as $category)
                                        <option
                                         @if (!empty($filter['category_id']==$category['id'])) 
                                         selected=""          
                                         @endif
                                         value="{{ $category['id'] }}">
                                            &nbsp;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                        @foreach ($category['subcategries'] as $subcategory)
                                            <option  
                                            @if (!empty($filter['category_id']==$subcategory['id'])) 
                                            selected=""          
                                            @endif
                                            value="{{ $subcategory['id'] }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;{{ $subcategory['category_name'] }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="filter_name" class="form-label">Name</label>
                            <input type="text" name="filter_name" class="form-control" id="filter_name"
                                @if (empty($filter['filter_name'])) value="{{ $filter['filter_name'] }}"
                                      @else
                                      value="{{ $filter['filter_name'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="filter_culumn" class="form-label">Filter Columns</label>
                            <input type="text" name="filter_culumn" class="form-control" id="filter_culumn"
                                @if (empty($filter['filter_culumn'])) value="{{ $filter['filter_culumn'] }}"
                                      @else
                                      value="{{ $filter['filter_culumn'] }}" @endif>
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
