<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    public function vendorBussinessDetails(){
        return $this->belongsTo(VendorsBusinessDetail::class,'id','vendor_id');
    }
    public static function getVendorShop($vendorid){
        // $getvendorShop = VendorsBusinessDetail::select('shop_name')->where('vendor_id',$vendorid)->first()->toArray() ?? [];
        $getvendorShop = VendorsBusinessDetail::select('shop_name')->where('vendor_id', $vendorid)->first()->toArray() ?? [];
        return $getvendorShop['shop_name'];
    }
}
