<?php

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finview
 */

$footer_bg_img = get_theme_mod('finview_footer_bg');
$finview_footer_logo = get_theme_mod('finview_footer_logo');
$finview_footer_top_space = function_exists('get_field') ? get_field('finview_footer_top_space') : '0';
$finview_copyright_center = $finview_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
$finview_footer_bg_url_from_page = function_exists('get_field') ? get_field('finview_footer_bg') : '';
$finview_footer_bg_color_from_page = function_exists('get_field') ? get_field('finview_footer2_bg_color') : '';
$footer2_bg_color = get_theme_mod('finview_footer2_bg_color');

// bg image
$bg_img = !empty($finview_footer_bg_url_from_page['url']) ? $finview_footer_bg_url_from_page['url'] : $footer_bg_img;

// bg color
$bg_color2 = !empty($finview_footer_bg_color_from_page) ? $finview_footer_bg_color_from_page : $footer2_bg_color;


// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod('footer_widget_number', 3);

for ($num = 1; $num <= $footer_widgets; $num++) {
    if (is_active_sidebar('footer-' . $num)) {
        $footer_columns++;
    }
}

switch ($footer_columns) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-12 col-sm-6 col-xl-3';
        $footer_class[2] = 'col-12 col-sm-6 col-xl-6';
        $footer_class[3] = 'col-12 col-sm-6 col-xl-3';
        break;
    case '4':
        $footer_class[1] = 'col-12 col-sm-6 col-xl-3';
        $footer_class[2] = 'col-12 col-sm-6 col-xl-3';
        $footer_class[3] = 'col-12 col-sm-6 col-xl-3';
        $footer_class[4] = 'col-12 col-sm-6 col-xl-3';
        break;


    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
}

?>

<!-- footer area start -->

<?php
$style_attributes = '';


if (isset($bg_color2)) {
    $style_attributes .= 'background-color: ' . esc_attr($bg_color2) . '; ';
}

?>

<footer style="<?php echo esc_attr($style_attributes); ?>" class="footer footer-secondary">
    <div class="container">

        <?php if (is_active_sidebar('footer-2-1') or is_active_sidebar('footer-2-2') or is_active_sidebar('footer-2-3')) : ?>

            <div class="row section align-items-center">
                <?php
                if ($footer_columns < 4) {
                    print '<div class="col-12 col-sm-6 col-xl-3">';
                    dynamic_sidebar('footer-2.1');
                    print '</div>';

                    print '<div class="col-12 col-sm-6 col-xl-6">';
                    dynamic_sidebar('footer-2.2');
                    print '</div>';

                    print '<div class="col-12 col-sm-6 col-xl-3">';
                    dynamic_sidebar('footer-2.3');
                    print '</div>';
                } else {
                    for ($num = 1; $num <= $footer_columns; $num++) {
                        if (!is_active_sidebar('footer-' . $num)) {
                            continue;
                        }
                        print '<div class="' . esc_attr($footer_class[$num]) . '">';
                        dynamic_sidebar('footer-' . $num);
                        print '</div>';
                    }
                }
                ?>
            </div>

        <?php endif; ?>


        <div class="row">
            <div class="col-12">
                <div class="footer__copyright">
                    <p class="copyright text-center"><?php print finview_copyright_text(); ?></p>
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