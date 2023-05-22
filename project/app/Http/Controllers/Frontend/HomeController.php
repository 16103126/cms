<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }

    public function language($id)
    {
        Session::put('language', $id);
        return back();
    }
}
