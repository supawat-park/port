@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            Permission Management
            <div class="pull-right">
                <a href="{{route('permission.create')}}" class="btn btn-primary btn-flat">
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
                    <th>Permission</th>
                    <th>Display Name</th>
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
                        url: '{{ route("permission.get") }}',
                        type: 'post'
                    },
                    columns: [
                        {data: 'slug', name: 'slug'},
                        {data: 'name',name: 'name'},
                        // {data: 'roles', name: 'roles.name', sortable: false},
                        // {data: 'created_at', name: 'users.created_at'},
                        // {data: 'updated_at', name: 'users.updated_at'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
                    ],
                });
            });
        </script>
    @endsection
@endsection
