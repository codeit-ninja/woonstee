<?php
/**
 * Template Name: Subpages as menu
 * 
 * Template for showing the subpages as a menu
 *
 * @package Understrap
 */
defined('ABSPATH') || exit;
get_header();

$container = get_theme_mod('understrap_container_type');
$children = get_pages('child_of=' . 1362 . '&sort_column=menu_order');
?>

<div class="wrapper" id="page-wrapper">
    <div class="<?php echo esc_attr($container); ?>">
        <?php breadcrumbs(); ?>
    </div>

    <div class="container mb-5">
        <div class="row gx-5">
            <div class="col-md-3 sidebar-left">
                <ul class="nav nav-sidebar flex-column gap-1">
                    <?php foreach( $children as $child ) : ?>
                        <li class="<?php echo $child->ID === get_the_ID() ? 'active' : ''; ?>">
                            <a href="<?php echo get_the_permalink( $child->ID ) ?>"><?php echo $child->post_title; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-9">
                <main class="site-main" id="main" role="main">                    
                    <?php if( has_post_thumbnail() ) : ?>
                        <picture style="float: left;">
                            <?php the_post_thumbnail( array(350) ); ?>
                        </picture>
                    <?php endif; ?>
                    
                    <h1><?php the_title(); ?></h1>
                    <!-- Render blocks -->
                    <?php get_template_part('loop-templates/blocks/block', 'editor'); ?>
                        
                </main>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();