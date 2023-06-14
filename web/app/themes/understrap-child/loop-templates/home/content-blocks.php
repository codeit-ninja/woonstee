<?php
/**
 * Home page blocks logic implementation
 */
$blocks = get_field('blocks');

if( ! $blocks || empty( $blocks ) ) {
    return;
}
?>

<?php foreach( $blocks as $block ) : ?>

    <div class="block block-<?= strtolower( $block['variant'] ) ?>">
        <div class="block-image">
            <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
        </div>
        <div class="block-text">
            <?= $block['text']; ?>
            <?php if( $block['show_button'] ) : ?>
                <a href="<?= $block['button']['link']; ?>" role="button" class="btn btn-outline-dark mt-3">
                    <?= $block['button']['text']; ?>
                    <i class="fa-sharp fa-light fa-arrow-right-long ms-3"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

<?php endforeach; ?>