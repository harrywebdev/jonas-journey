@extends('layouts.app')

@section('title', $post->title)

@section('content')
    @can('update', $post)
        <div class="admin-top-nav">
            <a href="{{ route('blog.edit', ['slug' => $post->slug]) }}" class="button is-link is-small">{{ __('global.posts.edit') }}</a>
        </div>
    @endcan

    <article class="blog-post content">
        <h2>{{ $post->title }}</h2>
        {!! $post->content_html !!}
    </article>

    <div class="post-footer">
        <x-post-pagination :previousPostSlug="$post->meta->previousPostSlug" :nextPostSlug="$post->meta->nextPostSlug"/>
    </div>
@endsection
