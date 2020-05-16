@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            User Management
            <div class="pull-right">
                <a href="{{route('user.create')}}" class="btn btn-primary btn-flat">
                    Create <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </h1>
@endsection

@section('content')
    
    <div class="container">
        <table class="table table-bordered" id="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Roles</th>
                <th>Created</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
    
    @section('javascript')
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("user.get") }}',
                        type: 'post'
                    },
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'email',name: 'email'},
                        {data: 'roles', name: 'roles.name', sortable: false},
                        {data: 'created_at', name: 'users.created_at'},
                        {data: 'updated_at', name: 'users.updated_at'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                });
            });
        </script>
    @endsection
@endsection
