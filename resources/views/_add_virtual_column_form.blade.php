{{ Form::open(['class' => 'form-horizontal hidden', 'role' => 'form', 'method' => 'post', 'id' => 'template-add-virtual-column']) }}
    <div class="form-group">
        {{ Form::label('name', 'Name', ['class' => 'col-lg-3 col-md-3 col-sm-3 control-label required']) }}
        <div class="col-lg-9 col-md-9 col-sm-9">
          {{ Form::text('name', null, ['class' => 'form-control box-size mi-name', 'id' => '', 'placeholder' => 'Name', 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        <div class="edit-form-btn">
          {{ Form::reset('Cancel', ['class' => 'btn btn-default btn-md', 'data-dismiss' => 'modal']) }}
          {{ Form::submit('Save', ['class' => 'btn btn-primary btn-md']) }}
            <div class="clearfix"></div>
        </div>
    </div>
{{ Form::close() }}