<?php
if (!defined('ABSPATH')) exit; // Защита от прямого доступа

// Функция для регистрации всех ACF блоков
function register_custom_acf_blocks() {
    // Блок: Рекламный блок Enibrow
    acf_register_block_type(array(
        'name'              => 'enibrow_discount_block', // 👈 ДОЛЖНО СОВПАДАТЬ!
        'title'             => __('Рекламный блок Enibrow'),
        'description'       => __('Рекламный блок со скидкой и ссылкой на карты.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/enibrow-discount.php',
        'category'          => 'layout',
        'icon'              => 'megaphone',
        'keywords'          => array('скидка', 'реклама', 'карты'),
        'mode'              => 'edit', // 👈 Включаем режим редактирования
        'supports'          => array('align' => true, 'customClassName' => true),
    ));
    
    acf_register_block_type(array(
        'name'              => 'reviews_list',
        'title'             => __('Отзывы списком'),
        'description'       => __('Блок для отображения списка отзывов.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/reviews-list.php',
        'category'          => 'layout',
        'icon'              => 'admin-comments',
        'keywords'          => array('отзывы', 'список', 'клиенты'),
        'mode'              => 'edit',
        'supports'          => array('align' => true, 'customClassName' => true),
    ));

    acf_register_block_type(array(
        'name'              => 'reviews_carousel',
        'title'             => __('Карусель отзывов'),
        'description'       => __('Выводит отзывы с флагом "Выводить на главной".'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/reviews-carousel.php',
        'category'          => 'formatting',
        'icon'              => 'slides',
        'keywords'          => array('отзывы', 'карусель'),
        'mode'              => 'edit',
        'supports'          => array('align' => true, 'customClassName' => true),
    ));
    
}




// Хук для инициализации ACF блоков
add_action('acf/init', 'register_custom_acf_blocks');
