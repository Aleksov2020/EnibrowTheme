<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$videos_per_page = 6; // Количество видео на страницу
$current_page_id = get_queried_object_id();
// Проверяем, является ли текущая страница родительской
$parent_page_id = wp_get_post_parent_id($current_page_id);

// Если это родительская страница "Видео" или главная страница видео, то загружаем все
$meta_query = array();
if (is_page('videos')) { 
    // Выводим все видео
    $meta_query = array();
    error_log('All');
} else {
    error_log('Only 1');
    // Фильтруем только по выбранной странице
    $meta_query = array(
        array(
            'key'     => 'video_page',
            'value'   => $current_page_id,
            'compare' => '='
        )
    );
}

// Запрос видео
$videos = new WP_Query(array(
    'post_type'      => 'video',
    'posts_per_page' => $videos_per_page,
    'paged'          => $paged,
    'meta_query'     => $meta_query
));


if ($videos->have_posts()): ?>
    <div class="videos-page wrapper col">
        <div class="video-wrapper row">
            <?php while ($videos->have_posts()): $videos->the_post();
                $video_url      = get_field('video_url', get_the_ID());
                $video_thumb    = get_field('video_thumbnail', get_the_ID());
                ?>
                <div class="video-item row" style="background-image: url(<?php echo esc_url($video_thumb['url']); ?>);">
                    <a href="<?php echo esc_url($video_url); ?>" class="video-filter" target="_blank">
                        <div class="video-button row">
                            <svg width="30" height="33" viewBox="0 0 30 33" fill="none">
                                <path d="M26.5347 12.1699C29.868 14.0944 29.868 18.9056 26.5347 20.8301L7.78466 31.6554C4.45133 33.5799 0.284666 31.1743 0.284667 27.3253V5.67467C0.284668 1.82567 4.45133 -0.579946 7.78467 1.34455L26.5347 12.1699Z" fill="white"/>
                            </svg>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Пагинация -->
        <div class="faq-page-pagination pagination-wrapper row">
            <?php
            $big = 999999999;
            $paginate_links = paginate_links(array(
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'total'     => $videos->max_num_pages,
                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14"><path d="M7 1L1 7L7 13" stroke="#825E69" stroke-opacity="0.2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14"><path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                'type'      => 'array',
            ));

            if ($paginate_links): ?>
                <div class="pagination-arrow">
                    <?php echo $paginate_links[0]; ?>
                </div>
                <div class="pagination-numbers row">
                    <?php
                    foreach ($paginate_links as $key => $link) {
                        if ($key !== 0 && $key !== count($paginate_links) - 1) {
                            echo '<div class="pagination-slide-number text-16-300">' . $link . '</div>';
                        }
                    }
                    ?>
                </div>
                <div class="pagination-arrow">
                    <?php echo end($paginate_links); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php wp_reset_postdata();
endif;
?>
