<?php
/**
 * Block editor
 * 
 * Render blocks
 * 
 * @since 1.0.0
 * @package Woonstee
 */
$blocks = get_field('blocks');

if( ! $blocks || empty( $blocks ) ) {
    return;
}

array_walk( $blocks, 'codeit_render_block');
?>