<?php
// Получаем все услуги, отмеченные для отображения
$services = get_posts([
    'post_type'      => 'uslyga',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => 'master_show_on_home',
            'value'   => '1',
            'compare' => '='
        ]
    ]
]);

// Группируем услуги по категориям
$services_by_category = [];
foreach ($services as $service) {
    $categories = get_term(get_field('cat_uslyga', $service->ID), 'cat_uslyga');

    $category_name = !empty($categories) ? $categories->name : 'Без категории';

    if (!isset($services_by_category[$category_name])) {
        $services_by_category[$category_name] = [];
    }
    $services_by_category[$category_name][] = $service;
}

// Получаем всех мастеров
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
                                    <div class="services-price-link colored-text light-text-300">Подробнее об услуге</div>
                                </div>
                            </td>

                            <?php foreach ($masters as $master) : ?>
                                <td class="price text-18-400">
                                    <?php
                                    $price = "-"; // Значение по умолчанию
                                    $master_services = get_field('master_services', $master->ID); // Репитер "Услуги мастера"

                                    if (!empty($master_services) && is_array($master_services)) {
                                        foreach ($master_services as $entry) {
                                            if ($entry['uslyga'] == $service->ID) { // Проверяем соответствие услуги
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

    <div class="button button-primary all-masters">
        Посмотреть все цены
    </div>
</div>
