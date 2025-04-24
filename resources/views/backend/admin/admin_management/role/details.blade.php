@extends('backend.admin.layouts.master', ['page_slug' => 'role'])
@section('title', 'Role Details -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Role Details')}}</h4>
                    <a href="{{route('am.role.index')}}" class="btn btn-primary">{{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>{{__('Name')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$role->name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Guard Name')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$role->guard_name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Created By')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{creater_name($role->createdBy)}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Created Date')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{dateTimeFormat($role->created_at)}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Updated By')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{updater_name($role->updatedBy)}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Updated Date')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$role->created_at != $role->updated_at ? dateTimeFormat($role->updated_at) : 'Null'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

