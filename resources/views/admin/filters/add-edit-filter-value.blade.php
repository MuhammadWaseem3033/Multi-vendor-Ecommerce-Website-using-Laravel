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
                        @if (empty($filter['id'])) action="{{ url('admin/add-edit-filter-value') }}"
                        @else
                        action="{{ url('admin/add-edit-filter-value/' . $filter['id']) }}" @endif>
                        @csrf
                        <div class="col-12">
                            <label for="filter_id" class="form-label">Filter ID</label>
{{-- 
                            <input type="text" name="filter_id" class="form-control" id="filter_id"
                                @if (empty($filterValue['filter_id'])) value="{{ $filterValue['filter_id'] }}"
                                      @else
                                      value="{{ $filterValue['filter_id'] }}" @endif> --}}
                        <select name="filter_id" id="filter_id" class="form-control">
                            <option value="">Select one</option>
                            @foreach ($filterValuegets as $filter)
                            <option value="{{$filter['id']}}">{{$filter['filter_name']}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-12">
                            <label for="filter_value" class="form-label">Filter Value </label>
                            <input type="text" name="filter_value" class="form-control" id="filter_value"
                                @if (empty($filterValue['filter_value'])) value="{{ $filterValue['filter_value'] }}"
                                      @else
                                      value="{{ $filterValue['filter_value'] }}" @endif>
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
