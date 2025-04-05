<?php
// Получаем выбранную категорию из блока
$category_id = get_field('related_category');

if (!$category_id) {
    echo '<p>Категория не выбрана</p>';
    return;
}

// Получаем услуги, связанные с категорией через ACF-поле
$related_services = get_posts(array(
    'post_type' => 'uslyga',
    'meta_query' => array(
        array(
            'key' => 'usl_cat_field',
            'value' => $category_id,
            'compare' => '='
        ),
    ),
    'posts_per_page' => -1,
));

if (!empty($related_services)): ?>
    <div class="subservice wrapper row">
        <?php foreach ($related_services as $service): ?>
            <?php
            $price = get_field('service_price', $service->ID);
            $duration = get_field('service_duration', $service->ID);
            $image_data = get_field('service_image', $service->ID);
            $image_url = '';

            // Fallback на портфолио
            if (!$image_data) {
                $portfolio_works = get_field('service_portfolio_works', $service->ID);
                if (!empty($portfolio_works)) {
                    $last_portfolio_id = end($portfolio_works);
                    $portfolio_image = get_field('portfolio_image', $last_portfolio_id);
                    if ($portfolio_image && isset($portfolio_image['url'])) {
                        $image_url = esc_url($portfolio_image['url']);
                    }
                }
            } else {
                $image_url = esc_url($image_data['url']);
            }

            // Проверка на наличие акции
            $has_action = false;
            $promotions = get_posts(array(
                'post_type' => 'promotion',
                'meta_query' => array(
                    array(
                        'key'     => 'promotion_services',
                        'value'   => '"' . $service->ID . '"',
                        'compare' => 'LIKE',
                    ),
                ),
            ));

            if (!empty($promotions)) {
                $has_action = true;
            }
            ?>
            <div class="subservice-item col">
                <div class="subservice-item-photo col" style="background-image: url('<?php echo $image_url; ?>');">
                    <?php if ($has_action): ?>
                        <div class="subservice-item-badge badge-primary">Акция</div>
                    <?php endif; ?>
                </div>
                <div class="subservice-item-wrapper col">
                    <div class="subservice-item-title colored-text">
                        <?php echo esc_html($service->post_title); ?>
                    </div>
                    <div class="subservice-item-text-wrapper col">
                        <div class="subservice-item-text-subtitle colored-text light-text-600">О процедуре:</div>

                        <?php if ($price): ?>
                            <div class="subservice-item-text-item row">
                                <div class="subservice-item-text-item-icon icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/coinSmall.svg" alt="coin">
                                </div>
                                <div class="subservice-item-text-item-label light-text-300">Стоимость</div>
                                <div class="subservice-item-text-item-separator"></div>
                                <div class="subservice-item-text-item-value light-text-300">от <?php echo esc_html($price); ?> ₽</div>
                            </div>
                        <?php endif; ?>

                        <?php if ($duration): ?>
                            <div class="subservice-item-text-item row">
                                <div class="subservice-item-text-item-label-wrapper row">
                                    <div class="subservice-item-text-item-icon icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/clockSmall.svg" alt="clock">
                                    </div>
                                    <div class="subservice-item-text-item-label light-text-300">Длительность</div>
                                </div>
                                <div class="subservice-item-text-item-separator"></div>
                                <div class="subservice-item-text-item-value light-text-300"><?php echo esc_html($duration); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="subservice-button-wrapper row">
                        <div class="button button-primary order-button">Записаться</div>
                        <a href="<?php echo get_permalink($service->ID); ?>" class="button button-bordered button-hover-white">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Услуги в выбранной категории не найдены.</p>
<?php endif; ?>
