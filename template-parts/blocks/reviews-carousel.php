<?php
if (!defined('ABSPATH')) exit; // Защита от прямого доступа

// Получаем отзывы с флагом `review_global`
$args = array(
    'post_type'      => 'reviews',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'review_global',
            'value'   => '1',
            'compare' => '='
        ),
    ),
);

$query = new WP_Query($args);
?>

<div class="reviews wrapper wrapper-laptop col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Реальные отзывы</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

    <div class="reviews-subtitle text-16-300">
        Этот вид процедуры выбирает большинство посетительниц салонов красоты.
        Его особенностью является детальная прорисовка – мастер рисует каждый отдельный волосок, что придает естественный вид бровям.
        Делают волосковый татуаж в 2-х техниках:
    </div>

    <div class="reviews-wrapper wrapper row">
        <div class="slider-reviews-wrapper row">
            <div class="slider-track-reviews row">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php
                        $review_name = get_field('review_name', get_the_ID());
                        $review_date = get_field('review_date', get_the_ID());
                        $review_rating = get_field('review_rating', get_the_ID());
                        $review_comment = get_field('review_comment', get_the_ID());
                        $review_images = get_field('review_images', get_the_ID());
                        ?>
                        <div class="review-card col">
                            <div class="review-card-text-wrapper col">
                                <div class="review-card-title-wrapper row">
                                    <div class="review-card-author-wrapper col">
                                        <div class="review-card-author-name text-16-700">
                                            <?php echo esc_html($review_name); ?>
                                        </div>
                                        <div class="review-card-rate-wrapper row">
                                            <div class="review-card-rate-stars row">
                                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo $i < $review_rating ? 'whiteStar.svg' : 'greyStar.svg'; ?>" alt="star" width="14" height="14">
                                                <?php endfor; ?>
                                            </div>
                                            <div class="review-card-rate-value">
                                                <?php echo esc_html($review_rating); ?>/5
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-card-date">
                                        <?php echo esc_html($review_date); ?>
                                    </div>
                                </div>
                                <div class="review-card-comment-wrapper col">
                                    <div class="review-card-comment-title light-text-700">
                                        Комментарий:
                                    </div>
                                    <div class="review-card-comment-value light-text">
                                        <?php echo esc_html($review_comment); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="review-card-footer-wrapper col">
                                <?php if ($review_images) : ?>
                                    <div class="review-card-gallery-wrapper row">
                                        <?php foreach ($review_images as $image) : ?>
                                            <div class="review-card-gallery-item">
                                                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="review-image" width="66" height="66">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="review-card-badge-wrapper row">
                                    <div class="review-card-badge green-badge">
                                        Отзыв проверен модератором
                                    </div>
                                    <div class="review-card-badge blue-badge">
                                        Телефон подтвержден
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>Пока нет отзывов.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="reviews-button-wrapper row">
        <div class="reviews-button next-button clickable">
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="button button-primary">
            Больше отзывов
        </div>
        <div class="reviews-button prev-button clickable">
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
</div>
