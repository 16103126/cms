<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\WebsiteLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order_id', 'asc')->get();
        $languages = WebsiteLanguage::get();
        return view('admin.menu.index', compact('menus', 'languages'));
    }

    public function lang($id)
    {
        Session::forget('primary');
        Session::put('lang', $id);
        return back();
    }

    public function primary($id)
    {
        Session::forget('lang');
        Session::put('primary', $id);
        return back();
    }

    public function store(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];

        if(str_contains($request->url, $host)){
            $url = '';
        }else{
            $url = 'regex:/^(http(s)?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        }

        $rules = [
            'name' => 'required|unique:menus,name',
            'url' => 'required|'.$url,
            'position' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => 'Menu name is require.',
            'name.unique' => 'This menu name is already taken',
            'url.required'  => 'Menu url is require.',
            // 'url.unique' => 'This url is already taken',
            'url.regex' => 'The url format is invalid.',
            'position.required' => 'Menu position is require.',
            'language_id.required' => 'Language is required.'
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('name', 'url', 'position', 'language_id');

        $menu = new Menu();
        $input['order_id'] = $menu->max('order_id') + 1;
        $menu->fill($input)->save();
        $message = __('Menu create successfully!');

        return response()->json(['success' => $message]);
    }

    public function status(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        if($menu->isPrimary == 1)
        {
            $message = __('Can not deactive primary menu!');
            return response()->json(['infoStatus' => $message]);
        }
        $menu->isActive = $request->data;
        $menu->update();
        $message = __('Menu status update successfully!');
        return response()->json(['msg' => $message]);
    }

    public function orderUpdate(Request $request)
    {
        foreach($request->order as $key => $id)
        {
            $menu = Menu::find($id);
            $menu->order_id = $key+1;
            $menu->update();
        }
        $message = 'menu update success';
        return response()->json(['message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $host = $_SERVER['HTTP_HOST'];

        if(str_contains($request->url, $host)){
            $url = '';
        }else{
            $url = 'regex:/^(http(s)?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        }

        $rules = [
            'name' => 'required|unique:menus,name,'.$id,
            // 'url' => 'required|unique:menus,url,'.$id.'|'.$url,
            'url' => 'required|'.$url,
            'position' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => 'Menu name is require.',
            'name.unique' => 'This menu name is already taken',
            'url.required'  => 'Menu url is require.',
            // 'url.unique' => 'This url is already taken',
            'url.regex' => 'The url format is invalid.',
            'position.required' => 'Menu position is require.',
            'language_id.required' => 'Language is required.'
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['menuerrors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('name', 'url', 'position', 'language_id', 'isPrimary');

        if($request->isPrimary == 'on'){
            $input['isPrimary'] = 1;
        }else{
            $input['isPrimary'] = 0;
        }

        $menu = Menu::findOrFail($id);
        $menu->fill($input)->update();
        $message = __('Menu update successfully!');

        return response()->json(['menusuccess' => $message]);
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        if($menu->isPrimary == 1)
        {
            $message = __('Can not delete the primary menu!');
            return response()->json(['infoMsg' => $message]);
        }

        if($menu->submenus()->count() > 0)
        {
            $message = __('Delete the submenu first!');
            return response()->json(['infoMsg' => $message]);
        }

        $menu->delete();
        $message = __('Menu deleted successfully!');
        return response()->json(['deleteMsg' => $message]);
    }
}
