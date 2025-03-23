document.addEventListener("DOMContentLoaded", function () {
    let selectedMaster = null;
    let selectedServices = [];
    const maxServices = 3;

    // Мастера и услуги из PHP
    const masters = mastersData;
    const services = servicesData;

    // Элементы DOM
    const masterSelect = document.querySelector(".custom-select.master .selected-option");
    const serviceSelects = document.querySelector(".custom-select.service .selected-option");
    const addServiceButton = document.querySelector(".button-add-service");
    const serviceContainer = document.querySelector(".custom-select-wrapper.service");
    const masterOptionsList = document.querySelector(".custom-select.master .options-list");
    const serviceOptionsList = document.querySelector(".custom-select.service .options-list");
    const submitButton = document.querySelector(".button-primary");
    const messageField = document.querySelector(".message-field");

    // Функция рендеринга списка мастеров
    function renderMasters() {
        masterOptionsList.innerHTML = "";
        masters.forEach((master) => {
            const option = document.createElement("li");
            option.classList.add("option");
            option.dataset.id = master.id;

            const wrapper = document.createElement("div");
            wrapper.classList.add("option-wrapper", "row");

            const avatar = document.createElement("div");
            avatar.classList.add("option-avatar");
            avatar.style.backgroundImage = `url(${master.photo})`;

            const nameWrapper = document.createElement("div");
            nameWrapper.classList.add("option-name-wrapper", "col");

            const label = document.createElement("div");
            label.classList.add("option-label");
            label.textContent = master.rank || "Мастер";

            const name = document.createElement("div");
            name.classList.add("option-name");
            name.textContent = master.name;

            nameWrapper.appendChild(label);
            nameWrapper.appendChild(name);
            wrapper.appendChild(avatar);
            wrapper.appendChild(nameWrapper);
            option.appendChild(wrapper);
            masterOptionsList.appendChild(option);

            option.addEventListener("click", function () {
                selectedMaster = master;
                masterSelect.querySelector(".option-text").textContent = master.name;
                masterSelect.querySelector(".avatar-placeholder").style.backgroundImage = `url(${master.photo})`;
                closeDropdown(masterSelect);
            });
        });
    }

    // Функция рендеринга списка услуг
    function renderServices() {
        serviceOptionsList.innerHTML = "";
        services.forEach((category) => {
            const categoryLabel = document.createElement("li");
            categoryLabel.classList.add("option-category");
            categoryLabel.textContent = category.name;
            serviceOptionsList.appendChild(categoryLabel);

            category.services.forEach((service) => {
                const option = document.createElement("li");
                option.classList.add("option");
                option.dataset.id = service.id;

                const wrapper = document.createElement("div");
                wrapper.classList.add("option-wrapper", "row");

                const avatar = document.createElement("div");
                avatar.classList.add("option-avatar");
                avatar.style.backgroundImage = `url(${service.image})`;

                const nameWrapper = document.createElement("div");
                nameWrapper.classList.add("option-name-wrapper", "col");

                const name = document.createElement("div");
                name.classList.add("option-name");
                name.textContent = service.name;

                nameWrapper.appendChild(name);
                wrapper.appendChild(avatar);
                wrapper.appendChild(nameWrapper);
                option.appendChild(wrapper);
                serviceOptionsList.appendChild(option);

                option.addEventListener("click", function () {
                    addService(service);
                    closeDropdown(serviceSelects);
                });
            });
        });
    }

    // Добавление услуги
    function addService(service) {
        if (selectedServices.length >= maxServices) return;

        selectedServices.push(service);

        const serviceElement = document.createElement("div");
        serviceElement.classList.add("service-item", "row");
        serviceElement.dataset.id = service.id;

        const name = document.createElement("div");
        name.classList.add("service-name");
        name.textContent = service.name;

        const removeButton = document.createElement("div");
        removeButton.classList.add("remove-service");
        removeButton.textContent = "Удалить";
        removeButton.addEventListener("click", function () {
            removeService(service.id, serviceElement);
        });

        serviceElement.appendChild(name);
        serviceElement.appendChild(removeButton);
        serviceContainer.appendChild(serviceElement);

        if (selectedServices.length > 0 && selectedServices.length < maxServices) {
            addServiceButton.style.display = "block";
        } else {
            addServiceButton.style.display = "none";
        }
    }

    // Удаление услуги
    function removeService(id, element) {
        selectedServices = selectedServices.filter((s) => s.id !== id);
        element.remove();
        addServiceButton.style.display = "block";
    }

    // Показать/скрыть дропдаун
    function toggleDropdown(select) {
        const optionsList = select.parentElement.querySelector(".options-list");
        optionsList.classList.toggle("visible");
    }

    // Закрыть дропдаун
    function closeDropdown(select) {
        const optionsList = select.parentElement.querySelector(".options-list");
        optionsList.classList.remove("visible");
    }

    // Отправка данных через AJAX
    function submitForm() {
        const formData = {
            master: selectedMaster ? selectedMaster.name : "Не выбран",
            services: selectedServices.map((s) => s.name),
            name: document.querySelector(".input-default[name='name']").value,
            phone: document.querySelector(".input-default[name='phone']").value,
        };

        fetch("/wp-admin/admin-ajax.php?action=send_booking", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(formData),
        })
            .then((response) => response.json())
            .then((data) => {
                messageField.textContent = data.message;
            })
            .catch((error) => {
                console.error("Ошибка отправки:", error);
                messageField.textContent = "Ошибка отправки данных";
            });
    }

    // Обработка клика по кнопке отправки
    submitButton.addEventListener("click", submitForm);

    // Обработка клика по мастеру
    masterSelect.addEventListener("click", function () {
        toggleDropdown(masterSelect);
    });

    // Обработка клика по услуге
    serviceSelects.addEventListener("click", function () {
        toggleDropdown(serviceSelects);
    });

    // Инициализация мастеров и услуг
    renderMasters();
    renderServices();
});
