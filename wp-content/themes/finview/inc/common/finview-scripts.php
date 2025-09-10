<?php

/**
 * finview_scripts description
 * @return [type] [description]
 */
function finview_scripts()
{

    /**
     * all css files
     */

    wp_enqueue_style('finview-fonts', 'https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap');
    wp_enqueue_style('spacing', FINVIEW_THEME_CSS_DIR . 'spacing.css', [], time());

    if (is_rtl()) {
        wp_enqueue_style('bootstrapdfdfd-rtl', FINVIEW_THEME_CSS_DIR2 . 'bootstrap/css/bootstrap.rtl.min.css', array());
    } else {
        wp_enqueue_style('bootstrap', FINVIEW_THEME_CSS_DIR2 . 'bootstrap/css/bootstrap.min.css', []);
    }
    wp_enqueue_style('bootstrap-icons', FINVIEW_THEME_CSS_DIR2 . 'bootstrap-icons/bootstrap-icons.min.css', []);
    wp_enqueue_style('cus_fontawesome', FINVIEW_THEME_CSS_DIR2 . 'fontawesome/css/fontawesome.min.css', []);
    wp_enqueue_style('nice-select', FINVIEW_THEME_CSS_DIR2 . 'nice-select/css/nice-select.css', []);
    wp_enqueue_style('magnific-popup', FINVIEW_THEME_CSS_DIR2 . 'magnific-popup/css/magnific-popup.css', []);
    wp_enqueue_style('slick', FINVIEW_THEME_CSS_DIR2 . 'slick/css/slick.css', []);
    wp_enqueue_style('odometer', FINVIEW_THEME_CSS_DIR2 . 'odometer/css/odometer.css', []);
    wp_enqueue_style('odometer', FINVIEW_THEME_CSS_DIR2 . 'odometer/css/odometer.css', []);
    wp_enqueue_style('animate', FINVIEW_THEME_CSS_DIR2 . 'animate/animate.css', []);
    wp_enqueue_style('style-css', FINVIEW_THEME_CSS_DIR . 'style.css', [], time());
    wp_enqueue_style('blog-css', FINVIEW_THEME_CSS_DIR . 'finview-blog.css', [], time());
    wp_enqueue_style('woocommerce-css', FINVIEW_THEME_CSS_DIR . 'woocommerce.css', [], time());
    wp_enqueue_style('finview-unit', FINVIEW_THEME_CSS_DIR . 'finview-unit.css', [], time());
    wp_enqueue_style('finview-custom', FINVIEW_THEME_CSS_DIR . 'finview-custom.css', [], time());
    wp_enqueue_style('finview-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-js', FINVIEW_THEME_JS_DIR2 . 'bootstrap/js/bootstrap.bundle.min.js', ['jquery'], '',  true);
    wp_enqueue_script('nice-select-js', FINVIEW_THEME_JS_DIR2 . 'nice-select/js/jquery.nice-select.min.js', ['jquery'], '',  true);
    wp_enqueue_script('magnific-popup-js', FINVIEW_THEME_JS_DIR2 . 'magnific-popup/js/jquery.magnific-popup.min.js', ['jquery'], '',  true);
    wp_enqueue_script('slick-js', FINVIEW_THEME_JS_DIR2 . 'slick/js/slick.min.js', ['jquery'], false, true);
    wp_enqueue_script('odometer-js', FINVIEW_THEME_JS_DIR2 . 'odometer/js/odometer.min.js', ['jquery'], false, true);
    wp_enqueue_script('viewport-js', FINVIEW_THEME_JS_DIR2 . 'viewport/viewport.jquery.js', ['jquery'], false, true);
    wp_enqueue_script('wow-js', FINVIEW_THEME_JS_DIR2 . 'wow/wow.min.js', ['jquery'], false, true);
    wp_enqueue_script('apexcharts-js', FINVIEW_THEME_JS_DIR2 . 'apexcharts/apexcharts.min.js', ['jquery'], false, true);
    wp_enqueue_script('jquery-validate-js', FINVIEW_THEME_JS_DIR2 . 'jquery-validate/jquery.validate.min.js', ['jquery'], false, true);

    wp_enqueue_script('plugin-js', FINVIEW_THEME_JS_DIR . 'plugins.js', ['jquery'], '', true);
    wp_enqueue_script('main-js', FINVIEW_THEME_JS_DIR . 'main.js', ['jquery'], '', true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'finview_scripts');

/*
Register Fonts
 */
function finview_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'finview')) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap';
    }
    return $font_url;
}
