<?php
// Получаем выбранные вопросы
$selected_faqs = get_field('selected_faqs');

if ($selected_faqs) :
?>
<div class="faq col wrapper">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Отвечаем на вопросы</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

    <div class="faq-wrapper col">
        <?php foreach ($selected_faqs as $index => $faq_id) :
            $title = get_the_title($faq_id);
            $link = get_permalink($faq_id);
            ?>
            <div class="faq-item row">
                <div class="faq-item-title-wrapper row">
                    <div class="faq-item-number colored-text">
                        <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                    </div>
                    <div class="faq-item-title colored-text">
                        <?php echo esc_html($title); ?>
                    </div>
                </div>
                <div class="faq-item-link-wrapper row">
                    <div class="faq-item-link-text colored-text">
                        Ответ мастера
                    </div>
                    <div class="faq-item-link-icon icon">
                        <a href="<?php echo esc_url($link); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/arrowRightColor.svg" alt="arrow" width="6" height="12">
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="button button-primary all-masters">
        Посмотреть все вопросы
    </div>
</div>
<?php endif; ?>
