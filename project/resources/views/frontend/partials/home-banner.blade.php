@php
    if( DB::table('page_settings')->where('name', 'home')->where('language_id', Session::get('language'))->exists())
    {
        $page = DB::table('page_settings')->where('name', 'home')->where('language_id', Session::get('language'))->first();
    }else{
        $page = DB::table('page_settings')->where('name', 'home')->where('isDefault', 1)->first();
    }
@endphp

@if (Request::is('/'))
<section class="banner-section" style="background-color: #042656">
    <div class="container">
      <div class="banner__content text--white">
          <h5 class="banner__subtitle text--white">{{$page->subtitle }}</h5>
          <h2 class="banner__title text--white">{{ $page->title }}</h2>
          <p>
              {{ $page->description }}
          </p>
      </div>
    </div>
</section>
@else
<h1>OK</h1>
@endif