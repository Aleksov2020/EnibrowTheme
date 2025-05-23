<?php
// Получаем все записи типа "master"
$args = array(
    'post_type'      => 'master',
    'posts_per_page' => -1, // Выводим всех мастеров
    'order'          => 'ASC',
);
$masters_query = new WP_Query($args);
$gallery_map_master_all = [];
if ($masters_query->have_posts()) :
?>
<div class="masters wrapper wrapper-laptop col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2><?= esc_html(get_field('title') ?: 'Все мастера'); ?></h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>
    <div class="masters-wrapper-slider row" style="width: 100%;">
        <div class="masters-wrapper-track masters-wrapper row">
            <?php while ($masters_query->have_posts()) : $masters_query->the_post(); ?>
                <?php
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

                // Получаем портфолио мастера
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

                $gallery_id = 'masterGalleryAll_' . $master_id;
                $gallery_map_master_all[$gallery_id] = [];
                $portfolio_index = 0;
                ?>

                <div class="master-card row">
                    <!-- Фото мастера -->
                    <a href="<?= get_permalink($master_id) ?>" class="master-photo" style="background-image: url(<?php echo esc_url($master_photo['url']); ?>);"></a>

                    <!-- Информация о мастере -->
                    <div class="master-info col">
                        <div class="master-info-title-wrapper row">
                            <a href="<?= get_permalink($master_id) ?>" class="master-title row">
                                <div class="master-name colored-text">
                                    <?php echo esc_html($master_name); ?> <?php echo esc_html($master_surname); ?>&nbsp;
                                </div>
                                <?php if ($master_rank) : ?>
                                    <div class="master-label">
                                        <?php echo esc_html($master_rank); ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <div class="master-rate-wrapper col">
                                <div class="master-rate-inner-wrapper row">
                                    <div class="master-rate-icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/starYellow.svg" width="19" height="19" alt="star">
                                    </div>
                                    <div class="master-rate-value">
                                        <?php echo esc_html($master_rate); ?>
                                    </div>
                                </div>
                                <div class="master-rate-reviews colored-text text-12-500">
                                    <?php echo esc_html($master_reviews); ?> отзывов
                                </div>
                            </div>
                        </div>

                        <!-- Бейджи -->
                        <div class="master-badges-wrapper row">
                            <a href="<?= get_permalink($master_id) ?>" class="master-badge light-text row colored-text">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/badge-master.svg"> Квалификация подтверждена
                            </a>
                            <a href="<?= get_permalink($master_id) ?>" class="master-badge light-text row colored-text">
                                Стаж <?php echo esc_html($master_experience); ?> лет
                            </a>
                        </div>

                        <!-- Описание и галерея -->
                        <div class="master-description-wrapper row">
                            <div class="master-detail-wrapper col">
                                <div class="master-detail light-text-300">
                                    <?php echo esc_html($master_bio); ?>
                                </div>
                                <div class="master-gallery-small row">
                                    <?php if ($portfolio_query->have_posts()) : ?>
                                        <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
                                            <?php 
                                            $portfolio_image = get_field('portfolio_image', get_the_ID()); 
                                            $gallery_map_master_all[$gallery_id][] = [
                                                'imageUrl'     => esc_url($portfolio_image['url']),
                                                'masterName'   => esc_html($master_name . ' ' . $master_surname),
                                                'masterRank'   => esc_html($master_rank),
                                                'masterLikes'  => esc_html($master_likes),
                                                'masterAvatar' => esc_url($master_photo['url']),
                                                'masterLink'   => esc_url(get_permalink($master_id)),
                                            ];
                                            ?>
                                            <?php if ($portfolio_image) : ?>
                                                <div class="gallery-item-small" style="background-image: url(<?php echo esc_url($portfolio_image['url']); ?>);" onclick="openGallery(<?= $portfolio_index ?>, '<?= $gallery_id ?>')"                                                ></div>
                                            <?php endif; ?>
                                            <?php $portfolio_index++; ?>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
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
                                    <div class="button button-primary open-order-modal"  data-master-id="<?= esc_attr($master_id); ?>">
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
<?php
else :
    echo '<p>Мастера не найдены.</p>';
endif;
wp_reset_postdata();
?>
</div>
<script>
window.galleryDataMap = window.galleryDataMap || {};
<?php foreach ($gallery_map_master_all as $galleryId => $images): ?>
window.galleryDataMap["<?= $galleryId ?>"] = <?= json_encode($images); ?>;
<?php endforeach; ?>
</script>