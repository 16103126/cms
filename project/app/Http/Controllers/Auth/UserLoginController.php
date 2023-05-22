<?php

namespace App\Http\Controllers\Auth;

use notify;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Mail\TwoFactorVarificationMail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class UserLoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.user.login');
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

        // $user = User::where('email', $request->email)->first();
        // if($user->isDeactivate == 1){
        //     return response()->json(['deactiveMsg' => __('Your account is deactivated.')]);
        // }

        $remember_me = $request->has('remember_me') ? 'true' : 'false';

        if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)){

            if(Auth::guard('user')->user()->isDeactivate == 1){
                return response()->json(['deactiveMsg' => __('Your account is deactivated.')]);
            }

            if($request->remember_me == 'on'){
                Cookie::queue('email', $request->email, 1440);
                Cookie::queue('password', $request->password, 1440);
            }else{
                Cookie::queue('email', $request->email, -1440);
                Cookie::queue('password', $request->password, -1440);
            }
            
            $message = __('You logged in successfully!');
            notify()->success($message);
            return response()->json(['success' => $message, "redirect" => route("user.dashboard")]);
            
        }else{

            $message = __('Your email or password is invalid.');
            return response()->json(['message' => $message]);
           
        }
    }

    public function providerRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function loginWithProvider($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $provider_id = $provider.'_id';

        $isUser = User::where($provider_id, $user->id)->first();

        if($isUser){
            Auth::guard('user')->login($isUser);
            return redirect()->route('user.dashboard');
        }

        if(User::where('email', $user->email)->first())
        {
            $updateUser = User::where('email', $user->email)->first();
            $updateUser->$provider_id = $user->id ;
            $updateUser->update();
            Auth::guard('user')->login($updateUser);
            return redirect()->route('user.dashboard');
        }

        $createUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->name.'_'.$user->id,
            $provider_id => $user->id,
            'password' => Hash::make($user->name.'@'.$user->id)
        ]);

        Auth::guard('user')->login($createUser);

        return redirect()->route('user.dashboard');
    }

    public function twoFactorForm()
    {
        return view('auth.user.twofa');
    }

    public function twoFactor(Request $request)
    {
        $rules = [
            'twofa_code' => 'required|numeric|min:4'
        ];

        $customs = [
            'twofa_code.required' => __('2Fa code is required.'),
            'twofa_code.numeric' => __('2Fa code must be numeric characters.'),
            'twofa_code.min' => __('Minimum 4 characters required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $user = Auth::guard('user')->user();

        if($user->twofa_code == $request->twofa_code)
        {
            Session::put('2fa', $user->id);
            $message = __('Successfully Verified!');
            return response()->json(['success' => $message, "redirect" => route("user.dashboard")]);
        }

        $message = __('Your code is invalid. Please, try again.');
        return response()->json(['message' => $message]);

    }

    public function resendCode()
    {
       Auth::guard('user')->user()->sendCode();
       return response()->json(['send' => 'Code send to your gamil.']);
    }

    public function logout()
    {
        Session::forget('2fa');
        Auth::guard('user')->logout();
        return redirect()->route('user.login.form');
    }
}
