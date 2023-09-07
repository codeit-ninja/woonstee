<?php
/**
 * Home page blocks logic implementation
 */
$blocks = get_field('blocks');

if( ! $blocks || empty( $blocks ) ) {
    return;
}

array_walk( $blocks, 'codeit_render_block');
?>