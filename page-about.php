<?php
/**
 * Template Name: О студии
 * Template Post Type: page
 */
get_header();
?>
<div class="main-wrapper page-about-wrapper col">
    <div class="colored-wrapper col">
        <div class="about-slider row wrapper">
            <div class="about-slider-left col">
                <div class="breadcrumbs row">
                    <div class="breabcrumbs-page-name light-text-300">
                        <a href="<?php echo home_url(); ?>">Главная</a>
                    </div>
                    <div class="breabcrumbs-separator"></div>
                    <div class="breabcrumbs-page-name light-text-300 active">
                        О студии
                    </div>
                </div>

                <div class="title">
                    <div class="about-page-title">
                        <?php the_field('about_title'); ?>
                    </div>
                </div>

                <div class="subtitle-wrapper row">
                    <div class="spacer"></div>
                    <div class="slider-subtitle text-16-300">
                        <?php the_field('about_subtitle_1'); ?>
                    </div>
                </div>
                <div class="subtitle-wrapper row">
                    <div class="spacer"></div>
                    <div class="slider-subtitle text-16-300">
                        <?php the_field('about_subtitle_2'); ?>
                    </div>
                </div>

                <div class="cons-wrapper row">
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/smart-watch.png" width="40" height="40"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php the_field('about_feature_1'); ?>
                        </div>
                    </div>
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/coins.png" width="35" height="38"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php the_field('about_feature_2'); ?>
                        </div>
                    </div>
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/birds.png" width="46" height="34"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php the_field('about_feature_3'); ?>
                        </div>
                    </div>
                </div>

                <div class="service-slider-form-wrapper col">
                    <div class="service-slider-form-title colored-text">
                        Записаться на процедуру
                    </div>
                    <div class="form-slider row">
                        <input class="input-default" type="text" placeholder="Ваше имя">
                        <div class="input-default-wrapper">
                            <label class="label-phone row">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                    <g clip-path="url(#clip0_3035_13027)">
                                    <rect width="60" height="20" fill="#F9F9F9"/>
                                    <rect y="20" width="60" height="20" fill="#428BC1"/>
                                    <rect y="40" width="60" height="20" fill="#ED4C5C"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_3035_13027">
                                        <rect width="60" height="60" rx="30" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                                +7
                            </label>
                            <input class="input-default phone-input" id="phone-input" type="text" placeholder="(000) 000 00 00 00">
                        </div>
                        <div class="button button-primary"> Отправить </div>
                    </div>
                    <div class="checkbox-wrapper row">
                        <div class="checkbox checked"></div>
                        <div class="checkbox-label">
                            Нажимая кнопку, вы даете согласие на обработку персональных данных и соглашаетесь с <span>политикой конфиденциальности</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-slider-right about-slider-right row">
                <div class="about-slider-buttons-wrapper">
                    <div class="about-slide-right-button prev-button">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <div class="about-slide-right-button next-button">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>
                <div class="about-slider-track row">
                    <?php
                    $slider_images = get_field('about_slider');
                    if ($slider_images):
                        foreach ($slider_images as $image): ?>
                            <div class="about-slide-right">
                                <img src="<?php echo esc_url($image['url']); ?>" width="600" height="676">
                            </div>
                        <?php endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php
        the_content();
    ?>
</div>

<?php get_footer(); ?>
