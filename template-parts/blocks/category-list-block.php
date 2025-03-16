<?php
// Получаем все категории услуг (таксономия "service_category")
$categories = get_terms(array(
    'taxonomy'   => 'service_category',
    'hide_empty' => true, // Не показывать пустые категории
));

if (!empty($categories)): ?>
    <div class="services wrapper wrapper-laptop row">
        <?php foreach ($categories as $category): ?>
            <?php
            // Получаем услуги, относящиеся к этой категории (максимум 6)
            $services = get_posts(array(
                'post_type'      => 'service', // Подставь нужный тип постов для услуг
                'posts_per_page' => 6,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'service_category',
                        'field'    => 'term_id',
                        'terms'    => $category->term_id,
                    ),
                ),
            ));
            ?>

            <div class="service first-service col">
                <div class="service-filter col">
                    <div class="service-title text-30-400 colored-text"> 
                        <?php echo esc_html($category->name); ?>
                    </div>
                    <div class="service-item-wrapper col">
                        <?php if (!empty($services)): ?>
                            <?php foreach ($services as $service): ?>
                                <div class="service-item colored-text">
                                    <?php echo esc_html($service->service_short_name); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="service-item colored-text">Нет услуг в этой категории</div>
                        <?php endif; ?>
                    </div>
                    <div class="show-more-button clickable text-16-500 colored-text">
                        <a href="<?php echo get_term_link($category); ?>">Все техники</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
