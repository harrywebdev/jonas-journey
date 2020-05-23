@extends('layouts.app')

@section('title', __('global.posts.edit'))

@section('content')
    <article class="blog-post content">
        <h2>{{ __('global.posts.edit') }}</h2>

        @if ($errors->any())
            <div class="message is-danger">
                <div class="message-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('blog.update', ['slug' => $post->slug]) }}">
            @csrf

            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="status" value="{{ $post->status }}">

            <div class="field">
                <label for="published_on" class="label">{{ __('global.posts.form.published_on') }}</label>
                <div class="control">
                    <input id="published_on" type="text" class="input @error('published_on') is-danger @enderror"
                           name="published_on" required value="{{ old('published_on', $post->published_on->format('Y-m-d')) }}"
                           placeholder="{{ __('global.posts.form.date_format') }}">
                </div>

                @error('published_on')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="content" class="label">{{ __('global.posts.form.content') }}</label>
                <div class="control">
                    <textarea id="content" class="textarea @error('content') is-danger @enderror"
                              name="content" required rows="20"
                              placeholder="{{ __('global.posts.form.content') }}">{{ old('content', $post->content) }}</textarea>
                </div>

                @error('content')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="admin-post-actions">
                <button class="button is-primary" type="submit">{{ __('global.actions.save') }}</button>
                <a class="button is-danger"
                   href="{{ route('blog.destroy', ['slug' => $post->slug]) }}">{{ __('global.actions.delete') }}</a>
                <a class="button is-warning"
                   href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ __('global.actions.cancel') }}</a>
            </div>
        </form>
    </article>
@endsection
