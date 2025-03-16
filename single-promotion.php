<?php get_header(); ?>
<div class="main-wrapper page-sale-wrapper col">
    <div class="colored-wrapper col">
        <div class="colored-wrapper col">
            <div class="service-slider row wrapper">
                <div class="service-slider-left col">
                    <!-- Хлебные крошки -->
                    <div class="breadcrumbs row">
                        <div class="breabcrumbs-page-name light-text-300">
                            <a href="<?php echo home_url(); ?>">Главная</a>
                        </div>
                        <div class="breabcrumbs-separator"></div>
                        <div class="breabcrumbs-page-name light-text-300">
                            <a href="<?php echo get_post_type_archive_link('promotion'); ?>">Акции</a>
                        </div>
                        <div class="breabcrumbs-separator"></div>
                        <div class="breabcrumbs-page-name light-text-300 active">
                            <?php the_title(); ?>
                        </div>
                    </div>

                    <!-- Заголовок -->
                    <div class="title">
                        <div class="sale-page-title">
                            <?php the_title(); ?>
                        </div>
                    </div>

                    <!-- Описание акции -->
                    <div class="subtitle-wrapper row">
                        <div class="spacer"></div>
                        <div class="slider-subtitle text-16-300">
                            <?php the_field('promotion_description'); ?>
                        </div>
                    </div>

                    <!-- Скидка -->
                    <?php if ($discount = get_field('promotion_discount')): ?>
                        <div class="sale-page-sale-wrapper row">
                            <div class="title">
                                Скидка <?php echo esc_html($discount); ?>%
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Форма записи -->
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
                                Нажимая кнопку вы даете согласие на обработку персональных данных и соглашаетесь с 
                                <span>политикой конфиденциальности</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Изображение акции -->
                <div class="service-slider-right sale-page-slider-right row">
                    <?php 
                        $image = get_field('promotion_image'); 
                        if ($image):
                    ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>" width="600" height="619">
                    <?php endif; ?>
                </div>

                <!-- Скидка (на планшете) -->
                <?php if ($discount): ?>
                    <div class="sale-page-sale-wrapper-tablet row">
                        <div class="title">
                            Скидка <?php echo esc_html($discount); ?> рублей 
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Форма записи (на планшете) -->
                <div class="service-slider-form-wrapper-tablet col">
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
                            Нажимая кнопку вы даете согласие на обработку персональных данных и соглашаетесь с 
                            <span>политикой конфиденциальности</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    the_content();
?>



</div>
<?php get_footer(); ?>
