<?php
$title = get_field('title_text');
$description = get_field('description_text');


// Выводим хлебные крошки
if (have_rows('breadcrumbs')): ?>
    <div class="breadcrumbs row">
        <?php while (have_rows('breadcrumbs')): the_row();
            $page_name = get_sub_field('page_name');
            $page_url = get_sub_field('page_url');
            $is_last = get_row_index() === count(get_field('breadcrumbs')); // Проверка на последний элемент
        ?>
            <div class="breabcrumbs-page-name light-text-300 <?php echo $is_last ? 'active' : ''; ?>">
                <?php if (!$is_last): ?>
                    <a href="<?php echo esc_url($page_url); ?>"><?php echo esc_html($page_name); ?></a>
                <?php else: ?>
                    <?php echo esc_html($page_name); ?>
                <?php endif; ?>
            </div>
            <?php if (!$is_last): ?>
                <div class="breabcrumbs-separator"></div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

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
