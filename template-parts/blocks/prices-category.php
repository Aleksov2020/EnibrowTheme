<?php
// Получаем ID текущей категории услуги
$category_id = get_the_ID();

if (!$category_id) {
    echo '<p>Категория услуг не найдена.</p>';
    return;
}

// Получаем все услуги, связанные с этой категорией
$services = get_posts(array(
    'post_type' => 'uslyga',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'usl_cat_field', // Поле ACF с категорией услуги
            'value' => $category_id,
            'compare' => '='
        ),
    ),
));

// Получаем всех мастеров
$masters = get_posts(array(
    'post_type' => 'master',
    'posts_per_page' => -1
));

if (empty($services)) {
    echo '<p>Услуги в данной категории отсутствуют.</p>';
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
                    <th>
                        <div class="services-price-header-name">Услуга/Процедура</div>
                    </th>
                    <?php foreach ($masters as $master) : ?>
                        <th>
                            <?= esc_html(get_field('master_name', $master->ID)); ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service) : ?>
                    <?php
                    $service_title = get_the_title($service->ID);
                    $service_price = get_field('service_price', $service->ID);
                    $service_description = get_field('service_short_description', $service->ID);
                    ?>
                    <tr class="content-row">
                        <td>
                            <div class="services-price-wrapper-name col">
                                <div class="services-price-name-wrapper row">
                                    <a href="<?= esc_url(get_permalink($service->ID)); ?>" class="services-price-name text-20-400">
                                        <?= esc_html($service_title); ?>
                                    </a>
                                </div>
                                <div class="services-price-short-description light-text-300">
                                    <?= esc_html($service_description); ?>
                                </div>
                                <a href="<?= esc_url(get_permalink($service->ID)); ?>" class="services-price-link colored-text light-text-300">
                                    Подробнее об услуге
                                </a>
                            </div>
                        </td>
                        <?php foreach ($masters as $master) : ?>
                            <?php
                            // Проверяем, есть ли услуга у мастера
                            $master_services = get_field('master_services', $master->ID);
                            $master_price = '-';
                            if ($master_services) {
                                foreach ($master_services as $entry) {
                                    if ($entry['uslyga'] == $service->ID) {
                                        $master_price = !empty($entry['service_price']) ? $entry['service_price'] . ' ₽' : '-';
                                        break;
                                    }
                                }
                            }
                            ?>
                            <td class="price text-18-400">
                                <?= esc_html($master_price); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="button button-primary all-masters">
        Посмотреть все цены
    </div>
</div>
