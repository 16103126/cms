<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        if(!Auth::guard('user')->user())
        {
            $message = __('You are not authentic user. Please login.');
            return response()->json(['error' => $message]);
        }

        $rules = [
            'reply' => 'required',
        ];

        $customs = [
            'reply.required' => __('Comment reply is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $reply = new Reply();

        $reply->user_id = Auth::guard('user')->user()->id;

        $reply->comment_id = $request->comment_id;

        $reply->reply = $request->reply;

        $reply->save();
    }

    public function update(Request $request, $id)
    {
        if(!Auth::guard('user')->user())
        {
            $message = __('You are not authentic user. Please login.');
            return response()->json(['error' => $message]);
        }

        $rules = [
            'reply' => 'required',
        ];

        $customs = [
            'reply.required' => __('Comment reply is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $reply = Reply::findOrFail($id);

        if(Auth::guard('user')->user()->id !== $reply->user->id)
        {
            $message = __('You are not authentic user.');
            return response()->json(['error' => $message]);
        }

        $reply->user_id = Auth::guard('user')->user()->id;

        $reply->comment_id = $request->comment_id;

        $reply->reply = $request->reply;

        $reply->update();
    }

    public function delete($id)
    {
        if(!Auth::guard('user')->user())
        {
            $message = __('You are not authentic user. Please login.');
            return response()->json(['error' => $message]);
        }

        $reply = Reply::findOrFail($id);

        if(Auth::guard('user')->user()->id !== $reply->user->id)
        {
            $message = __('You are not authentic user.');
            return response()->json(['error' => $message]);
        }

        $reply->delete();
    }
}
