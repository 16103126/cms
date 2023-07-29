<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\Form;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::where('language_id', Session::get('language'))->get();
        $blogs = Post::get();
        $users = User::get();
        $forms = Form::get();
        $pages = Page::get();
        return view('frontend.pages.home', compact('posts', 'users', 'forms', 'pages', 'blogs'));
    }

    public function language($id)
    {
        Session::put('language', $id);
        return back();
    }
}
