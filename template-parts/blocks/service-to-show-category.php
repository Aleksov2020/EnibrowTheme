<?php
$current_page_slug = get_post_field('post_name', the_ID());

print_r(get_post( the_ID()));

// Проверяем, есть ли таксономия с таким же слагом
$category = get_term_by('slug', $current_page_slug, 'cat_uslyga');

echo $category;

if (!$category) {
    echo '<p>Категория услуг не найдена.</p>';
    return;
}

// Получаем услуги, которые принадлежат этой категории
$args = array(
    'post_type'      => 'uslyga',
    'posts_per_page' => -1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'cat_uslyga',
            'field'    => 'slug',
            'terms'    => $category->slug,
        ),
    ),
);

$services_query = new WP_Query($args);

if ($services_query->have_posts()):
?>
    <div class="subservice wrapper row">
        <?php while ($services_query->have_posts()): $services_query->the_post(); ?>
            <div class="subservice-item col">
                <div class="subservice-item-photo col">
                    <?php if (get_field('service_promo')): ?>
                        <div class="subservice-item-badge badge-primary">Акция</div>
                    <?php endif; ?>
                </div>
                <div class="subservice-item-wrapper col">
                    <div class="subservice-item-title colored-text">
                        <?php the_title(); ?>
                    </div>
                    <div class="subservice-item-text-wrapper col">
                        <div class="subservice-item-text-subtitle colored-text light-text-600">
                            О процедуре:
                        </div>
                        <div class="subservice-item-text-item row">
                            <div class="subservice-item-text-item-icon icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/coinSmall.svg" alt="coin">
                            </div>
                            <div class="subservice-item-text-item-label light-text-300">Стоимость</div> 
                            <div class="subservice-item-text-item-separator"></div> 
                            <div class="subservice-item-text-item-value light-text-300">
                                от <?php the_field('service_price'); ?> ₽
                            </div> 
                        </div>
                        <div class="subservice-item-text-item row">
                            <div class="subservice-item-text-item-label-wrapper row">
                                <div class="subservice-item-text-item-icon icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/clockSmall.svg" alt="clock">
                                </div>
                                <div class="subservice-item-text-item-label light-text-300">Длительность</div> 
                            </div>
                            <div class="subservice-item-text-item-separator"></div> 
                            <div class="subservice-item-text-item-value light-text-300">
                                <?php the_field('service_duration'); ?>
                            </div> 
                        </div>
                    </div>
                    <div class="subservice-button-wrapper row">
                        <a href="<?php the_permalink(); ?>" class="button button-primary">
                            Записаться
                        </a>
                        <a href="<?php the_permalink(); ?>" class="button button-bordered button-hover-white">
                            Подробнее
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <p>Услуги данной категории отсутствуют.</p>
<?php endif; ?>
