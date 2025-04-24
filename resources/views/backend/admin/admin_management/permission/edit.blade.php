@extends('backend.admin.layouts.master', ['page_slug' => 'permission'])
@section('title', 'Permission Edit -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Permission Edit')}}</h4>
                    <a href="{{route('am.permission.index')}}" class="btn btn-primary">{{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <form action="{{route('am.permission.update', $permission->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $permission->name) }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="prefix">{{__('Prefix')}}</label>
                            <input type="text" name="prefix" class="form-control {{ $errors->has('prefix') ? ' is-invalid' : '' }}" value="{{ old('prefix', $permission->prefix) }}">
                            @if ($errors->has('prefix'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('prefix') }}</strong>
                                </span>
                            @endif
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

