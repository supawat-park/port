@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            Simple Template
        </div>
    </h1>
@endsection

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-12">
        {{-- <preview-component :datas="{}"></preview-component> --}}
        <dynamic-table-component :datas="{}"></dynamic-table-component>
        </div>
    </div>
    
    <hr/>

    <div class="row">
        <div class="col-6">
            @foreach ($columns as $key => $column)
                <div class="row modules-list-item">
                    <div class="col-lg-10">
                        <span >{{ $column->name }}&nbsp;&nbsp;</span>
                    </div>
                    <div class="col-lg-2">
                        {{-- <a href="javascript:void(0);"><i class="fa fa-plus add-module-to-menu" data-id="{{ $module->id }}" data-name="{{ $module->name }}" data-url="{{ $module->url }}" data-url_type="route" data-open_in_new_tab="0" data-view_permission_id="{{ $module->view_permission_id }}" ></i></a> --}}
                        <a href="javascript:void(0);"><i class="fa fa-plus add-column-to-list" data-id="{{$key}}" data-name="{{ $column->name }}" data-alias="{{ $column->alias }}"></i></a>
                    </div>
                </div>
            @endforeach
            <br/>
            <button type="button" class="btn btn-info show-modal" data-form="_add_virtual_column_form" data-header="Virtual Column"><i class="fa fa-plus" ></i>&nbsp;&nbsp;Virtual Column</button>
        </div>
        {{-- <div class="col-6"> --}}
            {{-- {{ Form::hidden('items', empty($items) ? '{}' : $items, ['id' => 'items','class' => 'menu-items-field']) }} --}}
            {{-- <div class="well">
                <div id="menu-items" class="dd">
                </div>
            </div> --}}
            <dynamic-column-component :datas="{{empty($items) ? '{}' : $items}}"></dynamic-column-component>
        {{-- </div> --}}
        
    </div>
    
</div>
@include("modal")
@endsection
@section("css")
     {!! Html::style('css/nestable2/jquery.nestable.css') !!}
@endsection
@section("javascript")
    {{ Html::script('js/nestable2/jquery.nestable.js') }}
    <script type="text/javascript">
        MasterTemplate.Template.selectors.formUrl = "{{route('template.getform')}}";
        MasterTemplate.Template.init();
    </script>
@endsection
