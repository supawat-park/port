@extends('layouts.sidemenu')

@section('page-header')
    <h1 class="mt-4">
        <div class="card-body">
            Menu Management
        </div>
    </h1>
@endsection

@section('content')
    <div class="container">
        {{ Form::model($menu, ['route' => ['menu.update', $menu], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-menu', 'files' => true]) }}
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($modules as $module)
                                <div class="row modules-list-item">
                                    <div class="col-lg-10">
                                        <span >{{ $module->name }}&nbsp;&nbsp;</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="javascript:void(0);"><i class="fa fa-plus add-module-to-menu" data-id="{{ $module->id }}" data-name="{{ $module->name }}" data-url="{{ $module->url }}" data-url_type="route" data-open_in_new_tab="0" data-view_permission_id="{{ $module->view_permission_id }}" ></i></a>
                                    </div>
                                </div>
                            @endforeach
                            <br/>
                            <button type="button" class="btn btn-info show-modal" data-form="_add_custom_url_form" data-header="Add Custom URL"><i class="fa fa-plus" ></i>&nbsp;&nbsp;Add Custom URL</button>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    {{ Form::hidden('items', empty($menu->items) ? '{}' : $menu->items, ['class' => 'menu-items-field']) }}
                    <div class="well">
                        <div id="menu-items" class="dd">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="edit-form-btn col-12">
            {{ link_to_route('menu.index', 'Cancel', [], ['class' => 'btn btn-danger btn-md']) }}
            {{ Form::submit('Update', ['class' => 'btn btn-primary btn-md']) }}
            <div class="clearfix"></div>
        </div>
        {{ Form::close() }}
    </div>
    @include("admin.menus.partials.modal")
@endsection

@section("css")
     {!! Html::style('css/nestable2/jquery.nestable.css') !!}
@endsection
@section("javascript")
    {{ Html::script('js/nestable2/jquery.nestable.js') }}
    <script type="text/javascript">
        Backend.Menu.selectors.formUrl = "{{route('menu.getform')}}";
        Backend.Menu.init();
    </script>
@endsection