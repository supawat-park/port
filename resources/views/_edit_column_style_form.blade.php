<style>
  #radioBtn .notActive{
      color: #3276b1;
      background-color: #fff;
  }
</style>
{{ Form::open(['class' => 'form-horizontal hidden', 'role' => 'form', 'method' => 'post', 'id' => 'template-add-virtual-column']) }}
  {{ Form::hidden('id', null, ['class' => 'mi-id']) }}
  {{ Form::hidden('content', null, ['class' => 'mi-content']) }}
  {{ Form::hidden('name', null, ['class' => 'mi-name']) }}
  {{ Form::hidden('alias', null, ['class' => 'mi-alias']) }}
  {{ Form::hidden('type', null, ['class' => 'mi-type']) }}
  {{ Form::hidden('colspan', null, ['class' => 'mi-colspan']) }}
  {{ Form::hidden('rowspan', null, ['class' => 'mi-rowspan']) }}
  {{-- {{ Form::hidden('header_align_vertical', 'middle', ['class' => 'mi-header']) }} 
  {{ Form::hidden('content_align_vertical', 'middle', ['class' => 'mi-content']) }} --}}
  <div class="form-group">
    {{ Form::label('header_align_horizontal', 'Header Align Horizontal', ['class' => 'col control-label required']) }}
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="input-group">
        <div id="radioBtn_header_horizontal" class="btn-group">
          <a class="btn btn-primary btn-sm active" data-toggle="header_align_horizontal" data-title="left"><i class="fa fa-align-left"></i></a>
          <a class="btn btn-primary btn-sm notActive" data-toggle="header_align_horizontal" data-title="center"><i class="fa fa-align-center"></i></a>
          <a class="btn btn-primary btn-sm notActive" data-toggle="header_align_horizontal" data-title="right"><i class="fa fa-align-right"></i></a>
        </div>
        <input type="hidden" name="header_align_horizontal" id="header_align_horizontal">
      </div>
    </div>
  </div>

  <div class="form-group">
    {{ Form::label('header_align_vertical', 'Header Align Vertical', ['class' => 'col control-label required']) }}
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="input-group">
        <div id="radioBtn_header_vertical" class="btn-group">
          <a class="btn btn-primary btn-sm active" data-toggle="header_align_vertical" data-title="top">TOP</a>
          <a class="btn btn-primary btn-sm notActive" data-toggle="header_align_vertical" data-title="middle">MIDDLE</a>
          <a class="btn btn-primary btn-sm notActive" data-toggle="header_align_vertical" data-title="bottom">BOTTOM</a>
        </div>
        <input type="hidden" name="header_align_vertical" id="header_align_vertical">
      </div>
    </div>
  </div>

  <div class="form-group">
    {{ Form::label('header_bold', 'Header Text Style', ['class' => 'col control-label required']) }}
    <div class="col-lg-6 col-md-6 col-sm-6">
      {{ Form::select('header_bold', array('normal' => 'Normal', 'bold' => 'Bold'), NULL, array('class' => 'browser-default custom-select')) }}
    </div>
  </div>

  <div id="content_area">
    <div class="form-group">
      {{ Form::label('content_align_horizontal', 'Content Align Horizontal', ['class' => 'col control-label required']) }}
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="input-group">
          <div id="radioBtn_content_horizontal" class="btn-group">
            <a class="btn btn-primary btn-sm active" data-toggle="content_align_horizontal" data-title="left"><i class="fa fa-align-left"></i></a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="content_align_horizontal" data-title="center"><i class="fa fa-align-center"></i></a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="content_align_horizontal" data-title="right"><i class="fa fa-align-right"></i></a>
          </div>
          <input type="hidden" name="content_align_horizontal" id="content_align_horizontal">
        </div>
      </div>
    </div>

    <div class="form-group">
      {{ Form::label('content_align_vertical', 'Header Align Vertical', ['class' => 'col control-label required']) }}
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="input-group">
          <div id="radioBtn_content_vertical" class="btn-group">
            <a class="btn btn-primary btn-sm active" data-toggle="content_align_vertical" data-title="top">TOP</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="content_align_vertical" data-title="middle">MIDDLE</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="content_align_vertical" data-title="bottom">BOTTOM</a>
          </div>
          <input type="hidden" name="content_align_vertical" id="content_align_vertical">
        </div>
      </div>
    </div>
  
    <div class="form-group">
      {{ Form::label('content_bold', 'content Text Style', ['class' => 'col control-label required']) }}
      <div class="col-lg-6 col-md-6 col-sm-6">
        {{ Form::select('content_bold', array('normal' => 'Normal', 'bold' => 'Bold'), NULL, array('class' => 'browser-default custom-select')) }}
      </div>
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
<script>
  $( document ).ready(function() {

    if($('#header_align_horizontal').val()){
      var sel = $('#header_align_horizontal').val();
      var tog = $('#radioBtn_header_horizontal a').data('toggle');
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    }

    if($('#header_align_vertical').val()){
      var sel = $('#header_align_vertical').val();
      var tog = $('#radioBtn_header_vertical a').data('toggle');
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    }

    if($('#content_align_horizontal').val()){
      var sel = $('#content_align_horizontal').val();
      var tog = $('#radioBtn_content_horizontal a').data('toggle');
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    }

    if($('#content_align_vertical').val()){
      var sel = $('#content_align_vertical').val();
      var tog = $('#radioBtn_content_vertical a').data('toggle');
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    }
  });
    
    $('#radioBtn_header_horizontal a').on('click', function(){
      var sel = $(this).data('title');
      var tog = $(this).data('toggle');
      $('#'+tog).prop('value', sel);
      
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })

    $('#radioBtn_content_horizontal a').on('click', function(){
      var sel = $(this).data('title');
      var tog = $(this).data('toggle');
      $('#'+tog).prop('value', sel);
      
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })

    $('#radioBtn_header_vertical a').on('click', function(){
      var sel = $(this).data('title');
      var tog = $(this).data('toggle');
      $('#'+tog).prop('value', sel);
      
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })

    $('#radioBtn_content_vertical a').on('click', function(){
      var sel = $(this).data('title');
      var tog = $(this).data('toggle');
      $('#'+tog).prop('value', sel);
      
      $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
      $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })


 
</script>