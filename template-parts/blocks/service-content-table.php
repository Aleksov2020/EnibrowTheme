<?php if( have_rows('content_table') ): ?>
    <div class="service-content row wrapper">
        <?php while( have_rows('content_table') ): the_row(); ?>
            <div class="service-content-separator"></div>
            <div class="service-content-item">
                <?php the_sub_field('content_item'); ?>
            </div>
        <?php endwhile; ?>
        <div class="service-content-separator"></div>
    </div>
<?php endif; ?>
