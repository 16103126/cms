@extends('admin.master')

@section('title', __('Update Seo'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/seo')) ? 'active' : '' }}">
                        <a href="{{ route('admin.seo') }}">@lang('Update Seo')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Update Seo')</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.seo.update', $seo->id) }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Website title')</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="title" class="form-control" id="basic-default-name" value="{{ $seo->title }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Meta keywords')</label>
                                        <div class="col-sm-9">
                                            <textarea name="meta_keywords" rows="5" class="form-control textarea" required> {{$seo->meta_keywords}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Meta description')</label>
                                        <div class="col-sm-9">
                                            <textarea name="meta_description" rows="5" class="form-control textarea" required> {{$seo->meta_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="" class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">@lang('Update')</button>
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