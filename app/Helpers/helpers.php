<?php

if (!function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (!function_exists('isActiveMenuItem')) {
    /**
     * checks if current URL is of current menu/sub-menu.
     */
    function isActiveMenuItem($item, $separator = '?')
    {
        
        $item->clean_url = $item->url;
        if (strpos($item->url, $separator) !== false) {
            $item->clean_url = explode($separator, $item->url, -1);
        }
        if (Active::checkRoutePattern($item->clean_url)) {
            return true;
        }
        if (!empty($item->children)) {
            foreach ($item->children as $child) {
                $child->clean_url = $child->url;
                if (strpos($child->url, $separator) !== false) {
                    $child->clean_url = explode($separator, $child->url, -1);
                }
                if (Active::checkRoutePattern($child->clean_url)) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (!function_exists('getRouteUrl')) {
    /**
     * Converts querystring params to array and use it as route params and returns URL.
     */
    function getRouteUrl($url, $url_type = 'route', $separator = '?')
    {
        $routeUrl = '';
        if (!empty($url)) {
            if ($url_type == 'route') {
                if (strpos($url, $separator) !== false) {
                    $urlArray = explode($separator, $url);
                    $url = $urlArray[0];
                    parse_str($urlArray[1], $params);
                    $routeUrl = route($url, $params);
                } else {
                    $routeUrl = route($url);
                }
            } else {
                $routeUrl = $url;
            }
        }

        return $routeUrl;
    }
}

if (!function_exists('getMenuItems')) {
    /**
     * Converts items (json string) to array and return array.
     */
    function getMenuItems()
    {
        $menus = App\Models\Menus::find(1);
        
        if (!empty($menus) && !empty($menus->items)) {
            return json_decode($menus->items);
        }

        return [];
    }
}

if (!function_exists('renderMenuItems')) {
    /**
     * render sidebar menu items after permission check.
     */
    function renderMenuItems($items, $viewName = 'layouts.partials.sidebar-item')
    {
        
        foreach ($items as $item) {

            if (!empty($item->view_permission_id)) {
                if (auth()->user()->can($item->view_permission_id)) {
                    echo view($viewName, compact('item'));
                }
            } else {
                echo view($viewName, compact('item'));
            }
        }
    }
}