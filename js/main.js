//=============================CHECKOX

document.querySelectorAll(".checkbox").forEach(checkbox => {
    checkbox.addEventListener("click", () => {
        checkbox.classList.toggle("checked");
    });
});

//============================= GALLERY CATEGORY

document.querySelectorAll(".gallery-category").forEach(checkbox => {
    checkbox.addEventListener("click", () => {
        document.querySelectorAll(".gallery-category").forEach((el) => {
            el.classList.remove("active");
        });

        checkbox.classList.toggle("active");
    });
});

document.querySelectorAll(".gallery-master-cards-likes-photo").forEach(checkbox => {
    checkbox.addEventListener("click", () => {
        checkbox.classList.toggle("active");
    });
});


// ===================== SLIDER SALES
document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".slider-track");
    const slides = document.querySelectorAll(".discont-slide-item");
    console.log(slides.length)

    const prevButton = document.querySelector(".discont-slider-button.prev-button");
    const nextButton = document.querySelector(".discont-slider-button.next-button");
    let currentIndex = 0;

    if (!prevButton || !nextButton) return;

    function updateSlidePosition() {
        track.style.transform = `translateX(-${currentIndex * 50}%)`;
    }

    nextButton.addEventListener("click", () => {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Циклический переход
        }
        updateSlidePosition();
    });

    prevButton.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = slides.length - 1; // Циклический переход
        }
        updateSlidePosition();
    });
});



// ===================== SLIDER REVIEWS

document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".slider-track-reviews");
    const slides = document.querySelectorAll(".review-card");
    const nextButton = document.querySelector(".reviews-button.prev-button");
    const prevButton = document.querySelector(".reviews-button.next-button");

    if (!track || slides.length === 0) return;

    let currentIndex = 0;
    let slideWidth, slidesPerView, maxIndex;

    function calculateSizes() {
        const gap = window.innerWidth < 700 ? 12 : 50;
        slideWidth = slides[0].offsetWidth + gap;
        const trackWidth = track.offsetWidth || track.parentElement.offsetWidth;
        slidesPerView = Math.max(1, Math.floor(trackWidth / slideWidth));
        maxIndex = Math.max(0, slides.length - slidesPerView);
    }

    function updateSlidePosition() {
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    function nextSlide() {
        currentIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
        updateSlidePosition();
    }

    function prevSlide() {
        currentIndex = currentIndex > 0 ? currentIndex - 1 : maxIndex;
        updateSlidePosition();
    }

    nextButton.addEventListener("click", nextSlide);
    prevButton.addEventListener("click", prevSlide);

    // Свайп
    let touchStartX = 0;
    let touchEndX = 0;

    track.addEventListener("touchstart", function (e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    track.addEventListener("touchend", function (e) {
        touchEndX = e.changedTouches[0].screenX;
        const deltaX = touchEndX - touchStartX;
        const threshold = 50;

        if (deltaX < -threshold) nextSlide();
        else if (deltaX > threshold) prevSlide();
    }, { passive: true });

    // Первичный расчёт и адаптация при изменении ширины экрана
    calculateSizes();
    updateSlidePosition();
    window.addEventListener("resize", () => {
        calculateSizes();
        updateSlidePosition(); // Пересчитываем позицию после ресайза
    });
});







//===========================ROLL BLOCK=======================================

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".roll-block").forEach((rollBlock, index) => {
        if (rollBlock.classList.contains("skip")) {
            return
        }
		
        // Ждём загрузки всех шрифтов
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(initRollBlocks);
        } else {
            // Если поддержка `document.fonts` отсутствует
            window.addEventListener("load", initRollBlocks);
        }
        


        function initRollBlocks() {
            const toggleButton = document.querySelectorAll(".button-roll-block")[index];

            const maxHeight = "194px"; // Высота в свернутом состоянии
            const fullHeight = rollBlock.scrollHeight + "px"; // Полная высота контента
    
            let isExpanded = true;
    
            if (isExpanded) {
                rollBlock.classList.add("expanded")
                rollBlock.style.height = maxHeight;
                toggleButton.textContent = "Развернуть текст";
            } else {
                rollBlock.style.height = fullHeight;
                toggleButton.textContent = "Свернуть текст";
            }
            isExpanded = !isExpanded;
    
            // Устанавливаем начальное состояние (свернуто)
            rollBlock.style.height = maxHeight;
            rollBlock.style.overflow = "hidden";
            rollBlock.style.transition = "height 0.3s ease-in-out";
    
            toggleButton.addEventListener("click", () => {
                if (isExpanded) {
                    rollBlock.classList.add("expanded")
                    rollBlock.style.height = maxHeight;
                    toggleButton.textContent = "Развернуть текст";
                } else {
                    rollBlock.classList.remove("expanded")
                    rollBlock.style.height = fullHeight;
                    toggleButton.textContent = "Свернуть текст";
                }
                isExpanded = !isExpanded;
            });
        }
    });
});



//===========================SLIDER SERVICE PAGE=======================================

document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".service-page-slider-track");
    const slides = document.querySelectorAll(".service-page-slide");
    const prevButton = document.querySelector(".prev-button");
    const nextButton = document.querySelector(".next-button");
    
    let currentIndex = 0;
    if (slides.length == 0) return;

    const slideWidth = slides[0].offsetWidth; // Ширина одного слайда
    const visibleSlides = 2; // Количество видимых слайдов

    function updateSlidePosition() {
        track.style.transform = `translateX(-${currentIndex * (slideWidth + 24)}px)`;
        console.log(slideWidth)
        console.log(currentIndex)
        updateVisibleClasses();
    }

    function updateVisibleClasses() {
        slides.forEach((slide, index) => {
            slide.classList.remove("slide-visible-one", "slide-visible-two", "slide-visible-three");

            if (index === currentIndex) {
                slide.classList.add("slide-visible-one");
            }
            if (index === currentIndex + 1) {
                slide.classList.add("slide-visible-two");
            }
            if (index === currentIndex + 2) {
                slide.classList.add("slide-visible-three");
            }
        });
    }

    nextButton.addEventListener("click", () => {
        if (currentIndex < slides.length - visibleSlides) {
            currentIndex++;
        } else {
            currentIndex = 0; // Зацикливание
        }
        updateSlidePosition();
    });

    prevButton.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = slides.length - visibleSlides; // Зацикливание в обратном направлении
        }
        updateSlidePosition();
    });

    // Устанавливаем классы для первых двух слайдов при загрузке
    updateVisibleClasses();
});




//====================== BLOG ARCHIVE CATEGORY

document.querySelectorAll(".blog-page-category-item").forEach(checkbox => {
    checkbox.addEventListener("click", () => {
        document.querySelectorAll(".blog-page-category-item").forEach((el) => {
            el.classList.remove("selected");
        });

        checkbox.classList.toggle("selected");
    });
});

//===================================== PAGE BLOG FORM

document.addEventListener("DOMContentLoaded", function () {
    const formWrapper = document.querySelector(".form-sidebar");
    const textWrapper = document.querySelector(".faq-page-text-wrapper.main-text");
    const authorWrapper = document.querySelector(".author-footer");

    const mainText = document.querySelector(".main-text");

    if (!formWrapper || !textWrapper) return; // Проверяем, есть ли элементы

    console.log(textWrapper.getBoundingClientRect())

    let isFixed = false; // Флаг, чтобы предотвратить "моргание"
    let isScrolledFull = false
    let isUnScrolledYet = true

    window.addEventListener("scroll", () => {

        const rectMain = mainText.getBoundingClientRect();
        const distanceTextToTop = rectMain.y;


        const rect = textWrapper.getBoundingClientRect(); // Получаем положение `.faq-page-text-wrapper`
        const distanceToBottom = authorWrapper.getBoundingClientRect().y;
        
        console.log(distanceToBottom)

        if (distanceTextToTop < 0) {
            isUnScrolledYet = false
        } else {
            isUnScrolledYet = true
        }

        if (distanceToBottom < 356) {
            isScrolledFull = true
        } else {
            isScrolledFull = false
        }

        if (!isUnScrolledYet && !isScrolledFull) {
            formWrapper.classList.add("fixed");
        } else {
            formWrapper.classList.remove("fixed")
        }
    });
});

//===================================== ABOUT SLIDER

document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".about-slider-track");
    const slides = document.querySelectorAll(".about-slide-right");
    if (slides.length == 0) return;
    const prevButton = document.querySelector(".about-slide-right-button.prev-button");
    const nextButton = document.querySelector(".about-slide-right-button.next-button");
    let currentIndex = 0;
    const slideWidth = slides[0].offsetWidth;  // Используем ширину слайда для корректного перемещения

    // Функция для обновления позиции слайдов
    function updateSlidePosition() {
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`; // Двигаем слайды на ширину одного слайда
    }

    // Переход к следующему слайду
    function nextSlide() {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Циклический переход
        }
        updateSlidePosition();
    }

    // Переход к предыдущему слайду
    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = slides.length - 1; // Циклический переход
        }
        updateSlidePosition();
    }

    // Обработчики кликов по кнопкам
    nextButton.addEventListener("click", () => {
        nextSlide();
        resetAutoSlide(); // Остановить автопрокрутку при клике
    });

    prevButton.addEventListener("click", () => {
        prevSlide();
        resetAutoSlide(); // Остановить автопрокрутку при клике
    });

    // Автопрокрутка слайдов
    let autoSlideInterval;

    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 3000);  // Каждые 3 секунды переходит к следующему слайду
    }

    // Остановить автопрокрутку
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);  // Останавливаем текущую автопрокрутку
        startAutoSlide();  // Запускаем новую автопрокрутку
    }

    // Запуск автопрокрутки при загрузке страницы
    startAutoSlide();
});


document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".masters-wrapper-track");
    const slides = document.querySelectorAll(".master-card");
    const prevButton = document.querySelector(".masters-button-slider.prev-button");
    const nextButton = document.querySelector(".masters-button-slider.next-button");

    if (!track || slides.length === 0) return;

    let currentIndex = 0;
    const slideWidth = slides[0].offsetWidth + 30;

    function updateSlidePosition() {
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlidePosition();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlidePosition();
    }

    nextButton.addEventListener("click", nextSlide);
    prevButton.addEventListener("click", prevSlide);

    // Swipe logic
    let startX = 0;
    let isSwiping = false;

    track.addEventListener("pointerdown", (e) => {
        startX = e.clientX;
        isSwiping = true;
        console.log(startX)
    });

    window.addEventListener("pointerup", (e) => {
        if (!isSwiping) return;

        const deltaX = e.clientX - startX;
        const threshold = 50;
        console.log(e.clientX)
        if (deltaX < -threshold) {
            nextSlide();
        } else if (deltaX > threshold) {
            prevSlide();
        }

        isSwiping = false;
    });

    window.addEventListener("pointercancel", () => {
        isSwiping = false;
        console.log("cancel")
    });
});





/* header open menu */
document.addEventListener('DOMContentLoaded', function () {
    const headerItems = document.querySelectorAll(".nav__item");

    headerItems.forEach((item) => {
        const dropdown = item.querySelector(".services-header-wrapper"); // Находим вложенное меню
        const arrow = item.querySelector("img"); // Находим стрелку

        if (dropdown && window.innerWidth > 760) { // Проверяем, есть ли вложенное меню
            let isOpen = false;
        
            item.addEventListener("mouseover", (event) => {
                // Закрываем все открытые меню
                document.querySelectorAll(".services-header-wrapper").forEach((el) => {
                    el.classList.remove("active");
                });

                // Открываем текущее меню
                dropdown.classList.add("active");

                // Переключаем поворот стрелки
                arrow.classList.toggle("rotate", true);

                // Ставим флаг, что меню открыто
                isOpen = true;

                // Добавляем обработчик для закрытия меню при уходе мыши
                dropdown.addEventListener("mouseleave", () => {
                    dropdown.classList.remove("active");
                    // Переключаем поворот стрелки
                    arrow.classList.toggle("rotate", false);
                    isOpen = false;
                }, { once: true });

            });
            
            // Обработчик для клика по всему документу, чтобы закрыть меню, если клик был не на открытом меню
            document.addEventListener('click', (event) => {
                // Если клик не был на открытом меню и его стрелке, закрываем меню
                if (isOpen && !dropdown.contains(event.target) && !arrow.contains(event.target)) {
                    dropdown.classList.remove("active");
                    arrow.classList.toggle("rotate", false);
                    isOpen = false;
                }
            });
            
        } else {
            item.addEventListener("click", (event) => {
                const isOpen = dropdown.classList.contains("active");

                // Переключаем класс "active" для текущего элемента
                if (!isOpen) {
                    dropdown.classList.add("active");
                } else {
                    if (event.target.classList.contains("label-nav__item")) {
                        dropdown.classList.remove("active");
                    }
                    
                }

                // Переключаем поворот стрелки
                arrow.classList.toggle("rotate", !isOpen);
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Находим все элементы с классом .full-width-container-title
    const titleElements = document.querySelectorAll('.full-width-container-title');

    titleElements.forEach(title => {
        

        // Добавляем обработчик клика на каждый элемент с классом .full-width-container-title
        title.addEventListener('click', function () {
            console.log("click")

            titleElements.forEach(title => {
                title.classList.remove("active");
            });
            document.querySelectorAll('.full-width-container-item').forEach(item => {
                item.classList.remove('active');
            });
            title.classList.add("active");
            // Находим все элементы с классом .full-width-container-item в пределах этого .full-width-container-col
            const itemElements = title.closest('.full-width-container-col').querySelectorAll('.full-width-container-item');
            
            // Добавляем класс active всем этим элементам
            itemElements.forEach(item => {
                item.classList.toggle('active');
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Находим все элементы с классом .full-width-container-title
    const button = document.querySelector('.button-show-mobile-menu');

    // Добавляем обработчик клика на каждый элемент с классом .full-width-container-title
    button.addEventListener('click', function () {
        document.querySelector('.header').classList.toggle("active");
        document.body.classList.toggle("overflow-hidden");
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const buttonOrder = document.querySelectorAll('.order-button');
    const modal = document.querySelector('.modal-order-background');
    const body = document.querySelector('body');

    // Открытие модального окна
    buttonOrder.forEach(button => {
        button.addEventListener('click', function () {
            modal.classList.add('show');
            body.style.overflow = 'hidden'; // Блокируем прокрутку
        });
    });

    // Закрытие модального окна по клику на фон
    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.remove('show');
            body.style.overflow = 'auto'; // Восстанавливаем прокрутку
        }
    });

    // Закрытие модального окна по кнопке закрытия
    const closeButton = document.querySelector('.modal-order-button-close');
    closeButton.addEventListener('click', function () {
        modal.classList.remove('show');
        body.style.overflow = 'auto'; // Восстанавливаем прокрутку
    });


    $(function(){
        $("#phone-input").mask("(999) 999-99-99");
    });

    $(function(){
        $("#phone_modal_order").mask("(999) 999-99-99");
    });
});