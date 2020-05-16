@extends('layouts.sidemenu')

@section('page-header')
    <h2 class="mt-4">
        <div class="card-body">
            User Management Show
        </div>
    </h2>
@endsection

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
        
            <tr>
                <th>E-mail</th>
                <td>{{ $user->email }}</td>
            </tr>
        
            {{-- <tr>
                <th>Status</th>
                <td>{!! $user->status_label !!}</td>
            </tr>
        
            <tr>
                <th>Confirmed</th>
                <td>{!! $user->confirmed_label !!}</td>
            </tr> --}}
        
            <tr>
                <th>Created At</th>
                <td>{{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})</td>
            </tr>
        
            <tr>
                <th>Last Updated</th>
                <td>{{ $user->updated_at }} ({{ $user->updated_at->diffForHumans() }})</td>
            </tr>
        
            {{-- @if ($user->trashed())
                <tr>
                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.deleted_at') }}</th>
                    <td>{{ $user->deleted_at }} ({{ $user->deleted_at->diffForHumans() }})</td>
                </tr>
            @endif --}}
        </table>
    </div>
@endsection