<?php

/**
 * The main template file
 *
 * Template Name: Blog Left Sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package avalle
 * @since 1.0.0
 * 
 */
get_header();

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
);
$query = new WP_Query($args);

?>

    <section class="blog blog-grid section">
        <div class="container ">
            <div class="row gy-5 gy-lg-0">
                <div class="col-12 col-lg-5 col-xl-4">
                    <div class="sidebar wow fadeInDown" data-wow-duration="0.8s">
                        <?php get_sidebar() ?>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8">
                    <div class="row g-4">
                        <?php
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                ?>
                                <div class="col-12 col-xl-6">
                                    <div class="card card--secondary wow fadeInUp" data-wow-duration="0.8s">
                                        <?php if(has_post_thumbnail()):?>    
                                            <a href="<?php the_permalink()?>" class="card--secondary__thumb zoom_effect">
                                                <?php the_post_thumbnail('finview-blog')?>
                                            </a>
                                        <?php endif;?>
                                        <div class="card--secondary__content">
                                            <p class="card--secondary__time mb-4 d-flex gap-3 flex-wrap"><span class="gap-6"><i class="bi bi-person-circle"></i> <?php echo get_the_author()?></span><span class="gap-6"><i class="bi bi-calendar-check"></i><?php echo get_the_date()?> </span> <a href="<?php comments_link();?>"><i class="bi bi-chat-dots"></i><?php comments_number();?></a></p>
                                            <a href="<?php the_permalink()?>">
                                                <h4><?php the_title()?></h4>
                                            </a>
                                            <p class="mt-4"><?php echo wp_trim_words(get_the_content(), 13);?></p>
                                            <a href="<?php the_permalink()?>" class="mt_32 read_more"><?php echo esc_html__('Read more','finview')?><i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation" class="nav_pagination">
                                <ul class="pagination">
                                    <?php
                                    $big = 999999999;
                                    echo paginate_links(array(
                                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                        'format' => '?paged=%#%',
                                        'current' => max(1, get_query_var('paged')),
                                        'total' => $query->max_num_pages,
                                        'prev_text' => '<span class="prev-icon"></span>',
                                        'next_text' => '<span class="next-icon"></span>',
                                    ));
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
