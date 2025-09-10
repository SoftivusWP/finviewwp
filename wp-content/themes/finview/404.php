<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package finview
 */

get_header();
?>

<section class="error-page text-center section">
   <div class="container">
      <div class="row gy-5 justify-content-center">
         <?php 
               $finview_404_bg = get_theme_mod('finview_404_bg',get_template_directory_uri() . '/assets/images/error_page.png');
               $finview_error_title = get_theme_mod('finview_error_title', __('Page not found', 'finview'));
               $finview_error_link_text = get_theme_mod('finview_error_link_text', __('Back To Home', 'finview'));
               $finview_error_desc = get_theme_mod('finview_error_desc', __('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'finview'));
            ?>
            <div class="col-12 col-lg-9 col-xxl-8">
               <div class="error-page__thumb wow fadeInDown" data-wow-duration="0.8s">
                  <img src="<?php echo esc_url($finview_404_bg); ?>" alt="<?php echo esc_attr__('images','finview') ?>">
               </div>
            </div>
           <div class="col-12 col-md-8 col-xxl-6">
               <div class="section__content">
                  <h2 class="section__content-title wow fadeInUp" data-wow-duration="0.8s"><?php print esc_html($finview_error_title);?></h2> 
                  <p class=" wow fadeInDown" data-wow-duration="0.8s"><?php print esc_html($finview_error_desc);?></p>
                  <a href="<?php print esc_url(home_url('/'));?>" class="btn_theme mt_40  wow fadeInUp" data-wow-duration="0.8s"><?php print esc_html($finview_error_link_text);?><i class="bi bi-arrow-up-right"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
get_footer();
