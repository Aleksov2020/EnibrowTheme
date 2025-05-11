<?php get_header(); ?>

<?php
// Получаем ACF-поля
$blog_views = get_field('blog_views') ?: 0;
$blog_read_time = get_field('blog_read_time') ?: 5;
$blog_image = get_field('blog_image');
$blog_date = get_the_date('d.m.Y');
$blog_tags = get_the_terms(get_the_ID(), 'post_tag'); // Получаем теги

$bread = get_field('bread', get_the_ID()); 
?>

<?php
// Добавляем ID для заголовков H2
function add_ids_to_h2($content) {
    $matches = array();
    preg_match_all('/<h2[^>]*>(.*?)<\/h2>/i', $content, $matches);
    if (!empty($matches[1])) {
        foreach ($matches[1] as $index => $title) {
            $id = 'section-' . ($index + 1);
            $content = str_replace($matches[0][$index], '<h2 id="' . esc_attr($id) . '">' . $title . '</h2>', $content);
        }
    }
    return $content;
}
add_filter('the_content', 'add_ids_to_h2');?>
    <div class="main-wrapper page-blog-wrapper col">
    <div class="colored-wrapper col">
        <div class="blog-page-slider wrapper row">
            <div class="blog-page-slider-left page col">
                <div class="page-title-wrapper col">
                    <div class="breadcrumbs row">
                        <div class="breabcrumbs-page-name light-text-300">
                            <a href="<?php echo home_url(); ?>">Главная</a>
                        </div>
                        <div class="breabcrumbs-separator"></div>
                        <div class="breabcrumbs-page-name light-text-300">
                            <a href="/blog-page/"> Блог </a>
                        </div>
                        <div class="breabcrumbs-separator"></div>
                        <div class="breabcrumbs-page-name light-text-300 active">
                            <?php echo $bread; ?> 
                        </div>
                    </div>

                    <div class="title">
                        <div class="blog-page-title">
                            <?php the_title(); ?>
                        </div>
                    </div>

                    <div class="blog-page-title-info-wrapper row">
                        <div class="blog-page-info-date light-text-300">
                            Дата создания: <?php echo esc_html($blog_date); ?>
                        </div>
                        <div class="blog-page-info-tags light-text-300">
                            Теги: 
                            <?php 
                            if ($blog_tags) {
                                $tag_list = array_map(function($tag) {
                                    return '<a href="' . get_term_link($tag) . '">' . esc_html($tag->name) . '</a>';
                                }, $blog_tags);
                                echo implode(', ', $tag_list);
                            } else {
                                echo 'Нет тегов';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="blog-page-title-footer row">
                        <div class="blog-page-views-wrapper row">
                            <div class="blog-page-views-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/iconViews.svg" alt="views" width="20" height="15">
                            </div>
                            <div class="blog-page-views-label text-16-300">
                                <?php echo esc_html($blog_views); ?>
                            </div>
                        </div>
                        <div class="blog-page-views-wrapper row">
                            <div class="blog-page-views-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/clockIcon.svg" alt="views" width="17" height="17">
                            </div>
                            <div class="blog-page-views-label text-16-300">
                                Время чтения <?php echo esc_html($blog_read_time); ?> минут
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="blog-page-slider-right">
                <?php if (!empty($blog_image)) : ?>
                    <img src="<?php echo esc_url($blog_image['url']); ?>" alt="<?php echo esc_attr($blog_image['alt']); ?>" width="720" height="500">
                <?php endif; ?>
            </div>

            <div class="blog-page-title-footer-tablet row">
                <div class="blog-page-views-wrapper row">
                    <div class="blog-page-views-icon icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/iconViews.svg" alt="views" width="20" height="15">
                    </div>
                    <div class="blog-page-views-label text-16-300">
                        <?php echo esc_html($blog_views); ?>
                    </div>
                </div>
                <div class="blog-page-views-wrapper row">
                    <div class="blog-page-views-icon icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/clockIcon.svg" alt="views" width="17" height="17">
                    </div>
                    <div class="blog-page-views-label text-16-300">
                        Время чтения <?php echo esc_html($blog_read_time); ?> минут
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php the_content(); ?>

    
</div>
<?php get_footer(); ?>
