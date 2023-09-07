<?php
/**
 * Text with image content block renderer
 */
$index = $args['index'];
$block = $args['block'];
?>

<div class="<?php echo $block['container']; ?>">

    <?php if( $block['image_side'] === 'left' ) : ?>
        <div class="block block-image-text-odd block-image-text row align-items-center">
            <div class="col-12 col-lg-5">
                <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
            <div class="col-12 col-lg-7 text-start p-5">
                <?= $block['text']; ?>
                <?php if( $block['use_button'] ) : ?>
                    <a href="<?= $block['button_link']; ?>" role="button" class="btn btn-dark mt-3">
                        <?= $block['button_text']; ?>
                        <i class="fa-sharp fa-light fa-arrow-right-long ms-3"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="block block-image-text-even block-image-text row align-items-center">
            <div class="col-12 col-lg-7 text-start p-5">
                <?= $block['text']; ?>
                <?php if( $block['use_button'] ) : ?>
                    <a href="<?= $block['button_link']; ?>" role="button" class="btn btn-dark mt-3">
                        <?= $block['button_text']; ?>
                        <i class="fa-sharp fa-light fa-arrow-right-long ms-3"></i>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-5">
                <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- <?php if( $index % 2 === 0 ) : ?>

    <div class="block block-image-text block-even block-<?= strtolower( $block['variant'] ) ?>">
        <div class="block-col">
            <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
        </div>
        <div class="block-col text-start p-5">
            <?= $block['text']; ?>
            <?php if( $block['show_button'] ) : ?>
                <a href="<?= $block['button']['link']; ?>" role="button" class="btn btn-dark mt-3">
                    <?= $block['button']['text']; ?>
                    <i class="fa-sharp fa-light fa-arrow-right-long ms-3"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

<?php else : ?>
    <div class="block block-image-text block-odd block-<?= strtolower( $block['variant'] ) ?>">
        <div class="block-col text-end p-5">
            <?= $block['text']; ?>
            <?php if( $block['show_button'] ) : ?>
                <a href="<?= $block['button']['link']; ?>" role="button" class="btn btn-outline-dark mt-3">
                    <?= $block['button']['text']; ?>
                    <i class="fa-sharp fa-light fa-arrow-right-long ms-3"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="block-col">
            <?php get_template_part('global-templates/image', null, ['image_ID' => $block['image']]); ?>
        </div>
    </div>
<?php endif ?> -->