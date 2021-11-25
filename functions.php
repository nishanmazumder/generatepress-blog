<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

// END ENQUEUE PARENT ACTION

// Assets
add_action('wp_enqueue_scripts', 'nm_register_scripts');
function nm_register_scripts()
{
    wp_enqueue_style('bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js', array('jquery'), '', true);
}

// Topics sidebar.
nm_topics_sidebar();
function nm_topics_sidebar()
{
    register_sidebar(array(
        'name'          => __('Topics Sidebar', 'generatepress'),
        'id'            => 'sidebar-topics',
        'description'   => __('Widgets in this area will be shown on all topics.', 'generatepress'),
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => apply_filters('generate_start_widget_title', '<h2 class="widget-title">'),
        'after_title'   => apply_filters('generate_end_widget_title', '</h2>'),
    ));

    register_sidebar(array(
        'name'          => __('Topics Table Content', 'generatepress'),
        'id'            => 'sidebar-tablecontent',
        'description'   => __('Widgets in this area will be shown on single post.', 'generatepress'),
        'before_widget' => '<aside id="%1$s" class="widget inner-padding %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => apply_filters('generate_start_widget_title', '<h2 class="widget-title">'),
        'after_title'   => apply_filters('generate_end_widget_title', '</h2>'),
    ));
}

//Post Content Limit 
function nm_post_content_limit($limit)
{
    $post_content = explode(' ', get_the_content());
    $limit_content = array_slice($post_content, 0, $limit);

    echo implode(' ', $limit_content);
}

//Pagination
function nm_post_pagination()
{
    $allowed_tags = [
        'span' => [
            'class' => []
        ],
        'a' => [
            'href' => [],
            'class' => []
        ]
    ];

    $arg = [
        'before_page_number' => '<span class="btn border boreder-secondary mr-2 mb-2">',
        'after_page_number' => '</span>'
    ];

    printf('<nav class="nm-pagi clearfix">%s</nav>', wp_kses(paginate_links($arg), $allowed_tags));
}

// Shortcode Topics
add_shortcode('nm_recent_post_topics', 'nm_topics_recent_post');
function nm_topics_recent_post()
{
    $args = [
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'post_type' => 'topics',
        'orderby'        => 'date',
        'short_order' => 'asc'
    ];

    $topics = new WP_Query($args);

    $data = '';
    if ($topics->have_posts()) :
        while ($topics->have_posts()) : $topics->the_post();
            $data .= '<a class="nm-topic-post-link" href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
        endwhile;
        wp_reset_postdata();
    endif;

    return $data;
}
