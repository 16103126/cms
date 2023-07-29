<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteLanguage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('admin.post.index', compact('posts'));
    }

    public function getPost()
    {
        $data = Post::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('category', function($row){
                    $cat = $row->category->name;
                    return $cat;
                })
            ->addColumn('action', function($row){
                $btn = '<a href="'. route('admin.post.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePost'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $languages = WebsiteLanguage::get();

        $categories = Category::get();

        return view('admin.post.create', compact('languages', 'categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'image' => 'required|image|mimes:jpeg,jpg,png,|max:1024',
            'category_id' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Post title is required.'),
            'slug.required' => __('Post slug is required.'),
            'slug.unique' => __('This post slug is already taken.'),
            'image.required' => __('Post image is required.'),
            'image.image' => __('Image must be a image.'),
            'image.mimes' => __('Image must be jpeg, jpg, png'),
            'image.size' => __('Image size not more than 1 mb.'),
            'description.required' => __('Post description is required.'),
            'tag.required' => __('Post tag is required.'),
            'meta_description.required' => __('Meta description is required.'),
            'meta_keyword.required' => __('Meta keyword is required.'),
            'language_id.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('title', 'category_id', 'description', 'meta_keyword', 'meta_description', 'language_id');

        $post = new Post();
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/frontend/images/post/', $imageName);
            $input['image'] = $imageName;
        }

        $input['slug'] = Str::slug($request->slug);
        
        $input['tags'] = json_encode($request->tags);

        $tag = new Tag();

        $tag->name = json_encode($request->tags);

        $tag->post_id = $post->id;

        $tag->save();

        $post->fill($input)->save();

        $message = __('Post create successfully!');

        return response()->json(['success' => $message]);
    }

    public function edit($id)
    {
        $languages = WebsiteLanguage::get();

        $categories = Category::get();

        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('languages', 'post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id,
            'image' => 'image|mimes:jpeg,jpg,png,|max:1024',
            'category_id' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Post title is required.'),
            'slug.required' => __('Post slug is required.'),
            'slug.unique' => __('This post slug is already taken.'),
            'image.image' => __('Image must be a image.'),
            'image.mimes' => __('Image must be jpeg, jpg, png'),
            'image.size' => __('Image size not more than 1 mb.'),
            'description.required' => __('Post description is required.'),
            'tag.required' => __('Post tag is required.'),
            'meta_description.required' => __('Meta description is required.'),
            'meta_keyword.required' => __('Meta keyword is required.'),
            'language_id.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('title', 'category_id', 'description', 'meta_keyword', 'meta_description', 'language_id');

        $post = Post::findOrFail($id);
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/frontend/images/post/', $imageName);
            $input['image'] = $imageName;

            if($post->image)
            {
                $path = 'assets/frontend/images/post/'.$post->image;
                if(file_exists($path)){
                    @unlink($path);
                }
            }

            $input['image'] = $imageName;
        }

        $input['slug'] = Str::slug($request->slug);
        
        $input['tags'] = json_encode($request->tags);

        $tag = Tag::where('post_id', $id)->first();

        $tag->name = json_encode($request->tags, true);

        $tag->post_id = $id;

        $tag->update();

        $post->fill($input)->update();

        $message = __('Post update successfully!');

        return response()->json(['success' => $message]);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        $message = __('Post delete successfully!');

        return response()->json(['success' => $message]);
    }
}
