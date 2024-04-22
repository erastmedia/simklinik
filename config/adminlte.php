<?php

use Illuminate\Support\Facades\Auth;

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SISTEM INFORMASI MANAJEMEN KLINIK',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '
        <span class="text-primary text-bold text-lg">S I M</span>
        <span class="text-lg text-bold">&nbsp;</span>
        <span class="badge badge-danger text-lg">K l i n i k</span>',
    // 'logo_img' => asset('img/letter-s.png'),
    'logo_img' => 'img/letter-s.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'img/letter-s.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'img/letter-s.png',
            'alt' => 'SIMKlinik Preloader Image',
            'effect' => 'animation__shake',
            'width' => 100,
            'height' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-gray elevation-4 text-sm',
    'classes_sidebar_nav' => 'nav-compact nav-child-indent',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'text'    => 'MASTER DATA',
            'classes' => 'text-bold',
            'icon'    => 'fas fa-fw fa-plus-square ml-0 mr-2',
            'icon_color'  => 'warning',
            'submenu' => [
                [
                    'text'  => 'Data Poli',
                    'icon'  => 'fas fa-fw fa-procedures ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/poli',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Dokter',
                    'icon'  => 'fas fa-fw fa-user-md ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/dokter',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Tenaga Medis',
                    'icon'  => 'fas fa-fw fa-user-nurse ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/petugas',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Supplier',
                    'icon'  => 'fas fa-fw fa-truck ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/supplier',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Pabrik',
                    'icon'  => 'fas fa-fw fa-industry ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/pabrik',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Gudang',
                    'icon'  => 'fas fa-fw fa-warehouse ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/gudang',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Golongan Obat',
                    'icon'  => 'fas fa-fw fa-layer-group ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/golobat',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Kategori Obat',
                    'icon'  => 'fas fa-fw fa-sitemap ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/kategori-obat',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Lokasi Obat',
                    'icon'  => 'fas fa-fw fa-location-arrow ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/lokasi-obat',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Satuan Obat',
                    'icon'  => 'fas fa-fw fa-warehouse ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => 'dashboard/master/satuan-obat',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Obat',
                    'icon'  => 'fas fa-fw fa-warehouse ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Obat Racikan',
                    'icon'  => 'fas fa-fw fa-warehouse ml-1 mr-2',
                    'icon_color'  => 'warning',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                
            ],
        ],
        [
            'text'    => 'IMPOR DATA',
            'classes' => 'text-bold',
            'icon'    => 'fas fa-fw fa-file-excel ml-0 mr-2',
            'icon_color'  => 'teal',
            'submenu' => [
                [
                    'text'  => 'Data Dokter',
                    'icon'  => 'fas fa-fw fa-file-import ml-1 mr-2',
                    'icon_color'  => 'teal',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Tenaga Medis',
                    'icon'  => 'fas fa-fw fa-file-import ml-1 mr-2',
                    'icon_color'  => 'teal',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Data Pasien',
                    'icon'  => 'fas fa-fw fa-file-import ml-1 mr-2',
                    'icon_color'  => 'teal',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Jadwal Praktek Dokter',
                    'icon'  => 'fas fa-fw fa-file-import ml-1 mr-2',
                    'icon_color'  => 'teal',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Jadwal Tenaga Medis',
                    'icon'  => 'fas fa-fw fa-file-import ml-1 mr-2',
                    'icon_color'  => 'teal',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
            ],
        ],
        [
            'text'    => 'PENDAFTARAN KLINIK',
            'classes' => 'text-bold',
            'icon'    => 'fas fa-fw fa-laptop-medical ml-0 mr-2',
            'icon_color'  => 'primary',
            'submenu' => [
                [
                    'text'  => 'Data Jaminan',
                    'icon'  => 'fas fa-fw fa-umbrella ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Registrasi Pasien',
                    'icon'  => 'fas fa-fw fa-id-card-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Jadwal Praktek Dokter',
                    'icon'  => 'fas fa-fw fa-calendar-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Jadwal Tenaga Medis',
                    'icon'  => 'far fa-fw fa-calendar-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Kunjungan Pasien',
                    'icon'  => 'fas fa-fw fa-hospital-user ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
            ],
        ],
        [
            'text'    => 'PELAYANAN KLINIK',
            'classes' => 'text-bold',
            'icon'    => 'fas fa-fw fa-hand-holding-medical ml-0 mr-2',
            'icon_color'  => 'primary',
            'submenu' => [
                [
                    'text'  => 'Diagnosa (ICD-10)',
                    'icon'  => 'fas fa-fw fa-diagnoses ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => 'dashboard/pelayanan-klinik/diagnosa',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Prosedur/Tindakan (ICD-9)',
                    'icon'  => 'fas fa-fw fa-diagnoses ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Pemeriksaan Awal',
                    'icon'  => 'fas fa-fw fa-id-card-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Pemeriksaan Utama',
                    'icon'  => 'fas fa-fw fa-calendar-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Janji Dengan Dokter',
                    'icon'  => 'far fa-fw fa-calendar-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Peringatan Pasien Kontrol',
                    'icon'  => 'fas fa-fw fa-hospital-user ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Surat Sehat dan Sakit',
                    'icon'  => 'fas fa-fw fa-hospital-user ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
            ],
        ],
        [
            'text'    => 'BILLING KASIR',
            'classes' => 'text-bold',
            'icon'    => 'fas fa-fw fa-money-bill ml-0 mr-2',
            'icon_color'  => 'primary',
            'submenu' => [
                [
                    'text'  => 'Kategori Biaya',
                    'icon'  => 'fas fa-fw fa-diagnoses ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Perawatan/Tindakan',
                    'icon'  => 'fas fa-fw fa-id-card-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Paket Perawatan/Tindakan',
                    'icon'  => 'fas fa-fw fa-calendar-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Pembayaran Kasir',
                    'icon'  => 'far fa-fw fa-calendar-alt ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Hapus Pembayaran Kasir',
                    'icon'  => 'fas fa-fw fa-hospital-user ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Retur Pembayaran Kasir',
                    'icon'  => 'fas fa-fw fa-hospital-user ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
                [
                    'text'  => 'Hapus Retur Pembayaran',
                    'icon'  => 'fas fa-fw fa-hospital-user ml-1 mr-2',
                    'icon_color'  => 'primary',
                    'url'   => '#',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
            ],
        ],
        [
            'text'    => 'SYSTEM',
            'classes' => 'text-bold',
            'icon'    => 'fas fa-fw fa-money-bill ml-0 mr-2',
            'icon_color'  => 'danger',
            'submenu' => [
                [
                    'text'  => 'Informasi Klinik',
                    'icon'  => 'fas fa-fw fa-diagnoses ml-1 mr-2',
                    'icon_color'  => 'danger',
                    'url'   => 'dashboard/system/profil-klinik',
                    'shift' => 'ml-2',
                    'classes' => 'text-sm',
                ],
            ],
        ],
        // ['header' => 'account_settings'],
        // [
        //     'text' => 'profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-user',
        // ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'cyan',
        //     'url'        => '#',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    // 'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    // 'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    // 'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.js',
                    // 'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.css',
                    // 'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    // 'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-flat-top.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'TempusDominus' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//adminlte.io/themes/v3/plugins/moment/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4//js/tempusdominus-bootstrap-4.min.js',
                ],
            ],
        ],
        'Toastr' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.js',
                ],
            ],
        ],
        'BsCustomFileInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js',
                ],
            ],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
