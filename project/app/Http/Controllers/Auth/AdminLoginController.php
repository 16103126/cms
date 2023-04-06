<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'     => 'required|email:rfc,dns',
            'password'  => 'required|alphaNum|min:5|max:20',
        ];

        $customs = [
            'email.required'    => __('Email address is required.'),
            'email.email'       => __('Invalid email format.'),

            'password.required' => __('Your password is required.'),
            'password.alphaNum' => __('Password must be alpha-numeric characters.'),
            'password.min'      => __('Minimum 5 characters is required.'),
            'password.max'      => __('Maximum 20 characters is required.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        } 

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

            $message = __('You logged in successfully!');
            return response()->json(['success' => $message, "redirect" => route("admin.dashboard")]);
            
        }else{

            $message = __('Your email or password is invalid.');
            return response()->json(['message' => $message]);
           
        }
    }

    public function logout()
    {
        
        Auth::guard('admin')->logout(); 

        return redirect()->route('admin.login.form')->with('success', __('You are logged out.'));
    }
}
