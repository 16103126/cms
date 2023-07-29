@extends('admin.master')

@section('title', __('Socail Login Setting'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/general/setting/social')) ? 'active' : '' }}">
                        <a href="{{ route('admin.general.setting.social') }}">@lang('Social Login Setting')</a>
                    </li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card mb-3">
                            <h5 class="card-header">@lang('Facebook')</h5>
                            <div class="card-body">
                                <form action="{{ route('admin.general.setting.social.fb') }}" method="POST">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="form-group mb-3">
                                        <label for="">@lang('Client ID')</label>
                                        <input type="text" name="fb_id" class="form-control" value="{{ $social->fb_id }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">@lang('Client Secret')</label>
                                        <input type="text" name="fb_secret" class="form-control" value="{{ $social->fb_secret }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">@lang('Redirect')</label>
                                        <input type="text" name="fb_redirect" class="form-control" value="{{ $social->fb_redirect }}" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <h5 class="card-header">@lang('Google')</h5>
                            <div class="card-body">
                                <form action="{{ route('admin.general.setting.social.g') }}" method="POST">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="form-group mb-3">
                                        <label for="">@lang('Client ID')</label>
                                        <input type="text" name="g_id" class="form-control" value="{{ $social->g_id }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">@lang('Client Secret')</label>
                                        <input type="text" name="g_secret" class="form-control" value="{{ $social->g_secret }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">@lang('Redirect')</label>
                                        <input type="text" name="g_redirect" class="form-control" value="{{ $social->g_redirect }}" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
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