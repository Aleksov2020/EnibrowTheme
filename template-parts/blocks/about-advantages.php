<?php
/**
 * ACF Block: Преимущества студии
 */
?>

<div class="about-page-advantages-wrapper wrapper row">
    <?php if (have_rows('advantages_repeater')): ?>
        <?php while (have_rows('advantages_repeater')): the_row(); ?>
            <div class="about-page-advantage col">
                <div class="about-page-advantage-title-wrapper row">
                    <div class="about-page-advantage-icon icon">
                        <img src="<?php the_sub_field('advantage_icon'); ?>" width="36" height="31" alt="advantage-icon">
                    </div>
                    <div class="about-page-advantage-title colored-text text-20-500">
                        <?php the_sub_field('advantage_title'); ?>
                    </div>
                </div>
                <div class="about-page-advantage-text light-text-300">
                    <?php the_sub_field('advantage_text'); ?>
                </div>
                <?php 
                $button_text = get_sub_field('advantage_button');
                $button_link = get_sub_field('advantage_button_link');
                if ($button_text && $button_link): ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="about-page-advantage-button-more colored-text light-text-300">
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Добавьте преимущества в ACF.</p>
    <?php endif; ?>
</div>
