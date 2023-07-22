<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilterValue extends Model
{
    use HasFactory;
    protected $table = 'products_filters_values';
    public function productsFilter()
    {
        return $this->belongsTo(ProductsFilter::class);
    }
    // public function productfilter()
    // {
    //     return $this->belongsTo(ProductsFilter::class);
    // }
}
