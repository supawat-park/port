@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            User Management Edit
        </div>
    </h1>
@endsection

@section('content')
    <div class="container">
        {{ Form::model($user, ['route' => ['user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
            {{-- Name --}}
            <div class="form-group">
                {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Name', 'required' => 'required']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

             {{-- Email --}}
             <div class="form-group">
                {{ Form::label('email', 'E-mail Address', ['class' => 'col-lg-2 control-label required']) }}

                <div class="col-lg-10">
                    {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => 'E-mail Address', 'required' => 'required']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
            @if ($user->id != 1)
                {{-- Associated Roles --}}
                <div class="form-group">
                    {{ Form::label('status', 'Associated Roles', ['class' => 'col-lg-4 control-label']) }}

                    <div class="col-lg-8">
                        @if (count($roles) > 0)
                            @foreach($roles as $role)
                                <div>
                                    <label for="role-{{$role->id}}" class="control control--radio" >
                                        <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" />  <label style="padding-left: 16px;">&nbsp;&nbsp;{!! $role->name !!}</label>
                                        <div class="control__indicator"></div>
                                        {{-- <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                            (
                                                <span class="show-text">Show</span>
                                                <span class="hide-text hidden">Hide</span>
                                                Permissions
                                            )
                                        </a> --}}
                                    </label>
                                </div>
                                {{-- <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                    @if ($role->all)
                                        All Permissions
                                    @else
                                        @if (count($role->permissions) > 0)
                                            <blockquote class="small">
                                                @foreach ($role->permissions as $perm)
                                                    {{$perm->display_name}}<br/>
                                                @endforeach
                                            </blockquote>
                                        @else
                                            No Permissions<br/><br/>
                                        @endif
                                    @endif
                                </div><!--permission list--> --}}
                            @endforeach
                        @else
                            No Roles to set.
                        @endif
                    </div><!--col-lg-3-->
                </div><!--form control-->

                {{-- Associated Permissions --}}
                {{-- <div class="form-group">
                    {{ Form::label('associated-permissions', 'Associated Permissions', ['class' => 'col-lg-4 control-label']) }}
                    <div class="col-lg-10">
                        <div id="available-permissions" class="hidden" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;background-color:white;">
                            <div class="row">
                                <div class="col-xs-12" style="margin-top: 20px !important;">
                                    @if ($permissions)
                                        @foreach ($permissions as $id => $name)
                                        <label class="control control--checkbox">
                                            <input type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}" id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} /> <label style="padding-left: 32px;" for="perm_{{ $id }}">{{ $name }}</label>
                                            <div class="control__indicator"></div>
                                        </label>
                                        @endforeach
                                    @else
                                        <p>There are no available permissions.</p>
                                    @endif
                                </div><!--col-lg-6-->
                            </div><!--row-->
                        </div><!--available permissions-->
                    </div><!--col-lg-3-->
                </div><!--form control--> --}}
            @endif
            <div class="edit-form-btn">
                {{ link_to_route('user.index', 'Cancel', [], ['class' => 'btn btn-danger btn-md']) }}
                {{ Form::submit('Update', ['class' => 'btn btn-primary btn-md']) }}
                <div class="clearfix"></div>
            </div>
        {{ Form::close() }}
    </div>
@endsection