@extends('admin.master')

@section('title', __('Edit Form'))

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item {{ (Request::is('admin/dashboard')) ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/form/index')) ? 'active' : '' }}">
                        <a href="{{ route('admin.form.index') }}">@lang('Manage Forms')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/form/edit*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.form.edit', $form->id) }}">@lang('Edit Form')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Edit Form')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.form.update', $form->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Form name')</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="form_title" class="form-control" id="basic-default-name" value="{{ $form->title }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="langSeletct" class="col-sm-3 col-form-label">@lang(' Select Page')</label>
                                        <div class="col-sm-9">
                                            <select id="langSeletct" name="page_id" class="form-select">
                                                @foreach ($pages as $page)
                                                    <option value="{{ $page->id }}" {{ $page->id == $form->page_id ? 'selected' : '' }}>{{ $page->name }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="mt-5" id="makeForm">
                                            <div class="row mb-3 input">
                                                <div class="form-check mb-3">
                                                    <input name="input" class="form-check-input" type="checkbox" value="1" id="inputCheckbox" {{ $inputs !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inputCheckbox"> @lang('Input') </label>
                                                </div>
                                                <div class="{{ $inputs == null ? 'd-none' : ''}}" id="inputForm">
                                                    <div id="addInputGroup">
                                                        @if ($inputs !== null) 
                                                        @foreach ($inputs['name'] as $key => $name)
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="input_name[]" class="form-control" value="{{ $name }}">
                                                            <select name="input_type[]" class="form-select">
                                                                <option value="text" {{ $inputs['type'][$key] == 'text' ? 'selected' : ''}}>@lang('Text')</option>
                                                                <option value="email" {{ $inputs['type'][$key] == 'email' ? 'selected' : ''}}>@lang('Email')</option>
                                                                <option value="password" {{ $inputs['type'][$key] == 'password' ? 'selected' : ''}}>@lang('Password')</option>
                                                                <option value="number" {{ $inputs['type'][$key] == 'number' ? 'selected' : ''}}>@lang('Number')</option>
                                                            </select>
                                                            <select name="input_option[]" class="form-select">
                                                                <option value="1" {{ $inputs['option'][$key] == 1 ? 'selected' : ''}}>@lang('Required')</option>
                                                                <option value="0" {{ $inputs['option'][$key] == 0 ? 'selected' : ''}}>@lang('Optional')</option>
                                                            </select>
                                                            <button type="button" class="btn btn-sm btn-danger removeInputBtn"><i class='bx bx-minus'></i></button>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                    <button type="button" id="inputAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 textarea">
                                                <div class="form-check mb-3">
                                                    <input name="textarea" class="form-check-input" type="checkbox" value="1" id="textareaCheckbox" {{ $textareas !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="textareaCheckbox"> @lang('Textarea') </label>
                                                </div>
                                                <div class="{{ $textareas == null ? 'd-none' : ''}}" id="textareaForm">
                                                    <div id="addTextareaGroup">
                                                        @if ($textareas !== null)
                                                        @foreach ($textareas['name'] as $key => $name)
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="textarea_name[]" class="form-control" value="{{ $name }}">
                                                            <select name="textarea_option[]" class="form-select">
                                                                <option value="1" {{ $textareas['option'][$key] == 1 ? 'selected' : '' }}>@lang('Required')</option>
                                                                <option value="0" {{ $textareas['option'][$key] == 1 ? 'selected' : '' }}>@lang('Optional')</option>
                                                            </select>
                                                            <button type="button" class="btn btn-sm btn-danger removeTextareaBtn"><i class='bx bx-minus'></i></button>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <div class="input-group">
                                                            <input type="text" name="textarea_name[]" class="form-control" placeholder="{{ __('Name') }}">
                                                            <select name="textarea_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <button type="button" id="textareaAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 image">
                                                <div class="form-check mb-3">
                                                    <input name="image" class="form-check-input" type="checkbox" value="1" id="imageCheckbox" {{ $images !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="imageCheckbox"> @lang('Image') </label>
                                                </div>
                                                <div class="{{ $images == null ? 'd-none' : ''}}" id="imageForm">
                                                    <div id="addImageGroup">
                                                        @if ($images !== null)
                                                        @foreach ($images['name'] as $key => $name)
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="image_label[]" class="form-control" value="{{ $images['label'][$key] }}">
                                                            <input type="text" name="image_name[]" class="form-control" value="{{ $name }}">
                                                            <select name="image_option[]" class="form-select">
                                                                <option value="1" {{ $images['option'][$key] == 1 ? 'selected' : '' }}>@lang('Required')</option>
                                                                <option value="0" {{ $images['option'][$key] == 0 ? 'selected' : '' }}>@lang('Optional')</option>
                                                            </select>
                                                            <button type="button" class="btn btn-sm btn-danger" id="removeImageBtn"><i class='bx bx-minus'></i></button>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <div class="input-group">
                                                            <input type="text" name="image_label[]" class="form-control" placeholder="{{ __('Label name') }}">
                                                            <input type="text" name="image_name[]" class="form-control" placeholder="{{ __('Name') }}">
                                                            <select name="image_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <button type="button" id="imageAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 file">
                                                <div class="form-check mb-3">
                                                    <input name="file" class="form-check-input" type="checkbox" value="1" id="fileCheckbox" {{ $files !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="fileCheckbox"> @lang('File') </label>
                                                </div>
                                                <div class="{{ $files == null ? 'd-none' : ''}}" id="fileForm">
                                                    <div id="addFileGroup">
                                                        @if ($files !== null)
                                                        @foreach ($files['name'] as $key => $name)
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="file_label[]" class="form-control" value="{{ $files['label'][$key] }}">
                                                            <input type="text" name="file_name[]" class="form-control" value="{{ $name }}">
                                                            <select name="file_option[]" class="form-select">
                                                                <option value="1" {{ $files['option'][$key] == 1 ? 'selected' : '' }}>@lang('Required')</option>
                                                                <option value="0" {{ $files['option'][$key] == 0 ? 'selected' : '' }}>@lang('Optional')</option>
                                                            </select>
                                                            <button type="button" class="btn btn-sm btn-danger" id="removeFileBtn"><i class='bx bx-minus'></i></button>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <div class="input-group">
                                                            <input type="text" name="file_label[]" class="form-control" placeholder="{{ __('Label naem') }}">
                                                            <input type="text" name="file_name[]" class="form-control" placeholder="{{ __('Name') }}">
                                                            <select name="file_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <button type="button" id="fileAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 select">
                                                <div class="form-check mb-3">
                                                    <input name="select" class="form-check-input" type="checkbox" value="1" id="selectCheckbox" {{ $selects !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="selectCheckbox"> @lang('Select') </label>
                                                </div>
                                                <div class="{{ $selects == null ? 'd-none' : ''}}" id="selectForm">
                                                    <div id="addSelectGroup">
                                                        <div class="input-group mb-3">
                                                            @if ($selects !== null)
                                                            @foreach ($selects['name'] as $key => $name)
                                                            <input type="text" name="select_name[]" class="form-control" value="{{ $name }}">
                                                            <select name="option_option[]" class="form-select">
                                                                <option value="1" {{ $selects['option'][$key] == 1 ? 'selected' : '' }}>@lang('Required')</option>
                                                                <option value="0" {{ $selects['option'][$key] == 0 ? 'selected' : '' }}>@lang('Optional')</option>
                                                            </select>
                                                            @endforeach
                                                            @else
                                                            <input type="text" name="select_name[]" class="form-control" placeholder="{{ __('Enter name') }}">
                                                            <select name="option_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                            @endif
                                                        </div>
                                                        @if ($selects !== null)
                                                        @foreach ($selects['value'] as $value)
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="option_value[]" class="form-control" value="{{ $value }}">
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="option_value[]" class="form-control" placeholder="{{ __('Enter value') }}">
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <button type="button" id="optionAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 checkbox">
                                                <div class="form-check mb-3">
                                                    <input name="checkbox" class="form-check-input" type="checkbox" value="1" id="checkboxCheckbox" {{ $checkboxs !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkboxCheckbox"> @lang('Checkbox') </label>
                                                </div>
                                                <div class="{{ $checkboxs == null ? 'd-none' : ''}}" id="checkboxForm">
                                                    <div id="addCheckboxGroup mb-3">
                                                        @if ($checkboxs !== null)
                                                        @foreach ($checkboxs['title'] as $title)
                                                        <input type="text" name="checkbox_title[]" class="form-control" value="{{ $title }}">
                                                        @endforeach
                                                        @foreach ($checkboxs['checkbox_comb'] as $key => $name)
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="checkbox_name[]" class="form-control" value="{{ $name }}">
                                                            <input type="text" name="checkbox_value[]" class="form-control" value="{{ $key }}">
                                                            <button type="button" class="btn btn-sm btn-danger" id="removeCheckboxBtn"><i class='bx bx-minus'></i></button>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <input type="text" name="checkbox_title[]" class="form-control" placeholder="{{ __('Checkbox title') }}">
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="checkbox_name[]" class="form-control" placeholder="{{ __('Checkbox name') }}">
                                                            <input type="text" name="checkbox_value[]" class="form-control" placeholder="{{ __('Checkbox value') }}">
                                                        </div>
                                                        @endif
                                                        <div class="addCheckboxGroup">

                                                        </div>
                                                    </div>
                                                    <button type="button" id="checkboxAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row radio">
                                                <div class="form-check mb-3">
                                                    <input name="radio" class="form-check-input" type="checkbox" value="1" id="radioCheckbox" {{ $radios !== null ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="radioCheckbox"> @lang('Radio') </label>
                                                </div>
                                                <div class="{{ $radios == null ? 'd-none' : ''}}" id="radioForm">
                                                    <div id="mb-3">
                                                        @if ($radios !== null)
                                                        @foreach ($radios['name'] as $name)
                                                        <input type="text" name="radio_name[]" class="form-control" value="{{ $name }}">
                                                        @endforeach
                                                        @foreach ($radios['value'] as $value)
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="radio_value[]" class="form-control" value="{{ $value }}">
                                                            <button type="button" class="btn btn-sm btn-danger" id="removeRadioBtn"><i class='bx bx-minus'></i></button>
                                                        </div>
                                                        @endforeach
                                                        @else
                                                        <input type="text" name="radio_name[]" class="form-control" placeholder="{{ __('Radio name') }}">
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="radio_value[]" class="form-control" placeholder="{{ __('Radio value') }}">
                                                        </div>
                                                        @endif
                                                        <div class="addRadioGroup">

                                                        </div>
                                                    </div>
                                                    <button type="button" id="radioAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- Content wrapper -->
    
@endsection

@push('js')



<script>

    $(document).on('click', '.removeInputBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).on('click', '.removeTextareaBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).on('click', '#removeImageBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).on('click', '#removeFileBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).on('click', '#removeOptionBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).on('click', '#removeCheckboxBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).on('click', '#removeRadioBtn', function(){
        $(this).parents('.input-group').remove();
    });

    $(document).ready(function(){

        let input = `<div class="input-group mt-3" id="input-group">
                        <input type="text" name="input_name[]" class="form-control" placeholder="Enter input name">
                        <select name="input_type[]" class="form-select">
                            <option value="text">@lang('Text')</option>
                            <option value="email">@lang('Email')</option>
                            <option value="password">@lang('Password')</option>
                            <option value="number">@lang('Number')</option>
                        </select>
                        <select name="input_option[]" class="form-select">
                            <option value="1">@lang('Required')</option>
                            <option value="0">@lang('Optional')</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-danger removeInputBtn"><i class='bx bx-minus'></i></button>
                    </div>`;

        let textarea = `<div class="input-group mt-3" id="input-group">
                        <input type="text" name="textarea_name[]" class="form-control" placeholder="Enter textarea name">
                        <select name="textarea_option[]" class="form-select">
                            <option value="1">@lang('Required')</option>
                            <option value="0">@lang('Optional')</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-danger removeTextareaBtn"><i class='bx bx-minus'></i></button>
                    </div>`;
        
        let image = `<div class="input-group mt-3">
                        <input type="text" name="image_label[]" class="form-control" placeholder="{{ __('Label name') }}">
                        <input type="text" name="image_name[]" class="form-control" placeholder="{{ __('Name') }}">
                        <select name="image_option[]" class="form-select">
                            <option value="1">@lang('Required')</option>
                            <option value="0">@lang('Optional')</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-danger" id="removeImageBtn"><i class='bx bx-minus'></i></button>
                    </div>`;
        
        let file = `<div class="input-group mt-3">
                        <input type="text" name="file_label[]" class="form-control" placeholder="{{ __('Label name') }}">
                        <input type="text" name="file_name[]" class="form-control" placeholder="{{ __('Name') }}">
                        <select name="file_option[]" class="form-select">
                            <option value="1">@lang('Required')</option>
                            <option value="0">@lang('Optional')</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-danger" id="removeFileBtn"><i class='bx bx-minus'></i></button>
                    </div>`;

        let option = `<div class="input-group mt-3">
                        <input type="text" name="option_value[]" class="form-control" placeholder="{{ __('Option value') }}">
                        <button type="button" class="btn btn-sm btn-danger" id="removeOptionBtn"><i class='bx bx-minus'></i></button>
                    </div>`;

        let checkbox = `<div class="input-group mt-3">
                            <input type="text" name="checkbox_name[]" class="form-control" placeholder="{{ __('Checkbox name') }}">
                            <input type="text" name="checkbox_value[]" class="form-control" placeholder="{{ __('Checkbox value') }}">
                            <button type="button" class="btn btn-sm btn-danger" id="removeCheckboxBtn"><i class='bx bx-minus'></i></button>
                        </div>`;

        let radio = `<div class="input-group mt-3">
                        <input type="text" name="radio_value[]" class="form-control" placeholder="{{ __('Radio value') }}">
                        <button type="button" class="btn btn-sm btn-danger" id="removeRadioBtn"><i class='bx bx-minus'></i></button>
                    </div>`;

        $('#inputAddBtn').on('click', function(){
            $('#addInputGroup').append(input);
        });

        $('#textareaAddBtn').on('click', function(){
            $('#addTextareaGroup').append(textarea);
        });

        $('#imageAddBtn').on('click', function(){
            $('#addImageGroup').append(image);
        });

        $('#fileAddBtn').on('click', function(){
            $('#addFileGroup').append(file);
        });

        $('#optionAddBtn').on('click', function(){
            $('#addSelectGroup').append(option);
        });

        $('#checkboxAddBtn').on('click', function(){
            $('.addCheckboxGroup').append(checkbox);
        });

        $('#radioAddBtn').on('click', function(){
            $('.addRadioGroup').append(radio);
        });

        $('#inputCheckbox').on('click', function(){
            if($('#inputCheckbox').is(':checked')){
                $('#inputForm').removeClass('d-none');
            }else{
                $('#inputForm').addClass('d-none');
            }
        });

        if($('#textareaCheckbox').is(':checked')){
                $('#textareaForm').removeClass('d-none');
            }

        $('#textareaCheckbox').on('click', function(){
            if($('#textareaCheckbox').is(':checked')){
                $('#textareaForm').removeClass('d-none');
            }else{
                $('#textareaForm').addClass('d-none');
            }
        });

        $('#imageCheckbox').on('click', function(){
            if($('#imageCheckbox').is(':checked')){
                $('#imageForm').removeClass('d-none');
            }else{
                $('#imageForm').addClass('d-none');
            }
        });

        $('#fileCheckbox').on('click', function(){
            if($('#fileCheckbox').is(':checked')){
                $('#fileForm').removeClass('d-none');
            }else{
                $('#fileForm').addClass('d-none');
            }
        });

        $('#selectCheckbox').on('click', function(){
            if($('#selectCheckbox').is(':checked')){
                $('#selectForm').removeClass('d-none');
            }else{
                $('#selectForm').addClass('d-none');
            }
        });

        $('#checkboxCheckbox').on('click', function(){
            if($('#checkboxCheckbox').is(':checked')){
                $('#checkboxForm').removeClass('d-none');
            }else{
                $('#checkboxForm').addClass('d-none');
            }
        });

        $('#radioCheckbox').on('click', function(){
            if($('#radioCheckbox').is(':checked')){
                $('#radioForm').removeClass('d-none');
            }else{
                $('#radioForm').addClass('d-none');
            }
        });

        $('form').on('submit', function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let method = $(this).attr('method');

            $.ajax({
                url : url,
                method : method,
                data : new FormData(this),
                cache : false,
                processData : false,
                contentType : false,

                success: function(response){
                    if(response.success){
                        $('#successMsg').removeClass('d-none');
                        $('#errorMsg').addClass('d-none');
                        $('#successMsg').html(`<p>${response.success}</p>`)
                    }
                    if(response.errorMsg){
                        $('#successMsg').addClass('d-none');
                        $('#errorMsg').removeClass('d-none');
                        $('#errorMsg').html(`<p>${response.errorMsg}</p>`);
                    }
                }
            });
        });
    });

</script>
    
@endpush