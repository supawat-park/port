<?php

Breadcrumbs::register('user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User Management', route('user.index'));
});

// Breadcrumbs::register('admin.access.user.deactivated', function ($breadcrumbs) {
//     $breadcrumbs->parent('admin.access.user.index');
//     $breadcrumbs->push(trans('menus.backend.access.users.deactivated'), route('admin.access.user.deactivated'));
// });

// Breadcrumbs::register('admin.access.user.deleted', function ($breadcrumbs) {
//     $breadcrumbs->parent('admin.access.user.index');
//     $breadcrumbs->push(trans('menus.backend.access.users.deleted'), route('admin.access.user.deleted'));
// });

Breadcrumbs::register('user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('Create User', route('user.create'));
});

Breadcrumbs::register('user.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('View User', route('user.show', $id));
});

Breadcrumbs::register('user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('Edit User', route('user.edit', $id));
});

Breadcrumbs::register('user.change-password', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('Change Password', route('user.change-password', $id));
});
