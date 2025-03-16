<?php get_header(); ?>
<div class="main-wrapper page-faq-wrapper col">
    <div class="faq-page page wrapper col">
        <div class="page-title-wrapper col">
            <div class="breadcrumbs row">
                <div class="breadcrumbs-page-name light-text-300">
                    <a href="<?php echo home_url(); ?>">Главная</a>
                </div>
                <div class="breadcrumbs-separator"></div>
                <div class="breadcrumbs-page-name light-text-300 active">
                    <?php the_title(); ?>
                </div>
            </div>

            <div class="title">
                <div class="faq-page-title">
                    <?php the_title(); ?>
                </div>
            </div>

            <div class="faq-page-title-footer row">
                <div class="faq-page-views-wrapper row">
                    <div class="faq-page-views-icon icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/iconViews.svg" alt="views" width="20" height="15">
                    </div>
                    <div class="faq-page-views-label text-16-300">
                        <?php echo get_field('faq_views'); ?>
                    </div>
                </div>
                <div class="faq-page-date-create row additional-badge-page light-text-300">
                    Дата создания: <?php echo get_field('faq_date'); ?>
                </div>
            </div>
        </div>

    </div>
    
    <?php the_content(); ?>

</div>

<?php get_footer(); ?>
