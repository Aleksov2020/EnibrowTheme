<?php 
add_action('admin_menu', function () {
    add_menu_page(
        'Заявки с сайта',        // Название страницы
        'Заявки',                // Название в меню
        'manage_options',        // Права доступа
        'site_orders',           // Слаг
        'render_site_orders_page', // Callback-функция
        'dashicons-feedback',    // Иконка
        26                       // Позиция
    );
});

add_action('init', function () {
    register_post_type('site_order', [
        'labels' => [
            'name' => 'Заявки',
            'singular_name' => 'Заявка',
        ],
        'public' => false,
        'show_ui' => false,
        'supports' => ['title', 'custom-fields'],
    ]);
});

function render_site_orders_page() {
    $orders = get_posts([
        'post_type' => 'site_order',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);

    echo '<div class="wrap"><h1>Заявки с сайта</h1><table class="widefat"><thead><tr><th>Имя</th><th>Телефон</th><th>Источник</th><th>Дата</th></tr></thead><tbody>';

    foreach ($orders as $order) {
        $phone = get_post_meta($order->ID, 'user_phone', true);
        $source = get_post_meta($order->ID, 'source_url', true);
        echo '<tr>';
        echo '<td>' . esc_html($order->post_title) . '</td>';
        echo '<td>' . esc_html($phone) . '</td>';
        echo '<td><a href="' . esc_url($source) . '" target="_blank">Источник</a></td>';
        echo '<td>' . esc_html(get_the_date('', $order)) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}

add_action('admin_post_nopriv_send_order', 'handle_site_order');
add_action('admin_post_send_order', 'handle_site_order');

function handle_site_order() {
    error_log('try to create'); // ← здесь была ошибка — не хватало ;
    
    $name = sanitize_text_field($_POST['user_name'] ?? '');
    $phone = sanitize_text_field($_POST['user_phone'] ?? '');
    $source = wp_get_referer();

    if (!$name || !$phone) {
        wp_die('Ошибка: не заполнены обязательные поля');
    }

    wp_insert_post([
        'post_type'   => 'site_order',
        'post_title'  => $name,
        'post_status' => 'publish',
        'meta_input'  => [
            'user_phone' => $phone,
            'source_url' => $source,
        ]
    ]);

    wp_redirect($source . '?order=success');
    exit;
}

