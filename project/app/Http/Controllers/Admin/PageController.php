<?php

namespace App\Http\Controllers\Admin;

use DomDocument;
use App\Models\Tag;
use App\Models\Form;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Submenu;
use App\Models\Category;
use App\Models\PageSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteLanguage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::get();
        return view('admin.pages.index', compact('pages'));
    }

    public function getPage()
    {
        $data = Page::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('active', function($row){
                if($row->isActive == 1){
                    $btn = '<button class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Active</button>
                            <ul class="dropdown-menu">
                                <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.page.status', $row->id) .'" data-value="0">Set Deactive</a></li>
                            </ul>';
                    return $btn;
                }else{
                    $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Deactive</button>
                            <ul class="dropdown-menu">
                                <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.page.status', $row->id) .'" data-value="1">Set Active</a></li>
                            </ul>';
                    return $btn;
                }
            })
            ->addColumn('action', function($row){
                $btn = '<a href="'. route('admin.page.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePage'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                return $btn;
            })
            ->rawColumns(['action', 'active'])
            ->make(true);
    }
    
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $forms = Form::where('page_id', $page->id)->get();
        return view('frontend.pages.show', compact('page', 'forms'));
    }

    public function menuData($id)
    {
        $language = WebsiteLanguage::findOrFail($id);
        $menu = $language->menus;
        return response()->json(['menu' => $menu]);
    }

    public function create()
    {
        $languages = WebsiteLanguage::get();

        return view('admin.pages.create', compact('languages'));
    }

    public function store(Request $request)
    {
        dd($request->file('file'));
        $reules = [
            'name' => 'required|unique:pages,name|max:20',
            'title' => 'required|unique:pages,title',
            'description' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'name.required' => __('Page name is required.'),
            'name.max' => __('Page name not more than 20 character.'),
            'name.unique' => __('This page name already taken.'),

            'title.required' => __('Page title is required'),
            'title.unique' => __('This page title already taken.'),

            'description.required' => __('Page content is required.'),
            'meta_keywords.required' => __('Page meta keywords is required.'),
            'meta_description.required' => __('Page meta description is required'),
            'language_id.required' => __('Page language is required'),
        ];

        $validate = Validator::make($request->all(), $reules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $data = $request->only('name', 'title', 'description', 'meta_keywords', 'meta_description', 'language_id');

        if($request->menu == 2)
        {
            $data['menu_id'] = $request->menu_id;
        }

        if($request->menu == 1)
        {
            $data['menu_id'] = 0;
        }

        $data['slug'] = Str::slug($request->name);
        
        
        if($request->form == 1)
        {
            if($request->form_title == null)
            {
                $message = __('Form title is required.');
                return response()->json(['errorMsg' => $message]);
            }

            $form_array = [];

            $form_array['title'] = $request->form_title;

            if($request->input == 1)
            {
                foreach($request->input_name as $name)
                {
                    if($name == null)
                    {
                        $message = __('Input name is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                $input_array = [];
                $input_array['name'] = $request->input_name;
                $input_array['type'] = $request->input_type;
                $input_array['option'] = $request->input_option;
                $input = json_encode($input_array);
                $form_array['input'] = $input;
            }

            if($request->textarea == 1)
            {
                foreach($request->textarea_name as $name)
                {
                    if($name == null)
                    {
                        $message = __('Textarea name is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                $textarea_array = [];
                $textarea_array['name'] = $request->textarea_name;
                $textarea_array['option'] = $request->textarea_option;
                $textarea = json_encode($textarea_array);
                $form_array['textarea'] = $textarea;
            }

            if($request->image == 1)
            {
                foreach($request->image_label as $label)
                {
                    if($label == null)
                    {
                        $message = __('Image label is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                foreach($request->image_name as $name)
                {
                    if($name == null)
                    {
                        $message = __('Image name is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                $image_array = [];
                $image_array['label'] = $request->image_label;
                $image_array['name'] = $request->image_name;
                $image_array['option'] = $request->image_option;
                $image = json_encode($image_array);
                $form_array['image'] = $image;
            }

            if($request->file == 1)
            {
                foreach($request->file_label as $label)
                {
                    if($label == null)
                    {
                        $message = __('File label is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                foreach($request->file_name as $name)
                {
                    if($name == null)
                    {
                        $message = __('File name is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                $file_array = [];
                $file_array['label'] = $request->file_label;
                $file_array['name'] = $request->file_name;
                $file_array['option'] = $request->file_option;
                $file = json_encode($file_array);
                $form_array['file'] = $file;
            }

            if($request->select == 1)
            {
                foreach($request->select_name as $name)
                {
                    if($name == null)
                    {
                        $message = __('Select name is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                foreach($request->option_value as $value)
                {
                    if($value == null)
                    {
                        $message = __('Option value is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                $select_array = [];
                $select_array['name'] = $request->select_name;
                $select_array['option'] = $request->option_option;
                $select_array['value'] = $request->option_value;
                $select = json_encode($select_array);
                $form_array['select'] = $select;
            }

            if($request->checkbox == 1)
            {
                foreach($request->checkbox_title as $title)
                {
                    if($title == null)
                    {
                        $message = __('Checkbox title is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                foreach($request->checkbox_name as $name)
                {
                    if($name == null)
                    {
                        $message = __('Checkbox name is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                foreach($request->checkbox_value as $value)
                {
                    if($value == null)
                    {
                        $message = __('Checkbox value is required.');
                        return response()->json(['errorMsg' => $message]);
                    }
                }
                $checkbox_array = [];
                $checkbox_array['title'] = $request->checkbox_title;
                $name= $request->checkbox_name;
                $value = $request->checkbox_value;
                $checkbox_comb = array_combine($name, $value);
                $checkbox_array['checkbox_comb'] = $checkbox_comb;
                $checkbox = json_encode($checkbox_array);
                $form_array['checkbox'] = $checkbox;
            }

            if($request->radio == 1)
            {
                $radio_array = [];
                $radio_array['name'] = $request->radio_name;
                $radio_array['value'] = $request->radio_value;
                $radio = json_encode($radio_array);
                $form_array['radio'] = $radio;
            }

            $page = new Page();
            $page->fill($data)->save();

            $form_array['page_id'] = $page->id;
            $form = new Form();
            $form->fill($form_array)->save();

            if($request->menu == 2){

                $submenu = new Submenu();
                $submenu->name = $page->name;
                $submenu->language_id = $page->language_id;
                $submenu->url = route('page', $page->slug);
                $submenu->order_id = $submenu->max('order_id') + 1;
                $submenu->menu_id = $page->menu_id;
                $submenu->save();
                $success = __('Page created successfully!');
                return response()->json(['success' => $success]);
            }else{
    
                $menu = new Menu();
                $menu->name = $page->name;
                $menu->language_id = $page->language_id;
                $menu->url = route('page', $page->slug);
                $menu->order_id = $menu->max('order_id') + 1;
                $menu->position = 'header';
                $menu->save();
                $success = __('Page created successfully!');
                return response()->json(['success' => $success]);
            }
        }

        $page = new Page();
        $page->fill($data)->save();

        if($request->menu == 2){

            $submenu = new Submenu();
            $submenu->name = $page->name;
            $submenu->language_id = $page->language_id;
            $submenu->url = route('page', $page->slug);
            $submenu->order_id = $submenu->max('order_id') + 1;
            $submenu->menu_id = $page->menu_id;
            $submenu->save();
            $success = __('Page created successfully!');
            return response()->json(['success' => $success]);
        }else{

            $menu = new Menu();
            $menu->name = $page->name;
            $menu->language_id = $page->language_id;
            $menu->url = route('page', $page->slug);
            $menu->order_id = $menu->max('order_id') + 1;
            $menu->position = 'header';
            $menu->save();
            $success = __('Page created successfully!');
            return response()->json(['success' => $success]);
        }
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $languages = WebsiteLanguage::get();
        return view('admin.pages.edit', compact('page', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $reules = [
            'title' => 'required|unique:pages,title,'.$id,
            'description' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ];

        $customs = [
            'title.required' => __('Page title is required'),
            'title.unique' => __('This page title already taken.'),

            'description.required' => __('Page content is required.'),
            'meta_keywords.required' => __('Page meta keywords is required.'),
            'meta_description.required' => __('Page meta description is required'),
        ];
        $validate = Validator::make($request->all(), $reules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $data = $request->only('name', 'title', 'description', 'meta_keywords', 'meta_description', 'language_id');

        if($request->menu == 2)
        {
            $data['menu_id'] = $request->menu_id;
        }

        if($request->menu == 1)
        {
            $data['menu_id'] = 0;
        }

        $data['slug'] = Str::slug($request->name);
        
        
        if($request->form == 1)
        {
            if($request->form_title == null)
            {
                $message = __('Form title is required.');
                return response()->json(['errorMsg' => $message]);
            }

            $form_array = [];

            $form_array['title'] = $request->form_title;

            if($request->input == 1)
            {
                $input_array = [];
                $input_array['name'] = $request->input_name;
                $input_array['type'] = $request->input_type;
                $input_array['option'] = $request->input_option;
                $input = json_encode($input_array);
                $form_array['input'] = $input;
            }

            if($request->textarea == 1)
            {
                $textarea_array = [];
                $textarea_array['name'] = $request->textarea_name;
                $textarea_array['option'] = $request->textarea_option;
                $textarea = json_encode($textarea_array);
                $form_array['textarea'] = $textarea;
            }

            if($request->image == 1)
            {
                $image_array = [];
                $image_array['label'] = $request->image_label;
                $image_array['name'] = $request->image_name;
                $image_array['option'] = $request->image_option;
                $image = json_encode($image_array);
                $form_array['image'] = $image;
            }

            if($request->file == 1)
            {
                $file_array = [];
                $file_array['label'] = $request->file_label;
                $file_array['name'] = $request->file_name;
                $file_array['option'] = $request->file_option;
                $file = json_encode($file_array);
                $form_array['file'] = $file;
            }

            if($request->select == 1)
            {
                $select_array = [];
                $select_array['name'] = $request->select_name;
                $select_array['option'] = $request->option_option;
                $select_array['value'] = $request->option_value;
                $select = json_encode($select_array);
                $form_array['select'] = $select;
            }

            if($request->checkbox == 1)
            {
                $checkbox_array = [];
                $checkbox_array['title'] = $request->checkbox_title;
                $name= $request->checkbox_name;
                $value = $request->checkbox_value;
                $checkbox_comb = array_combine($name, $value);
                $checkbox_array['checkbox_comb'] = $checkbox_comb;
                $checkbox = json_encode($checkbox_array);
                $form_array['checkbox'] = $checkbox;
            }

            if($request->radio == 1)
            {
                $radio_array = [];
                $radio_array['name'] = $request->radio_name;
                $radio_array['value'] = $request->radio_value;
                $radio = json_encode($radio_array);
                $form_array['radio'] = $radio;
            }

            $page = Page::findOrFail($id);
            $page->fill($data)->update();

            $form_array['page_id'] = $page->id;
            $form = new Form();
            $form->fill($form_array)->save();
        }

        $page = Page::findOrFail($id);
        $page_name = $page->name;
        $page->fill($data)->update();

        $page = Page::findOrFail($id);

        if($request->menu == 2){

            if(Submenu::where('name', $page_name)->exists())
            {
                $submenu = Submenu::where('name', $page_name)->first();
                $submenu->name = $page->name;
                $submenu->language_id = $page->language_id;
                $submenu->url = route('page', $page->slug);
                $submenu->menu_id = $page->menu_id;
                $submenu->update();
            }else{
                $submenu = new Submenu();
                $submenu->name = $page->name;
                $submenu->language_id = $page->language_id;
                $submenu->url = route('page', $page->slug);
                $submenu->order_id = $submenu->max('order_id') + 1;
                $submenu->menu_id = $page->menu_id;
                $submenu->save();

                if(Menu::where('name', $page_name)->exists())
                {
                    $menu = Menu::where('name', $page_name)->first();
                    $menu->delete();
                }
            }

            $success = __('Page update successfully!');
            return response()->json(['success' => $success]);
        }

        if(Menu::where('name', $page_name)->exists())
        {
            $menu = Menu::where('name', $page_name)->first();
            $menu->name = $page->name;
            $menu->language_id = $page->language_id;
            $menu->url = route('page', $page->slug);
            $menu->update();
        }else{
            $menu = new Menu();
            $menu->name = $page->name;
            $menu->url = route('page', $page->slug);
            $menu->order_id = $menu->max('order_id') + 1;
            $menu->language_id = $page->language_id;
            $menu->position = 'header';
            $menu->save();
            if(Submenu::where('name', $page_name)->exists())
            {
                $submenu = Submenu::where('name', $page_name)->first();
                $submenu->delete();
            }
        }
        
        $success = __('Page update successfully!');
        return response()->json(['success' => $success]);
    }

    public function status(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->isActive = $request->data;
        $page->update();
        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function delete($id)
    {
        $page = Page::findOrFail($id);
        $menu = Menu::where('name', $page->name)->first();
        $submenu = Submenu::where('menu_id', $page->menu_id)->first();

        if($menu !== null && $menu->submenus()->count() < 1)
        {
            $menu->delete();
        }

        if($submenu !== null)
        {
            $submenu->delete();
        }
        
        $page->delete();

        $message = __('Page delete successfully!');

        return response()->json(['success' => $message]);
    }

    public function about()
    {
        if( PageSetting::where('name', 'about')->where('language_id', Session::get('language'))->exists())
        {
            $page = PageSetting::where('name', 'about')->where('language_id', Session::get('language'))->first();
        }else{
            $page = PageSetting::where('name', 'about')->where('isDefault', 1)->first();
        }

        return view('frontend.pages.about', compact('page'));
    }

    public function faqs()
    {
        if( PageSetting::where('name', 'faqs')->where('language_id', Session::get('language'))->exists())
        {
            $page = PageSetting::where('name', 'faqs')->where('language_id', Session::get('language'))->first();

            $description = json_decode($page->description, true);
        }else{
            $page = PageSetting::where('name', 'faqs')->where('isDefault', 1)->first();

            $description = json_decode($page->description, true);
        }

        return view('frontend.pages.faqs', compact('page', 'description'));
    }

    public function blog()
    {
        $posts = Post::where('language_id', Session::get('language'))->get();
        
        return view('frontend.pages.blog', compact('posts'));
    }

    public function blogDetail($slug)
    {
        $post = Post::where('slug', $slug)->where('language_id', Session::get('language'))->first();

        $recent_posts = Post::Where('language_id', Session::get('language'))->orderBy('id', 'desc')->take(5)->get();

        $categories = Category::Where('language_id', Session::get('language'))->get();

        return view('frontend.pages.single-blog', compact('post', 'categories', 'recent_posts'));
    }

    public function blogCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts;
        return view('frontend.pages.category-blog', compact('posts'));
    }

    public function blogTag($name)
    {
        $array = [];

        $tags = Tag::get();
        
        foreach($tags as $tag)
        {
            $d = json_decode($tag->name, true);
            $c = implode($d);
            $str = explode(',', $c);
            if(in_array($name, $str))
            {
                $array['post_id'] = $tag->post_id;
            }
        }

        $posts = [];
        foreach($array as $id)
        {
            $post = Post::where('id', $id)->first();
            $posts = $post;
        }
        
        return view('frontend.pages.tag-blog', compact('posts'));
    }
}
