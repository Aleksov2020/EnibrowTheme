<?php
$title = get_field('title_text');
$description = get_field('description_text');
?>

<div class="title">
    <div class="title__page">
        <?php echo esc_html($title); ?>
    </div>
</div>

<?php if ($description): ?>
    <div class="blog-page-subtitle text-16-300">
        <?php echo esc_html($description); ?>
    </div>
<?php endif; ?>
