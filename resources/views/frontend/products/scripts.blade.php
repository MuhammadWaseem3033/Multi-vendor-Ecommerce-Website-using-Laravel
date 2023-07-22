<?php use App\Models\ProductsFilter;
$productsFilters = ProductsFilter::productgetvalue();
//  dd($productsFilters);die;
?>
<script>
    $(document).ready(function() {
        // sort by filter
        $('#sort').on('change', function() {
            // this.form.submit();
            var sort = $('#sort').val();
            var url = $('#url').val();
            // add two more filter in sort 
            var color = get_filter('color');
            var size = get_filter('size');
            var price = get_filter('price');
            var brand = get_filter('brand');

            // add two more filter end 
            @foreach ($productsFilters as $filters)
                var {{ $filters['filter_culumn'] }} = get_filter('{{ $filters['filter_culumn'] }}');
            @endforeach
            // alert(url);
            // return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: {
                    @foreach ($productsFilters as $filters)
                        {{ $filters['filter_culumn'] }}: {{ $filters['filter_culumn'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color: color,
                    price: price,
                    brand:brand,
                },
                success: function(data) {
                    $('.filter_products').html(data);
                },
                error: function() {
                    alert('Error');
                }
            });
        });
        // just pick the one value of the filter 

        // sort by Sizes
        $('.size').on('change', function() {
            // this.form.submit();
            var size = get_filter('size');
            // alert(size);
            var sort = $('#sort').val();
            var price = $('#price').val();
            var url = $('#url').val();
            @foreach ($productsFilters as $filters)
                var {{ $filters['filter_culumn'] }} = get_filter('{{ $filters['filter_culumn'] }}');
            @endforeach
            // alert(url);
            // return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: {
                    @foreach ($productsFilters as $filters)
                        {{ $filters['filter_culumn'] }}: {{ $filters['filter_culumn'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    price: price,
                },
                success: function(data) {
                    $('.filter_products').html(data);
                },
                error: function() {
                    alert('Error');
                }
            });
        });
        // filter by color of the prduct
        $('.color').on('change', function() {
            // this.form.submit();
            var color = get_filter('color');
            var size = get_filter('size');
            // alert(size);
            var sort = $('#sort').val();
            var url = $('#url').val();
            @foreach ($productsFilters as $filters)
                var {{ $filters['filter_culumn'] }} = get_filter('{{ $filters['filter_culumn'] }}');
            @endforeach
            // alert(url);
            // return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: {
                    @foreach ($productsFilters as $filters)
                        {{ $filters['filter_culumn'] }}: {{ $filters['filter_culumn'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color,
                    color,
                },
                success: function(data) {
                    $('.filter_products').html(data);
                },
                error: function() {
                    alert('Error');
                }
            });
        });
        $('.price').on('change', function() {
            // this.form.submit();
            var price = get_filter('price');
            // alert(price);
            var color = get_filter('color');
            var size = get_filter('size');
            // alert(size);
            var sort = $('#sort').val();
            var url = $('#url').val();
            @foreach ($productsFilters as $filters)
                var {{ $filters['filter_culumn'] }} = get_filter('{{ $filters['filter_culumn'] }}');
            @endforeach
            // alert(url);
            // return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: {
                    @foreach ($productsFilters as $filters)
                        {{ $filters['filter_culumn'] }}: {{ $filters['filter_culumn'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color: color,
                    price: price
                },
                success: function(data) {
                    $('.filter_products').html(data);
                },
                error: function() {
                    alert('Error');
                }
            });
        });
        // filter for brands
        $('.brand').on('change', function() {
            // this.form.submit();
            var brand = get_filter('brand');
            // alert(brand );/

            var price = get_filter('price');
            // alert(price);
            var color = get_filter('color');
            var size = get_filter('size');
            // alert(size);
            var sort = $('#sort').val();
            var url = $('#url').val();
            @foreach ($productsFilters as $filters)
                var {{ $filters['filter_culumn'] }} = get_filter('{{ $filters['filter_culumn'] }}');
            @endforeach
            // alert(url);
            // return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: url,
                data: {
                    @foreach ($productsFilters as $filters)
                        {{ $filters['filter_culumn'] }}: {{ $filters['filter_culumn'] }},
                    @endforeach
                    url: url,
                    sort: sort,
                    size: size,
                    color: color,
                    price: price,
                    brand: brand,
                },
                success: function(data) {
                    $('.filter_products').html(data);
                },
                error: function() {
                    alert('Error');
                }
            });
        });
        // using foreach for ALL the filter dynamicly show 
        @foreach ($productsFilters as $filter)
            $('.{{ $filter['filter_culumn'] }}').on('click', function() {
                var url = $('#url').val();
                var price = $get_filter('price');
                var brand = get_filter('brand');
                var size = $get_filter('size');
                var color = $get_filter('color');
                var sort = $('#sort option:selected').val();
                @foreach ($productsFilters as $filters)
                    var {{ $filters['filter_culumn'] }} = get_filter(
                        '{{ $filters['filter_culumn'] }}');
                @endforeach
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: "post",
                    data: {
                        @foreach ($productsFilters as $filters)
                            {{ $filters['filter_culumn'] }}: {{ $filters['filter_culumn'] }},
                        @endforeach
                        url: url,
                        sort: sort,
                        price: price,
                        size: size,
                        color: color,
                        brand:brand,
                    },
                    success: function(data) {
                        $('.filter_products').html(data);
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            });
        @endforeach


    });
</script>
