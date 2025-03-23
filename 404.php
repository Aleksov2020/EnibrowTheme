<?php
get_header();

// Получаем ID страницы 404 из настроек
$custom_404_page_id = get_field('404_page', 'option');

// Если страница не задана или не найдена, отображаем стандартное сообщение
if ($custom_404_page_id) {
    $post = get_post($custom_404_page_id);
    setup_postdata($post);
    ?>
    <div class="custom-404-page">
        <?php the_content(); ?>
    </div>
    <?php
    wp_reset_postdata();
} else {
    ?>
    <div class="custom-404-page">
        <h1>Страница не найдена</h1>
        <p>Извините, но страница, которую вы искали, не существует.</p>
    </div>
    <?php
}

get_footer();
