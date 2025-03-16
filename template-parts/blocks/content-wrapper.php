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
                <input class="input-default" type="text" placeholder="Ваше имя">
                <input class="input-default" type="text" placeholder="+7 000 000 00 00 00">
                <div class="button button-primary"> Отправить </div>
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
