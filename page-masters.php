<?php
/**
 * Template Name: Страница Мастеров
 * Template Post Type: page
 */

get_header(); ?>

<div class="main-wrapper page-index-wrapper col">
<?php
/* Template Name: Мастера */
get_header();
?>

    <div class="masters-page-slider wrapper row">
        <div class="page-title-wrapper col">
            <div class="breadcrumbs row">
                <div class="breabcrumbs-page-name light-text-300">
                    <a href="<?php echo home_url(); ?>">Главная</a>
                </div>
                <div class="breabcrumbs-separator"></div>
                <div class="breabcrumbs-page-name light-text-300 active">
                    Мастера
                </div>
            </div>

            <div class="title">
                <div class="masters-page-title">
                    <?php the_field('masters_page_title'); ?>
                </div>
            </div>

            <div class="masters-page-badge-wrapper row">
                <div class="masters-page-badge yellow-badge-page text-16-300">
                    <?php the_field('masters_page_reviews'); ?> отзывов
                </div>
                <div class="masters-page-badge text-16-300">
                    <?php the_field('masters_page_experience'); ?>
                </div>
                <div class="masters-page-badge text-16-300">
                    <?php the_field('masters_page_consultation'); ?>
                </div>
            </div>

            <div class="subtitle-wrapper row">
                <div class="spacer"></div>
                <div class="slider-subtitle text-16-300">
                    <?php the_field('masters_page_description'); ?>
                </div>
            </div>

            <div class="masters-page-step-wrapper row">
                <?php if (have_rows('masters_page_steps')): ?>
                    <?php while (have_rows('masters_page_steps')): the_row(); ?>
                        <div class="masters-page-step row">
                            <div class="master-page-step-number">
                                <?php the_sub_field('step_number'); ?>
                            </div>
                            <div class="masters-page-step-icon icon">
                                <img src="<?php the_sub_field('step_icon'); ?>" width="29" height="29" alt="step-icon">
                            </div>
                            <div class="masters-page-step-label text-16-300">
                                <?php the_sub_field('step_label'); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="masters-image-slider-wrapper">
            <img src="<?php the_field('masters_page_image'); ?>" width="572" height="373" alt="masters">
        </div>
    </div>



    <?php
        the_content();
    ?>
</div>

<?php get_footer(); ?>