<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class WebsiteLanguageController extends Controller
{
    public function index()
    {
        $languages = WebsiteLanguage::get();
        return view('admin.website-language.index', compact('languages'));
    }

    public function getLanguage()
    {
        $data = WebsiteLanguage::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('default', function($row){
                    if($row->isDefault == 1){
                        $btn = '<button class="btn btn-success btn-sm">Default</button>';
                        return $btn;
                    }else{
                        $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Set Default</button>
                                <ul class="dropdown-menu">
                                    <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.website-language.status', $row->id) .'">Set Default</a></li>
                                </ul>';
                        return $btn;
                    }
                })
            ->addColumn('action', function($row){
                    $btn = '<a href="'. route('admin.website-language.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                    <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLanguage'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action', 'default'])
            ->make(true);
    }
    
    public function create()
    {
        return view('admin.website-language.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'language' => 'required|unique:website_languages,language'
        ];

        $customs = [
            'language.required' => 'Language is required',
            'language.unique' => 'This language is already taken.'
        ];

        $validate = Validator::make($request->all(),$rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $language = new WebsiteLanguage();
        $language->language = $request->language;
        $language->name = time().Str::random(8);

        if($language->count() < 1)
        {
            $language->isDefault = 1;
        }

        $language->file = $language->name.'.json';

        $language->save();

        $lang = [];

        $keys = $request->keys;
        $values = $request->values;

        foreach(array_combine($keys, $values) as $key => $value)
        {
            $n = str_replace('_', ' ', $key);
            $lang[$n] = $value;
        }

        $data = json_encode($lang);

        file_put_contents(lang_path().'/'.$language->file, $data);

        $message = __('Language addes successfully!');

        return response()->json(['success' => $message]);

    }

    public function status(Request $request, $id)
    {
        $language = WebsiteLanguage::findOrFail($id);
        $language->isDefault = $request->data;
        $language->update();

        $language = WebsiteLanguage::where('id', '!=', $id)->update(['isDefault' => 0]);

        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function edit($id)
    {
        $language = WebsiteLanguage::findOrFail($id);
        $langFile = file_get_contents(lang_path().'/'.$language->file);
        $langData = json_decode($langFile);
        return view('admin.website-language.edit', compact('language', 'langData'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'language' => 'required|unique:website_languages,language,'.$id
        ];

        $customs = [
            'language.required' => 'Language is required',
            'language.unique' => 'This language is already taken.'
        ];

        $validate = Validator::make($request->all(),$rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $language = WebsiteLanguage::findOrFail($id);
        $language->language = $request->language;
        $language->name = time().Str::random(8);

        if($language->count() < 1)
        {
            $language->isDefault = 1;
        }

        if(File::exists(lang_path().'/'.$language->file))
        {
            File::delete(lang_path().'/'.$language->file);
        }

        $language->file = $language->name.'.json';

        $language->update();

        $lang = [];

        $keys = $request->keys;
        $values = $request->values;

        foreach(array_combine($keys, $values) as $key => $value)
        {
            $n = str_replace('_', ' ', $key);
            $lang[$n] = $value;
        }

        $data = json_encode($lang);

        file_put_contents(lang_path().'/'.$language->file, $data);

        $message = __('Language Update successfully!');

        return response()->json(['success' => $message]);
    }

    public function delete($id)
    {
        $language = WebsiteLanguage::findOrFail($id);

        if($language->isDefault == 1)
        {
            return response()->json(['errors' => __('Can not delete default language')]);
        }

        if(File::exists(lang_path().'/'.$language->file))
        {
            File::delete(lang_path().'/'.$language->file);
        }

        $language->delete();

        return response()->json(['success' =>  __('Language delete successfully!')]);
    }
}
