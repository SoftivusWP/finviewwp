<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finview
 */

$finview_blog_btn = get_theme_mod( 'finview_blog_btn', 'Read More' );
$finview_blog_btn_switch = get_theme_mod( 'finview_blog_btn_switch', true );

?>

<?php if ( !empty( $finview_blog_btn_switch ) ): ?>
<div class="postbox__read-more mt-4">
    <a href="<?php the_permalink();?>" class="tp-btn btn_theme"><?php print esc_html( $finview_blog_btn );?></a>
</div>
<?php endif;?>