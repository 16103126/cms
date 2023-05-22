@extends('admin.master')

@section('title', __('Create Admin Language'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/admin-language/index')) ? 'active' : '' }}">
                        <a href="{{ route('admin.admin-language.index') }}">@lang('Manage Admin Language')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/admin-language/create')) ? 'active' : '' }}">
                        <a href="{{ route('admin.admin-language.create') }}">@lang('Create Admin Language')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Create Admin Language')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.admin-language.store') }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Language Name')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="language" class="form-control" id="basic-default-name" placeholder="{{ __('Enter language name') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-form-label">@lang('Translate Language')</label>
                                        <div id="addLang" class="mb-3">
                                            <div class="row mb-3">
                                                <div class="col-sm-5 mb-2">
                                                    <input type="text" name="keys[]" class="form-control" id="basic-default-name" placeholder="{{ __('Enter main language') }}" required>
                                                </div>
                                                <div class="col-sm-5 mb-2">
                                                    <input type="text" name="values[]" class="form-control" id="basic-default-name" placeholder="{{ __('Enter translate language') }}" required>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-11">
                                        <div class="btn btn-sm btn-icon btn-dark" id="addBtn" style="float: right; margin-top: -30px;">
                                            <i class='bx bx-plus'></i>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
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
    $(document).ready(function(){
        let html = `<div class="row mb-3" id="lang">
                        <div class="col-sm-5 mb-2">
                            <input type="text" name="keys[]" class="form-control" id="basic-default-name" placeholder="{{ __('Enter main language') }}" required>
                        </div>
                        <div class="col-sm-5 mb-2">
                            <input type="text" name="values[]" class="form-control" id="basic-default-name" placeholder="{{ __('Enter translate language') }}" required>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <div class="btn btn-sm btn-icon btn-danger" id="removeBtn" style="margin-left: 5px;">
                            <i class='bx bx-x'></i>
                            </div>
                        </div>
                    </div>`
        $('#addBtn').click(function(){
            $('#addLang').append(html);
        });
    });

    $(document).on('click', '#removeBtn', function(e){
        e.preventDefault();
        $(this).parents('#lang').remove();
    });

    $(document).on('submit', 'form', function(e){
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
                if(response.errors){
                    $.each(response.errors, function(index, error){
                        $('#successMsg').addClass('d-none');
                        $('#errorMsg').removeClass('d-none');
                        $('#errorMsg').html(`<p>${error}</p>`);
                    })
                }
            }
        })
    })
</script>
    
@endpush