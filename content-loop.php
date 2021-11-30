<?php

/**
 * The Loop
 *
 * @package BDSOFTcr
 */
?>

<div class="container-fluid nm-topics-section">
    <div class="row inside-article">
        <?php
        do_action('generate_before_loop', 'archive');
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