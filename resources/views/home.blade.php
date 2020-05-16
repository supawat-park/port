@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            You are logged in! Role : {{ access()->getRole() }}
        {{-- 
            @role('admin')
                You are logged in! Role : Admin
            @endrole

            @role('user')
                You are logged in! Role : User
            @endrole --}}
        </div>
    </h1>
@endsection

@section('content')
    <div class="container">
        <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>. The top navbar is optional, and just for demonstration. Just create an element with the <code>#menu-toggle</code> ID which will toggle the menu when clicked.</p>
    </div>
@endsection
