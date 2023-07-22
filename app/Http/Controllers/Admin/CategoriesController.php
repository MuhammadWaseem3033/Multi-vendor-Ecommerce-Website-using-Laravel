<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoriesController extends Controller
{
    public function categories()
    {
        $categories = Category::with('sections', 'parentCategory')->get()->toArray();
        $title = 'Categories';
        return view('admin.categories.categories')->with(compact('categories', 'title'));
    }
    // status active in active
    public function categoryUpdateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == "") {
            $title = 'Add Category';
            $category = new Category;
            $getCategories = array();
            $massage = 'Add Categories Seccessfully';
        } else {
            $title = 'Edit Category';
            $category = Category::find($id);
            $getCategories = Category::with('subcategries')->where(['parent_id' => 0, 'section_id' => $category['section_id']])->get();
            $massage = 'Edit Categories Seccessfully';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required|numeric',
                'url' => 'required',
            ];
            $customValidate = [
                'category_name.required' => 'Name is Required ',
                'category_name.regex' => 'Dont use the spacial Caracter',
                'section_id.required' => 'Mobile is Required',
                'section_id.numeric' => 'Mobile number are Invalid ',
                'url.required' => 'Url nist be required',
            ];
            $this->validate($request, $rules, $customValidate);
            // upload category imgae
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'front/images/category' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                }
            } else {
                $category->category_image = "";
            }
            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->meta_title = $data['meta_title'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->url = $data['url'];
            $category->status = 1;
            $category->save();

            return redirect('admin/categories')->with('massage', "Your are successfully Adding the New Row");
        }
        $getSection = Section::get()->toArray();
        return view('admin.categories.add-edit-category')->with(compact('title', 'category', 'getSection', 'massage', 'getCategories'));
    }
    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subcategries')->where(['parent_id' => 0, 'section_id' => $data['section_id']])->get()->toArray();
            return view('admin.categories.append_category_level')->with(compact('getCategories'));
        }
    }
    public function detaleCategory($id)
    {
        Category::where('id', $id)->delete();
        $massage = "Delete The Massage SuccessFully";
        return redirect()->back()->with('success_massage', $massage);
    }
    public function detaleCategoryImage($id)
    {
        $categoryimage = Category::select('category_image')->where('id', $id)->first();
        $category_image_path = 'front/images/category';
        if (file_exists($category_image_path . $categoryimage->categroy_image)) {
            unlink(file_exists($category_image_path . $categoryimage->categroy_image));
        }
        // Delete category image from categories folder
        Category::where('id',$id)->update(['category_image'=>'']);
        $massage = " Category has been  delete successfully ";
        return redirect()->back()->with('success_massage',$massage);
    }
}
