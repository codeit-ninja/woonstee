<?php
/**
 * Call to action block template
 */
$block = $args['block'];

$background_color = isset( $block['background_color'] ) ? $block['background_color'] : 'transparent';
$text_color = isset( $block['text_color'] ) ? $block['text_color'] : '#000000';

$col_1 = 'col-lg-6 col-xl-7';
$col_2 = 'col-lg-6 col-xl-5';

if( ! $block['buttons_template']['buttons'] ) {
    $col_1 = 'col-12';
}
?>

<div class="container">
    <div class="block block-cta p-5" style="background-color: <?php echo $background_color; ?>;color: <?php echo $text_color; ?>;">
        <div class="row align-items-center gx-5">
            <div class="<?php echo $col_1; ?>">
                <div class="block-cta-body">
                    <?php
                    printf(
                        '%s',
                        $block['text']
                    );
                    ?>
                </div>
            </div>
            <?php if( $block['buttons_template']['buttons'] ) : ?>
                <div class="<?php echo $col_2; ?>">
                    <?php 
                    if( isset( $block['buttons_template'] ) && $block['buttons_template'] ) {
                        get_template_part('templates/blocks/templates/buttons', null, $block['buttons_template']);
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>