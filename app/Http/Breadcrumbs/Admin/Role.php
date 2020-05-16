<?php

Breadcrumbs::register('role.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Role Management', route('role.index'));
});

Breadcrumbs::register('role.create', function ($breadcrumbs) {
    $breadcrumbs->parent('role.index');
    $breadcrumbs->push('Create Role', route('role.create'));
});

Breadcrumbs::register('role.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('role.index');
    $breadcrumbs->push('Edit Role', route('role.edit', $id));
});
