@extends('layout')

@section('title', $post->title)

@section('content')
    <x-blog-post :post="$post"/>
@endsection