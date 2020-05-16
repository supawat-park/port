@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            Role Management
            <div class="pull-right">
                <a href="{{route('role.create')}}" class="btn btn-primary btn-flat">
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
                <th>Role</th>
                <th>Permission</th>
                <th>Number of Users</th>
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
                        url: '{{ route("role.get") }}',
                        type: 'post'
                    },
                    columns: [
                        {data: 'name', name: 'roles.name'},
                        {data: 'permissions', name: 'permissions.name', sortable: false},
                        {data: 'users', name: 'users', searchable: false, sortable: false},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                });
            });
        </script>
    @endsection
@endsection
