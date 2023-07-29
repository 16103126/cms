@extends('admin.master')

@section('title', __('Edit Category'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/category/index')) ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">@lang('Manage Category')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/category/edit')) ? 'active' : '' }}">
                        <a href="{{ route('admin.category.edit', $category->id) }}">@lang('Edit Category')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Edit Category')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Category name')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ $category->name }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Category slug')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="slug" class="form-control" id="basic-default-name" value="{{ $category->slug }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Select language')</label>
                                        <div class="col-sm-9">
                                            <select name="language_id" class="form-control">
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}" {{ $category->language_id == $language->id ? 'selected' : '' }}>{{ $language->language }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name"></label>
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

</script>
    
@endpush