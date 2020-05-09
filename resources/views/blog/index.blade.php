@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    @if ($posts->count())
        <ul>
            @foreach ($posts as $post)
                <li class="posts-index__item {{ $post->slug == $lastPostSlug ? 'has-pointer' : '' }}">
                    <a class="posts-index__link" href="{{ route('blog.show', ['slug' => $post->slug]) }}">
                        {{ $post->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>{{ __('global.posts.is_empty') }}</p>
    @endif
@endsection