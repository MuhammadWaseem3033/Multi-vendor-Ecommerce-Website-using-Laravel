<?php use App\Models\Product ;?>
@extends('frontend.layout.layout')
@section('content')
  <!-- Page Introduction Wrapper -->
  <div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>{{$getvendorShop}}</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">{{$getvendorShop}}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
   <!-- Shop-Page -->
   <div class="page-shop u-s-p-t-80">
    <div class="container">
        <!-- Shop-Intro -->
        <div class="shop-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <a href="{{url('/')}}">Home</a>
                </li>
               <?php /* echo $categoryDetails['Breadcrums'] */ ?>
            </ul>
        </div>
        <!-- Shop-Intro /- -->
        <div class="row">
            <!-- Shop-Left-Side-Bar-Wrapper -->
            {{-- @include('frontend.products.filters') --}}
            <!-- Shop-Left-Side-Bar-Wrapper /- -->
            <!-- Shop-Right-Wrapper -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- Page-Bar -->
                <div class="page-bar clearfix">
                    <div class="shop-settings">
                        <a id="list-anchor" >
                            <i class="fas fa-th-list"></i>
                        </a>
                        <a id="grid-anchor" class="active">
                            <i class="fas fa-th"></i>
                        </a>
                    </div>
                    <!-- Toolbar Sorter 1  -->
                    {{-- <form name="sortProducts" id="sortProducts">
                        @csrf
                        <input type="hidden" name="url" id="url" value="{{$url}}" >
                    <div class="toolbar-sorter">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="sort-by">Sort By</label>
                            <select name="sort" class="select-box" id="sort">
                                <option selected value="">Filter Product</option>
                                <option value="product_latest" @if (isset($_GET['sort']) && $_GET['sort']=='product_latest')
                                    selected @endif>Sort By: Latest</option>
                                <option value="product_lowest" @if (isset($_GET['sort']) && $_GET['sort']=='product_lowest')
                                selected @endif>Sort By: Lowest Price</option>
                                <option value="product_highest" @if (isset($_GET['sort']) && $_GET['sort']=='product_highest')
                                selected @endif>Sort By: Highest Price</option>
                                <option value="name_z_a" @if (isset($_GET['sort']) && $_GET['sort']=='name_z_a')
                                selected @endif>Sort By: Name A==Z</option>
                                <option value="name_a_z" @if (isset($_GET['sort']) && $_GET['sort']=='name_a_z')
                                selected @endif>Sort By: Name Z==A</option>
                            </select>
                        </div>
                    </div>
                </form> --}}
                    <!-- //end Toolbar Sorter 1  -->
                    <!-- Toolbar Sorter 2  -->
                    {{-- <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Show: 8</option>
                                <option value="">Show: 16</option>
                                <option value="">Show: 28</option>
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Showing:&nbsp; {{count($categoryProducts)}}</option>
                                <option value="">Showing: All</option>
                               
                            </select>
                        </div>
                    </div> --}}
                    <!-- //end Toolbar Sorter 2  -->
                </div>
                <!-- Page-Bar /- -->
                <!-- Row-of-Product-Container -->
                <div class="">
                    @include('frontend.products.vendor_product_listing')
                </div>
                <!-- Row-of-Product-Container /- -->
                @if (isset($_GET['sort']))
                <div>{{$vendorProducts->appends(['sort'=>$_GET['sort']])->links()}}</div>
                @else
                <div>{{$vendorProducts->links()}}</div>
                @endif
            </div>
            <!-- Shop-Right-Wrapper /- -->
            <!-- Shop-Pagination -->
            {{-- <div class="pagination-area">
                <div class="pagination-number">
                    <ul>
                        <li style="display: none">
                            <a href="#" title="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">...</a>
                        </li>
                        <li>
                            <a href="#">10</a>
                        </li>
                        <li>
                            <a href="#" title="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <!-- Shop-Pagination /- -->
        </div>
    </div>
</div>
<!-- Shop-Page /- -->
@endsection