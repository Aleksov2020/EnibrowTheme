<?php
// Получаем всех мастеров
$masters = get_posts([
    'post_type' => 'master',
    'posts_per_page' => -1,
]);

// Получаем все услуги и группируем их по категориям
$services = get_posts([
    'post_type' => 'uslyga',
    'posts_per_page' => -1,
]);

$services_by_category = [];
foreach ($services as $service) {
    // Получаем категорию услуги
    $category_id = get_field('usl_cat_field', $service->ID); // Правильное поле для категории
    $category_name = $category_id ? get_field('cat_short_name', $category_id) : 'Без категории';

    // Получаем последние фото из работ портфолио, связанных с услугой
    $portfolio_works = get_field('service_portfolio_works', $service->ID);
    $latest_image_url = get_template_directory_uri() . '/assets/avatar-placeholder.png'; // Фото по умолчанию

    if (!empty($portfolio_works)) {
        // Получаем ID последнего добавленного портфолио
        $latest_portfolio_id = end($portfolio_works);
        $portfolio_image = get_field('portfolio_image', $latest_portfolio_id);

        if ($portfolio_image && !empty($portfolio_image['url'])) {
            $latest_image_url = esc_url($portfolio_image['url']);
        }
    }

    // Группируем услуги по категориям
    $services_by_category[$category_name][] = [
        'service' => $service,
        'image' => $latest_image_url,
    ];
}
?>
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



<div class="modal-order-background row">
    <div class="modal-order col">
        <div class="close-order-modal-icon" id="close-order-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                <path d="M2.16943 27.2583L27.0083 2.41943M2.16943 2.41943L27.0083 27.2583" stroke="#825E69" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="modal-order-title-wrapper row">
            <div class="modal-order-title">
                Быстрая запись
            </div>
            <div class="modal-order-button-close">

            </div>
        </div>
        <div class="modal-order-body col">
            <div class="custom-select-wrapper col">
                <label for="master-select" class="select-label">Выберите мастера (не обязательно)</label>
                <div class="custom-select master-select">
                    <div class="selected-option">
                        <div class="avatar-placeholder" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/avatar-placeholder.png'?>);"></div>
                        <span class="option-text">Мастер не выбран</span>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <ul class="options-list">
                        <?php foreach ($masters as $master): ?>
                            <?php
                                $master_photo = get_field('master_photo', $master->ID);
                                $photo_url = !empty($master_photo) ? esc_url($master_photo['url']) : get_template_directory_uri() . '/assets/avatar-placeholder.png';
                            ?>
                            <li class="option" data-id="<?= esc_attr($master->ID); ?>">
                                <div class="option-wrapper row">
                                    <div class="option-avatar" style="background-image: url(<?= esc_url($photo_url); ?>);"></div>
                                    <div class="option-name-wrapper col">
                                        <?php if (get_field('master_rank', $master->ID) == 'ТОП-мастер'): ?>
                                            <div class="option-label">ТОП-мастер</div>
                                        <?php endif; ?>
                                        <div class="option-name">
                                            <?= esc_html(get_field('master_name', $master->ID) . ' ' . get_field('master_surname', $master->ID)); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div id="services-container" class="custom-select-wrapper col">
                <label for="service-select" class="select-label">Выберите услугу</label>
                <div class="custom-select service-select" id="service-1">
                    <div class="selected-option">
                        <div class="avatar-placeholder" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/avatar-placeholder.png'?>);"></div>
                        <span class="option-text">Услуга не выбрана</span>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <ul class="options-list">
                        <li class="option" data-id="consultation">
                            <div class="option-wrapper row">
                                <div class="option-avatar" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/avatar-placeholder.png);"></div>
                                <div class="option-name-wrapper col">
                                    <div class="option-name">Консультация</div>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($services_by_category as $category_name => $services): ?>
                            <li class="option-category"><?= esc_html($category_name); ?></li>
                            <?php foreach ($services as $service_data): ?>
                                <?php $service = $service_data['service']; ?>
                                <?php $image_url = $service_data['image']; ?>
                                <li class="option" data-id="<?= esc_attr($service->ID); ?>">
                                    <div class="option-wrapper row">
                                        <div class="option-avatar" style="background-image: url(<?= esc_url($image_url); ?>);"></div>
                                        <div class="option-name-wrapper col">
                                            <div class="option-name">
                                                <?= esc_html(get_field('service_short_name', $service->ID)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="custom-select service-select hidden" id="service-2">
                    <div class="delete-option-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                            <path d="M7.93688 8.19932L4.57812 4.84056M4.57812 4.84056L1.21937 1.4818M4.57812 4.84056L7.93688 1.4818M4.57812 4.84056L1.21937 8.19932" stroke="#825E69" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="selected-option">
                        <div class="avatar-placeholder" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/avatar-placeholder.png'?>);"></div>
                        <span class="option-text">Услуга не выбрана</span>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <ul class="options-list">
                        <li class="option" data-id="consultation">
                            <div class="option-wrapper row">
                                <div class="option-avatar" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/avatar-placeholder.png);"></div>
                                <div class="option-name-wrapper col">
                                    <div class="option-name">Консультация</div>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($services_by_category as $category_name => $services): ?>
                            <li class="option-category"><?= esc_html($category_name); ?></li>
                            <?php foreach ($services as $service_data): ?>
                                <?php $service = $service_data['service']; ?>
                                <?php $image_url = $service_data['image']; ?>
                                <li class="option" data-id="<?= esc_attr($service->ID); ?>">
                                    <div class="option-wrapper row">
                                        <div class="option-avatar" style="background-image: url(<?= esc_url($image_url); ?>);"></div>
                                        <div class="option-name-wrapper col">
                                            <div class="option-name">
                                                <?= esc_html(get_field('service_short_name', $service->ID)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="custom-select service-select hidden" id="service-3">
                    <div class="delete-option-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                            <path d="M7.93688 8.19932L4.57812 4.84056M4.57812 4.84056L1.21937 1.4818M4.57812 4.84056L7.93688 1.4818M4.57812 4.84056L1.21937 8.19932" stroke="#825E69" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="selected-option">
                        <div class="avatar-placeholder" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/avatar-placeholder.png'?>);"></div>
                        <span class="option-text">Услуга не выбрана</span>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <ul class="options-list">
                        <li class="option" data-id="consultation">
                            <div class="option-wrapper row">
                                <div class="option-avatar" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/avatar-placeholder.png);"></div>
                                <div class="option-name-wrapper col">
                                    <div class="option-name">Консультация</div>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($services_by_category as $category_name => $services): ?>
                            <li class="option-category"><?= esc_html($category_name); ?></li>
                            <?php foreach ($services as $service_data): ?>
                                <?php $service = $service_data['service']; ?>
                                <?php $image_url = $service_data['image']; ?>
                                <li class="option" data-id="<?= esc_attr($service->ID); ?>">
                                    <div class="option-wrapper row">
                                        <div class="option-avatar" style="background-image: url(<?= esc_url($image_url); ?>);"></div>
                                        <div class="option-name-wrapper col">
                                            <div class="option-name">
                                                <?= esc_html(get_field('service_short_name', $service->ID)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="button-add-service row">
                    Добавить услугу
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M9 17.1777C13.4183 17.1777 17 13.596 17 9.17773C17 4.75946 13.4183 1.17773 9 1.17773C4.58172 1.17773 1 4.75946 1 9.17773C1 13.596 4.58172 17.1777 9 17.1777Z" stroke="white"/>
                    <path d="M11.4016 9.17734H9.00156M9.00156 9.17734H6.60156M9.00156 9.17734V6.77734M9.00156 9.17734V11.5773" stroke="white" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
            <div class="custom-select-wrapper col">
                <label for="modal-order-group" class="select-label">Есть ли у вас старый татуаж ?</label>
                <div class="modal-order-group row">
                    <div class="modal-order-btn active">
                        Нет
                    </div>
                    <div class="modal-order-btn">
                        Есть
                    </div>
                </div> 
            </div>
            <div class="custom-select-wrapper col">
                <label for="input-default" class="select-label">Укажите ваше имя</label>
                <input class="input-default" type="text" name="client_name" id="name_modal_order" placeholder="Ваше имя">
            </div>
            <div class="custom-select-wrapper col">
                <label for="input-default" class="select-label">Укажите ваш телефон</label>
                <div class="input-default-wrapper">
                    <label class="label-phone row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                            <g clip-path="url(#clip0_3035_13027)">
                            <rect width="60" height="20" fill="#F9F9F9"/>
                            <rect y="20" width="60" height="20" fill="#428BC1"/>
                            <rect y="40" width="60" height="20" fill="#ED4C5C"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_3035_13027">
                            <rect width="60" height="60" rx="30" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        +7
                    </label>
                    <input class="input-default phone-input" id="phone_modal_order" type="text" name="client_phone" placeholder="(000) 000 00 00 00">
                </div>
            </div>
            <div class="custom-select-wrapper col">
                <div class="button row button-primary">
                    <div class="button-label"  id="submit-order">Запись онлайн</div>
                </div>
            </div>
            <div class="checkbox-wrapper row">
                <div class="checkbox checked"></div>
                <div class="checkbox-label" style="color: #00000080;">
                    Нажимая кнопку, вы даёте согласие на обработку персональных данных и соглашаетесь с <span>политикой конфиденциальности</span>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal-gallery-background">
    <div class="modal-gallery col">
        <div class="close-gallery-modal-icon" id="close-gallery-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                <path d="M2.16943 27.2583L27.0083 2.41943M2.16943 2.41943L27.0083 27.2583" stroke="#825E69" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="modal-gallery-item">
            <div class="gallery-image">
                <img class="modal-gallery-image-data" src="<?php echo get_template_directory_uri(); ?>/assets/gallery-photo.png" alt="">
                <div class="modal-gallery-button modal-gallery-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="modal-gallery-button modal-gallery-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M1 13L7 7L1 1" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="modal-gallery-master row">
            <div class="modal-gallery-master-left row">
                <a href="#" class="modal-gallery-master-left-inner row" id="master-link">
                    <div class="modal-gallery-master-avatar"></div>
                    <div class="modal-gallery-master-name-wrapper">
                        <div class="modal-gallery-master-name-rank">ТОП Мастер</div>
                        <div class="modal-gallery-master-name">Имя</div>
                    </div>
                </a>
                <div class="modal-gallery-master-likes col">
                    <div class="row clickable modal-like-icon" id="like-button" data-id="<?= esc_attr($work_id); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17" fill="none">
                            <path d="M9.14945 3.42589L10 4.80155L10.8506 3.42589C11.5789 2.24796 12.858 1.5 14.3182 1.5C16.5889 1.5 18.5 3.42492 18.5 5.83333C18.5 6.87433 18.0316 8.0043 17.2012 9.16973C16.3776 10.3257 15.2585 11.4311 14.1059 12.4018C12.9578 13.3685 11.805 14.178 10.9365 14.7468C10.5626 14.9916 10.2432 15.1908 10.0019 15.3375C9.76029 15.1896 9.44036 14.9888 9.06581 14.742C8.19701 14.1696 7.04368 13.3558 5.89518 12.386C4.742 11.4122 3.62241 10.305 2.79834 9.15033C1.96702 7.98551 1.5 6.86161 1.5 5.83333C1.5 3.42492 3.41107 1.5 5.68182 1.5C7.14196 1.5 8.42115 2.24796 9.14945 3.42589Z" stroke="#C0C0C0" stroke-width="2"/>
                        </svg>
                    </div>
                    <div class="modal-master-cards-likes-counter" id="like-counter">0</div>
                </div>
            </div>
            <div class="modal-gallery-master-right row">
                <a class="modal-gallery-master-more" href="#" id="master-more">Подробнее о мастере</a>
                <div class="modal-gallery-master-button button-order">Записаться</div>
            </div>
        </div>
    </div>
</div>




<?php
// Получаем все работы для галереи
$portfolio_works = get_posts(array(
    'post_type'      => 'portfolio_work',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'portfolio_slider',
            'value'   => '1',
            'compare' => '='
        )
    )
));

$gallery_data = [];
foreach ($portfolio_works as $index => $work) {
    $image = get_field('portfolio_image', $work->ID);
    $master_id = get_field('portfolio_master', $work->ID);
    $master_name = get_field('master_name', $master_id);
    $master_photo = get_field('master_photo', $master_id);
    $master_likes = get_field('master_likes', $master_id);
    $master_rank = get_field('master_rank', $master_id);

    $gallery_data[] = [
        'id'           => $work->ID,
        'imageUrl'     => esc_url($image['url']),
        'masterName'   => esc_html($master_name),
        'masterRank'   => esc_html($master_rank),
        'masterLikes'  => esc_html($master_likes),
        'masterAvatar' => esc_url($master_photo['url']),
        'masterLink'   => esc_url(get_permalink($master_id)),
    ];
}

// Выводим JS с уникальным ID галереи (например, "sliderGallery")
echo '<script>';
echo 'window.galleryDataMap = window.galleryDataMap || {};';
echo 'window.galleryDataMap["sliderGallery"] = ' . json_encode($gallery_data) . ';';
echo '</script>';
?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.modal-gallery-background');
    const galleryImage = modal.querySelector('.modal-gallery-image-data');
    const masterAvatar = modal.querySelector('.modal-gallery-master-avatar');
    const masterName = modal.querySelector('.modal-gallery-master-name');
    const masterRank = modal.querySelector('.modal-gallery-master-name-rank');
    const masterLikes = modal.querySelector('.modal-master-cards-likes-counter');
    const leftButton = modal.querySelector('.modal-gallery-left');
    const rightButton = modal.querySelector('.modal-gallery-right');
    const closeButton = modal.querySelector('#close-gallery-modal');
    const masterLink = modal.querySelector('#master-link');
    const moreLink = modal.querySelector('#master-more');

    let currentIndex = 0;
    let currentGallery = [];

    window.openGallery = function (index, galleryId) {
        currentGallery = window.galleryDataMap[galleryId] || [];
        currentIndex = index;
        updateModal('right');
        console.log('Открываем галерею:', currentGallery);
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    };

    function hasLiked(postId) {
        const liked = localStorage.getItem('likedGalleryItems');
        if (!liked) return false;
        if (!postId) return false;
        postId = postId.toString(); // Приводим к строке
        return JSON.parse(liked).includes(postId);
    }

    function setLiked(postId, liked = true) {
        let likedList = localStorage.getItem('likedGalleryItems');
        likedList = likedList ? JSON.parse(likedList) : [];

        if (liked && !likedList.includes(postId)) {
            likedList.push(postId);
        } else if (!liked) {
            likedList = likedList.filter(id => id !== postId);
        }

        localStorage.setItem('likedGalleryItems', JSON.stringify(likedList));
    }

    function updateModal(orientation) {
        const data = currentGallery[currentIndex];
        if (!data) return;

        const likeButton = document.getElementById("like-button");
        const likeCounter = document.getElementById("like-counter");
        const isLiked = hasLiked(data.id);

        likeButton.classList.toggle("active", isLiked);
        likeButton.dataset.id = data.id;

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'get_portfolio_likes',
                post_id: data.id
            })
        })
        .then(res => res.json())
        .then(response => {
            if (response.success) {
                likeCounter.textContent = response.data.likes;
            }
        });

        animateImageChange(data.imageUrl, orientation);
        masterAvatar.style.backgroundImage = `url(${data.masterAvatar})`;
        masterName.textContent = data.masterName || 'Мастер';
        masterRank.textContent = data.masterRank || '';
        masterLink.href = data.masterLink;
        moreLink.href = data.masterLink;
    }

    function handleLike(element) {
        const likeIcon = element.querySelector('.like-icon');
        const likeCounter = element.querySelector('.gallery-master-cards-likes-counter');
        const postId = element.dataset.id;

        if (!likeIcon || !likeCounter || !postId) return;

        const isLiked = hasLiked(postId);
        const newLikes = isLiked
            ? Math.max(0, Number(likeCounter.textContent) - 1)
            : Number(likeCounter.textContent) + 1;

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'toggle_portfolio_like',
                post_id: postId,
                increment: isLiked ? '0' : '1'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                likeCounter.textContent = data.data.likes;
                likeIcon.classList.toggle('active');
                setLiked(postId, !isLiked);
            } else {
                alert("Ошибка при сохранении лайка");
            }
        });
    }

    document.querySelectorAll('.gallery-master-cards-likes-wrapper').forEach(el => {
        const postId = el.dataset.id;
        if (hasLiked(postId)) {
            el.querySelector('.like-icon')?.classList.add('active');
        }
    });

    document.getElementById('like-button').addEventListener('click', function () {
        const postId = currentGallery[currentIndex].id;
        console.log(currentGallery[currentIndex]);

        console.log('Клик по лайку в модалке', postId);
        if (!postId) return;

        const isLiked = this.classList.contains('active');
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'toggle_portfolio_like',
                post_id: postId,
                increment: isLiked ? '0' : '1'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                this.classList.toggle('active');
                document.getElementById('like-counter').textContent = data.data.likes;
                setLiked(postId.toString(), !isLiked);
            }
        });
    });

    leftButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + currentGallery.length) % currentGallery.length;
        updateModal('left');
    });

    rightButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % currentGallery.length;
        updateModal('right');
    });

    closeButton.addEventListener('click', () => {
        modal.classList.remove('show');
        document.body.style.overflow = '';

        // Обновим лайки после выхода
        const likedItems = JSON.parse(localStorage.getItem('likedGalleryItems') || '[]');

        likedItems.forEach(postId => {
            // Запрашиваем текущее количество лайков
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'get_portfolio_likes',
                    post_id: postId
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.syncLikeAcrossGalleries(postId, data.data.likes, true);
                }
            });
        });
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
            // Обновим лайки после выхода
            const likedItems = JSON.parse(localStorage.getItem('likedGalleryItems') || '[]');

            likedItems.forEach(postId => {
                // Запрашиваем текущее количество лайков
                fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'get_portfolio_likes',
                        post_id: postId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.syncLikeAcrossGalleries(postId, data.data.likes, true);
                    }
                });
            });
        }
    });

    function animateImageChange(newSrc, direction = 'right') {
        const oldImg = galleryImage;
        const newImg = document.createElement('img');
        newImg.className = 'modal-gallery-image-data';
        newImg.src = newSrc;

        // Стили начальной позиции для нового изображения
        newImg.classList.add(`fade-in-${direction}`);
        modal.querySelector('.gallery-image').appendChild(newImg);

        // Запуск анимации
        requestAnimationFrame(() => {
            // Старое изображение уходит
            oldImg.classList.add(`fade-out-${direction}`);

            // Новое приходит
            newImg.classList.remove(`fade-in-${direction}`);
        });

        // После окончания анимации — удаляем старое изображение
        setTimeout(() => {
            oldImg.remove();
            newImg.classList.remove(`fade-out-${direction}`, `fade-in-${direction}`);
        }, 400);
    }
});

function updateGalleryLikeUI(postId, newCount, isLiked) {
    document.querySelectorAll(`[data-id='${postId}']`).forEach(el => {
        const icon = el.querySelector('.like-icon');
        const counter = el.querySelector('.gallery-master-cards-likes-counter');
        if (icon) icon.classList.toggle('active', isLiked);
        if (counter) counter.textContent = newCount;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const addServiceButton = document.querySelector('.button-add-service');
    const serviceSelect1 = document.getElementById('service-1');
    const serviceSelect2 = document.getElementById('service-2');
    const serviceSelect3 = document.getElementById('service-3');
    const tattooButtons = document.querySelectorAll('.modal-order-btn');
    const masterSelect = document.querySelector('.master-select');
    var selectedServices = [];
    let selectedMaster = null;
    let selectedTattoo = 'Нет';
    
    // Функция для открытия/закрытия селекта
    function toggleSelect(select) {
        const isOpen = select.classList.contains('open');
        closeAllSelects();
        if (!isOpen) {
            select.classList.add('open');
        }
    }

    // Функция закрытия всех селектов
    function closeAllSelects() {
        document.querySelectorAll('.custom-select').forEach(select => {
            select.classList.remove('open');
        });
    }

    // Функция выбора мастера
    function selectMaster(masterId, masterName, masterImage) {
        selectedMaster = { id: masterId, name: masterName };
        const selectedOption = masterSelect.querySelector('.selected-option .option-text');
        const avatarPlaceholder = masterSelect.querySelector('.avatar-placeholder');

        // Обновляем текст и картинку выбранного мастера
        selectedOption.innerText = masterName;
        avatarPlaceholder.style.backgroundImage = `url(${masterImage})`;

        console.log('Выбранный мастер:', selectedMaster);
    }

    // Функция выбора услуги
    function selectService(serviceSelect, serviceId, serviceName, serviceImage) {
        const selectedOption = serviceSelect.querySelector('.selected-option .option-text');
        const avatarPlaceholder = serviceSelect.querySelector('.avatar-placeholder');

        // Обновляем текст и картинку выбранной услуги
        selectedOption.innerText = serviceName;
        avatarPlaceholder.style.backgroundImage = `url(${serviceImage})`;

        // Проверяем, не была ли услуга уже выбрана
        const serviceExists = selectedServices.some(service => service.id === serviceId);
        if (!serviceExists) {
            selectedServices.push({ id: serviceId, name: serviceName, image: serviceImage });
        }

        // Логика отображения кнопки "Добавить услугу"
        if (selectedServices.length < 3) {
            addServiceButton.style.display = 'flex';
        } else {
            addServiceButton.style.display = 'none';
        }

        console.log('Выбранные услуги:', selectedServices);
    }

    // Обработка клика на кнопку "Добавить услугу"
    function handleAddServiceClick() {
        if (serviceSelect2.classList.contains('hidden')) {
            serviceSelect2.classList.remove('hidden');
        } else if (serviceSelect3.classList.contains('hidden')) {
            serviceSelect3.classList.remove('hidden');
        }

        // Скрываем кнопку после добавления третьего селекта
        if (selectedServices.length >= 2) {
            addServiceButton.style.display = 'none';
        }
    }

    // Обработка клика на кнопку "Удалить" селекта
    function handleDeleteServiceClick(deleteButton) {
        const serviceSelect = deleteButton.closest('.service-select');
        const avatarPlaceholder = serviceSelect.querySelector('.avatar-placeholder');
        const selectedOption = serviceSelect.querySelector('.selected-option .option-text');

        // Возвращаем плейсхолдер
        avatarPlaceholder.removeAttribute('style');
        selectedOption.innerText = 'Услуга не выбрана';

        // Скрываем селект
        serviceSelect.classList.add('hidden');
        addServiceButton.style.display = 'flex';

        console.log('Удалена услуга');
    }

    // Добавляем обработчики кликов на все селекты
    document.querySelectorAll('.custom-select').forEach(select => {
        const selectedOption = select.querySelector('.selected-option');
        const options = select.querySelectorAll('.option');

        // Открытие/закрытие селекта
        selectedOption.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleSelect(select);
        });

        // Обработка выбора услуги или мастера
        options.forEach(option => {
            option.addEventListener('click', function () {
                const itemId = option.dataset.id;
                const itemName = option.querySelector('.option-name').innerText;
                const itemImage = option.querySelector('.option-avatar').style.backgroundImage.replace('url(', '').replace(')', '').replace(/\"/gi, "");

                if (select.classList.contains('master-select')) {
                    selectMaster(itemId, itemName, itemImage);
                } else {
                    selectService(select, itemId, itemName, itemImage);
                }

                closeAllSelects();
            });
        });

        // Обработка клика на кнопку "Удалить"
        const deleteButton = select.querySelector('.delete-option-button');
        if (deleteButton) {
            deleteButton.addEventListener('click', function () {
                handleDeleteServiceClick(deleteButton);
            });
        }
    });

    // Обработка клика на кнопку "Добавить услугу"
    addServiceButton.addEventListener('click', handleAddServiceClick);

    // Обработка клика на кнопку "Есть/Нет"
    tattooButtons.forEach(button => {
        button.addEventListener('click', function () {
            tattooButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            selectedTattoo = button.innerText;
            console.log('Старый татуаж:', selectedTattoo);
        });
    });

    // Закрытие селектов при клике вне области
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.custom-select')) {
            closeAllSelects();
        }
    });

    $('#close-order-modal').click((e) => {
        if (!e.target.closest('.modal-order')) {
            document.getElementById('close-order-modal').click();
        }
    })

    document.getElementById('submit-order').addEventListener('click', function () {
        const nameInput = document.querySelector('#name_modal_order');
        const phoneInput = document.querySelector('#phone_modal_order');
        const name = nameInput.value.trim();
        const phone = phoneInput.value.trim();

        nameInput.classList.remove('error');
        phoneInput.classList.remove('error');

        // Проверка имени
        const nameValid = /^[А-Яа-яA-Za-z\s-]{2,}$/.test(name);
        if (!nameValid) {
            nameInput.classList.add('error');
        }

        // Проверка телефона
        const digitsOnly = phone.replace(/\D/g, '');
        if (digitsOnly.length < 7) {
            phoneInput.classList.add('error');
        }

        if (!nameValid || digitsOnly.length < 7) return;

        const masterId = selectedMaster ? selectedMaster.id : null;
        const serviceIds = selectedServices.map(s => s.id);
        const tattooStatus = selectedTattoo;

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'send_modal_order',
                name: name,
                phone: phone,
                master_id: masterId,
                tattoo: tattooStatus,
                services: JSON.stringify(serviceIds)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Заявка успешно отправлена');
            } else {
                alert('Ошибка: ' + data.data);
            }
        })
        .catch(() => {
            alert('Ошибка при отправке формы');
        });
    });

    // Обработка клика по кнопке цены в таблице
    document.querySelectorAll('.price-button-service.price-active').forEach(button => {
        button.addEventListener('click', () => {
            const masterId = button.dataset.masterId;
            const serviceId = button.dataset.serviceId;

            // Открываем модалку
            document.querySelector('.modal-order-background').classList.add('show');
            document.querySelector('body').style.overflow = 'hidden';

            // Находим мастера по ID
            const option = document.querySelector(`.master-select .option[data-id="${masterId}"]`);
            if (option) {
                const name = option.querySelector('.option-name').innerText.replace(/\n/g, '').trim();
                const image = option.querySelector('.option-avatar').style.backgroundImage
                    .replace('url(', '')
                    .replace(')', '')
                    .replace(/"/g, '');
                
                // Используем функцию напрямую
                selectMaster(masterId, name, image);
            }

            // Имитация клика по нужной услуге (в первый селект)
            const serviceOption = document.querySelector(`#service-1 .option[data-id="${serviceId}"]`);
            if (serviceOption) {
                const name = serviceOption.querySelector('.option-name').innerText.replace(/\n/g, '').trim();
                const image = serviceOption.querySelector('.option-avatar').style.backgroundImage
                    .replace('url(', '')
                    .replace(')', '')
                    .replace(/"/g, '');

                selectService(serviceSelect1, serviceId, name, image);
            }
        });
    });


    $('#close-order-modal').click(() => {
        $('.modal-order-background').removeClass('show');
        document.querySelector('body').style.overflow = 'auto';

        // Очищаем выбранного мастера
        selectedMaster = null;
        const masterText = masterSelect.querySelector('.option-text');
        const masterAvatar = masterSelect.querySelector('.avatar-placeholder');
        masterText.textContent = 'Мастер не выбран';
        masterAvatar.style.backgroundImage = `url(${masterAvatar.dataset.default})`; // или placeholder

        // Очищаем выбранные услуги
        selectedServices.length = 0; 

        // Первый селект услуги сбрасываем
        const resetServiceSelect = (selectEl) => {
            selectEl.classList.remove('hidden');
            selectEl.querySelector('.option-text').textContent = 'Услуга не выбрана';
            selectEl.querySelector('.avatar-placeholder').removeAttribute('style');
        };

        resetServiceSelect(serviceSelect1);
        resetServiceSelect(serviceSelect2);
        resetServiceSelect(serviceSelect3);

        serviceSelect2.classList.add('hidden');
        serviceSelect3.classList.add('hidden');

        // Показываем кнопку "Добавить услугу"
        addServiceButton.style.display = 'flex';

        // Сброс старого татуажа
        tattooButtons.forEach(btn => btn.classList.remove('active'));
        tattooButtons[0].classList.add('active');
        selectedTattoo = 'Нет';

        // Очистка полей формы
        document.querySelector('#name_modal_order').value = '';
        document.querySelector('#phone_modal_order').value = '';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const modalVideo = document.querySelector('.modal-video-background');
    const closeBtn = document.querySelector('.modal-video-close');
    const iframe = document.getElementById('video-iframe');
    const videoItems = document.querySelectorAll('.video-item');

    videoItems.forEach(item => {
        item.addEventListener('click', function () {
            const videoUrl = this.querySelector('.video-button').getAttribute('href');
            iframe.src = videoUrl + '?autoplay=1';
            modalVideo.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });

    if (!closeBtn) return;

    closeBtn.addEventListener('click', function () {
        modalVideo.style.display = 'none';
        iframe.src = '';
        document.body.style.overflow = '';
    });

    modalVideo.addEventListener('click', function (e) {
        if (e.target === modalVideo) {
            modalVideo.style.display = 'none';
            iframe.src = '';
            document.body.style.overflow = '';
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    function hasLiked(postId) {
        const liked = localStorage.getItem('likedGalleryItems');
        if (!liked) return false;
        return JSON.parse(liked).includes(postId.toString());
    }

    function setLiked(postId, liked = true) {
        let likedList = localStorage.getItem('likedGalleryItems');
        likedList = likedList ? JSON.parse(likedList) : [];

        if (liked && !likedList.includes(postId)) {
            likedList.push(postId);
        } else if (!liked) {
            likedList = likedList.filter(id => id !== postId);
        }

        localStorage.setItem('likedGalleryItems', JSON.stringify(likedList));
    }

    // 1. При загрузке отметить лайки
    document.querySelectorAll('.gallery-master-cards-likes-wrapper').forEach(el => {
        const postId = el.dataset.id;
        const icon = el.querySelector('.like-icon');
        if (hasLiked(postId)) icon.classList.add('active');
    });

    // 2. Обработка кликов на лайк
    document.querySelectorAll('.gallery-master-cards-likes-wrapper').forEach(el => {
        el.addEventListener('click', function () {
            const postId = this.dataset.id;
            const icon = this.querySelector('.like-icon');
            const counter = this.querySelector('.gallery-master-cards-likes-counter');
            const isLiked = hasLiked(postId);

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'toggle_portfolio_like',
                    post_id: postId,
                    increment: isLiked ? '0' : '1'
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    setLiked(postId, !isLiked);
                    updateGalleryLikeUI(postId, data.data.likes, !isLiked);
                }
            });
        });
    });

    // 3. Функция доступна из модалки
    window.syncLikeAcrossGalleries = updateGalleryLikeUI;
});

</script>

<?php wp_footer(); ?>
</body>
</html>
