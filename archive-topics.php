<?php

/**
 * The template for displaying Archive pages.
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

				/**
				 * generate_archive_title hook.
				 *
				 * @since 0.1
				 *
				 * @hooked generate_archive_title - 10
				 */
				//do_action( 'generate_archive_title' );

				/**
				 * generate_before_loop hook.
				 *
				 * @since 3.1.0
				 */
				do_action('generate_before_loop', 'archive'); ?>
				<div class="container-fluid nm-topics-section">
					<div class="row">
						<?php
						while (have_posts()) :
							the_post();
						?>
							<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 nm-display-flex">
								<div class="nm-post-area">
									<a href="<?php esc_url(the_permalink()); ?>">
										<div class="nm-topics-img" style="background-image: url(<?php echo esc_url(the_post_thumbnail_url()); ?>);"></div>
									</a>
									<div class="nm-topics-title">
										<a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a>
									</div>
									<p><?php nm_post_content_limit(30); ?></p>
								</div>
							</div>

						<?php
						endwhile;

						/**
						 * generate_after_loop hook.
						 *
						 * @since 2.3
						 */
						do_action('generate_after_loop', 'archive'); ?>

					</div>
				</div>
		<?php

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
