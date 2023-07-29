@extends('admin.master')

@section('title', __('Captcha Setting'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/general/setting/captcha')) ? 'active' : '' }}">
                        <a href="{{ route('admin.general.setting.captcha') }}">@lang('Captcha Setting')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-3">
                    <h5 class="card-header">@lang('Captcha')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-11">
                                <form action="{{ route('admin.general.setting.captcha.update') }}" method="POST">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">@lang('Captcha Secret')</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="captcha_secret" class="form-control" value="{{ $captcha->captcha_secret }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                       <div class="row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label">@lang('Captcha Sitekey')</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="captcha_sitekey" class="form-control" value="{{ $captcha->captcha_sitekey }}" required>
                                        </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                            </div>
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