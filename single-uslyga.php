
<?php get_header(); ?>

<?php
// Данные услуги
$service_name = get_the_title();
$service_category = get_field('cat_uslyga'); // Категория услуги
$service_duration = get_field('service_duration');
$service_persistence = get_field('service_persistence');
$service_price = get_field('service_price');

// Получаем связанные работы из портфолио
$portfolio_works = get_field('service_portfolio_works');
?>
 <div class="main-wrapper subservice-page-wrapper col">

    <div class="colored-wrapper slider-page-service-wrapper col">
        <div class="service-slider row wrapper">
            <div class="service-slider-left col">
                <div class="breadcrumbs row">
                    <div class="breabcrumbs-page-name light-text-300">
                        <a href="<?php echo site_url(); ?>">Главная</a>
                    </div>
                    <div class="breabcrumbs-separator"></div>
                    <div class="breabcrumbs-page-name light-text-300 active">
                        <?php echo esc_html(get_the_title()); ?>
                    </div>
                </div>

                <div class="title">
                    <h2><?php echo esc_html($service_name); ?></h2>
                </div>

                <div class="subtitle-wrapper row">
                    <div class="spacer"></div>
                    <div class="slider-subtitle text-16-300">
                        Только естественный татуаж бровей сделает Вас привлекательнее <br/> и подчеркнет Вашу красоту
                    </div>
                </div>

                <div class="cons-wrapper row">
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/smart-watch.png" width="40" height="40"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php echo esc_html($service_duration); ?>
                        </div>
                    </div>
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/coins.png" width="35" height="38"/>
                        </div>
                        <div class="con-name text-16-300">
                            от <?php echo esc_html($service_price); ?> ₽
                        </div>
                    </div>
                    <div class="con-item row">
                        <div class="con-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/birds.png" width="46" height="34"/>
                        </div>
                        <div class="con-name text-16-300">
                            <?php echo esc_html($service_persistence); ?>
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
                            Нажимая кнопку, вы даёте согласие на обработку персональных данных и соглашаетесь с <span>политикой конфиденциальности</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-slider-right row">
                <div class="service-page-slider-wrapper row">
                    <div class="service-page-slider-track row">
                        <?php if ($portfolio_works): ?>
                            <?php foreach ($portfolio_works as $portfolio_id): ?>
                                <?php 
                                    $portfolio_image = get_field('portfolio_image', $portfolio_id); 
                                    if ($portfolio_image):
                                ?>
                                    <div class="service-page-slide">
                                        <img src="<?php echo esc_url($portfolio_image['url']); ?>" alt="slide" width="358" height="614">
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Нет изображений для данной услуги.</p>
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
    $service_links = get_field('service_content_links'); 
    if ($service_links): 
    ?>
        <div class="service-content row wrapper">
            <?php foreach ($service_links as $link): ?>
                <div class="service-content-separator"></div>
                <div class="service-content-item">
                    <a href="#<?php echo esc_attr($link['section_anchor']); ?>">
                        <?php echo esc_html($link['section_name']); ?>
                    </a>
                </div>
            <?php endforeach; ?>
            <div class="service-content-separator"></div>
        </div>
    <?php endif; ?>
    
    <?php
        the_content();
    ?>             

</div>

<?php get_footer(); ?>
