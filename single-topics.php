<?php

/**
 * The Template for displaying all single posts.
 *
 * @package GeneratePress
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div <?php generate_do_attr('content'); ?>>
	<div class="nm-sidbar-table">
		<?php
		if (is_active_sidebar('sidebar-tablecontent')) {
			get_sidebar('tablecontent');
		} else {
			echo "No data avaialable!";
		}
		?>
	</div>
	<!-- <main <php generate_do_attr('main'); ?>> -->
	<main class="nm-topic-single-container">

		<?php
		/**
		 * generate_before_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_before_main_content');

		if (generate_has_default_loop()) {
			while (have_posts()) :
				the_post();
				get_template_part('content', 'topics');
			endwhile;
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
do_action('generate_after_primary_content_area');

if (is_active_sidebar('sidebar-topics')) {
	get_sidebar('topics');
} else {
	echo "No data avaialable!";
}

get_footer();
