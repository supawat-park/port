<?php

Breadcrumbs::register('permission.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Permission Management', route('permission.index'));
});

Breadcrumbs::register('permission.create', function ($breadcrumbs) {
    $breadcrumbs->parent('permission.index');
    $breadcrumbs->push('Create Permission', route('permission.create'));
});

Breadcrumbs::register('permission.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('permission.index');
    $breadcrumbs->push('Edit Permission', route('permission.edit', $id));
});
