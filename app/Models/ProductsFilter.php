<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilter extends Model
{
    use HasFactory;
    public function filter_values()
    {
        return $this->hasMany(ProductsFilterValue::class ,'filter_id');
    }
    public static function productgetvalue()
    {
        $productgetvalue = ProductsFilter::with('filter_values')->where('status',1)->get()->toArray();
        // dd($productgetvalue);
        return $productgetvalue ; 
    }
    public static function getfilterName($filter_id)
    {
        $getfilterName = ProductsFilter::select('filter_name')->where('id', $filter_id)->get()->first();
        // dd($getfilterName);die;
        if ($getfilterName) {
            return $getfilterName->filter_name;
        dd($getfilterName->filter_name);

        } else {
            dd('null');
            return null; // or any appropriate fallback value
        }
    }
    public static function filter_availible($filter_id,$category_id)
    {
        $filter_availible = ProductsFilter::select('cat_ids')->where(['id'=>$filter_id,'status'=>1])->first()->toArray();
        $cateIdsArr = explode(",",$filter_availible['cat_ids']);
        if (in_array($category_id,$cateIdsArr)) {
            $availble = 'Yes';
        }else
        {
            $availble = 'No';
        }
        return $availble ;
    }
    public static function getSizes($url)
    {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::select('id')->whereIn('category_id',$categoryDetails['catIds'])->pluck('id')->toArray();
        $getProductSizes = Products_Attribute::select('size')->whereIn('product_id',$getProductIds)->groupby('size')->pluck('size')->toArray();
        // echo '<pre>';
        // print_r($getProductSizes);die;
        return $getProductSizes ;
    }
    public static function getColors($url)
    {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::select('id')->whereIn('category_id',$categoryDetails['catIds'])->pluck('id')->toArray();
         $getColors = Product::select('product_color')->whereIn('id',$getProductIds)->groupBy('product_color')->pluck('product_color')->toArray();
        return $getColors ;
    }
    public static function getBrands($url)
    {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::select('id')->whereIn('category_id',$categoryDetails['catIds'])->pluck('id')->toArray();  //yha pr category ki id aati haa 
         $getBrandIds = Product::select('brand_id')->whereIn('id',$getProductIds)->groupBy('brand_id')->pluck('brand_id')->toArray(); // yha us k sath brand id bhi aati haa 
         $brandDetails = Brand::select('id','name')->whereIn('id',$getBrandIds)->get()->toArray(); // yha pr brand ki id k sath name ka bhi chaek lgaya haa 
        //  echo '<pre>';
        //  print_r($brandDetails);
        return $brandDetails ;
    }
}
