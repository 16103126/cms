<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegistrationController extends Controller
{
    public function registerForm()
    {
        return view('auth.user.registration');
    }

    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:5|max:50',
            'username'              => 'required|min:5|max:20|unique:users,username',
            'email'                 => 'required|email:rfc,dns|unique:users,email',
            'password'              => 'required|alphaNum|min:5|max:20',
            'password_confirmation' => 'required|same:password',
            'g-recaptcha-response' => 'required|captcha'
        ];

        $customs = [
            'name.required'     => __('Your name is required'),
            'name.regex'        => __('Invalid name format.'),
            'name.min'          => __('Minimum 5 characters is required.'),
            'name.max'          => __('Maximum 50 characters is required.'),

            'username.required' => __('Your username is required'),
            'username.min'      => __('Minimum 5 characters is required.'),
            'username.max'      => __('Maximum 20 characters is required.'),
            'username.unique'   => __('This username is already used.'),

            'email.required'    => __('Email is required.'),
            'email.email'       => __('Invalid email format.'),
            'email.unique'      => __('This email is already used.'),

            'password.required' => __('Your password is required.'),
            'password.alphaNum' => __('Password must be alpha-numeric characters.'),
            'password.min'      => __('Minimum 5 characters is required.'),
            'password.max'      => __('Maximum 20 characters is required.'),

            'password_confirmation.required' => __('Password Confirmation is required.'),
            'password_confirmation.same'     => __('Confirmation password does not match.'),
            
            'g-recaptcha-response.required'  => __('Please verify that you are not a robot.'),
            'g-recaptcha-response.captcha'   => __('Captcha error! try again later.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->all();

        $user = new User();

        $input['password'] = Hash::make($request->password);

        $user->fill($input)->save();

        $message = __('Your are registered. Please, login.');

        return response()->json(['success' => $message, "redirect" => route("user.login.form")]);
    }
}
