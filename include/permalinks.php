<?php
// Кастомные пермалинки для услуг
function uslyga_permalink($permalink, $post) {
    if ($post->post_type === 'uslyga') {
        $terms = wp_get_post_terms($post->ID, 'tax_uslyga');
        if (!empty($terms) && !is_wp_error($terms)) {
            $term_slug = $terms[0]->slug;
            $permalink = home_url('/' . $term_slug . '/' . $post->post_name . '/');
        }
    } elseif ($post->post_type === 'blog') {
        // Для записей типа "blog"
        $permalink = home_url('/blog/' . $post->post_name . '/');
    } elseif ($post->post_type === 'master') {
        // Для записей типа "master"
        $permalink = home_url('/master/' . $post->post_name . '/');
    }
    return $permalink;
}
add_filter('post_type_link', 'uslyga_permalink', 10, 2);

// Кастомные правила перезаписи URL
function custom_rewrite_rules() {
    // Жестко заданные страницы
    $static_pages = array(
        'questions',
        'promotions',
        'videos',
        'master',
        'about',
        'reviews-page',
        'portfolio',
        'prices',
        'blog-page'
    );

    // Правила для жестко заданных страниц
    foreach ($static_pages as $page) {
        // Основная страница (например: /questions/)
        add_rewrite_rule(
            '^' . $page . '/?$',
            'index.php?pagename=' . $page,
            'top'
        );

        // Подстраницы (например: /questions/example/)
        add_rewrite_rule(
            '^' . $page . '/([^/]+)/?$',
            'index.php?pagename=' . $page . '/$matches[1]',
            'top'
        );
    }

    // Правила для категорий услуг (пример: /category/)
    add_rewrite_rule(
        '^cat_uslyga/([^/]+)/?$',
        'index.php?cat_uslyga=$matches[1]',
        'top'
    );

    // Правило для записей типа "blog" (например: /blog-page/имя-записи/)
    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?post_type=blog&name=$matches[1]',
        'top'
    );

    // Правило для записей типа "blog" (например: /master/имя-записи/)
    add_rewrite_rule(
        '^master/([^/]+)/?$',
        'index.php?post_type=master&name=$matches[1]',
        'top'
    );

    // Правила для услуг с категорией (пример: /category/service/)
    add_rewrite_rule(
        '^([^/]+)/([^/]+)/?$',
        'index.php?uslyga=$matches[2]&tax_uslyga=$matches[1]',
        'top'
    );

    // Правила для любых страниц (чтобы поддерживать одиночные страницы)
    add_rewrite_rule(
        '^([^/]+)/?$',
        'index.php?pagename=$matches[1]',
        'bottom'
    );
}
add_action('init', 'custom_rewrite_rules');

// Сброс перезаписей при активации
function flush_rewrite_rules_on_activation() {
    register_uslyga();
    register_cat_uslyga();
    register_tax_uslyga();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flush_rewrite_rules_on_activation');

// Сброс перезаписей при деактивации
function flush_rewrite_rules_on_deactivation() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'flush_rewrite_rules_on_deactivation');
?>
