<?php
/**
 * TPCore Sidebar Posts Category
 *
 * @author     Theme_Pure
 * @category   Widgets
 * @package    TPCore/Widgets
 * @version    1.0.0
 * @extends    WP_Widget
 */

class TP_Post_Category_Sidebar_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct('tp-blog-posts-category', 'TP Sidebar Blog Posts Category', array(
			'description'    => 'Blog Post Category Widget by Theme_Pure'
		));
	}


	public function widget($args, $instance)
	{
		extract($args);
		extract($instance);

		echo $before_widget;
		if (!empty($instance['title'])) {
			echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		}
?>

		<div class="rc__post-wrapper">
			<ul class="category p-0">
				<?php
				// Get all categories
				$categories = get_categories();
				foreach ($categories as $category) {
					$post_category_image = get_field('post_category_image', $category);
				?>
					<li>
						<a href="<?php echo get_category_link($category->term_id); ?>">
							<?php if (!empty($post_category_image)) : ?>
								<span class="category__icon">
									<img src="<?php echo esc_url($post_category_image['url']); ?>" alt="<?php echo esc_attr("icon"); ?>">
								</span>
							<?php endif ?>
							<span class="category__content"><?php echo $category->name; ?></span>
						</a>
					</li>
				<?php
				}
				?>
			</ul>
		</div>

	<?php echo $after_widget;
	}



	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$count = !empty($instance['count']) ? $instance['count'] : '3'; // Default count is '3'
		$posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : 'DESC'; // Default order is 'DESC'
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($count); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php selected($posts_order, 'ASC'); ?>>ASC</option>
				<option value="DESC" <?php selected($posts_order, 'DESC'); ?>>DESC</option>
			</select>
		</p>

<?php }
}

add_action('widgets_init', function () {
	register_widget('TP_Post_Category_Sidebar_Widget');
});
