@extends('backend.user.layouts.master')
@section('title', 'Profile -')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>{{ __('This is user profile') }}</h1>
            <h3>{{ __('User Name') }}: {{ Auth::user()->name }}</h3>
        </div>
    </div>
</div>
@endsection