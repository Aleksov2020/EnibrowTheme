<?php
// Получаем все записи пост-тайпа "promotion"
$args = array(
    'post_type'      => 'promotion',
    'posts_per_page' => -1, 
    'order'          => 'DESC',
);
$promotions_query = new WP_Query($args);

if ($promotions_query->have_posts()) :
?>
<div class="sale-archive-page wrapper col">
    <?php while ($promotions_query->have_posts()) : $promotions_query->the_post(); ?>
        <?php
        $promotion_name = get_field('promotion_name', get_the_ID());
        $promotion_description = get_field('promotion_description', get_the_ID());
        $promotion_discount = get_field('promotion_discount', get_the_ID());
        $promotion_image = get_field('promotion_image', get_the_ID());
        $link = get_permalink(get_the_ID());
        ?>
        
        <div class="discont discont-sale-archive-item row">
            <div class="discont-text-wrapper col">
                <div class="discont-title">
                    <h2><?php echo esc_html($promotion_name); ?></h2>
                </div>
                <div class="discont-subtitle text-16-300">
                    <?php echo esc_html($promotion_description); ?>
                </div>
                <div class="discont-value">
                    скидка <?php echo esc_html($promotion_discount); ?> рублей
                </div>
            </div>

            <div class="discont-slider row">
                <div class="discont-filter row">
                    <div class="discont-slide col" style="background-image: url('<?php echo esc_url($promotion_image['url']); ?>');">
                        <a href="<?= esc_url($link) ?>" class="button button-primary-hover">
                            Подробнее об акции
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/iconQuestionPrimary.svg" alt="question" width="15" height="15">
                        </a>
                    </div>
                </div>

            </div>
        </div>

    <?php endwhile; ?>
</div>
<?php
else :
    echo '<p>Акции не найдены.</p>';
endif;
wp_reset_postdata();
?>
