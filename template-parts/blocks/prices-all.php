<?php
// Получаем всех мастеров с чекбоксом "master_show_global"
$masters = get_posts([
    'post_type'      => 'master',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => 'master_show_global',
            'value'   => '1',
            'compare' => '='
        ]
    ]
]);

// Группируем услуги по категориям
$services_by_category = [];

// Проходим по каждому мастеру и получаем его услуги с ценами
foreach ($masters as $master) {
    $master_services = get_field('master_services', $master->ID); // Репитер "Услуги мастера"

    if (!empty($master_services) && is_array($master_services)) {
        foreach ($master_services as $entry) {
            $service_id = $entry['uslyga'];
            $service_price = !empty($entry['service_price']) ? $entry['service_price'] . " ₽" : "-";

            // Получаем категорию услуги через ACF поле
            $category_id = get_field('usl_cat_field', $service_id);
            if ($category_id) {
                $category = get_post($category_id);
                $category_name = $category ? $category->post_title : 'Без категории';
                $category_link = get_permalink($category_id);
            } else {
                $category_name = 'Без категории';
                $category_link = '#';
            }

            // Группируем услуги по категориям
            if (!isset($services_by_category[$category_name])) {
                $services_by_category[$category_name] = [];
            }

            // Добавляем услугу в категорию с ценой от текущего мастера
            $services_by_category[$category_name][$service_id]['title'] = get_the_title($service_id);
            $services_by_category[$category_name][$service_id]['short_description'] = get_field('service_short_description', $service_id);
            $services_by_category[$category_name][$service_id]['link'] = get_permalink($service_id);
            $services_by_category[$category_name][$service_id]['masters'][$master->ID] = $service_price;
            $services_by_category[$category_name][$service_id]['category_link'] = $category_link;
        }
    }
}
?>

<div class="services-price wrapper-price-content col">
    <div class="price-wrapper-animation-outer">
        <div class="price-animation-wrapper row">
            <div class="price-animation-item">
                Листай таблицу влево или вправо
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>
                        <div class="services-price-header-name">
                            Услуга/Процедура
                        </div>
                    </th>
                    <?php foreach ($masters as $master) : ?>
                        <th class="<?= get_field('master_rank', $master->ID) ? 'top-master-label' : ''; ?>">
                            <?php if ($master_rank = get_field('master_rank', $master->ID)) : ?>
                                <div class="label-fot-top-master"><?= esc_html($master_rank); ?></div>
                            <?php endif; ?>
                            <?= esc_html(get_field('master_name', $master->ID)); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $is_first_row = true; 
                foreach ($services_by_category as $category_name => $services) : ?>
                    <tr class="<?= $is_first_row ? 'row-gap' : 'first-row'; ?>">
                        <td>
                            <a href="<?= esc_url($services[array_key_first($services)]['category_link']); ?>" class="services-price-title text-20-400">
                                <?= esc_html($category_name); ?>
                            </a>
                        </td>
                    </tr>

                    <?php foreach ($services as $service_id => $service) : ?>
                        <tr class="content-row">
                            <td>
                                <div class="services-price-wrapper-name col">
                                    <div class="services-price-name-wrapper row">
                                        <a href="<?= esc_url($service['link']); ?>" class="services-price-name text-20-400">
                                            <?= esc_html($service['title']); ?>
                                        </a>
                                        <?php if (get_field('is_promotion', $service_id)) : ?>
                                            <div class="services-price-sale-badge text-16-500">Акция</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="services-price-short-description light-text-300"><?= esc_html($service['short_description']); ?></div>
                                    <a href="<?= esc_url($service['link']); ?>" class="services-price-link colored-text light-text-300">Подробнее об услуге</a>
                                </div>
                            </td>

                            <?php foreach ($masters as $master) : ?>
                                <td class="price text-18-400">
                                    <?php
                                    $price = isset($service['masters'][$master->ID]) ? $service['masters'][$master->ID] : "-";
                                    ?>
                                    <div class="price-button-service"><?= esc_html($price); ?></div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php $is_first_row = false; ?>
                <?php endforeach; ?>
                
                <tr class="first-row">
                    <td colspan="<?= count($masters) + 1; ?>">
                        * <span class="text-16-500">Примечание</span> - Итоговая стоимость зависит от желаемого вида татуажа и мастера
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <a class="button button-primary all-masters" href='/prices'>
        Посмотреть все цены
    </a>
</div>
