<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ValueController extends Controller
{

    public function show($id)
    {
        $forms = Form::findOrFail($id);
        $values = $forms->values()->paginate(20);               
        $headers = [];

        if(isset($values[0]))
        {
            foreach($values as $key => $data)
            {
                $a = json_decode($data['value'], true);
                array_push($headers, $a);
            }
        }

        return view('admin.value.show', compact('values', 'headers'));
    }

    public function formIndex()
    {
        return view('admin.value.index');
    }

    public function getValueForm()
    {
        $data = Form::latest()->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('page', function($row){
            $page = Page::where('id', $row->page_id)->first()->name;
            return $page;
        })
        ->addColumn('active', function($row){
            if($row->isActive == 1){
                $btn = '<button class="btn btn-success btn-sm">Active</button>';
                return $btn;
            }else{
                $btn = '<button class="btn btn-danger btn-sm">Deactive</button>';
                return $btn;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'. route('admin.value.show', $row->id) .'" class="btn btn-info btn-sm"><i class="bx bx-show"></i></a>';
            return $btn;
        })
        ->rawColumns(['active', 'action', 'page'])
        ->make(true);
    }

    public function downloadFile($file)
    {
        $path = 'assets/frontend/images/form/file/'.$file;
        $fileName = $file;
        return response()->download($path, $fileName);
    }

    public function downloadImage($image)
    {
        $path = 'assets/frontend/images/form/image/'.$image;
        $imageName = $image;
        return response()->download($path, $imageName);
    }
}
