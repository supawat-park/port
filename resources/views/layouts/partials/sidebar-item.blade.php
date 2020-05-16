{{-- <div class="list-group list-group-flush">
    <a href="{{ getRouteUrl($item->url) }}" class="list-group-item list-group-item-action {{ active_class(isActiveMenuItem($item), 'active') }}">{{ $item->name }}</a>
</div> --}}

<li class="list-group list-group-flush {{ active_class(isActiveMenuItem($item)) }} @if(!empty($item->children)) {{ 'treeview' }} @endif ">
    <a href="{{ getRouteUrl($item->url) }}" class="list-group-item list-group-item-action {{ active_class(isActiveMenuItem($item), 'active') }}">
        {{-- <i class="fa {{ @$item->icon }}"></i> --}}
        <span>{{ $item->name }}</span>
        @if (!empty($item->children))
            <i class="fa fa-angle-left pull-right"></i>
        @endif
    </a>
    @if (!empty($item->children))
    <ul class="treeview-menu {{ active_class(isActiveMenuItem($item), 'menu-open') }}" style="display: none; {{ active_class(isActiveMenuItem($item), 'display: block;') }}">
        {{ renderMenuItems($item->children,'layouts.partials.sidebar-subitem') }}
    </ul>
    @endif
</li>