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
  <!-- Подключение библиотеки jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- Подключение jQuery плагина Masked Input -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

<div class="header-position-wrapper row">
  <header class="col wrapper">
    <div class="header row">

    <!-- ЛОГОТИП -->
    <div class="logo">
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
          <div class="button-show-mobile-menu button-mobile-circle order-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
              <path d="M8.38674 20.1667H4.46586C3.31013 20.1667 2.73225 20.1667 2.29082 19.9366C1.90252 19.7343 1.58683 19.4113 1.38899 19.0141C1.16406 18.5625 1.16406 17.9713 1.16406 16.789V6.65564C1.16406 5.47331 1.16406 4.88213 1.38899 4.43055C1.58683 4.03331 1.90252 3.71035 2.29082 3.50796C2.73225 3.27786 3.31013 3.27786 4.46586 3.27786H16.4349C17.5906 3.27786 18.1685 3.27786 18.6099 3.50796C18.9982 3.71035 19.3139 4.03331 19.5117 4.43055C19.7367 4.88213 19.7367 5.47331 19.7367 6.65564V8.55564M5.29131 1.16675V3.27786M15.6094 1.16675V3.27786M1.16406 7.50008H19.7367M11.9981 11.7224L5.29131 11.7223M8.38674 15.9446L5.29131 15.9445M12.514 20.1667L14.6034 19.7392C14.7855 19.702 14.8766 19.6833 14.9615 19.6492C15.037 19.619 15.1087 19.5798 15.175 19.5324C15.2499 19.4789 15.3156 19.4118 15.447 19.2773L19.7367 14.889C20.3065 14.306 20.3065 13.3608 19.7367 12.7779C19.1668 12.1949 18.2429 12.1949 17.673 12.7779L13.3834 17.1662C13.2519 17.3007 13.1863 17.3678 13.1341 17.4445C13.0878 17.5123 13.0494 17.5857 13.0199 17.6629C12.9866 17.7497 12.9683 17.8429 12.9319 18.0292L12.514 20.1667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>

          <!-- Адрес (мобильный) -->
          <div class="address light-text row">
            <div class="icon">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/mapPoint.svg'); ?>" alt="mapPoint" width="10" height="12">
            </div>
            <div class="label-address colored-text">
              <?php the_field('site_address', 'option'); ?>
            </div>
          </div>
        </div>

        <!-- Блок с телефоном + кнопка (мобильный) -->
        <div class="header__right-part-mobile row">
          <div class="header__phone-wrapper row">
            <div class="phone-wrapper col">
              <div class="phone row">
                <div class="icon">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/phone.svg'); ?>" alt="phone"/>
                </div>
                <div class="phone-label"><?php the_field('site_phone', 'option'); ?></div>
              </div>
              <div class="work-time light-text colored-text">
                <?php the_field('site_work_time', 'option'); ?>
              </div>
            </div>
            <div class="button row button-primary button-animation-left-to-right">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/whitePlus.svg'); ?>" alt="plus" width="14" height="14"/>
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
            <a class="social-link yt" href="<?php the_field('site_social_youtube', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
            <a class="social-link vk" href="<?php the_field('site_social_vk', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
            <a class="social-link wa" href="<?php the_field('site_social_whatsapp', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
            <a class="social-link tg" href="<?php the_field('site_social_telegram', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
          </div>

          <!-- Адрес -->
          <div class="address light-text row">
            <div class="icon">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/mapPoint.svg'); ?>" alt="mapPoint" width="10" height="12">
            </div>
            <div class="label-address colored-text">
              <?php the_field('site_address', 'option'); ?>
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
                      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/phone.svg'); ?>" alt="phone"/>
                    </div>
                    <div class="phone-label">
                      <?php the_field('site_phone', 'option'); ?>
                    </div>
                  </div>
                  <div class="work-time light-text colored-text">
                    <?php the_field('site_work_time', 'option'); ?>
                  </div>
                </div>

                <div class="label-address colored-text">
                  <?php the_field('site_address', 'option'); ?>
                </div>

                <div class="button row button-primary button-animation-left-to-right">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/whitePlus.svg'); ?>" alt="plus" width="14" height="14"/>
                  <div class="button-label">
                    Запись онлайн
                  </div>
                </div>

                <div class="social-links row">
                  <a class="social-link yt" href="<?php the_field('site_social_youtube', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
                  <a class="social-link vk" href="<?php the_field('site_social_vk', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
                  <a class="social-link wa" href="<?php the_field('site_social_whatsapp', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
                  <a class="social-link tg" href="<?php the_field('site_social_telegram', 'option'); ?>" target="_blank" rel="noopener noreferrer"></a>
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
                                    <?php $category_name = get_field('category_full_name', $category->ID) ?: $category->post_title; ?>
                                    <div class="full-width-container-col col">
                                        <div class="full-width-container-title row">
                                            <div class="full-width-container-title-icon icon">
                                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/liIcon.svg'); ?>" alt="li" width="6" height="10">
                                            </div>
                                            <div class="full-width-container-title-value text-16-500">
                                                <a href="<?php echo esc_url(get_permalink($category->ID)); ?>" class="category-link">
                                                    <?php echo esc_html($category_name); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="full-width-container-separator"></div>

                                        <?php if ($selected_services): ?>
                                            <?php foreach ($selected_services as $service_id): ?>
                                                <?php
                                                $service = get_post($service_id);
                                                $service_category_id = get_field('usl_cat_field', $service_id);
                                                ?>
                                                <?php if ($service && $service_category_id == $category_id): ?>
                                                    <?php $short_name = get_field('service_short_name', $service_id) ?: $service->post_title; ?>
                                                    <div class="full-width-container-item text-16-300">
                                                        <a href="<?php echo esc_url(get_permalink($service->ID)); ?>" class="service-link">
                                                            <?php echo esc_html($short_name); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="full-width-container-image" style="background-image: url('<?php echo esc_url($background_image); ?>');"></div>
                    </div>
                </div>
            </div>



            <div class="nav__item text-17-400 colored-text">
              <a href="/prices/" class="label-nav__item row">Цены</a>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <a href="/portfolio/" class="label-nav__item row">Портфолио</a>
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
                <a href="/about/" class="service-header-wrapper-item row colored-text">
                  О нас
                </a>
                <a href="/master/" class="service-header-wrapper-item row colored-text">
                  Мастера
                </a>
                <a href="/promotions/" class="service-header-wrapper-item row colored-text">
                  Акции
                  <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/saleRedIcon.svg'); ?>"
                    alt="saleRed"
                    width="17"
                    height="16">
                </a>
                <a href="/reviews-page/" class="service-header-wrapper-item row colored-text">
                  Отзывы
                </a>
                <a href="/videos/" class="service-header-wrapper-item row colored-text">
                  Видео
                </a>
              </div>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <a href="/blog-page/" class="label-nav__item row">Статьи</a>
            </div>
            <div class="nav__item text-17-400 colored-text">
              <a href="/questions/"  class="label-nav__item row">Вопросы</a>
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
      </div> <!-- Конец .menu.row -->
    </div> <!-- Конец .header.row -->
  </header>
</div> <!-- Конец .header-position-wrapper.row -->
