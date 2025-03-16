<?php 
$recommendations = get_field('service_recommendations', get_the_ID()); 

if ($recommendations): 
?>
    <div class="service-blog wrapper row">
        <?php foreach ($recommendations as $recommendation_id): 
            $title = get_the_title($recommendation_id);
            $link = get_field('recommendation_link', $recommendation_id);
            $icon = get_field('recommendation_icon', $recommendation_id);
            $reading_time = get_field('recommendation_time', $recommendation_id);
        ?>
            <div class="service-blog-item col">
                <div class="service-blog-item-title-wrapper row">
                    <div class="service-blog-item-title-icon icon">
                        <?php if ($icon): ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="icon" width="40" height="40">
                        <?php endif; ?>
                    </div>
                    <div class="service-blog-item-title-value colored-text text-16-500">
                        <?php echo esc_html($title); ?>
                    </div>
                </div>
                <div class="service-blog-item-button">
                    <a href="<?php echo esc_url($link); ?>" class="button button-primary">
                        Подробнее
                    </a>
                </div>
                <div class="service-blog-item-time-wrapper row">
                    <div class="service-blog-item-time-icon icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/clockIcon.svg" alt="clock" width="17" height="17">
                    </div>
                    <div class="service-blog-item-time-value light-text">
                        <?php echo esc_html($reading_time); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
