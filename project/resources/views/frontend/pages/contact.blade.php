@extends('frontend.master')

@section('title', __('Contact Page'))

@section('content')

	<!-- Hero Section Starts -->
    <section class="hero-section" style="background-color: #042656">
		<div class="container">
			<div class="hero__content text--white">
                <h2 class="hero__title text--white text--center">@lang('Contact')</h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    <li>
                        @lang('Contact')
                    </li>
                </ul>
			</div>
		</div>
    </section>


    <!-- Contact Section Starts Here -->
	<div class="contact-section pt-120 pb-120 transform--top">
		<div class="container">
            <div class="contact__form__wrapper bg--body">
                <form class="contact__form row g-4" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="alert alert-danger d-none" id="errorMsg"></div>
                    <div class="alert alert-success d-none" id="successMsg"></div>
                    <div class="form-group form--group col-sm-6">
                        <label for="name" class="profile--label">@lang('Your Name')</label>
                        <input type="text" name="name" id="name" class="form-control mb-0 form--control" required>
                    </div>
                    <div class="form-group form--group col-sm-6">
                        <label for="email" class="profile--label">@lang('Email Address')</label>
                        <input type="text" name="email" id="email" class="form-control mb-0 form--control" required>
                    </div>
                    <div class="form-group form--group col-sm-6">
                        <label for="number" class="profile--label">@lang('Phone Number')</label>
                        <input type="number" name="phone_number" id="number" class="form-control mb-0 form--control required">
                    </div>
                    <div class="form-group form--group col-sm-6">
                        <label for="subject" class="profile--label">@lang('Subject')</label>
                        <input type="text" name="subject" id="subject" class="form-control mb-0 form--control required">
                    </div>
                    <div class="form-group form--group col-sm-12">
                        <label for="message" class="profile--label">@lang('Message')</label>
                        <textarea id="message" name="message" class="form-control mb-0 form--control required"></textarea>
                    </div>
                    <div class="form-group form--group col-sm-12">
                        <div class="text-end">
                            <button type="submit" class="cmn--btn">@lang('Send Message')</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
    <!-- Contact Section Ends Here -->

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('form').on('submit', function(e){
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
        });
    </script>
@endpush