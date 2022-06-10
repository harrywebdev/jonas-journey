@extends('layouts.app')

@section('title', '404')

@section('content')
    <p>{{ __('global.errors.unauthorized') }}</p>
    <p><a href="/">{{ __('global.errors.continue_home') }}</a></p>
@endsection
