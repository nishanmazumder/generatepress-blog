<?php

/**
 * The Sidebar containing the main widget areas.
 *
 * @package GeneratePress
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<div <?php generate_do_attr('right-sidebar'); ?>>
	<div class="inside-right-sidebar">
		<?php
		/**
		 * generate_before_right_sidebar_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_before_right_sidebar_content');

		if (!dynamic_sidebar('sidebar-topics')) {
			generate_do_default_sidebar_widgets('sidebar-topics');
		}
		/**
		 * generate_after_right_sidebar_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_after_right_sidebar_content');
		?>
	</div>
</div>