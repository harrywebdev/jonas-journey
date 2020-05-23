@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    @can('create', \App\Blog\Post::class)
        <div class="admin-top-nav">
            <a href="{{ route('blog.create') }}" class="button is-link is-small">{{ __('global.posts.add_new') }}</a>
        </div>
    @endcan

    @if ($posts->count())
        <ul>
            @foreach ($posts as $post)
                <li class="posts-index__item {{ $post->slug == $lastPostSlug ? 'has-pointer' : '' }}">
                    <a class="posts-index__link" href="{{ route('blog.show', ['slug' => $post->slug]) }}">
                        {{ $post->title }}
                    </a>

                    @if ($showPostStatus && $post->status != 'published')
                        <span class="tag">{{ __('global.posts.status.' . $post->status) }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>{{ __('global.posts.is_empty') }}</p>
    @endif
@endsection
