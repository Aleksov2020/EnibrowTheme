
<?php
/**
 * Регистрируем настройки и контролы в кастомайзере (Theme Customizer)
 */
function mytheme_customize_register($wp_customize) {

    // 1) Добавляем секцию «Настройки шапки»
    $wp_customize->add_section('mytheme_header_section', array(
        'title'    => 'Настройки шапки',
        'priority' => 30, // Порядок в списке секций
    ));

    // ========== АДРЕС ==========
    // Добавляем настройку (Setting) для адреса
    $wp_customize->add_setting('mytheme_address', array(
        'default'           => 'г. Москва, Посланников переулок, 1 - метро Бауманская',
        'sanitize_callback' => 'sanitize_text_field', // Фильтрация
    ));
    // Добавляем контрол (поле для ввода)
    $wp_customize->add_control('mytheme_address', array(
        'label'    => 'Адрес',
        'section'  => 'mytheme_header_section',
        'type'     => 'text',
    ));

    // ========== YOUTUBE ==========
    $wp_customize->add_setting('mytheme_social_youtube', array(
        'default'           => 'https://youtube.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_social_youtube', array(
        'label'   => 'Ссылка на YouTube',
        'section' => 'mytheme_header_section',
        'type'    => 'url',
    ));

    // ========== VK ==========
    $wp_customize->add_setting('mytheme_social_vk', array(
        'default'           => 'https://vk.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_social_vk', array(
        'label'   => 'Ссылка на ВКонтакте',
        'section' => 'mytheme_header_section',
        'type'    => 'url',
    ));

    // ========== WHATSAPP ==========
    $wp_customize->add_setting('mytheme_social_whatsapp', array(
        'default'           => 'https://wa.me/79123456789',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_social_whatsapp', array(
        'label'   => 'Ссылка на WhatsApp',
        'section' => 'mytheme_header_section',
        'type'    => 'url',
    ));

    // ========== TELEGRAM ==========
    $wp_customize->add_setting('mytheme_social_telegram', array(
        'default'           => 'https://t.me/username',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_social_telegram', array(
        'label'   => 'Ссылка на Telegram',
        'section' => 'mytheme_header_section',
        'type'    => 'url',
    ));

        // Добавляем или используем уже существующую секцию. 
    // Если нужна новая, создаём:
    $wp_customize->add_section('mytheme_header_section', array(
        'title'    => 'Настройки шапки',
        'priority' => 30,
    ));

    // ==== Телефон ====
    $wp_customize->add_setting('mytheme_phone', array(
        'default'           => '+7 (906) 933-99-99',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_phone', array(
        'label'   => 'Телефон',
        'section' => 'mytheme_header_section',
        'type'    => 'text',
    ));

    // ==== Время работы ====
    $wp_customize->add_setting('mytheme_work_time', array(
        'default'           => 'Пн-Пт с 08:00 до 21:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_work_time', array(
        'label'   => 'Время работы',
        'section' => 'mytheme_header_section',
        'type'    => 'text',
    ));

    // ==== Адрес (второй) ====
    $wp_customize->add_setting('mytheme_address2', array(
        'default'           => 'г. Москва, Посланников переулок., 1 - метро Бауманская',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_address2', array(
        'label'   => 'Адрес (2)',
        'section' => 'mytheme_header_section',
        'type'    => 'text',
    ));

    // ==== Текст кнопки "Запись онлайн" ====
    $wp_customize->add_setting('mytheme_online_button_text', array(
        'default'           => 'Запись онлайн',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_online_button_text', array(
        'label'   => 'Текст кнопки онлайн-записи',
        'section' => 'mytheme_header_section',
        'type'    => 'text',
    ));

    // ======================= ФУТЕР =========================
    $wp_customize->add_section('mytheme_footer_section', array(
        'title'    => 'Настройки подвала (Footer)',
        'priority' => 40,
    ));

    // Телефон
    $wp_customize->add_setting('mytheme_footer_phone', array(
        'default'           => '+7 (906) 933-99-99',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_phone', array(
        'label'   => 'Телефон (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'text',
    ));

    // Время работы
    $wp_customize->add_setting('mytheme_footer_work_time', array(
        'default'           => 'Пн-Пт с 08:00 до 21:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_work_time', array(
        'label'   => 'Время работы (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'text',
    ));

    // Адрес
    $wp_customize->add_setting('mytheme_footer_address', array(
        'default'           => 'г. Москва ул. Бауманская 43/1 стр.1',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_address', array(
        'label'   => 'Адрес (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'text',
    ));

    // Текст кнопки "Оставить заявку"
    $wp_customize->add_setting('mytheme_footer_button_text', array(
        'default'           => 'Оставить заявку',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_button_text', array(
        'label'   => 'Текст кнопки (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'text',
    ));

    // Юридическая информация (копирайт)
    $wp_customize->add_setting('mytheme_footer_copyright', array(
        'default'           => '© 2018-2024 ООО "ЦИТО ЭЙДЖ".',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_copyright', array(
        'label'   => 'Копирайт (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'text',
    ));

    // ИНН и ОГРН
    $wp_customize->add_setting('mytheme_footer_legal_info', array(
        'default'           => 'ИНН: 7733868739. ОГРН: 1147746081482',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('mytheme_footer_legal_info', array(
        'label'   => 'Юридическая информация (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'text',
    ));

    // Соцсети (если отличаются от хедера)
    $wp_customize->add_setting('mytheme_footer_social_vk', array(
        'default'           => 'https://vk.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_footer_social_vk', array(
        'label'   => 'Ссылка на VK (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('mytheme_footer_social_whatsapp', array(
        'default'           => 'https://wa.me/79123456789',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_footer_social_whatsapp', array(
        'label'   => 'Ссылка на WhatsApp (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('mytheme_footer_social_youtube', array(
        'default'           => 'https://youtube.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_footer_social_youtube', array(
        'label'   => 'Ссылка на YouTube (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('mytheme_footer_social_telegram', array(
        'default'           => 'https://t.me/username',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('mytheme_footer_social_telegram', array(
        'label'   => 'Ссылка на Telegram (Footer)',
        'section' => 'mytheme_footer_section',
        'type'    => 'url',
    ));

}

    

add_action('customize_register', 'mytheme_customize_register');
