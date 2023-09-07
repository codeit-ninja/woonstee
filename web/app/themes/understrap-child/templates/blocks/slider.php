<?php
/**
 * Glide.js slider
 * 
 * @link https://glidejs.com/docs/
 */
$block = $args['block'];
?>

<div class="glide">
    <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
            <?php foreach( $block['images'] as $image ) : ?>
                <li class="glide__slide">
                    <img src="<?=$image['sizes']['medium']; ?>" />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>