@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            Permission Management Edit
        </div>
    </h1>
@endsection

@section('content')
        <div class="container">
            {{ Form::model($permission, ['route' => ['permission.update', $permission], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-permission']) }}
                <div class="form-group">
                    {{ Form::label('slug', 'Slug', ['class' => 'col-lg-2 control-label required']) }}
                
                    <div class="col-lg-10">
                        {{ Form::text('slug', null, ['class' => 'form-control box-size', 'placeholder' => 'Slug', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->
                
                <div class="form-group">
                    {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label required']) }}
                
                    <div class="col-lg-10">
                        {{ Form::text('name', null,['class' => 'form-control box-size', 'placeholder' => 'Name', 'required' => 'required']) }}
                    </div><!--col-lg-3-->
                </div><!--form control-->
                <div class="edit-form-btn">
                    {{ link_to_route('permission.index', 'Cancel', [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit('Update', ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            {{ Form::close() }}
        </div>
@endsection