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
function nm_topics_post_type() {

	/**
	 * Post Type: Topics.
	 */

	$labels = [
		"name" => __( "Topics", "custom-post-type-ui" ),
		"singular_name" => __( "Topic", "custom-post-type-ui" ),
		"menu_name" => __( "Topics", "custom-post-type-ui" ),
		"all_items" => __( "All Topics", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Topic", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Topic", "custom-post-type-ui" ),
		"new_item" => __( "New Topic", "custom-post-type-ui" ),
		"view_item" => __( "View Topic", "custom-post-type-ui" ),
		"view_items" => __( "View Topics", "custom-post-type-ui" ),
		"search_items" => __( "Search Topics", "custom-post-type-ui" ),
		"not_found" => __( "No Topics found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Topics found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Topic:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Topic", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Topic", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Topic", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Topic", "custom-post-type-ui" ),
		"archives" => __( "Topic archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Topic", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Topic", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Topics list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Topics list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Topics list", "custom-post-type-ui" ),
		"attributes" => __( "Topics attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Topic", "custom-post-type-ui" ),
		"item_published" => __( "Topic published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Topic published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Topic reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Topic scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Topic updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Topic:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Topics", "custom-post-type-ui" ),
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
		"rewrite" => [ "slug" => "topics", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-welcome-widgets-menus",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments", "author", "page-attributes" ],
		"taxonomies" => [ "category", "post_tag" ],
		"show_in_graphql" => false,
	];

	register_post_type( "topics", $args );
}

// Assets
add_action('wp_enqueue_scripts', 'nm_register_scripts');
function nm_register_scripts()
{
    wp_enqueue_style('bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri().'/assets/custom.js', array('jquery'), '', true);
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

// Shortcode Topics || Widgets
add_shortcode('nm_recent_post_topics', 'nm_topics_recent_post');
function nm_topics_recent_post()
{
    $args = [
        'post_status' => 'publish',
        'posts_per_page' => 15,
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

// Shortcode Best Article || Widgets
add_shortcode('nm_best_article', 'nm_best_article_list');
function nm_best_article_list($attr, $content = null)
{
    $attr = shortcode_atts([
        'best' => 'uncategorized'
    ], $attr);

    $args = [
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'post_type' => 'topics',
        'orderby'        => 'date',
        'tax_query' => [[
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $attr['best']
        ]]
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
            // $data .= '<a href="' . esc_url(get_the_permalink()) . '"><div class="nm-releted-post-img" style="background:url(' . esc_url(get_the_post_thumbnail_url()) . ')" class="img-responsive"></div></a>';
            $data .= '<a href="' . esc_url(get_the_permalink()) . '" class="nm-related-img-div"><div style="background:url(' . esc_url(get_the_post_thumbnail_url()) . ')" class="img-responsive"></div></a>';
            $data .= '</div>';
        endwhile;
        $data .= '</div></div>';
        wp_reset_postdata();
    endif;

    return $data;
}

// Shortcode Latest Topics
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
            // $data .= '<a href="' . esc_url(get_the_permalink()) . '"><div class="nm-releted-post-img" style="background:url(' . esc_url(get_the_post_thumbnail_url()) . ')" class="img-responsive"></div></a>';
            $data .= '<a href="' . esc_url(get_the_permalink()) . '" class="nm-related-img-div"><div style="background:url(' . esc_url(get_the_post_thumbnail_url()) . ')" class="img-responsive"></div></a>';
            $data .= '<a class="nm-topic-related-post-link" href="' . esc_url(get_the_permalink()) . '">' . nm_post_title_limit_str(30) . '</a>';
            $data .= '<span>' . esc_html(get_the_modified_time('F d, Y')) . '</span>';
            $data .= '</div>';
        endwhile;
        $data .= '</div></div>';
        wp_reset_postdata();
    endif;

    return $data;
}

// Twitter Button
add_shortcode('nm_twitter', 'nm_twitter_btn');
function nm_twitter_btn($attr, $content = null)
{
    $attr = shortcode_atts([
        'text' => 'FOLLOW US ON',
        'link' => '#',
        'color' => '#F15A29',
        'hover' => '#fff'
    ], $attr);

    $btn = '';
    $btn .= '<style>
        .nm-follow-twitter:hover {
            background: ' . $attr['color'] . ';
            color: ' . $attr['hover'] . ' !important;
        }
    </style>';
    $btn .= '<a class="nm-follow-twitter" href="' . $attr['link'] . '" style="border: 2px solid ' . $attr['color'] . '; color: ' . $attr['color'] . '">
    ' . $attr['text'] . '
    <svg width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path d="M22.23,5.924c-0.736,0.326-1.527,0.547-2.357,0.646c0.847-0.508,1.498-1.312,1.804-2.27 c-0.793,0.47-1.671,0.812-2.606,0.996C18.324,4.498,17.257,4,16.077,4c-2.266,0-4.103,1.837-4.103,4.103 c0,0.322,0.036,0.635,0.106,0.935C8.67,8.867,5.647,7.234,3.623,4.751C3.27,5.357,3.067,6.062,3.067,6.814 c0,1.424,0.724,2.679,1.825,3.415c-0.673-0.021-1.305-0.206-1.859-0.513c0,0.017,0,0.034,0,0.052c0,1.988,1.414,3.647,3.292,4.023 c-0.344,0.094-0.707,0.144-1.081,0.144c-0.264,0-0.521-0.026-0.772-0.074c0.522,1.63,2.038,2.816,3.833,2.85 c-1.404,1.1-3.174,1.756-5.096,1.756c-0.331,0-0.658-0.019-0.979-0.057c1.816,1.164,3.973,1.843,6.29,1.843 c7.547,0,11.675-6.252,11.675-11.675c0-0.178-0.004-0.355-0.012-0.531C20.985,7.47,21.68,6.747,22.23,5.924z"></path></svg>
    </a>';

    return $btn;
}

// Widget Title
add_shortcode('nm_widget_title', 'nm_widget_title_text');
function nm_widget_title_text($attr, $content = null)
{
    $attr = shortcode_atts([
        'text' => 'Best Articles',
        'icon' => '#d9645a'
    ], $attr);

    $title = '';

    $title .= '<style>
    .nm-widget-title svg{
        fill: ' . $attr['icon'] . ';
    }
    </style>';

    $title .= '<div class="nm-widget-title wp-block-uagb-icon-list uagb-icon-list__outer-wrap uagb-icon-list__layout-vertical uagb-block-1b1009b2">
    <div class="uagb-icon-list__wrap">
    <div class="wp-block-uagb-icon-list-child uagb-icon-list-repeater uagb-icon-list__wrapper uagb-block-d19f6de2 nm-title">
    <div class="uagb-icon-list__content-wrap"><span class="uagb-icon-list__source-wrap"><span class="uagb-icon-list__source-icon">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M496.25 202.52l-110-15.44 41.82-104.34c6.67-16.64-11.6-32.18-26.59-22.63L307.44 120 273.35 12.82C270.64 4.27 263.32 0 256 0c-7.32 0-14.64 4.27-17.35 12.82l-34.09 107.19-94.04-59.89c-14.99-9.55-33.25 5.99-26.59 22.63l41.82 104.34-110 15.43c-17.54 2.46-21.68 26.27-6.03 34.67l98.16 52.66-74.48 83.54c-10.92 12.25-1.72 30.93 13.29 30.93 1.31 0 2.67-.14 4.07-.45l108.57-23.65-4.11 112.55c-.43 11.65 8.87 19.22 18.41 19.22 5.15 0 10.39-2.21 14.2-7.18l68.18-88.9 68.18 88.9c3.81 4.97 9.04 7.18 14.2 7.18 9.54 0 18.84-7.57 18.41-19.22l-4.11-112.55 108.57 23.65c17.36 3.76 29.21-17.2 17.35-30.49l-74.48-83.54 98.16-52.66c15.64-8.39 11.5-32.2-6.04-34.66zM338.51 311.68l-51.89-11.3 1.97 53.79L256 311.68l-32.59 42.49 1.96-53.79-51.89 11.3 35.6-39.93-46.92-25.17 52.57-7.38-19.99-49.87 44.95 28.62L256 166.72l16.29 51.23 44.95-28.62-19.99 49.87 52.57 7.38-46.92 25.17 35.61 39.93z"></path></svg></span></span>
    <div class="uagb-icon-list__label-wrap"><span class="uagb-icon-list__label">
    ' . $attr['text'] . '</span>
    </div>
    </div>
    </div>
    </div>
    </div>';

    return $title;
}

// Footer menu
add_action('after_setup_theme', 'nm_footer_menu');
function nm_footer_menu()
{
    register_nav_menu('nm-footer-menu', __('Footer Menu', 'generatepress'));
}
