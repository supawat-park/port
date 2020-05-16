@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            Role Management Edit
        </div>
    </h1>
@endsection

@section('content')
    <div class="container">
        {{ Form::model($role, ['route' => ['role.update', $role], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}
            
            <div class="form-group">
                {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Name', 'required' => 'required']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            
            <div class="form-group">
                {{ Form::label('slug', 'Slug', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    {{ Form::text('slug', null, ['class' => 'form-control box-size', 'placeholder' => 'Slug', 'required' => 'required']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('associated_permissions', 'Associated Permissions', ['class' => 'col-lg-4 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::select('associated_permissions', ['all' => 'All', 'custom' => 'Custom'], $role->all ? 'all' : 'custom', ['class' => 'form-control select2 box-size']) }}

                    <div id="available-permissions" class="" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;background-color:white;">
                        <div class="row">
                            <div class="col-xs-12" style="margin-top: 20px !important;">
                                @if ($permissions->count())
                                    @foreach ($permissions as $perm)
                                    <label class="control control--checkbox">
                                        <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'checked' : '') : (in_array($perm->id, $rolePermissions) ? 'checked' : '') }} /> <label style="padding-left: 32px;" for="perm_{{ $perm->id }}">{{ $perm->name }}</label>
                                        <div class="control__indicator"></div>
                                    </label>
                                    {{-- <br/> --}}
                                    @endforeach
                                @else
                                    <p>There are no available permissions.</p>
                                @endif
                            </div><!--col-lg-6-->
                        </div><!--row-->
                    </div><!--available permissions-->
                </div><!--col-lg-3-->
            </div><!--form control-->

            <div class="edit-form-btn">
                {{ link_to_route('role.index', 'Cancel', [], ['class' => 'btn btn-danger btn-md']) }}
                {{ Form::submit('Update', ['class' => 'btn btn-primary btn-md']) }}
                <div class="clearfix"></div>
            </div>
        </div><!--container-->
    {{ Form::close() }}
    
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
        //    var associated = document.getElementById("#associated_permissions");
           var associated_container = document.getElementById("#available-permissions");
        //    associated.onchange = function (event) {
           $("#associated_permissions").change(function(e) {
                if ($("#associated_permissions") != null){
                    if ($("#associated_permissions").val() == "custom"){
                        $('#available-permissions').removeClass('hidden');
                    }else{
                        $('#available-permissions').addClass('hidden');
                    }  
                }
            });
        });
        
    </script>
@endsection