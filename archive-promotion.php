<?php
get_header();
?>
<div class="main-wrapper page-sale-archive-wrapper col">
    <div class="sale-archive-page page wrapper col">
        <!-- Хлебные крошки -->
        <div class="page-title-wrapper col">
            <div class="breadcrumbs row">
                <div class="breabcrumbs-page-name light-text-300">
                    <a href="<?php echo home_url(); ?>">Главная</a>
                </div>
                <div class="breabcrumbs-separator"></div>
                <div class="breabcrumbs-page-name light-text-300 active">
                    Акции
                </div>
            </div>
            
            <!-- Заголовок -->
            <div class="title">
                <h1 class="sale-archive-page-title">Акции в студии Enibrow</h1>
            </div>

            <!-- Описание страницы -->
            <div class="page-subtitle text-16-300">
                Перманентный татуаж бровей известен с 70-х годов XX века, и за столь долгий срок появилось множество техник данной процедуры. Стоит рассмотреть подробней каждый из видов, чтобы знать больше об их преимуществах, недостатках и особенностях.
            </div>
        </div>

        <!-- Список акций -->
        <section class="sale-list col">
            <?php
            $promotions = new WP_Query(array(
                'post_type'      => 'promotion',
                'posts_per_page' => -1, // Выводим все акции
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($promotions->have_posts()) :
                while ($promotions->have_posts()) : $promotions->the_post();
                    $discount = get_field('promotion_discount'); // Поле скидки
                    $image    = get_field('promotion_image');    // Поле изображения
            ?>
                <div class="discont discont-sale-archive-item row">
                    <div class="discont-text-wrapper col">
                        <div class="discont-title">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="discont-subtitle text-16-300">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if ($discount) : ?>
                            <div class="discont-value">
                                скидка <?php echo esc_html($discount); ?> рублей
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="discont-slider row">
                        <div class="discont-filter row">
                            <div class="discont-slide col">
                                <a href="<?php the_permalink(); ?>" class="button button-primary-hover">
                                    Подробнее об акции
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/iconQuestionPrimary.svg" alt="question" width="15" height="15">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>На данный момент акций нет.</p>';
            endif;
            ?>
        </section>
    </div>

    <?php
        // Попробуем загрузить контент из страницы с ID, чтобы редактировать в Gutenberg
        $page = get_page_by_path('archive-promotions'); 
        if ($page) {
            echo apply_filters('the_content', $page->post_content);
        }
    ?>
</div>
<?php get_footer(); ?>
