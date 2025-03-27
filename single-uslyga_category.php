<?php get_header(); ?>

<div class="main-wrapper page-index-wrapper col">
    <?php
        $page_id = get_the_ID();

        // Получаем ACF поля услуги
        $slider_subtitle = get_field('category_subtitle', $page_id);
        $duration = get_field('service_duration', $page_id);
        $price = get_field('service_price', $page_id);
        $durability = get_field('service_durability', $page_id);
        $slider_images = get_field('service_slider_images', $page_id);
    ?>

    <div class="colored-wrapper slider-page-service-wrapper col">
        <div class="service-slider row wrapper">
            <div class="service-slider-left col">
                <div class="breadcrumbs row">
                    <div class="breadcrumbs-page-name light-text-300">
                        <a href="<?php echo home_url(); ?>">Главная</a>
                    </div>
                    <div class="breadcrumbs-separator"></div>
                    <div class="breadcrumbs-page-name light-text-300 active">
                        <a href="<?php echo get_permalink( $page_id); ?>"><?php the_title(); ?></a>
                        
                    </div>
                </div>
                <div class="title">
                    <div class="title__page"><?php the_title(); ?></div>
                </div>
                <div class="subtitle-wrapper row">
                    <div class="spacer"></div>
                    <div class="slider-subtitle text-16-300">
                        <?php echo esc_html($slider_subtitle); ?>
                    </div>
                </div>

                <div class="cons-wrapper row">
                    <?php if ($duration): ?>
                        <div class="con-item row">
                            <div class="con-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/smart-watch.png" width="40" height="40"/>
                            </div>
                            <div class="con-name text-16-300">
                                Длительность: <?php echo esc_html($duration); ?> минут
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($price): ?>
                        <div class="con-item row">
                            <div class="con-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/coins.png" width="35" height="38"/>
                            </div>
                            <div class="con-name text-16-300">
                                Стоимость от <?php echo esc_html($price); ?> руб.
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($durability): ?>
                        <div class="con-item row">
                            <div class="con-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/birds.png" width="46" height="34"/>
                            </div>
                            <div class="con-name text-16-300">
                                Стойкость от <?php echo esc_html($durability); ?> года
                            </div>
                        </div>
                    <?php endif; ?>
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
                            Нажимая кнопку, вы даете согласие на обработку персональных данных и соглашаетесь с 
                            <span>политикой конфиденциальности</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-slider-right row">
                <div class="service-page-slider-wrapper row">
                    <div class="service-page-slider-track row">
                        <?php if (!empty($slider_images)): ?>
                            <?php foreach ($slider_images as $index => $image): ?>
                                <div class="service-page-slide <?php echo ($index < 3) ? 'slide-visible-' . ($index + 1) : ''; ?>">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="358" height="614">
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="service-page-slide">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.png" alt="Нет изображения" width="358" height="614">
                            </div>
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
                            <path d="M1 13L7 7L1 1" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
