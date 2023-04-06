<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\PasswordResetJob;
use App\Mail\PasswordResetMail;
use App\Jobs\passwordResetMailJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserPasswordResetController extends Controller
{
    public function passwordForgotForm()
    {
        return view('auth.user.password-forgot');
    }

    public function passwordForgot(Request $request)
    {
        $rules = [
            'email' => 'required|email:rfc,dns',
        ];

        $customs = [
            'email.required' => __('Email address is required.'),
            'email.email' => __('Invalid email format.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        } 

        $user = User::where('email', $request->email)->first();

        if(!$user){

            $message = ['message' => __('Invalid email address. Please, try again.')];
            return response()->json($message);
        }
        
        Mail::to($user->email)->send(new PasswordResetMail($user));

        $message = ['success' => __('Password reset link sent to your email. Please, check your email.')];

        return response()->json($message);

    }

    public function passwordResetForm($username)
    {
        $user = User::where('username', $username)->first();
        return view('auth.user.password-reset-form', compact('user'));
    }
    public function passwordReset(Request $request, $username)
    {
        $rules = [
            'password'  => 'required|alphaNum|min:5|max:10',
            'password_confirmation' => 'required|same:password',
        ];

        $customs = [
            'password.required' => __('Your password is required.'),
            'password.alphaNum' => __('Password must be alpha-numeric characters.'),
            'password.min'      => __('Minimum 5 characters is required.'),
            'password.max'      => __('Maximum 10 characters is required.'),

            'password_confirmation.required' => __('Password Confirmation is required.'),
            'password_confirmation.same'     => __('Confirmation password does not match.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        } 
        
        $user = User::where('username', $username)->first();
        $user->password = Hash::make($request->password);
        $user->update();

        $message = __('Your password reset sucessfully.');
        return response()->json(['success' => $message]);
    }
}
