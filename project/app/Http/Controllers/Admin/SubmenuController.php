<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Submenu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubmenuController extends Controller
{
    public function store(Request $request)
    {
        $host = $_SERVER['HTTP_HOST'];

        if(str_contains($request->url, $host)){
            $url = '';
        }else{
            $url = 'regex:/^(http(s)?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        }

        $rules = [
            'name' => 'required|unique:submenus,name',
            // 'url' => 'required|unique:submenus,url|'.$url,
            'url' => 'required|'.$url,
            'menu_id' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => 'Submenu name is require.',
            'name.unique' => 'This submenu name is already taken.',
            'url.required'  => 'Submenu url is require.',
            // 'url.unique' => 'This url is already taken',
            'url.regex' => 'The url format is invalid.',
            'menu_id.required' => 'Menu is required.',
            'language_id.required' => 'Language is required.'
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errorss' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('name', 'url', 'menu_id', 'language_id');

        $submenu = new Submenu();
        $input['order_id'] = $submenu->max('order_id') + 1;
        $submenu->fill($input)->save();
        $message = __('Submenu create successfully!');

        return response()->json(['successs' => $message]);
    }

    public function status(Request $request, $id)
    {
        $submenu = Submenu::findOrFail($id);
        if($submenu->isPrimary == 1)
        {
            $message = __('Can not deactive primary submenu');
            return response()->json(['infoStatus' => $message]);
        }
        $submenu->isActive = $request->data;
        $submenu->update();
        $message = __('Submenu active successfully!');
        return response()->json(['msg' => $message]);
    }

    public function orderUpdate(Request $request)
    {
        foreach($request->order as $key => $id)
        {
            $submenu = Submenu::find($id);
            $submenu->order_id = $key+1;
            $submenu->update();
        }
        $message = 'submenu update successfully!';
        return response()->json(['messagess' => $message]);
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
            'name' => 'required|unique:submenus,name,'.$id,
            // 'url' => 'required|unique:submenus,url,'.$id.'|'.$url,
            'url' => 'required|'.$url,
            'menu_id' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => 'Submenu name is require.',
            'name.unique' => 'This submenu name is already taken.',
            'url.required'  => 'Submenu url is require.',
            // 'url.unique' => 'This url is already taken', 
            'url.regex' => 'The url format is invalid.',
            'menu_id.required' => 'Menu is required.',
            'language_id.required' => 'Language is required.'
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['submenuerrors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('name', 'url', 'menu_id', 'language_id', 'isPrimary');

        if($request->isPrimary == 'on'){
            $input['isPrimary'] = 1;
        }else{
            $input['isPrimary'] = 0;
        }

        $submenu = Submenu::findOrFail($id);

        if(Page::where('name', $submenu->name)->exists())
        {
            $page = Page::where('name', $submenu->name)->first();
            $page->name = $input['name'];
            $page->slug = Str::slug($input['name']);
            $page->update();
        }

        $submenu->fill($input)->update();
        $message = __('Submenu Update successfully!');

        return response()->json(['submenusuccess' => $message]);
    }

    public function delete($id)
    {
        $submenu = Submenu::findOrFail($id);
        if($submenu->isPrimary == 1)
        {
            $message = __('Can not delete the primary submenu.');
            return response()->json(['infoMsg' => $message]);
        }

        if(Page::where('name', $submenu->name)->exists())
        {
            $message = __('Delete the page first!');
            return response()->json(['infoMsg' => $message]);
        }

        $submenu->delete();
        $message = 'Submenu deleted successfully!';
        return response()->json(['deleteMsg' => $message]);
    }

}
