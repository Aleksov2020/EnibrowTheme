<?php
// Получаем поля ACF
$slider_id = get_the_ID(); // Получаем ID текущего блока слайдера

// Основной заголовок и подзаголовок
$slider_title = get_field('slider_title', $slider_id);
$slider_subtitle = get_field('slider_subtitle', $slider_id);

// Навигационные элементы
$slider_nav_items = get_field('slider_nav_items', $slider_id);

// Форма записи
$form_title = get_field('form_title', $slider_id);
$form_placeholder_name = get_field('form_placeholder_name', $slider_id);
$form_placeholder_phone = get_field('form_placeholder_phone', $slider_id);
$form_button_text = get_field('form_button_text', $slider_id);

// Контактные данные
$contact_address = get_field('contact_address', $slider_id);
$contact_map = get_field('contact_map', $slider_id); // URL изображения карты

// Режим работы
$work_hours = get_field('work_hours', $slider_id);
$work_days = get_field('work_days', $slider_id); // Массив дней недели

?>

<div class="slider wrapper wrapper-laptop-small row">
    <div class="slider__left">
        <div class="background-slider">
            <div class="slider-wrapper col">
                <div class="slider-text col">
                    <h1><?php echo esc_html($slider_title); ?></h1>
                    <div class="subtitle-wrapper row">
                        <div class="spacer"></div>
                        <div class="slider-subtitle text-16-300">
                            <?php echo esc_html($slider_subtitle); ?>
                        </div>
                    </div>
                </div>
                <div class="slider-nav row">
                    <?php if( $slider_nav_items ): ?>
                        <?php foreach( $slider_nav_items as $item ): ?>
                            <div class="slider-nav-item"><?php echo esc_html($item['nav_title']); ?></div>
                            <div class="slider-nav-spacer"></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="slider__right">
        <div class="slider-right-background">
            <div class="slider-right-wrapper col">
                <div class="slider-right-wrapper-left col">
                    <h3>Консультация / Запись</h3>
                    <div class="form-slider col">
                        <input class="input-default" type="text" placeholder="Ваше имя">
                        <div class="input-default-wrapper">
                            <label class="label-phone row">+7</label>
                            <input class="input-default phone-input" type="text" placeholder="(000) 000 00 00">
                        </div>
                        <div class="button">Отправить</div>
                    </div>
                    <div class="checkbox-wrapper row">
                        <div class="checkbox checked"></div>
                        <div class="checkbox-label">
                            Нажимая кнопку, вы даете согласие на обработку персональных данных и соглашаетесь с 
                            <span>политикой конфиденциальности</span>
                        </div>
                    </div>
                </div>
                <div class="slider-right-wrapper-right col">
                    <div class="slider-right-map-wrapper col">
                        <div class="address-map">
                            <?php echo esc_html($slider_address); ?>
                        </div>
                        <div class="map-image">
                            <img src="<?php echo esc_url($slider_map_image['url']); ?>" alt="Карта" width="290" height="96">
                        </div>
                    </div>
                    <div class="work-time-wrapper col">
                        <div class="work-time-title text-16-500">Режим работы:</div>
                        <div class="slider-work-time"><?php echo esc_html($slider_work_time); ?></div>
                        <div class="work-time-items-wrapper row">
                            <?php if( $slider_work_days ): ?>
                                <?php foreach( $slider_work_days as $day ): ?>
                                    <div class="work-time-item <?php echo $day['inactive'] ? 'inactive' : ''; ?>">
                                        <?php echo esc_html($day['day_name']); ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
