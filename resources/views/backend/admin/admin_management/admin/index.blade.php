@extends('backend.admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Admin List -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Admin List')}}</h4>
                    <a href="{{route('am.admin.create')}}" class="btn btn-primary">{{__('Add New')}}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>{{__('SL')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Created By')}}</th>
                                    <th>{{__('Created Date')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td><span class="badge {{$admin->status_badge_color}}">{{$admin->status_badge_label}}</span></td>
                                        <td>{{$admin->createdBy ? $admin->createdBy->name : 'System'}}</td>
                                        <td>{{date('d M, Y', strtotime($admin->created_at))}}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{route('am.admin.edit', $admin->id)}}" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

