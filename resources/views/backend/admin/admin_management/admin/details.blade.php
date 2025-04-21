@extends('backend.admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Admin Details -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Admin Details')}}</h4>
                    <a href="{{route('am.admin.index')}}" class="btn btn-primary">{{__('Back')}}</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>{{__('Name')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$admin->name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Image')}}</td>
                                <td>{{__(':')}}</td>
                                <td><img src="{{auth_storage_url($admin->image, $admin->gender)}}" alt="" height="50" width="50"></td>
                            </tr>
                            <tr>
                                <td>{{__('Email')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$admin->email}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Gender')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$admin->gender_label}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Status')}}</td>
                                <td>{{__(':')}}</td>
                                <td><span class="badge {{$admin->status_badge_color}}">{{$admin->status_badge_label}}</span></td>
                            </tr>
                            <tr>
                                <td>{{__('Created By')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$admin->createdBy ? $admin->createdBy->name : 'System'}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Created Date')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{date('d M, Y', strtotime($admin->created_at))}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Updated By')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$admin->updatedBy ? $admin->updatedBy->name : 'Null'}}</td>
                            </tr>
                            <tr>
                                <td>{{__('Updated Date')}}</td>
                                <td>{{__(':')}}</td>
                                <td>{{$admin->created_at != $admin->updated_at ? date('d M, Y', strtotime($admin->updated_at)) : 'Null'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

