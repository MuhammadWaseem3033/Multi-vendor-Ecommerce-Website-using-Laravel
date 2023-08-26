<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Api\StoreBrandRequest;
use App\Http\Resources\ApiResource;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendApicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Product::all();
        return Brand::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->name);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();
        return response()->json(
            [
                'massage' => 'task successfully Created',
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name =null ,  $id = null)
    {
        if ($id == "") {
            $brand = Brand::all();
        }else{
            $brand = Brand::find($id);
        }
        return response()->json([
            'success' => true,
            'massage' => 'your Brand is Show',
            'data' => $brand,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
