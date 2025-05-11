<footer class="wrapper wrapper-laptop col">
    <div class="map-wrapper col">
        <div class="contact-widget col">
            <div class="contact-widget-title">Наши контакты</div>
            <div class="contact-widget-phone-wrapper row">
                <div class="contact-widget-phone-icon icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/phone.svg" alt="phone-icon" width="18" height="18">
                </div>
                <div class="contact-widget-phone">
                    +7 (906) 933-99-99
                </div>
            </div>
            <div class="contact-widget-social-wrapper row">
                <div class="contact-widget-social-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/VK.svg" alt="vk" width="35" height="35">
                </div>
                <div class="contact-widget-social-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/WA.svg" alt="wa" width="35" height="35">
                </div>
                <div class="contact-widget-social-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/YT.svg" alt="yt" width="45" height="35">
                </div>
                <div class="contact-widget-social-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/TG.svg" alt="tg" width="35" height="35">
                </div>
            </div>
            <div class="contact-widget-work-time colored-text">
                Пн-Пт с 08:00 до 21:00
            </div>
            <div class="contact-widget-address-wrapper row">
                <div class="contact-widget-address-icon icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/mapPoint.svg" alt="map-point" width="12" height="15">
                </div>
                <div class="contact-widget-address">
                    г. Москва ул. Бауманская 43/1 стр.1
                </div>
            </div>
            <div class="contact-widget-buttons-wrapper row">
                <a href="#" class="contact-widget-button-map button">
                    <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.75297 14.924C5.75314 14.9241 5.75327 14.9242 6 14.5835L5.75297 14.924Z" fill="#FF0000"/>
                    </svg>
                    Перейти на карты
                </a>
                <div class="contact-widget-button button button-primary order-button">
                    Оставить заявку
                </div>
            </div>
        </div>
    </div>

    <div class="footer-navigation-wrapper row">
        <?php 
        $menu_items = array('Акции', 'Вопросы', 'Статьи', 'Прайс', 'О нашей студии', 'Отзывы', 'Видео', 'Портфолио', 'Мастера');
        foreach ($menu_items as $item) : ?>
            <div class="footer-nav-item"><?php echo esc_html($item); ?></div>
        <?php endforeach; ?>
    </div>

    <div class="footer-bottom-wrapper row">
        <div class="footer-bottom-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logoColored.png" alt="logo" width="209" height="60">
        </div>
        <div class="footer-bottom-banks-wrapper row hide-laptop">
            <?php 
            $banks = array('paymentCashIcon.svg', 'sbp.svg', 'sber.svg', 'alfa.svg', 'mir.svg', 'yoomoney.svg', 'halva.svg', 'yapay.svg');
            foreach ($banks as $bank) : ?>
                <div class="footer-bottom-banks-item icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo esc_attr($bank); ?>" alt="bank" width="20" height="20">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="footer-bottom-law-wrapper col">
            <div class="footer-bottom-law-name">
                © 2018-2024 ООО "ЦИТО ЭЙДЖ".
            </div>
            <div class="footer-bottom-law-info">
                ИНН: 7733868739. ОГРН: 1147746081482
            </div>
        </div>
    </div>
</footer>
