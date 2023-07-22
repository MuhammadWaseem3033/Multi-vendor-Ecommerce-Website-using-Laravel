<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function Brands()
    {
        $brands = Brand::get()->toArray(); 
        $title = 'Brands';        
        return view('admin.brands.brands')->with(compact('brands', 'title'));
    }
    public function brandsUpdateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
    public function addEditBrands(Request $request, $id = null)
    {
        if ($id=="") {
            $title = "Add brands";
            $brand = new Brand;
            $massage = "Add new brand Successfully";
        } else {
            $title = "Edit brands";
            $brand = Brand::find($id);
            $massage = "Update brand Successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customValidate = [
                'brand_name.required' => 'Name is Required ',
            ];
            $this->validate($request, $rules, $customValidate);
            $brand->name = $data['brand_name'];
            $brand->status = 1 ;
            $brand->save();

            return redirect('admin/brands')->with('massage',"Your are successfully Adding the New Row");
        }
        return view('admin.brands.add-edit-brand')->with(compact('title', 'massage', 'brand'));
    }
    public function destroyBrand(Request $request, $id)
    {
        Brand::where('id', $id)->delete();
        $massage = "Delete The Massage SuccessFully";
        return redirect()->back()->with('success_massage', $massage);
    }
}
