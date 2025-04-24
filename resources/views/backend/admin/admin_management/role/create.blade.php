@extends('backend.admin.layouts.master', ['page_slug' => 'role'])
@section('title', 'Role Create -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Role Create')}}</h4>
                    <a href="{{route('am.role.index')}}" class="btn btn-primary">{{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <form action="{{route('am.role.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" placeholder="Role name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
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

