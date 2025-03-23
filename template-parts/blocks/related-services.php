<?php
// Получаем выбранную категорию из блока
$category_id = get_field('related_category');

if (!$category_id) {
    echo '<p>Категория не выбрана</p>';
    return;
}

// Получаем услуги, связанные с категорией
$related_services = get_posts(array(
    'post_type' => 'uslyga',
    'tax_query' => array(
        array(
            'taxonomy' => 'tax_uslyga',
            'field'    => 'term_id',
            'terms'    => $category_id,
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
            $image = get_field('service_image', $service->ID);
            $has_action = get_field('service_has_action', $service->ID);
            // Получаем работы из портфолио, связанные с услугой
            $portfolio_works = get_field('service_portfolio_works', $service->ID);

            // Если есть связанные работы, берем последнюю
            $image = '';
            if (!empty($portfolio_works)) {
                $last_portfolio_id = end($portfolio_works); // Берем последний добавленный
                $image_data = get_field('portfolio_image', $last_portfolio_id);
                if ($image_data && isset($image_data['url'])) {
                    $image = $image_data['url'];
                }
            }

            // Получаем связанные акции
            $has_action = false;
            $promotions = get_posts(array(
                'post_type' => 'promotion',
                'meta_query' => array(
                    array(
                        'key' => 'promotion_services', // ACF поле для связи услуг с акцией
                        'value' => '"' . $service->ID . '"', // Ищем ID услуги
                        'compare' => 'LIKE',
                    ),
                ),
            ));

            if (!empty($promotions)) {
                $has_action = true;
            }
            ?>

            <div class="subservice-item col">
                <div class="subservice-item-photo col" style="background-image: url('<?php echo esc_url($image); ?>');">
                    <?php if ($has_action): ?>
                        <div class="subservice-item-badge badge-primary">
                            Акция
                        </div>
                    <?php endif; ?>
                </div>
                <div class="subservice-item-wrapper col">
                    <div class="subservice-item-title colored-text">
                        <?php echo esc_html($service->post_title); ?>
                    </div>
                    <div class="subservice-item-text-wrapper col">
                        <div class="subservice-item-text-subtitle colored-text light-text-600">
                            О процедуре:
                        </div>
                        <div class="subservice-item-text-item row">
                            <div class="subservice-item-text-item-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/coinSmall.svg" alt="coin">
                            </div>
                            <div class="subservice-item-text-item-label light-text-300">
                                Стоимость
                            </div> 
                            <div class="subservice-item-text-item-separator"></div>
                            <div class="subservice-item-text-item-value light-text-300">
                                от <?php echo esc_html($price); ?> ₽
                            </div> 
                        </div>
                        <div class="subservice-item-text-item row">
                            <div class="subservice-item-text-item-label-wrapper row">
                                <div class="subservice-item-text-item-icon icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/clockSmall.svg" alt="clock">
                                </div>
                                <div class="subservice-item-text-item-label light-text-300">
                                    Длительность
                                </div> 
                            </div>
                            <div class="subservice-item-text-item-separator"></div> 
                            <div class="subservice-item-text-item-value light-text-300">
                                <?php echo esc_html($duration); ?>
                            </div> 
                        </div>
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
