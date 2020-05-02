@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="blog-post content">
        <h2>{{ $post->title }}</h2>
        {!! $post->content_html !!}
    </article>

    <div class="post-footer">
        <x-post-pagination :previousPostSlug="$post->meta->previousPostSlug" :nextPostSlug="$post->meta->nextPostSlug"/>
    </div>
@endsection