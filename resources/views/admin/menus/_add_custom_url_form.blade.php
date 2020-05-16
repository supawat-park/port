{{ Form::open(['class' => 'form-horizontal hidden', 'role' => 'form', 'method' => 'post', 'id' => 'menu-add-custom-url']) }}
    <div class="form-group">
        {{ Form::label('name', 'Name', ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label required']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('name', null, ['class' => 'form-control box-size mi-name', 'id' => '', 'placeholder' => 'Name', 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('url', 'Url', ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('url', null, ['class' => 'form-control box-size mi-url', 'placeholder' => 'Url']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('icon', 'Icon Class', ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label', 'title' => 'Icon Class']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('icon', null, ['class' => 'form-control box-size mi-icon', 'placeholder' => 'Icon Class']) }}
        </div>
    </div>
    <div class="form-group view-permission-block">
        {{ Form::label('view_permission_id', 'Permission', ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('view_permission_id', null, ['class' => 'form-control box-size mi-view_permission_id', 'placeholder' => 'Permission']) }}
        </div>
    </div>
    {{ Form::hidden('id', null, ['class' => 'mi-id']) }}
    <div class="box-body">
            <div class="form-group">
                <div class="edit-form-btn">
                  {{ Form::reset('Cancel', ['class' => 'btn btn-default btn-md', 'data-dismiss' => 'modal']) }}
                  {{ Form::submit('Save', ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
{{ Form::close() }}
