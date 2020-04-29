@extends('layouts.app')

@section('title', '404')

@section('content')
    <p>{{ __('global.errors.page_not_found') }}</p>
    <p><a href="/">{{ __('global.errors.continue_home') }}</a></p>
@endsection