<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('admin.user.index', compact('users'));
    }

    public function getUser()
    {
        $data = User::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                    $btn = '<a class="btn btn-info btn-sm" href="'. route('admin.user.show', $row->id) .'"><i class="bx bxs-show"></i></a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
                    return $btn;
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $address = json_decode($user->address);
        return view('user.account.profile-show', compact('user', 'address'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // $user->delete();

        $message = __('User delete successfully!');

        return response()->json(['success' => $message]);
    }
}
