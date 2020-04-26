@extends('layout')

@section('title', $post->title)

@section('content')
    <x-blog-post :post="$post"/>

    <div class="post-footer">
        @if ($post->meta->previousPostSlug)
            <a href="{{ route('blog.show', ['slug' => $post->meta->previousPostSlug]) }}">
                ← Predchozi
            </a>
        @endif

        @if ($post->meta->nextPostSlug)
            <a class="post-footer__next" href="{{ route('blog.show', ['slug' => $post->meta->nextPostSlug]) }}">
                Dalsi →
            </a>
        @endif
    </div>
@endsection