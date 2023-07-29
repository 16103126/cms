<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(!Auth::guard('user')->user())
        {
            $message = __('You are not authentic user. Please login.');
            return response()->json(['error' => $message]);
        }

        $rules = [
            'comment' => 'required',
        ];

        $customs = [
            'comment.required' => __('Comment is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $comment = new Comment();

        $comment->user_id = Auth::guard('user')->user()->id;

        $comment->post_id = $request->post_id;

        $comment->comment = $request->comment;

        $comment->save();
    }

    public function update(Request $request, $id)
    {
        if(!Auth::guard('user')->user())
        {
            $message = __('You are not authentic user. Please login.');
            return response()->json(['error' => $message]);
        }

        $rules = [
            'comment' => 'required',
        ];

        $customs = [
            'comment.required' => __('Comment is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $comment = Comment::findOrFail($id);

        if(Auth::guard('user')->user()->id !== $comment->user->id)
        {
            $message = __('You are not authentic user.');
            return response()->json(['error' => $message]);
        }

        $comment->user_id = Auth::guard('user')->user()->id;

        $comment->post_id = $request->post_id;

        $comment->comment = $request->comment;

        $comment->update();
    }

    public function delete($id)
    {
        if(!Auth::guard('user')->user())
        {
            $message = __('You are not authentic user. Please login.');
            return response()->json(['error' => $message]);
        }
        
        $comment = Comment::findOrFail($id);

        if(Auth::guard('user')->user()->id !== $comment->user->id)
        {
            $message = __('You are not authentic user.');
            return response()->json(['error' => $message]);
        }

        $comment->delete();
    }
}
