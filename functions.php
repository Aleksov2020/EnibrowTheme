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
}, 
10, 
2);

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
error_log('Current page title: ' . get_the_title());

add_action('pre_get_posts', function($query) {
  if ($query->is_main_query()) {
      error_log('Main Query Vars: ' . print_r($query->query_vars, true));
  }
});

// Функция для получения данных мастеров
function get_masters_data() {
  $masters = get_posts([
      'post_type' => 'master',
      'posts_per_page' => -1,
      'meta_query' => [
          [
              'key' => 'master_show_global',
              'value' => '1',
              'compare' => '='
          ]
      ]
  ]);

  $masters_data = array_map(function ($master) {
      $photo = get_field('master_photo', $master->ID);
      $photo_url = !empty($photo) ? $photo['url'] : get_template_directory_uri() . '/assets/avatar-placeholder.png';

      return [
          'id' => $master->ID,
          'name' => get_the_title($master->ID),
          'rank' => get_field('master_rank', $master->ID),
          'photo' => $photo_url,
      ];
  }, $masters);

  return $masters_data;
}

// Функция для получения данных услуг
function get_services_data() {
  $categories = get_terms([
      'taxonomy' => 'tax_uslyga',
      'hide_empty' => false,
  ]);

  $services_data = [];
  foreach ($categories as $category) {
      $services = get_posts([
          'post_type' => 'uslyga',
          'posts_per_page' => -1,
          'tax_query' => [
              [
                  'taxonomy' => 'tax_uslyga',
                  'field' => 'term_id',
                  'terms' => $category->term_id,
              ]
          ],
      ]);

      $services_list = array_map(function ($service) {
          $portfolio_works = get_field('service_portfolio_works', $service->ID);

          // Проверяем наличие массива и его содержимое
          if (is_array($portfolio_works) && !empty($portfolio_works)) {
              $last_work_id = end($portfolio_works);
              $image_data = get_field('portfolio_image', $last_work_id);
              $image = !empty($image_data) ? $image_data['url'] : get_template_directory_uri() . '/assets/avatar-placeholder.png';
          } else {
              $image = get_template_directory_uri() . '/assets/avatar-placeholder.png';
          }

          return [
              'id' => $service->ID,
              'name' => get_the_title($service->ID),
              'image' => $image,
          ];
      }, $services);

      $services_data[] = [
          'name' => $category->name,
          'services' => $services_list,
      ];
  }

  return $services_data;
}

// Подключаем скрипты с передачей данных мастеров и услуг
function enqueue_custom_scripts() {
  wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/order.js', ['jquery'], null, true);

  // Передаем данные мастеров в JavaScript
  wp_localize_script('custom-js', 'mastersData', get_masters_data());
  wp_localize_script('custom-js', 'servicesData', get_services_data());
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


acf_add_local_field_group(array(
  'key' => 'group_404_page',
  'title' => 'Настройки страницы 404',
  'fields' => array(
      array(
          'key' => 'field_404_page',
          'label' => 'Страница 404',
          'name' => '404_page',
          'type' => 'post_object',
          'post_type' => array('page'),
          'return_format' => 'id',
          'ui' => 1,
      ),
  ),
  'location' => array(
      array(
          array(
              'param' => 'options_page',
              'operator' => '==',
              'value' => 'acf-options',
          ),
      ),
  ),
));

acf_add_options_page(array(
  'page_title' => 'Настройки темы',
  'menu_title' => 'Настройки темы',
  'menu_slug' => 'theme-settings',
  'capability' => 'edit_posts',
  'redirect' => false
));

// Подключаем файлы
require_once get_template_directory() . '/include/permalinks.php';
require_once get_template_directory() . '/include/post-types.php';
require_once get_template_directory() . '/include/acf-blocks.php';
require_once get_template_directory() . '/include/acf-fields.php';
require_once get_template_directory() . '/include/ajax-requests.php';
