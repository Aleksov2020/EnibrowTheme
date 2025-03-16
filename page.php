<?php
/**
 * Шаблон для стандартных страниц
 */

get_header(); ?>

<div class="main-wrapper page-index-wrapper col">
    <?php
        the_content();
    ?>
</div>

<?php get_footer(); ?>
