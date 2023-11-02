<?php
/**
 * Teammember loop template
 */
$slug = sanitize_title($args['name']);
$tpl_args = array(
    'id'        => $slug,
    'employee'  => $args
);

add_action('insert_before_body_end', fn() => get_template_part('templates/offcanvas/offcanvas', 'employee', $tpl_args));
?>

<div class="col-md-6 col-lg-4 col-xl-3 member pe-auto" data-offcanvas-open="#<?php echo $slug; ?>" role="button">
    <div class="member-image">
        <?php get_template_part("global-templates/image", null, ['image_ID' => $args['image']]); ?>
    </div>
    <div class="member-body">
        <?php 
        printf(
            '<span class="d-block member-name">%s</span>',
            esc_html($args['name'])
        );
        ?>
        <?php 
        printf(
            '<span class="text-muted member-role">%s</span>',
            $args['role']
        );
        ?>
    </div>
</div>