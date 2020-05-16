@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            User Management Create
        </div>
    </h1>
@endsection

@section('content')
    <div class="container">
            {{ Form::open(['route' => 'user.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
                {{-- Name --}}
                <div class="form-group">
                    {{ Form::label('Name', 'Name', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Name', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Email --}}
                <div class="form-group">
                    {{ Form::label('email', 'Email', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => 'Email', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Password --}}
                <div class="form-group">
                    {{ Form::label('password', 'Password', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::password('password', ['class' => 'form-control box-size', 'placeholder' => 'Password', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Password Confirmation --}}
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::password('password_confirmation', ['class' => 'form-control box-size', 'placeholder' => 'Password Confirmation', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Associated Roles --}}
                <div class="form-group">
                    {{ Form::label('status', 'Associated Roles', ['class' => 'col-lg-4 control-label']) }}

                    <div class="col-lg-8">
                        @if (count($roles) > 0)
                            @foreach($roles as $role)
                                <div>
                                    <label for="role-{{$role->id}}" class="control control--radio" >
                                        <input type="radio" value="{{$role->id}}" name="assignees_roles[]" id="role-{{$role->id}}" class="get-role-for-permissions" {{ $role->id == 2 ? 'checked' : '' }} />  <label style="padding-left: 16px;">&nbsp;&nbsp;{!! $role->name !!}</label>
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            @endforeach
                        @else
                            No Roles to set.
                        @endif
                    </div><!--col-lg-3-->
                </div><!--form control-->

                {{-- Buttons --}}
                <div class="edit-form-btn">
                    {{ link_to_route('user.index', 'Cancel', [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit('Create', ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            {{ Form::close() }}
    </div>
@endsection