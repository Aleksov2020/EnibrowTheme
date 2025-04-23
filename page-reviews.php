<?php
/*
Template Name: Reviews Page
*/

get_header(); 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'reviews',
    'posts_per_page' => 3,
    'paged' => $paged,
);

$query = new WP_Query($args);
?>

<div class="main-wrapper page-review-archive-wrapper col">
    <div class="review-page page wrapper col">
        <div class="page-title-wrapper col">
            <div class="breadcrumbs row">
                <div class="breabcrumbs-page-name light-text-300">
                    <a href="<?php echo home_url(); ?>">Главная</a>
                </div>
                <div class="breabcrumbs-separator"></div>
                <div class="breabcrumbs-page-name light-text-300 active">
                    <a href="<?php echo get_permalink(get_the_ID()); ?>"> Отзывы </a>
                </div>
            </div>

            <div class="title">
                <div class="review-archive-page-title">
                    Отзывы о студии Enibrow
                </div>
            </div>

            <div class="page-subtitle text-16-300">
                Перманентный татуаж бровей известен с 70-х годов XX века, и за столь долгий срок появилось множество техник данной процедуры. Стоит рассмотреть подробней каждый из видов, чтобы знать больше об их преимуществах, недостатках и особенностях.
            </div>
        </div>
    </div>

    <div class="reviews-page-wrapper wrapper col">
        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php
                $review_id = get_the_ID();
                $review_name = get_field('review_name', $review_id);
                $review_date = get_field('review_date', $review_id);
                $review_rating = get_field('review_rating', $review_id);
                $review_comment = get_field('review_comment', $review_id);
                $review_images = get_field('review_images', $review_id);
                $gallery_id = 'reviewGallery_' . $review_id;
                ?>
                <div class="review-page-item row">
                    <div class="review-page-item-header col">
                        <div class="review-page-item-name text-18-500"><?php echo esc_html($review_name); ?></div>
                        <div class="review-page-item-date text-12-500"><?php echo esc_html($review_date); ?></div>
                        <div class="review-page-item-badge-wrapper col">
                            <div class="review-page-item-badge blue-badge light-text-400">Телефон подтвержден</div>
                            <div class="review-page-item-badge green-badge light-text-400">Отзыв проверен модератором</div>
                        </div>
                    </div>
                    <div class="review-page-item-body col">
                        <div class="review-page-item-body-rate-wrapper row">
                            <div class="review-page-item-body-rate-title text-16-500">Оценка:</div>
                            <div class="review-page-item-body-rate-stars-wrapper row">
                                <?php for ($i = 0; $i < $review_rating; $i++) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/whiteStar.svg" alt="star" width="14" height="14">
                                <?php endfor; ?>
                                <div class="review-page-item-body-rate-stars-label"><?php echo esc_html($review_rating); ?>/5</div>
                            </div>
                        </div>
                        <div class="review-page-item-body-text light-text-400"><?php echo esc_html($review_comment); ?></div>

                        <?php if ($review_images) : ?>
                            <div class="review-page-item-body-gallery-wrapper row">
                                <?php foreach ($review_images as $index => $portfolio_id) :
                                    $img = get_field('portfolio_image', $portfolio_id);
                                    if (!$img) continue;
                                ?>
                                    <div class="review-card-gallery-item" onclick="openGallery(<?= $index ?>, '<?= $gallery_id ?>')">
                                        <img src="<?= esc_url($img['sizes']['thumbnail']); ?>" alt="review-image" width="66" height="66">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Пагинация -->
        <div class="review-page-pagination pagination-wrapper row">
            <?php
            $total_pages = $query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));

            if ($current_page > 1) {
                echo '<a class="pagination-arrow" href="' . get_pagenum_link($current_page - 1) . '"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14"><path d="M7 1L1 7L7 13" stroke="#825E69" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>';
            }

            echo '<div class="pagination-numbers row">';

            if ($current_page > 3) {
                echo '<a class="pagination-slide-number text-16-300" href="' . get_pagenum_link(1) . '">1</a>';
                if ($current_page > 4) {
                    echo '<div class="pagination-shortcut text-16-300 colored-text">...</div>';
                }
            }

            for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
                if ($i == $current_page) {
                    echo '<div class="pagination-slide-number text-16-300 active">' . $i . '</div>';
                } else {
                    echo '<a class="pagination-slide-number text-16-300" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                }
            }

            if ($current_page < $total_pages - 2) {
                if ($current_page < $total_pages - 3) {
                    echo '<div class="pagination-shortcut text-16-300 colored-text">...</div>';
                }
                echo '<a class="pagination-slide-number text-16-300" href="' . get_pagenum_link($total_pages) . '">' . $total_pages . '</a>';
            }

            echo '</div>';

            if ($current_page < $total_pages) {
                echo '<a class="pagination-arrow" href="' . get_pagenum_link($current_page + 1) . '"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14"><path d="M1 13L7 7L1 1" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>';
            }
            ?>
        </div>

        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Отзывов пока нет.</p>
    <?php endif; ?>

    <?php the_content(); ?>
</div>

<?php
// Подготовка данных для JS галереи
echo '<script>window.galleryDataMap = window.galleryDataMap || {};';
$query = new WP_Query($args);
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        $review_id = get_the_ID();
        $portfolio_ids = get_field('review_images', $review_id);
        $gallery_id = 'reviewGallery_' . $review_id;

        $gallery_data = [];
        if ($portfolio_ids) {
            foreach ($portfolio_ids as $portfolio_id) {
                if (get_post_type($portfolio_id) !== 'portfolio_work') continue;

                $image = get_field('portfolio_image', $portfolio_id);
                $likes = get_field('portfolio_likes', $portfolio_id);
                $master_id = get_field('portfolio_master', $portfolio_id);
                $master_name = $master_id ? get_field('master_name', $master_id) : '';
                $master_surname = $master_id ? get_field('master_surname', $master_id) : '';
                $master_rank = $master_id ? get_field('master_rank', $master_id) : 'Мастер';
                $master_photo = $master_id ? get_field('master_photo', $master_id) : null;
                $master_link = $master_id ? get_permalink($master_id) : '#';

                $gallery_data[] = [
                    'id'           => $portfolio_id,
                    'imageUrl'     => esc_url($image['url']),
                    'masterName'   => esc_html(trim($master_name . ' ' . $master_surname)),
                    'masterRank'   => esc_html($master_rank),
                    'masterLikes'  => esc_html($likes),
                    'masterAvatar' => $master_photo ? esc_url($master_photo['url']) : '',
                    'masterLink'   => esc_url($master_link),
                ];
            }
        }

        echo 'window.galleryDataMap["' . $gallery_id . '"] = ' . json_encode($gallery_data) . ';';
    endwhile;
    wp_reset_postdata();
endif;
echo '</script>';
?>

<?php get_footer(); ?>
