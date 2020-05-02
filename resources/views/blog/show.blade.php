@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <x-blog-post :post="$post"/>

    <div class="post-footer">
        {{--@if ($post->meta->previousPostSlug)--}}
            {{--<a href="{{ route('blog.show', ['slug' => $post->meta->previousPostSlug]) }}">--}}
                {{--{{ __('global.posts.go_to_previous_post') }}--}}
            {{--</a>--}}
        {{--@endif--}}

        {{--@if ($post->meta->nextPostSlug)--}}
            {{--<a class="post-footer__next" href="{{ route('blog.show', ['slug' => $post->meta->nextPostSlug]) }}">--}}
                {{--{{ __('global.posts.go_to_next_post') }}--}}
            {{--</a>--}}
        {{--@endif--}}
    </div>
@endsection