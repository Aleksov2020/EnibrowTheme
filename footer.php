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
    $category_name = $category_id ? get_the_title($category_id) : 'Без категории';

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
                                                <?= esc_html(get_the_title($service->ID)); ?>
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
                        Удалить
                    </div>
                    <div class="selected-option">
                        <div class="avatar-placeholder" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/avatar-placeholder.png'?>);"></div>
                        <span class="option-text">Услуга не выбрана</span>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <ul class="options-list">
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
                                                <?= esc_html(get_the_title($service->ID)); ?>
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
                        Удалить
                    </div>
                    <div class="selected-option">
                        <div class="avatar-placeholder" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/avatar-placeholder.png'?>);"></div>
                        <span class="option-text">Услуга не выбрана</span>
                        <span class="arrow">&#9660;</span>
                    </div>
                    <ul class="options-list">
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
                                                <?= esc_html(get_the_title($service->ID)); ?>
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
                    <div class="row clickable modal-like-icon" id="like-button">
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
    const closeButton = modal.querySelector('.modal-gallery-master-more');
    const masterLink = modal.querySelector('#master-link');
    const buttonOrder = modal.querySelector('.button-order');

    let currentIndex = 0;
    let currentGalleryData = [];

    window.openGallery = function (index, galleryId) {
        currentGalleryData = window.galleryDataMap[galleryId] || [];
        currentIndex = index;
        updateModal();
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
        console.log(window.galleryDataMap);
    };

    function updateModal() {
        const data = currentGalleryData[currentIndex];
        if (!data) return;
        galleryImage.src = data.imageUrl;
        masterAvatar.style.backgroundImage = `url(${data.masterAvatar})`;
        masterName.textContent = data.masterName || 'Мастер';
        masterRank.textContent = data.masterRank || 'Мастер';
        masterLikes.textContent = data.masterLikes || '0';
        masterLink.href = data.masterLink;
        closeButton.href = data.masterLink;
    }

    leftButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + currentGalleryData.length) % currentGalleryData.length;
        document.getElementById("like-button").classList.remove("active");
        updateModal();
    });

    rightButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % currentGalleryData.length;
        document.getElementById("like-button").classList.remove("active");
        updateModal();
    });

    closeButton.addEventListener('click', () => {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    document.getElementById("close-gallery-modal").addEventListener("click", () => {
        modal.classList.remove('show');
        document.querySelector('body').style.overflow = 'auto';
        document.getElementById("like-button").classList.remove("active");
    })
});

document.addEventListener("DOMContentLoaded", function () {

    const likeButton = document.getElementById("like-button");
 
    if (!likeButton) return;
    const likeCounter = document.getElementById("like-counter");

    likeButton.addEventListener("click", function () {

        if (!likeCounter) return;

        if (likeButton.classList.contains("active")) {
            likeButton.classList.remove("active");
            likeCounter.textContent = Math.max(0, Number(likeCounter.textContent) - 1);
        } else {
            likeButton.classList.add("active");
            likeCounter.textContent = Number(likeCounter.textContent) + 1;
        }
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const addServiceButton = document.querySelector('.button-add-service');
    const serviceSelect1 = document.getElementById('service-1');
    const serviceSelect2 = document.getElementById('service-2');
    const serviceSelect3 = document.getElementById('service-3');
    const tattooButtons = document.querySelectorAll('.modal-order-btn');
    const masterSelect = document.querySelector('.master-select');
    let selectedServices = [];
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

    $('#close-order-modal').click(() => {
        $('.modal-order-background').removeClass('show');
        document.querySelector('body').style.overflow = 'auto';
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


function handleLike(element) {
    const likeIcon = element.querySelector('.like-icon');
    const likeCounter = element.querySelector('.gallery-master-cards-likes-counter');

    if (!likeIcon || !likeCounter) return;

    if (likeIcon.classList.contains('active')) {
        likeIcon.classList.remove('active');
        likeCounter.textContent = Math.max(0, Number(likeCounter.textContent) - 1);
    } else {
        likeIcon.classList.add('active');
        likeCounter.textContent = Number(likeCounter.textContent) + 1;
    }
}
</script>

<?php wp_footer(); ?>
</body>
</html>
