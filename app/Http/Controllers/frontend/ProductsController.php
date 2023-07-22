<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Products_Attribute;
use App\Models\ProductsFilter;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\get;

class ProductsController extends Controller
{
    public function Listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo'<pre>';
            //  print_r($data);die; 
            $url = $data['sort'];
            $_GET['sort'] = $data['sort'];
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryExists = Category::where(['url' => $url, 'status' => 1])->exists();
            if ($categoryExists > 0) {
                $categoryDetails = Category::categoryDetails($url);
                // dd($categoryDetails);           
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);
                // checking for  Dynamic show one listing 
                $productsFilters = ProductsFilter::productgetvalue();
                // dd($productsFilters);die;
                foreach ($productsFilters as $key => $filter) {
                    if (
                        isset($filter['filter_culumn']) && isset($data[$filter['filter_culumn']]) &&
                        !empty($filter['filter_culumn']) && !empty($data[$filter['filter_culumn']])
                    ) {
                        $categoryProducts->whereIn($filter['filter_culumn'], $data[$filter['filter_culumn']]);
                    }
                }
                // checking for fabric its just show one listing 
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }

                // checking for sort product 
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == 'product_latest') {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } elseif ($_GET['sort'] == 'product_lowest') {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } elseif ($_GET['sort'] == 'product_highest') {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } elseif ($_GET['sort'] == 'name_z_a') {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } elseif ($_GET['sort'] == 'name_a_z') {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    }
                }
                // checking for size filter
                if (isset($data['size']) && !empty($data['size'])) {
                    $productIds = Products_Attribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }
                // checking color filter
                if (isset($data['color']) && !empty($data['color'])) {
                    $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('id', $productIds);
                }
                // checking Price filter
                if (isset($data['price']) && !empty($data['price'])) {
                    foreach ($data['price'] as $key => $price) {
                        $priceArr = explode('-', $price);
                        $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                    }
                    $productIds = call_user_func_array('array_merge', $productIds);
                    $categoryProducts->whereIn('products.id', $productIds);
                    // $imploadPrices = implode('-',$data['price']);
                    // $explodePrices = explode('-',$imploadPrices);
                    // $min = reset($explodePrices);
                    // $max = end($explodePrices);
                    // $productIds = Product::select('id')->whereBetween('product_price',[$min,$max])->pluck('id')->toArray();
                    // $categoryProducts->whereIn('products.id',$productIds);
                }
                //  check on  Brand filter
                // checking color filter
                if (isset($data['brand']) && !empty($data['brand'])) {
                    $productIds = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }
                $categoryProducts = $categoryProducts->paginate(30);

                // dd($categoryProducts);         
                return view('frontend.products.ajax_product_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryExists = Category::where(['url' => $url, 'status' => 1])->exists();
            if ($categoryExists) {
                $categoryDetails = Category::categoryDetails($url);
                // dd($categoryDetails);           
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])
                    ->where('status', 1);
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == 'product_latest') {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } elseif ($_GET['sort'] == 'product_lowest') {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } elseif ($_GET['sort'] == 'product_highest') {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } elseif ($_GET['sort'] == 'name_z_a') {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } elseif ($_GET['sort'] == 'name_a_z') {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    }
                }
                $categoryProducts = $categoryProducts->cursorpaginate(2);

                // dd($categoryProducts);         
                return view('frontend.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
    }
    public function vendorlisting($vendorid)
    {
        // git vendor shop 
        $getvendorShop = Vendor::getVendorShop($vendorid);

        //    get vendor product
        $vendorProducts = Product::with('brand')->where('vendor_id', $vendorid)->where('status', 1);
        $vendorProducts =  $vendorProducts->paginate(10);
        // dd($getvendorproduct);die;
        return view('frontend.products.vendor_listing')->with(compact('getvendorShop', 'vendorProducts'));
    }
    public function productDetail($id)
    {
        $productDetails = Product::with([
            'section', 'category', 'brand',
            'attribute' => function ($query) {
                $query->where('stock', '>', 0)->where('status', 1);
            }, 'Addimage', 'vendor',
        ])->find($id)->toArray();
        // dd($productDetails);
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        // get similer product 
        $samilerproduct = Product::with('brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();
        // dd($samilerproduct);die;
        $totalstock  = Products_Attribute::where('product_id', $id)->sum('stock');
        // dd($totalstock); 
        // insert the session id and product id if the user can't the view the product  
        // $session = new Session();
        if (empty(Session::get('session_id'))) {
            $session_id = md5(uniqid(rand(), true));
        } else {
            $session_id =  Session::get('session_id');
        }
        // this use for the session id not count again and again 
        Session::put('session_id', $session_id);
        // count if recently view product session id 0 so insert in table 
        $recentlyViewProduct = DB::table('recently_view_products')->where(['product_id' => $id, 'session_id' => $session_id])->count();
        if ($recentlyViewProduct == 0) {
            DB::table('recently_view_products')->insert(['product_id' => $id, 'session_id' => $session_id]);
        }
        // get recenlty views product ids
        $recentlyViewProducts = DB::table('recently_view_products')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->limit(4)->inRandomOrder()->get()->pluck('product_id')->toArray();
        //  dd($recentlyViewProducts);die;
        $groupProducts = array();
        if (!empty($productDetails['group_code'])) {
            $groupProducts = Product::select('id', 'product_image')->where('id', '!=', $id)->where(['group_code' => $productDetails['group_code'], 'status' => 1])->get()->toArray();
            // dd($groupProducts);die;
        }

        $recenltyViewproducts = Product::with('brand')->whereIn('id', $recentlyViewProducts)->get()->toArray();
        // dd($recenltyViewproducts);die;
        return view('frontend.products.productDetails')->with(compact('productDetails', 'categoryDetails', 'totalstock', 'samilerproduct', 'recenltyViewproducts', 'groupProducts'));
    }
    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'], $data['size']);
            return $getDiscountAttributePrice;
        }
    }
    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // if (Auth::check()) {
            //     $isStockavailible = Products_Attribute::isStockavailible($data['product_id'], $data['size']);
            // }else{
            //     return  redirect()->route('vendor.login')->with('message', 'Please log in to add items to your cart.');
            // }      
            $isStockavailible = Products_Attribute::isStockavailible($data['product_id'], $data['size']);     
            // dd($isStockavailible);die;
            if ($isStockavailible < $data['quantity']) {
                return redirect()->back()->with('massage', 'the product quantity not Availible');
            }
            $session_id = Session::get('session_id');
            if (!empty($session_id)) {
                $session_id = Session::getId();
               Session::put('session_id',$session_id);
            }
            $item = new Cart ;
            $item->session_id =    $session_id ;
            $item->product_id =    $data['product_id'];
            $item->size =    $data['size'] ;
            $item->quantity =    $data['quantity'];
            $item->save() ; 

            return redirect()->back()->with('massage','the product add to cart successFully');
        }
    }
}
