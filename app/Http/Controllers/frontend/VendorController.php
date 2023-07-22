<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function Vendor_login()
    {
        return view('frontend.vendorlogin.vendor-login-register');
    }

    public function Vendor_register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $rules =
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:admins|unique:vendors',
                    'mobile' => 'required|min:10|numeric|unique:admins|unique:vendors',
                    'accept' => 'required',
                ];
            $customMassage =
                [
                    'name.required' => 'name is required ',
                    'email.required' => 'Email is Required',
                    'email.unique' => 'Email is Allready Exists',
                    'mobile.required' => 'Email is Required',
                    'mobile.unique' => 'mobile is Allready Exists',
                    'accept.required' => 'Please Accept is T&C',
                ];
            $validator = Validator::make($data, $rules, $customMassage);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            DB::beginTransaction();

            try {
                // Insert data in Vendors table
                $vendor = new Vendor;
                $vendor->name = $data['name'];
                $vendor->email = $data['email'];
                $vendor->mobile = $data['mobile'];
                $vendor->status = 0;
                $vendor->save();

                // Get the vendor ID
                $vendor_id = $vendor->id;

                // Insert data in Admins table
                $admin = new Admin;
                $admin->type = 'vendor';
                $admin->vendor_id = $vendor_id;
                $admin->name = $data['name'];
                $admin->email = $data['email'];
                $admin->mobile = $data['mobile'];
                $admin->password = bcrypt($data['password']);
                $admin->status = 0;
                $admin->save();

                Mail::send('emails.vendor_Confirmation',$admin->toArray(),function($massage){
                    $massage->to('waseemkingkhan55@gmail.com','test mail')
                    ->subject('vendor email Confrimation massage ');
                });
                DB::commit();

                // Send Email Confirmation

                // Redirect back with a success message
                $message = "Thanks for registering as a Vendor. We have sent you an email to confirm your account.";
                return redirect()->back()->with('message', $message);
            } catch (\Exception $e) {
                DB::rollback();

                // Handle the exception, log the error, or return an error message
                $error = $e->getMessage();
                return redirect()->back()->with('error', $error);
            }
        }
    }
}
