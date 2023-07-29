@extends('admin.master')

@section('title', __('Logo Seting'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/general/setting/logo')) ? 'active' : '' }}">
                        <a href="{{ route('admin.general.setting.logo') }}">@lang('Logo Setting')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <div class="container mt-3">
                        @include('partials.success')
                        @include('partials.success')
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="card-header">@lang('Website Logo')</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <form method="POST" action="{{ route('admin.general.setting.logo.update') }}">
                                            @csrf
                                            <img src="{{ asset('assets/frontend/images/logo/'.$logo->website_logo) }}" class="d-block rounded" height="250" width="300" id="preview-image">
                                            <input id="upload" class="form-control mb-3" type="file" name="website_logo">
                                            <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="card-header">@lang('Dashboard Logo')</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <form method="POST" action="{{ route('admin.general.setting.logo.update') }}">
                                            @csrf
                                            <img src="{{ asset('assets/admin/img/logo/'.$logo->dashboard_logo) }}" class="d-block rounded" height="250" width="300" id="preview-image2">
                                            <input id="upload2" class="form-control mb-3" type="file" name="dashboard_logo">
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

    $(document).ready(function(){
        $('#upload').change(function(){    
            let reader      = new FileReader();
            reader.onload   = (e) => { 
                $('#preview-image').attr('src', e.target.result); 
            }   
            reader.readAsDataURL(this.files[0]); 
        });

        $('#upload2').change(function(){    
            let reader      = new FileReader();
            reader.onload   = (e) => { 
                $('#preview-image2').attr('src', e.target.result); 
            }   
            reader.readAsDataURL(this.files[0]); 
        });
    });

</script>
    
@endpush