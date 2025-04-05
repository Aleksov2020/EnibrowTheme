<?php
// Получаем все опубликованные акции
$promotions = get_posts(array(
    'post_type'      => 'promotion',
    'posts_per_page' => -1, // Вывести все акции
    'post_status'    => 'publish',
));

if (!empty($promotions)): ?>
    <div class="wrapper wrapper-laptop row">
        <div class="slider-home-wrapper">
            <div class="discont-slider-buttons-wrapper row">
                <div class="discont-slider-button prev-button clickable">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/arrowLeftIconColor.svg" alt="arrow-left" width="6" height="12">
                </div>
                <div class="discont-slider-button next-button clickable">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/arrowRightIconColor.svg" alt="arrow-right" width="6" height="12">
                </div>
            </div>
            <div class="slider-track row" style="width: calc(<?php echo count($promotions); ?> * 100%);">
                <?php foreach ($promotions as $promotion): ?>
                    <?php
                    $title = get_field('promotion_name', $promotion->ID);
                    $description = get_field('promotion_description', $promotion->ID);
                    $discount = get_field('promotion_discount', $promotion->ID);
                    $image = get_field('promotion_image', $promotion->ID);
                    $image_url = $image ? $image['url'] : '';
                    $link = get_permalink($promotion->ID);
                    ?>

                    <div class="discont discont-slide-item row">
                        <div class="discont-text-wrapper col">
                            <div class="discont-title">
                                <h2><?php echo esc_html($title); ?></h2>
                            </div>
                            <div class="discont-subtitle text-16-300">
                                <?php echo esc_html($description); ?>
                            </div>
                            <div class="discont-value">
                                скидка <?php echo esc_html($discount); ?> рублей
                            </div>
                        </div>
            
                        <div class="discont-slider row">
                            <div class="discont-filter row">
                                <div class="discont-slide col" style="background-image: url('<?php echo esc_url($image_url); ?>'); background-size: cover; background-position: center;">
                                    <a href="<?php echo esc_url($link); ?>" class="button button-primary-hover">
                                        Подробнее об акции
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                            <path d="M8.5 12.6667V12.6608M8.5 10.8809C8.5 8.20242 11 8.79758 11 6.71428C11 5.39932 9.88067 4.33333 8.5 4.33333C7.38058 4.33333 6.43301 5.03402 6.11444 6M16 8.5C16 12.6422 12.6422 16 8.5 16C4.35787 16 1 12.6422 1 8.5C1 4.35787 4.35787 1 8.5 1C12.6422 1 16 4.35787 16 8.5Z" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
