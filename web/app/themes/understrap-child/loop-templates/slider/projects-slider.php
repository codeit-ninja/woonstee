<?php
/**
 * Projects sliders template
 */
$wp_post = new WP_Query( array('post_type' => 'project') );
?>

<?php if ( $wp_post->have_posts() ) : ?>
    <h3 class="mb-5 mx-5 px-5">Inspiratie</h3>
    <div class="slider project-slider">
        <?php while ( $wp_post->have_posts() ) : $wp_post->the_post(); ?>
            <div class="slider-item">
                <?php the_post_thumbnail(); ?>
                <a href="<?php the_permalink(); ?>" class="slider-title">
                    <?php the_title(); ?>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="slider-controls">
        <button class="slider-prev">
            <i class="fa-thin fa-angle-left"></i>
        </button>
        <button class="slider-next">
            <i class="fa-thin fa-angle-right"></i>
        </button>
    </div>
<?php endif; ?>