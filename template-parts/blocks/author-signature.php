<?php
$master_id = get_field('author_master');

if ($master_id) {
    $master_name  = get_field('master_name', $master_id);
    $master_surname = get_field('master_surname', $master_id);
    $master_rank  = get_field('master_rank', $master_id);
    $master_bio   = get_field('master_description_articles', $master_id);
    $master_photo = get_field('master_photo', $master_id);
    $photo_url    = $master_photo ? $master_photo['url'] : get_template_directory_uri() . '/assets/default-author.jpg'; // Фолбэк
?>

<div class="author-footer faq-page-author row">
    <div class="faq-page-author-wrapper row">
        <div class="faq-page-author-image">
            <img src="<?= esc_url($photo_url); ?>" alt="<?= esc_attr($master_name); ?>" width="90" height="90">
        </div>
        <div class="faq-page-author-text text-16-300">  
            <span class="faq-page-author-post text-16-500">Автор ответа:</span> 
            <?= esc_html($master_name . ' ' . $master_surname); ?> 
            <?= $master_rank ? ', ' . esc_html($master_rank) : ''; ?>. 
            <?= esc_html($master_bio); ?>
        </div>
    </div>
    <div class="button row button-primary button-animation-left-to-right">
        <img src="<?= get_template_directory_uri(); ?>/assets/whitePlus.svg" width="14" height="14"/>
        <div class="button-label">
            Консультация
        </div>
    </div>
</div>

<?php } ?>
