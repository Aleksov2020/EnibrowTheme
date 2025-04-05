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


// add_action('template_redirect', function() {
//   error_log('Template: ' . basename(get_page_template()));
// });

// global $post;
// error_log('Current page ID: ' . get_the_ID());
// error_log('Current page title: ' . get_the_title());

// add_action('pre_get_posts', function($query) {
//   if ($query->is_main_query()) {
//       error_log('Main Query Vars: ' . print_r($query->query_vars, true));
//   }
// });



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

// Регистрация CPT "Категория услуги"
register_post_type('uslyga_category', array(
  'labels' => array(
      'name' => 'Категории услуг',
      'singular_name' => 'Категория услуги'
  ),
  'public' => true,
  'show_in_rest' => true,
  'hierarchical' => false,
  'has_archive' => false,
  'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
));

// Регистрация CPT "Услуга"
register_post_type('uslyga', array(
  'labels' => array(
      'name' => 'Услуги',
      'singular_name' => 'Услуга'
  ),
  'public' => true,
  'show_in_rest' => true,
  'has_archive' => false,
  'rewrite' => array('slug' => '%uslyga_category%', 'with_front' => false),
  'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
));


add_filter('post_type_link', function($post_link, $post) {

  if ($post->post_type === 'uslyga') {
      // Получаем ID связанной категории из произвольного поля (ACF post_object)
      $category_id = get_field('usl_cat_field', $post->ID);

      if ($category_id) {
          $category_post = get_post($category_id);
          $cat_slug = $category_post ? $category_post->post_name : '';
          // Заменяем плейсхолдер категории на её slug
          $post_link = str_replace('%uslyga_category%', $cat_slug, $post_link);
      }
  }

  if ($post->post_type === 'uslyga_category') {
      // Получаем ID связанной категории из произвольного поля (ACF post_object)
      // error_log('uslyga_category');
      // error_log($post_link);

      $post_link = str_replace('uslyga_category', '', $post_link);
  }

  return $post_link;
}, 10, 2);

// Перезапись ссылок для CPT
function custom_post_type_link($post_link, $post) {
  if ($post->post_type === 'master') {
      return home_url('/master/' . $post->post_name . '/');
  }
  if ($post->post_type === 'faq') {
      return home_url('/faq/' . $post->post_name . '/');
  }
  return $post_link;
}
add_filter('post_type_link', 'custom_post_type_link', 10, 2);

// Кастомные правила перезаписи
function custom_rewrite_rules() {
  add_rewrite_rule('^master/([^/]+)/?$', 'index.php?post_type=master&name=$matches[1]', 'top');
  add_rewrite_rule('^faq/([^/]+)/?$', 'index.php?post_type=faq&name=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_rules');

add_rewrite_rule(
  '^([^/]+)/?$',
  'index.php?pagename=$matches[1]',
  'top'
);

add_rewrite_rule(
  '^([^/]+)/([^/]+)/?$',
  'index.php?pagename=$matches[1]/$matches[2]',
  'top'
);

add_rewrite_rule(
  '^([^/]+)/([^/]+)/([^/]+)/?$',
  'index.php?pagename=$matches[1]/$matches[2]/$matches[3]',
  'top'
);

add_rewrite_rule(
  '^([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$',
  'index.php?pagename=$matches[1]/$matches[2]/$matches[3]/$matches[4]',
  'top'
);

add_rewrite_rule(
  '^([^/]+)/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$',
  'index.php?pagename=$matches[1]/$matches[2]/$matches[3]/$matches[4]/$matches[5]',
  'top'
);

// страница настроек сайта
acf_add_options_page(array(
  'page_title' => 'Настройки сайта',
  'menu_title' => 'Настройки сайта',
  'menu_slug'  => 'site-settings',
  'capability' => 'edit_posts',
  'redirect'   => false
));

// Подключаем файлы
//require_once get_template_directory() . '/include/permalinks.php';
require_once get_template_directory() . '/include/post-types.php';
require_once get_template_directory() . '/include/acf-blocks.php';
require_once get_template_directory() . '/include/acf-fields.php';
require_once get_template_directory() . '/include/ajax-requests.php';
require_once get_template_directory() . '/include/orders.php';
