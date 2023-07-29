<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{
    public function seo()
    {
        $seo = Seo::findOrFail(1);
        return view('admin.general-setting.seo', compact('seo'));
    }

    public function updateSeo(Request $request)
    {
        $rules = [
            'title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        ];

        $customs = [
            'title.required' => __('Website title is required'),
            'meta_keywords.required' => __('Meta keywords is required'),
            'meta_description.required' => __('Meta description is required'),
        ];

        $validate = Validator::make($request->all(),$rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('title', 'meta_kewords', 'meta_description');

        $seo = Seo::findOrFail(1);

        $seo->fill($input)->save();

        $message = __('Seo update successfully.');

        return response()->json(['success' => $message]);
    }

    public function logo()
    {
        $logo = GeneralSetting::findOrFail(1);
        return view('admin.general-setting.logo', compact('logo'));
    }

    public function updateLogo(Request $request)
    {
        $rules = [
            'website_logo' => 'image|mimes:jpeg,jpg,png,|max:1024',
            'dashboard_logo' => 'image|mimes:jpeg,jpg,png,|max:1024',
        ];

        $customs = [
            'website_logo.image' => __('Logo must be a image.'),
            'website_logo.mimes' => __('Logoe must be jpeg, jpg, png'),
            'website_logo.size' => __('Logo size not more than 1 mb.'),
            'dashboard_logo.image' => __('Logo must be a image.'),
            'dashboard_logo.mimes' => __('Logo must be jpeg, jpg, png'),
            'dashboard_logo.size' => __('Logo size not more than 1 mb.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $logo = GeneralSetting::findOrFail(1);
        
        if($request->hasFile('website_logo'))
        {
            if($logo->website_logo)
            {
                $path = 'assets/frontend/images/logo/'.$logo->website_logo;
                if(file_exists($path)){
                    @unlink($path);
                }
            }

            $file = $request->file('website_logo');
            $logoName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/frontend/images/logo/', $logoName);
            $logo->website_logo = $logoName;
        }

        if($request->hasFile('dashboard_logo'))
        {
            if($logo->dashboard_logo)
            {
                $path = 'assets/admin/img/logo/'.$logo->dashboard_logo;
                if(file_exists($path)){
                    @unlink($path);
                }
            }

            $file = $request->file('dashboard_logo');
            $logoName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/img/logo/', $logoName);
            $logo->dashboard_logo = $logoName;
        }

        $logo->update();

        $message = __('Logo update successfully!');

        return response()->json(['success' => $message]);
    }

    public function icon()
    {
        $icon = GeneralSetting::findOrFail(1);
        return view('admin.general-setting.icon', compact('icon'));
    }

    public function updateIcon(Request $request)
    {
        $rules = [
            'website_icon' => 'image|mimes:jpeg,jpg,png,|max:1024',
            'dashboard_icon' => 'image|mimes:jpeg,jpg,png,|max:1024',
        ];

        $customs = [
            'website_icon.image' => __('Icon must be a image.'),
            'website_icon.mimes' => __('Icone must be jpeg, jpg, png'),
            'website_icon.size' => __('Icon size not more than 1 mb.'),
            'dashboard_icon.image' => __('Icon must be a image.'),
            'dashboard_icon.mimes' => __('Icon must be jpeg, jpg, png'),
            'dashboard_icon.size' => __('Icon size not more than 1 mb.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $icon = GeneralSetting::findOrFail(1);
        
        if($request->hasFile('website_icon'))
        {
            if($icon->website_icon)
            {
                $path = 'assets/frontend/images/icon/'.$icon->website_icon;
                if(file_exists($path)){
                    @unlink($path);
                }
            }

            $file = $request->file('website_icon');
            $iconName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/frontend/images/icon/', $iconName);
            $icon->website_icon = $iconName;
        }

        if($request->hasFile('dashboard_icon'))
        {
            if($icon->dashboard_icon)
            {
                $path = 'assets/admin/img/icons/'.$icon->dashboard_icon;
                if(file_exists($path)){
                    @unlink($path);
                }
            }

            $file = $request->file('dashboard_icon');
            $iconName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/admin/img/icons/', $iconName);
            $icon->dashboard_icon = $iconName;
        }

        $icon->update();

        $message = __('Icon update successfully!');

        return response()->json(['success' => $message]);
    }

    public function social()
    {
        $social = GeneralSetting::findOrFail(1);
        return view('admin.general-setting.social', compact('social'));
    }

    // public function facebookConfig($input)
    // {
    //     $this->setEnv('MAIL_MAILER', $input['mail_driver']);
    //     $this->setEnv('MAIL_HOST',$input['mail_host']);
    //     $this->setEnv('MAIL_PORT',$input['mail_port']);
    //     $this->setEnv('MAIL_USERNAME',$input['mail_username']);
    //     $this->setEnv('MAIL_PASSWORD',$input['mail_password']);
    //     $this->setEnv('MAIL_ENCRYPTION',$input['mail_encryption']);
    //     $this->setEnv('MAIL_FROM_ADDRESS',$input['from_mail']);
    //     $this->setEnv('MAIL_FROM_NAME',$input['from_name']);
    // }

    public function updateFacebook(Request $request)
    {
        $rules = [
            'fb_id' => 'required',
            'fb_secret' => 'required',
            'fb_redirect' => 'required',
        ];

        $customs = [
            'fb_id.required' => __('Facebook client id is required.'),
            'fb_secret.required' => __('Facebook secret id is required.'),
            'fb_redirect.required' => __('Facebook redirect url is required.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('fb_id', 'fb_secret', 'fb_redirect');

        $social = GeneralSetting::findOrFail(1);

        $configData = file_get_contents(config_path().'/services.php');
        $configData = str_replace($social->fb_id, $input['fb_id'], $configData);
        $configData = str_replace($social->fb_secret, $input['fb_secret'], $configData);
        $configData = str_replace($social->fb_redirect, $input['fb_redirect'], $configData);

        file_put_contents(config_path().'/services.php', $configData);

        $social->fill($input)->update();

        $message = __('Facebook update successfully');

        return response()->json(['success' => $message]);
    }

    public function updateGoogle(Request $request)
    {
        $rules = [
            'g_id' => 'required',
            'g_secret' => 'required',
            'g_redirect' => 'required',
        ];

        $customs = [
            'g_id.required' => __('Google client id is required.'),
            'g_secret.required' => __('Google secret id is required.'),
            'g_redirect.required' => __('Google redirect url is required.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }
        
        $input = $request->only('g_id', 'g_secret', 'g_redirect');

        $social = GeneralSetting::findOrFail(1);

        $configData = file_get_contents(config_path().'/services.php');
        $configData = str_replace($social->g_id, $input['g_id'], $configData);
        $configData = str_replace($social->g_secret, $input['g_secret'], $configData);
        $configData = str_replace($social->g_redirect, $input['g_redirect'], $configData);

        file_put_contents(config_path().'/services.php', $configData);

        $social->fill($input)->update();

        $message = __('Google update successfully');

        return response()->json(['success' => $message]);
    }

    public function captcha()
    {
        $captcha = GeneralSetting::findOrFail(1);

        return view('admin.general-setting.captcha', compact('captcha'));
    }

    private function setEnv($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function captchaConfig($input)
    {
        $this->setEnv('NOCAPTCHA_SECRET', $input['captcha_secret']);
        $this->setEnv('NOCAPTCHA_SITEKEY', $input['captcha_sitekey']);
    }

    public function updateCaptcha(Request $request)
    {
        $rules = [
            'captcha_secret' => 'required',
            'captcha_sitekey' => 'required',
        ];

        $customs = [
            'captcha_secret.required' => __('Captcha secret is required.'),
            'captcha_sitekey.required' => __('Captcha site key is required.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }
        
        $input = $request->only('captcha_secret', 'captcha_sitekey');

        $captcha = GeneralSetting::findOrFail(1);

        $this->captchaConfig($input);

        $captcha->fill($input)->update();

        $message = __('Captcha update successfully');

        return response()->json(['success' => $message]);
    }

    public function emailConfig($input)
    {
        $this->setEnv('MAIL_MAILER', $input['driver']);
        $this->setEnv('MAIL_HOST',$input['host']);
        $this->setEnv('MAIL_PORT',$input['port']);
        $this->setEnv('MAIL_USERNAME',$input['username']);
        $this->setEnv('MAIL_PASSWORD',$input['password']);
        $this->setEnv('MAIL_ENCRYPTION',$input['encryption']);
        $this->setEnv('MAIL_FROM_ADDRESS',$input['from_email']);
        $this->setEnv('MAIL_FROM_NAME',$input['from_name']);
    }

    public function mail()
    {
        $mail = Mail::findOrFail(1);

        return view('admin.general-setting.mail', compact('mail'));
    }

    public function updateMail(Request $request)
    {
        $rules = [
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'required',
            'from_email' => 'required|email:rfc,dns',
            'from_name' => 'required'
        ];

        $customs = [
            'driver.required' => __('Mail driver is required.'),
            'host.required' => __('Mail host is required.'),
            'por.required' => __('Mail port is required.'),
            'username.required' => __('Mail username is required.'),
            'password.required' => __('Mail password is required.'),
            'encryption.required' => __('Mail encryption is required.'),
            'from_email.required' => __('From email address is required.'),
            'from_email.email'       => __('Invalid email format.'),
            'from_name.required' => __('From name is required.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('driver', 'host', 'port', 'username', 'password', 'encryption', 'from_email', 'from_name');

        $mail = Mail::findOrFail(1);

        $this->emailConfig($input);

        $mail->fill($input)->update();

        $message = __('Mail update successfully!');

        return response()->json(['success' => $message]);
    }
}
