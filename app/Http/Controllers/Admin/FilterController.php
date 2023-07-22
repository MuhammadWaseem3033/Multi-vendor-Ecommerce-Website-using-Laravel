<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductsFilter;
use App\Models\ProductsFilterValue;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FilterController extends Controller
{
    public function filters()
    {
        $filters = ProductsFilter::get()->toArray();
        $title = 'FiltersProducts';
        // dd($filters);die;
        return view('admin.filters.filter', compact('title', 'filters'));
    }
    public function AddEditFilter(Request $request, $id = null)
    {
        if ($id == "") {
            $title = 'Add Filter';
            $filter = new ProductsFilter;
            // $categories = Category::select('category_name')->get()->toArray();
            $massage =  'Filter Add Successfully ';
            // dd($categories);die;
        } else {
            $title = 'Edit Filter';
            $filter = ProductsFilter::find($id);
            // $categories = Category::select('category_name')->get()->toArray();
            $massage =  'Filter Edit Successfully ';
            // dd($categories);die;
        }
        // $filter = '';
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);die;
            // save the date form the productfilter table
            $cat_ids = implode(",", $data['cat_ids']);
            $filter->filter_name = $data['filter_name'];
            $filter->cat_ids = $cat_ids;
            $filter->filter_culumn = $data['filter_culumn'];
            $filter->status = 1;
            $filter->save();

            // Add filter column in product table 
            DB::statement('ALTER TABLE products ADD '.$data['filter_culumn'].' VARCHAR(255) AFTER discription');

            return redirect('admin/filter')->with('massage', $massage);
        }
        // here the ftech date with reations section with categories and subcategories 
        $categroies = Section::with('categroies')->get()->toArray();
        // dd($categroies);die;
        return view('admin.filters.add-edit-filter')->with(compact('title', 'filter', 'categroies'));
    }
    public function deletefilter($id)
    {
        $massage ='filter delete successfully';

        ProductsFilter::where('id', $id)->delete();
        return redirect()->back()->with('massage', $massage);
    }
    


    public function filterstatusupdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsFilter::where('id', $data['filter_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }
    public function filtersValue()
    {
        $filtervalues = ProductsFilterValue::get()->toArray();
        $title = 'Filters_value';

        // dd($filtervalues);die;
        return view('admin.filters.filter-value', compact('title', 'filtervalues'));
    }
    public function AddEditFilterValue(Request $request , $id = null)
    {
        if ($id == "") {
            $title = 'add Filter value';
            $filterValue = new ProductsFilterValue ; 
            $massage = 'Add filter Value SuccessFully';
            // dd($filterValue);die;
        }else{
            $title = 'add Filter value';
            $filterValue = ProductsFilterValue::find($id); 
            $massage = 'Add filter Value SuccessFully';
            // dd($filterValue);die;
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);die;
            // save the date form the productfilter table
            $filterValue->filter_id = $data['filter_id'];
            $filterValue->filter_value = $data['filter_value'];
            $filterValue->status = 1;
            $filterValue->save();

            // Add filter column in product table 
            // DB::statement('ALTER TABLE products ADD '.$data['filter_culumn'].' VARCHAR(255) AFTER discription');

            return redirect('admin/filter-value')->with('massage', $massage);
        }
        $filterValuegets = ProductsFilter::where('status',1)->get()->toArray();
        // dd($filterValuegets);die;

        return view('admin.filters.add-edit-filter-value')->with(compact('title','filterValue','massage','filterValuegets'));
    }
    public function categoryFilters(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre>';
            // print_r($data);
            $category_id  =$data['category_id'];
            
            return response()->json([
                'view'=>(String)View::make('admin.filters.category_filter')->with(compact('category_id'))
            ]); 
        }

    }
}
