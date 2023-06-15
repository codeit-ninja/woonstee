<?php
/**
 * Home page blocks logic implementation
 */
$blocks = get_field('blocks');

if( ! $blocks || empty( $blocks ) ) {
    return;
}

// echo '<pre>'; 
// print_r($blocks);
// echo '</pre>';

array_walk( $blocks, 'codeit_render_block');
?>