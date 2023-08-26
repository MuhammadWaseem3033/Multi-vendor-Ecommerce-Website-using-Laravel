<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->inRandomOrder()->take(4)->get();
        return view('frontend.index')->with(compact('products'));
    }
}
