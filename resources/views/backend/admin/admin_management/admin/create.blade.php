@extends('backend.admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Admin Create -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Admin Create')}}</h4>
                    <a href="{{route('am.admin.index')}}" class="btn btn-primary">{{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <form action="{{route('am.admin.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <input type="file" name="image" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('Password Confirmation')}}</label>
                            <input type="password_confirmation" name="password_confirmation" class="form-control" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

