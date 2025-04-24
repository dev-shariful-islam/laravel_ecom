@extends('backend.admin.layouts.master', ['page_slug' => 'permission'])
@section('title', 'Permission Details -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Permission Details')}}</h4>
                    <a href="{{route('am.permission.index')}}" class="btn btn-primary">{{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>{{__('Name')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$permission->name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Prefix')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$permission->prefix}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Guard')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$permission->guard_name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Created By')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{creater_name($permission->createdBy)}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Created Date')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{dateTimeFormat($permission->created_at)}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Updated By')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{updater_name($permission->updatedBy)}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Updated Date')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$permission->created_at != $permission->updated_at ? dateTimeFormat($permission->updated_at) : 'Null'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

