
    <div class="slider wrapper wrapper-laptop-small row">
        <div class="slider__left">
            <div class="background-slider">
                <div class="slider-wrapper col">
                    <div class="slider-text col">
                        <h1><?= esc_html(get_field('slider_title')); ?></h1>
                        <div class="subtitle-wrapper row">
                            <div class="spacer"></div>
                            <div class="slider-subtitle text-16-300">
                                <?= esc_html(get_field('slider_subtitle')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="slider-nav row">
                        <?php while (have_rows('slider_links')): the_row(); ?>
                            <div class="slider-nav-item">
                                <a href="<?= esc_url(get_sub_field('link_url')); ?>">
                                    <?= esc_html(get_sub_field('link_title')); ?>
                                </a>
                            </div>
                            <div class="slider-nav-spacer"></div>
                        <?php endwhile; ?>
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
                                    <?= esc_html(get_field('slider_phone_code')); ?>
                                </label>
                                <input class="input-default phone-input" id="phone-input" type="text" placeholder="(000) 000 00 00 00">
                            </div>

                            <div class="button" id="send">Отправить</div>
                        </div>
                        <div class="checkbox-wrapper row">
                            <div class="checkbox checked"></div>
                            <div class="checkbox-label">
                                <?= esc_html(get_field('slider_checkbox_text')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="slider-right-wrapper-right col">
                        <div class="slider-right-map-wrapper col">
                            <div class="address-map">
                                <?= esc_html(get_field('slider_address')); ?>
                            </div>
                            <?php 
                            $map_image = get_field('slider_map_image');
                            $map_link = get_field('slider_map_link');
                            if ($map_image): ?>
                                <a href="<?= esc_url($map_link ?: '#'); ?>" class="map-image" target="_blank" rel="noopener">
                                    <img src="<?= esc_url($map_image['url']); ?>" width="290" height="96">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="work-time-wrapper col">
                            <div class="work-time-title text-16-500">Режим работы:</div>
                            <div class="slider-work-time"><?= esc_html(get_field('slider_working_hours')); ?></div>
                            <div class="work-time-items-wrapper row">
                                <?php if (have_rows('slider_work_days')): ?>
                                    <?php while (have_rows('slider_work_days')): the_row(); ?>
                                        <div class="work-time-item light-text-300 <?= get_sub_field('inactive') ? 'inactive' : ''; ?>">
                                            <?= esc_html(get_sub_field('day_name')); ?>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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