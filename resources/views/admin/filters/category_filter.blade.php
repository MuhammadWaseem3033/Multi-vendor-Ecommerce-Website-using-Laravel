<?php use App\Models\ProductsFilter;
$productsFilters = ProductsFilter::productgetvalue();
//  dd($productsFilters);die;
if (isset($product['category_id'])) {
    $category_id = $product['category_id'] ;
}
?>
@foreach ($productsFilters as $productsFilter)
    @if (isset($category_id))
        <?php
        $filterAvailible = ProductsFilter::filter_availible($productsFilter['id'], $category_id);
        ?>
        @if ($filterAvailible == 'Yes')
            <div class="col-12"> 
                <label for="{{ $productsFilter['filter_culumn'] }}" class="form-label">Select
                    {{ $productsFilter['filter_name'] }}</label>
                <select name="{{ $productsFilter['filter_culumn'] }}" id="{{ $productsFilter['filter_culumn'] }}"
                    class="form-control">
                    <option value="">Select {{ $productsFilter['filter_culumn'] }}</option>
                    @foreach ($productsFilter['filter_values'] as $filtervalue)
                        <option value="{{ $filtervalue['filter_value'] }}"
                         @if (!empty($product[$productsFilter['filter_culumn']]) && $filtervalue['filter_value'] == $product[$productsFilter['filter_culumn']])
                            selected
                        @endif>{{ $filtervalue['filter_value'] }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    @endif
@endforeach
