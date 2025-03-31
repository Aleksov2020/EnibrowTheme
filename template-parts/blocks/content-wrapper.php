<?php
/**
 * Блок "Обертка с формой"
 */
?>

<div class="faq-page-text-wrapper main-text wrapper row">
    <div class="main-text-wrapper col">
        <InnerBlocks />
    </div>

    <div class="faq-page-form-wrapper sidebar-form">
        <div class="form-sidebar col">
            <div class="form-sidebar-header"></div>
            <div class="form-sidebar-body col">
                <div class="form-sidebar-title">
                    Консультация / Запись
                </div>
                <input class="input-default" type="text" placeholder="Ваше имя" id="user-name" >
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
                    <input class="input-default phone-input" id="phone-input" type="text" placeholder="(000) 000 00 00 00">
                </div>

                <div class="button button-primary" id="send">Отправить</div>
                <div class="checkbox-wrapper row">
                    <div class="checkbox checked"></div>
                    <div class="checkbox-label">
                        Нажимая кнопку, вы даете согласие на <br/> обработку персональных данных и<br/> соглашаетесь с <span> политикой <br/> конфиденциальности </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
document.querySelector('#send').addEventListener('click', async () => {
  const nameInput = document.querySelector('#user-name');
  const phoneInput = document.querySelector('#phone-input');
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

  // Отправка
  const formData = new FormData();
  formData.append('action', 'send_order');
  formData.append('user_name', name);
  formData.append('user_phone', phone);

  try {
    const response = await fetch('/enibrow/wp-admin/admin-post.php', {
      method: 'POST',
      body: formData,
    });

    if (!response.ok) throw new Error('Ошибка при отправке формы');

    const redirectUrl = new URL(window.location.href);
    window.location.href = redirectUrl.toString();
  } catch (error) {
    console.error(error);
  }
});
</script>
