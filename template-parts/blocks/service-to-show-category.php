<?php
// Получаем текущий пост и его слаг
$current_post_id = get_queried_object_id();
$current_page_slug = get_post_field('post_name', $current_post_id);

// Получаем объект текущей страницы
$current_post = get_post($current_post_id);

if (!$current_post) {
    echo '<p>Категория услуг не найдена.</p>';
    return;
}

// Проверяем, является ли текущий пост категорией услуг
if ($current_post->post_type !== 'uslyga_category') {
    echo '<p>Текущая страница не является категорией услуг.</p>';
    return;
}

// Получаем услуги, связанные с данной категорией
$args = array(
    'post_type'      => 'uslyga',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key'   => 'usl_cat_field',
            'value' => $current_post_id,
            'compare' => '='
        ),
    ),
);

$services_query = new WP_Query($args);

if ($services_query->have_posts()):
?>
    <div class="subservice wrapper row">
        <?php while ($services_query->have_posts()): $services_query->the_post(); ?>
            <?php
                $duration_minutes = get_field('service_duration_minutes', get_the_ID());
                $price_rub = get_field('service_price_rub',  get_the_ID());
            ?>
            <div class="subservice-item col">
                <?php $image = get_field('service_preview_image', get_the_ID());
                $default_image = get_template_directory_uri() . '/assets/girl-service.png';
                $background_url = $image ? $image['url'] : $default_image;
                ?>
                <a href="<?php the_permalink(); ?>" class="subservice-item-photo col" style="background-image: url('<?php echo esc_url($background_url); ?>')">
                    <?php if (get_field('service_promo')): ?>
                        <div class="subservice-item-badge badge-primary">Акция</div>
                    <?php endif; ?>
                </a>
                <div class="subservice-item-wrapper col">
                    <a href="<?php the_permalink(); ?>" class="subservice-item-title colored-text">
                        <?php the_title(); ?>
                    </a>
                    <div class="subservice-item-text-item row">
                        <div class="subservice-item-text-item-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/coinSmall.svg" alt="coin">
                        </div>
                        <div class="subservice-item-text-item-label light-text-300">Стоимость</div>
                        <div class="subservice-item-text-item-separator"></div>
                        <div class="subservice-item-text-item-value light-text-300">
                            <?php echo $price_rub ? esc_html($price_rub) : "—"; ?>
                        </div>
                    </div>

                    <div class="subservice-item-text-item row">
                        <div class="subservice-item-text-item-label-wrapper row">
                            <div class="subservice-item-text-item-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/clockSmall.svg" alt="clock">
                            </div>
                            <div class="subservice-item-text-item-label light-text-300">Длительность</div>
                        </div>
                        <div class="subservice-item-text-item-separator"></div>
                        <div class="subservice-item-text-item-value light-text-300">
                            <?php echo $duration_minutes ? esc_html($duration_minutes) : "—"; ?>
                        </div>
                    </div>
                    <div class="subservice-button-wrapper row">
                        <a href="<?php the_permalink(); ?>" class="button button-primary">
                            Записаться
                        </a>
                        <a href="<?php the_permalink(); ?>" class="button button-bordered button-hover-white">
                            Подробнее
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <p>Услуги данной категории отсутствуют.</p>
<?php endif; ?>
