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

<div class="services-price wrapper-price-content col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2><?= esc_html(get_field('title') ?: 'Стоимость услуги'); ?></h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

    <div class="price-wrapper-animation-outer">
        <div class="price-animation-wrapper row">
            <div class="price-animation-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M7.04173 14.7367C7.36117 14.9943 7.78943 14.9441 8.07246 14.631C11.4823 10.8395 15.9294 9.67634 19.9176 11.1424L17.1207 18.6179C17.1004 18.6777 17.0611 18.7057 17.0013 18.6854C16.9504 18.6728 16.9389 18.6321 16.9351 18.5826L16.8584 16.5439C16.8043 15.2182 15.9769 14.4187 14.8126 14.4102C13.4907 14.4058 12.6519 15.3692 12.6161 16.9263L12.517 23.0848C12.4412 27.7371 14.3638 30.8446 18.2426 32.2944C22.8757 34.0341 27.1526 32.078 29.0771 26.94L29.9697 24.5427C30.9271 22.0158 30.2772 20.0884 28.2538 19.2995C28.2995 18.3982 27.818 17.663 26.9099 17.3186C26.5933 17.2021 26.2474 17.1378 25.88 17.1167C25.9282 16.1405 25.4071 15.3252 24.4558 14.9592C24.1989 14.863 23.9205 14.81 23.6357 14.7825L24.9956 11.1351C25.5185 9.74753 24.937 8.47985 23.6436 7.99108C22.3337 7.50365 21.0736 8.07619 20.5507 9.4637L20.4545 9.72059C15.9029 8.06592 10.6666 9.34085 6.97408 13.6615C6.70001 13.9822 6.73126 14.4868 7.04173 14.7367ZM18.857 30.7999C15.792 29.6604 13.9735 27.351 14.0398 23.1068L14.1236 16.966C14.1227 16.3178 14.4349 15.9526 14.9331 15.9468C15.4059 15.9346 15.7026 16.3269 15.7377 16.8811L15.976 20.769C16.019 21.4222 16.2914 21.7168 16.6767 21.8611C17.1308 22.0333 17.602 21.7885 17.7868 21.2837L22.0487 9.91146C22.2196 9.44094 22.6693 9.23947 23.1144 9.40399C23.5684 9.57622 23.7445 10.0196 23.5736 10.4901L20.5361 18.6078C20.3917 18.9932 20.6072 19.4085 20.9925 19.5529C21.3689 19.6896 21.7869 19.5072 21.9236 19.1308L23.0239 16.2019C23.2476 16.1927 23.5158 16.2215 23.7384 16.3038C24.2865 16.5102 24.4741 16.9942 24.2613 17.5677L23.3067 20.1278C23.1547 20.5221 23.3854 20.9196 23.7618 21.0564C24.1217 21.1943 24.5512 21.0526 24.7018 20.6419L25.4703 18.5702C25.7017 18.552 25.9699 18.5809 26.1924 18.6632C26.7406 18.8695 26.9281 19.3535 26.7154 19.9271L26.076 21.6313C25.9254 22.0421 26.156 22.4396 26.5324 22.5763C26.8923 22.7143 27.3205 22.5561 27.4724 22.1618L27.9383 20.8952C28.9151 21.2674 29.1012 22.4748 28.4401 24.2221L27.6995 26.2251C26.0421 30.6357 22.7358 32.2496 18.857 30.7999Z" fill="#825E69"/>
                </svg>
            </div>
            Листай таблицу влево или вправо
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>
                        <div class="services-price-header-name services-price-service-name">
                            Услуга/Процедура
                        </div>
                    </th>
                    <?php foreach ($masters as $master) : ?>
                        <th class="<?= get_field('master_rank', $master->ID) ? 'top-master-label' : ''; ?>">
                            <?php if ($rank = get_field('master_rank', $master->ID)) : ?>
                                <div class="label-fot-top-master"><?= esc_html($rank); ?></div>
                            <?php endif; ?>
                            <a href="<?= get_permalink($master->ID) ?>">
                                <?= esc_html(get_field('master_name', $master->ID)); ?>
                            </a>
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
                                    <?= esc_html(get_field('service_short_name', $service_id)); ?>
                                </div>
                                <?php
                                $promotion_args = [
                                    'post_type' => 'promotion',
                                    'posts_per_page' => 1,
                                    'meta_query' => [[
                                        'key'     => 'promotion_services',
                                        'value'   => '"' . $service_id . '"',
                                        'compare' => 'LIKE',
                                    ]]
                                ];
                                $promo_query = new WP_Query($promotion_args);
                                if ($promo_query->have_posts()) :
                                    $promo_query->the_post(); ?>
                                    <a href="<?= esc_url(get_permalink()); ?>" class="services-price-sale-badge text-16-500">
                                        Акция
                                    </a>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                                <div class="separator-punkt"> </div>
                            </div>
                            <div class="services-price-short-description light-text-300">
                                <?= esc_html(get_field('service_short_description', $service_id)); ?>
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
                        <td class="price text-18-400">
                            <div class="price-button-service <?= $class ?>"
                                data-master-id="<?= esc_attr($master->ID); ?>"
                                data-service-id="<?= esc_attr($service_id); ?>">
                                <?= esc_html($price); ?>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <tr class="first-row">
                    <td colspan="<?= count($masters) + 1; ?>">
                        * <span class="text-16-500">Примечание</span> — Цена может варьироваться в зависимости от мастера и выбранной техники
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <a href="#order" class="button button-primary all-masters">
        Записаться
    </a>
</div>

