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
        'supports'           => array('thumbnail', 'excerpt'),
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
        'rewrite'            => array('slug' => 'reviews'),
        'show_in_rest'       => true, // Поддержка Gutenberg
    );

    register_post_type('reviews', $args);
}

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
        'labels' => array(
            'name'          => 'Услуги',
            'singular_name' => 'Услуга',
            'menu_name'     => 'Услуги'
        ),
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // Поддержка Gutenberg
        'supports'     => array('title', 'editor', 'thumbnail'), // Заголовок, описание, миниатюра
        'menu_icon'    => 'dashicons-admin-tools',
    );
    register_post_type('service', $args);
}


// Регистрация Post Type: Категория услуг
function register_service_category_post_type() {
    $args = array(
        'labels' => array(
            'name'          => 'Категории услуг',
            'singular_name' => 'Категория услуг',
            'menu_name'     => 'Категории услуг'
        ),
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // Для поддержки Gutenberg
        'supports'     => array('title', 'editor'), // Заголовок и описание
        'menu_icon'    => 'dashicons-list-view', // Иконка в меню WP
    );
    register_post_type('service_category', $args);
}

// Регистрация таксономии: Категория услуг
function register_service_category_taxonomy() {
    $args = array(
        'labels' => array(
            'name'          => 'Категории услуг',
            'singular_name' => 'Категория услуги',
            'menu_name'     => 'Категории услуг'
        ),
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true, // Поддержка Gutenberg
        'hierarchical' => true, // Древовидная структура
    );
    register_taxonomy('service_category', 'service', $args);
}
add_action('init', 'register_service_category_taxonomy');


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



add_action('init', 'register_portfolio_work_post_type');
add_action('init', 'register_service_category_post_type');
add_action('init', 'register_recommendation_post_type');
add_action('init', 'register_reviews_post_type');
add_action('init', 'register_master_post_type');
add_action('init', 'register_service_post_type');
add_action('init', 'register_video_post_type');
