<?php

return [
    [
        'icon' => 'nav-icon fas fa-home',
        'route' => 'dashboard.',
        'title' => 'Dashboard',
        'active' => 'dashboard.',
    ],
    [
        'icon' => 'nav-icon fas fa-th-large',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'active' => 'dashboard.categories.*',
        // 'ability' => 'categories.view',

    ],
    [
        'icon' => 'nav-icon fas fa-store',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
        // 'ability' => 'products.view',

    ],
    [
        'icon' => 'nav-icon fas fa-user-lock',
        'route' => 'dashboard.roles.index',
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        // 'ability' => 'roles.view',

    ],
    [
        'icon' => 'nav-icon fas fa-users-cog',
        'route' => 'dashboard.admins.index',
        'title' => 'admins',
        'active' => 'dashboard.admins.*',
        // 'ability' => 'admins.view',

    ],
    [
        'icon' => 'nav-icon fas fa-user-friends',
        'route' => 'dashboard.users.index',
        'title' => 'users',
        'active' => 'dashboard.users.*',
        // 'ability' => 'users.view',

    ],

];
