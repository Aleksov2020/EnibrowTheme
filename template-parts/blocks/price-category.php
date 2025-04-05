<?php
// Получаем категорию из ACF или из текущей страницы
$category_id = get_field('selected_category');
if (!$category_id) {
    $category_id = get_queried_object_id();
}

// Получаем все услуги категории
$services = get_posts(array(
    'post_type' => 'uslyga',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'cat_uslyga',
            'field' => 'term_id',
            'terms' => $category_id,
        ),
    ),
));

// Группируем услуги по категориям
$services_by_category = [];
foreach ($services as $service) {
    $categories = wp_get_post_terms($service->ID, 'cat_uslyga');
    $category_name = !empty($categories) ? $categories[0]->name : 'Без категории';

    if (!isset($services_by_category[$category_name])) {
        $services_by_category[$category_name] = [];
    }
    $services_by_category[$category_name][] = $service;
}

// Получаем всех мастеров без фильтрации по чекбоксу
$masters = get_posts(array(
    'post_type' => 'master',
    'posts_per_page' => -1,
));

?>

<div class="services-price wrapper-price-content col">
    <div class="title-wrapper row">
        <div class="title">
            <h2>Стоимость услуг</h2>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Услуга/Процедура</th>
                    <?php foreach ($masters as $master) : ?>
                        <th class="<?= get_field('master_rank', $master->ID) == 'TOP-мастер' ? 'top-master-label' : ''; ?>">
                            <?php if (get_field('master_rank', $master->ID) == 'TOP-мастер') : ?>
                                <div class="label-for-top-master">TOP-МАСТЕР</div>
                            <?php endif; ?>
                            <?= esc_html(get_field('master_name', $master->ID)); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services_by_category as $category_name => $services) : ?>
                    <tr class="first-row">
                        <td><div class="services-price-title text-20-400"><?= esc_html($category_name); ?></div></td>
                    </tr>

                    <?php foreach ($services as $service) : ?>
                        <tr class="content-row">
                            <td>
                                <div class="services-price-wrapper-name col">
                                    <div class="services-price-name-wrapper row">
                                        <div class="services-price-name text-20-400"><?= esc_html(get_the_title($service->ID)); ?></div>
                                        <?php if (get_field('is_promotion', $service->ID)) : ?>
                                            <div class="services-price-sale-badge text-16-500">Акция</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="services-price-short-description light-text-300"><?= esc_html(get_field('service_short_description', $service->ID)); ?></div>
                                    <a href="<?= esc_url(get_permalink($service->ID)); ?>" class="services-price-link colored-text light-text-300">Подробнее об услуге</a>
                                </div>
                            </td>

                            <?php foreach ($masters as $master) : ?>
                                <td class="price text-18-400">
                                    <?php
                                    $price = "-";
                                    $master_services = get_field('master_services', $master->ID);

                                    if (!empty($master_services) && is_array($master_services)) {
                                        foreach ($master_services as $entry) {
                                            if ($entry['uslyga'] == $service->ID) {
                                                $price = $entry['service_price'] . " ₽";
                                                break;
                                            }
                                        }
                                    }
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

    <a href="/prices" class="button button-primary all-masters">
        Посмотреть все цены
    </a>
</div>
