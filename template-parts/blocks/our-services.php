<?php
$services = get_field('selected_services');

if ($services): ?>
    <div class="page-galley-subservice-wrapper col">
        <div class="title-wrapper row">
            <div class="title-left-arrow row">
                <div class="spacer-title"></div>
                <div class="circle-title"></div>
            </div>
            <div class="title">
                <h2>Наши услуги</h2>
            </div>
            <div class="title-right-arrow row">
                <div class="circle-title"></div>
                <div class="spacer-title"></div>
            </div>
        </div>

        <div class="subservice wrapper row">
            <?php foreach ($services as $service): ?>
                <div class="subservice-item col">
                    <div class="subservice-item-photo col">
                        <?php if (get_field('service_promotion', $service->ID)): ?>
                            <div class="subservice-item-badge badge-primary">
                                Акция
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="subservice-item-wrapper col">
                        <div class="subservice-item-title colored-text">
                            <a href="<?php echo esc_url(get_permalink($service->ID)); ?>">
                                <?php echo esc_html(get_the_title($service->ID)); ?>
                            </a>
                        </div>
                        <div class="subservice-item-text-wrapper col">
                            <div class="subservice-item-text-subtitle colored-text light-text-600">
                                О процедуре:
                            </div>
                            <div class="subservice-item-text-item row">
                                <div class="subservice-item-text-item-icon icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/coinSmall.svg" alt="coin">
                                </div>
                                <div class="subservice-item-text-item-label light-text-300">
                                    Стоимость
                                </div> 
                                <div class="subservice-item-text-item-separator"></div> 
                                <div class="subservice-item-text-item-value light-text-300">
                                    от <?php echo esc_html(get_field('service_price', $service->ID)); ?> ₽
                                </div> 
                            </div>
                            <div class="subservice-item-text-item row">
                                <div class="subservice-item-text-item-label-wrapper row">
                                    <div class="subservice-item-text-item-icon icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/clockSmall.svg" alt="clock">
                                    </div>
                                    <div class="subservice-item-text-item-label light-text-300">
                                        Длительность
                                    </div> 
                                </div>
                                <div class="subservice-item-text-item-separator"></div> 
                                <div class="subservice-item-text-item-value light-text-300">
                                    <?php echo esc_html(get_field('service_duration', $service->ID)); ?>
                                </div> 
                            </div>
                        </div>
                        <div class="subservice-button-wrapper row">
                            <a href="<?php echo esc_url(get_permalink($service->ID)); ?>" class="button button-primary">
                                Записаться
                            </a>
                            <a href="<?php echo esc_url(get_permalink($service->ID)); ?>" class="button button-bordered button-hover-white">
                                Подробнее
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="button button-primary"> Посмотреть все услуги </div>
    </div>
<?php endif; ?>
