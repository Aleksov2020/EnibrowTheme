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

            // Получаем категорию услуги
            $categories = get_the_terms($service_id, 'tax_uslyga');
            $category_name = !empty($categories) && !is_wp_error($categories) ? $categories[0]->name : 'Без категории';

            // Группируем услуги по категориям
            if (!isset($services_by_category[$category_name])) {
                $services_by_category[$category_name] = [];
            }

            // Добавляем услугу в категорию с ценой от текущего мастера
            $services_by_category[$category_name][$service_id]['title'] = get_the_title($service_id);
            $services_by_category[$category_name][$service_id]['short_description'] = get_field('service_short_description', $service_id);
            $services_by_category[$category_name][$service_id]['masters'][$master->ID] = $service_price;
        }
    }
}
?>

<div class="services-price wrapper-price-content col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Стоимость услуг</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

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
                <?php foreach ($services_by_category as $category_name => $services) : ?>
                    <tr class="first-row">
                        <td>
                            <div class="services-price-title text-20-400"><?= esc_html($category_name); ?></div>
                        </td>
                    </tr>

                    <?php foreach ($services as $service_id => $service) : ?>
                        <tr class="content-row">
                            <td>
                                <div class="services-price-wrapper-name col">
                                    <div class="services-price-name-wrapper row">
                                        <div class="services-price-name text-20-400"><?= esc_html($service['title']); ?></div>
                                        <?php if (get_field('is_promotion', $service_id)) : ?>
                                            <div class="services-price-sale-badge text-16-500">Акция</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="services-price-short-description light-text-300"><?= esc_html($service['short_description']); ?></div>
                                    <div class="services-price-link colored-text light-text-300">Подробнее об услуге</div>
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
