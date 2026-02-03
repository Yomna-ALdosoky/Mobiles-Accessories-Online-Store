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

    ],
    [
        'icon' => 'nav-icon fas fa-store',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',

    ],
    // [
    //     'icon' => 'far fa-circle nav-icon',
    //     'route' => 'dashboard.dashboard.index',
    //     'title' => 'Dashboard',
    // ],

];