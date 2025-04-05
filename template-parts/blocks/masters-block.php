<?php
// Получаем записи типа "master" с фильтром по чекбоксу "Показывать мастера по всему сайту"
$args = array(
    'post_type'      => 'master',
    'posts_per_page' => 4,
    'meta_query'     => array(
        array(
            'key'   => 'master_show_global',
            'value' => '1',
        ),
    ),
);
$masters_query = new WP_Query($args);
$gallery_map_master = [];

if ($masters_query->have_posts()) :
?>
<div class="masters wrapper wrapper-laptop col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Наши мастера</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>
    <div class="masters-wrapper-slider row" style="width: 100%;">
        <div class="masters-wrapper-track masters-wrapper row">
            <?php while ($masters_query->have_posts()) : $masters_query->the_post();
                $master_id = get_the_ID();
                $master_rank = get_field('master_rank', $master_id);
                $master_experience = get_field('master_experience', $master_id);
                $master_name = get_field('master_name', $master_id);
                $master_surname = get_field('master_surname', $master_id);
                $master_bio = get_field('field_master_short_description', $master_id);
                $master_photo = get_field('master_photo', $master_id);
                $master_likes = get_field('master_likes', $master_id);

                $master_reviews = (int) get_field('master_review_count', $master_id);
                $master_rate = (float) get_field('master_rating', $master_id);

                $portfolio_args = array(
                    'post_type'      => 'portfolio_work',
                    'posts_per_page' => 4,
                    'meta_query'     => array(
                        array(
                            'key'   => 'portfolio_master',
                            'value' => $master_id,
                            'compare' => '='
                        ),
                        array(
                            'key'   => 'portfolio_preview',
                            'value' => '1',
                            'compare' => '='
                        )
                    )
                );
                $portfolio_query = new WP_Query($portfolio_args);
                $gallery_id = 'masterGallery_' . $master_id;
                $gallery_map_master[$gallery_id] = [];
                $portfolio_index = 0;
            ?>
            <div class="master-card row">
                <a href="<?= get_permalink($master_id) ?>" class="master-photo" style="background-image: url(<?= esc_url($master_photo['url']); ?>);"></a>
                <div class="master-info col">
                    <div class="master-info-title-wrapper row">
                        <div class="master-title row">
                            <a href="<?= get_permalink($master_id) ?>" class="master-name colored-text">
                                <?= esc_html($master_name . ' ' . $master_surname); ?>&nbsp;
                            </a>
                            <?php if ($master_rank) : ?>
                                <a href="<?= get_permalink($master_id) ?>" class="master-label">
                                    <?= esc_html($master_rank); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="master-rate-wrapper col">
                            <a href="<?= get_permalink($master_id) ?>" class="master-rate-inner-wrapper row">
                                <div class="master-rate-icon">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/starYellow.svg" width="19" height="19" alt="star">
                                </div>
                                <div class="master-rate-value">
                                    <?= esc_html($master_rate); ?>
                                </div>
                            </a>
                            <a href="<?= get_permalink($master_id) ?>" class="master-rate-reviews colored-text text-12-500">
                                <?= esc_html($master_reviews); ?> отзывов
                            </a>
                        </div>
                    </div>
                    <div class="master-badges-wrapper row">
                        <a href="<?= get_permalink($master_id) ?>" class="master-badge light-text row colored-text">
                            <img src="<?= get_template_directory_uri(); ?>/assets/badge-master.svg"> Квалификация подтверждена
                        </a>
                        <a href="<?= get_permalink($master_id) ?>" class="master-badge light-text row colored-text">
                            Стаж <?= esc_html($master_experience); ?> лет
                        </a>
                    </div>
                    <div class="master-description-wrapper row">
                        <div class="master-detail-wrapper col">
                            <div class="master-detail light-text-300">
                                <?= esc_html($master_bio); ?>
                            </div>
                            <div class="master-gallery-small row">
                                <?php if ($portfolio_query->have_posts()) :
                                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                                        $portfolio_image = get_field('portfolio_image', get_the_ID());
                                        if ($portfolio_image) :
                                            $gallery_map_master[$gallery_id][] = [
                                                'imageUrl'     => esc_url($portfolio_image['url']),
                                                'masterName'   => esc_html($master_name . ' ' . $master_surname),
                                                'masterRank'   => esc_html($master_rank),
                                                'masterLikes'  => esc_html($master_likes),
                                                'masterAvatar' => esc_url($master_photo['url']),
                                                'masterLink'   => esc_url(get_permalink($master_id)),
                                            ];
                                ?>
                                            <div class="gallery-item-small"
                                                 onclick="openGallery(<?= $portfolio_index ?>, '<?= $gallery_id ?>')"
                                                 style="background-image: url(<?= esc_url($portfolio_image['url']); ?>);"></div>
                                <?php
                                            $portfolio_index++;
                                        endif;
                                    endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                                                    <!-- Услуги -->
                                                    <div class="master-services-wrapper col">
                                <div class="master-services-inner-wrapper col">
                                    <div class="master-services-title light-text-600 colored-text">
                                        Цены на процедуры:
                                    </div>

                                    <?php
                                    $master_services = get_field('master_services', $master_id);
                                    $category_prices = [];

                                    if (!empty($master_services)) {
                                        foreach ($master_services as $service_item) {
                                            $service_id = $service_item['uslyga'];
                                            $price = $service_item['service_price'];

                                            if (!$service_id || !$price) {
                                                continue;
                                            }

                                            $category_id = get_field('usl_cat_field', $service_id);
                                            if (!$category_id) {
                                                continue;
                                            }

                                            $category_name = get_field('cat_short_name', $category_id);


                                            if (!isset($category_prices[$category_name])) {
                                                $category_prices[$category_name] = $price;
                                            } else {
                                                $category_prices[$category_name] = min($category_prices[$category_name], $price);
                                            }
                                        }
                                    }

                                    if (!empty($category_prices)) :
                                        foreach ($category_prices as $cat_name => $min_price) :
                                    ?>
                                        <div class="master-service-wrapper light-text-300 row">
                                            <div class="master-service-name">
                                                <?php echo esc_html($cat_name); ?>
                                            </div>
                                            <div class="master-service-separator"></div>
                                            <div class="master-service-price">
                                                от <?php echo number_format($min_price, 0, '', ' '); ?> ₽
                                            </div>
                                        </div>
                                    <?php
                                        endforeach;
                                    else :
                                    ?>
                                        <div class="master-service-wrapper light-text-300 row">
                                            <div class="master-service-name">
                                                Услуги не найдены
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Кнопки -->
                                <div class="master-service-button-wrapper row">
                                    <div class="button button-primary">
                                        Записаться
                                    </div>
                                    <a href="<?= get_permalink($master_id) ?>" class="button-more colored-text">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="buttons-masters-wrapper row">
        <div class="masters-button-slider prev-button">            
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <a href="/master" class="button button-primary all-masters">Все мастера</a>
        <div class="masters-button-slider next-button">            
            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
</div>
<?php else :
    echo '<p>Мастера не найдены.</p>';
endif;
wp_reset_postdata();
?>
<script>
window.galleryDataMap = window.galleryDataMap || {};
<?php foreach ($gallery_map_master as $galleryId => $images): ?>
window.galleryDataMap["<?= $galleryId ?>"] = <?= json_encode($images); ?>;
<?php endforeach; ?>
</script>