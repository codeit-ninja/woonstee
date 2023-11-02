<?php
/**
 * Hero image block
 */
$index = $args['index'];
$block = $args['block'];

$image = wp_get_attachment_image( $block['image'], 'full', false, array('class' => 'img-fluid mx-auto') );
$text = $block['text'];
$fullwidth = $block['fullwidth'] ? 'container-fluid p-0' : 'container';
$fullheigth = ! $block['fixed_height'] && $block['fullheigth'] ? 'vh-100' : '';

$heigth = '';

if( $block['fixed_height'] ) {
    $heigth = 'style="height: '. $block['height_in_px'] .'px;"';
}
?>
<div class="block block-hero-banner">
    <div class="container h-100">
        <div class="row align-items-center h-100 g-5">
            <div class="col-lg-6 order-1 order-lg-0" data-aos="fade-right">
                <div class="d-flex flex-column gap-4">
                    <div class="block-hero-banner-heading">Verrassend, inspirerend & veelzeidig</div>
                    <div class="block-hero-banner-text">
                        De Woonstee luistert graag naar uw woonwensen om zo uw droominterieur te realiseren.
                        We verwelkomen u graag in onze showroom!
                    </div>
                    <div class="block-hero-banner-buttons mt-4">
                        <button class="btn btn-outline-dark">Vrijblijvend advies aanvragen</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-0 order-lg-1 mb-4 mb-lg-0" data-aos="fade-left">
                <?php get_template_part('global-templates/image', null, ['image_ID' => 844]); ?>
            </div>
        </div>
    </div>
</div>

<!-- <div class="block block-hero-image block-wrapper overflow-hidden <?php echo $fullwidth; ?> <?php echo $fullheigth; ?>" <?php echo $heigth; ?>>
    <?php echo $image; ?>

    <?php if( $block['use_text'] && $text ) : ?>
        <div class="block-hero-image-text" style="justify-content: <?php echo $block['vertical_alignment']; ?>">
            <div class="container" style="align-items: <?php echo $block['horizontal_alignment']; ?>">
                <?php echo $text; ?>
                <?php if( $block['use_button'] ) : ?>
                    <?php get_template_part('templates/blocks/templates/button', null, $block['button_template']['button']); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div> -->