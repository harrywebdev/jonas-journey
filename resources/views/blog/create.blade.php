@extends('layouts.app')

@section('title', __('global.posts.add_new'))

@section('content')
    <article class="blog-post content post-editable js-image-upload-area">
        <h2>{{ __('global.posts.add_new') }}</h2>

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

        <form method="POST" action="{{ route('blog.store') }}">
            @csrf

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label for="published_on" class="label">{{ __('global.posts.form.published_on') }}</label>
                        <div class="control">
                            <input id="published_on" type="text"
                                   class="input @error('published_on') is-danger @enderror"
                                   name="published_on" required value="{{ old('published_on', $defaultPublishedOn) }}"
                                   placeholder="{{ __('global.posts.form.date_format') }}">
                        </div>

                        @error('published_on')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <label for="status" class="label">{{ __('global.posts.form.status') }}</label>
                        <div class="control">
                            <div class="select">
                                <select name="status" id="status">
                                    <option
                                        value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>{{ __('global.posts.status.published') }}</option>
                                    <option
                                        value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>{{ __('global.posts.status.draft') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="field">
                <label for="content" class="label">{{ __('global.posts.form.content') }}</label>
                <div class="control">
                    <textarea id="content"
                              class="textarea @error('content') is-danger @enderror js-image-upload-textarea"
                              name="content" required rows="20"
                              placeholder="{{ __('global.posts.form.content') }}">{{ old('content') }}</textarea>
                </div>

                @error('content')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="js-image-gallery admin-image-gallery"></div>

            <div class="field">
                <div class="file is-small">
                    <label class="file-label">
                        <input class="file-input js-image-upload-input" type="file" name="images" multiple
                               accept="image/*">
                        <span class="file-cta">
                            <span class="file-label">
                                {{ __('global.posts.form.upload_file') }}
                            </span>
                        </span>
                    </label>
                </div>
            </div>

            <div class="admin-post-actions">
                <button class="button is-primary" type="submit">{{ __('global.actions.save') }}</button>
                <a class="button is-danger" href="{{ route('blog.index') }}">{{ __('global.actions.discard') }}</a>
            </div>
        </form>
    </article>
@endsection
