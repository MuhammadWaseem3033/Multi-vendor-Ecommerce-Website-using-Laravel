<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function user_register()
    {
        return view('frontend.userlogin.user');
    }
    public function userRegister(Request $request)
    {
        $data = $request->all();
        $validated = $request->validate([
            // 'name' => 'required|unique|string|max:255',
            // 'mobile' => 'required|unique|max:13',
            // 'email' => 'required|email|unique',
            'password' => 'required',
            'accept' => 'required',
        ]);
        // Return the message
        // if ($validator->fails()) {
        //     return response()->json([
        //         'error' => true,
        //         'message' => $validator->errors()
        //     ]);
        // }
        // dd($data);die;
        $user = new User();
        $user->name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->status = 1;
        $user->save();

        // send Register Email massage 
        $email = $data['email'];
        $massageData = ['name' => $data['name'], 'mobile' => $data['mobile'], 'email' => $data['email']];
        Mail::send('emails.register', $massageData, function ($message) use ($email) {
            $message->to($email)->subject('well to the Multi-Vendor E-commerce website ');
        });


        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect('/cart')->with('massage');
        } else {
            return redirect()->back()->with('error');
        }
    }
    public function userLoginRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required',
            ]);
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // if (Auth::user()->status==0) {
                // return redirect()->back()->with(['error'=>'Your Account has been Deacctive ,  Please contact with the Admin ']);                    
                // }
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }
                return redirect('/cart')->with('massage');
            } else {
                return redirect()->back()->with('error');
            }
        }
    }
    public function userAcount(Request $request)
    {
        if ($request->ajax()) {

        }else{
            $countries  = Country::where('status',1)->get()->toarray();
            return view('frontend.userlogin.useraccount')->with(compact('countries'));
        }
    }
    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function userForgotPassword(Request $request)
    {
    }
}
