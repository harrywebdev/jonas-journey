@extends('layout')

@section('title', 'Blog')

@section('content')
    <h1>Blog &ndash; Jonas's Journey</h1>

    @forelse($posts as $post)
        <x-blog-post :post="$post" />
    @empty
        <p>There are no posts yet.</p>
    @endforelse

@endsection