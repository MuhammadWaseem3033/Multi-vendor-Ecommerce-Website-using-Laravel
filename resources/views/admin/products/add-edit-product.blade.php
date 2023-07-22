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
                        <div class="col-6 alert alert-success bg-success text-light border-0
                         alert-dismissible fade show"
                            role="alert">
                            {{ session()->get('massage') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span>
                        @endforeach
                    @endif
                    <form class="row g-3" method="post" enctype="multipart/form-data"
                        @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}"
                            @else
                            action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif>
                        @csrf
                        <div class="col-12">
                            <label for="category_id" class="form-label">Category Select</label>
                            <select name="category_id" id="category_id" class="form-control text-dark">
                                <option value="">Select</option>
                                @foreach ($categories as $section)
                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                    @foreach ($section['categroies'] as $category)
                                        <option @if (!empty($product['category_id'] == $category['id'])) selected="" @endif
                                            value="{{ $category['id'] }}">
                                            &nbsp;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                        @foreach ($category['subcategries'] as $subcategory)
                                            <option @if (!empty($product['category_id'] == $subcategory['id'])) selected="" @endif
                                                value="{{ $subcategory['id'] }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;{{ $subcategory['category_name'] }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="brand_id" class="form-label">Brand name</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                <option value="">Brand Select</option>
                                @foreach ($brands as $brand)
                                    <option @if (!empty($product['brand_id'] == $brand['id'])) selected @endif value="{{ $brand['id'] }}">
                                        {{ $brand['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="group_code" class="form-label">Group Code</label>
                            <input type="text" name="group_code" class="form-control" id="group_code"
                                @if (empty($product['group_code'])) value="{{ $product['group_code'] }}"
                                      @else
                                      value="{{ $product['group_code'] }}" @endif>
                        </div>

                        <div class="col-12">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" id="product_name"
                                @if (empty($product['product_name'])) value="{{ $product['product_name'] }}"
                                      @else
                                      value="{{ $product['product_name'] }}" @endif>
                        </div>
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" name="product_code" class="form-control" id="product_code"
                                @if (empty($product['product_code'])) value="{{ $product['product_code'] }}"
                                      @else
                                      value="{{ $product['product_code'] }}" @endif>
                        </div>
                        @error('product_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="product_color" class="form-label">Product Color</label>
                            <input type="text" name="product_color" class="form-control" id="product_color"
                                @if (empty($product['product_color'])) value="{{ $product['product_color'] }}"
                                      @else
                                      value="{{ $product['product_color'] }}" @endif>
                        </div>
                        @error('product_color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="text" name="product_price" class="form-control" id="product_price"
                                @if (empty($product['product_price'])) value="{{ $product['product_price'] }}"
                                      @else
                                      value="{{ $product['product_price'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="product_discount" class="form-label">Product Dicount(%)</label>
                            <input type="text" name="product_discount" class="form-control" id="product_discount"
                                @if (empty($product['product_discount'])) value="{{ $product['product_discount'] }}"
                                      @else
                                      value="{{ $product['product_discount'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="product_weight" class="form-label">Product Weight</label>
                            <input type="text" name="product_weight" class="form-control" id="product_weight"
                                @if (empty($product['product_weight'])) value="{{ $product['product_weight'] }}"
                                      @else
                                      value="{{ $product['product_weight'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="discription" class="form-label">discription</label>
                            <input type="text" name="discription" class="form-control" id="discription"
                                @if (empty($product['discription'])) value="{{ $product['discription'] }}"
                                      @else
                                      value="{{ $product['discription'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                @if (empty($product['meta_title'])) value="{{ $product['meta_title'] }}"
                                      @else
                                      value="{{ $product['meta_title'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="meta_discription" class="form-label">Meta discription</label>
                            <input type="text" name="meta_discription" class="form-control" id="meta_discription"
                                @if (empty($product['meta_discription'])) value="{{ $product['meta_discription'] }}"
                                      @else
                                      value="{{ $product['meta_discription'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="meta_kaywords" class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_kaywords" class="form-control" id="meta_kaywords"
                                @if (empty($product['meta_kaywords'])) value="{{ $product['meta_kaywords'] }}"
                                      @else
                                      value="{{ $product['meta_kaywords'] }}" @endif>
                        </div>
                        <div class="col-12">
                            <label for="is_featured" class="form-label">Is Feature</label>
                            <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                                @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked="" @endif>
                        </div>
                        <div class="col-md-8 col-lg-12">
                            @if (!empty($product['product_image']))
                                <div>
                                    <a href="{{ url('front/product/image/small/' . $product['product_image']) }}">
                                        <img src="{{ asset('front/product/image/small/' . $product['product_image']) }}"
                                            width="80px" style=" border-radius:5rem;" />
                                    </a>
                                </div>
                                <a target="_blank"
                                    href="{{ url('front/product/image/small/' . $product['product_image']) }}">view
                                    image / </a>
                                <a title="product" href="{{ url('admin/delete-product-image/' . $product['id']) }}">Delete
                                    image </a>
                            @else
                                <img src="{{ asset('front/product/image/000000.webp') }}" height='50px'
                                    style=" border-radius:5rem; ">
                            @endif
                            <div class="col-12 text-dark">
                                <label for="product_image" class="form-label">Product Image (Recoemended Size: 1000 x
                                    1000)</label>
                                <input type="file" name="product_image" class="form-control" id="product_image"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12">
                            @if (!empty($product['product_vedio']))
                                <div>
                                    <a href="{{ url('front/product/vedio' . $product['product_vedio']) }}">
                                        <img src="{{ url('front/product/vedio' . $product['product_vedio']) }}"
                                            width="80px" />
                                    </a>
                                </div>
                                <a target="_blank" href="{{ url('front/product/vedio' . $product['product_vedio']) }}">view
                                    vedio/ </a>
                                {{-- <a title="product" class="confirmDeleteimage" module="product-image"
                                    moduleid="{{ $product['id'] }}"  --}}
                                    {{-- onclick="return confirm('Are you sure Delete this:'+title+'?')"  --}} 
                                    {{-- href="javascript:void(0)">Delete
                                    image </a> --}}
                            @endif
                            <div class="col-12">
                                <label for="product_vedio" class="form-label">Video Image (Recoemended Size:less the 2
                                    pm)</label>
                                <input type="file" name="product_vedio" class="form-control" id="product_vedio"
                                    value="">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" name="status" class="form-control" id="status"
                                @if (empty($product['status'])) value="{{ $product['status'] }}"
                                                  @else
                                                  value="{{ $product['status'] }}" @endif>
                        </div>
                        <h5>Select for Filter Your Product</h5>
                        <div class="loadFilters">
                            @include('admin.filters.category_filter')
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
    <script>
        $(document).ready(function() {
            $('#category_id').on('change', function() {
                var category_id = $(this).val();
                // alert(category_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "category-filters",
                    data: {category_id:category_id},
                    success: function (response) {
                        $('.loadFilters').html(response.view);
                    }
                });
            });
            $('.confirmDeleteimage').click(function() {
                var module = $(this).attr('module');
                // alert(module);
                var moduleid = $(this).attr('moduleid');
                // alert(moduleid);
                Swal.fire({
                    title: 'Are you sure Deleted This:',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.confirmDelete) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // alert('done');
                        window.location = "/admin/dalete-" + module + "/" + moduleid;
                    }
                })
            });
        });
    </script>
@endsection
