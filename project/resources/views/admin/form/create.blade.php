@extends('admin.master')

@section('title', __('Create Form'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/form/create')) ? 'active' : '' }}">
                        <a href="{{ route('admin.form.create') }}">@lang('Create Form')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Create Form')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.form.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-3">
                                        <div class="mt-5" id="makeForm">
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Form title')</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="form_title" class="form-control" id="basic-default-name" placeholder="{{ __('Enter form title') }}" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="langSeletct" class="col-sm-3 col-form-label">@lang(' Select Page')</label>
                                                <div class="col-sm-9">
                                                    <select id="langSeletct" name="page_id" class="form-select">
                                                        @foreach ($pages as $page)
                                                            <option value="{{ $page->id }}">{{ $page->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3 input">
                                                <div class="form-check mb-3">
                                                    <input name="input" class="form-check-input" type="checkbox" value="1" id="inputCheckbox">
                                                    <label class="form-check-label" for="inputCheckbox"> @lang('Input') </label>
                                                </div>
                                                <div class="d-none" id="inputForm">
                                                    <div id="addInputGroup">
                                                        <div class="input-group">
                                                            <input type="text" name="input_name[]" class="form-control" placeholder="{{ __('Name') }}">
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
                                                        </div>
                                                    </div>
                                                    <button type="button" id="inputAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 textarea">
                                                <div class="form-check mb-3">
                                                    <input name="textarea" class="form-check-input" type="checkbox" value="1" id="textareaCheckbox">
                                                    <label class="form-check-label" for="textareaCheckbox"> @lang('Textarea') </label>
                                                </div>
                                                <div class="d-none" id="textareaForm">
                                                    <div id="addTextareaGroup">
                                                        <div class="input-group">
                                                            <input type="text" name="textarea_name[]" class="form-control" placeholder="{{ __('Name') }}">
                                                            <select name="textarea_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="textareaAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 image">
                                                <div class="form-check mb-3">
                                                    <input name="image" class="form-check-input" type="checkbox" value="1" id="imageCheckbox">
                                                    <label class="form-check-label" for="imageCheckbox"> @lang('Image') </label>
                                                </div>
                                                <div class="d-none" id="imageForm">
                                                    <div id="addImageGroup">
                                                        <div class="input-group">
                                                            <input type="text" name="image_label[]" class="form-control" placeholder="{{ __('Label name') }}">
                                                            <input type="text" name="image_name[]" class="form-control" placeholder="{{ __('Name') }}">
                                                            <select name="image_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="imageAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 file">
                                                <div class="form-check mb-3">
                                                    <input name="file" class="form-check-input" type="checkbox" value="1" id="fileCheckbox">
                                                    <label class="form-check-label" for="fileCheckbox"> @lang('File') </label>
                                                </div>
                                                <div class="d-none" id="fileForm">
                                                    <div id="addFileGroup">
                                                        <div class="input-group">
                                                            <input type="text" name="file_label[]" class="form-control" placeholder="{{ __('Label naem') }}">
                                                            <input type="text" name="file_name[]" class="form-control" placeholder="{{ __('Name') }}">
                                                            <select name="file_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="fileAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 select">
                                                <div class="form-check mb-3">
                                                    <input name="select" class="form-check-input" type="checkbox" value="1" id="selectCheckbox">
                                                    <label class="form-check-label" for="selectCheckbox"> @lang('Select') </label>
                                                </div>
                                                <div class="d-none" id="selectForm">
                                                    <div id="addSelectGroup">
                                                        <div class="input-group">
                                                            <input type="text" name="select_name[]" class="form-control" placeholder="{{ __('Select name') }}">
                                                            <select name="option_option[]" class="form-select">
                                                                <option value="1">@lang('Required')</option>
                                                                <option value="0">@lang('Optional')</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="option_value[]" class="form-control" placeholder="{{ __('Option value') }}">
                                                        </div>
                                                    </div>
                                                    <button type="button" id="optionAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row mb-3 checkbox">
                                                <div class="form-check mb-3">
                                                    <input name="checkbox" class="form-check-input" type="checkbox" value="1" id="checkboxCheckbox">
                                                    <label class="form-check-label" for="checkboxCheckbox"> @lang('Checkbox') </label>
                                                </div>
                                                <div class="d-none" id="checkboxForm">
                                                    <div id="addCheckboxGroup">
                                                        <input type="text" name="checkbox_title[]" class="form-control" placeholder="{{ __('Checkbox title') }}">
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="checkbox_name[]" class="form-control" placeholder="{{ __('Checkbox name') }}">
                                                            <input type="text" name="checkbox_value[]" class="form-control" placeholder="{{ __('Checkbox value') }}">
                                                        </div>
                                                    </div>
                                                    <button type="button" id="checkboxAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                            <div class="row radio">
                                                <div class="form-check mb-3">
                                                    <input name="radio" class="form-check-input" type="checkbox" value="1" id="radioCheckbox">
                                                    <label class="form-check-label" for="radioCheckbox"> @lang('Radio') </label>
                                                </div>
                                                <div class="d-none" id="radioForm">
                                                    <div id="addRadioGroup">
                                                        <input type="text" name="radio_name[]" class="form-control" placeholder="{{ __('Radio name') }}">
                                                        <div class="input-group mt-3">
                                                            <input type="text" name="radio_value[]" class="form-control" placeholder="{{ __('Radio value') }}">
                                                        </div>
                                                    </div>
                                                    <button type="button" id="radioAddBtn" class="btn btn-sm btn-dark col-sm-2 mt-2 mb-3" style="margin-left: 10px;"><i class='bx bx-plus'></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-3">
                                        <label for="" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                        </div>
                                    </div>
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

<script src="https://cdn.tiny.cloud/1/nnd7pakaxqr7isf3oqefsdlew1jsidgl78umfeus6tg21ng0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>

    $(document).on('click', '#removeInputBtn', function(){
        $(this).parents('#input-group').remove();
    });

    $(document).on('click', '#removeTextareaBtn', function(){
        $(this).parents('#input-group').remove();
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
                        <button type="button" class="btn btn-sm btn-danger" id="removeInputBtn"><i class='bx bx-minus'></i></button>
                    </div>`;

        let textarea = `<div class="input-group mt-3" id="input-group">
                        <input type="text" name="textarea_name[]" class="form-control" placeholder="Enter textarea name">
                        <select name="textarea_option[]" class="form-select">
                            <option value="1">@lang('Required')</option>
                            <option value="0">@lang('Optional')</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-danger" id="removeTextareaBtn"><i class='bx bx-minus'></i></button>
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
            $('#addCheckboxGroup').append(checkbox);
        });

        $('#radioAddBtn').on('click', function(){
            $('#addRadioGroup').append(radio);
        });

        $('#inputCheckbox').on('click', function(){
            if($('#inputCheckbox').is(':checked')){
                $('#inputForm').removeClass('d-none');
            }else{
                $('#inputForm').addClass('d-none');
            }
        });

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
    })

</script>
    
@endpush