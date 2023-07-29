<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::get();

        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function getData()
    {
        $data = Subscriber::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSubscriber'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action', 'default'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email:rfc,dns|unique:subscribers,email'
        ];

        $customs = [
            'email.required'    => __('Email is required.'),
            'email.email'       => __('Invalid email format.'),
            'email.unique'      => __('You already subscribed.'),
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $subcri = new Subscriber();
        
        $subcri->email = $request->email;

        $subcri->save();

        $message = __('You are successfully subscribed.');

        return response()->json(['success' => $message]);
    }
}
