<?php
/**
 * Render image the WordPress way
 */
$url = wp_get_attachment_image_url( $args['image_ID'], 'full' );
$min_height = isset($args['min_height']) ? $args['min_height'] : 'auto';

printf(
    '<div class="tpl-bg-image" style="background-image: url(%s);min-height: %s;"></div>',
    $url,
    $min_height
);
?>