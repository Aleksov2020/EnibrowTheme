<?php get_header(); ?>

<?php
// Получаем данные мастера
$master_name = get_field('master_name');
$master_surname = get_field('master_surname');
$master_rank = get_field('master_rank');
$master_experience = get_field('master_experience');
$master_photo = get_field('master_photo');
$master_education = get_field('master_education');
$master_likes = get_field('master_likes');
$master_reviews_count = (int) get_field('master_review_count', $master_id);
$master_rating = (float) get_field('master_rating', $master_id);
$services_prices = get_field('services_prices');
$master_bio = get_field('master_bio') ?: 'Информация отсутствует';
$master_extra_education = get_field('master_extra_education') ?: [];
?>
<div class="main-wrapper page-master-wrapper col">

    <div class="colored-wrapper col">
        <div class="master-page-slider wrapper row">
            <div class="master-page-slider-left page col">
                <div class="master-title-wrapper col">
                    <div class="breadcrumbs row">
                        <div class="breadcrumbs-page-name light-text-300">
                            <a href="<?php echo home_url(); ?>">Главная</a>
                        </div>
                        <div class="breadcrumbs-separator"></div>
                        <div class="breadcrumbs-page-name light-text-300 active">
                            <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a>
                        </div>
                    </div>

                    <div class="master-page-slider-content col">
                        <div class="title">
                            <div class="master-page-title">
                                Мастер <?php echo esc_html($master_name . ' ' . $master_surname); ?>
                            </div>
                        </div>

                        <div class="master-page-slider-content-badge-wrapper row">
                            <?php if ($master_rank) : ?>
                                <div class="master-page-slider-content-badge row text-16-500 colored-text">
                                    <div class="master-page-slider-content-badge-icon icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/topIcon.svg" alt="top">
                                    </div>
                                    <?php echo esc_html($master_rank); ?>
                                </div>
                            <?php endif; ?>

                            <div class="master-page-slider-content-badge row colored-text">
                                <div class="master-page-slider-content-badge-icon icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/badge-master.svg" alt="top">
                                </div>
                                Квалификация подтверждена
                            </div>

                            <div class="master-page-slider-content-badge row colored-text">
                                Стаж <?php echo esc_html($master_experience); ?> лет
                            </div>
                        </div>

                        <div class="master-page-slider-education-photo-wrapper row">
                            <div class="master-page-slider-right-tablet">
                                <img src="<?php echo esc_url($master_photo['url']); ?>" class="master-page-slider-right-img" alt="<?php echo esc_attr($master_name); ?>" width="600" height="892">
                                <div class="master-page-slider-rate-wrapper col">
                                    <div class="master-page-slider-rate-value-wrapper row">
                                        <div class="master-page-slider-rate-icon icon">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/starYellow.svg" alt="star" width="19" height="19">
                                        </div>
                                        <div class="master-page-slider-rate-value text-26-400">
                                            <?php echo esc_html($master_rating); ?>
                                        </div>
                                    </div>
                                    <div class="master-page-slider-rate-reviews-button text-12-500 colored-text">
                                        <?php echo esc_html($master_reviews_count); ?> отзывов
                                    </div>
                                </div>
                            </div>

                            <div class="master-page-slider-education col">
                                <div class="master-page-slider-education-title text-16-300">
                                    Образование мастера:
                                </div>
                                <?php if ($master_education) : ?>
                                    <?php $edu_count = count($master_education); ?>
                                    <div class="master-education-list">
                                        <?php foreach ($master_education as $index => $edu) : ?>
                                            <?php if ($index < 2) : ?>
                                                <div class="master-page-slider-education-item-wrapper row">
                                                    <div class="master-page-slider-education-item-year text-16-500 colored-text">
                                                        <?php echo esc_html($edu['edu_year']); ?>
                                                    </div>
                                                    <div class="master-page-slider-education-item-value text-16-300">
                                                        <?php echo esc_html($edu['edu_place']); ?>
                                                    </div>
                                                    <div class="master-page-about-exp-icon icon">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/checkGreenIcon.svg" alt="check" width="14" height="30">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if ($edu_count > 2) : ?>
                                        <div class="master-page-slider-education-button-more text-16-500 colored-text">
                                            <a href="#full-education-section">Подробнее</a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="master-page-slider-price-wrapper col text-16-300">
                            <div class="master-page-slider-price-title">
                                Стоимость процедуры:
                            </div>
                            <div class="master-page-slider-price-inner row">
                                <?php if ($services_prices) : ?>
                                    <?php foreach ($services_prices as $service) : ?>
                                        <div class="master-page-slider-price-item-wrapper row">
                                            <div class="master-page-slider-price-item-value">
                                                <?php echo get_the_title($service['uslyga']); ?>
                                            </div>
                                            <div class="master-page-slider-price-item-separator"></div>
                                            <div class="master-page-slider-price-value">
                                                от <?php echo esc_html($service['price']); ?> ₽
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Цены на услуги отсутствуют.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="button row button-primary button-animation-left-to-right">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/whitePlus.svg" width="14" height="14"/>
                            <div class="button-label">
                                Записаться к мастеру
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="master-page-slider-right">
                <img src="<?php echo esc_url($master_photo['url']); ?>" class="master-page-slider-right-img" alt="<?php echo esc_attr($master_name); ?>" width="600" height="892">
                <div class="master-page-slider-rate-wrapper col">
                    <div class="master-page-slider-rate-value-wrapper row">
                        <div class="master-page-slider-rate-icon icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/starYellow.svg" alt="star" width="19" height="19">
                        </div>
                        <div class="master-page-slider-rate-value text-26-400">
                            <?php echo esc_html($master_rating); ?>
                        </div>
                    </div>
                    <div class="master-page-slider-rate-reviews-button text-12-500 colored-text">
                        <?php echo esc_html($master_reviews_count); ?> отзывов
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Блок Опыт работы, Биография и Образование -->
    <div class="master-page-about-wrapper wrapper row">
        <div class="master-page-about col">
            <?php if ($master_experience): ?>
            <div class="master-page-about-title colored-text text-20-500">
                Опыт работы
            </div>
            <div class="master-page-about-text text-16-300">
                С <?php echo date('Y') - esc_html($master_experience); ?> года
            </div>
            <?php endif; ?>
            <div class="master-page-about-title colored-text text-20-500">
                Немного слов о себе
            </div>
            <div class="master-page-about-text text-16-300">
                <?php echo esc_html($master_bio); ?>
            </div>
        </div>
        <div class="master-page-about col" id="full-education-section">
            <div class="master-page-about-title colored-text text-20-500">
                Образование
            </div>
            <div class="master-page-about-text text-16-300 col">
                <?php if ($master_education) : ?>
                    <?php foreach ($master_education as $edu) : ?>
                        <div class="master-page-about-exp-wrapper row">
                            <div class="master-page-about-exp-year colored-text text-16-500">
                                <?php echo esc_html($edu['edu_year']); ?>
                            </div>
                            <div class="master-page-about-exp-value colored-text text-16-300">
                                <?php echo esc_html($edu['edu_place']); ?>
                            </div>
                            <div class="master-page-about-exp-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/checkGreenIcon.svg" alt="check" width="14" height="30">
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="master-page-about-title colored-text text-20-500">
                Дополнительное образование
            </div>
            <div class="master-page-about-text text-16-300 col">
                <?php if ($master_extra_education) : ?>
                    <?php foreach ($master_extra_education as $edu) : ?>
                        <div class="master-page-about-exp-wrapper row">
                            <div class="master-page-about-exp-year colored-text text-16-500">
                                <?php echo esc_html($edu['extra_edu_year']); ?>
                            </div>
                            <div class="master-page-about-exp-value colored-text text-16-300">
                                <?php echo esc_html($edu['extra_edu_place']); ?>
                            </div>
                            <div class="master-page-about-exp-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/checkGreenIcon.svg" alt="check" width="14" height="30">
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php the_content(); ?>












    <?php get_footer(); ?>
</div>


