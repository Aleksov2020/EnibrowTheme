<?php
$master_id = get_the_ID();
if (!$master_id) return;

$services = get_field('master_services', $master_id);
if (!$services) return;

// Группируем услуги по категориям
$grouped = [];

foreach ($services as $item) {
    $service_id = $item['uslyga'];
    $price = $item['service_price'];

    $cat_id = get_field('usl_cat_field', $service_id);
    $cat_name = $cat_id ? get_field('cat_short_name', $cat_id) : 'Без категории';

    $grouped[$cat_name][] = [
        'title'       => get_field('service_short_name', $service_id),
        'description' => get_field('service_short_description', $service_id),
        'link'        => get_permalink($service_id),
        'price'       => $price ? $price . ' ₽' : '-',
        'duration'    => get_field('service_duration', $service_id) ?: '-', // добавлено
        'id'          => $service_id,
    ];
}
?>

<div class="services-price wrapper-price-content col">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th style="text-align: left; padding-left: 30px;">Услуга/Процедура</th>
                    <th>Продолжительность</th> <!-- добавлено -->
                    <th>Стоимость</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grouped as $cat => $services): ?>
                    <tr class="first-row">
                        <td colspan="3" class="services-price-title text-20-400"><?= esc_html($cat); ?></td>
                    </tr>
                    <?php foreach ($services as $s): ?>
                        <tr>
                            <td>
                                <div class="services-price-wrapper-name col">
                                    <a href="<?= esc_url($s['link']); ?>" class="services-price-name text-20-400"><?= esc_html($s['title']); ?><div class="separator-punkt"> </div></a>
                                    <div class="services-price-short-description light-text-300"><?= esc_html($s['description']); ?></div>
                                    <a href="<?= esc_url($s['link']); ?>" class="services-price-link colored-text light-text-300">Подробнее об услуге</a>
                                </div>
                            </td>
                            <td class="price text-18-400">
                                <?= esc_html(preg_replace('/^\S+/', '~', $s['duration'])); ?>
                            </td>
                            <td class="price text-18-400">
                                <div class="price-button-service"
                                     data-master-id="<?= esc_attr($master_id); ?>"
                                     data-service-id="<?= esc_attr($s['id']); ?>">
                                    <?= esc_html($s['price']); ?>
                                </div>
                            </td>
                            <td class="price-button-service price-active button-table-add-service" data-master-id="<?= esc_attr($master_id); ?>" data-service-id="<?= esc_attr($s['id']); ?>">
                                <div class="button-table-add-service-inner">
                                    +
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
