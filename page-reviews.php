<?php
/*
Template Name: Reviews Page
*/

get_header(); 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'reviews', // Замените на ваш кастомный PostType
    'posts_per_page' => 3, // Ограничиваем количество отзывов на странице
    'paged' => $paged,
);

$query = new WP_Query($args);
?>
<div class="main-wrapper page-review-archive-wrapper col">
    <div class="review-page page wrapper col">
        <div class="page-title-wrapper col">
            <div class="breadcrumbs row">
                <div class="breabcrumbs-page-name light-text-300">
                    Главная
                </div>
                <div class="breabcrumbs-separator"></div>
                <div class="breabcrumbs-page-name light-text-300 active">
                    Отзывы
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
        </div>
        <!-- Кастомная пагинация -->
        <div class="review-page-pagination pagination-wrapper row">
            <?php
            // Общее количество страниц
            $total_pages = $query->max_num_pages;
            error_log($total_pages);
            // Текущая страница
            $current_page = max(1, get_query_var('paged'));
            
            // Ссылка на предыдущую страницу
            if ($current_page > 1) {
                echo '<a class="pagination-arrow" href="' . get_pagenum_link($current_page - 1) . '">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>';
            }

            // Ссылки на страницы
            echo '<div class="pagination-numbers row">';

            // Всегда показываем первую страницу
            if ($current_page > 3) {
                echo '<a class="pagination-slide-number text-16-300" href="' . get_pagenum_link(1) . '">1</a>';
                if ($current_page > 4) {
                    echo '<div class="pagination-shortcut text-16-300 colored-text">...</div>';
                }
            }

            // Показываем страницы вокруг текущей
            for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
                if ($i == $current_page) {
                    echo '<div class="pagination-slide-number text-16-300 active">' . $i . '</div>';
                } else {
                    echo '<a class="pagination-slide-number text-16-300" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                }
            }

            // Всегда показываем последнюю страницу
            if ($current_page < $total_pages - 2) {
                if ($current_page < $total_pages - 3) {
                    echo '<div class="pagination-shortcut text-16-300 colored-text">...</div>';
                }
                echo '<a class="pagination-slide-number text-16-300" href="' . get_pagenum_link($total_pages) . '">' . $total_pages . '</a>';
            }

            echo '</div>';

            // Ссылка на следующую страницу
            if ($current_page < $total_pages) {
                echo '<a class="pagination-arrow" href="' . get_pagenum_link($current_page + 1) . '">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>';
            }
            ?>
    </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Отзывов пока нет.</p> </div>
    <?php endif; ?>



    

    <?php
        the_content();
    ?>


<?php get_footer(); ?>