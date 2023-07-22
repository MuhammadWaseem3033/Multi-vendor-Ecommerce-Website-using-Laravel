<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function dashboard()
    {
        session()->put('page', 'dashoabrd');
        return view('admin.dashboard');
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('massage', 'Your Email and Password Not Correct');
            }
        }
        return view('admin.login');
    }
    public function UpdateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // Check if Current password is valid entered by the admin
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_massage', 'Your password is Updated !');
                } else {
                    return redirect()->back()->with('success_massage', 'Your password is Not Updated !');
                }
            } else {
                return redirect()->back()->with('error_massage', 'Your Current Password are Invalid !!');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
       
        return view('admin.settings.update-admin-password')->with(compact('adminDetails'));
    }
    // update admin details
    public function CheckAdminDateils(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
        
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ];
            $customValidate = [
                'admin_name.required' => 'Name is Required ',
                'admin_name.regex' => 'Dont use the spacial Caracter',
                'admin_mobile.required' => 'Mobile is Required',
                'admin_mobile.numeric' => 'Mobile number are Invalid ',
            ];
            $this->validate($request, $rules, $customValidate);
            if ($request->hasFile('admin_image')) {

                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
               
                    $imagePath = 'admin/assets/image/' . $imageName;
             
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }
            // admin detial update
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $imageName]);
            return redirect()->back()->with('success_massage', 'Admin details is Updated');
        }
        // update password code
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_massage', 'Your password is Updated !');
                } else {
                    return redirect()->back()->with('success_massage', 'Your password is Not Updated !');
                }
            } else {
                return redirect()->back()->with('error_massage', 'Your Current Password are Invalid !!');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update-admin-detail')->with(compact('adminDetails'));
    }
    public function CheckAdminPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
    public function UpdateVendordetail(Request $request, $slug)
    {
        if ($slug == 'personel') {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                ];
                $customValidate = [
                    'vendor_name.required' => 'Name is Required ',
                    'vendor_name.regex' => 'Dont use the spacial Caracter',
                    'vendor_mobile.required' => 'Mobile is Required',
                    'vendor_mobile.numeric' => 'Mobile number are Invalid ',
                ];
                $this->validate($request, $rules, $customValidate);
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/assets/image/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }
                Admin::where('id', Auth::guard('admin')->user()->id)
                    ->update(
                        [
                            'name' => $data['vendor_name'],
                            'mobile' => $data['vendor_mobile'],
                            'image' => $imageName,
                        ]
                    );
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)
                    ->update(
                        [
                            'name' => $data['vendor_name'],
                            'mobile' => $data['vendor_mobile'],
                            'address' => $data['vendor_address'],
                            'city' => $data['vendor_city'],
                            'state' => $data['vendor_state'],
                            'country' => $data['vendor_country'],
                            'pincode' => $data['vendor_pincode'],
                            'email' => $data['vendor_email'],
                        ]
                    );
                return redirect()->back()->with('massage', 'Vendor update Successfully');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == 'business') {
            if ($request->isMethod('post')) 
            {
                $data = $request->all();
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                ];
                $customValidate = [
                    'shop_name.required' => 'Name is Required ',
                    'shop_name.regex' => 'Dont use the spacial Caracter',
                    'shop_mobile.required' => 'Mobile is Required',
                    'shop_mobile.numeric' => 'Mobile number are Invalid ',
                ];
                $this->validate($request, $rules, $customValidate);
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/assets/proofs/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_address_proof_image'])) {
                    $imageName = $data['current_address_proof_image'];
                } else {
                    $imageName = "";
                }
                $vendorCount = VendorsBusinessDetail::where(Auth::guard('admin')->user()->vendor_id)->count();
                if ($vendorCount >0) {
                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)
                    ->update(
                        [
                            'shop_name' => $data['shop_name'],
                            'shop_mobile' => $data['shop_mobile'],
                            'shop_address' => $data['shop_address'],
                            'shop_city' => $data['shop_city'],
                            'shop_state' => $data['shop_state'],
                            'shop_country' => $data['shop_country'],
                            'shop_pincode' => $data['shop_pincode'],
                            'shop_email' => $data['shop_email'],
                            'business_licens_number' => $data['shop_business_licens_number'],
                            'gst_number' => $data['shop_gst_number'],
                            'pan_number' => $data['shop_pan_number'],
                            'address_proof' => $data['address_proof'],
                            'address_proof_image' => $imageName
                        ]
                    );
                }else{
                    VendorsBusinessDetail::insert(
                        ['vendor_id'=> Auth::guard('admin')->user()->vendor_id ,                        
                            'shop_name' => $data['shop_name'],
                            'shop_mobile' => $data['shop_mobile'],
                            'shop_address' => $data['shop_address'],
                            'shop_city' => $data['shop_city'],
                            'shop_state' => $data['shop_state'],
                            'shop_country' => $data['shop_country'],
                            'shop_pincode' => $data['shop_pincode'],
                            'shop_email' => $data['shop_email'],
                            'business_licens_number' => $data['shop_business_licens_number'],
                            'gst_number' => $data['shop_gst_number'],
                            'pan_number' => $data['shop_pan_number'],
                            'address_proof' => $data['address_proof'],
                            'address_proof_image' => $imageName ,
                            ]                        
                    );
                }                
                return redirect()->back()->with('massage', 'Vendor update Successfully');
            }
            $vendorCount = VendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            }else{
                $vendorDetails = array();
            }
        } else if ($slug == 'bank') {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_holder_name' => 'required',
                ];
                $customValidate =
                    [
                        'bank_name.required' => 'Name is Required ',
                        'bank_name.regex' => 'Dont use the spacial Caracter',
                        'account_holder_name.required' => 'Mobile is Required',
                    ];
                $this->validate($request, $rules, $customValidate);
                $vendorCount = VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->count();
                if ($vendorCount > 0) {
                    VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)
                    ->update(
                        [
                            'bank_name' => $data['bank_name'],
                            'account_holder_name' => $data['account_holder_name'],
                            'account_number' => $data['account_number'],
                            'bank_ifsc_code' => $data['bank_ifsc_code'],
                        ]
                    );
                }else{
                    VendorsBankDetail::insert(['vendor_id' => Auth::guard('admin')->user()->vendor_id,
                    
                            'bank_name' => $data['bank_name'],
                            'account_holder_name' => $data['account_holder_name'],
                            'account_number' => $data['account_number'],
                            'bank_ifsc_code' => $data['bank_ifsc_code'],
                        ]
                    );
                }                
                return redirect()->back()->with('massage', 'Vendor Bank Details update Successfully');
            }
            $vendorCount = VendorsBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
            $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            }else{
                $vendorDetails = array();
            }
        }
        $countries = Country::where('status',1)->get()->toArray();
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails','countries'))->with('success massage', 'Update Successfull');
    }
    // the funtion of admins / subadmin/ vendor
    public function admins($type = null)
    {
        $admins = Admin::query();
        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . "s";
        } else {
            $title = "All Admins/SubAdmins/Vendor";
        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }
    public function viewVendorDtails(Request $request, $id)
    {
        $vendorDetails = Admin::with('vendorPersonel', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        return view('admin.admins.view-vendor-details')->with(compact('vendorDetails'));
    }

    public function adminUpdateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=='Active') {
                $status = 0 ;
            }else{
                $status = 1 ;
            }
            Admin::where('id',$data['admin_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
