<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function getContact()
    {
        $data = Contact::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteContact'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:30',
            'email' => 'required|email:rfc,dns',
            'phone_number' => 'required|max:11',
            'subject' => 'required|max:30',
            'message' => 'required'
        ];

        $customs = [
            'name.required' => __('Name is required.'),
            'name.max' => __('Name is not more than 30 character.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Invalid email address.'),
            'phone_number.required' => __('Phone number is required.'),
            'phone_number.max' => __('Phone number not more than 11.'),
            'subject.required' => __('Subject is required.'),
            'subject.max' => __('Subject is not more than 30 character.'),
            'message.required' => __('Message is required.')
        ];

        $validate = Validator::make($request->all(), $rules, $customs);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $input = $request->only('name', 'email', 'phone_number', 'subject', 'message');

        $contact = new Contact();

        $contact->fill($input)->save();

        $message = __('Your message is sent.');

        return response()->json(['success' => $message]);
    }
    
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $message = __('Contact deleted successfully!');
        return response()->json(['success' => $message]);
    }
}
