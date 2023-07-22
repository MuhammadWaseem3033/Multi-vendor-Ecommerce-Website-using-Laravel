<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Gd\Commands\InsertCommand;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function vendor()
    {
        return $this->belongsTo(vendor::class, 'vendor_id')->with('vendorBussinessDetails');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function attribute()
    {
        return $this->hasMany(Products_Attribute::class);
    }
    public function Addimage()
    {
        return $this->hasMany(ProductsImage::class);
    }
    public static function getProductNew($product_id)
    {
        $productIds = Product::select('id')->where('status', 1)->orderby('id', 'Desc')->limit(3)->pluck('id');
        $productIds = json_decode(json_encode($productIds), true);
        if (in_array($product_id, $productIds)) {
            $isProductNew = 'Yes';
        } else {
            $isProductNew = 'No';
        }
        return $isProductNew;
    }
    public static function getDiscountPrice($product_id)
    {
        $proDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
        $proDetails = json_decode(json_encode($proDetails), true);
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first();
        $catDetails = json_decode(json_encode($catDetails), true);
        if ($proDetails['product_discount'] > 0) {
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
        } else if ($catDetails['category_discount'] > 0) {
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);
        } else {
            $discounted_price = 0;
        }
        return  $discounted_price;
    }
    // public static function getDiscountAttributePrice($product_id, $size)
    // {
    //     $proAttrPrice = Products_Attribute::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();
    //     $proDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
    //     $proDetails = json_decode(json_encode($proDetails), true);
    //     $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first();
    //     $catDetails = json_decode(json_encode($catDetails), true);
    //     if ($proDetails['product_discount'] > 0) {

    //         $final_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount'] / 100);
    //         $discount = $proAttrPrice['price'] - $final_price ;

    //     } else if ($catDetails['category_discount'] > 0) {

    //         $final_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['category_discount'] / 100);
    //         $discount = $proAttrPrice['price'] - $final_price ;

    //     } else {
    //         $final_price = $proAttrPrice['price'];
    //         $discount = 0 ;
    //     }
    //     return  array(['product_price'=>$proAttrPrice['price'],'final_price'=>$final_price , 'discount'=>$discount]);
    // }
    public static function getDiscountAttributePrice($product_id, $size)
{
    $proAttrPrice = Products_Attribute::where(['product_id' => $product_id, 'size' => $size])->first();

    if (!$proAttrPrice) {
        // Handle case when no matching product attribute is found
        return null;
    }

    $proDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
    $catDetails = Category::select('category_discount')->where('id', $proDetails->category_id)->first();

    $final_price = $proAttrPrice->price;
    $discount = 0;

    if ($proDetails->product_discount > 0) {
        $final_price -= ($proAttrPrice->price * $proDetails->product_discount / 100);
        $discount = $proAttrPrice->price - $final_price;
    } else if ($catDetails->category_discount > 0) {
        $final_price -= ($proAttrPrice->price * $catDetails->category_discount / 100);
        $discount = $proAttrPrice->price - $final_price;
    }

    return [
        'product_price' => $proAttrPrice->price,
        'final_price' => $final_price,
        'discount' => $discount,
    ];
}

}
