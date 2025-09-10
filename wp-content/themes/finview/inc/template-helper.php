<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package finview
 */

/** 
 *
 * finview header
 */

function finview_check_header()
{
    global $finview_current_header_style;

    // Get the current page ID
    if (function_exists('is_shop') && is_shop()) {
        // WooCommerce Shop Page - only runs if WooCommerce is installed
        $current_page_id = get_option('woocommerce_shop_page_id');
    } elseif (is_home() && !is_front_page()) {
        // Blog Page (Posts Page)
        $current_page_id = get_option('page_for_posts');
    } else {
        // Regular Pages
        $current_page_id = get_the_ID();
    }

    // acf
    $finview_header_style = function_exists('get_field') ? get_field('header_style', $current_page_id) : null;
    // kirki
    $finview_default_header_style = get_theme_mod('choose_default_header', 'header-style-1');

    if ($finview_header_style == 'header-style-1') {
        $finview_current_header_style = 'header-style-1';
        get_template_part('template-parts/header/header-1');
    } elseif ($finview_header_style == 'header-style-2') {
        $finview_current_header_style = 'header-style-2';
        get_template_part('template-parts/header/header-2');
    } elseif ($finview_header_style == 'header-style-3') {
        $finview_current_header_style = 'header-style-3';
        get_template_part('template-parts/header/header-3');
    } else {
        if ($finview_default_header_style == 'header-style-2') {
            $finview_current_header_style = 'header-style-2';
            get_template_part('template-parts/header/header-2');
        } else {
            $finview_current_header_style = 'header-style-1';
            get_template_part('template-parts/header/header-1');
        }
    }
}
add_action('finview_header_style', 'finview_check_header', 10);



/**
 * [finview_header_lang description]
 * @return [type] [description]
 */
function finview_header_lang_defualt()
{
    $finview_header_lang = get_theme_mod('finview_header_lang', false);
    if ($finview_header_lang) : ?>

        <ul>
            <li><a href="javascript:void(0)" class="lang__btn"><?php print esc_html__('English', 'finview'); ?> <i class="fa-light fa-angle-down"></i></a>
                <?php do_action('finview_language'); ?>
            </li>
        </ul>

    <?php endif; ?>
    <?php
}

/**
 * [finview_language_list description]
 * @return [type] [description]
 */
function _finview_language($mar)
{
    return $mar;
}
function finview_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul>';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
        $mar .= '<li><a href="#">' . esc_html__('English', 'finview') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Bangla', 'finview') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'finview') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _finview_language($mar);
}
add_action('finview_language', 'finview_language_list');

// header logo
function finview_header_logo()
{
    global $finview_current_header_style;

    // Get the current page ID
    if (function_exists('is_shop') && is_shop()) {
        // WooCommerce Shop Page - only runs if WooCommerce is installed
        $current_page_id = get_option('woocommerce_shop_page_id');
    } elseif (is_home() && !is_front_page()) {
        // Blog Page (Posts Page)
        $current_page_id = get_option('page_for_posts');
    } else {
        // Regular Pages
        $current_page_id = get_the_ID();
    }

    $finview_logo_add = function_exists('get_field') ? get_field('is_enable_sec_logo', $current_page_id) : NULL;

    $finview_logo = get_template_directory_uri() . '/assets/images/logo/logo.png';
    $finview_logo_black = get_template_directory_uri() . '/assets/images/logo/logo-secondary.png';

    $finview_site_logo = get_theme_mod('logo', $finview_logo);
    $finview_secondary_logo = get_theme_mod('secondary_logo', $finview_logo_black);

    $inner_img = !empty($finview_logo_add) ? $finview_logo_add['url'] : '';

    if (!empty($inner_img)) { ?>
        <a class="secondary-logo navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url($inner_img); ?>" alt="<?php echo esc_attr__('logo', 'finview'); ?>">
        </a>
        <?php } else {
        if ($finview_current_header_style == 'header-style-1') { ?>
            <a class="standard-logo navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($finview_site_logo); ?>" alt="<?php echo esc_attr__('logo', 'finview'); ?>" />
            </a>
        <?php } elseif ($finview_current_header_style == 'header-style-2') { ?>
            <a class="standard-logo navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($finview_secondary_logo); ?>" alt="<?php echo esc_attr__('logo', 'finview'); ?>" />
            </a>
    <?php }
    }
}
add_action('finview_header_logo', 'finview_header_logo');


// header logo
function finview_header_sticky_logo()
{ ?>
    <?php
    $finview_logo_black = get_template_directory_uri() . '/assets/images/logo/logo-black.png';
    $finview_secondary_logo = get_theme_mod('secondary_logo', $finview_logo_black);
    ?>
    <a class="sticky-logo" href="<?php print esc_url(home_url('/')); ?>">
        <images src="<?php print esc_url($finview_secondary_logo); ?>" alt="<?php print esc_attr__('logo', 'finview'); ?>" />
    </a>
<?php
}

function finview_mobile_logo()
{
    // side info
    $finview_mobile_logo_hide = get_theme_mod('finview_mobile_logo_hide', false);

    $finview_site_logo = get_theme_mod('logo', get_template_directory_uri() . '/assets/img/logo/logo.png');

?>

    <?php if (!empty($finview_mobile_logo_hide)) : ?>
        <div class="side__logo mb-25">
            <a class="sideinfo-logo" href="<?php print esc_url(home_url('/')); ?>">
                <img src="<?php print esc_url($finview_site_logo); ?>" alt="<?php print esc_attr__('logo', 'finview'); ?>" />
            </a>
        </div>
    <?php endif; ?>



<?php }

/**
 * [finview_header_social_profiles description]
 * @return [type] [description]
 */
function finview_header_social_profiles()
{
    $finview_topbar_fb_url = get_theme_mod('finview_topbar_fb_url', __('#', 'finview'));
    $finview_topbar_twitter_url = get_theme_mod('finview_topbar_twitter_url', __('#', 'finview'));
    $finview_topbar_instagram_url = get_theme_mod('finview_topbar_instagram_url', __('#', 'finview'));
    $finview_topbar_linkedin_url = get_theme_mod('finview_topbar_linkedin_url', __('#', 'finview'));
    $finview_topbar_youtube_url = get_theme_mod('finview_topbar_youtube_url', __('#', 'finview'));
?>
    <ul>
        <?php if (!empty($finview_topbar_fb_url)) : ?>
            <li><a href="<?php print esc_url($finview_topbar_fb_url); ?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($finview_topbar_twitter_url)) : ?>
            <li><a href="<?php print esc_url($finview_topbar_twitter_url); ?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($finview_topbar_instagram_url)) : ?>
            <li><a href="<?php print esc_url($finview_topbar_instagram_url); ?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($finview_topbar_linkedin_url)) : ?>
            <li><a href="<?php print esc_url($finview_topbar_linkedin_url); ?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif; ?>

        <?php if (!empty($finview_topbar_youtube_url)) : ?>
            <li><a href="<?php print esc_url($finview_topbar_youtube_url); ?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif; ?>
    </ul>

<?php
}

function finview_footer_social_profiles()
{
    $finview_footer_fb_url = get_theme_mod('finview_footer_fb_url', __('#', 'finview'));
    $finview_footer_twitter_url = get_theme_mod('finview_footer_twitter_url', __('#', 'finview'));
    $finview_footer_instagram_url = get_theme_mod('finview_footer_instagram_url', __('#', 'finview'));
    $finview_footer_linkedin_url = get_theme_mod('finview_footer_linkedin_url', __('#', 'finview'));
    $finview_footer_youtube_url = get_theme_mod('finview_footer_youtube_url', __('#', 'finview'));
?>

    <ul>
        <?php if (!empty($finview_footer_fb_url)) : ?>
            <li>
                <a href="<?php print esc_url($finview_footer_fb_url); ?>">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($finview_footer_twitter_url)) : ?>
            <li>
                <a href="<?php print esc_url($finview_footer_twitter_url); ?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($finview_footer_instagram_url)) : ?>
            <li>
                <a href="<?php print esc_url($finview_footer_instagram_url); ?>">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($finview_footer_linkedin_url)) : ?>
            <li>
                <a href="<?php print esc_url($finview_footer_linkedin_url); ?>">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($finview_footer_youtube_url)) : ?>
            <li>
                <a href="<?php print esc_url($finview_footer_youtube_url); ?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
<?php
}

/**
 * [finview_header_menu description]
 * @return [type] [description]
 */
function finview_header_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => 'navbar-nav mb-lg-0',
        'container'      => '',
        'fallback_cb'    => 'Eduker_Navwalker_Class::fallback',
        'walker'         => new Eduker_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [finview_header_menu description]
 * @return [type] [description]
 */
function finview_mobile_menu()
{
?>
    <?php
    $finview_menu = wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => '',
        'container'      => '',
        'menu_id'        => 'mobile-menu-active',
        'echo'           => false,
    ]);

    $finview_menu = str_replace("menu-item-has-children", "menu-item-has-children has-children", $finview_menu);
    echo wp_kses_post($finview_menu);
    ?>
<?php
}

/**
 * [finview_search_menu description]
 * @return [type] [description]
 */
function finview_header_search_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'header-search-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Eduker_Navwalker_Class::fallback',
        'walker'         => new Eduker_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [finview_footer_menu description]
 * @return [type] [description]
 */
function finview_footer_menu()
{
    wp_nav_menu([
        'theme_location' => 'footer-menu',
        'menu_class'     => 'footer__menu',
        'container'      => '',
        'fallback_cb'    => 'Eduker_Navwalker_Class::fallback',
        'walker'         => new Eduker_Navwalker_Class,
    ]);
}


/**
 * [finview_category_menu description]
 * @return [type] [description]
 */
function finview_category_menu()
{
    wp_nav_menu([
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'Eduker_Navwalker_Class::fallback',
        'walker'         => new Eduker_Navwalker_Class,
    ]);
}

/**
 *
 * finview footer
 */
add_action('finview_footer_style', 'finview_check_footer', 10);

function finview_check_footer()
{
    $finview_footer_style = function_exists('get_field') ? get_field('footer_style') : NULL;
    $finview_default_footer_style = get_theme_mod('choose_default_footer', 'footer-style-1');

    if ($finview_footer_style == 'footer-style-1') {
        get_template_part('template-parts/footer/footer-1');
    } elseif ($finview_footer_style == 'footer-style-2') {
        get_template_part('template-parts/footer/footer-2');
    } elseif ($finview_footer_style == 'footer-style-3') {
        get_template_part('template-parts/footer/footer-3');
    } elseif ($finview_footer_style == 'footer-style-4') {
        get_template_part('template-parts/footer/footer-4');
    } else {

        /** default footer style **/
        if ($finview_default_footer_style == 'footer-style-2') {
            get_template_part('template-parts/footer/footer-2');
        } else {
            get_template_part('template-parts/footer/footer-1');
        }
    }
}

// finview_copyright_text
function finview_copyright_text()
{
    $home_url = esc_url(home_url('/')); // Get the home URL
    $copyright_text = get_theme_mod('finview_copyright', 'Copyright © 2024 <a href="' . $home_url . '">Finview</a> - All Rights Reserved');
    echo wp_kses($copyright_text, array(
        'a' => array(
            'href' => array(),
        ),
    ));
}



/**
 *
 * pagination
 */
if (!function_exists('finview_pagination')) {

    function _finview_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function finview_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul>';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _finview_pagi_callback($pagi);
    }
}


// header top bg color
function finview_breadcrumb_bg_color()
{

    // Default Menu Color
    $color_code = get_theme_mod('finview_breadcrumb_bg_color', '');
    $custom_css = '';
    if ($color_code != '') {
        $custom_css .= "body .banner{
            background-color: $color_code !important;
        }";
    }
    // Enqueue and add inline styles for menu Color
    wp_register_style('finview-menu-custom', false);
    wp_enqueue_style('finview-menu-custom', false);
    wp_add_inline_style('finview-menu-custom', $custom_css, true);
}
add_action('wp_enqueue_scripts', 'finview_breadcrumb_bg_color');

// breadcrumb-spacing top
function finview_breadcrumb_spacing()
{
    $padding_px = get_theme_mod('finview_breadcrumb_spacing', '160px');
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', []);
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style('finview-breadcrumb-top-spacing', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'finview_breadcrumb_spacing');

// breadcrumb-spacing bottom
function finview_breadcrumb_bottom_spacing()
{
    $padding_px = get_theme_mod('finview_breadcrumb_bottom_spacing', '160px');
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', []);
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style('finview-breadcrumb-bottom-spacing', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'finview_breadcrumb_bottom_spacing');

// scrollup
function finview_scrollup_switch()
{
    $scrollup_switch = get_theme_mod('finview_scrollup_switch', false);
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', []);
    if ($scrollup_switch) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style('finview-scrollup-switch', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'finview_scrollup_switch');


function finview_menu_custom_color()
{
    // Default Menu bg Color
    $color_code_menu_bg = get_theme_mod('header_menu_bg_color', '');
    $custom_menu_css_bg = '';
    if ($color_code_menu_bg != '') {
        $custom_menu_css_bg .= ".header-section{
            background-color: $color_code_menu_bg !important;
        }";
    }
    // Default Menu active bg
    $color_code_menu_active_bg = get_theme_mod('header_menu_active_bg_color', '');
    $custom_menu_active_css = '';
    if ($color_code_menu_active_bg != '') {
        $custom_menu_active_css .= "body .header-sticky.header-active{
            background: $color_code_menu_active_bg !important;
        }";
    }

    // // Default Menu Color
    // $padding_menu = get_theme_mod('nav_outside_padding', '');
    // $custom_menu_css_padding = '';
    // if ($padding_menu != '') {
    //     $custom_menu_css_padding .= ".header .nav{
    //         padding: $padding_menu !important;
    //     }";
    // }


    // // Default Menu Color
    // $padding_code_menu = get_theme_mod('menu_inner_padding', '');
    // $custom_menu_padding = '';
    // if ($padding_code_menu != '') {
    //     $custom_menu_padding .= ".header .nav__menu-items>li>a{
    //         padding: $padding_code_menu !important;
    //     }";
    // }
    // Default Menu Color
    $color_code_menu = get_theme_mod('header_menu_color', '');
    $custom_menu_css = '';
    if ($color_code_menu != '') {
        $custom_menu_css .= ".navbar-nav>li>a{
            color: $color_code_menu !important;
        }";
    }
    // Default Menu hover Color
    $color_code_menu_hover = get_theme_mod('header_menu_color_hover', '');
    $custom_menu_css_hov = '';
    if ($color_code_menu_hover != '') {
        $custom_menu_css_hov .= "body .navbar-nav li>a:hover, body .main-menu .main-menu .navbar-nav li.dropdown>a:hover::after, body .navbar-nav .current-menu-ancestor>a, body .navbar-nav .current_page_item>a{
            color: $color_code_menu_hover !important;
        }";
    }

    // Default Menu hover Color
    $color_code_menu_drop_bg = get_theme_mod('header_menu_color_drop', '');
    $custom_menu_css_drop_bg = '';
    if ($color_code_menu_drop_bg != '') {
        $custom_menu_css_drop_bg .= ".navbar-nav li.dropdown>.dropdown-menu{
            background-color: $color_code_menu_drop_bg !important;
        }";
    }

    // Default Menu Color
    $color_code_menu_drop = get_theme_mod('header_menu_drop_color', '');
    $custom_menu_css_drop = '';
    if ($color_code_menu_drop != '') {
        $custom_menu_css_drop .= ".main-menu .navbar-nav li.dropdown li a{
             color: $color_code_menu_drop !important;
         }";
    }
    // Default Menu hover Color
    $color_menu_css_drop_hover = get_theme_mod('header_menu_drop_color_hover', '');
    $custom_menu_css_drop_hover = '';
    if ($color_menu_css_drop_hover != '') {
        $custom_menu_css_drop_hover .= ".navbar-nav .current_page_item>a,.main-menu .navbar-nav .dropdown-menu li:hover>a,.main-menu .navbar-nav li.dropdown li.current_page_item a{
             color: $color_menu_css_drop_hover !important;
         }";
    }


    // cart box Color
    $color_code_cart_color = get_theme_mod('menu_menu_cart_color', '');
    $custom_menu_css_cart = '';
    if ($color_code_cart_color != '') {
        $custom_menu_css_cart .= ".header-section .navbar .nav-right .cart i{
            color: $color_code_cart_color !important;
        }";
    }

    // search Bg
    $menu_search_box = get_theme_mod('finview_menu_search_box', '');
    $custom_menu_search_box = '';
    if ($menu_search_box != '') {
        $custom_menu_search_box .= ".header-section .navbar .nav-right .nav-right__search .nav-right__search-icon{
            background-color: $menu_search_box !important;
        }";
    }

    // search Color
    $menu_search_box_color = get_theme_mod('finview_menu_search_box_color', '');
    $custom_menu_search_box_color = '';
    if ($menu_search_box_color != '') {
        $custom_menu_search_box_color .= ".header-section .navbar .nav-right .nav-right__search .nav-right__search-icon i {
            color: $menu_search_box_color !important;
        }";
    }

    // button box Bg
    $color_code_buttom = get_theme_mod('custom_menu_css_buttom', '');
    $custom_menu_css_buttom = '';
    if ($color_code_buttom != '') {
        $custom_menu_css_buttom .= ".btn_theme{
            background-color: $color_code_buttom !important;
        }";
    }

    // buttom box Color
    $color_code_buttom_color = get_theme_mod('custom_menu_css_buttom_color', '');
    $custom_menu_css_buttom_color = '';
    if ($color_code_buttom_color != '') {
        $custom_menu_css_buttom_color .= ".btn_theme,.btn_theme i {
            color: $color_code_buttom_color !important;
        }";
    }

    // border Color
    $color_code_buttom_border_color = get_theme_mod('custom_menu_css_buttom_border', '');
    $custom_menu_css_buttom_border_color = '';
    if ($color_code_buttom_border_color != '') {
        $custom_menu_css_buttom_border_color .= ".btn_theme {
           border-color: $color_code_buttom_border_color !important;
        }";
    }

    // custom_menu_css_info
    $color_code_buttom_border_info = get_theme_mod('custom_menu_css_info', '');
    $custom_menu_css_buttom_border_info = '';
    if ($color_code_buttom_border_info != '') {
        $custom_menu_css_buttom_border_info .= ".offcanvas .offcanvas-body .custom-nevbar__right .custom-nevbar__right-location, .offcanvas .offcanvas-body .custom-nevbar__right .custom-nevbar__right-location .contact a, .offcanvas .offcanvas-body .custom-nevbar__right .custom-nevbar__right-location .contact p {
           color: $color_code_buttom_border_info !important;
        }";
    }
    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_bg', false);
    wp_enqueue_style('custom_menu_css_bg', false);
    wp_add_inline_style('custom_menu_css_bg', $custom_menu_css_bg, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_active_css', false);
    wp_enqueue_style('custom_menu_active_css', false);
    wp_add_inline_style('custom_menu_active_css', $custom_menu_active_css, true);


    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_color', false);
    wp_enqueue_style('custom_menu_css_color', false);
    wp_add_inline_style('custom_menu_css_color', $custom_menu_css, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_color_hover', false);
    wp_enqueue_style('custom_menu_css_color_hover', false);
    wp_add_inline_style('custom_menu_css_color_hover', $custom_menu_css_hov, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_drop_css_bg', false);
    wp_enqueue_style('custom_menu_drop_css_bg', false);
    wp_add_inline_style('custom_menu_drop_css_bg', $custom_menu_css_drop_bg, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_drop_color', false);
    wp_enqueue_style('custom_menu_css_drop_color', false);
    wp_add_inline_style('custom_menu_css_drop_color', $custom_menu_css_drop, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_drop_color_hover', false);
    wp_enqueue_style('custom_menu_css_drop_color_hover', false);
    wp_add_inline_style('custom_menu_css_drop_color_hover', $custom_menu_css_drop_hover, true);

    // button/cart

    // Enqueue and add inline styles for cart Color
    wp_register_style('header-menu-custom-cart', false);
    wp_enqueue_style('header-menu-custom-cart', false);
    wp_add_inline_style('header-menu-custom-cart', $custom_menu_css_cart, true);

    // Enqueue and add inline styles for button bg
    wp_register_style('custom_menu_search_box_color', false);
    wp_enqueue_style('custom_menu_search_box_color', false);
    wp_add_inline_style('custom_menu_search_box_color', $custom_menu_search_box, true);

    // Enqueue and add inline styles for button Color
    wp_register_style('custom_menu_search_box_color1', false);
    wp_enqueue_style('custom_menu_search_box_color1', false);
    wp_add_inline_style('custom_menu_search_box_color1', $custom_menu_search_box_color, true);

    // Enqueue and add inline styles for button bg
    wp_register_style('header-menu-custom-button', false);
    wp_enqueue_style('header-menu-custom-button', false);
    wp_add_inline_style('header-menu-custom-button', $custom_menu_css_buttom, true);

    // Enqueue and add inline styles for button Color
    wp_register_style('header-menu-custom-button-color', false);
    wp_enqueue_style('header-menu-custom-button-color', false);
    wp_add_inline_style('header-menu-custom-button-color', $custom_menu_css_buttom_color, true);

    // Enqueue and add inline styles for button Color
    wp_register_style('custom_menu_css_buttom_border_color', false);
    wp_enqueue_style('custom_menu_css_buttom_border_color', false);
    wp_add_inline_style('custom_menu_css_buttom_border_color', $custom_menu_css_buttom_border_color, true);

    // Enqueue and add inline styles for button Color
    wp_register_style('custom_menu_css_buttom_border_info', false);
    wp_enqueue_style('custom_menu_css_buttom_border_info', false);
    wp_add_inline_style('custom_menu_css_buttom_border_info', $custom_menu_css_buttom_border_info, true);
}
add_action('wp_enqueue_scripts', 'finview_menu_custom_color');


// theme color

function finview_custom_color()
{
    // Primary Color
    $color_code = get_theme_mod('finview_color_option', '#074C3E');
    $custom_css = '';
    if ($color_code != '') {
        $custom_css .= ":root{
            --primary-color: $color_code !important;
            --tp-theme-1: $color_code !important;
        }";
    }
    // Secondary Color
    $color_code2 = get_theme_mod('finview_color_option_2', '#FCB650');
    $custom_css2 = '';
    if ($color_code2 != '') {
        $custom_css2 .= ":root{
            --secondary-color: $color_code2 !important;
        }";
    }
    // Enqueue and add inline styles for Primary Color
    wp_register_style('finview-custom', false);
    wp_enqueue_style('finview-custom', false);
    wp_add_inline_style('finview-custom', $custom_css, true);
    // Enqueue and add inline styles for Secondary Color
    wp_register_style('finview-custom-2', false);
    wp_enqueue_style('finview-custom-2', false);
    wp_add_inline_style('finview-custom-2', $custom_css2, true);
}
add_action('wp_enqueue_scripts', 'finview_custom_color');


// theme color
function finview_custom_color_scrollup()
{
    $color_code = get_theme_mod('finview_color_scrollup', '#2b4eff');
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { color: " . $color_code . "}";
        $custom_css .= ".demo-class { stroke: " . $color_code . "}";
        wp_add_inline_style('finview-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'finview_custom_color_scrollup');

// theme color
function finview_custom_color_secondary()
{
    $color_code = get_theme_mod('finview_color_option_3', '#30a820');
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { background-color: " . $color_code . "}";

        $custom_css .= ".demo-class { color: " . $color_code . "}";

        $custom_css .= ".asdf { border-color: " . $color_code . "}";
        wp_add_inline_style('finview-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'finview_custom_color_secondary');

// theme color
function finview_custom_color_secondary_2()
{
    $color_code = get_theme_mod('finview_color_option_3_2', '#ffb352');
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', []);
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".demo-class { background-color: " . $color_code . "}";

        $custom_css .= ".demo-class { color: " . $color_code . "}";

        $custom_css .= ".demo-class { border-color: " . $color_code . "}";
        wp_add_inline_style('finview-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'finview_custom_color_secondary_2');


// finview_kses_intermediate
function finview_kses_intermediate($string = '')
{
    return wp_kses($string, finview_get_allowed_html_tags('intermediate'));
}

function finview_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function finview_kses($raw)
{

    $allowed_tags = array(
        'a'                         => array(
            'class'   => array(),
            'href'    => array(),
            'rel'  => array(),
            'title'   => array(),
            'target' => array(),
        ),
        'abbr'                      => array(
            'title' => array(),
        ),
        'b'                         => array(),
        'blockquote'                => array(
            'cite' => array(),
        ),
        'cite'                      => array(
            'title' => array(),
        ),
        'code'                      => array(),
        'del'                    => array(
            'datetime'   => array(),
            'title'      => array(),
        ),
        'dd'                     => array(),
        'div'                    => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'dl'                     => array(),
        'dt'                     => array(),
        'em'                     => array(),
        'h1'                     => array(),
        'h2'                     => array(),
        'h3'                     => array(),
        'h4'                     => array(),
        'h5'                     => array(),
        'h6'                     => array(),
        'i'                         => array(
            'class' => array(),
        ),
        'img'                    => array(
            'alt'  => array(),
            'class'   => array(),
            'height' => array(),
            'src'  => array(),
            'width'   => array(),
        ),
        'li'                     => array(
            'class' => array(),
        ),
        'ol'                     => array(
            'class' => array(),
        ),
        'p'                         => array(
            'class' => array(),
        ),
        'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
        ),
        'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
        ),
        'strike'                 => array(),
        'br'                     => array(),
        'strong'                 => array(),
        'data-wow-duration'            => array(),
        'data-wow-delay'            => array(),
        'data-wallpaper-options'       => array(),
        'data-stellar-background-ratio'   => array(),
        'ul'                     => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g'     => array('fill' => true),
        'title' => array('title' => true),
        'path'  => array('d' => true, 'fill' => true,),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}
