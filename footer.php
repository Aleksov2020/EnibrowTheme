<footer class="wrapper wrapper-laptop col">
    <div class="map-wrapper col">
        <div class="contact-widget col">
            <div class="contact-widget-title">Наши контакты</div>

            <!-- Телефон -->
            <div class="contact-widget-phone-wrapper row">
                <div class="contact-widget-phone-icon icon">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/phone.svg'); ?>" alt="phone-icon" width="18" height="18">
                </div>
                <div class="contact-widget-phone">
                    <?php echo esc_html(get_theme_mod('mytheme_footer_phone')); ?>
                </div>
            </div>

            <!-- Соцсети -->
            <div class="contact-widget-social-wrapper row">
                <a href="<?php echo esc_url(get_theme_mod('mytheme_footer_social_vk')); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/VK.svg'); ?>" alt="vk" width="35" height="35">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('mytheme_footer_social_whatsapp')); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/WA.svg'); ?>" alt="wa" width="35" height="35">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('mytheme_footer_social_youtube')); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/YT.svg'); ?>" alt="yt" width="45" height="35">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('mytheme_footer_social_telegram')); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/TG.svg'); ?>" alt="tg" width="35" height="35">
                </a>
            </div>

            <!-- Время работы -->
            <div class="contact-widget-work-time colored-text">
                <?php echo esc_html(get_theme_mod('mytheme_footer_work_time')); ?>
            </div>

            <!-- Адрес -->
            <div class="contact-widget-address-wrapper row">
                <div class="contact-widget-address-icon icon">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/mapPoint.svg'); ?>" alt="map-point" width="12" height="15">
                </div>
                <div class="contact-widget-address">
                    <?php echo esc_html(get_theme_mod('mytheme_footer_address')); ?>
                </div>
            </div>

            <!-- Кнопка -->
            <div class="contact-widget-button button button-primary">
                <?php echo esc_html(get_theme_mod('mytheme_footer_button_text')); ?>
            </div>
        </div>
    </div>

    <div class="footer-bottom-law-wrapper col">
        <div class="footer-bottom-law-name">
            <?php echo esc_html(get_theme_mod('mytheme_footer_copyright')); ?>
        </div>
        <div class="footer-bottom-law-info">
            <?php echo esc_html(get_theme_mod('mytheme_footer_legal_info')); ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
