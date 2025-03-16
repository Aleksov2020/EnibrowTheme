<?php
if (!defined('ABSPATH')) exit; // Защита от прямого доступа

// Функция для регистрации всех ACF блоков
function register_custom_acf_blocks() {
    // Блок: Рекламный блок Enibrow
    acf_register_block_type(array(
        'name'              => 'enibrow_discount_block',
        'title'             => __('Рекламный блок Enibrow'),
        'description'       => __('Рекламный блок со скидкой и ссылкой на карты.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/enibrow-discount.php',
        'category'          => 'enibrow',
        'icon'              => 'megaphone',
        'keywords'          => array('скидка', 'реклама', 'карты'),
        'mode'              => 'edit', 
        'supports'          => array('align' => true, 'customClassName' => true),
    ));

    acf_register_block_type(array(
        'name'            => 'video_gallery',
        'title'           => __('Видео Галерея'),
        'description'     => __('Выводит видео, отмеченные как "показывать на сайте"'),
        'render_template' => get_template_directory() . '/template-parts/blocks/video-block.php',
        'category'        => 'enibrow',
        'icon'            => 'video-alt3',
        'keywords'        => array('video', 'gallery'),
        'supports'        => array(
            'align' => true,
        ),
    ));
    
    acf_register_block_type(array(
        'name'              => 'reviews_list',
        'title'             => __('Отзывы списком'),
        'description'       => __('Блок для отображения списка отзывов.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/reviews-list.php',
        'category'          => 'enibrow',
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
        'category'          => 'enibrow',
        'icon'              => 'slides',
        'keywords'          => array('отзывы', 'карусель'),
        'mode'              => 'edit',
        'supports'          => array('align' => true, 'customClassName' => true),
    ));
    
    acf_register_block_type(array(
            'name'              => 'masters-block',
            'title'             => __('Наши мастера'),
            'description'       => __('Блок для вывода списка мастеров.'),
            'render_template'   => 'template-parts/blocks/masters-block.php', // Путь к шаблону
            'category'          => 'enibrow',
            'icon'              => 'admin-users',
            'keywords'          => array('мастера', 'специалисты'),
            'supports'          => array('align' => false),
    ));

    acf_register_block_type(array(
        'name'            => 'colored-wrapper',
        'title'           => __('Цветная обертка'),
        'description'     => __('Контейнер для вложенных блоков'),
        'render_template' => get_template_directory() . '/template-parts/blocks/colored-wrapper.php',
        'category'        => 'enibrow',
        'icon'            => 'align-center',
        'keywords'        => array('контейнер', 'обертка', 'wrapper'),
        'supports'        => array(
            'align'   => false,
            'jsx'     => true,
        ),
    ));

    acf_register_block_type(array(
        'name'            => 'footer-block',
        'title'           => __('Футер'),
        'description'     => __('Блок для отображения футера с контактами и навигацией.'),
        'render_template' => get_template_directory() . '/template-parts/blocks/footer-block.php',
        'category'        => 'enibrow',
        'icon'            => 'admin-site',
        'keywords'        => array('footer', 'футер', 'подвал'),
        'supports'        => array(
            'align' => false,
            'mode'  => false,
            'jsx'   => true,
        ),
    ));
    

    acf_register_block_type(array(
        'name'              => 'roll-block',
        'title'             => __('Разворачиваемый текст', 'textdomain'),
        'description'       => __('Гибкий текстовый блок с возможностью сворачивания.', 'textdomain'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/roll-block.php',
        'category'          => 'enibrow', // Твоя кастомная категория блоков
        'icon'              => 'align-full-width',
        'keywords'          => array('разворачиваемый', 'текст', 'аккордеон'),
        'supports'          => array(
            'align'         => false,
            'mode'          => 'edit',
        ),
    ));

    // рекоммендации для услуг
    acf_register_block_type(array(
        'name'              => 'service-recommendations',
        'title'             => __('Рекомендации для услуги', 'textdomain'),
        'description'       => __('Блок с рекомендациями, связанными с услугой.', 'textdomain'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/service-recommendations.php',
        'category'          => 'enibrow',
        'icon'              => 'admin-comments',
        'keywords'          => array('рекомендации', 'услуга', 'статьи'),
        'supports'          => array(
            'align'         => false,
            'mode'          => 'edit',
        ),
    ));

    acf_register_block_type(array(
        'name' => 'gallery_block',
        'title' => __('Галерея работ', 'textdomain'),
        'description' => __('Галерея фотографий из портфолио мастеров', 'textdomain'),
        'render_template' => get_template_directory() . '/template-parts/blocks/gallery-block.php',
        'category' => 'enibrow',
        'icon' => 'images-alt2',
        'keywords' => array('галерея', 'фото', 'портфолио'),
        'mode' => 'edit',
    ));

    acf_register_block_type(array(
        'name'            => 'prices',
        'title'           => __('Таблица цен'),
        'description'     => __('Выводит таблицу с ценами мастеров на услуги.'),
        'render_template' => get_template_directory() . '/template-parts/blocks/prices.php',
        'category'        => 'enibrow',
        'icon'            => 'money-alt',
        'keywords'        => array('цены', 'стоимость', 'прайс'),
    ));



    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'custom_slider',
            'title'             => __('Слайдер'),
            'description'       => __('Блок для главного слайдера'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/slider-home-block.php',
            'category'          => 'formatting',
            'icon'              => 'images-alt2',
            'keywords'          => array('слайдер', 'карта', 'контакты'),
            'supports'          => array(
                'align'         => false,
                'jsx'           => true, // Позволяет ACF редактировать блок в Gutenberg
            ),
            'mode'              => 'edit', // Открывается сразу в редакторе
            'post_types'        => array('page'), // Ограничение по типу контента
        ));
    }
    
    
    acf_register_block_type(array(
        'name'              => 'category_list',
        'title'             => __('Категории услуг'),
        'description'       => __('Выводит категории с максимум 6 услугами'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/category-list-block.php',
        'category'          => 'enibrow',
        'icon'              => 'grid-view',
        'keywords'          => array('категории', 'услуги'),
        'supports'          => array(
            'align'         => false,
            'jsx'           => true,
        ),
        'post_types'        => array('page'),
    ));

    acf_register_block_type(array(
        'name'              => 'promotion_slider',
        'title'             => __('Акции'),
        'description'       => __('Выводит все акции'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/promotion-slider-block.php',
        'category'          => 'enibrow',
        'icon'              => 'tag',
        'keywords'          => array('акции', 'скидки', 'промо'),
        'supports'          => array(
            'align'         => false,
            'jsx'           => true,
        ),
        'mode'              => 'auto', // Блок всегда отображает контент
        'post_types'        => array('page'),
    ));


    acf_register_block_type(array(
        'name'              => 'blog_list',
        'title'             => __('Блог (4 записи)'),
        'description'       => __('Выводит последние записи блога'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/blog-list.php',
        'category'          => 'enibrow',
        'icon'              => 'admin-post',
        'keywords'          => array('блог', 'статьи', 'новости'),
        'supports'          => array('align' => false),
    ));
    
    acf_register_block_type(array(
        'name'              => 'service_to_show_category',
        'title'             => __('Связанные услуги категории', 'textdomain'),
        'description'       => __('Выводит услуги, связанные с текущей категорией', 'textdomain'),
        'render_template'   => '/template-parts/blocks/service-to-show-category.php',
        'category'          => 'enibrow',
        'icon'              => 'admin-tools',
        'keywords'          => array('услуги', 'категория', 'service'),
    ));
    

    acf_register_block_type(array(
        'name'            => 'portfolio_categories_block',
        'title'           => __('Галерея работ с фильтром', 'textdomain'),
        'description'     => __('Выводит категории портфолио для фильтрации'),
        'render_template' => get_template_directory() . '/template-parts/blocks/portfolio-categories.php',
        'category'        => 'enibrow',
        'icon'            => 'images-alt2',
        'keywords'        => array('portfolio', 'filter', 'gallery'),
        'supports'        => array(
            'align' => true,
        ),
    ));
    
    acf_register_block_type(array(
        'name'              => 'our_services',
        'title'             => __('Наши услуги'),
        'description'       => __('Выводит выбранные 4 услуги.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/our-services.php',
        'category'          => 'enibrow',
        'icon'              => 'admin-tools',
        'keywords'          => array('услуги', 'сервис', 'предложения'),
        'mode'              => 'auto',
        'supports'          => array(
            'align'         => false,
            'mode'          => false,
            'jsx'           => true
        )
    ));
}




// Хук для инициализации ACF блоков
add_action('acf/init', 'register_custom_acf_blocks');

function register_custom_block_category($categories, $post) {
    return array_merge(
        array(
            array(
                'slug'  => 'enibrow',
                'title' => __('Блоки Enibrow', 'textdomain'),
                'icon'  => 'layout'
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'register_custom_block_category', 10, 2);