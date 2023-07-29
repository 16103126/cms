@extends('frontend.master')

@section('title', __('Faqs Page'))

@section('content')

 <!-- Hero Section Starts -->
 <section class="hero-section" style="background-color: #042656">
    <div class="container">
        <div class="hero__content text--white">
            <h2 class="hero__title text--white">@lang('FAQS')</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="index.html">@lang('Home')</a>
                </li>
                <li>
                    @lang('FAQS')
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Hero Section Ends -->

<!-- About Section Starts -->
<section class="about-section pt-120 pb-120">
    <div class="container">
        <div class="row flex-row-reverse justify-content-between gy-5">
            <div class="accordion" id="accordionExample">
                @foreach ($description as $question => $answer)
                <div class="accordion-item mb-3">
                  <h2 class="accordion-header" id="heading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                      {{ $question }}
                    </button>
                  </h2>
                  <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      {{ $answer }}
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- About Section Ends -->

@endsection