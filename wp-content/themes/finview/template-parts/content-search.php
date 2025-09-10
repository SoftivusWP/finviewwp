<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finview
 */
$finview_blog_content_words_number = get_theme_mod( 'finview_blog_content_words_number', '12' );
$finview_blog_content_switch = get_theme_mod( 'finview_blog_content_switch', true );

if ( is_single() ) : ?>
    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-search mb-4' );?>>
        <?php if ( has_post_thumbnail() ): ?>
            <div class="postbox__thumb">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </div>
        <?php endif;?>

        <div class="postbox__content">
            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
            <h3 class="postbox__title">
                <?php the_title();?>
            </h3>
            <div class="postbox__text">
               <?php the_content();?>
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'finview' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
            </div>
            <?php print finview_get_tag();?>
        </div>
    </article>
<?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-search mb-4');?>>
        <?php if ( has_post_thumbnail() ): ?>    
        <div class="postbox__thumb">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
        </div>
        <?php endif; ?>
        <div class="postbox__content">
            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

            <h3 class="postbox__title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>

            <?php if ( !empty( $finview_blog_content_switch ) ): ?>
            <div class="postbox__text">
                <?php  echo wp_trim_words( get_the_content(), absint( $finview_blog_content_words_number ) ); ?>
            </div>
            <?php endif; ?>

            <!-- blog btn -->
            <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
        </div>
    </article>
    
<?php endif;?>