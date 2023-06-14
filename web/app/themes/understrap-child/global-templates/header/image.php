<?php
/**
 * Header image logic
 */
$image_ID = get_field('header_background_image');
$image_attributes = wp_get_attachment_image_src( $image_ID, 'full' );
?>

<div class="header-hero" style="background-image: url(<?php echo $image_attributes[0] ?>)">
    <div class="header-hero-content container">
        <div class="row g-5">
            <div class="col-12 text-center text-white">
                <span>droominterieur</span>
                <h2>
                    Verrassend, Inspirerend & Veelzijdig
                </h2>
                <a href="#" role="button" class="btn btn-primary">Vrijblijvend advies aanvragen</a>
            </div>
        </div>
    </div>
</div>