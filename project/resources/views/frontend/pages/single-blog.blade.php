@extends('frontend.master')

@section('title', $post->title)

@section('description', $post->meta_description)

@section('keywords', $post->meta_keyword)

@section('content')

 <!-- Hero Section Starts -->
 <section class="hero-section" style="background-color: #042656">
    <div class="container">
        <div class="hero__content text--white">
            <h2 class="hero__title text--white">@lang('Blog Details')</h2>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">@lang('Home')</a>
                </li>
                <li>
                    @lang('Blog Details')
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- Hero Section Ends -->

 <!-- Blog Section Starts Here -->
 <section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-8">
                @if (!empty($post))
                <div class="post__details">
                    <div class="post__header">
                        <h3 class="post__title">
                            {{ $post->title }}
                        </h3>
                    </div>
                    <div class="post__thumb">
                        <img src="{{ asset('assets/frontend/images/post/'.$post->image) }}" alt="blog">
                    </div>
                    {!! $post->description !!}
                    <div class="row gy-4 justify-content-between">
                        <div class="col-md-6">
                            <h6 class="post__share__title">@lang('Post Comment')</h6>
                            <form id="createForm" action="{{ route('comment.store') }}" method="POST" class="contact__form">
                                @csrf
                                @include('partials.error')
                                <textarea name="comment" class="form-class mb-0 form--control" name="" id="" cols="3" rows="3"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-primary">@lang('Sent')</button>
                            </form>
                            <div class="comment mt-5">
                                @foreach ($post->comments as $comment)
                                    <div class="card mb-3" style="background-color: rgb(247, 250, 253)">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img class="rounded-circle mb-5" src="{{ asset('assets/user/img/profile/'.$comment->user->image) }}" width="50px;" alt="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <h6 class="mt-1 mb-4">{{ $comment->user->name }}</h6>
                                                    <p>{{ $comment->comment }}</p>
                                                    <form id="updateForm{{ $comment->id }}" action="{{ route('comment.update', $comment->id) }}" method="post" class="contact__form d-none mb-3">
                                                        @csrf
                                                        <textarea name="comment" class="form-class mb-0 form--control" cols="3" rows="3">{{ $comment->comment }}</textarea>
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                                    </form>
                                                    <p>
                                                        <span class="text-secondary" style="margin-right: 10px;" data-id="{{ $comment->id }}">@lang('Edit')</span>
                                                        <span class="text-danger" style="margin-right: 10px;" data-href="{{ route('comment.delete', $comment->id) }}">@lang('Delete')</span>
                                                        <span class="text-primary" id="replyCom" data-id="{{ $comment->id }}">@lang('Reply')</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            <form id="replyForm{{ $comment->id }}" action="{{ route('reply.store') }}" method="post" class="contact__form d-none mb-3">
                                                @csrf
                                                <textarea name="reply" class="form-class mb-0 form--control" cols="1" rows="1"></textarea>
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <button type="submit" class="btn btn-primary">@lang('Sent')</button>
                                            </form>
                                            @foreach (DB::table('replies')->where('comment_id', $comment->id)->get() as $reply)
                                                <div class="card mb-3" style="background-color: rgb(247, 250, 253)">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                @php
                                                                    $user = DB::table('users')->where('id', $reply->user_id)->first();
                                                                @endphp
                                                                 <img class="rounded-circle mb-5" src="{{ asset('assets/user/img/profile/'.$user->image) }}" width="50px;" alt="">
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <h6 class="mt-1">{{ $user->name }}</h6>
                                                                <p class="mt-3">{{ $reply->reply}}</p>
                                                                <form id="updateForm{{ $reply->id }}" action="{{ route('reply.update', $reply->id) }}" method="post" class="contact__form d-none mb-3">
                                                                    @csrf
                                                                    <textarea name="reply" class="form-class mb-0 form--control" cols="3" rows="3">{{ $reply->reply }}</textarea>
                                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                                    <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                                                </form>
                                                                <p>
                                                                    <span class="text-secondary" style="margin-right: 10px;" data-id="{{ $reply->id }}">@lang('Edit')</span>
                                                                    <span class="text-danger" style="margin-right: 10px;" data-href="{{ route('reply.delete', $reply->id) }}">@lang('Delete')</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach 
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="post__share__title">@lang('Share now')</h6>
                            <ul class="post__share">
                                <li>
                                    <a href="#0">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <i class="lab la-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <i class="lab la-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#0">
                                        <i class="lab la-skype"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @else
                <h2>@lang('Post is not available for this language.')</h2>
                @endif
            </div>
            <div class="col-lg-4">
                <aside class="blog-sidebar bg--section">
                    <div class="widget widget__category">
                        <h4 class="widget__title">@lang('Categories')</h4>
                        <ul class="category__link">
                            @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget__post__area">
                        <h4 class="widget__title">@lang('Recent Post')</h4>
                        <ul>
                            @foreach ($recent_posts as $post)
                            <li>
                                <a href="{{ route('blog.detail', $post->slug) }}" class="widget__post">
                                    <div class="widget__post__thumb">
                                        <img src="{{ asset('assets/frontend/images/post/'. $post->image) }}" alt="blog">
                                    </div>
                                    <div class="widget__post__content">
                                        <h6 class="widget__post__title">
                                            {{ $post->title }}
                                        </h6>
                                        <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</span>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget__tags">
                        <h4 class="widget__title">@lang('Tags')</h4>
                        @if (!empty($post))
                        <ul>
                            @php
                                $tags =json_decode($post->tags, true);
                            @endphp
                            @foreach ($tags as $tag)
                            @php
                                $array = explode(',', $tag);
                            @endphp
                            @foreach ($array as $data)
                            <li>
                                <a href="{{ route('blog.tag', $data) }}">
                                    {{ $data }}
                                </a>
                            </li>
                            @endforeach
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section Ends Here -->

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
                        if(response.error) {
                                $('#successMsg').addClass('d-none');
                                $('#errorMsg').removeClass('d-none');
                                $('#errorMsg').html(`<p>${response.error}</p>`);
                            }
                        if(response.errors){
                            $.each(response.errors, function(index, error){
                                $('#successMsg').addClass('d-none');
                                $('#errorMsg').removeClass('d-none');
                                $('#errorMsg').html(`<p>${error}</p>`);
                            });
                        }
                        location.reload();
                    }
                });
            });

            $('.text-secondary').on('click', function(){
                let id = $(this).attr('data-id');
                $('#updateForm'+id).removeClass('d-none');
            });

            $('.text-danger').on('click', function(e){
                e.preventDefault();
                let url = $(this).attr('data-href');
                $.ajax({
                    url : url,
                    type: 'DELETE',
                    dataType: 'json',
                    data : {
                        _token: '{{csrf_token()}}'
                    },
                });
                location.reload();
            });

            $('.text-secondary').on('click', function(){
                let id = $(this).attr('data-id');
                $('#updateForm'+id).removeClass('d-none');
            });

            $('.text-primary').on('click', function(){
                let id = $(this).data('id');
                $('#replyForm'+id).removeClass('d-none');
            })
        });
    </script>
@endpush