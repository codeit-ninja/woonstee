<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles()
{

    // Get the theme data.
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get('Version');

    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    // Grab asset urls.
    $theme_styles = "/css/child-theme{$suffix}.css";
    $theme_scripts = "/js/child-theme{$suffix}.js";

    $custom_theme_styles = "/css/dewoonstee{$suffix}.css";

    $css_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_styles);

    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version);
    wp_enqueue_style('custom-theme-styles', get_stylesheet_directory_uri() . $custom_theme_styles, array(), $css_version);
    wp_enqueue_script('jquery');

    $js_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_scripts);

    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true);
    wp_enqueue_script('masonry-script', '//cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', array(), $js_version, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain()
{
    load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'add_child_theme_textdomain');



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version()
{
    return 'bootstrap5';
}
add_filter('theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20);



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js()
{
    wp_enqueue_script(
        'understrap_child_customizer',
        get_stylesheet_directory_uri() . '/js/customizer-controls.js',
        array('customize-preview'),
        '20130508',
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js');

/**
 * Disable the gutenberg editor if defined
 */
function disable_gutenberg_editor_check(bool $use_block_editor, WP_Post $post)
{
    if (get_field('disable_gutenberg_editor', $post->ID) || $post->post_type === 'project') {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post', 'disable_gutenberg_editor_check', 10, 2);

/**
 * Template block parser to use in `array_walk` 
 * when looping over the blocks
 * 
 *  @param array    $block
 *  @param int      $index
 */
function codeit_render_block($block, $index)
{
    if ($block['acf_fc_layout'] === 'block_hero_image') {
        return get_template_part('templates/blocks/hero', 'image', array('index' => $index, 'block' => $block));
    }

    if ($block['acf_fc_layout'] === 'block_image_with_text') {
        return get_template_part('templates/blocks/image', 'text', array('index' => $index, 'block' => $block));
    }

    if ($block['acf_fc_layout'] === 'block_text') {
        return get_template_part('templates/blocks/text', null, array('index' => $index, 'block' => $block));
    }

    if ($block['acf_fc_layout'] === 'block_slider') {
        return get_template_part('templates/blocks/slider', null, array('index' => $index, 'block' => $block));
    }

    if ($block['acf_fc_layout'] === 'block_price_table') {
        return get_template_part('templates/blocks/price', 'table', array('index' => $index, 'block' => $block));
    }
}

function breadcrumbs()
{
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
    }
}

function facebook_social_button()
{
    $article_url = get_article_url(); // Psuedo-code method to retrieve the article's URL.
    $article_url .= '#utm_source=facebook&utm_medium=social&utm_campaign=social_buttons';
    $title = html_entity_decode(get_og_title()); // Psuedo-code method to retrieve the og_title.
    $description = html_entity_decode(get_og_description()); // Psuedo-code method to retrieve the og_description.
    $og_image = get_og_image(); // Psuedo-code method to retrieve the og_image assigned to a post.
    $images = $og_image->get_images();
    $url = 'http://www.facebook.com/sharer/sharer.php?s=100';
    $url .= '&p[url]=' . urlencode($article_url);
    $url .= '&p[title]=' . urlencode($title);
    $url .= '&p[images][0]=' . urlencode($images[0]);
    $url .= '&p[summary]=' . urlencode($description);
    $url .= '&u=' . urlencode($article_url);
    $url .= '&t=' . urlencode($title);

    echo esc_attr($url);
}

add_shortcode('social-share-buttons', 'social_share_buttons');

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    global $wp_version;
    
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext' => $filetype['ext'],
        'type' => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
add_action('admin_head', 'fix_svg');