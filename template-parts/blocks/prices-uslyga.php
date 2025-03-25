<?php
// Получаем текущую услугу (post ID)
$service_id = get_the_ID();

if (!$service_id) {
    echo '<p>Услуга не найдена.</p>';
    return;
}

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

if (empty($masters)) {
    echo '<p>Нет доступных мастеров для этой услуги.</p>';
    return;
}
?>

<div class="services-price wrapper col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Стоимость услуги</h2>
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
                    <th>
                        <div class="services-price-header-name">
                            Услуга/Процедура
                        </div>
                    </th>
                    <?php foreach ($masters as $master) : ?>
                        <th>
                            <?= esc_html(get_field('master_name', $master->ID)); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr class="content-row">
                    <td>
                        <div class="services-price-wrapper-name col">
                            <div class="services-price-name-wrapper row">
                                <div class="services-price-name text-20-400">
                                    <?= esc_html(get_the_title($service_id)); ?>
                                </div>
                                <?php if (get_field('is_promotion', $service_id)) : ?>
                                    <div class="services-price-sale-badge text-16-500">Акция</div>
                                <?php endif; ?>
                            </div>
                            <div class="services-price-short-description light-text-300">
                                <?= esc_html(get_field('service_short_description', $service_id)); ?>
                            </div>
                            <div class="services-price-link colored-text light-text-300">Подробнее об услуге</div>
                        </div>
                    </td>
                    <?php foreach ($masters as $master) : ?>
                        <?php
                        $master_services = get_field('master_services', $master->ID); 
                        $price = '-';

                        if ($master_services) {
                            foreach ($master_services as $entry) {
                                if ($entry['uslyga'] == $service_id) {
                                    $price = !empty($entry['service_price']) ? $entry['service_price'] . " ₽" : "-";
                                    break;
                                }
                            }
                        }
                        ?>
                        <td class="price text-18-400">
                            <?= esc_html($price); ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="button button-primary all-masters">
        Записаться
    </div>
</div>

