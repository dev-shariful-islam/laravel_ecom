@extends('backend.admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Admin List -')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Admin List')}}</h4>
                    <div class="buttons">
                        <a href="{{route('am.admin.recycle_bin')}}" class="btn btn-info">{{__('Recycle Bin')}}</a>
                        <a href="{{route('am.admin.create')}}" class="btn btn-primary">{{__('Add New')}}</a>
                    </div>
                </div>
                <div class="card-body">

                        <table class="table table-striped" id="datatable">
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
                                                <a href="{{route('am.admin.show', $admin->id)}}" class="btn btn-link btn-info btn-lg"><i class="fa fa-eye"></i></a>

                                                <a href="{{route('am.admin.edit', $admin->id)}}" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></a>
                                                <a onclick="
                                                confirmDelete(() => document.getElementById('delete-form{{$admin->id}}').submit())" href="javascript:void(0);" class="btn btn-link btn-danger btn-lg"><i class="fa fa-trash"></i></a>
                                                <form action="{{route('am.admin.destroy', $admin->id)}}" method="POST" id="delete-form{{$admin->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

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
@endsection
@push('css_link')
    <link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.2/b-html5-3.2.2/r-3.0.4/datatables.min.css" rel="stylesheet" integrity="sha384-sqOu7pF98QbQzM7YdH6CBxJlQWc0ZgtviJ3otMbLprxG1YSNNevjcrpxsv3HGv1D" crossorigin="anonymous">
@endpush
@push('js_link')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.2/b-html5-3.2.2/r-3.0.4/datatables.min.js" integrity="sha384-j5XVl38ak4SUutRM1v049vIyXRxIKJPJ4e9oNNGFsmHysTBbmi3MqMgwkFOJjV9k" crossorigin="anonymous"></script>
@endpush
@push('js')
    <script>
    $(document).ready(function () {


        $('#datatable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            iDisplayLength: 10,
            order: [[0, 'desc']],
            buttons: [{
                    extend: 'pdfHtml5',
                    download: 'open',
                    orientation: 'potrait',
                    pagesize: 'A4',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                },
                  'excel', 'csv', 'pageLength',
            ]
        });

    });

    </script>
@endpush


