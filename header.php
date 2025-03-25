<?php
/**
 * Шаблон шапки (header.php)
 * Вставьте этот файл в папку вашей темы: wp-content/themes/ВАША_ТЕМА/
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(''); ?></title>
  <?php wp_head(); ?>
</head>

<body>

<div class="header-position-wrapper row">
  <header class="col wrapper">
    <div class="header row">

      <!-- ЛОГОТИП -->
      <div class="logo">
        <!-- Ссылка на главную -->
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo.svg'); ?>"
            alt="<?php bloginfo('name'); ?>"
            width="259"
            height="110">
        </a>
      </div>

      <!-- Блок для мобильных -->
      <div class="mobile-header-wrapper">
        <div class="logo-mobile-wrapper row">

          <!-- Кнопка-меню (бургер) -->
          <div class="button-show-mobile-menu button-mobile-circle">
            <!-- Ваши SVG-иконки гамбургера/точек -->
            <svg class="points" xmlns="http://www.w3.org/2000/svg" width="11" height="4" viewBox="0 0 11 4" fill="none">
              <rect width="4" height="4" rx="2" fill="white"/>
              <rect x="7" width="4" height="4" rx="2" fill="white"/>
            </svg>
            <svg class="points" xmlns="http://www.w3.org/2000/svg" width="11" height="4" viewBox="0 0 11 4" fill="none">
              <rect width="4" height="4" rx="2" fill="white"/>
              <rect x="7" width="4" height="4" rx="2" fill="white"/>
            </svg>
            <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
              <rect x="2" y="2" width="41" height="41" rx="20.5" fill="white"/>
              <rect x="1" y="1" width="43" height="43" rx="21.5" stroke="white" stroke-opacity="0.5" stroke-width="2"/>
              <path d="M16.8451 16.8432L28.1588 28.1569M28.5123 16.4896L16.4915 28.5104" stroke="#825E69" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>

          <!-- Логотип (мобильный) -->
          <div class="logo-mobile">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo.svg'); ?>"
                alt="<?php bloginfo('name'); ?>"
                width="259"
                height="110">
            </a>
          </div>

          <!-- Повторная кнопка гамбургера -->
          <div class="button-show-mobile-menu button-mobile-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
              <path d="M8.38674 20.1667H4.46586C3.31013 20.1667 2.73225 20.1667 2.29082 19.9366C1.90252 19.7343 1.58683 19.4113 1.38899 19.0141C1.16406 18.5625 1.16406 17.9713 1.16406 16.789V6.65564C1.16406 5.47331 1.16406 4.88213 1.38899 4.43055C1.58683 4.03331 1.90252 3.71035 2.29082 3.50796C2.73225 3.27786 3.31013 3.27786 4.46586 3.27786H16.4349C17.5906 3.27786 18.1685 3.27786 18.6099 3.50796C18.9982 3.71035 19.3139 4.03331 19.5117 4.43055C19.7367 4.88213 19.7367 5.47331 19.7367 6.65564V8.55564M5.29131 1.16675V3.27786M15.6094 1.16675V3.27786M1.16406 7.50008H19.7367M11.9981 11.7224L5.29131 11.7223M8.38674 15.9446L5.29131 15.9445M12.514 20.1667L14.6034 19.7392C14.7855 19.702 14.8766 19.6833 14.9615 19.6492C15.037 19.619 15.1087 19.5798 15.175 19.5324C15.2499 19.4789 15.3156 19.4118 15.447 19.2773L19.7367 14.889C20.3065 14.306 20.3065 13.3608 19.7367 12.7779C19.1668 12.1949 18.2429 12.1949 17.673 12.7779L13.3834 17.1662C13.2519 17.3007 13.1863 17.3678 13.1341 17.4445C13.0878 17.5123 13.0494 17.5857 13.0199 17.6629C12.9866 17.7497 12.9683 17.8429 12.9319 18.0292L12.514 20.1667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>

          <!-- Адрес (мобильный) -->
          <div class="address light-text row">
            <div class="icon">
              <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/mapPoint.svg'); ?>"
                alt="mapPoint"
                width="10"
                height="12">
            </div>
            <div class="label-address colored-text">
              г. Москва, Посланников переулок., 1 -  метро Бауманская
            </div>
          </div>
        </div>

        <!-- Блок с телефоном + кнопка (мобильный) -->
        <div class="header__right-part-mobile row">
          <div class="header__phone-wrapper row">
            <div class="phone-wrapper col">
              <div class="phone row">
                <div class="icon">
                  <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/phone.svg'); ?>"
                    alt="phone"/>
                </div>
                <div class="phone-label">+7 (906) 933-99-99</div>
              </div>
              <div class="work-time light-text colored-text">
                Пн-Пт с 08:00 до 21:00
              </div>
            </div>
            <div class="button row button-primary button-animation-left-to-right">
              <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/whitePlus.svg'); ?>"
                alt="plus"
                width="14"
                height="14"/>
              <div class="button-label">Запись онлайн</div>
            </div>
          </div>
        </div>
      </div>
      <!-- Конец мобильной части -->

      <!-- Меню (ПК-версия) -->
      <div class="menu row">
        <div class="header__left-part col">
        <div class="header__contacts row">
        <!-- Соц. сети -->
        <div class="social-links row">
          <!-- YouTube -->
          <a class="social-link yt" 
            href="<?php echo esc_url( get_theme_mod('mytheme_social_youtube') ); ?>" 
            target="_blank" 
            rel="noopener noreferrer">
            <!-- Можно вставить иконку или оставить стилями -->
          </a>
          <!-- VK -->
          <a class="social-link vk"
            href="<?php echo esc_url( get_theme_mod('mytheme_social_vk') ); ?>"
            target="_blank"
            rel="noopener noreferrer">
          </a>
          <!-- WhatsApp -->
          <a class="social-link wa"
            href="<?php echo esc_url( get_theme_mod('mytheme_social_whatsapp') ); ?>"
            target="_blank"
            rel="noopener noreferrer">
          </a>
          <!-- Telegram -->
          <a class="social-link tg"
            href="<?php echo esc_url( get_theme_mod('mytheme_social_telegram') ); ?>"
            target="_blank"
            rel="noopener noreferrer">
          </a>
        </div>

        <div class="address light-text row">
          <div class="icon">
            <img
              src="<?php echo esc_url(get_template_directory_uri() . '/assets/mapPoint.svg'); ?>"
              alt="mapPoint"
              width="10"
              height="12">
          </div>
          <div class="label-address colored-text">
            <?php echo esc_html( get_theme_mod('mytheme_address') ); ?>
          </div>
        </div>
      </div>

          <!-- Навигация (редактируемая из админки, если зарегистрировали меню) -->
          <nav class="nav-pc row">
            <div class="wrapper-mobile-contacts">
              <div class="header__phone-wrapper col">
                <div class="phone-wrapper col">
                  <div class="phone row">
                    <div class="icon">
                      <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/phone.svg'); ?>"
                        alt="phone"/>
                    </div>
                    <div class="phone-label">
                      <?php echo esc_html( get_theme_mod('mytheme_phone') ); ?>
                    </div>
                  </div>
                  <div class="work-time light-text colored-text">
                    <?php echo esc_html( get_theme_mod('mytheme_work_time') ); ?>
                  </div>
                </div>

                <div class="label-address colored-text">
                  <?php echo esc_html( get_theme_mod('mytheme_address2') ); ?>
                </div>

                <div class="button row button-primary button-animation-left-to-right">
                  <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/whitePlus.svg'); ?>"
                    alt="plus"
                    width="14"
                    height="14"/>
                  <div class="button-label">
                    <?php echo esc_html( get_theme_mod('mytheme_online_button_text') ); ?>
                  </div>
                </div>

                <div class="social-links row">
                  <a class="social-link yt"
                    href="<?php echo esc_url( get_theme_mod('mytheme_social_youtube') ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"></a>
                  <a class="social-link vk"
                    href="<?php echo esc_url( get_theme_mod('mytheme_social_vk') ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"></a>
                  <a class="social-link wa"
                    href="<?php echo esc_url( get_theme_mod('mytheme_social_whatsapp') ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"></a>
                  <a class="social-link tg"
                    href="<?php echo esc_url( get_theme_mod('mytheme_social_telegram') ); ?>"
                    target="_blank"
                    rel="noopener noreferrer"></a>
                </div>
              </div>
            </div>
            <?php
            // Получаем выбранные категории и услуги через ACF
            $selected_categories = get_field('header_categories', 'option');
            $selected_services = get_field('header_services', 'option');
            $background_image = get_field('header_background_image', 'option');
            ?>

            <div class="nav__item text-17-400 colored-text">
                <div class="label-nav__item row">
                    Услуги
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/arrowBotIcon.svg'); ?>" alt="arrow" width="9" height="5">
                </div>
                <div class="services-header-wrapper full-width-container row">
                    <div class="wrapper row service-header-wrapper-inner">
                        <?php if ($selected_categories): ?>
                            <?php foreach ($selected_categories as $category_id): ?>
                                <?php $category = get_post($category_id); ?>
                                <?php if ($category): ?>
                                    <div class="full-width-container-col col">
                                        <div class="full-width-container-title row">
                                            <div class="full-width-container-title-icon icon">
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/liIcon.svg'); ?>" alt="li" width="6" height="10">
                                            </div>
                                            <div class="full-width-container-title-value text-16-500">
                                                <a href="<?php echo esc_url(get_permalink($category->ID)); ?>" class="category-link">
                                                    <?php echo esc_html($category->post_title); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="full-width-container-separator"></div>
                                        
                                        <?php if ($selected_services): ?>
                                            <?php foreach ($selected_services as $service_id): ?>
                                                <?php $service = get_post($service_id); ?>
                                                <?php
                                                // Проверяем связь услуги с категорией через ACF
                                                $service_category_id = get_field('usl_cat_field', $service_id);
                                                ?>
                                                <?php if ($service && $service_category_id == $category_id): ?>
                                                    <div class="full-width-container-item text-16-300">
                                                        <a href="<?php echo esc_url(get_permalink($service->ID)); ?>" class="service-link">
                                                            <?php echo esc_html($service->post_title); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="full-width-container-image" style="background-image: url('<?php echo esc_url($background_image); ?>');">
                        </div>
                    </div>
                </div>
            </div>


            <div class="nav__item text-17-400 colored-text">
              <a href="/prices/" class="label-nav__item row">Цены</a>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <div class="label-nav__item row">Портфолио</div>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <a href="/about/" class="label-nav__item row">
                О студии
                <img
                  src="<?php echo esc_url(get_template_directory_uri() . '/assets/arrowBotIcon.svg'); ?>"
                  alt="arrow"
                  width="9"
                  height="5">
              </a>
              <div class="services-header-wrapper container-about col">
                <div class="service-header-wrapper-item row colored-text">
                  О нас
                </div>
                <div class="service-header-wrapper-item row colored-text">
                  Мастера
                </div>
                <div class="service-header-wrapper-item row colored-text">
                  Акции
                  <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/saleRedIcon.svg'); ?>"
                    alt="saleRed"
                    width="17"
                    height="16">
                </div>
                <div class="service-header-wrapper-item row colored-text">
                  Отзывы
                </div>
                <div class="service-header-wrapper-item row colored-text">
                  Видео
                </div>
              </div>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <div class="label-nav__item row">Статьи</div>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <div class="label-nav__item row">Вопросы</div>
            </div>

            <!-- Соц. ссылки для мобильной версии -->
            <div class="social-links-mobile row">
              <div class="social-link yt"></div>
              <div class="social-link vk"></div>
              <div class="social-link wa"></div>
              <div class="social-link tg"></div>
            </div>
          </nav>
        </div>

        <!-- Правая часть (ПК): телефон + кнопка -->
        <div class="header__right-part row">
          <div class="header__phone-wrapper row">
            <div class="phone-wrapper col">
              <div class="phone row">
                <div class="icon">
                  <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/phone.svg'); ?>"
                    alt="phone"/>
                </div>
                <div class="phone-label">+7 (906) 933-99-99</div>
              </div>
              <div class="work-time light-text colored-text">
                Пн-Пт с 08:00 до 21:00
              </div>
            </div>
            <div class="button row button-primary button-animation-left-to-right order-button">
              <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/whitePlus.svg'); ?>"
                alt="plus"
                width="14"
                height="14"/>
              <div class="button-label">Запись онлайн</div>
            </div>
          </div>
        </div>

        <!-- Низ мобильного меню -->
        <div class="mobile-header-footer row">
          <div class="button-header-footer phone-footer-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
              <path d="M14.0066 13.6071C13.9717 13.8709 13.8772 14.1342 13.7175 14.3814C13.5579 14.6286 13.3635 14.8564 13.1197 15.0626C12.7078 15.4107 12.2738 15.644 11.802 15.7679C11.3375 15.8928 10.848 15.9249 10.3344 15.8569C9.58601 15.7579 8.80952 15.4762 8.01325 15.0056C7.21698 14.5349 6.43719 13.9397 5.68122 13.221C4.91888 12.4939 4.20929 11.7067 3.54609 10.8511C2.89119 9.98921 2.31451 9.10035 1.81605 8.18457C1.32492 7.26976 0.951196 6.37049 0.708568 5.49602C0.466909 4.61423 0.396496 3.79237 0.497329 3.03044C0.563257 2.53226 0.714324 2.06771 0.948589 1.65144C1.18382 1.22785 1.51693 0.854476 1.95428 0.539629C2.48494 0.140222 3.0286 -0.0189201 3.57156 0.0529336C3.777 0.0801215 3.97662 0.151267 4.14842 0.263456C4.32755 0.376616 4.47886 0.530821 4.58572 0.73878L5.97091 3.35972C6.07874 3.56035 6.15183 3.74148 6.19653 3.91139C6.2422 4.07398 6.25853 4.23269 6.24011 4.37189C6.21684 4.54771 6.14221 4.71675 6.01719 4.87165C5.89951 5.02753 5.73683 5.18491 5.53747 5.33744L4.90325 5.84241C4.81187 5.91232 4.76258 6.00271 4.74707 6.11993C4.73931 6.17853 4.73987 6.23079 4.74678 6.29134C4.76104 6.35286 4.77723 6.39973 4.78609 6.44563C4.88617 6.70487 5.07193 7.05 5.34435 7.47369C5.62411 7.89835 5.92491 8.33324 6.25506 8.77202C6.59988 9.21275 6.93391 9.62222 7.27915 10.0034C7.61803 10.3762 7.90444 10.6377 8.13645 10.8026C8.1712 10.8221 8.21231 10.8499 8.26077 10.8787C8.31655 10.9085 8.37428 10.9236 8.44032 10.9323C8.56505 10.9488 8.66625 10.9175 8.75762 10.8476L9.38797 10.3719C9.59564 10.213 9.79015 10.0971 9.97054 10.0315C10.1529 9.95131 10.3284 9.92236 10.5118 9.94663C10.6513 9.96508 10.7941 10.0138 10.9468 10.1011C11.0995 10.1884 11.2557 10.306 11.4226 10.4548L13.6234 12.4979C13.7967 12.655 13.9084 12.8263 13.9649 13.0201C14.014 13.213 14.0338 13.402 14.0066 13.6071Z" fill="white"/>
            </svg>
            Позвонить
          </div>
          <div class="button-header-footer">Записаться</div>
        </div>
      </div> <!-- Конец .menu.row -->
    </div> <!-- Конец .header.row -->
  </header>
</div> <!-- Конец .header-position-wrapper.row -->
