<?php
// Получаем настройки блока (если нужно)
$classes = 'colored-wrapper col ' . get_field('custom_class');
?>
<div class="<?php echo esc_attr($classes); ?>">
    <InnerBlocks />
</div>