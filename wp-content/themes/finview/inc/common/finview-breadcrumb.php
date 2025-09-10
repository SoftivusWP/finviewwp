<?php
function finview_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    $loan_slug = get_theme_mod('finview_loan_slug', __('loans', 'finview'));
    $services_slug = get_theme_mod('finview_services_slug', __('services', 'finview'));

    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'finview'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'finview'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    } elseif (is_single() && 'product' == get_post_type()) {
        $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'finview'));
    } elseif (is_single() && 'courses' == get_post_type()) {
        $title = esc_html__('Course Details', 'finview');
    } elseif ('courses' == get_post_type()) {
        $title = esc_html__('Courses', 'finview');
    } elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'finview') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'finview');
    } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
        $title = get_theme_mod('breadcrumb_shop', __('Shop', 'finview'));
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }


    $_id = get_the_ID();

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';
    if (!empty($_GET['s'])) {
        $is_breadcrumb = null;
    }

    if (empty($is_breadcrumb) && $breadcrumb_show == 1) {

        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image', $_id) : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image', $_id) : '';
        $inner_img_from_page = function_exists('get_field') ? get_field('breadcrumb_inner_image', $_id) : '';
        $hide_inner_img = function_exists('get_field') ? get_field('hide_inner_inner_image', $_id) : '';

        // get_theme_mod
        $bg_img = get_theme_mod('breadcrumb_bg_img');
        $breadcrumb_switch = get_theme_mod('breadcrumb_switch', true);
        $inner_img = get_theme_mod('breadcrumb_inner_thumb');
        $finview_breadcrumb_switch = get_theme_mod('finview_breadcrumb_switch', false);
        $breadcrumb_text_switch = get_theme_mod('breadcrumb_text_switch', true);
        $breadcrumb_title_switch = get_theme_mod('breadcrumb_title_switch', true);

        if ($hide_bg_img && empty($_GET['s'])) {
            $bg_img = '';
        } else {
            $bg_img = !empty($bg_img_from_page) ? $bg_img_from_page['url'] : $bg_img;
        } ?>

        <?php
        if ($hide_inner_img && empty($_GET['s'])) {
            $inner_img = '';
        } else {
            $inner_img = !empty($inner_img_from_page) ? $inner_img_from_page['url'] : $inner_img;
        } ?>


        <script>
            jQuery(document).ready(function($) {
                var loanSlug = "<?php echo esc_js($loan_slug); ?>";
                var servicesSlug = "<?php echo esc_js($services_slug); ?>";

                if ($('body').hasClass('single-loans')) {
                    $('ol.breadcrumb [property="itemListElement"]:nth-child(2) > a > [property="name"]').text(loanSlug);
                }
                if ($('body').hasClass('single-services')) {
                    $('ol.breadcrumb [property="itemListElement"]:nth-child(2) > a > [property="name"]').text(servicesSlug);
                }
            });
        </script>

        <!-- page title area start -->
        <?php if (!empty($breadcrumb_switch)) : ?>
            <section style="background: url('<?php echo esc_url($bg_img); ?>') bottom center / cover no-repeat;" class="banner">
                <div class="container ">
                    <div class="row gy-4 gy-sm-0 align-items-center">
                        <div class="col-12  <?php echo esc_html(($finview_breadcrumb_switch) ? 'col-sm-6' : 'col-sm-12')   ?>">
                            <div class="banner__content">
                                <?php if (!empty($breadcrumb_title_switch)) : ?>
                                    <h1 class="banner__title display-4 wow fadeInLeft" data-wow-duration="0.8s"><?php echo wp_kses_post($title); ?></h1>
                                <?php endif; ?>
                                <?php if (!empty($breadcrumb_text_switch)) : ?>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb wow fadeInRight d-flex align-items-center gap-2" data-wow-duration="0.8s">
                                            <?php if (function_exists('bcn_display')) {
                                                bcn_display();
                                            } ?>
                                        </ol>
                                    </nav>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($finview_breadcrumb_switch)) : ?>
                            <?php if (!empty($inner_img)) : ?>
                                <div class="col-12 col-sm-6">
                                    <div class="banner__thumb text-end">
                                        <img src="<?php echo esc_url($inner_img); ?>" alt="image">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- page title area end -->
    <?php
    }
}

add_action('finview_before_main_content', 'finview_breadcrumb_func');

// finview_search_form
function finview_search_form()
{
    ?>
    <div class="search-wrapper p-relative transition-3 d-none">
        <div class="search-form transition-3">
            <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                <input type="search" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('Enter Your Keyword', 'finview'); ?>">
                <button type="submit" class="search-btn"><i class="far fa-search"></i></button>
            </form>
            <a href="javascript:void(0);" class="search-close"><i class="far fa-times"></i></a>
        </div>
    </div>
<?php
}

add_action('finview_before_main_content', 'finview_search_form');

?>