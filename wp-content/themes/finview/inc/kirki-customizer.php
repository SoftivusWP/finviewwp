<?php

/**
 * finview customizer
 *
 * @package finview
 */

use Kirki\Compatibility\Kirki;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Added Panels & Sections
 */
function finview_customizer_panels_sections($wp_customize)
{

    //Add panel
    $wp_customize->add_panel('finview_customizer', [
        'priority' => 10,
        'title'    => esc_html__('Finview Customizer', 'finview'),
    ]);

    /**
     * Customizer Section
     */
    $wp_customize->add_section('header_top_setting', [
        'title'       => esc_html__('Header Info Setting', 'finview'),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('header_top_setting_color', [
        'title'       => esc_html__('Header Menu Color', 'finview'),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('section_header_logo', [
        'title'       => esc_html__('Header Setting', 'finview'),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'finview'),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('header_side_setting', [
        'title'       => esc_html__('Side Info', 'finview'),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('breadcrumb_setting', [
        'title'       => esc_html__('Breadcrumb Setting', 'finview'),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('blog_setting', [
        'title'       => esc_html__('Blog Setting', 'finview'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('footer_setting', [
        'title'       => esc_html__('Footer Settings', 'finview'),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('color_setting', [
        'title'       => esc_html__('Color Setting', 'finview'),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('404_page', [
        'title'       => esc_html__('404 Page', 'finview'),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('typo_setting', [
        'title'       => esc_html__('Typography Setting', 'finview'),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);

    $wp_customize->add_section('slug_setting', [
        'title'       => esc_html__('Slug Settings', 'finview'),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'finview_customizer',
    ]);
}

add_action('customize_register', 'finview_customizer_panels_sections');

function _header_top_fields($fields)
{


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_preloader',
        'label'    => esc_html__('Preloader On/Off', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_backtotop',
        'label'    => esc_html__('Back To Top On/Off', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_header_sticky',
        'label'    => esc_html__('Header Sticky On Scroll', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'finview_header_sticky_style',
        'label'       => esc_html__('Select Header Sticky Style', 'finview'),
        'section'     => 'header_top_setting',
        // 'placeholder' => esc_html__('Select an option...', 'finview'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'sticky-style-1'   => 'Scrolling Down',
            'sticky-style-2'   => 'Scrolling Up',
        ],
        'default'     => 'sticky-style-1',
        'active_callback' => [
            [
                'setting'  => 'finview_header_sticky',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'wow_animation_switch',
        'label'    => esc_html__('Wow Animation On/Off', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    // Cart 
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_cart_switch',
        'label'    => esc_html__('Cart Swicher', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    // search 
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_navright_search_switch',
        'label'    => esc_html__('Search Swicher', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];


    // Button 
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_btnone_switch',
        'label'    => esc_html__('Button Swicher', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    // Button Text
    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_btnone_text',
        'label'    => esc_html__('Button One Text', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Sign In', 'finview'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_btnone_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];
    // Button Link
    $fields[] = [
        'type'     => 'link',
        'settings' => 'finview_btnone_link',
        'label'    => esc_html__('Button Link', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('#', 'finview'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_btnone_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // text 
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_offcanvas_switch',
        'label'    => esc_html__('Offcanvas Contact Info', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_extra_address',
        'label'    => esc_html__('Office Address', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('6391 Celina, Delaware 10299', 'finview'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_offcanvas_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];


    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_extra_email',
        'label'    => esc_html__('Email ID', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => esc_html__('Info@gmail.com', 'finview'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_offcanvas_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];


    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_extra_phone',
        'label'    => esc_html__('Phone Number', 'finview'),
        'section'  => 'header_top_setting',
        'default'  => wp_kses_post('+123456789'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_offcanvas_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];




    return $fields;
}
add_filter('kirki/fields', '_header_top_fields');



/*
Header Settings
 */
function _header_header_fields($fields)
{
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__('Select Header Style', 'finview'),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__('Select an option...', 'finview'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2'   => get_template_directory_uri() . '/inc/img/header/header-2.png',
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__('Header Logo', 'finview'),
        'description' => esc_html__('Upload Your Logo.', 'finview'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/images/logo/logo.png',
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-1',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'secondary_logo',
        'label'       => esc_html__('Header Secondary Logo', 'finview'),
        'description' => esc_html__('Upload Your Secondary Logo.', 'finview'),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/images/logo/logo-secondary.png',
        'active_callback' => [
            [
                'setting'  => 'choose_default_header',
                'operator' => '==',
                'value'    => 'header-style-2',
            ],
        ],
    ];


    return $fields;
}
add_filter('kirki/fields', '_header_header_fields');

/*
Header Settings
 */

/*
Header Settings color
 */
function _header_top_fields_color($fields)
{

    // menu

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_bg_color',
        'label'       => __('Header BG Color', 'finview'),
        'description' => esc_html__('This is a Header BG Color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_active_bg_color',
        'label'       => __('Header Active BG Color', 'finview'),
        'description' => esc_html__('This is a Header Active BG Color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'header_menu_typography',
        'label'       => esc_html__('Menu Typography', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.main-menu .navbar-nav>li>a',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color',
        'label'       => __('Menu Color', 'finview'),
        'description' => esc_html__('This is a Menu color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color_hover',
        'label'       => __('Menu Hover Color', 'finview'),
        'description' => esc_html__('This is a Menu color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_color_drop',
        'label'       => __('Menu Dropdown BG Color', 'finview'),
        'description' => esc_html__('This is a Menu color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_drop_color',
        'label'       => __('Menu Dropdown Color', 'finview'),
        'description' => esc_html__('This is a Menu color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'header_menu_drop_color_hover',
        'label'       => __('Menu Dropdown Hover Color', 'finview'),
        'description' => esc_html__('This is a Menu color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];


    // rightside

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'menu_menu_cart_color',
        'label'       => __('Menu Cart Color', 'finview'),
        'description' => esc_html__('This is a Cart color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'menu_btn_typography',
        'label'       => esc_html__('Button Typography', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 12,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.btn_theme,.btn_theme i',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_menu_search_box',
        'label'       => __('Menu Search Box BG', 'finview'),
        'description' => esc_html__('This is a Search Box bg color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_menu_search_box_color',
        'label'       => __('Menu Search Color', 'finview'),
        'description' => esc_html__('This is a Search Box color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 10,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom',
        'label'       => __('Menu Button BG', 'finview'),
        'description' => esc_html__('This is a Button bg color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom_border',
        'label'       => __('Menu Button Border', 'finview'),
        'description' => esc_html__('This is a Button border color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom_color',
        'label'       => __('Menu Button Color', 'finview'),
        'description' => esc_html__('This is a Button color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];


    $fields[] = [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_info',
        'label'       => __('Contact Info Color For Menu', 'finview'),
        'description' => esc_html__('This is a Contact Info color control.', 'finview'),
        'section'     => 'header_top_setting_color',
        'default'     => '',
        'priority'    => 12,
    ];


    return $fields;
}
add_filter('kirki/fields', '_header_top_fields_color');

/*
Header Settings color
 */

/*
_header_page_title_fields
 */
function _header_page_title_fields($fields)
{
    // Breadcrumb Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_switch',
        'label'    => esc_html__('Breadcrumb Hide', 'finview'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];


    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__('Breadcrumb Background Image', 'finview'),
        'description' => esc_html__('Breadcrumb Background Image', 'finview'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/images/inner_banner.png',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];


    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_breadcrumb_bg_color',
        'label'       => __('Breadcrumb BG Color', 'finview'),
        'description' => esc_html__('This is a Breadcrumb bg color control.', 'finview'),
        'section'     => 'breadcrumb_setting',
        'default'     => '',
        'priority'    => 10,
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];


    // text 
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_breadcrumb_switch',
        'label'    => esc_html__('breadcrumb Image', 'finview'),
        'section'  => 'breadcrumb_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_inner_thumb',
        'label'       => esc_html__('Breadcrumb inner Image', 'finview'),
        'description' => esc_html__('Breadcrumb inner Image', 'finview'),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/images/reviews_banner.png',
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'finview_breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // Breadcrumb title Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_title_switch',
        'label'    => esc_html__('Breadcrumb Title Hide', 'finview'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'breadcrumb_title_typography',
        'label'       => esc_html__('Breadcrumb Title Font', 'finview'),
        'section'     => 'breadcrumb_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.banner .banner__content .banner__title',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_title_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    // Breadcrumb text Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_text_switch',
        'label'    => esc_html__('Breadcrumb Text Hide', 'finview'),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'breadcrumb_text_typography',
        'label'       => esc_html__('Breadcrumb Font', 'finview'),
        'section'     => 'breadcrumb_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.banner .banner__content .breadcrumb span',
            ],
        ],
        'active_callback' => [
            [
                'setting'  => 'breadcrumb_text_switch',
                'operator' => '==',
                'value'    => true,
            ],
            [
                'setting'  => 'breadcrumb_switch',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];



    // $fields[] = [
    //     'type'     => 'switch',
    //     'settings' => 'breadcrumb_info_switch',
    //     'label'    => esc_html__( 'Breadcrumb Info switch', 'finview' ),
    //     'section'  => 'breadcrumb_setting',
    //     'default'  => '1',
    //     'priority' => 10,
    //     'choices'  => [
    //         'on'  => esc_html__( 'Enable', 'finview' ),
    //         'off' => esc_html__( 'Disable', 'finview' ),
    //     ],

    // ];

    return $fields;
}
add_filter('kirki/fields', '_header_page_title_fields');

/*
Header Social
 */
function _header_blog_fields($fields)
{
    // Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_blog_btn_switch',
        'label'    => esc_html__('Blog BTN On/Off', 'finview'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_blog_btn',
        'label'    => esc_html__('Blog Button text', 'finview'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Read More', 'finview'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_blog_btn_switch',
                'operator' => '==',
                'value'    => '1',
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_blog_cat',
        'label'    => esc_html__('Blog Category Meta On/Off', 'finview'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_blog_author',
        'label'    => esc_html__('Blog Author Meta On/Off', 'finview'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_blog_date',
        'label'    => esc_html__('Blog Date Meta On/Off', 'finview'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_blog_comments',
        'label'    => esc_html__('Blog Comments Meta On/Off', 'finview'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'finview_blog_content_switch',
        'label'    => esc_html__('Blog Content On/Off', 'finview'),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'finview'),
            'off' => esc_html__('Disable', 'finview'),
        ],
    ];

    $fields[] = [
        'type'     => 'number',
        'settings' => 'finview_blog_content_words_number',
        'label'    => esc_html__('Blog Content Words Count', 'finview'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('12', 'finview'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'finview_blog_content_switch',
                'operator' => '==',
                'value'    => '1',
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__('Blog Title', 'finview'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog', 'finview'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__('Blog Details Title', 'finview'),
        'section'  => 'blog_setting',
        'default'  => esc_html__('Blog Details', 'finview'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_blog_fields');

/*
Footer
 */
function _header_footer_fields($fields)
{
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__('Choose Footer Style', 'finview'),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__('Select an option...', 'finview'),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2'   => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
        ],
        'default'     => 'footer-style-1',
    ];


    $fields[] = [
        'type'        => 'slider',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__('Number of Footer Widget Columns', 'sportsmi'),
        'description' => esc_html__('Select how many widget columns to show in the footer.', 'sportsmi'),
        'section'     => 'footer_setting',
        'default'     => 4,
        'choices'     => [
            'min'  => 1,
            'max'  => 5,
            'step' => 1,
        ],
        'active_callback'  => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '!==',
                'value'    => 'footer-style-2',
            ],
        ],
    ];



    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_footer_bg_color',
        'label'       => __('Footer BG Color', 'finview'),
        'description' => esc_html__('This is a Footer bg color control.', 'finview'),
        'section'     => 'footer_setting',
        'default'     => '#03211B',
        'priority'    => 10,
        'active_callback' => function () {
            return true === get_theme_mod('choose_default_footer', false) && 'footer-style-2' !== get_theme_mod('choose_default_footer', 'footer-style-2');
        },
        'active_callback'  => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '!==',
                'value'    => 'footer-style-2',
            ],
        ],
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_footer2_bg_color',
        'label'       => __('Footer-2 BG Color', 'finview'),
        'description' => esc_html__('This is a Footer-2 bg color control.', 'finview'),
        'section'     => 'footer_setting',
        'default'     => '#074C3E',
        'priority'    => 10,
        'active_callback' => function () {
            return true === get_theme_mod('choose_default_footer', false) && 'footer-style-1' !== get_theme_mod('choose_default_footer', 'footer-style-1');
        },
        'active_callback'  => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '!==',
                'value'    => 'footer-style-1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'finview_footer_bg',
        'label'       => __('Footer BG Image', 'finview'),
        'description' => esc_html__('This is a Footer bg image control.', 'finview'),
        'section'     => 'footer_setting',
        'default'     => get_template_directory_uri() . '/assets/images/footer_bg.png',
        'priority'    => 10,
        'active_callback' => function () {
            return true === get_theme_mod('choose_default_footer', false) && 'footer-style-2' !== get_theme_mod('choose_default_footer', 'footer-style-2');
        },
        'active_callback'  => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '!==',
                'value'    => 'footer-style-2',
            ],
        ],
    ];

    // $fields[] = [
    //     'type'     => 'switch',
    //     'settings' => 'footer_style_2_switch',
    //     'label'    => esc_html__('Footer Style 2 On/Off', 'finview'),
    //     'section'  => 'footer_setting',
    //     'default'  => '0',
    //     'priority' => 10,
    //     'choices'  => [
    //         'on'  => esc_html__('Enable', 'finview'),
    //         'off' => esc_html__('Disable', 'finview'),
    //     ],
    // ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_menu_switch',
        'label'    => esc_html__('Footer Menu', 'tradexy'),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__('Enable', 'tradexy'),
            'off' => esc_html__('Disable', 'tradexy'),
        ],
        'active_callback'  => [
            [
                'setting'  => 'choose_default_footer',
                'operator' => '!==',
                'value'    => 'footer-style-1',
            ],
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_copyright',
        'label'    => esc_html__('Copy Right', 'finview'),
        'section'  => 'footer_setting',
        'default'  => esc_html__('Copyright &copy; 2024 Finview. All Rights Reserved', 'finview'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', '_header_footer_fields');

// color
function finview_color_fields($fields)
{

    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_color_option',
        'label'       => __('Primary Color', 'finview'),
        'description' => esc_html__('This is a Primary color control.', 'finview'),
        'section'     => 'color_setting',
        'default'     => '#074C3E',
        'priority'    => 10,
    ];
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'finview_color_option_2',
        'label'       => __('Secondary Color', 'finview'),
        'description' => esc_html__('This is a Secondary color control.', 'finview'),
        'section'     => 'color_setting',
        'default'     => '#FCB650',
        'priority'    => 10,
    ];


    return $fields;
}
add_filter('kirki/fields', 'finview_color_fields');

// 404
function finview_404_fields($fields)
{
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'finview_404_bg',
        'label'       => esc_html__('404 Image.', 'finview'),
        'description' => esc_html__('404 Image.', 'finview'),
        'section'     => '404_page',
        'default'     => get_template_directory_uri() . '/assets/images/error_page.png',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_error_title',
        'label'    => esc_html__('Not Found Title', 'finview'),
        'section'  => '404_page',
        'default'  => esc_html__('Page not found', 'finview'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'finview_error_desc',
        'label'    => esc_html__('404 Description Text', 'finview'),
        'section'  => '404_page',
        'default'  => esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted', 'finview'),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_error_link_text',
        'label'    => esc_html__('404 Link Text', 'finview'),
        'section'  => '404_page',
        'default'  => esc_html__('Back To Home', 'finview'),
        'priority' => 10,
    ];
    return $fields;
}
add_filter('kirki/fields', 'finview_404_fields');





/**
 * Added Fields
 */
function finview_typo_fields($fields)
{
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__('Body Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            // 'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body,a,button,p,th,td,li,input,textarea,select,label,blockquote,span,h1,h1>a,h2,h2>a,h3,h3>a,h4,h4>a,h5,h5>a,h6,h6>a,.headingTwo,.headingThree,.headingFour,.headingFive,.headingSix',
            ],
        ],
    ];
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_size_setting',
        'label'       => esc_html__('Body Size', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-size'      => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body,a,button,p,th,td,li,input,textarea,select,label,blockquote,span',
            ],
        ],
    ];

    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_size_setting',
        'label'       => esc_html__('Body Font', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-size'      => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body,a,button,p,th,td,li,input,textarea,select,label,blockquote,span',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__('Heading H1 Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'color'          => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1, h1>a, h1 > a span',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__('Heading h2 Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'color'          => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2, h2>a, h2 > a span',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__('Heading h3 Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'color'          => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3, h3>a, h3 > a span',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__('Heading h4 Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'color'          => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4, h4>a, h4 > a span',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__('Heading h5 Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'color'          => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5, h5>a, h5 > a span',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__('Heading h6 Style', 'finview'),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'color'          => '',
            'line-height'    => '',
            'letter-spacing' => '0',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6, h6>a, h6 > a span',
            ],
        ],
    ];
    return $fields;
}

add_filter('kirki/fields', 'finview_typo_fields');


/**
 * Added Fields
 */
function finview_slug_setting($fields)
{
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_loan_slug',
        'label'    => esc_html__('Loan Slug', 'finview'),
        'section'  => 'slug_setting',
        'default'  => esc_html__('loan', 'finview'),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'finview_services_slug',
        'label'    => esc_html__('Services Slug', 'finview'),
        'section'  => 'slug_setting',
        'default'  => esc_html__('service', 'finview'),
        'priority' => 10,
    ];

    return $fields;
}

add_filter('kirki/fields', 'finview_slug_setting');







/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function finview_THEME_option($name)
{
    $value = '';
    if (class_exists('finview')) {
        $value = Kirki::get_option(finview_get_theme(), $name);
    }

    return apply_filters('finview_THEME_option', $value, $name);
}

/**
 * Get config ID
 *
 * @return string
 */
function finview_get_theme()
{
    return 'finview';
}
