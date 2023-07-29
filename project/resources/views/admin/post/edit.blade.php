@extends('admin.master')

@section('title', __('Edit Post'))

@section('content')

@push('css')
<link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'>
<style type="text/css">
    .bootstrap-tagsinput .tag {
       margin-right: 2px;
       color: white !important;
       background-color: hsl(244, 55%, 58%);
       padding: .2em .6em .3em;
       font-size: 100%;
       font-weight: 700;
       vertical-align: baseline;
       border-radius: .25em;
    }
</style>
@endpush

@php
    $data = json_decode($post->tags);
@endphp

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
                    <li class="breadcrumb-item {{ (Request::is('admin/post/index')) ? 'active' : '' }}">
                        <a href="{{ route('admin.post.index') }}">@lang('Manage Post')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/post/edit', $post->id)) ? 'active' : '' }}">
                        <a href="{{ route('admin.post.edit', $post->id) }}">@lang('Edit Post')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Edit Post')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.post.update', $post->id) }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Post title')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="title" class="form-control" id="basic-default-name" value="{{ $post->title }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Post slug')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="slug" class="form-control" id="basic-default-name" value="{{ $post->slug }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Select Category')</label>
                                        <div class="col-sm-9">
                                            <select name="category_id" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Post Image')</label>
                                        <div class="col-sm-9">
                                            <img src="{{ asset('assets/frontend/images/post/'.$post->image) }}" class="d-block rounded" height="100" width="100" id="preview-image">
                                            <input id="upload" type="file" name="image" class="form-control" id="basic-default-name">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Post description')</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" rows="5" class="form-control textarea" required> {!! $post->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Tags')</label>
                                        <div class="col-sm-9">
                                            @foreach ($data as $da)
                                            <input type="text" id="tag" name="tags[]" value="{{ $da }}" class="form-control" data-role="tagsinput"/>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Meta keyword')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="meta_keyword" class="form-control" id="basic-default-name" value="{{  $post->meta_keyword }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Meta description')</label>
                                        <div class="col-sm-9">
                                            <textarea name="meta_description" rows="5" class="form-control" required>{{ $post->meta_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Select language')</label>
                                        <div class="col-sm-9">
                                            <select name="language_id" class="form-control">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ $post->language_id == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
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
<script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>

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
                    });
                }
            }
        });
    });

    $(document).ready(function(){
        new FroalaEditor('.textarea',{
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

    $(function () {
         $('input').on('change', function (event) {

            var $element = $(event.target);
            var $container = $element.closest('.example');

            if (!$element.data('tagsinput'))
               return;

            var val = $element.val();
            if (val === null)
               val = "null";
            var items = $element.tagsinput('items');

            $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
            $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));

         }).trigger('change');
      });

</script>
    
@endpush