<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit;
}

// Получаем все категории услуг (тип поста "uslyga_category")
$categories = get_posts(array(
    'post_type'      => 'uslyga_category',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
));

if (!empty($categories)): ?>
    <div class="services wrapper wrapper-laptop row">
        <?php foreach ($categories as $category): ?>
            <?php
            // Получаем связанные услуги для этой категории через ACF
            $services = get_posts(array(
                'post_type'      => 'uslyga', // Тип поста "услуга"
                'posts_per_page' => -1,
                'meta_query'     => array(
                    array(
                        'key'     => 'usl_cat_field', // ACF поле для связи
                        'value'   => $category->ID,
                        'compare' => '=',
                    ),
                ),
            ));

            // Пропускаем категорию, если в ней нет услуг
            if (empty($services)) {
                continue;
            }
            ?>

            <?php $bg_image = get_field('uslyga_category_image', $category->ID); ?>
            <div class="service first-service col" style="background-image: url('<?php echo esc_url($bg_image ?: get_template_directory_uri() . '/assets/first.jpg'); ?>');">

                <div class="service-filter col">
                    <div class="service-title text-30-400 colored-text">
                        <a href="<?php echo esc_url(get_permalink($category->ID)); ?>">
                            <?php echo esc_html(get_the_title($category->ID)); ?>
                        </a>
                    </div>
                    <div class="service-item-wrapper col">
                        <?php foreach ($services as $service): ?>
                            <div class="service-item colored-text">
                                <a href="<?php echo esc_url(get_permalink($service->ID)); ?>">
                                    <?php echo esc_html(get_the_title($service->ID)); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="show-more-button clickable text-16-500 colored-text">
                        <a href="<?php echo esc_url(get_permalink($category->ID)); ?>">Все техники</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Категории услуг не найдены.</p>
<?php endif; ?>
