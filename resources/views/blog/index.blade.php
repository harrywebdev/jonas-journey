@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    @if ($posts->count())
        <ul>
            @foreach ($posts as $post)
                <li><a class="posts-index__link" href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a></li>
            @endforeach
        </ul>
    @else
        <p>{{ __('global.posts.is_empty') }}</p>
    @endif
@endsection