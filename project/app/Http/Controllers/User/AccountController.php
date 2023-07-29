<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('user')->user();
        $address = json_decode($user->address);
        return view('user.account.profile', compact('user','address'));
    }

    public function profileData()
    {
        $user = Auth::guard('user')->user();
        $countries = Country::get();
        $address = json_decode($user->address);
        return response()->json(['user' => $user, 'countries' => $countries, 'address' => $address]);
    }

    public function profileUpdate(Request $request, $id)
    {
        $rules = [
            'name'                  => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:5|max:50',
            'username'              => 'required|min:5|max:20|unique:users,username,'.$id,
            'email'                 => 'required|email:rfc,dns|unique:users,email,'.$id,
            'phone'                 => 'numeric',
            'age'                   => 'numeric',
            'nid'                   => 'numeric',
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

            'phone.numeric'     => __('Phone number must be numeric character.'),
            'age.numeric'       => __('Age must be numeric character'),
            'nid.numeric'       => __('NID must be numeric character'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);
        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('name', 'username', 'email', 'phone_number', 'phone_code', 'age', 'gender', 'nid', 'about', 'image');

        $address = ['country' => $request->country, 'state' => $request->state, 'city' => $request->city, 'zip_code' => $request->zip_code];
        $input['address'] = json_encode($address);

        $user = User::findOrFail($id);

        $user->fill($input)->update();

        $message = __('Profile update successfully.');

        return response()->json(['success' => $message]);
    }

    public function profileImageUpdate(Request $request, $id)
    {
        $rules = [
            'image'                 => 'image|mimes:png,jpg,jpeg|size:1024',
        ];

        $customs = [
            'image.image'       => __('Enter valid image.'),
            'image.mimes'       => __('Image must be png, jpg, jpeg'),
            'image.size'        => __('Image size not more than 1mb.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);
        if($validate->fails()){
            return response()->json(['errorimg' => $validate->getMessageBag()->toArray()]);
        }

        $user = User::findOrFail($id);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/user/img/profile/', $imageName);

            if($user->image){
                $path = 'assets/user/img/profile/'.$user->image;
                if(file_exists($path)){
                    @unlink($path);
                }
            }       
            $user->image = $imageName;
        }

        $user->update();

        $message = __('Profile image update successfully.');

        return response()->json(['successimg' => $message]);
    }

    public function state($id)
    {
        $user = Auth::guard('user')->user();
        $country = Country::findOrFail($id);
        $states = $country->states;
        $address = json_decode($user->address);
        return response()->json(['states' => $states, 'address' => $address]);
    }

    public function city($id)
    {
        $user = Auth::guard('user')->user();
        $state = State::findOrFail($id);
        $city = $state->cities;
        $address = json_decode($user->address);
        return response()->json(['cities' => $city, 'address' => $address]);
    }

    public function accountDeactivate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if($request->deactive == 'on')
        {
            if(Hash::check($request->password, $user->password)){
                $user->isDeactivate = 1;
                $user->update();
                Auth::guard('user')->logout();
                $message = __('Your account is Deactivated.');
                return response()->json(["deactiveMsg" => $message, "redirect" => route("user.login.form")]);
            }else{
                return response()->json(['deactiveError' => __('Invalid password.')]);
            }
        }
    }

    public function passwordResetForm()
    {
        $user = Auth::guard('user')->user();
        return view('user.account.password-reset', compact('user'));
    }

    public function passwordReset(Request $request, $id)
    {
        $rules = [
            'password'              => 'required|alphaNum|min:5|max:20',
            'new_password'          => 'required|alphaNum|min:5|max:20',
            'password_confirmation' => 'required|same:new_password',
        ];

        $customs = [
            'password.required' => __('Your password is required.'),
            'password.alphaNum' => __('Password must be alpha-numeric characters.'),
            'password.min'      => __('Minimum 5 characters is required.'),
            'password.max'      => __('Maximum 20 characters is required.'),

            'new_password.required' => __('New password is required.'),
            'new_password.alphaNum' => __('Password must be alpha-numeric characters.'),
            'new_password.min'      => __('Minimum 5 characters is required.'),
            'new_password.max'      => __('Maximum 20 characters is required.'),

            'password_confirmation.required' => __('Password Confirmation is required.'),
            'password_confirmation.same'     => __('Confirmation password does not match.'),
        ];
        
        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $user = Auth::guard('user')->user();

        if(Hash::check($request->password, $user->password)){

            if(!Hash::check($request->new_password, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->update();
                $message = __('Password reset successfully!');
                return response()->json(['success' => $message]);
            }   
            
            $message = __('Do not used old password.');
            return response()->json(['info' => $message]);
        }
        $message = __('Invalid old password.');
        return response()->json(['message' => $message]);
    }

    public function twofaForm()
    {
        $user = Auth::guard('user')->user();
        return view('user.account.twofa', compact('user'));
    }

    public function twofa(Request $request, $id)
    {
        $input = $request->all();
        $user = User::findOrFail($id);

        if($request->sending_type == 1 && $user->phone_number == null){

            $rules = [
                'phone_number'              => 'required|min:9|numeric'
            ];
    
            $customs = [
                'phone_number.required' => __('Phone number is required.'),
                'phone_number.min' => __('Minimum 9 character is required.'),
                'phone_number.numeric' => __('Phone number must be numeric character.'),
            ];

            $validate = Validator::make($request->all(), $rules, $customs);

            if($validate->fails()){
                return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
            }

            $input['phone_number'] = $request->phone_number;
        }
        
        if($request->twofa == 'on'){
            $input['isTwoFa'] = 1;
        }else{
            $input['isTwoFa'] = 0;
        }
        
        $user->fill($input)->update();
        return response()->json(['success' => __('2Fa Varification update successfully!')]);
    }

    public function profileShow($id)
    {
        $user = User::findOrFail($id);
        $address = json_decode($user->address);
        return view('user.account.profile-show', compact('user', 'address'));
    }

    public function status($id)
    {
        
    }
}
