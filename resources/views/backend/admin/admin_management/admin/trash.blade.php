@extends('backend.admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Admin Trash -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Admin Trash')}}</h4>
                    <a href="{{route('am.admin.index')}}" class="btn btn-primary">{{__('Back')}}</a>
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
                                    <th>{{__('Deleted By')}}</th>
                                    <th>{{__('Deleted Date')}}</th>
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
                                        <td>{{$admin->deletedBy ? $admin->deletedBy->name : 'System'}}</td>
                                        <td>{{date('d M, Y', strtotime($admin->deleted_at))}}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{route('am.admin.restores', $admin->id)}}" class="btn btn-link btn-success btn-lg"><i class="fa fa-undo"></i></a>

                                                <a href="{{route('am.admin.fd', $admin->id)}}" class="btn btn-link btn-danger btn-lg"><i class="fa fa-trash"></i></a>
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

