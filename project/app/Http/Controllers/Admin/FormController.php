<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use App\Models\Page;
use App\Models\Value;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::get();
        return view('admin.form.index', compact('forms'));
    }

    public function getForm()
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
                $btn = '<button class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Active</button>
                        <ul class="dropdown-menu">
                            <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.form.status', $row->id) .'" data-value="0">Set Deactive</a></li>
                        </ul>';
                return $btn;
            }else{
                $btn = '<button class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Deactive</button>
                        <ul class="dropdown-menu">
                            <li id="statusDropdown" style="cursor: pointer;"><a class="dropdown-item" data-href="'. route('admin.form.status', $row->id) .'" data-value="1">Set Active</a></li>
                        </ul>';
                return $btn;
            }
        })
        ->addColumn('action', function($row){
            $btn = '<a href="'. route('admin.form.edit', $row->id) .'" class="btn btn-success btn-sm"><i class="bx bxs-edit-alt"></i></a>
            <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePage'.$row->id.'"><i class="bx bxs-x-circle"></i></button>';
            return $btn;
        })
        ->rawColumns(['active', 'action', 'page'])
        ->make(true);
    }

    public function create()
    {
        $pages = Page::get();
        return view('admin.form.create', compact('pages'));
    }

    public function store(Request $request)
    {
        if($request->form_title == null)
        {
            $message = __('Form title is required.');
            return response()->json(['errorMsg' => $message]);
        }

        $form_array = [];

        $form_array['title'] = $request->form_title;
        $form_array['page_id'] = $request->page_id;

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

        $form = new Form();
        $form->fill($form_array)->save();
        $success = __('Form created successfully!');
        return response()->json(['success' => $success]);
    }

    public function edit($id)
    {
        $form = Form::findOrFail($id);
        $pages = Page::get();
        $inputs = json_decode($form->input, true);
        $textareas = json_decode($form->textarea, true);
        $files = json_decode($form->file, true);
        $images = json_decode($form->image, true);
        $selects = json_decode($form->select, true);
        $checkboxs = json_decode($form->checkbox, true);
        $radios = json_decode($form->radio, true);
        return view('admin.form.edit', compact('form', 'pages', 'inputs', 'textareas', 'files', 'images', 'selects', 'checkboxs', 'radios'));
    }

    public function update(Request $request, $id)
    {
        if($request->form_title == null)
        {
            $message = __('Form title is required.');
            return response()->json(['errorMsg' => $message]);
        }

        $form_array = [];

        $form_array['title'] = $request->form_title;

        $form_array['page_id'] = $request->page_id;

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

        $form = Form::findOrFail($id);
        $form->fill($form_array)->update();
        $success = __('Form updated successfully!');
        return response()->json(['success' => $success]);
    }

    public function status(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        $form->isActive = $request->data;
        $form->update();
        return response()->json(['success' => __('Status update successfully!')]);
    }

    public function value(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        $rules = [];
        if(isset($form['input']))
        {
            $input = json_decode($form['input'], true);
            $names = $input['name'];
            $type = $input['type'];
            $option = $input['option'];
            foreach($names as $key => $name)
            {
                if($option[$key] == 1)
                {
                    $rules[$name] = 'required';
                }
            }
        }

        if(isset($form['textarea']))
        {
            $textarea = json_decode($form['textarea'], true);
            $names = $textarea['name'];
            $option = $textarea['option'];
            foreach($names as $key => $name)
            {
                if($option[$key] == 1)
                {
                    $rules[$name] =  'required';
                }
            }
        }

        if(isset($form['image']))
        {
            $image = json_decode($form['image'], true);
            $names = $image['name'];
            $option = $image['option'];
            foreach($names as $key => $name)
            {
                if($option[$key] == 1)
                {
                    $rules[$name] =  'required|image|mimes:jpeg,jpg,png|max:1000';
                }

                if($option[$key] == 0)
                {
                    $rules[$name] = 'image|mimes:jpeg,jpg,png|max:1000';
                }
            }
        }

        if(isset($form['file']))
        {
            $file = json_decode($form['file'], true);
            $names = $file['name'];
            $option = $file['option'];
            foreach($names as $key => $name)
            {
                if($option[$key] == 1)
                {
                    $rules[$name] = 'required|mimes:doc,docx,pdf|max:2048';
                }

                if($option[$key] == 0)
                {
                    $rules[$name] = 'mimes:doc,docx,pdf|max:2048';
                }
            }
        }

        if(isset($form['select']))
        {
            $select = json_decode($form['select'], true);
            $names = $select['name'];
            $option = $select['option'];

            foreach($names as $key => $name)
            {
                if($option[$key] == 1)
                {
                    $rules[$name] = 'required';
                }
            }
        }
        
        $validate = Validator::make($request->all(), $rules);

        if($validate->fails())
        {
            return response()->json(['errors' => $validate->getMessageBag()->toArray()]);
        }

        $value = new Value();

        $value->form_id = $form->id;
        $input = $request->except('_token');

        if(isset($form['image']))
        {
            $image = json_decode($form['image'], true);
            $names = $image['name'];
            $option = $image['option'];
            foreach($names as $key => $name)
            {
                if($request->hasFile($name))
                {
                    $file = $request->file($name);
                    $imageName = time().str_replace(' ', '', $file->getClientOriginalName());
                    $file->move('assets/frontend/images/form/image/', $imageName);
                    $input[$name] = $imageName;
                }

            }
        }

        if(isset($form['file']))
        {
            $file = json_decode($form['file'], true);
            $names = $file['name'];
            $option = $file['option'];
            foreach($names as $key => $name)
            {
                if($request->hasFile($name))
                {
                    $file = $request->file($name);
                    $fileName = time().str_replace(' ', '', $file->getClientOriginalName());
                    $file->move('assets/frontend/images/form/file/', $fileName);
                    $input[$name] = $fileName;
                }
            }
        }

        $value->value = json_encode($input);
        $value->save();

        $message = __('Form submit successfully!');

        return response()->json(['success' => $message]);
    }

    public function delete($id)
    {
        $form = Form::findOrFail($id);
        $form->delete();
        $success = __('Form Delete successfully!');
        return response()->json(['success' => $success]);
    }
}
