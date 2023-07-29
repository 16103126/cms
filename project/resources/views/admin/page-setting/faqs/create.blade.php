@extends('admin.master')

@section('title', __('Faqs Page Setting'))

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
                    <li class="breadcrumb-item {{ (Request::is('admin/page/settings/faqs')) ? 'active' : '' }}">
                        <a href="{{ route('admin.page.setting.faqs') }}">@lang('Faqs Page Setting')</a>
                    </li>
                    <li class="breadcrumb-item {{ (Request::is('admin/page/setting/faqs/create*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.page.setting.faqs.create') }}">@lang('Create Page')</a>
                    </li>
                    </ol>
                </nav>
                <div class="card mb-4">
                    <h5 class="card-header">@lang('Create Page')</h5>
                    <div class="card-body mt-5">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <form method="POST" action="{{ route('admin.page.setting.faqs.store') }}">
                                    @csrf
                                    @include('partials.success')
                                    @include('partials.error')
                                    <div class="row mb-2">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Page Title')</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control" id="basic-default-name" placeholder="{{ __('Enter page title') }}" required>
                                        </div>
                                    </div>
                                    <div id="addFaqs">
                                        <div class="row mb-2">
                                            <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Question')</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="question[]" class="form-control" id="basic-default-name" placeholder="{{ __('Enter question') }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Answer')</label>
                                            <div class="col-sm-9">
                                                <textarea name="answer[]" rows="5" class="form-control" placeholder="{{ __('Enter answer') }}" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label" for="basic-default-name"></label>
                                        <div class="col-sm-9">
                                            <button type="button" id="faqsAddBtn" class="btn btn-sm btn-dark col-sm-2 mb-3"><i class='bx bx-plus'></i></button>
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
    });

    $(document).ready(function(){

        let html =`<div id="faqsRemove">
                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Question')</label>
                            <div class="col-sm-9">
                                <input type="text" name="question[]" class="form-control" id="basic-default-name" placeholder="{{ __('Enter Question') }}" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">@lang('Answer')</label>
                            <div class="col-sm-9">
                                <textarea name="answer[]" rows="5" class="form-control" placeholder="{{ __('Enter answer') }}" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-11 col-form-label" for="basic-default-name"></label>
                            <div class="col-sm-1">
                            <button type="button" class="btn btn-sm btn-danger" id="removeFaqsBtn"><i class='bx bx-minus'></i></button>
                            </div>
                        </div>
                    </div>`;

        $('#faqsAddBtn').on('click', function(){
            $('#addFaqs').append(html);
        });
    });

    $(document).on('click', '#removeFaqsBtn', function(){
        $(this).parents('#faqsRemove').remove();
    });
</script>
    
@endpush


