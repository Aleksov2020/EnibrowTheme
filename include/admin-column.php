<?php
function add_master_columns($columns) {
    $columns['services_prices'] = 'Услуги и цены';
    return $columns;
}
add_filter('manage_master_posts_columns', 'add_master_columns');

function show_master_columns($column, $post_id) {
    if ($column == 'services_prices') {
        $prices = get_field('services_prices', $post_id);
        if ($prices) {
            foreach ($prices as $price) {
                echo get_the_title($price['service']) . ' - ' . esc_html($price['price']) . ' ₽<br>';
            }
        } else {
            echo 'Нет услуг';
        }
    }
}
add_action('manage_master_posts_custom_column', 'show_master_columns', 10, 2);
