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

// Подготовка скрипта с данными для JS
$reviews_gallery_data = [];

$query = new WP_Query($args);

ob_start();
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
                    <?php while ($query->have_posts()) : $query->the_post();
                        $review_id = get_the_ID();
                        $review_name = get_field('review_name', $review_id);
                        $review_date = get_field('review_date', $review_id);
                        $review_rating = get_field('review_rating', $review_id);
                        $review_comment = get_field('review_comment', $review_id);
                        $review_images = get_field('review_images', $review_id);
                        $gallery_id = 'reviewGallery_' . $review_id;

                        $review_master_id = get_field('review_master', $review_id);
   
                        $master_name = get_field('master_name', $review_master_id);
                        $master_surname = get_field('master_surname', $review_master_id);
                        $master_rank = get_field('master_rank', $review_master_id);
                        $master_photo = get_field('master_photo', $review_master_id);
                        $master_link = get_permalink($review_master_id);

                        $master_avatar = $master_photo ? esc_url($master_photo['url']) : '';

                        $portfolio_ids = get_field('review_images', $review_id); // теперь это массив ID portfolio_work
                        $gallery_id = 'reviewGallery_' . $review_id;
                        $reviews_gallery_data[$gallery_id] = [];
                        
                        if ($portfolio_ids) {
                            foreach ($portfolio_ids as $index => $portfolio_id) {
                                $image = get_field('portfolio_image', $portfolio_id);
                                $likes = get_field('portfolio_likes', $portfolio_id);
                        
                                $master_id = get_field('portfolio_master', $portfolio_id);
                                $master_name = $master_id ? get_field('master_name', $master_id) : '';
                                $master_surname = $master_id ? get_field('master_surname', $master_id) : '';
                                $master_rank = $master_id ? get_field('master_rank', $master_id) : 'Мастер';
                                $master_photo = $master_id ? get_field('master_photo', $master_id) : null;
                                $master_link = $master_id ? get_permalink($master_id) : '#';
                                $master_avatar = $master_photo ? esc_url($master_photo['url']) : '';
                        
                                $reviews_gallery_data[$gallery_id][] = [
                                    'id'           => $portfolio_id,
                                    'imageUrl'     => esc_url($image['url']),
                                    'masterName'   => esc_html(trim($master_name . ' ' . $master_surname)),
                                    'masterRank'   => esc_html($master_rank),
                                    'masterLikes'  => esc_html($likes),
                                    'masterAvatar' => $master_avatar,
                                    'masterLink'   => esc_url($master_link),
                                ];
                            }
                        }
                        
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
                                    <?php foreach ($portfolio_ids as $index => $portfolio_id) : ?>
                                        <?php $img = get_field('portfolio_image', $portfolio_id); ?>
                                        <?php if ($img) : ?>
                                            <div class="review-card-gallery-item" onclick="openGallery(<?= $index ?>, '<?= $gallery_id ?>')">
                                                <img src="<?= esc_url($img['sizes']['thumbnail']); ?>" alt="review-image" width="66" height="66">
                                            </div>
                                        <?php endif; ?>
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
        <a href="/reviews-page/" class="button button-primary">
            Больше отзывов
        </a>
        <div class="reviews-button prev-button clickable">
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
</div>
<?php
$block_html = ob_get_clean();
echo $block_html;

// Вставляем данные для галерей JS
echo '<script>window.galleryDataMap = window.galleryDataMap || {};';
foreach ($reviews_gallery_data as $galleryId => $images) {
    echo 'window.galleryDataMap["' . $galleryId . '"] = ' . json_encode($images) . ';';
}
echo '</script>';
?>