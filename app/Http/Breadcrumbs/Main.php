<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

require __DIR__.'/Menu.php';
require __DIR__.'/Admin/User.php';
require __DIR__.'/Admin/Role.php';
require __DIR__.'/Admin/Permission.php';
