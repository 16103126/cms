<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteLanguage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', compact('categories'));
    }

    public function getCategory()
    {
        $data = Category::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    $btn = '<a href="'. route('admin.category.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $languages = WebsiteLanguage::get();

        return view('admin.category.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,',
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => __('Category name is required.'),
            'slug.required' => __('Category slug is required.'),
            'slug.unique' => __('This category slug is already taken.'),
            'language_id.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $category = new Category();
        
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->language_id = $request->language_id;
        $category->save();

        $message = __('Category create successfully!');

        return response()->json(['success' => $message]);
    }

    public function edit($id)
    {
        $languages = WebsiteLanguage::get();

        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('languages', 'category'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => __('Category name is required.'),
            'slug.required' => __('Category slug is required.'),
            'slug.unique' => __('This category slug is already taken.'),
            'language_id.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $category = Category::findOrFail($id);
        
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->language_id = $request->language_id;
        $category->update();

        $message = __('Category update successfully!');

        return response()->json(['success' => $message]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if($category->posts->count() < 1)
        {
            $message = __('Delete this category post.');

            return response()->json(['errors' => $message]);
        }

        $category->delete();

        $message = __('Category delete successfully!');

        return response()->json(['success' => $message]);
    }
}
