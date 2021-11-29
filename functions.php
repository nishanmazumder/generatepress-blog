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
// Post Types TOPICS
add_action('init', 'nm_topics_post_type');
function nm_topics_post_type()
{

    /**
     * Post Type: Topics.
     */

    $labels = [
        "name" => __("Topics", "custom-post-type-ui"),
        "singular_name" => __("Topic", "custom-post-type-ui"),
        "menu_name" => __("Topics", "custom-post-type-ui"),
        "all_items" => __("All Topics", "custom-post-type-ui"),
        "add_new" => __("Add new", "custom-post-type-ui"),
        "add_new_item" => __("Add new Topic", "custom-post-type-ui"),
        "edit_item" => __("Edit Topic", "custom-post-type-ui"),
        "new_item" => __("New Topic", "custom-post-type-ui"),
        "view_item" => __("View Topic", "custom-post-type-ui"),
        "view_items" => __("View Topics", "custom-post-type-ui"),
        "search_items" => __("Search Topics", "custom-post-type-ui"),
        "not_found" => __("No Topics found", "custom-post-type-ui"),
        "not_found_in_trash" => __("No Topics found in trash", "custom-post-type-ui"),
        "parent" => __("Parent Topic:", "custom-post-type-ui"),
        "featured_image" => __("Featured image for this Topic", "custom-post-type-ui"),
        "set_featured_image" => __("Set featured image for this Topic", "custom-post-type-ui"),
        "remove_featured_image" => __("Remove featured image for this Topic", "custom-post-type-ui"),
        "use_featured_image" => __("Use as featured image for this Topic", "custom-post-type-ui"),
        "archives" => __("Topic archives", "custom-post-type-ui"),
        "insert_into_item" => __("Insert into Topic", "custom-post-type-ui"),
        "uploaded_to_this_item" => __("Upload to this Topic", "custom-post-type-ui"),
        "filter_items_list" => __("Filter Topics list", "custom-post-type-ui"),
        "items_list_navigation" => __("Topics list navigation", "custom-post-type-ui"),
        "items_list" => __("Topics list", "custom-post-type-ui"),
        "attributes" => __("Topics attributes", "custom-post-type-ui"),
        "name_admin_bar" => __("Topic", "custom-post-type-ui"),
        "item_published" => __("Topic published", "custom-post-type-ui"),
        "item_published_privately" => __("Topic published privately.", "custom-post-type-ui"),
        "item_reverted_to_draft" => __("Topic reverted to draft.", "custom-post-type-ui"),
        "item_scheduled" => __("Topic scheduled", "custom-post-type-ui"),
        "item_updated" => __("Topic updated.", "custom-post-type-ui"),
        "parent_item_colon" => __("Parent Topic:", "custom-post-type-ui"),
    ];

    $args = [
        "label" => __("Topics", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => "topics",
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "topics", "with_front" => true],
        "query_var" => true,
        "menu_icon" => "dashicons-welcome-widgets-menus",
        "supports" => ["title", "editor", "thumbnail", "excerpt", "custom-fields", "comments", "author", "page-attributes"],
        "taxonomies" => ["post_tag"],
        "show_in_graphql" => false,
    ];

    register_post_type("topics", $args);
}

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

//Post title Limit 
function nm_post_title_limit($limit)
{
    $post_title = explode(' ', get_the_title());
    $limit_content = array_slice($post_title, 0, $limit);

    return implode(' ', $limit_content);
}

// Post title limit by string
function nm_post_title_limit_str($content_count = 0)
{
    // Get title
    $excerpt = wp_strip_all_tags(get_the_title());
    $excerpt = substr($excerpt, 0, $content_count);
    $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));

    return $excerpt;
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

// Gutenberg Editor size
function nm_block_editor_styles()
{
    $version = filemtime(get_stylesheet_directory() . '/assets/css/nm-editor.css');

    wp_enqueue_style(
        '/assets/css/nm-editor.css',
        get_stylesheet_directory_uri() . '/assets/css/nm-editor.css',
        [],
        $version
    );
}
add_action('enqueue_block_editor_assets', 'nm_block_editor_styles');

// Shortcode Realated Topics
add_shortcode('nm_related_post_topics', 'nm_topics_related_post');
function nm_topics_related_post()
{
    $args = [
        'post_type' => 'topics',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'order'        => 'desc',
        'orderby' => 'rand',
    ];

    //Get all Tag ids form single post
    $get_tags_single = wp_get_post_terms(get_queried_object_id(), 'post_tag', ['fields' => 'ids']);

    if (is_tag()) {
        $args['tag_id'] = get_queried_object_id();
    } elseif (is_single()) {
        $args['tag__in'] = $get_tags_single;
        $args['post__not_in'] = [get_queried_object_id()];
    }

    $topics = new WP_Query($args);

    if ($topics->have_posts()) :
        $data = '<div class="container-fluid nm-no-pad nm-topic-related-container"> <div class="row">';
        while ($topics->have_posts()) : $topics->the_post();
            $data .= '<div class="col-md-4 col-sm-12 col-xs-12 nm-topic-related">';
            $data .= '<span>' . esc_html(get_the_modified_time('M d, Y')) . '</span>';
            $data .= '<a class="nm-topic-related-post-link" href="' . esc_url(get_the_permalink()) . '">' . nm_post_title_limit_str(30) . '</a>';
            $data .= '<a href="' . esc_url(get_the_permalink()) . '"><div class="nm-releted-post-img" style="background:url(' . esc_url(get_the_post_thumbnail_url()) . ')" class="img-responsive"></div></a>';
            $data .= '</div>';
        endwhile;
        $data .= '</div></div>';
        wp_reset_postdata();
    endif;

    return $data;
}

// Shortcode Realated Topics
add_shortcode('nm_latest_post_topics', 'nm_topics_latest_post');
function nm_topics_latest_post()
{
    $args = [
        'post_type' => 'topics',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'order'        => 'desc'
    ];

    $topics = new WP_Query($args);

    if ($topics->have_posts()) :
        $data = '<div class="container-fluid nm-no-pad nm-topic-related-container nm-topics-latest"> <div class="row">';
        while ($topics->have_posts()) : $topics->the_post();
            $data .= '<div class="col-md-4 col-sm-12 col-xs-12 nm-topic-related">';
            $data .= '<a href="' . esc_url(get_the_permalink()) . '"><div class="nm-releted-post-img" style="background:url(' . esc_url(get_the_post_thumbnail_url()) . ')" class="img-responsive"></div></a>';
            $data .= '<a class="nm-topic-related-post-link" href="' . esc_url(get_the_permalink()) . '">' . nm_post_title_limit_str(30) . '</a>';
            $data .= '<span>' . esc_html(get_the_modified_time('F d, Y')) . '</span>';
            $data .= '</div>';
        endwhile;
        $data .= '</div></div>';
        wp_reset_postdata();
    endif;

    return $data;
}

// Footer menu
add_action('after_setup_theme', 'nm_footer_menu');
function nm_footer_menu(){
    register_nav_menu('nm-footer-menu', __('Footer Menu', 'generatepress'));
}