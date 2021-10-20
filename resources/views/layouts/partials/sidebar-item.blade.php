<div class="list-group list-group-flush">
    <a href="{{ getRouteUrl($item->url) }}" class="list-group-item list-group-item-action {{ active_class(isActiveMenuItem($item), 'active') }}">{{ $item->name }}</a>
</div>