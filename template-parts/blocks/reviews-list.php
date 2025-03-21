<?php
if (!defined('ABSPATH')) exit; // Защита от прямого доступа

// Получаем ID текущего поста (мастера)
$master_id = get_the_ID();

$args = array(
    'post_type'      => 'reviews',
    'posts_per_page' => -1, // Вывести все отзывы
    'meta_query'     => array(
        array(
            'key'     => 'review_master', // Поле ACF
            'value'   => $master_id, // ID текущего мастера
            'compare' => '='
        ),
    ),
);

$query = new WP_Query($args);
?>

<div class="reviews-page-wrapper wrapper col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Отзывы о мастере</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

    <?php if ($query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $review_name = get_field('review_name', get_the_ID());
            $review_date = get_field('review_date', get_the_ID());
            $review_rating = get_field('review_rating', get_the_ID());
            $review_comment = get_field('review_comment', get_the_ID());
            $review_images = get_field('review_images', get_the_ID());
            ?>
            <div class="review-page-item row">
                <div class="review-page-item-header col">
                    <div class="review-page-item-name text-18-500">
                        <?php echo esc_html($review_name); ?>
                    </div>
                    <div class="review-page-item-date text-12-500">
                        <?php echo esc_html($review_date); ?>
                    </div>
                    <div class="review-page-item-badge-wrapper col">
                        <div class="review-page-item-badge blue-badge light-text-400">
                            Телефон подтвержден
                        </div>
                        <div class="review-page-item-badge green-badge light-text-400">
                            Отзыв проверен модератером
                        </div>
                    </div>
                </div>
                <div class="review-page-item-body col">
                    <div class="review-page-item-body-rate-wrapper row">
                        <div class="review-page-item-body-rate-title text-16-500">
                            Оценка:
                        </div>
                        <div class="review-page-item-body-rate-stars-wrapper row">
                            <?php for ($i = 0; $i < $review_rating; $i++) : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/whiteStar.svg'" alt="star" width="14" height="14">
                            <?php endfor; ?>
                            <div class="review-page-item-body-rate-stars-label">
                                <?php echo esc_html($review_rating); ?>/5
                            </div>
                        </div>
                    </div>
                    <div class="review-page-item-body-text light-text-400">
                        <?php echo esc_html($review_comment); ?>
                    </div>
                    <?php if ($review_images) : ?>
                        <div class="review-page-item-body-gallery-wrapper row">
                            <?php foreach ($review_images as $image) : ?>
                                <div class="review-card-gallery-item">
                                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="review-image" width="66" height="66">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Отзывов пока нет.</p>
    <?php endif; ?>

</div>
