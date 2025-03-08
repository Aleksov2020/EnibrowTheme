<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit;
}
add_action('acf/init', function() {
    // video
    if (function_exists('acf_add_local_field_group')) {
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
    }

    // reviews
    if (function_exists('acf_add_local_field_group')) {
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
    }


    //service
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_service_fields',
            'title' => 'Детали услуги',
            'fields' => array(
                array(
                    'key' => 'field_service_category',
                    'label' => 'Категория услуги',
                    'name' => 'service_category',
                    'type' => 'post_object',
                    'post_type' => array('service_category'),
                    'return_format' => 'id',
                ),
                array(
                    'key' => 'field_show_price_on_main',
                    'label' => 'Выводить цену на главной',
                    'name' => 'show_price_on_main',
                    'type' => 'true_false',
                    'ui' => 1,
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'service',
                    ),
                ),
            ),
        ));
    }

    // masters
    if (function_exists('acf_add_local_field_group')) {
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
                    'key'   => 'field_master_likes',
                    'label' => 'Количество лайков',
                    'name'  => 'master_likes',
                    'type'  => 'number',
                    'default_value' => 0,
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
    }

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

    // Service Category
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key'    => 'group_service_category_fields',
            'title'  => 'Настройки категории услуг',
            'fields' => array(
                array(
                    'key'   => 'field_full_service_name',
                    'label' => 'Полное имя категории',
                    'name'  => 'full_service_name',
                    'type'  => 'text',
                    'placeholder' => 'Введите полное имя категории...',
                ),
                array(
                    'key'   => 'field_service_recommendations',
                    'label' => 'Рекомендации',
                    'name'  => 'service_recommendations',
                    'type'  => 'relationship',
                    'post_type' => array('recommendation'),
                    'max' => 4, // Ограничение до 4 рекомендаций
                    'return_format' => 'id',
                ),
                array(
                    'key'   => 'field_linked_services',
                    'label' => 'Связанные услуги',
                    'name'  => 'linked_services',
                    'type'  => 'message',
                    'message' => 'Этот список заполняется автоматически на основе выбранной категории в услугах.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'service_category',
                    ),
                ),
            ),
        ));
    }


    // Portfolio
    if (function_exists('acf_add_local_field_group')) {
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
    }
    
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key'    => 'group_service_fields',
            'title'  => 'Детали услуги',
            'fields' => array(
                array(
                    'key'   => 'field_service_short_name',
                    'label' => 'Короткое имя услуги (для фильтра)',
                    'name'  => 'service_short_name',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_service_category',
                    'label' => 'Категория услуги',
                    'name'  => 'service_category',
                    'type'  => 'taxonomy',
                    'taxonomy' => 'service_category',
                    'field_type' => 'select',
                    'return_format' => 'id',
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
                    'key'   => 'field_service_recommendations',
                    'label' => 'Рекомендации',
                    'name'  => 'service_recommendations',
                    'type'  => 'relationship',
                    'post_type' => array('recommendation'),
                    'max' => 4,
                    'return_format' => 'id',
                ),
                array(
                    'key'   => 'field_service_portfolio_works',
                    'label' => 'Работы портфолио',
                    'name'  => 'service_portfolio_works',
                    'type'  => 'relationship',
                    'post_type' => array('portfolio_work'),
                    'return_format' => 'id',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'service',
                    ),
                ),
            ),
        ));
    }
    
    


    // Группа полей для рекламного блока Enibrow
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
});



