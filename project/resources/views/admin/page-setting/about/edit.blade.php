@extends('admin.master')

@section('title', __('Edit About Page'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/page/settings/about')) ? 'active' : '' }}">
                        <a href="{{ route('admin.page.setting.about') }}">@lang('About Page Setting')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/page/setting/about/edit*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.page.setting.about.edit', $page->id) }}">@lang('Edit Page')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Edit Page')</h5>
                    <div class="card-body mt-5">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.page.setting.about.update', $page->id) }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page title')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="title" class="form-control" id="basic-default-name" value="{{ $page->title }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page Image')</label>
                                        <div class="col-sm-9">
                                            <img src="{{ asset('assets/frontend/images/page/'.$page->image) }}" class="d-block rounded" height="100" width="100" id="preview-image">
                                          <input id="upload" type="file" name="image" class="form-control" id="basic-default-name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page description')</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" rows="5" class="form-control" required>{!! $page->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Select Language')</label>
                                        <div class="col-sm-9">
                                            <select name="language_id" class="form-control" required>
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ $page->language_id == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
                                                @endforeach
                                            </select>
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

<script src="https://cdn.tiny.cloud/1/nnd7pakaxqr7isf3oqefsdlew1jsidgl78umfeus6tg21ng0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>

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
        });
    });

    $(document).ready(function(){
        new FroalaEditor('textarea',{
            // toolbarButtons: ['undo', 'redo', 'fontSize', 'paragraphFormat', 'align', 'quote', 'formatOL', 'formatUL', 'bold', 'italic', 'underline', 'fontFamily', 'insertLink', 'insertTable'],
            heightMin: 300,
        });

        $('#upload').change(function(){    
            let reader      = new FileReader();
            reader.onload   = (e) => { 
                $('#preview-image').attr('src', e.target.result); 
            }   
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>
    
@endpush


