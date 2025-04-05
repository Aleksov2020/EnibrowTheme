<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit;
}
add_action('acf/init', function() {
    // video
    acf_add_local_field_group(array(
        'key' => 'group_video_fields',
        'title' => 'Детали видеозаписи',
        'fields' => array(
            array(
                'key' => 'field_video_thumbnail',
                'label' => 'Обложка видео',
                'name' => 'video_thumbnail',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_video_url',
                'label' => 'Ссылка на видео',
                'name' => 'video_url',
                'type' => 'url',
                'placeholder' => 'https://',
            ),
            array(
                'key'   => 'field_video_show',
                'label' => 'Отображать на главной',
                'name'  => 'video_show',
                'type'  => 'true_false', 
                'ui'    => true,        
            ),
            array(
                'key'          => 'field_video_page',
                'label'        => 'Выбрать страницу',
                'name'         => 'video_page',
                'type'         => 'post_object',
                'post_type'    => array('page'),
                'return_format' => 'id',
                'required'     => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'video',
                ),
            ),
        ),
    ));

    // reviews
    acf_add_local_field_group(array(
        'key'    => 'group_reviews',
        'title'  => 'Отзыв',
        'fields' => array(
            array(
                'key'   => 'field_review_name',
                'label' => 'Имя',
                'name'  => 'review_name',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_review_rating',
                'label' => 'Оценка',
                'name'  => 'review_rating',
                'type'  => 'number',
                'min'   => 1,
                'max'   => 5,
                'step'  => 1,
            ),
            array(
                'key'   => 'field_review_comment',
                'label' => 'Комментарий',
                'name'  => 'review_comment',
                'type'  => 'textarea',
            ),
            array(
                'key'   => 'field_review_images',
                'label' => 'Картинки',
                'name'  => 'review_images',
                'type'  => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key'   => 'field_review_master',
                'label' => 'Мастер',
                'name'  => 'review_master',
                'type'  => 'post_object',
                'post_type' => array('master'),
                'return_format' => 'id',
                'multiple' => 0,
            ),
            array(
                'key'   => 'field_review_global',
                'label' => 'Выводить отзыв на всех страницах сайта',
                'name'  => 'review_global',
                'type'  => 'true_false',
                'ui'    => 1,
            ),
            array(
                'key'   => 'field_review_date',
                'label' => 'Дата отзыва',
                'name'  => 'review_date',
                'type'  => 'date_picker',
                'display_format' => 'd.m.Y',
                'return_format'  => 'd.m.Y',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'reviews',
                ),
            ),
        ),
    ));

    // masters
    acf_add_local_field_group(array(
        'key'    => 'group_master_fields',
        'title'  => 'Детали мастера',
        'fields' => array(
            array(
                'key'   => 'field_master_rank',
                'label' => 'Звание мастера',
                'name'  => 'master_rank',
                'type'  => 'text',
                'placeholder' => 'Например: ТОП-мастер'
            ),
            array(
                'key'   => 'field_master_experience',
                'label' => 'Стаж (лет)',
                'name'  => 'master_experience',
                'type'  => 'number',
                'min'   => 0,
                'step'  => 1
            ),
            array(
                'key'   => 'field_master_name',
                'label' => 'Имя',
                'name'  => 'master_name',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_master_surname',
                'label' => 'Фамилия',
                'name'  => 'master_surname',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_master_bio',
                'label' => 'Немного слов о себе',
                'name'  => 'master_bio',
                'type'  => 'textarea',
                'rows'  => 4,
            ),
            array(
                'key'   => 'field_master_short_description',
                'label' => 'Краткое описание',
                'name'  => 'short_description',
                'type'  => 'textarea',
                'rows'  => 2,
                'instructions' => 'Введите краткое описание мастера для отображения в блоке'
            ),
            array(
                'key' => 'field_master_review_count',
                'label' => 'Количество отзывов',
                'name' => 'master_review_count',
                'type' => 'number',
                'min' => 0,
                'step' => 1,
                'default_value' => 0,
            ),
            array(
                'key' => 'field_master_rating',
                'label' => 'Средняя оценка',
                'name' => 'master_rating',
                'type' => 'text',
                'default_value' => "4.4",
            ),
            array(
                'key'   => 'field_master_education',
                'label' => 'Образование',
                'name'  => 'master_education',
                'type'  => 'repeater',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_edu_year',
                        'label' => 'Год',
                        'name'  => 'edu_year',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_edu_place',
                        'label' => 'Место обучения',
                        'name'  => 'edu_place',
                        'type'  => 'text',
                    )
                )
            ),
            array(
                'key'   => 'field_master_extra_education',
                'label' => 'Дополнительное образование',
                'name'  => 'master_extra_education',
                'type'  => 'repeater',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_extra_edu_year',
                        'label' => 'Год',
                        'name'  => 'extra_edu_year',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_extra_edu_place',
                        'label' => 'Место обучения',
                        'name'  => 'extra_edu_place',
                        'type'  => 'text',
                    )
                )
            ),
            array(
                'key'   => 'field_master_photo',
                'label' => 'Фото мастера',
                'name'  => 'master_photo',
                'type'  => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key'   => 'field_master_show_global',
                'label' => 'Показывать мастера по всему сайту',
                'name'  => 'master_show_global',
                'type'  => 'true_false',
                'ui'    => 1,
            ),
            array(
                'key'   => 'field_master_description_articles',
                'label' => 'Описание в статьях и вопросах',
                'name'  => 'master_description_articles',
                'type'  => 'textarea',
                'rows'  => 3,
            )
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'master',
                ),
            ),
        ),
    ));
    
    //услуги у мастера
    acf_add_local_field_group(array(
        'key'    => 'group_master_services',
        'title'  => 'Услуги мастера',
        'fields' => array(
            array(
                'key'   => 'field_master_services',
                'label' => 'Услуги мастера',
                'name'  => 'master_services',
                'type'  => 'repeater',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_service_name',
                        'label' => 'Услуга',
                        'name'  => 'uslyga',
                        'type'  => 'post_object',
                        'post_type' => array('uslyga'),
                        'return_format' => 'id',
                    ),
                    array(
                        'key'   => 'field_service_price',
                        'label' => 'Цена',
                        'name'  => 'service_price',
                        'type'  => 'number',
                        'prepend' => '₽',
                    )
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'master',
                ),
            ),
        ),
    ));
    
    // recommendations
    acf_add_local_field_group(array(
        'key'    => 'group_recommendation_fields',
        'title'  => 'Настройки рекомендации',
        'fields' => array(
            array(
                'key'   => 'field_recommendation_icon',
                'label' => 'SVG-иконка',
                'name'  => 'recommendation_icon',
                'type'  => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ),
            array(
                'key'   => 'field_recommendation_time',
                'label' => 'Время чтения',
                'name'  => 'recommendation_time',
                'type'  => 'text',
                'placeholder' => 'Пример: Время чтения 4 минуты',
            ),
            array(
                'key'   => 'field_recommendation_link',
                'label' => 'Ссылка для перехода',
                'name'  => 'recommendation_link',
                'type'  => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'recommendation',
                ),
            ),
        ),
    ));

    // Portfolio
    acf_add_local_field_group(array(
        'key'    => 'group_portfolio_work_fields',
        'title'  => 'Детали работы портфолио',
        'fields' => array(
            array(
                'key'   => 'field_portfolio_slider',
                'label' => 'Выводить в слайдер (максимум 7)',
                'name'  => 'portfolio_slider',
                'type'  => 'true_false',
                'ui'    => 1,
            ),
            array(
                'key'   => 'field_portfolio_main',
                'label' => 'Выводить на главную',
                'name'  => 'portfolio_main',
                'type'  => 'true_false',
                'ui'    => 1,
            ),
            array(
                'key'   => 'field_portfolio_preview',
                'label' => 'Фотография предпросмотра у мастера',
                'name'  => 'portfolio_preview',
                'type'  => 'true_false',
                'ui'    => 1,
            ),
            array(
                'key'   => 'field_portfolio_master',
                'label' => 'Мастер',
                'name'  => 'portfolio_master',
                'type'  => 'post_object',
                'post_type' => array('master'),
                'return_format' => 'id',
                'required' => 1,
            ),
            array(
                'key'   => 'field_portfolio_image',
                'label' => 'Фотография работы',
                'name'  => 'portfolio_image',
                'type'  => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key'   => 'field_portfolio_page',
                'label' => 'Страница портфолио',
                'name'  => 'portfolio_page',
                'type'  => 'post_object',
                'post_type' => array('page'),
                'return_format' => 'id',
            ),
            array(
                'key'   => 'field_master_likes',
                'label' => 'Количество лайков',
                'name'  => 'portfolio_likes',
                'type'  => 'number',
                'default_value' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'portfolio_work',
                ),
            ),
        ),
    ));
    
    // услуги
    acf_add_local_field_group(array(
        'key'    => 'group_service_fields',
        'title'  => 'Детали услуги',
        'fields' => array(
            array(
                'key'   => 'field_service_short_name',
                'label' => 'Короткое имя услуги (для фильтра и меню)',
                'name'  => 'service_short_name',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_service_short_description',
                'label' => 'Краткое описание (для таблицы)',
                'name'  => 'service_short_description',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            array(
                'key'   => 'field_service_duration',
                'label' => 'Длительность',
                'name'  => 'service_duration',
                'type'  => 'text',
                'instructions' => 'Пример: 60 минут, 1.5 часа',
            ),
            array(
                'key'   => 'field_service_persistence',
                'label' => 'Стойкость',
                'name'  => 'service_persistence',
                'type'  => 'text',
                'instructions' => 'Пример: 6 месяцев, 1 год',
            ),
            array(
                'key'   => 'field_service_price',
                'label' => 'Стоимость от',
                'name'  => 'service_price',
                'type'  => 'number',
                'prepend' => '₽',
            ),
            array(
                'key'   => 'field_service_portfolio_works',
                'label' => 'Работы портфолио',
                'name'  => 'service_portfolio_works',
                'type'  => 'relationship',
                'post_type' => array('portfolio_work'),
                'return_format' => 'id',
            ),
            array(
                'key'   => 'field_master_show_on_home',
                'label' => 'Отображать на главной',
                'name'  => 'master_show_on_home',
                'type'  => 'true_false', 
                'ui'    => true,        
            ),
            array(
                'key'   => 'field_cat_uslyga',
                'label' => 'Категория услуги',
                'name'  => 'usl_cat_field',
                'type'  => 'post_object',
                'post_type' => array('uslyga_category'),
                'return_format' => 'id',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'uslyga',
                ),
            ),
        ),
    ));

    // для блока на странице услуг
    acf_add_local_field_group(array(
        'key'    => 'group_service_content_links',
        'title'  => 'Якорные ссылки на блоки страницы',
        'fields' => array(
            array(
                'key'   => 'field_service_content_links',
                'label' => 'Секции страницы',
                'name'  => 'service_content_links',
                'type'  => 'repeater',
                'button_label' => 'Добавить ссылку',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_section_name',
                        'label' => 'Название секции',
                        'name'  => 'section_name',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_section_anchor',
                        'label' => 'Якорь (ID секции)',
                        'name'  => 'section_anchor',
                        'type'  => 'text',
                        'instructions' => 'Пример: "about", "pricing", "gallery"',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'uslyga',
                ),
            ),
        ),
    ));
    
    // категория услуг
    acf_add_local_field_group(array(
        'key'    => 'group_service_category_fields',
        'title'  => 'Детали категории услуг',
        'fields' => array(
            array(
                'key'   => 'field_category_full_name',
                'label' => 'Полное имя категории услуг',
                'name'  => 'category_full_name',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_cat_short_name',
                'label' => 'Короткое имя категории',
                'name'  => 'cat_short_name',
                'type'  => 'text',
                'instructions' => 'Например: Брови, Губы, Межресничка',
            ),
            array(
                'key'   => 'field_category_subtitle',
                'label' => 'Подзаголовок категории',
                'name'  => 'category_subtitle',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_category_duration',
                'label' => 'Длительность услуги',
                'name'  => 'category_duration',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_category_price_from',
                'label' => 'Цена от',
                'name'  => 'category_price_from',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_category_persistence',
                'label' => 'Сохранение результата',
                'name'  => 'category_persistence',
                'type'  => 'text',
            ),
            array(
                'key' => 'field_uslyga_category_image',
                'label' => 'Фоновое изображение',
                'name' => 'uslyga_category_image',
                'type' => 'image',
                'description' => 'Изображение для отображения на главной',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'uslyga_category',
                ),
            ),
        ),
    ));

    // Группа полей для яндекс блока
    acf_add_local_field_group(array(
        'key'    => 'group_enibrow_discount_block',
        'title'  => 'Рекламный блок Enibrow',
        'fields' => array(
            array(
                'key'   => 'field_discount_title',
                'label' => 'Заголовок',
                'name'  => 'discount_title',
                'type'  => 'text',
                'default_value' => 'Рейтинг на Яндекс Картах 5.0',
                'placeholder'   => 'Введите заголовок...',
            ),
            array(
                'key'   => 'field_discount_text',
                'label' => 'Текст скидки',
                'name'  => 'discount_text',
                'type'  => 'textarea',
                'default_value' => 'Скидка на первую процедуру по удалению татуажа ремувером в студии естественного татуажа Enibrow',
                'placeholder'   => 'Введите описание скидки...',
                'rows'  => 3,
            ),
            array(
                'key'   => 'field_discount_link',
                'label' => 'Ссылка на карты',
                'name'  => 'discount_link',
                'type'  => 'url',
                'default_value' => 'https://yandex.ru/maps/',
                'placeholder'   => 'Введите ссылку...',
            ),
            array(
                'key'   => 'field_discount_button_text',
                'label' => 'Текст кнопки',
                'name'  => 'discount_button_text',
                'type'  => 'text',
                'default_value' => 'Перейти на карты',
                'placeholder'   => 'Введите текст кнопки...',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/enibrow_discount_block',
                ),
            ),
        ),
    ));

    // Группа полей для блока отзывов Enibrow
    acf_add_local_field_group(array(
        'key'    => 'group_reviews_list',
        'title'  => 'Отзывы списком',
        'fields' => array(
            array(
                'key'   => 'field_reviews_list_title',
                'label' => 'Заголовок блока',
                'name'  => 'reviews_list_title',
                'type'  => 'text',
                'default_value' => 'Отзывы наших клиентов',
                'placeholder' => 'Введите заголовок...',
            ),
            array(
                'key'   => 'field_reviews_list_count',
                'label' => 'Количество отзывов',
                'name'  => 'reviews_list_count',
                'type'  => 'number',
                'default_value' => 5,
                'min'   => 1,
                'max'   => 50,
                'step'  => 1,
            ),
            array(
                'key'   => 'field_reviews_list_master',
                'label' => 'Фильтр по мастеру',
                'name'  => 'reviews_list_master',
                'type'  => 'post_object',
                'post_type' => array('master'), // Выбираем мастера
                'return_format' => 'id',
                'multiple' => 0,
                'allow_null' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/reviews_list',
                ),
            ),
        ),
    ));

    // Roll block
    acf_add_local_field_group(array(
        'key'    => 'group_roll_block',
        'title'  => 'Разворачиваемый текст',
        'fields' => array(
            array(
                'key'   => 'field_roll_content',
                'label' => 'Содержимое блока',
                'name'  => 'roll_content',
                'type'  => 'flexible_content',
                'button_label' => 'Добавить элемент',
                'layouts' => array(
                    'title_block' => array(
                        'key' => 'layout_title_block',
                        'name' => 'title_block',
                        'label' => 'Заголовок',
                        'display' => 'row',
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_title_block',
                                'label' => 'Заголовок',
                                'name'  => 'title',
                                'type'  => 'text',
                            ),
                        ),
                    ),
                    'text_block' => array(
                        'key' => 'layout_text_block',
                        'name' => 'text_block',
                        'label' => 'Текстовый блок',
                        'display' => 'row',
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_text_block',
                                'label' => 'Текст',
                                'name'  => 'text',
                                'type' => 'wysiwyg',
                                'tabs' => 'visual',
                                'toolbar' => 'basic',
                                'media_upload' => 0,
                            ),
                        ),
                    ),
                    'list_item' => array(
                        'key' => 'layout_list_item',
                        'name' => 'list_item',
                        'label' => 'Элемент списка',
                        'display' => 'row',
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_list_item_title',
                                'label' => 'Название элемента',
                                'name'  => 'list_title',
                                'type'  => 'text',
                            ),
                            array(
                                'key'   => 'field_list_item_text',
                                'label' => 'Описание элемента',
                                'name'  => 'list_text',
                                'type' => 'wysiwyg',
                                'tabs' => 'visual',
                                'toolbar' => 'basic',
                                'media_upload' => 0,
                            ),
                        ),
                    ),
                    'danger_block' => array(
                        'key' => 'layout_danger_block',
                        'name' => 'danger_block',
                        'label' => 'Блок с предупреждением',
                        'display' => 'row',
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_danger_text',
                                'label' => 'Текст предупреждения',
                                'name'  => 'danger_text',
                                'type' => 'wysiwyg',
                                'tabs' => 'visual',
                                'toolbar' => 'basic',
                                'media_upload' => 0,
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'key'   => 'field_skip_roll_block',
                'label' => 'Не скрывать блок',
                'name'  => 'skip_roll_block',
                'type'  => 'true_false',
                'ui'    => 1,
                'default_value' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/roll-block',
                ),
            ),
        ),
    ));

    // акции
    acf_add_local_field_group(array(
        'key'    => 'group_promotion_fields',
        'title'  => 'Настройки акции',
        'fields' => array(
            array(
                'key'   => 'field_promotion_name',
                'label' => 'Название акции',
                'name'  => 'promotion_name',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_promotion_description',
                'label' => 'Описание акции',
                'name'  => 'promotion_description',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            array(
                'key'   => 'field_promotion_discount',
                'label' => 'Скидка (рубли)',
                'name'  => 'promotion_discount',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_promotion_image',
                'label' => 'Изображение акции',
                'name'  => 'promotion_image',
                'type'  => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ),
            array(
                'key'   => 'field_promotion_services',
                'label' => 'Связанные услуги',
                'name'  => 'promotion_services',
                'type'  => 'relationship',
                'post_type' => array('uslyga'),
                'return_format' => 'id',
                'instructions' => 'Выберите услуги, на которые распространяется акция',
                'max' => 5,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'promotion',
                ),
            ),
        ),
    ));
    
    // блок слайдер
    acf_add_local_field_group(array(
        'key' => 'group_slider_fields',
        'title' => 'Настройки слайдера',
        'fields' => array(
            array(
                'key' => 'field_slider_title',
                'label' => 'Заголовок',
                'name' => 'slider_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_slider_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'slider_subtitle',
                'type' => 'textarea',
                'rows' => 2,
            ),
            array(
                'key' => 'field_slider_nav_items',
                'label' => 'Элементы навигации',
                'name' => 'slider_nav_items',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_nav_title',
                        'label' => 'Название',
                        'name' => 'nav_title',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_slider_map_image',
                'label' => 'Карта',
                'name' => 'slider_map_image',
                'type' => 'image',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_slider_address',
                'label' => 'Адрес',
                'name' => 'slider_address',
                'type' => 'text',
            ),
            array(
                'key' => 'field_slider_work_time',
                'label' => 'Режим работы',
                'name' => 'slider_work_time',
                'type' => 'text',
            ),
            array(
                'key' => 'field_slider_work_days',
                'label' => 'Дни работы',
                'name' => 'slider_work_days',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_day_name',
                        'label' => 'День',
                        'name' => 'day_name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_day_inactive',
                        'label' => 'Выходной?',
                        'name' => 'inactive',
                        'type' => 'true_false',
                        'ui' => 1,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'custom_slider',
                ),
            ),
        ),
    ));

    // Блог
    acf_add_local_field_group(array(
        'key' => 'group_blog_fields',
        'title' => 'Дополнительные поля блога',
        'fields' => array(
            array(
                'key' => 'field_blog_views',
                'label' => 'Количество просмотров',
                'name' => 'blog_views',
                'type' => 'number',
                'default_value' => 0,
            ),
            array(
                'key' => 'field_blog_read_time',
                'label' => 'Время чтения (минут)',
                'name' => 'blog_read_time',
                'type' => 'number',
                'default_value' => 5,
            ),
            array(
                'key' => 'field_blog_image',
                'label' => 'Изображение статьи',
                'name' => 'blog_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ),
            array(
                'key' => 'field_blog_page',
                'label' => 'Принадлежит странице',
                'name' => 'blog_page',
                'type' => 'post_object',
                'post_type' => array('page'), // Позволяет выбрать любую страницу
                'return_format' => 'id',
                'instructions' => 'Выберите страницу, к которой относится эта статья',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'blog',
                ),
            ),
        ),
    ));

    // наши услуги
    acf_add_local_field_group(array(
        'key'    => 'group_our_services_block',
        'title'  => 'Блок "Наши услуги"',
        'fields' => array(
            array(
                'key'           => 'field_selected_services',
                'label'         => 'Выберите услуги',
                'name'          => 'selected_services',
                'type'          => 'relationship',
                'post_type'     => array('uslyga'),
                'filters'       => array('search'),
                'max'           => 4,
                'return_format' => 'object',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/our-services',
                ),
            ),
        ),
    ));

    // вопросы
    acf_add_local_field_group(array(
        'key'    => 'group_faq_fields',
        'title'  => 'Детали вопроса',
        'fields' => array(
            array(
                'key'   => 'field_faq_views',
                'label' => 'Количество просмотров',
                'name'  => 'faq_views',
                'type'  => 'number',
                'default_value' => 0,
            ),
            array(
                'key'   => 'field_faq_date',
                'label' => 'Дата создания',
                'name'  => 'faq_date',
                'type'  => 'date_picker',
                'display_format' => 'd.m.Y',
                'return_format'  => 'd.m.Y',
            ),
            array(
                'key'          => 'field_faq_related_page',
                'label'        => 'Связанная страница',
                'name'         => 'faq_related_page',
                'type'         => 'post_object',
                'post_type'    => array('page'),
                'return_format'=> 'id',
                'required'     => 1,
                'instructions' => 'Выберите страницу, к которой относится этот вопрос.',
            ),
            array(
                'key'          => 'field_faq_image',
                'label'        => 'Изображение вопроса',
                'name'         => 'faq_image',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
                'library'      => 'all',
                'instructions' => 'Загрузите изображение для этого вопроса (если необходимо).',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'faq',
                ),
            ),
        ),
    ));

    //содержание статьи
    acf_add_local_field_group(array(
        'key'      => 'group_content_table',
        'title'    => 'Содержание статьи',
        'fields'   => array(
            array(
                'key'          => 'field_content_items',
                'label'        => 'Пункты содержания',
                'name'         => 'content_items',
                'type'         => 'repeater',
                'button_label' => 'Добавить пункт',
                'sub_fields'   => array(
                    array(
                        'key'   => 'field_content_title',
                        'label' => 'Название пункта',
                        'name'  => 'content_title',
                        'type'  => 'text',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/content-table',
                ),
            ),
        ),
    ));

    // Настройки хедера
    acf_add_local_field_group(array(
        'key' => 'group_header_settings',
        'title' => 'Настройки хедера',
        'fields' => array(
            array(
                'key' => 'field_header_categories',
                'label' => 'Категории для отображения',
                'name' => 'header_categories',
                'type' => 'post_object',
                'post_type' => array('uslyga_category'), // Изменил на правильный CPT категорий
                'multiple' => true,
                'return_format' => 'id',
                'instructions' => 'Выберите категории услуг для отображения в меню',
            ),
            array(
                'key' => 'field_header_services',
                'label' => 'Услуги для отображения',
                'name' => 'header_services',
                'type' => 'relationship',
                'post_type' => array('uslyga'),
                'filters' => array('search'),
                'return_format' => 'id',
                'instructions' => 'Выберите услуги для отображения в меню',
            ),
            array(
                'key' => 'field_header_background_image',
                'label' => 'Фоновое изображение',
                'name' => 'header_background_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Выберите фон для меню',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'header-settings',
                ),
            ),
        ),
    ));    

    // Настройки сайта
    acf_add_local_field_group(array(
        'key' => 'group_site_settings',
        'title' => 'Основные настройки сайта',
        'fields' => array(
            array(
                'key' => 'field_site_phone',
                'label' => 'Телефон',
                'name' => 'site_phone',
                'type' => 'text',
            ),
            array(
                'key' => 'field_site_work_time',
                'label' => 'Время работы',
                'name' => 'site_work_time',
                'type' => 'text',
            ),
            array(
                'key' => 'field_site_address',
                'label' => 'Адрес',
                'name' => 'site_address',
                'type' => 'text',
            ),
            array(
                'key' => 'field_site_social_youtube',
                'label' => 'YouTube',
                'name' => 'site_social_youtube',
                'type' => 'url',
            ),
            array(
                'key' => 'field_site_social_vk',
                'label' => 'VK',
                'name' => 'site_social_vk',
                'type' => 'url',
            ),
            array(
                'key' => 'field_site_social_whatsapp',
                'label' => 'WhatsApp',
                'name' => 'site_social_whatsapp',
                'type' => 'url',
            ),
            array(
                'key' => 'field_site_social_telegram',
                'label' => 'Telegram',
                'name' => 'site_social_telegram',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'site-settings',
                ),
            ),
        ),
    ));
    


});



