@if (Request::is('/'))
<section class="banner-section bg_img bg--title left__center">
    <div class="container">
      <div class="banner__content text--white">
          <h5 class="banner__subtitle text--white">@lang('This is perfect place for you')</h5>
          <h2 class="banner__title text--white">@lang('Our Labor will comes true your prosperity')</h2>
          <p>
              @lang('Debitis nobis sequi animi minus reprehenderit, neque nihil eos commodi at quam dolorum tempore quae iste illo vitae amet aut ad aliquid.')
          </p>
      </div>
    </div>
</section>
@else
<h1>OK</h1>
@endif