<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
    '/instagram.php'
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

// Register rest route for Instagram integration
add_action( 'rest_api_init', array( WP_Instagram::class, 'register_rest_route' ) );

add_theme_support('soil', [
    'clean-up',
    'disable-trackbacks',
    'nice-search'
]);

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

    // Font awesome
    wp_enqueue_style('font-awesome-styles', '//ka-f.fontawesome.com/releases/v6.4.0/css/pro.min.css', array(), $css_version);
    wp_enqueue_style('font-awesome-styles', '//ka-f.fontawesome.com/releases/v6.4.0/css/pro-v5-font-face.min.css', array(), $css_version);

    // Theme specific styles
    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version);
    wp_enqueue_style('custom-theme-styles', get_stylesheet_directory_uri() . $custom_theme_styles, array(), $css_version);
    wp_enqueue_script('jquery');

    $js_version = $theme_version . '.' . filemtime(get_stylesheet_directory() . $theme_scripts);

    // Theme specific scripts
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
    add_image_size('thumbnail-medium', 480, 480, true);
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

    if ($block['acf_fc_layout'] === 'block_hero_banner') {
        return get_template_part('templates/blocks/hero', 'banner', array('index' => $index, 'block' => $block));
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

    if ($block['acf_fc_layout'] === 'block_cta') {
        return get_template_part('templates/blocks/cta', null, array('index' => $index, 'block' => $block));
    }

    if ($block['acf_fc_layout'] === 'block_cta_image') {
        return get_template_part('templates/blocks/cta', 'image', array('index' => $index, 'block' => $block));
    }
}

function breadcrumbs()
{
    if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs();
}

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

// Allow SVG
function add_mime_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['avif'] = 'image/avif';
    $mime_types['avifs'] = 'image/avif-sequence';

    return $mime_types;
}
add_filter('upload_mimes', 'add_mime_types');

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

function parse_shortcode_atts( string $shortcode ) {
    // Store the shortcode attributes in an array heree
    $attributes = [];

    if (preg_match_all('/\w+\=\".*?\"/', $shortcode, $key_value_pairs)) {

        // Now split up the key value pairs
        foreach($key_value_pairs[0] as $kvp) {
            $kvp = str_replace('"', '', $kvp);
            $pair = explode('=', $kvp);
            $attributes[$pair[0]] = $pair[1];
        }
    }

    // Return the array
    return $attributes;
}

function theme_slug_filter_wp_title( $title_parts ) {
    if ( is_404() ) {
        $title_parts['title'] = 'Pagina niet gevonden';
    }

    return $title_parts;
} 

// Hook into document_title_parts
add_filter( 'document_title_parts', 'theme_slug_filter_wp_title' );

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// Prevent search queries.
add_action(
	'parse_query',
	function ( $query, $error = true ) {
		if ( is_search() && ! is_admin() ) {
			$query->is_search       = false;
			$query->query_vars['s'] = false;
			$query->query['s']      = false;
			if ( true === $error ) {
				$query->is_404 = true;
			}
		}
	},
	15,
	2
);

// Remove the Search Widget.
add_action(
	'widgets_init',
	function () {
		unregister_widget( 'WP_Widget_Search' );
	}
);

// Remove the search form.
add_filter( 'get_search_form', '__return_empty_string', 999 );

// Remove the core search block.
add_action(
	'init',
	function () {
		if ( ! function_exists( 'unregister_block_type' ) || ! class_exists( 'WP_Block_Type_Registry' ) ) {
			return;
		}
		$block = 'core/search';
		if ( WP_Block_Type_Registry::get_instance()->is_registered( $block ) ) {
			unregister_block_type( $block );
		}
	}
);

// Remove admin bar menu search box.
add_action(
	'admin_bar_menu',
	function ( $wp_admin_bar ) {
		$wp_admin_bar->remove_menu( 'search' );
	},
	11
);

add_action('wp_enqueue_scripts', 'deregister_styles');
function deregister_styles(){
    
    // Deregister ACF Form style
    wp_deregister_style('acf-global');
    wp_deregister_style('acf-input');
    wp_deregister_style('acf-extended-input');
    wp_dequeue_style('contact-form-7');
    
    // Avoid dependency conflict
    wp_register_style('acf-global', false);
    wp_register_style('acf-input', false);
    wp_register_style('acf-extended-input', false);
    wp_register_style('contact-form-7', false);
}

add_filter('wpcf7_autop_or_not', '__return_false');

function social_links() {
    $html = '<div class="d-flex gap-3">';

    foreach( get_field('social_links', 'option') as $social ) {
        $html .= '<a href="'. $social['link'] .'">'. $social['icon'] .'</a>';
    }

    $html .= '</div>';

    return $html;
}
add_shortcode('social-links', 'social_links');

function get_social_link_by_type( string $t ) {
    $types = get_field('social_links', 'option');
    $social = current( array_filter( $types, fn( $type ) => str_contains( $type['link'], $t ) ) );

    if( $social ) {
        return $social['link'];
    }

    return false; 
}

function remove_default_post_type($args, $postType) {
    if ($postType === 'post') {
        $args['public']                = false;
        $args['show_ui']               = false;
        $args['show_in_menu']          = false;
        $args['show_in_admin_bar']     = false;
        $args['show_in_nav_menus']     = false;
        $args['can_export']            = false;
        $args['has_archive']           = false;
        $args['exclude_from_search']   = true;
        $args['publicly_queryable']    = false;
        $args['show_in_rest']          = false;
    }

    return $args;
}
add_filter('register_post_type_args', 'remove_default_post_type', 0, 2);

function team_members() {
    ob_start();

    $members = get_field( 'team_members', 'option' );

    array_walk( $members, fn( $member ) => get_template_part('loop-templates/team', 'member', $member) );

    return sprintf('<div class="row" id="team-members">%s</div>', ob_get_clean());
}
add_shortcode('team-members', 'team_members');