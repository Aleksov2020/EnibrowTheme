<div class="blog-page-category-wrapper row">
    <div class="blog-page-category-label text-16-300">
        Темы :
    </div>
    <div class="blog-page-category-items-wrapper row">
        <?php if (have_rows('faq_links')) : ?>
            <?php while (have_rows('faq_links')) : the_row(); ?>
                <?php
                $faq_name = get_sub_field('faq_name');
                $faq_url = get_sub_field('faq_url');
                $faq_active = get_sub_field('faq_active');
                ?>
                <div class="blog-page-category-item text-16-300 <?php echo $faq_active ? 'selected' : ''; ?>">
                    <a href="<?php echo esc_url($faq_url); ?>">
                        <?php echo esc_html($faq_name); ?>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

