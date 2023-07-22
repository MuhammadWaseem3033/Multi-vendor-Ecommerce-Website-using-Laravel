<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Products_Attribute;
use App\Models\ProductsFilter;
use App\Models\ProductsImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    public function Products()
    {
        // $authdard = Auth::guard('admin')->user()->type;
        // dd($authdard);
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        if ($adminType == 'vendor') {
            $vendorStatus = Auth::guard('admin')->user()->status ;
            if ($vendorStatus ==0) {
                return redirect('admin/update-vendor-detail/personel')->with('error','your account not approved yet');
            }
        }
        $products = Product::with(
            [
                'section' => function ($query) {
                    $query->select('id', 'name');
                },
                'category' => function ($query) {
                    $query->select('id', 'category_name');
                },
                'brand' =>  function ($query) {
                    $query->select('id', 'name');
                }
            ]
            );
            if ($adminType =="vendor") {
                $products = $products->where('vendor_id',$vendor_id)    ;
            }
            $products = $products->get()->toArray();
        $title = 'Products';
        // dd($products);
        // die;
        return view('admin.products.products')->with(compact('products', 'title'));
    }
    public function productsUpdateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // reverse the status 
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function destroyProduct($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success_massage', 'Delete Product Successfully');
    }
    public function addEditProducts(Request $request, $id = null)
    {

        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
            $massage = "Add new products Successfully";
            // dd($id);
        } else {
            $title = "Edit Product";
            $product = Product::find($id);
            $massage = "Update products Successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            
            if ($request->hasFile('product_image')) {
                // dd($request->hasFile('product_image'));die;
                $image_tmp = $request->file('product_image');
                // dd($image_tmp);die;
                if ($image_tmp->isValid()) {
                    // dd($image_tmp->isValid());die;

                    $extension = $image_tmp->getClientOriginalExtension();
                    // dd($extension);die;

                    $imageName = rand(111, 99999) . '.' . $extension;
                    // resize the image 
                    $largeimagePath = 'front/product/image/large/' . $imageName;
                    // dd($largeimagePath);die;

                    $mediumimagePath = 'front/product/image/medium/' . $imageName;
                    // dd($mediumimagePath);die;
                    $smallimagePath = 'front/product/image/small/' . $imageName;
                    Image::make($image_tmp)->resize(1000, 1000)->save($largeimagePath);
                    Image::make($image_tmp)->resize(500, 500)->save($mediumimagePath);
                    Image::make($image_tmp)->resize(250, 250)->save($smallimagePath);
                    $product->product_image = $imageName;
                    // dd($product);die;
                }
            }
            // upload the video 
            if ($request->hasFile('product_vedio')) {
                $vedio_tmp = $request->file('product_vedio');
                if ($vedio_tmp->isValid()) {
                    // insert in product folder
                    $extension = $vedio_tmp->getClientOriginalExtension();
                    $vedioName =  rand(111, 99999) . '.' . $extension;
                    $vedioPath = 'front/product/vedio/';
                    $vedio_tmp->move($vedioPath, $vedioName);
                    // insert in product table
                    $product->product_vedio = $vedioName;
                }
            }
            $categroyDetails = Category::find($data['category_id']);
            $product->section_id = $categroyDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->group_code = $data['group_code'];

            $productsFilters = ProductsFilter::productgetvalue();
            
            foreach ($productsFilters as $filter){
                $filterAvailible = ProductsFilter::filter_availible($filter['id'],$data['category_id']);
                if ($filterAvailible =='Yes') {
                    if (isset($filter['filter_culumn']) && $data[$filter['filter_culumn']]) {
                        $product->{$filter['filter_culumn']} = $data[$filter['filter_culumn']] ;
                    }
                }
            }

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $adminId = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id =  $adminId;
            if ($adminType == 'vendor') {
                $product->vendor_id = $vendor_id;
            } else {
                $product->vendor_id = 0;
            }
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->discription = $data['discription'];
            $product->meta_title = $data['meta_title'];
            $product->meta_discription = $data['meta_discription'];
            $product->meta_kaywords = $data['meta_kaywords'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = 'No';
            }
            $product->status = 1;

            $product->save();

            return redirect('/admin/products')->with('success_massage', $massage);
        }
        $categories = Section::with('categroies')->get()->toArray();
        // dd($categories);
        $brands = Brand::where('status', 1)->get()->toArray();
        // dd($brands);die;
        return view('admin.products.add-edit-product')->with(compact('title', 'massage', 'product', 'categories', 'brands'));
    }
    public function destroyProductImage($id)
    {
        $imagedelete = Product::select('product_image')->where('id', $id)->first();

        // select image from the folder 
        $small_image_path = 'front/product/image/small';
        $large_image_path = 'front/product/image/large';
        $medium_image_path = 'front/product/image/medium';
        // delete for small image 
        if (file_exists($small_image_path . $imagedelete->product_image)) {
            unlink($small_image_path . $imagedelete->product_image);
        }
        // delete for large image 
        if (file_exists($large_image_path . $imagedelete->product_image)) {
            unlink($large_image_path . $imagedelete->product_image);
        }
        // delete for medium image 
        if (file_exists($medium_image_path . $imagedelete->product_image)) {
            unlink($medium_image_path . $imagedelete->product_image);
        }
        Product::where('id', $id)->update(['product_image' => '']);
        return redirect()->back()->with('success_massage', 'Delete Product Images Successfully');
    }
    public function destroyProductVedio($id)
    {
        $productVedio = Product::select('product_vedio')->where('id', $id)->first();

        $productvedio_path = 'front/product/vedio';

        if (fileExists($productvedio_path . $productVedio->product_vedio)) {
            unlink($productvedio_path . $productVedio->product_vedio);
        }
        Product::where('id', $id)->update(['product_vedio' => '']);

        return redirect()->back()->with('success_massage', 'Delete the Product vedio successfully');
    }
    public function addEditAttributes(Request $request, $id)
    {
        $title = 'Add the Attrbutes ';
        $massage = 'Attribute additing the Successfully';
        $product = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')->with('attribute')->find($id);
        $product = json_decode(json_encode($product), true);
        // dd($product);die;
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>';
            // print_r($data);die;
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    $skuCount = Products_Attribute::where('sku', $value)->count();
                    if ($skuCount > 0) {
                        return redirect()->back()->with('error_massage', 'Product SKU allreay Exists | Please Add new Sku !');
                    }
                    // $sizeCount  = Products_Attribute::where(['product_id' => $id, 'size', $data['size'][$key]])->count();
                    $sizeCount  = Products_Attribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();

                    if ($sizeCount > 0) {
                        return redirect()->back()->with('error_massage', 'Product Size Allready Exists | Please Add new Size');
                    }
                    $attribute = new Products_Attribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success_massage', 'Product Attribute Add suucessFully');
        }

        return view('admin.attributes.add-edit-attribute')->with(compact('title', 'product', 'massage'));
    }
    public function productsAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // reverse the status 
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Products_Attribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }
    public function editAttribute(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            echo '<pre>';
            //    print_r($data);die;
            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    Products_Attribute::where(['id' => $data['attributeId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_massage', 'Product Attribute Update suucessFully');
        }
    }
    public function AddImages(Request $request , $id)
    {
        $title = 'Product Image';
        // $product = Product::with('Addimage')->find($id);
        $massage = '';
        // dd('hello');die;
        $product = Product::select('id', 'product_name', 'product_code', 'product_color',
         'product_price', 'product_image')->with('Addimage')->find($id);
        //  dd($product);die;
       
         if ($request->isMethod('post')) {
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                // echo '<pre>';
                // print_r($images);die;
                foreach($images as $key => $image){
                    // Generete image name
                    // dd($image_tmp);
                    $image_tmp = $image->getClientOriginalName();
                    // dd($image_tmp);die;
                    $extension = $image->getClientOriginalExtension();
                // dd($extension);die;
                $image_tmp = Image::make($image->getRealPath());
                // dd($image_tmp);
                $imageName =$image_tmp.rand(111, 99999) . '.' . $extension;
                // resize the image 
                // dd($imageName);
                $largeimagePath = 'front/product/image/large/' . $imageName;
                // dd($largeimagePath);die;
                $mediumimagePath = 'front/product/image/medium/' . $imageName;
                // dd($mediumimagePath);die;
                $smallimagePath = 'front/product/image/small/' . $imageName;
                Image::make($image_tmp)->resize(1000, 1000)->save($largeimagePath);
                Image::make($image_tmp)->resize(500, 500)->save($mediumimagePath);
                Image::make($image_tmp)->resize(250, 250)->save($smallimagePath);
                $image = new ProductsImage ;
                $image->image = $imageName;
                $image->product_id = $id;
                $image->status = 1;
                $image->save();
                // dd($product);die;
                }
            return redirect()->back()->with('success_massage', 'Product Images Add suucessFully');
            }
         }
        return view('admin.attributes.add_edit_images')->with(compact('title', 'product', 'massage'));

    }
    public function destroyProductAttribute($id)
    {
        Products_Attribute::where('id', $id)->delete();
        return redirect()->back()->with('success_massage', 'Product attribute Delete Successfully');

    }
    public function productsImagesUpdateStatus(Request $request)
    {
        if ($request->ajex()) {
            $data = $request->all();
            dd($data);die;
            if ($data['status']=='active') {
                $status = 0 ;
            }else {
                $status = 1 ;
            }
            ProductsImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
            }
            if ($request->ajax()) {
                $data = $request->all();
                // echo "<pre>";
                // print_r($data);
                // reverse the status 
                if ($data['status'] == 'Active') {
                    $status = 0;
                } else {
                    $status = 1;
                }
                ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);
                return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
            }
    }
    public function destroyProductimages($id)
    {
        $imagedelete = ProductsImage::select('image')->where('id', $id)->first();
        // select image from the folder 
        $small_image_path = 'front/product/image/small';
        $large_image_path = 'front/product/image/large';
        $medium_image_path = 'front/product/image/medium';
        // delete for small image 
        if (file_exists($small_image_path . $imagedelete->image)) {
            unlink($small_image_path . $imagedelete->image);
        }
        // delete for large image 
        if (file_exists($large_image_path . $imagedelete->image)) {
            unlink($large_image_path . $imagedelete->image);
        }
        // delete for medium image 
        if (file_exists($medium_image_path . $imagedelete->image)) {
            unlink($medium_image_path . $imagedelete->image);
        }
        ProductsImage::where('id', $id)->delete();
        
        return redirect()->back()->with('success_massage', 'Delete Product Images Successfully');
    }
}
