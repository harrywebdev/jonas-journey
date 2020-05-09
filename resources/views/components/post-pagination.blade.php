<div class="post-pagination">
    @if ($previousPostSlug)
        <a href="{{ route('blog.show', ['slug' => $previousPostSlug]) }}">
            {{ __('global.posts.go_to_previous_post') }}
        </a>
    @else
        <span></span>
    @endif

    <a href="{{ route('home') }}" class="post-pagination__index">{{ __('global.posts.go_to_index') }}</a>

    @if ($nextPostSlug)
        <a class="post-pagination__next" href="{{ route('blog.show', ['slug' => $nextPostSlug]) }}">
            {{ __('global.posts.go_to_next_post') }}
        </a>
    @else
        <span></span>
    @endif
</div>