<?php
$category_id = get_the_ID();
if (!$category_id) {
    echo '<p>Категория услуг не найдена.</p>';
    return;
}

// Получаем все услуги в категории
$services = get_posts(array(
    'post_type' => 'uslyga',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'usl_cat_field',
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

// Получаем все акции
$promotions = get_posts(array(
    'post_type' => 'promotion',
    'posts_per_page' => -1,
));

// Составляем карту: ID услуги => ID акции
$service_promotions = [];
foreach ($promotions as $promo) {
    $related_services = get_field('promotion_services', $promo->ID);
    if (!empty($related_services)) {
        foreach ($related_services as $service_id) {
            $service_promotions[$service_id] = $promo->ID;
        }
    }
}

if (empty($services)) {
    echo '<p>Услуги в данной категории отсутствуют.</p>';
    return;
}
?>

<div class="services-price wrapper col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row"><div class="spacer-title"></div><div class="circle-title"></div></div>
        <div class="title"><h2>Стоимость услуг</h2></div>
        <div class="title-right-arrow row"><div class="circle-title"></div><div class="spacer-title"></div></div>
    </div>

    <div class="price-wrapper-animation-outer">
        <div class="price-animation-wrapper row">
            <div class="price-animation-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="..."/></svg>
            </div>
            Листай таблицу влево или вправо
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>
                        <div class="services-price-header-name services-price-service-name">Услуга/Процедура</div>
                    </th>
                    <?php foreach ($masters as $master) : ?>
                        <th class="<?= get_field('master_rank', $master->ID) ? 'top-master-label' : ''; ?>">
                            <?php if ($master_rank = get_field('master_rank', $master->ID)) : ?>
                                <div class="label-fot-top-master"><?= esc_html($master_rank); ?></div>
                            <?php endif; ?>
                            <a href="<?= get_permalink($master->ID) ?>">
                                <?= esc_html(get_field('master_name', $master->ID)); ?>
                            </a>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service) : ?>
                    <?php
                    $service_id = $service->ID;
                    $service_title = get_the_title($service_id);
                    $service_description = get_field('service_short_description', $service_id);
                    $has_promo = isset($service_promotions[$service_id]);
                    $promo_link = $has_promo ? get_permalink($service_promotions[$service_id]) : '';
                    ?>
                    <tr class="content-row">
                        <td>
                            <div class="services-price-wrapper-name col">
                                <div class="services-price-name-wrapper row">
                                    <a href="<?= esc_url(get_permalink($service_id)); ?>" class="services-price-name text-20-400">
                                        <?= esc_html($service_title); ?>
                                    </a>
                                    <?php if ($has_promo) : ?>
                                        <a href="<?= esc_url($promo_link); ?>" class="services-price-sale-badge text-16-500">Акция</a>
                                    <?php endif; ?>
                                </div>
                                <div class="services-price-short-description light-text-300">
                                    <?= esc_html($service_description); ?>
                                </div>
                                <a href="<?= esc_url(get_permalink($service_id)); ?>" class="services-price-link colored-text light-text-300">
                                    Подробнее об услуге
                                </a>
                            </div>
                        </td>
                        <?php foreach ($masters as $master) :
                            $price = '-';
                            $class = '';
                            $master_services = get_field('master_services', $master->ID);
                            if ($master_services) {
                                foreach ($master_services as $entry) {
                                    if ($entry['uslyga'] == $service_id) {
                                        $price = !empty($entry['service_price']) ? $entry['service_price'] . ' ₽' : '-';
                                        $class = !empty($entry['service_price']) ? 'price-active' : '';
                                        break;
                                    }
                                }
                            }
                            ?>
                            <td class="price text-18-400 <?= esc_attr($class); ?>">
                                <?= esc_html($price); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="/prices" class="button button-primary all-masters">
        Посмотреть все цены
    </a>
</div>
