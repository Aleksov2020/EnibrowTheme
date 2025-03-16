<?php
/**
 * ACF Block: О студии
 */
?>

<div class="about-page-text-wrapper wrapper row">
    <?php if (have_rows('about_repeater')): ?>
        <?php while (have_rows('about_repeater')): the_row(); ?>
            <div class="about-page-text-item col">
                <div class="about-page-text-item-title text-20-500 colored-text">
                    <?php the_sub_field('about_title'); ?>
                </div>
                <div class="about-page-text-item-description text-16-300">
                    <?php the_sub_field('about_description'); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p></p>
    <?php endif; ?>
</div>
