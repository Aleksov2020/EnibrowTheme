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

    echo '<div class="wrap"><h1>Заявки с сайта</h1><table class="widefat"><thead><tr><th>Имя</th><th>Телефон</th><th>Мастер</th><th>Услуги</th><th>Татуаж</th><th>Источник</th><th>Дата</th></tr></thead><tbody>';

    foreach ($orders as $order) {
        $phone     = get_post_meta($order->ID, 'user_phone', true);
        $source    = get_post_meta($order->ID, 'source_url', true);
        $master_id = get_post_meta($order->ID, 'master_id', true);
        $tattoo    = get_post_meta($order->ID, 'tattoo_exist', true);
        $services  = get_post_meta($order->ID, 'service_ids', true);

        $master_name = $master_id ? get_the_title($master_id) : '—';
        $service_titles = [];

        if (is_array($services)) {
            foreach ($services as $service_id) {
                $service_titles[] = get_the_title($service_id);
            }
        }

        echo '<tr>';
        echo '<td>' . esc_html($order->post_title) . '</td>';
        echo '<td>' . esc_html($phone) . '</td>';
        echo '<td>' . esc_html($master_name) . '</td>';
        echo '<td>' . esc_html(implode(', ', $service_titles)) . '</td>';
        echo '<td>' . esc_html($tattoo ?: '—') . '</td>';
        echo '<td><a href="' . esc_url($source) . '" target="_blank">Источник</a></td>';
        echo '<td>' . esc_html(get_the_date('', $order)) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}


add_action('wp_ajax_send_modal_order', 'handle_modal_order');
add_action('wp_ajax_nopriv_send_modal_order', 'handle_modal_order');

function handle_modal_order() {
    $name      = sanitize_text_field($_POST['name'] ?? '');
    $phone     = sanitize_text_field($_POST['phone'] ?? '');
    $master_id = intval($_POST['master_id'] ?? 0);
    $tattoo    = sanitize_text_field($_POST['tattoo'] ?? '');
    $services  = json_decode(stripslashes($_POST['services'] ?? '[]'), true);
    $source    = wp_get_referer();

    if (strlen($name) < 3 || empty($phone)) {
        wp_send_json_error('Некорректные данные');
    }

    $post_id = wp_insert_post([
        'post_type'    => 'site_order',
        'post_title'   => $name,
        'post_status'  => 'publish',
        'meta_input'   => [
            'user_phone'   => $phone,
            'source_url'   => $source,
            'master_id'    => $master_id,
            'tattoo_exist' => $tattoo,
            'service_ids'  => $services,
        ]
    ]);

    if ($post_id) {
        wp_send_json_success('Заявка отправлена');
    } else {
        wp_send_json_error('Ошибка при сохранении');
    }
}


