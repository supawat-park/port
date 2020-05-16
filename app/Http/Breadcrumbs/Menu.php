<?php

Breadcrumbs::register('menu.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Menu Management', route('menu.index'));
});

