<?php
$category_id = get_field('service_category');

if (!$category_id) {
    echo '<p>Категория услуг не выбрана.</p>';
    return;
}

// Получаем все услуги по выбранной категории
$services = get_posts(array(
    'post_type' => 'uslyga',
    'tax_query' => array(
        array(
            'taxonomy' => 'tax_uslyga',
            'field' => 'term_id',
            'terms' => $category_id,
        ),
    ),
    'posts_per_page' => -1,
));

// Получаем всех мастеров с услугами из выбранной категории
$masters = get_posts(array(
    'post_type' => 'master',
    'posts_per_page' => -1,
));

$filtered_masters = [];
$services_by_master = [];

// Группируем услуги по мастерам и категориям
foreach ($masters as $master) {
    $master_services = get_field('master_services', $master->ID);
    if (!empty($master_services)) {
        foreach ($master_services as $entry) {
            $service_id = $entry['uslyga'];
            $service_price = !empty($entry['service_price']) ? $entry['service_price'] . " ₽" : "-";
            if (in_array($service_id, wp_list_pluck($services, 'ID'))) {
                $filtered_masters[$master->ID] = $master;
                $services_by_master[$service_id][$master->ID] = $service_price;
            }
        }
    }
}

if (empty($filtered_masters)) {
    echo '<p>Нет мастеров с услугами в данной категории.</p>';
    return;
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
                    <th>Услуга/Процедура</th>
                    <?php foreach ($filtered_masters as $master) : ?>
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
                <?php foreach ($services as $service) : ?>
                    <?php
                    $service_id = $service->ID;
                    if (!isset($services_by_master[$service_id])) {
                        continue;
                    }
                    ?>
                    <tr class="content-row">
                        <td>
                            <div class="services-price-wrapper-name col">
                                <div class="services-price-name text-20-400">
                                    <?= esc_html(get_the_title($service_id)); ?>
                                </div>
                                <div class="services-price-short-description light-text-300">
                                    <?= esc_html(get_field('service_short_description', $service_id)); ?>
                                </div>
                                <div class="services-price-link colored-text light-text-300">Подробнее об услуге</div>
                            </div>
                        </td>
                        <?php foreach ($filtered_masters as $master) : ?>
                            <?php
                            $price = isset($services_by_master[$service_id][$master->ID]) ? $services_by_master[$service_id][$master->ID] : "-";
                            ?>
                            <td class="price text-18-400">
                                <div class="price-button-service"><?= esc_html($price); ?></div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                <tr class="first-row">
                    <td colspan="<?= count($filtered_masters) + 1; ?>">
                        * <span class="text-16-500">Примечание</span> - Итоговая стоимость зависит от желаемого вида татуажа и мастера
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
