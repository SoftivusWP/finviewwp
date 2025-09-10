<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finview
 */

// info
$finview_btnone_switch = get_theme_mod('finview_btnone_switch', false);
$finview_navright_search_switch = get_theme_mod('finview_navright_search_switch', false);
$finview_offcanvas_switch = get_theme_mod('finview_offcanvas_switch', false);
$finview_cart_switch = get_theme_mod('finview_cart_switch', false);
$finview_menu_col = $finview_offcanvas_switch ? 'col-md-7 col-xl-8' : 'col-12';

// contact button
$finview_buttonone_text = get_theme_mod('finview_btnone_text', __('Sign In', 'finview'));
$finview_buttonone_link = get_theme_mod('finview_btnone_link', __('#', 'finview'));

// header_sticky
$finview_header_sticky = get_theme_mod('finview_header_sticky', true);

$finview_header_sticky_style = get_theme_mod('finview_header_sticky_style', '');

if ($finview_header_sticky_style == 'sticky-style-2') {
   $finview_current_sticky_style = '';
} else {
   $finview_current_sticky_style = '';
}

?>

<!-- header area start -->

<?php
$finview_preloader = get_theme_mod('finview_preloader', false);
$finview_backtotop = get_theme_mod('finview_backtotop', false);
?>

<?php if (!empty($finview_preloader)) : ?>

   <!--  Preloader  -->
   <div class="preloader">
      <span class="loader"></span>
   </div>

   <!-- pre loader area end -->
<?php endif; ?>

<?php if (!empty($finview_backtotop)) : ?>
   <!-- back to top start -->
   <a href="#" class="scrollToTop"><i class="bi bi-chevron-double-up"></i></a>
   <!-- back to top end -->
<?php endif; ?>

<script>
   jQuery(function($) {
      "use strict";
      jQuery(document).ready(function() {
         var finviewHeaderStickyStyle = '<?php echo esc_js($finview_header_sticky_style); ?>';
         var scroll_offset = 120;
         if (finviewHeaderStickyStyle === 'sticky-style-2') {
            var lastScroll = 0;
            var isScrolled = false;
            window.addEventListener("scroll", function() {
               var topHeader = document.querySelector(".header-sticky");
               var currentScroll =
                  window.pageYOffset ||
                  document.documentElement.scrollTop ||
                  document.body.scrollTop ||
                  0;
               var scrollDirection = currentScroll < lastScroll;
               var shouldToggle = isScrolled && scrollDirection;
               isScrolled = currentScroll > 5;
               topHeader.classList.toggle("header-active", shouldToggle);
               lastScroll = currentScroll;
            });
         } else {
            $(window).scroll(function() {
               var $this = $(window);
               if ($(".header-sticky").length) {
                  if ($this.scrollTop() > scroll_offset) {
                     $(".header-sticky").addClass("header-active");
                  } else {
                     $(".header-sticky").removeClass("header-active");
                  }
               }
            });
         }
      });
   });
</script>

<header class="header-section <?php echo esc_attr($finview_header_sticky) ? 'header-sticky' : ''; ?> <?php echo esc_attr($finview_current_sticky_style); ?>">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <nav class="navbar navbar-expand-xl nav-shadow">
               <?php finview_header_logo(); ?>
               <div class="collapse navbar-collapse">
                  <div class="main-menu">

                     <?php finview_header_menu(); ?>

                  </div>
               </div>

               <?php if (!empty($finview_cart_switch) || !empty($finview_navright_search_switch) || !empty($finview_btnone_switch)) : ?>
                  <div class="nav-right d-none d-xl-flex">

                     <?php if (!empty($finview_cart_switch)) : ?>
                        <?php
                        // Check if WooCommerce is active
                        if (class_exists('WooCommerce')) :
                        ?>
                           <a href="<?php echo wc_get_cart_url(); ?>" class="cart mt-xl-3">
                              <i class="bi bi-cart2"></i>
                              <span class="card_count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                           </a>
                        <?php endif; ?>
                     <?php endif; ?>

                     <?php if (!empty($finview_navright_search_switch)) : ?>
                        <div class="nav-right__search">
                           <span class="nav-right__search-icon btn_theme btn_alt rounded-circle box_12 p-0"> <i class="bi bi-search"></i> </span>
                           <div class="nav-right__search-inner">
                              <div class="nav-search-inner__form">
                                 <form method="GET" id="search" class="inner__form" action="<?php echo esc_url(home_url('/')); ?>">
                                    <div class="input-group">
                                       <input type="text" class="form-control" placeholder="<?php echo esc_attr__('Search Here', 'finview'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr('Search for:', 'finview'); ?>" required>
                                       <button type="submit" class="search_icon"><i class="bi bi-search"></i></button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     <?php endif; ?>

                     <?php if (!empty($finview_btnone_switch)) : ?>
                        <a href="<?php echo esc_url($finview_buttonone_link) ?>" class="btn_theme"><?php echo esc_html($finview_buttonone_text) ?> <i class="bi bi-arrow-up-right"></i></a>
                     <?php endif; ?>
                  </div>
               <?php endif; ?>
               <span class="d-flex gap-3  d-xl-none">
                  <?php if (!empty($finview_cart_switch)) : ?>
                     <?php
                     // Check if WooCommerce is active
                     if (class_exists('WooCommerce')) :
                     ?>
                        <a href="<?php echo wc_get_cart_url(); ?>" class="cart mt-xl-3">
                           <i class="bi bi-cart2"></i>
                           <span class="card_count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                     <?php endif; ?>
                  <?php endif; ?>
                  <a class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                     <i class="bi bi-list"></i>
                  </a>
               </span>
         </div>
         </nav>
      </div>
   </div>
   </div>
</header>


<div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight">
   <div class="offcanvas-body custom-nevbar">
      <div class="row">
         <div class="<?php $finview_menu_col ?>">
            <div class="custom-nevbar__left">
               <button type="button" class="close-icon d-md-none ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x"></i></button>

               <?php finview_header_menu(); ?>

            </div>
         </div>
         <?php if (!empty($finview_offcanvas_switch)) : ?>
            <div class="col-md-5 col-xl-4">
               <div class="custom-nevbar__right">
                  <div class="custom-nevbar__top d-none d-md-block">
                     <button type="button" class="close-icon ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x"></i></button>
                     <div class="custom-nevbar__right-thumb mb-auto">
                        <?php finview_header_logo(); ?>
                     </div>
                  </div>
                  <?php
                  $default_address = '6391 Celina, Delaware 10299';
                  $finview_extra_address = get_theme_mod('finview_extra_address', wp_kses_post($default_address));

                  $default_mail = 'Info@gmail.com';
                  $finview_extra_email = get_theme_mod('finview_extra_email', wp_kses_post($default_mail));

                  $default_phone = '+123 456 789';
                  $finview_extra_phone = get_theme_mod('finview_extra_phone', wp_kses_post($default_phone));
                  ?>

                  <ul class="custom-nevbar__right-location">
                     <?php if (!empty($finview_extra_phone)) :   ?>
                        <li>
                           <p class="mb-2"> <?php echo esc_html__('Phone:', 'finview') ?> </p>
                           <div class="contact"><?php echo wp_kses($finview_extra_phone, wp_kses_allowed_html('post'))  ?></div>
                        </li>
                     <?php endif ?>
                     <?php if (!empty($finview_extra_email)) :   ?>
                        <li class="location">
                           <p class="mb-2"><?php echo esc_html__('Email:', 'finview') ?> </p>
                           <div class="fs-4 contact"><?php echo wp_kses($finview_extra_email, wp_kses_allowed_html('post'))  ?></div>
                        </li>
                     <?php endif ?>
                     <?php if (!empty($finview_extra_address)) :   ?>
                        <li class="location">
                           <p class="mb-2"><?php echo esc_html__('Location:', 'finview') ?></p>
                           <p class="fs-4 contact"> <?php echo wp_kses($finview_extra_address, wp_kses_allowed_html('post'))  ?></p>
                        </li>
                     <?php endif ?>
                  </ul>
               </div>
            </div>
         <?php endif ?>
      </div>
   </div>
</div>

<!-- header area end -->