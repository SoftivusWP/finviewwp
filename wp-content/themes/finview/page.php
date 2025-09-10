<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package finview
 */

get_header();

?>

<div class="tp-page-area sec-mar">
	<?php
	if (class_exists('\Elementor\Plugin') && is_a(\Elementor\Plugin::$instance, '\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($post->ID)->is_built_with_elementor()) :
		?>
		<div class="container-fluid custom-container">
		<?php else : ?>
			<div class="container">
			<?php endif; ?>
			<div class="row">
				<div class="col-xl-12">
					<div class="tp-page-content">
						<?php
						if (have_posts()) :
							while (have_posts()) : the_post();
								get_template_part('template-parts/content', 'page');
							endwhile;
						else :
							get_template_part('template-parts/content', 'none');
						endif;
						?>
					</div>
				</div>
			</div>
			</div>
		</div>


		<?php
		get_footer();
