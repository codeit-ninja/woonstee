<?php
/**
 * Text with image content block renderer
 */
$index = $args['index'];
$block = $args['block'];
?>

<div class="container">

    <div class="block block-price-table row g-0">
        <?php foreach ($block['price_table'] as $key => $price_table ) : ?>

            <div class="card text-center col-lg-4">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $price_table['title'] ?></h5>
                    <span class="block-price-table-price"><?php echo $price_table['price'] ?></span>
                    <span class="block-price-table-quantity"><?php echo $price_table['quantity'] ?></span>
                </div>
                <div class="card-body">
                    <p><?php echo $price_table['description'] ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo $price_table['extra_notes'] ?></small>

                    <?php if( $price_table['use_button'] ) : ?>
                        <div class="mt-5">
                            <?php if( $price_table['use_form'] ) : ?>
                                <button class="btn btn-dark" data-offcanvas-open="#<?php echo 'offcanvas-form-' . $key; ?>"><?php echo $price_table['button_text'] ?></button>
                            <?php else : ?>
                                <a role="button" class="btn btn-dark" href="<?php echo $price_table['button_link'] ?>"><?php echo $price_table['button_text'] ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php 
            if( $price_table['use_form'] ) {
                add_action('insert_before_body_end', function () use ($price_table, $key) {
                    get_template_part('templates/offcanvas/form', null, array(
                        'id'        => 'offcanvas-form-' . $key,
                        'shortcode' => $price_table['form_shortcode']
                    ));
                });
            }
            ?>

        <?php endforeach; ?>
    </div>
    
</div>