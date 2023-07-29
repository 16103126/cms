<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageSetting;
use Illuminate\Http\Request;
use App\Models\WebsiteLanguage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PageSettingController extends Controller
{
    public function home()
    {
        $pages = PageSetting::where('name', 'home')->get();

        return view('admin.page-setting.home.index', compact('pages'));
    }

    public function getHome()
    {
        $data = PageSetting::where('name', 'home')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('default', function($row){
                    if($row->isDefault == 1){
                        $btn = '<button class="btn btn-success btn-sm">Default</button>';
                        return $btn;
                    }else{
                        $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Set Default</button>
                                <ul class="dropdown-menu">
                                    <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.page.setting.home.status', $row->id) .'">Set Default</a></li>
                                </ul>';
                        return $btn;
                    }
                })
            ->addColumn('action', function($row){
                    $btn = '<a href="'. route('admin.page.setting.home.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                    <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteHome'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action', 'default'])
            ->make(true);
    }

    public function createHome()
    {
        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.home.create', compact('languages'));
    }

    public function storeHome(Request $request)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Title is required.'),
            'subtitle.required' => __('Subtitle is required.'),
            'description.required' => __('Description is required.'),
            'language.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'home')->where('language_id', $request->language_id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $input = $request->only('title', 'subtitle', 'description', 'language_id');

        $page = new PageSetting();

        $input['name'] = 'home';
        
        $page->fill($input)->save();

        $message = __('Page added successfully!');

        return response()->json(['success' => $message]);
    }

    public function homeEdit($id)
    {
        $page = PageSetting::findOrFail($id);

        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.home.edit', compact('page', 'languages'));
    }

    public function homeUpdate(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Title is required.'),
            'subtitle.required' => __('Subtitle is required.'),
            'description.required' => __('Description is required.'),
            'language.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'home')->where('language_id', $request->language_id)->where('id', '!=', $id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $input = $request->only('title', 'subtitle', 'description', 'language_id');

        $page = PageSetting::findOrFail($id);

        $input['name'] = 'home';
        
        $page->fill($input)->update();

        $message = __('Page update successfully!');

        return response()->json(['success' => $message]);
    }

    public function homeStatus(Request $request, $id)
    {
        $page = PageSetting::findOrFail($id);
        $page->isDefault = $request->data;
        $page->update();

        $page = PageSetting::where('name', 'home')->where('id', '!=', $id)->update(['isDefault' => 0]);

        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function homeDelete($id)
    {
        $page = PageSetting::findOrFail($id);

        if($page->isDefault == 1)
        {
            return response()->json(['errors' => __('Can not delete default page')]);
        }

        $page->delete();

        return response()->json(['success' =>  __('Page delete successfully!')]);
    }

    public function about()
    {
        $pages = PageSetting::where('name', 'about')->get();

        return view('admin.page-setting.about.index', compact('pages'));
    }

    public function getAbout()
    {
        $data = PageSetting::where('name', 'about')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('default', function($row){
                    if($row->isDefault == 1){
                        $btn = '<button class="btn btn-success btn-sm">Default</button>';
                        return $btn;
                    }else{
                        $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Set Default</button>
                                <ul class="dropdown-menu">
                                    <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.page.setting.about.status', $row->id) .'">Set Default</a></li>
                                </ul>';
                        return $btn;
                    }
                })
            ->addColumn('action', function($row){
                    $btn = '<a href="'. route('admin.page.setting.about.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                    <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAbout'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action', 'default'])
            ->make(true);
    }

    public function createAbout()
    {
        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.about.create', compact('languages'));
    }

    public function storeAbout(Request $request)
    {
        $rules = [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,|max:1024',
            'description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Title is required.'),
            'image.required' => __('Image is required.'),
            'image.image' => __('Image must be a image.'),
            'image.mimes' => __('Image must be jpeg, jpg, png'),
            'image.size' => __('Image size not more than 1 mb.'),
            'description.required' => __('Description is required.'),
            'language.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'about')->where('language_id', $request->language_id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $input = $request->only('title', 'description', 'language_id');

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/frontend/images/page/', $imageName);
            $input['image'] = $imageName;
        }

        $page = new PageSetting();

        $input['name'] = 'about';
        
        $page->fill($input)->save();

        $message = __('Page added successfully!');

        return response()->json(['success' => $message]);
    }

    public function aboutEdit($id)
    {
        $page = PageSetting::findOrFail($id);

        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.about.edit', compact('page', 'languages'));
    }

    public function aboutUpdate(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,|max:1024',
            'description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Title is required.'),
            'image.image' => __('Image must be a image.'),
            'image.mimes' => __('Image must be jpeg, jpg, png'),
            'image.size' => __('Image size not more than 1 mb.'),
            'description.required' => __('Description is required.'),
            'language.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'about')->where('language_id', $request->language_id)->where('id', '!=', $id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $input = $request->only('title', 'description', 'language_id');

        $page = PageSetting::findOrFail($id);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/frontend/images/page/', $imageName);

            if($page->image)
            {
                $path = 'assets/frontend/images/page/'.$page->image;
                if(file_exists($path)){
                    @unlink($path);
                }
            }

            $input['image'] = $imageName;
        }

        $input['name'] = 'about';
        
        $page->fill($input)->update();

        $message = __('Page update successfully!');

        return response()->json(['success' => $message]);
    }

    public function aboutStatus(Request $request, $id)
    {
        $page = PageSetting::findOrFail($id);
        $page->isDefault = $request->data;
        $page->update();

        $page = PageSetting::where('name', 'about')->where('id', '!=', $id)->update(['isDefault' => 0]);

        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function aboutDelete($id)
    {
        $page = PageSetting::findOrFail($id);

        if($page->isDefault == 1)
        {
            return response()->json(['errors' => __('Can not delete default page')]);
        }

        if($page->image)
        {
            $path = 'assets/frontend/images/page/'.$page->image;

            if(file_exists($path)){
                @unlink($path);
            }
        }

        $page->delete();

        return response()->json(['success' =>  __('Page delete successfully!')]);
    }

    public function faqs()
    {
        $pages = PageSetting::where('name', 'faqs')->get();

        return view('admin.page-setting.faqs.index', compact('pages'));
    }

    public function getFaqs()
    {
        $data = PageSetting::where('name', 'faqs')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('default', function($row){
                    if($row->isDefault == 1){
                        $btn = '<button class="btn btn-success btn-sm">Default</button>';
                        return $btn;
                    }else{
                        $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Set Default</button>
                                <ul class="dropdown-menu">
                                    <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.page.setting.faqs.status', $row->id) .'">Set Default</a></li>
                                </ul>';
                        return $btn;
                    }
                })
            ->addColumn('action', function($row){
                    $btn = '<a href="'. route('admin.page.setting.faqs.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                    <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFaqs'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action', 'default'])
            ->make(true);
    }

    public function createFaqs()
    {
        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.faqs.create', compact('languages'));
    }

    public function storeFaqs(Request $request)
    {
        $rules = [
            'title' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Page title is required.'),
            'question.required' => __('Question is required.'),
            'answer.required' => __('Answer is required.'),
            'language_id.required' => __('Language is required')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'faqs')->where('language_id', $request->language_id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $faqs = array_combine($request->question, $request->answer);
        
        $description = json_encode($faqs);

        $input = $request->only('title', 'language_id');

        $page = new PageSetting();

        $input['name'] = 'faqs';

        $input['description'] = $description;
        
        $page->fill($input)->save();

        $message = __('Page added successfully!');

        return response()->json(['success' => $message]);
    }

    public function faqsEdit($id)
    {
        $page = PageSetting::findOrFail($id);

        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.faqs.edit', compact('page', 'languages'));
    }

    public function faqsUpdate(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Page title is required.'),
            'question.required' => __('Question is required.'),
            'answer.required' => __('Answer is required.'),
            'language_id.required' => __('Language is required')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'faqs')->where('language_id', $request->language_id)->where('id', '!=', $id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $faqs = array_combine($request->question, $request->answer);
        
        $description = json_encode($faqs);

        $input = $request->only('title', 'language_id');

        $page = PageSetting::findOrFail($id);

        $input['name'] = 'faqs';

        $input['description'] = $description;
        
        $page->fill($input)->update();

        $message = __('Page update successfully!');

        return response()->json(['success' => $message]);
    }

    public function faqsStatus(Request $request, $id)
    {
        $page = PageSetting::findOrFail($id);
        $page->isDefault = $request->data;
        $page->update();

        $page = PageSetting::where('name', 'faqs')->where('id', '!=', $id)->update(['isDefault' => 0]);

        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function faqsDelete($id)
    {
        $page = PageSetting::findOrFail($id);

        if($page->isDefault == 1)
        {
            return response()->json(['errors' => __('Can not delete default page')]);
        }

        $page->delete();

        return response()->json(['success' =>  __('Page delete successfully!')]);
    }

    public function footer()
    {
        $pages = PageSetting::where('name', 'footer')->get();

        return view('admin.page-setting.footer.index', compact('pages'));
    }

    public function getFooter()
    {
        $data = PageSetting::where('name', 'footer')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('default', function($row){
                    if($row->isDefault == 1){
                        $btn = '<button class="btn btn-success btn-sm">Default</button>';
                        return $btn;
                    }else{
                        $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Set Default</button>
                                <ul class="dropdown-menu">
                                    <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.page.setting.footer.status', $row->id) .'">Set Default</a></li>
                                </ul>';
                        return $btn;
                    }
                })
            ->addColumn('action', function($row){
                    $btn = '<a href="'. route('admin.page.setting.footer.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
                    <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFooter'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action', 'default'])
            ->make(true);
    }

    public function createFooter()
    {
        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.footer.create', compact('languages'));
    }

    public function storeFooter(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Title is required.'),
            'description.required' => __('Description is required.'),
            'language.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'footer')->where('language_id', $request->language_id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $input = $request->only('title', 'description', 'language_id');

        $page = new PageSetting();

        $input['name'] = 'footer';
        
        $page->fill($input)->save();

        $message = __('Page added successfully!');

        return response()->json(['success' => $message]);
    }

    public function footerEdit($id)
    {
        $page = PageSetting::findOrFail($id);

        $languages = WebsiteLanguage::get();

        return view('admin.page-setting.footer.edit', compact('page', 'languages'));
    }

    public function footerUpdate(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'language_id' => 'required'
        ];

        $customs = [
            'title.required' => __('Title is required.'),
            'description.required' => __('Description is required.'),
            'language.required' => __('Language is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails()){
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        if(PageSetting::where('name', 'footer')->where('language_id', $request->language_id)->where('id', '!=', $id)->exists())
        {
            $message = [__('This Language is already taken.')];

            return response()->json(['errors' => $message]);
        }

        $input = $request->only('title', 'description', 'language_id');

        $page = PageSetting::findOrFail($id);

        $input['name'] = 'footer';
        
        $page->fill($input)->update();

        $message = __('Page update successfully!');

        return response()->json(['success' => $message]);
    }

    public function footerStatus(Request $request, $id)
    {
        $page = PageSetting::findOrFail($id);
        $page->isDefault = $request->data;
        $page->update();

        $page = PageSetting::where('name', 'footer')->where('id', '!=', $id)->update(['isDefault' => 0]);

        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function footerDelete($id)
    {
        $page = PageSetting::findOrFail($id);

        if($page->isDefault == 1)
        {
            return response()->json(['errors' => __('Can not delete default page')]);
        }

        $page->delete();

        return response()->json(['success' =>  __('Page delete successfully!')]);
    }

  
}
