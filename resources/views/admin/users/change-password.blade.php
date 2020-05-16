@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            User Management Change Password
        </div>
    </h1>
@endsection

@section('content')
    <div class="container">
        {{ Form::open(['route' => ['user.change-password', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'patch']) }}
            <div class="form-group">
                {{ Form::label('old password', 'Old password', ['class' => 'col-lg-2 control-label required', 'placeholder' => 'Old password']) }}

                <div class="col-lg-10">
                    {{ Form::password('old_password', ['class' => 'form-control  box-size']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('password', 'New password', ['class' => 'col-lg-2 control-label required', 'placeholder' => 'New password']) }}

                <div class="col-lg-10">
                    {{ Form::password('password', ['class' => 'form-control  box-size']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('password_confirmation', 'New Password Confirmation', ['class' => 'col-lg-4 control-label', 'placeholder' => 'New Password Confirmation']) }}

                <div class="col-lg-10">
                    {{ Form::password('password_confirmation', ['class' => 'form-control  box-size']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            <div class="edit-form-btn">
                {{ link_to_route('user.index', 'Cancel', [], ['class' => 'btn btn-danger btn-md']) }}
                {{ Form::submit('Update', ['class' => 'btn btn-primary btn-md']) }}
                <div class="clearfix"></div>
            </div>
        {{ Form::close() }}
    </div>
@endsection