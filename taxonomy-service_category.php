<?php get_header(); ?>

<?php
$category_name = get_field('category_full_name', get_queried_object());
$category_subtitle = get_field('category_subtitle', get_queried_object());
$category_duration = get_field('category_duration', get_queried_object());
$category_price_from = get_field('category_price_from', get_queried_object());
$category_persistence = get_field('category_persistence', get_queried_object());

// Получаем 7 работ из портфолио, которые отмечены для слайдера
$args = array(
    'post_type'      => 'portfolio_work',
    'posts_per_page' => 7, // Ограничиваем до 7
    'meta_query'     => array(
        array(
            'key'   => 'portfolio_slider',
            'value' => '1',
            'compare' => '='
        )
    )
);
$portfolio_query = new WP_Query($args);
?>
<div class="main-wrapper col service-page-wrapper">
    <div class="colored-wrapper slider-page-service-wrapper col">
        <div class="service-slider row wrapper">
            <div class="service-slider-left col">
                <div class="breadcrumbs row">
                    <div class="breabcrumbs-page-name light-text-300">
                        <a href="<?php echo site_url(); ?>">Главная</a>
                    </div>
                    <div class="breabcrumbs-separator"></div>
                    <div class="breabcrumbs-page-name light-text-300 active">
                        <?php echo esc_html($category_name); ?>
                    </div>
                </div>

                <div class="title">
                    <div class="title__page"><?php echo esc_html($category_name); ?></div>
                </div>

                <div class="subtitle-wrapper row">
                    <div class="spacer"></div>
                    <div class="slider-subtitle text-16-300">
                        <?php echo esc_html($category_subtitle); ?>
                    </div>
                </div>

                <div class="cons-wrapper row">
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/smart-watch.png" width="40" height="40"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php echo esc_html($category_duration); ?>
                        </div>
                    </div>
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/coins.png" width="35" height="38"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php echo esc_html($category_price_from); ?>
                        </div>
                    </div>
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/birds.png" width="46" height="34"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php echo esc_html($category_persistence); ?>
                        </div>
                    </div>
                </div>

                <div class="service-slider-form-wrapper col">
                    <div class="service-slider-form-title colored-text">
                        Записаться на процедуру
                    </div>
                    <div class="form-slider row">
                        <input class="input-default" type="text" placeholder="Ваше имя">
                        <input class="input-default" type="text" placeholder="+7 000 000 00 00 00">
                        <div class="button button-primary"> Отправить </div>
                    </div>
                    <div class="checkbox-wrapper row">
                        <div class="checkbox checked"></div>
                        <div class="checkbox-label">
                            Нажимая кнопку, вы даёте согласие на обработку персональных данных и соглашаетесь с <span>политикой конфиденциальности</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-slider-right row">
                <div class="service-page-slider-wrapper row">
                    <div class="service-page-slider-track row">
                        <?php if ($portfolio_query->have_posts()): ?>
                            <?php while ($portfolio_query->have_posts()): $portfolio_query->the_post(); ?>
                                <?php 
                                    $portfolio_image = get_field('portfolio_image'); 
                                    if ($portfolio_image): 
                                ?>
                                    <div class="service-page-slide">
                                        <img src="<?php echo esc_url($portfolio_image['url']); ?>" alt="<?php the_title(); ?>" width="358" height="614">
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else: ?>
                            <p>Нет доступных работ для слайдера.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="service-page-slider-button-wrapper row">
                    <div class="service-page-slider-button prev-button clickable">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="service-page-slider-button next-button clickable">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

$page_slug = 'tatyazh'; // Укажите слаг нужной страницы
$page = get_page_by_path($page_slug, OBJECT, 'page'); // Получаем объект страницы

if ($page) {
    $page_content = apply_filters('the_content', get_post_field('post_content', $page->ID));
    echo '<div class="page-content">' . $page_content . '</div>';
} else {
    echo '<p>Страница не найдена.</p>';
}

?>
</div>
<?php get_footer(); ?>
