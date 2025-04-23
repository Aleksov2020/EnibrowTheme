<?
add_action('wp_ajax_filter_portfolio', 'filter_portfolio');
add_action('wp_ajax_nopriv_filter_portfolio', 'filter_portfolio');

function filter_portfolio() {
    $selected_category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;

    $gallery_data = [];
    $html = '';
    $total = 0;

    if ($selected_category !== 'all') {
        // Получаем работы услуги
        $service = get_post($selected_category);
        if (!$service) {
            wp_send_json([
                'html' => '<p>Категория не найдена.</p>',
                'galleryData' => [],
                'has_more' => false,
            ]);
        }

        $portfolio_works_all = get_field('service_portfolio_works', $service->ID);
        if (!$portfolio_works_all || !is_array($portfolio_works_all)) {
            wp_send_json([
                'html' => '<p>Нет работ в этой категории.</p>',
                'galleryData' => [],
                'has_more' => false,
            ]);
        }

        $filtered_works = array_filter($portfolio_works_all, function ($work_id) {
            return get_field('portfolio_main', $work_id);
        });

        $total = count($filtered_works);
        $portfolio_works = array_slice($filtered_works, $offset, $limit);

    } else {
        // Все работы с флагом portfolio_main
        $query_args = array(
            'post_type'      => 'portfolio_work',
            'posts_per_page' => $limit,
            'offset'         => $offset,
            'meta_query'     => array(
                array(
                    'key'     => 'portfolio_main',
                    'value'   => '1',
                    'compare' => '='
                )
            )
        );
        $portfolio_works = get_posts($query_args);

        // Для подсчёта total
        $all_ids = get_posts(array(
            'post_type'      => 'portfolio_work',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => array(
                array(
                    'key'     => 'portfolio_main',
                    'value'   => '1',
                    'compare' => '='
                )
            )
        ));
        $total = count($all_ids);
    }

    // Генерация HTML и JS-данных
    ob_start();

    foreach ($portfolio_works as $index => $work) {
        $work_id = is_object($work) ? $work->ID : $work;

        $master_id = get_field('portfolio_master', $work_id);
        $master_name = get_field('master_name', $master_id);
        $master_photo = get_field('master_photo', $master_id);
        $portfolio_likes = get_field('portfolio_likes', $work_id);
        $master_rank = get_field('master_rank', $master_id);
        $image = get_field('portfolio_image', $work_id);

        $gallery_data[] = [
            'id'     => $work_id,
            'imageUrl'     => esc_url($image['url']),
            'masterName'   => esc_html($master_name),
            'masterRank'   => esc_html($master_rank),
            'masterLikes'  => esc_html($portfolio_likes),
            'masterAvatar' => esc_url($master_photo['url']),
            'masterLink'   => esc_url(get_permalink($master_id)),
        ];
        ?>

        <div class="gallery-item">
            <div class="gallery-photo" onclick="openGallery(<?= $offset + $index; ?>, 'sliderGallery');">
                <?php if ($image): ?>
                    <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr(get_the_title($work_id)); ?>" width="276" height="276">
                <?php endif; ?>
            </div>
            <div class="gallery-text col">
                <div class="gallery-master-card row">
                    <div class="gallery-master-card-left-wrapper row">
                        <div class="gallery-master-photo clickable">
                            <?php if ($master_photo): ?>
                                <img src="<?= esc_url($master_photo['url']); ?>" width="51" height="51" alt="<?= esc_attr($master_name); ?>"/>
                            <?php endif; ?>
                        </div>
                        <div class="gallery-master-info-wrapper col">
                            <a href="<?= get_permalink($master_id)?>" class="gallery-master-badge-wrapper row clickable">
                                <?php if ($master_rank): ?>
                                    <div class="gallery-master-badge light-text-500 clickable">
                                        <?= esc_html($master_rank); ?>&nbsp;
                                    </div>
                                <?php endif; ?>
                            </a>
                            <a href="<?= get_permalink($master_id)?>" class="gallery-master-name text-16-500 colored-text clickable">
                                <?= esc_html($master_name); ?>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-master-cards-likes-wrapper col" data-id="<?= $work_id ?>" onclick="handleLike(this);">
                        <div class="gallery-master-cards-likes-photo row clickable like-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                                <path d="M9.14945 3.42589L10 4.80155L10.8506 3.42589C11.5789 2.24796 12.858 1.5 14.3182 1.5C16.5889 1.5 18.5 3.42492 18.5 5.83333C18.5 6.87433 18.0316 8.0043 17.2012 9.16973C16.3776 10.3257 15.2585 11.4311 14.1059 12.4018C12.9578 13.3685 11.805 14.178 10.9365 14.7468C10.5626 14.9916 10.2432 15.1908 10.0019 15.3375C9.76029 15.1896 9.44036 14.9888 9.06581 14.742C8.19701 14.1696 7.04368 13.3558 5.89518 12.386C4.742 11.4122 3.62241 10.305 2.79834 9.15033C1.96702 7.98551 1.5 6.86161 1.5 5.83333C1.5 3.42492 3.41107 1.5 5.68182 1.5C7.14196 1.5 8.42115 2.24796 9.14945 3.42589Z" stroke="#C0C0C0" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="gallery-master-cards-likes-counter">
                            <?= esc_html($portfolio_likes); ?>
                        </div>
                    </div>
                </div>
                <div class="buttons-wrapper col">
                    <div class="button button-primary text-16-500">
                        Записаться
                    </div>
                    <a href="<?= get_permalink($master_id)?>" class="button-label">
                        Подробнее о мастере
                    </a>
                </div>
            </div>
        </div>

        <?php
    }

    $html = ob_get_clean();

    wp_send_json([
        'html'        => $html,
        'galleryData' => $gallery_data,
        'has_more'    => ($offset + $limit) < $total,
    ]);
}
