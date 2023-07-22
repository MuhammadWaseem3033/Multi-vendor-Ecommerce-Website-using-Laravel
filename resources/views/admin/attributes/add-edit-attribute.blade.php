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
                    @if (session()->has('success_massage'))
                        <div class="col-12 alert alert-success bg-success text-light border-0
                         alert-dismissible fade show"
                            role="alert">
                            {{ session()->get('success_massage') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error_massage'))
                        <div class="col-12 alert alert-success bg-success text-light border-0
                     alert-dismissible fade show"
                            role="alert">
                            {{ session()->get('error_massage') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="row g-3" method="post" action="{{ url('admin/add-edit-attribute/' . $product['id']) }}">
                        @csrf

                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="product_name" class="form-label">Product Name</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;{{ $product['product_name'] }}
                        </div>
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="
                            " class="form-label">Product Code</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp; {{ $product['product_code'] }}
                        </div>
                        @error('product_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="product_color" class="form-label">Product Color</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;{{ $product['product_color'] }}
                        </div>
                        @error('product_color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="col-12">
                            <label for="product_price" class="form-label">Product Price</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;{{ $product['product_price'] }}
                        </div>
                        <div class="col-12">
                            @if (!empty($product['product_image']))
                                <img src="{{ asset('front/product/image/large/' . $product['product_image']) }}"
                                    height="100px">
                            @else
                                <img src="{{ asset('front/product/image/000000.webp') }}" height='100px'>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="field_wrapper">
                                <div>
                                    <input type="text" name="size[]" placeholder="Size" style="width: 120px;"
                                        required />
                                    <input type="text" name="sku[]" placeholder="SKU" style="width: 120px;" required />
                                    <input type="text" name="price[]" placeholder="Price" style="width: 120px;"
                                        required />
                                    <input type="text" name="stock[]" placeholder="Stock" style="width: 120px;"
                                        required />
                                    <a href="javascript:void(0);" class="add_button" title="Add field">
                                        <i class="bi bi-check-square"></i></a>
                                </div>
                            </div>
                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
                    <hr><br>
                    <form action="{{ url('admin/edit-attribute/' . $product['id']) }}" method="post">
                        @csrf
                        <table class="Attribute">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Section</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($product['attribute'] as $attribute)
                                <input style="display:none" type="text" name="attributeId[]" value="{{$attribute['id']}}">
                                    <tr>
                                        <th scope="row">{{ $attribute['id'] }}</th>
                                        <th scope="row">
                                           {{($attribute['size']) }}
                                        </th>
                                        <th scope="row">{{ $attribute['sku'] }}</th>
                                        <th scope="row">
                                            <input type="text" name="price[]"
                                                value="{{ $attribute['price'] }}"class="form-control">

                                        </th>
                                        <th scope="row">
                                            <input type="text" name="stock[]"
                                                value="{{ $attribute['stock'] }}"class="form-control">
                                        </th>
                                        <th scope="row">
                                            @if ($attribute['status'] == '1')
                                                <a href="javascript:void(0)" class="UpdateAttributeStatus"
                                                    id="attribute-{{ $attribute['id'] }}"
                                                    attribute_id="{{ $attribute['id'] }}"><i
                                                        class="bi bi-bookmark-check-fill" status="Active"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="UpdateAttributeStatus"
                                                    id="attribute-{{ $attribute['id'] }}"
                                                    attribute_id="{{ $attribute['id'] }}"><i class="bi bi-bookmark-check"
                                                        status="Inactive"></i></a>
                                            @endif
                                        </th>
                                        <th scope="row">
                                            <a title="product" class="confirmDelete"
                                                onclick="return confirm('Are you sure Delete this:'+title+'?')"
                                                href="{{ url('admin/delete-product/' . $product['id']) }}">
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                            <a href=""><i class=""></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Update Attibute</button>
                    </form>
                </div>


            </div>
        </div>

    </main><!-- End #main -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    // Add Edit Product Attribute
    $(document).ready(function() {
        $('.Attribute').DataTable();
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div><div style="height:10px"></div><input type="text" name="size[]"placeholder="Size" style="width: 120px;" required /><input type="text" name="sku[]"placeholder="sku" style="width: 120px;" required /> <input type="text" name="price[]"placeholder="Price" style="width: 120px;" required /> <input type="text" name="stock[]"placeholder="Size" style="width: 120px;" required /> <a href="javascript:void(0);" class="remove_button"> Remove<br></div>';
        //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
        // status updata
        $(document).on('click', '.UpdateAttributeStatus', function() {
            var status = $(this).children("i").attr("status");
            // alert(status);
            var attribute_id = $(this).attr("attribute_id");
            // alert(attribute_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "/admin/product-attribute-update-status",
                data: {
                    status: status,
                    attribute_id: attribute_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $('#attribute-' + attribute_id).html(
                            "<i class='bi bi-bookmark-check' status='Inactive'></i>");
                    } else if (resp['status'] == 1) {
                        $('#attribute-' + attribute_id).html(
                            "<i class='bi bi-bookmark-check-fill' status='Active'></i>");
                    }
                },
                error: function() {
                    alert('Error');
                }
            });
        });
    });
</script>
