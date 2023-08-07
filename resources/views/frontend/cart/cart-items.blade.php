<?php use App\Models\Product; ?>
<form>
    <!-- Products-List-Wrapper -->
    <div class="table-wrapper u-s-m-b-60">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_price = 0;
                @endphp
                @foreach ($getCartItems as $item)
                    <?php $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']); ?>
                    {{-- {{ dd($getDiscountAttributePrice) }}    --}}
                    <tr>
                        <td>
                            <div class="cart-anchor-image">
                                <a href="/product/{{ $item['product']['id'] }}">
                                    @if (isset($item['product']['product_image']))
                                        <img src="{{ asset('front/product/image/small/' . $item['product']['product_image']) }}"
                                            alt="Product">
                                    @endif
                                    <h6>Name:{{ $item['product']['product_name'] }}
                                        <b>({{ $item['product']['product_code'] }}) </b> -
                                        {{ $item['size'] }} <br>
                                        Color:{{ $item['product']['product_color'] }}
                                    </h6>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="cart-price">
                                @if ($getDiscountAttributePrice['discount'] > 0)
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            Rs : {{ $getDiscountAttributePrice['final_price'] }}
                                        </div>

                                        <div class="item-old-price" style="margin-left: -3rem ;">
                                            Rs :{{ $getDiscountAttributePrice['product_price'] }}
                                        </div>
                                    </div>
                                @else
                                    <div class="price-template">
                                        <div class="item-new-price">
                                            Rs : {{ $getDiscountAttributePrice['product_price'] }}
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="cart-quantity">
                                <div class="quantity">
                                    <input type="text" class="quantity-text-field" value="{{ $item['quantity'] }}">
                                    <a class="plus-a updateCartItem" data-id="{{ $item['id'] }}"
                                        data-qty="{{ $item['quantity'] }}" data-max="100">&#43;</a>
                                    <a class="minus-a updateCartItem" data-id="{{ $item['id'] }}"
                                        data-qty="{{ $item['quantity'] }}" data-min="1">&#45;</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="cart-price">
                                <div class="price-templete">
                                    <div class="item-new-price">
                                        Rs: {{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="action-wrapper">
                                {{-- <button class="button button-outline-secondary fas fa-sync"></button> --}}
                                <a href="javascript:;"
                                    class="button button-outline-secondary fas fa-trash deleteCartItems"
                                    data-id="{{ $item['id'] }}"></a>
                            </div>
                        </td>
                    </tr>
                    @php
                        $total_price = $total_price + $getDiscountAttributePrice['final_price'] * $item['quantity'];
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Products-List-Wrapper /- -->
    <!-- Coupon -->
    <div class="coupon-continue-checkout u-s-m-b-60">
        <div class="coupon-area">
            <h6>Enter your coupon code if you have one.</h6>
            <div class="coupon-field">
                <label class="sr-only" for="coupon-code">Apply Coupon</label>
                <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code">
                <button type="submit" class="button">Apply Coupon</button>
            </div>
        </div>
        <div class="button-area">
            <a href="shop-v1-root-category.html" class="continue">Continue Shopping</a>
            <a href="checkout.html" class="checkout">Proceed to Checkout</a>
        </div>
    </div>
    <!-- Coupon /- -->
</form>
<!-- Billing -->
<div class="calculation u-s-m-b-60">
    <div class="table-wrapper-2">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Cart Totals</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Sub Total</h3>
                    </td>
                    <td>
                        <span class="calc-text">Rs : {{ $total_price }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Coupon Discount</h3>
                    </td>
                    <td>
                        <span class="calc-text">Rs: 0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Grand Total</h3>
                    </td>
                    <td>
                        <span class="calc-text">{{ $total_price }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Billing /- -->
<!-- Include jQuery library (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Your custom JavaScript -->
<script>
    $(document).on('click', '.updateCartItem', function() {
        var quantity = $(this).data('qty');
        var new_qty;

        if ($(this).hasClass('plus-a')) {
            new_qty = parseInt(quantity) + 1;
        } else if ($(this).hasClass('minus-a')) {
            if (quantity <= 1) {
                alert("Quantity must be at least one.");
                return false;
            }
            new_qty = parseInt(quantity) - 1;
        }

        var cartid = $(this).data('id'); // Use data-id instead of data-cartid

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/cart/update', // Use the correct URL for the Laravel route
            data: {
                id: cartid,
                qty: new_qty
            }, // Use 'id' instead of 'cartid' to match the PHP code
            success: function(resp) {
                if (resp.status == false) {
                    alert(resp.massage);
                }
                $('.appendCartItems').html(resp.view);
            },
            error: function() {
                alert('Error');
            }
        });

    });

    $(document).on('click', '.deleteCartItems', function() {
        var cartid = $(this).data('id');
        var result = confirm("Are you sure to delete the this cart Items ?");
        if (result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/cart/delete',
                data: {
                    cartid: cartid
                },
                success: function(resp) {
                    $('.appendCartItems').html(resp.view);
                },
                error: function() {
                    alert('Error');
                }
            });
        }

    });
</script>
