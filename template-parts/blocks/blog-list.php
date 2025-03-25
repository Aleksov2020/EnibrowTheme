<?php
$posts = get_posts(array(
    'post_type'      => 'blog',
    'posts_per_page' => 4, // Количество выводимых статей
));

if ($posts) :
?>
    <div class="blog wrapper wrapper-laptop col">
        <div class="blog-wrapper row">
            <?php foreach ($posts as $post) :
                setup_postdata($post);
                $views = get_field('blog_views', $post->ID) ?: 0;
                $read_time = get_field('blog_read_time', $post->ID) ?: 5;
                $date = get_the_date('d.m.Y', $post->ID);
                $title = get_the_title($post->ID);
                $permalink = get_permalink($post->ID);
                $thumbnail = get_field('blog_image', $post->ID);
            ?>
                <div class="blog-item col">
                    <div class="blog-item-photo col" style="background-image: url('<?php echo esc_url($thumbnail['url']); ?>');">
                        <div class="blog-item-counters-wrapper text-16-300 row">
                            <div class="blog-item-counter-wrapper row">
                                <div class="blog-item-counter-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/iconViewsCount.svg" width="20" height="15" alt="views">
                                </div>
                                <div class="blog-item-counter-value">
                                    <?php echo esc_html($views); ?>
                                </div>
                            </div>
                            <div class="blog-item-date-wrapper row">
                                <div class="blog-item-date-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/iconCalendar.svg" width="16" height="16" alt="calendar">
                                </div>
                                <div class="blog-item-date-value">
                                    <?php echo esc_html($date); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item-text-wrapper col">
                        <div class="blog-item-title colored-text">
                            <?php echo esc_html($title); ?>
                        </div>
                        <div class="blog-item-buttons-wrapper col">
                            <div class="blog-item-time-read-wrapper row">
                                <div class="blog-item-time-read-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/clockIcon.svg" width="17" height="17" alt="clock">
                                </div>
                                <div class="blog-item-time-read-value light-text">
                                    Время чтения <?php echo esc_html($read_time); ?> минут
                                </div>
                            </div>
                            <a href="<?php echo esc_url($permalink); ?>" class="button button-bordered button-hover-white">
                                Читать статью
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="/blog" class="button button-primary all-blog-items">
            Список всех статей
        </a>
    </div>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p>Статей пока нет.</p>
<?php endif; ?>
