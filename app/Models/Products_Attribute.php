<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products_Attribute extends Model
{
    use HasFactory;
    public static function isStockAvailible($product_id , $size)
    {
            $isStockavailible = Products_Attribute::select('stock')->where(['product_id'=>$product_id,'size'=>$size])->first();
            if ($isStockavailible) {

                return $isStockavailible->stock;
            }
    }
}
