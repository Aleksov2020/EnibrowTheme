<?php
/**
 * Template Name: Наши услуги
 * Template Post Type: page
 */

get_header(); ?>

<div class="main-wrapper page-index-wrapper col">

<?php
/**
 * Template Name: Портфолио
 * Template Post Type: page
 */

get_header(); ?>

<div class="portfolio-page page wrapper col">
    <div class="page-title-wrapper col">
        <div class="breadcrumbs row">
            <div class="breadcrumbs-page-name light-text-300">
                <a class="breabcrumbs-page-name light-text-300" href="<?php echo home_url(); ?>">Главная</a>
            </div>
            <div class="breadcrumbs-separator"></div>
            <div class="breadcrumbs-page-name light-text-300 active">
                Портфолио
            </div>
        </div>

        <div class="title">
            <div class="gallery-page-title">
                Наши работы
            </div>
        </div>

        <div class="page-subtitle text-16-300">
            Ознакомьтесь с нашими последними проектами и результатами работы.
        </div>
    </div>

    <div class="gallery wrapper wrapper-laptop col" id="portfolio-items">
        <div class="gallery-items-wrapper row">
            <?php
            $args = array(
                'post_type'      => 'portfolio_work',
                'posts_per_page' => 6,
                'paged'          => 1
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $image = get_field('portfolio_image');
                    $master_id = get_field('portfolio_master');
                    $master_name = get_field('master_name', $master_id);
                    $master_photo = get_field('master_photo', $master_id);
                    $master_likes = get_field('master_likes', $master_id);
                    ?>
                    <div class="gallery-item">
                        <div class="gallery-photo">
                            <?php if ($image): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>" width="276" height="276">
                            <?php endif; ?>
                        </div>
                        <div class="gallery-text col">
                            <div class="gallery-master-card row">
                                <div class="gallery-master-card-left-wrapper row">
                                    <div class="gallery-master-photo">
                                        <?php if ($master_photo): ?>
                                            <img src="<?php echo esc_url($master_photo['url']); ?>" width="51" height="51" alt="<?php echo esc_attr($master_name); ?>"/>
                                        <?php endif; ?>
                                    </div>
                                    <div class="gallery-master-info-wrapper col">
                                        <div class="gallery-master-name text-16-500 colored-text">
                                            <?php echo esc_html($master_name); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="gallery-master-cards-likes-wrapper col">
                                <div class="gallery-master-cards-likes-photo row">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                                            <path d="M9.14945 3.42589L10 4.80155L10.8506 3.42589C11.5789 2.24796 12.858 1.5 14.3182 1.5C16.5889 1.5 18.5 3.42492 18.5 5.83333C18.5 6.87433 18.0316 8.0043 17.2012 9.16973C16.3776 10.3257 15.2585 11.4311 14.1059 12.4018C12.9578 13.3685 11.805 14.178 10.9365 14.7468C10.5626 14.9916 10.2432 15.1908 10.0019 15.3375C9.76029 15.1896 9.44036 14.9888 9.06581 14.742C8.19701 14.1696 7.04368 13.3558 5.89518 12.386C4.742 11.4122 3.62241 10.305 2.79834 9.15033C1.96702 7.98551 1.5 6.86161 1.5 5.83333C1.5 3.42492 3.41107 1.5 5.68182 1.5C7.14196 1.5 8.42115 2.24796 9.14945 3.42589Z" stroke="#C0C0C0" stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <div class="gallery-master-cards-likes-counter">
                                        <?php echo esc_html($master_likes); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons-wrapper col">
                                <div class="button button-primary open-order-modal"  data-master-id="<?= esc_attr($master_id); ?>">
                                    Записаться
                                </div>
                                <div class="button-label">
                                    Подробнее о мастере
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>Нет работ в портфолио.</p>
            <?php endif; ?>
        </div>
        <div class="button button-primary" id="load-more-portfolio" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
            Загрузить еще
        </div>

    </div>

</div>

<script>
jQuery(document).ready(function($) {
    $('#load-more-portfolio').on('click', function() {
        var button = $(this),
            page = button.data('page'),
            ajaxurl = button.data('url');

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'load_more_portfolio',
                page: page
            },
            success: function(response) {
                if (response) {
                    $('#portfolio-items').append(response);
                    button.data('page', page + 1);
                } else {
                    button.remove();
                }
            }
        });
    });
});
</script>

<?php
    function load_more_portfolio() {
        $paged = $_POST['page'] + 1;
        $args = array(
            'post_type'      => 'portfolio_work',
            'posts_per_page' => 6,
            'paged'          => $paged
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $image = get_field('portfolio_image');
                $master_id = get_field('portfolio_master');
                $master_name = get_field('master_name', $master_id);
                $master_photo = get_field('master_photo', $master_id);
                $master_likes = get_field('master_likes', $master_id);
                ?>
                <div class="gallery-item">
                    <div class="gallery-photo">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>" width="276" height="276">
                        <?php endif; ?>
                    </div>
                    <div class="gallery-text col">
                        <div class="gallery-master-card row">
                            <div class="gallery-master-card-left-wrapper row">
                                <div class="gallery-master-photo">
                                    <?php if ($master_photo): ?>
                                        <img src="<?php echo esc_url($master_photo['url']); ?>" width="51" height="51" alt="<?php echo esc_attr($master_name); ?>"/>
                                    <?php endif; ?>
                                </div>
                                <div class="gallery-master-info-wrapper col">
                                    <div class="gallery-master-name text-16-500 colored-text">
                                        <?php echo esc_html($master_name); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-master-cards-likes-wrapper col">
                                <div class="gallery-master-cards-likes-counter">
                                    <?php echo esc_html($master_likes); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        die();
    }
    add_action('wp_ajax_load_more_portfolio', 'load_more_portfolio');
    add_action('wp_ajax_nopriv_load_more_portfolio', 'load_more_portfolio');

    get_footer(); 
    ?>


    <?php the_content(); ?>
</div>

