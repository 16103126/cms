@extends('admin.master')

@section('title', __('Home Page Setting'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/page/settings/home')) ? 'active' : '' }}">
                        <a href="{{ route('admin.page.setting.home') }}">@lang('Home Page Setting')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/page/setting/home/create*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.page.setting.home.create') }}">@lang('Create Page')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Create Page')</h5>
                    <div class="card-body mt-5">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.page.setting.home.store') }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page title')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="title" class="form-control" id="basic-default-name" placeholder="{{ __('Enter page title') }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page subtitle')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="subtitle" class="form-control" id="basic-default-name" placeholder="{{ __('Enter page subtitle') }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page description')</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" rows="5" class="form-control" placeholder="{{ __('Enter page description') }}" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Select Language')</label>
                                        <div class="col-sm-9">
                                            <select name="language_id" class="form-control" required>
                                                @foreach ($languages as $language)
                                                    <option value="{{ $language->id }}">{{ $language->language }}</option>
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
        })
    })
</script>
    
@endpush


