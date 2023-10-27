<?php
/**
 * Call to action block template
 */
$block = $args['block'];

$background_color = isset( $block['background_color'] ) ? $block['background_color'] : 'transparent';
$text_color = isset( $block['text_color'] ) ? $block['text_color'] : '#000000';
?>

<div class="container">
    <div class="block block-cta p-5" style="background-color: <?php echo $background_color; ?>;color: <?php echo $text_color; ?>;">
        <div class="row align-items-center gx-5">
            <div class="col-lg-6 col-xl-7">
                <div class="block-cta-body">
                    <?php
                    printf(
                        '%s',
                        $block['text']
                    );
                    ?>
                </div>
            </div>
            <div class="col-lg-6 col-xl-5">
                <?php 
                if( isset( $block['buttons_template'] ) && $block['buttons_template'] ) {
                    get_template_part('templates/blocks/templates/buttons', null, $block['buttons_template']);
                }
                ?>
            </div>
        </div>
    </div>
</div>