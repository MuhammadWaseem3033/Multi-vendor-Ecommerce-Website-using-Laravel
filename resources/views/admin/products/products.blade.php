{{-- @dd($products) --}}
@extends('admin.layouts.main')

<body>
    @section('main.container')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>{{ $title }}- Tables</h1>
            </div><!-- End Page Title -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <a class="btn btn-info" style="float:right;margin-bottom:10px;"
                        href="{{ url('admin/add-edit-product') }}">Add Products</a>
                    <!-- Default Table -->
                    @if (session()->has('success_massage'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            {{ session()->get('success_massage') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close">
                            </button>
                        </div>
                    @endif
                    <table class="Product">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product color</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Section</th>
                                <th scope="col">Category</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product['product_name'] }}</th>
                                    <th scope="row">
                                        {{-- @dd($product['product_color'])  --}}
                                        @if (!empty($product['product_image']))
                                            <img src="{{ asset('front/product/image/large/' . $product['product_image']) }}"
                                                height="50px" style=" border-radius:5rem; ">
                                        @else
                                            <img src="{{ asset('front/product/image/000000.webp') }}" height='50px'
                                                style=" border-radius:5rem; ">
                                        @endif
                                    </th>
                                    <th scope="row">{{ $product['product_color'] }}</th>
                                    <th scope="row">
                                        @if ($product['admin_type'] == 'vendor')
                                            <a target="_blank"
                                                href={{ url('admin/view-vendor-details/' . $product['admin_id']) }}>
                                                {{ ucfirst($product['admin_type']) }}</a>
                                        @else
                                            {{ ucfirst($product['admin_type']) }}
                                        @endif
                                    </th>
                                    <th scope="row">{{ $product['section']['name'] }}</th>
                                    <th scope="row">{{ $product['category']['category_name'] }}</th>
                                    <th scope="row">{{ $product['brand']['name'] }}</th>
                                    <th scope="row">
                                        @if ($product['status'] == '1')
                                            <a href="javascript:void(0)" class="UpdateproductStatus"
                                                id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}"><i
                                                    class="bi bi-bookmark-check-fill" status="Active"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="UpdateproductStatus"
                                                id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}"><i
                                                    class="bi bi-bookmark-check" status="Inactive"></i></a>
                                        @endif
                                    </th>
                                    <th scope="row">
                                        <a title="Edit Product" href="{{ url('admin/add-edit-product/' . $product['id']) }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </a>
                                        <a title="Delete Product" class="confirmDelete"
                                            onclick="return confirm('Are you sure Delete this:'+title+'?')"
                                            href="{{ url('admin/delete-product/'.$product['id']) }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                        <a title="Add Attribute" href="{{ url('admin/add-edit-attribute/'.$product['id']) }}"> <i
                                            class="bi bi-plus-square"></i>
                                        </a>
                                        <a title="Add Multipule Images" href="{{url('admin/Add-Images/'.$product['id'])}}"><i class="bi bi-images"></i></a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </main>
    @endsection
    @section('custom.js')
        <script>
            $(document).ready(function() {
                $('.Product').DataTable();
            });
            $(document).on('click', '.UpdateproductStatus', function() {
                // custom Datatable 
                var status = $(this).children("i").attr("status");
                // alert(status);
                var product_id = $(this).attr("product_id");
                // alert(product_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/admin/product-update-status",
                    data: {
                        status: status,
                        product_id: product_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $('#product-' + product_id).html(
                                "<i class='bi bi-bookmark-check' status='Inactive'></i>");
                        } else if (resp['status'] == 1) {
                            $('#product-' + product_id).html(
                                "<i class='bi bi-bookmark-check-fill' status='Active'></i>");
                        }
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            });
        </script>
    @endsection
