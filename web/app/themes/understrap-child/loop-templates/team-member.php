<?php
/**
 * Teammember loop template
 */
?>

<div class="col-md-6 col-lg-4 col-xl-3 member">
    <div class="member-image" data-bs-toggle="popover" data-bs-content="<?php echo $args['about_me']; ?>">
        <?php get_template_part("global-templates/image", null, ['image_ID' => $args['image']]); ?>
    </div>
    <div class="member-body">
        <?php 
        printf(
            '<span class="d-block member-name">%s</span>',
            $args['name']
        );
        ?>
        <?php 
        printf(
            '<span class="text-muted member-role">%s</span>',
            $args['role']
        );
        ?>
    </div>
    <div class="member-about">
        <?php 
        printf(
            '%s',
            $args['about_me']
        );
        ?>
    </div>
</div>