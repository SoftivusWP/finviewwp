<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finview
 */

$footer_menu_switch = get_theme_mod('footer_menu_switch', false);
$footer_bg_img = get_theme_mod('finview_footer_bg');
$finview_footer_logo = get_theme_mod('finview_footer_logo');
$finview_footer_top_space = function_exists('get_field') ? get_field('finview_footer_top_space') : '0';
$finview_copyright_center = $finview_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
$finview_footer_bg_url_from_page = function_exists('get_field') ? get_field('finview_footer_bg') : '';
$finview_footer_bg_color_from_page = function_exists('get_field') ? get_field('finview_footer_bg_color') : '';
$footer_bg_color = get_theme_mod('finview_footer_bg_color');

// bg image
$bg_img = !empty($finview_footer_bg_url_from_page['url']) ? $finview_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color = !empty($finview_footer_bg_color_from_page) ? $finview_footer_bg_color_from_page : $footer_bg_color;


// footer_columns
$footer_columns = get_theme_mod('footer_widget_number', 4);

// Column classes based on number of columns
$footer_class = [];
switch ($footer_columns) {
    case 1:
        $footer_class[1] = 'col-12';
        break;
    case 2:
        $footer_class[1] = 'col-md-6';
        $footer_class[2] = 'col-md-6';
        break;
    case 3:
        $footer_class[1] = 'col-md-6 col-xl-4';
        $footer_class[2] = 'col-md-6 col-xl-4';
        $footer_class[3] = 'col-md-6 col-xl-4';
        break;
    case 4:
        $footer_class[1] = 'col-md-6 col-lg-4 col-xl-3';
        $footer_class[2] = 'col-md-6 col-lg-2 col-xl-3';
        $footer_class[3] = 'col-md-6 col-lg-3 col-xl-3';
        $footer_class[4] = 'col-md-6 col-lg-3 col-xl-3';
        break;
    case 5:
        $footer_class[1] = 'col-xl-3 col-lg-3 col-md-4 col-6';
        $footer_class[2] = 'col-xl-2 col-lg-2 col-6';
        $footer_class[3] = 'col-xl-2 col-lg-2 col-6';
        $footer_class[4] = 'col-xl-2 col-lg-2 col-6';
        $footer_class[5] = 'col-xl-3 col-8';
        break;
    default:
        for ($i = 1; $i <= $footer_columns; $i++) {
            $footer_class[$i] = 'col-md-6 col-lg-3';
        }
        break;
}

?>

<!-- footer area start -->

<?php
$style_attributes = '';

if (isset($bg_color)) {
    $style_attributes .= 'background-color: ' . esc_attr($bg_color) . '; ';
}
if (isset($bg_img)) {
    $style_attributes .= 'background-image: url(' . esc_attr($bg_img) . '); ';
}

?>

<footer style="<?php echo esc_attr($style_attributes); ?>" class="footer">
    <div class="container">

        <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4')) : ?>

            <div class="row section gy-5 gy-xl-0">
                <?php
                for ($num = 1; $num <= $footer_columns; $num++) {
                    if (!is_active_sidebar('footer-' . $num)) {
                        continue;
                    }
                    $class = isset($footer_class[$num]) ? $footer_class[$num] : 'col-md-6 col-lg-3 section__col';
                    echo '<div class="' . esc_attr($class) . '">';
                    dynamic_sidebar('footer-' . $num);
                    echo '</div>';
                }
                ?>
            </div>

        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <?php
                $has_footer_menu = function_exists('tradexy_footer_menu') && wp_get_nav_menu_items('footer-menu');
                $footer_class = $has_footer_menu ? 'justify-content-between' : 'justify-content-center';
                ?>
                <div class="footer__copyright <?php echo esc_attr($footer_class); ?>">
                    <p class="copyright text-center"><?php print finview_copyright_text(); ?></p>
                    <?php if (!empty($footer_menu_switch)): ?>
                        <div class="right">
                            <?php finview_footer_menu() ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <?php
    $footer_shape_image = get_theme_mod('footer_shape_image', false);
    ?>

    <?php if (!empty($footer_shape_image)) : ?>
        <div class="img-area">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/footer-Illu-left.png'); ?>" class="left" alt="<?php echo esc_attr__('Images', 'finview'); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/footer-Illu-right.png'); ?>" class="right" alt="<?php echo esc_attr__('Images', 'finview'); ?>">
        </div>
    <?php endif; ?>



    </div>
</footer>