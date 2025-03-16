<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit;
}

function register_video_post_type() {
    $labels = array(
        'name'               => 'Видеозаписи',
        'singular_name'      => 'Видеозапись',
        'menu_name'          => 'Видеозаписи',
        'name_admin_bar'     => 'Видеозапись',
        'add_new'            => 'Добавить новую',
        'add_new_item'       => 'Добавить новую видеозапись',
        'new_item'           => 'Новая видеозапись',
        'edit_item'          => 'Редактировать видеозапись',
        'view_item'          => 'Просмотреть видеозапись',
        'all_items'          => 'Все видеозаписи',
        'search_items'       => 'Искать видеозаписи',
        'not_found'          => 'Не найдено',
        'not_found_in_trash' => 'Не найдено в корзине'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'video'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-video-alt3',
        'supports'           => array('title', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('video', $args);
}

function register_master_post_type() {
    $args = array(
        'labels' => array(
            'name'          => 'Мастера',
            'singular_name' => 'Мастер',
            'menu_name'     => 'Мастера'
        ),
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // Включает поддержку Gutenberg
        'supports'     => array('title', 'thumbnail', 'editor'), // Поддержка заголовка, миниатюры и описания
        'menu_icon'    => 'dashicons-admin-users',
    );
    register_post_type('master', $args);
}

function register_reviews_post_type() {
    $labels = array(
        'name'               => 'Отзывы',
        'singular_name'      => 'Отзыв',
        'menu_name'          => 'Отзывы',
        'name_admin_bar'     => 'Отзыв',
        'add_new'            => 'Добавить новый',
        'add_new_item'       => 'Добавить новый отзыв',
        'new_item'           => 'Новый отзыв',
        'edit_item'          => 'Редактировать отзыв',
        'view_item'          => 'Просмотреть отзыв',
        'all_items'          => 'Все отзывы',
        'search_items'       => 'Искать отзывы',
        'not_found'          => 'Отзывы не найдены',
        'not_found_in_trash' => 'В корзине нет отзывов'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true, // Поддержка Gutenberg
    );

    register_post_type('reviews', $args);
}

// блок яндекс карт
function register_recommendation_post_type() {
    $labels = array(
        'name'               => 'Рекомендации',
        'singular_name'      => 'Рекомендация',
        'menu_name'          => 'Рекомендации',
        'name_admin_bar'     => 'Рекомендация',
        'add_new'            => 'Добавить рекомендацию',
        'add_new_item'       => 'Добавить новую рекомендацию',
        'new_item'           => 'Новая рекомендация',
        'edit_item'          => 'Редактировать рекомендацию',
        'view_item'          => 'Просмотреть рекомендацию',
        'all_items'          => 'Все рекомендации',
        'search_items'       => 'Искать рекомендации',
        'not_found'          => 'Рекомендации не найдены.',
        'not_found_in_trash' => 'В корзине нет рекомендаций.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true, // Поддержка Gutenberg
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-lightbulb', // Иконка для админ-панели
        'supports'           => array('title'), // Поддержка заголовков
        'has_archive'        => false,
    );

    register_post_type('recommendation', $args);
}

// Регистрация Post Type: Услуга
function register_service_post_type() {
    $args = array(
        'labels'      => array(
            'name'          => 'Услуги',
            'singular_name' => 'Услуга',
            'menu_name'     => 'Услуги'
        ),
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports'     => array('title', 'editor', 'thumbnail'),
        'menu_icon'    => 'dashicons-hammer',
        'rewrite'       => array('slug' => 'services', 'with_front' => false),
    );
    register_post_type('service', $args);
}

function register_service_category_post_type() {
    $labels = array(
        'name'          => 'Категории услуг',
        'singular_name' => 'Категория услуги',
        'menu_name'     => 'Категории услуг',
        'all_items'     => 'Все категории',
        'add_new'       => 'Добавить категорию',
        'add_new_item'  => 'Добавить новую категорию',
        'edit_item'     => 'Редактировать категорию',
        'view_item'     => 'Просмотреть категорию',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true, // Включает Gutenberg
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'services', 'with_front' => false),
    );

    register_post_type('service_category', $args);
}
add_action('init', 'register_service_category_post_type');

//сервис категория
function register_service_category_taxonomy() {
    $args = array(
        'labels'            => array(
            'name'          => 'Категории услуг',
            'singular_name' => 'Категория услуги',
            'menu_name'     => 'Категории услуг'
        ),
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'services'),
    );
    register_taxonomy('service_category', array('service'), $args);
}



// Регистрация Post Type: Работа портфолио
function register_portfolio_work_post_type() {
    $args = array(
        'labels' => array(
            'name'          => 'Портфолио',
            'singular_name' => 'Работа портфолио',
            'menu_name'     => 'Портфолио'
        ),
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // Включает поддержку Gutenberg
        'supports'     => array('title', 'thumbnail'), // Заголовок и миниатюра
        'menu_icon'    => 'dashicons-format-gallery', // Иконка в меню WP
    );
    register_post_type('portfolio_work', $args);
}

//Акции
function register_promotion_post_type() {
    $labels = array(
        'name'               => 'Акции',
        'singular_name'      => 'Акция',
        'menu_name'          => 'Акции',
        'name_admin_bar'     => 'Акцию',
        'add_new'            => 'Добавить новую',
        'add_new_item'       => 'Добавить новую акцию',
        'new_item'           => 'Новая акция',
        'edit_item'          => 'Редактировать акцию',
        'view_item'          => 'Просмотреть акцию',
        'all_items'          => 'Все акции',
        'search_items'       => 'Найти акцию',
        'not_found'          => 'Акции не найдены',
        'not_found_in_trash' => 'В корзине акций не найдено'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'rewrite'            => array('slug' => 'archive-promotions', 'with_front' => false),
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-tag',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // Подключаем Gutenberg
    );

    register_post_type('promotion', $args);
}
add_action('init', 'register_promotion_post_type');

//Блог
function register_blog_post_type() {
    $labels = array(
        'name'               => 'Блог',
        'singular_name'      => 'Статья',
        'menu_name'          => 'Блог',
        'name_admin_bar'     => 'Статья',
        'add_new'            => 'Добавить новую',
        'add_new_item'       => 'Добавить новую статью',
        'new_item'           => 'Новая статья',
        'edit_item'          => 'Редактировать статью',
        'view_item'          => 'Просмотреть статью',
        'all_items'          => 'Все статьи',
        'search_items'       => 'Искать статьи',
        'not_found'          => 'Статьи не найдены',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'hierarchical'       => true, // Включаем иерархию (дочерние записи)
        'has_archive'        => false, // Отключаем архив, чтобы он не конфликтовал
        'menu_icon'          => 'dashicons-welcome-write-blog',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
        'rewrite' => array(
            //'slug'          => 'blog-page',
            'with_front'    => false,
            'hierarchical'  => true, // Включаем вложенные ссылки
        ),
    );

    register_post_type('blog', $args);
}

function register_faq_post_type() {
    $labels = array(
        'name'               => 'Вопросы',
        'singular_name'      => 'Вопрос',
        'menu_name'          => 'Вопросы',
        'name_admin_bar'     => 'Вопрос',
        'add_new'            => 'Добавить новый',
        'add_new_item'       => 'Добавить новый вопрос',
        'new_item'           => 'Новый вопрос',
        'edit_item'          => 'Редактировать вопрос',
        'view_item'          => 'Просмотреть вопрос',
        'all_items'          => 'Все вопросы',
        'search_items'       => 'Искать вопросы',
        'not_found'          => 'Вопросы не найдены',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
        'rewrite' => array(
        //    'slug' => 'questions',
        ),
    );

    register_post_type('faq', $args);
}

add_action('init', 'register_faq_post_type');
add_action('init', 'register_blog_post_type');
add_action('init', 'register_service_category_taxonomy');
add_action('init', 'register_portfolio_work_post_type');
add_action('init', 'register_recommendation_post_type');
add_action('init', 'register_reviews_post_type');
add_action('init', 'register_master_post_type');
add_action('init', 'register_service_post_type');
add_action('init', 'register_video_post_type');
