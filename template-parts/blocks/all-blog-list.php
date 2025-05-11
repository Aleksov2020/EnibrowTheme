<?php
// Получаем текущую страницу
$current_page_id = get_queried_object_id();

// Проверяем, находимся ли мы на главной странице блога
$is_blog_main = is_page('blog-page');

// Формируем аргументы запроса
$args = array(
    'post_type'      => 'blog',
    'posts_per_page' => 6, // Количество записей на странице
    'order'          => 'DESC',
);

// Если это не главная страница блога, фильтруем записи по категории (по ID страницы)
if (!$is_blog_main) {
    $args['meta_query'] = array(
        array(
            'key'     => 'blog_category_page', // Поле ACF, где указывается страница категории
            'value'   => $current_page_id,
            'compare' => '='
        ),
    );
}

$blog_query = new WP_Query($args);

if ($blog_query->have_posts()) :
?>
<div class="blog-page-blogs col">
    <div class="blog wrapper wrapper-laptop col">
        <div class="blog-wrapper row">
            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <?php
                $blog_image = get_field('blog_image', get_the_ID());
                $blog_views = get_field('blog_views', get_the_ID()) ?: 0;
                $blog_read_time = get_field('blog_read_time', get_the_ID()) ?: 5;
                $blog_date = get_the_date('d.m.Y');
                ?>

                <div class="blog-item col">
                    <a href="<?php the_permalink(); ?>" class="blog-item-photo col" style="background-image: url('<?php echo esc_url($blog_image['url']); ?>');">
                        <div class="blog-item-counters-wrapper text-16-300 row">
                            <div class="blog-item-counter-wrapper row">
                                <div class="blog-item-counter-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/iconViewsCount.svg" width="20" height="15" alt="views">
                                </div>
                                <div class="blog-item-counter-value">
                                    <?php echo esc_html($blog_views); ?>
                                </div>
                            </div>
                            <div class="blog-item-date-wrapper row">
                                <div class="blog-item-date-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/iconCalendar.svg" width="16" height="16" alt="calendar">
                                </div>
                                <div class="blog-item-date-value">
                                    <?php echo esc_html($blog_date); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="blog-item-text-wrapper col">
                        <a href="<?php the_permalink(); ?>" class="blog-item-title colored-text">
                            <?php the_title(); ?>
                        </a>
                        <div class="blog-item-buttons-wrapper col">
                            <div class="blog-item-time-read-wrapper row">
                                <<a href="<?php the_permalink(); ?>"  class="blog-item-time-read-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/clockIcon.svg" width="17" height="17" alt="clock"> 
                                </a>
                                <div class="blog-item-time-read-value light-text">
                                    Время чтения <?php echo esc_html($blog_read_time); ?> минут
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="button button-bordered">
                                Читать статью
                            </a>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>

        <!-- Пагинация -->
        <div class="blog-page-pagination pagination-wrapper row">
            <?php
            echo paginate_links(array(
                'total'   => $blog_query->max_num_pages,
                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                    <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>',
                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                                    <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>',
            ));
            ?>
        </div>
    </div>
</div>

<?php
endif;
wp_reset_postdata();
?>
