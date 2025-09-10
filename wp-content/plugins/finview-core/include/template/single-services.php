<?php

/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();
?>
<section class="service-details">
    <div class="container-fluid custom-container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <?php the_content() ?>
        <?php
            endwhile;
            wp_reset_query();
        endif;
        ?>
    </div>
</section>
<?php get_footer(); ?>