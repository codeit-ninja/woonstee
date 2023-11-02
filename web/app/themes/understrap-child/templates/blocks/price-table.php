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

            <div class="card text-center col-lg-4" data-aos="fade-down" data-aos-delay="<?php echo $key * 100; ?>" data-aos-offset="300">
                <div class="card-header">
                    <h4 class="card-title"><?php echo esc_html( $price_table['title'] ) ?></h4>
                    <span class="block-price-table-price"><?php echo esc_html( $price_table['price'] ) ?></span>
                    <span class="block-price-table-quantity"><?php echo esc_html( $price_table['quantity'] ) ?></span>
                </div>
                <div class="card-body">
                    <p><?php echo $price_table['description'] ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo $price_table['extra_notes'] ?></small>

                    <div class="mt-5">
                        <?php get_template_part('templates/blocks/templates/button', null, $price_table['button']); ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    
</div>