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
                <input class="input-default" type="text" name="client_name" placeholder="Ваше имя">
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
                    <input class="input-default phone-input" id="phone-input" type="text" name="client_phone" placeholder="(000) 000 00 00 00">
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
        <div class="modal-gallery-item">
            <div class="gallery-image" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/gallery-photo.png'; ?>);">
                <div class="modal-gallery-button modal-gallery-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M7 1L1 7L7 13" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="modal-gallery-button modal-gallery-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M1 13L7 7L1 0.999999" stroke="#825E69" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="modal-gallery-master row">
            <div class="modal-gallery-master-left row">
                <div class="modal-gallery-master-left-inner row">
                    <div class="modal-gallery-master-avatar" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/girl-service.png'; ?>);"></div>
                    <div class="modal-gallery-master-name-wrapper">
                        <div class="modal-gallery-master-name-rank">
                            ТОП Мастер
                        </div>
                        <div class="modal-gallery-master-name">
                            Ксения
                        </div>
                    </div>
                </div>
                <div class="modal-gallery-master-likes col">
                    <div class="modal-gallery-master-like"></div>
                    <div class="modal-gallery-master-like-counter">
                        3500
                    </div>
                </div>                        
            </div>
            <div class="modal-gallery-master-right row">
                <a class="modal-gallery-master-more" href="#">
                    Подробнее о мастере
                </a>
                <div class="modal-gallery-master-button button-order">
                    Записаться
                </div>
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
        'imageUrl' => esc_url($image['url']),
        'masterName' => esc_html($master_name),
        'masterRank' => esc_html($master_rank),
        'masterLikes' => esc_html($master_likes),
        'masterAvatar' => esc_url($master_photo['url']),
    ];
}

echo '<script>';
echo 'window.galleryData = ' . json_encode($gallery_data) . ';';
echo '</script>';
?>


<div class="modal-video-background">
    <div class="modal-video col">
        <div class="modal-video-close">&times;</div>
        <div class="modal-video-content">
            <iframe id="video-iframe" width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
function handleLike(element) {
    console.log(element)

    const likeIcon = element.querySelector('.like-icon');
    const likeCounter = element.querySelector('.gallery-master-cards-likes-counter');

    // Переключение класса на лайк
    if (likeIcon.classList.contains('active')) {
        likeIcon.classList.remove('active');
        likeCounter.textContent = Number(likeCounter.textContent) - 1;
    } else {
        likeIcon.classList.add('active');
        likeCounter.textContent = Number(likeCounter.textContent) + 1;
    }
}

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
            addServiceButton.style.display = 'block';
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
        addServiceButton.style.display = 'block';

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

    console.log('JS скрипт загружен');
});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.modal-gallery-background');
    const galleryImage = modal.querySelector('.gallery-image');
    const masterAvatar = modal.querySelector('.modal-gallery-master-avatar');
    const masterName = modal.querySelector('.modal-gallery-master-name');
    const masterRank = modal.querySelector('.modal-gallery-master-name-rank');
    const masterLikes = modal.querySelector('.modal-gallery-master-like-counter');
    const closeButton = modal.querySelector('.modal-gallery-master-more');
    const buttonOrder = modal.querySelector('.button-order');
    const leftButton = modal.querySelector('.modal-gallery-left');
    const rightButton = modal.querySelector('.modal-gallery-right');

    let currentIndex = 0;
    let galleryData = [];

    // Глобальная функция открытия галереи
    window.openGallery = function (index, data) {

        currentIndex = index;
        galleryData = data;
        openModal();
    };

    // Открытие модального окна
    function openModal() {
        const data = galleryData[currentIndex];


        galleryImage.style.backgroundImage = `url(${data.imageUrl})`;
        masterAvatar.style.backgroundImage = `url(${data.masterAvatar})`;
        masterName.textContent = data.masterName == "" ? "Мастер" : data.masterName;
        masterRank.textContent = data.masterRank == "" ? "Мастер" : data.masterRank;
        masterLikes.textContent = data.masterLikes;
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    // Закрытие модального окна
    function closeModal() {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }

    // Переключение влево
    function showPrev() {
        currentIndex = (currentIndex - 1 + galleryData.length) % galleryData.length;
        openModal();
    }

    // Переключение вправо
    function showNext() {
        currentIndex = (currentIndex + 1) % galleryData.length;
        openModal();
    }

    // События
    leftButton.addEventListener('click', showPrev);
    rightButton.addEventListener('click', showNext);
    closeButton.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    buttonOrder.addEventListener('click', function () {
        alert('Записаться на процедуру!');
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


</script>

<?php wp_footer(); ?>
</body>
</html>
