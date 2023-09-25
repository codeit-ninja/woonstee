<?php
/**
 * Carousel template part
 */
?>
<div id="bs-carousel" class="carousel slide">
    <div class="carousel-inner">
    <?php foreach ($args as $key => $image): ?>
            <div class="carousel-item <?php if( $key === 0 ) echo 'active'; ?>">
                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="carousel-controls">
        <button class="carousel-controls-prev" type="button" data-bs-target="#bs-carousel" data-bs-slide="prev">
            <i class="fa-thin fa-angle-left" aria-hidden="true"></i>
            <span class="visually-hidden">Previous</span>
        </button>
        <div class="carousel-count">
            <span class="carousel-count-current">1</span>
            /
            <span class="carousel-count-total"><?php echo count( $args ); ?></span>
        </div>
        <button class="carousel-controls-next" type="button" data-bs-target="#bs-carousel" data-bs-slide="next">
        <i class="fa-thin fa-angle-right" aria-hidden="true"></i>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- <div class="b-carousel-wrapper">
    <div class="b-carousel">
        <?php foreach ($args as $image): ?>
            <div class="b-carousel-item">
                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="b-carousel-controls">
        <button class="b-carousel-prev">
            <i class="fa-thin fa-angle-left"></i>
        </button>
        <button class="b-carousel-next">
            <i class="fa-thin fa-angle-right"></i>
        </button>
    </div>
</div> -->