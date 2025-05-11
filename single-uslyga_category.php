<?php get_header(); ?>

<div class="main-wrapper page-index-wrapper col">
<?php
        $page_id = get_the_ID();

        // Получаем ACF поля услуги
        $slider_subtitle = get_field('category_subtitle', $page_id);
        $duration = get_field('category_duration', $page_id);
        $price = get_field('category_price_from', $page_id);
        $bread = get_field('bread', $page_id);
        $durability = get_field('category_persistence', $page_id);
        $slider_images = [];

        $related_services = get_posts([
            'post_type'      => 'uslyga',
            'posts_per_page' => -1,
            'meta_query'     => [
                [
                    'key'     => 'usl_cat_field',
                    'value'   => $page_id,
                    'compare' => '=',
                ]
            ],
        ]);

        foreach ($related_services as $service) {
            $portfolio_ids = get_field('service_portfolio_works', $service->ID);

            if (!$portfolio_ids) continue;

            foreach ($portfolio_ids as $portfolio_id) {
                if (get_field('portfolio_slider', $portfolio_id)) {
                    $img = get_field('portfolio_image', $portfolio_id);
                    if ($img) {
                        $slider_images[] = $img;
                    }
                }

                if (count($slider_images) >= 7) break 2; // прерываем оба цикла
            }
        }
    ?>

    <div class="colored-wrapper slider-page-service-wrapper col">
        <div class="service-slider row wrapper">
            <div class="service-slider-left col">
                <div class="breadcrumbs row">
                    <div class="breadcrumbs-page-name light-text-300">
                        <a href="<?php echo home_url(); ?>">Главная</a>
                    </div>
                    <div class="breabcrumbs-separator"></div>
                    <div class="breadcrumbs-page-name light-text-300 active">
                        <a href="<?php echo get_permalink( $page_id); ?>"><?php echo $bread; ?></a>
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
                                <?php echo esc_html($duration); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($price): ?>
                        <div class="con-item row">
                            <div class="con-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/coins.png" width="35" height="38"/>
                            </div>
                            <div class="con-name text-16-300">
                                <?php echo esc_html($price); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($durability): ?>
                        <div class="con-item row">
                            <div class="con-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/birds.png" width="46" height="34"/>
                            </div>
                            <div class="con-name text-16-300">
                                <?php echo esc_html($durability); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="service-slider-form-wrapper col">
                    <div class="service-slider-form-title colored-text">
                        Записаться на процедуру
                    </div>
                    <div class="form-slider row">
                        <input class="input-default" type="text" placeholder="Ваше имя" id="user-name" >
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

                        <div class="button button-primary" id="send">Отправить</div>
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
<script>
function triggerErrorAnimation(element) {
    element.classList.remove('error');
    void element.offsetWidth; // перезапуск анимации
    element.classList.add('error');
}

document.querySelector('#send').addEventListener('click', async () => {
    const checkbox = document.querySelector('.checkbox');
    const checkboxWrapper = document.querySelector('.checkbox-wrapper');

    checkboxWrapper.classList.remove('error');

    const nameInput = document.querySelector('#user-name');
    const phoneInput = document.querySelector('#phone-input');
    const name = nameInput.value.trim();
    const phone = phoneInput.value.trim();

    nameInput.classList.remove('error');
    phoneInput.classList.remove('error');

    let hasError = false;

    // Проверка чекбокса
    if (!checkbox.classList.contains('checked')) {
        triggerErrorAnimation(checkboxWrapper);
        hasError = true;
    }

    // Проверка имени
    const nameValid = /^[А-Яа-яA-Za-z\s-]{2,}$/.test(name);
    if (!nameValid) {
        triggerErrorAnimation(nameInput);
        hasError = true;
    }

    // Проверка телефона
    const digitsOnly = phone.replace(/\D/g, '');
    if (digitsOnly.length < 7) {
        triggerErrorAnimation(phoneInput);
        hasError = true;
    }

    if (hasError) return;

    const formData = new FormData();
    formData.append('action', 'send_order');
    formData.append('user_name', name);
    formData.append('user_phone', phone);

    try {
        const response = await fetch('/enibrow/wp-admin/admin-post.php', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) throw new Error('Ошибка при отправке формы');

        const redirectUrl = new URL(window.location.href);
        window.location.href = redirectUrl.toString();
    } catch (error) {
        console.error(error);
    }
});
</script>

<?php get_footer(); ?>
