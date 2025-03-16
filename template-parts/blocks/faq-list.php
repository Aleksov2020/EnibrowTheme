<?php
$items_per_page = get_field('faq_items_per_page') ?: 5;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'post_type'      => 'faq',
    'posts_per_page' => $items_per_page,
    'paged'          => $paged,
);

$query = new WP_Query($args);
?>

<div class="faq-page-wrapper wrapper row">
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <div class="faq-page-item-wrapper col">
                <div class="faq-page-item-title">
                    <?php the_title(); ?>
                </div>
                <div class="faq-page-item-buttons-wrapper row">
                    <div class="faq-item-button-wrapper row">
                        <div class="faq-item-button-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/liIcon.svg" alt="li-icon" width="8" height="14">
                        </div>
                        <div class="faq-item-button-label text-16-500 colored-text">
                            <a href="<?php the_permalink(); ?>">Читать ответ</a>
                        </div>
                    </div>
                    <div class="faq-item-views-wrapper row">
                        <div class="faq-item-button-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/iconViews.svg" alt="views-icon" width="19" height="15">
                        </div>
                        <div class="faq-item-button-label text-16-500">
                            <?php echo get_post_meta(get_the_ID(), 'faq_views', true) ?: 0; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <p>Нет вопросов.</p>
    <?php endif; ?>
</div>

<div class="faq-page-pagination pagination-wrapper row">
    <?php
    echo paginate_links(array(
        'total' => $query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none"><path d="M7 1L1 7L7 13" stroke="#825E69" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none"><path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'type' => 'list'
    ));
    ?>
</div>
