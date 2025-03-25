<?php
// Получаем текущую услугу (post ID)
$service_id = get_the_ID();

if (!$service_id) {
    echo '<p>Услуга не найдена.</p>';
    return;
}

// Получаем работы портфолио, связанные с данной услугой
$portfolio_works = get_field('service_portfolio_works', $service_id);

if (empty($portfolio_works)) {
    echo '<p>Нет работ в портфолио для этой услуги.</p>';
    return;
}
?>

<div class="gallery wrapper wrapper-laptop col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Фото работ</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

    <div class="gallery-items-wrapper row">
        <?php foreach ($portfolio_works as $index => $work_id):
            $image = get_field('portfolio_image', $work_id);
            $master_id = get_field('portfolio_master', $work_id);
            $master_name = get_field('master_name', $master_id);
            $master_photo = get_field('master_photo', $master_id);
            $master_likes = get_field('master_likes', $master_id);
            $master_rank = get_field('master_rank', $master_id);
        ?>
        <div class="gallery-item">
            <div class="gallery-photo" onclick="openGallery(<?= $index; ?>, window.galleryData);">
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr(get_the_title($work_id)); ?>" width="276" height="276">
                <?php endif; ?>
            </div>
            <div class="gallery-text col">
                <div class="gallery-master-card row">
                    <div class="gallery-master-card-left-wrapper row">
                        <div class="gallery-master-photo clickable">
                            <?php if ($master_photo): ?>
                                <img src="<?php echo esc_url($master_photo['url']); ?>" width="51" height="51" alt="<?php echo esc_attr($master_name); ?>"/>
                            <?php endif; ?>
                        </div>
                        <div class="gallery-master-info-wrapper col">
                            <div class="gallery-master-badge-wrapper row clickable">
                                <?php if ($master_rank): ?>
                                    <div class="gallery-master-badge light-text-500 clickable">
                                        <?php echo esc_html($master_rank); ?>&nbsp;
                                    </div>
                                <?php endif; ?>
                                <div class="gallery-master-post light-text-500 colored-text clickable">
                                    Мастер:
                                </div>
                            </div>
                            <div class="gallery-master-name text-16-500 colored-text clickable">
                                <?php echo esc_html($master_name); ?>
                            </div>
                        </div>
                    </div>
                    <div class="gallery-master-cards-likes-wrapper col">
                        <div class="gallery-master-cards-likes-photo row clickable">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                                <path d="M9.14945 3.42589L10 4.80155L10.8506 3.42589C11.5789 2.24796 12.858 1.5 14.3182 1.5C16.5889 1.5 18.5 3.42492 18.5 5.83333C18.5 6.87433 18.0316 8.0043 17.2012 9.16973C16.3776 10.3257 15.2585 11.4311 14.1059 12.4018C12.9578 13.3685 11.805 14.178 10.9365 14.7468C10.5626 14.9916 10.2432 15.1908 10.0019 15.3375C9.76029 15.1896 9.44036 14.9888 9.06581 14.742C8.19701 14.1696 7.04368 13.3558 5.89518 12.386C4.742 11.4122 3.62241 10.305 2.79834 9.15033C1.96702 7.98551 1.5 6.86161 1.5 5.83333C1.5 3.42492 3.41107 1.5 5.68182 1.5C7.14196 1.5 8.42115 2.24796 9.14945 3.42589Z" stroke="#C0C0C0" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="gallery-master-cards-likes-counter">
                            <?php echo esc_html($master_likes); ?>
                        </div>
                    </div>
                </div>
                <div class="buttons-wrapper col">
                    <div class="button button-primary">
                        Записаться
                    </div>
                    <div class="button-label">
                        Подробнее о мастере
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
