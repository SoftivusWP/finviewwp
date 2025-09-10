<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finview_widgets_init()
{

    $footer_style_2_switch = get_theme_mod('footer_style_2_switch', true);


    /**
     * blog sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'finview'),
        'id'            => 'blog-sidebar',
        'description'          => esc_html__('Set Your Blog Widget', 'finview'),
        'before_widget' => '<div id="%1$s" class="sidebar__widget sidebar__part %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar__widget-head"><h3 class="sidebar__widget-title">',
        'after_title'   => '</h3></div>',
    ]);


    $footer_widgets = get_theme_mod('footer_widget_number', 3);

    // footer default
    for ($num = 1; $num <= $footer_widgets + 1; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer %1$s', 'finview'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('Footer column %1$s', 'finview'), $num),
            'before_widget' => '<div id="%1$s" class="footer__contact footer-box footer__widget footer-col-' . $num . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer__widget-title">',
            'after_title'   => '</h4>',
        ]);
    }

    // footer 2
    if ($footer_style_2_switch) {
        for ($num = 1; $num <= $footer_widgets; $num++) {
            register_sidebar([
                'name'          => sprintf(esc_html__('Footer Style 2 : %1$s', 'finview'), $num),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf(esc_html__('Footer Style 2 : %1$s', 'finview'), $num),
                'before_widget' => '<div id="%1$s" class="footer__contact_secondary footer__widget footer__widget-2 footer-col-2-' . $num . ' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="footer__widget-title mb-4">',
                'after_title'   => '</h4>',
            ]);
        }
    }
}
add_action('widgets_init', 'finview_widgets_init');
