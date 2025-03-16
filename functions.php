<?php
// Подключение CSS и JS
function mytheme_enqueue_scripts() {
  // Подключаем style.css темы
  wp_enqueue_style('enibrow-style', get_stylesheet_uri());

  // Подключаем свой скрипт
  wp_enqueue_script('enibrow-script', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
  wp_enqueue_style('google-fonts-montesserat', 'https://fonts.googleapis.com/css2?family=Oranienbaum&display=swap', false);
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', false);

}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

function enqueue_admin_block_styles() {
  wp_enqueue_style('editor-styles', get_template_directory_uri() . '/admin-style.css', array(), '1.0', 'all');
}
add_action('enqueue_block_editor_assets', 'enqueue_admin_block_styles');

// Регистрируем меню
function mytheme_register_menus() {
  register_nav_menus(array(
    'main_menu' => 'Главное меню',
    'footer_menu' => 'Меню в подвале'
  ));
}
add_action('init', 'mytheme_register_menus');

// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit;
}


function add_master_columns($columns) {
  $columns['show_global'] = 'Глобальный показ';
  return $columns;
}
add_filter('manage_master_posts_columns', 'add_master_columns');

function show_master_columns($column, $post_id) {
  if ($column == 'show_global') {
      $value = get_field('master_show_global', $post_id);
      echo $value ? '✅' : '❌';
  }
}
add_action('manage_master_posts_custom_column', 'show_master_columns', 10, 2);

function allow_svg_upload($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');


// Добавление колонки с изображением в список записей "Портфолио"
add_filter('manage_portfolio_work_posts_columns', function($columns) {
  $columns['portfolio_image'] = 'Фото работы';
  return $columns;
});

// Заполнение колонки с изображением
add_action('manage_portfolio_work_posts_custom_column', function($column, $post_id) {
  if ($column === 'portfolio_image') {
      $image = get_field('portfolio_image', $post_id);
      if ($image) {
          echo '<img src="' . esc_url($image['sizes']['thumbnail']) . '" style="width: 80px; height: auto;" />';
      } else {
          echo '—';
      }
  }
}, 10, 2);

// Убедимся, что колонка сортируемая (опционально)
add_filter('manage_edit-portfolio_work_sortable_columns', function($columns) {
  $columns['portfolio_image'] = 'portfolio_image';
  return $columns;
});


add_action('template_redirect', function() {
  error_log('Template: ' . basename(get_page_template()));
});

global $post;
error_log('Current page ID: ' . get_the_ID());
error_log('Current page slug: ' . $post->post_name);
error_log('Current page title: ' . get_the_title());

add_action('pre_get_posts', function($query) {
  if ($query->is_main_query()) {
      error_log('Main Query Vars: ' . print_r($query->query_vars, true));
  }
});





// Подключаем файлы
require_once get_template_directory() . '/include/post-types.php';
require_once get_template_directory() . '/include/acf-blocks.php';
require_once get_template_directory() . '/include/acf-fields.php';
require_once get_template_directory() . '/include/ajax-requests.php';
