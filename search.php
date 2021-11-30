<?php

/**
 * The template for displaying Search Results pages.
 *
 * @package GeneratePress
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<div <?php generate_do_attr('content'); ?>>
	<main <?php generate_do_attr('main'); ?>>
		<?php
		/**
		 * generate_before_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_before_main_content'); ?>

		<div class="container-fluid nm-topic-header">
			<div class="row nm-topic-heaer-title">
				<div class="col-md-12">
					<!-- <php
					$id = 11;
					$post = get_post($id);
					$content = apply_filters('the_content', $post->post_content);
					?> -->
					<h2 style="margin-bottom: 5px;"><?php wp_title(' '); ?></h2>
					<!-- <p><php echo $content; ?></p> -->
				</div>
			</div>
		</div>


		<?php
		if (generate_has_default_loop()) {
			if (have_posts()) :
				get_template_part('content', 'loop');
			else :
				generate_do_template_part('none');
			endif;
		}

		/**
		 * generate_after_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_after_main_content');
		?>
	</main>
</div>

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action('generate_after_primary_content_area'); ?>

<!-- <div class="nm-sidbar-right"> -->
<?php
if (is_active_sidebar('sidebar-topics')) {
	get_sidebar('topics');
} else {
	echo "No data avaialable!";
}
?>
<!-- </div> -->

<?php
get_footer();
