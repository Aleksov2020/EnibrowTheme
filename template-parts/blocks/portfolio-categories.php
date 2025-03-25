<?php
// Получаем услуги с привязанными работами портфолио
$services = get_posts(array(
    'post_type'      => 'uslyga',
    'posts_per_page' => -1,
));

$categories = array();
foreach ($services as $service) {
    $portfolio_works = get_field('service_portfolio_works', $service->ID);
    $short_name = get_field('service_short_name', $service->ID);
    
    // Отображаем кнопку только если есть больше 1 работы с `portfolio_main`
    if ($portfolio_works) {
        $filtered_works = array_filter($portfolio_works, function($work_id) {
            return get_field('portfolio_main', $work_id);
        });
        if (count($filtered_works) > 1) {
            $categories[$service->ID] = $short_name;
        }
    }
}
?>

<div class="gallery wrapper wrapper-laptop col">
    <div class="title-wrapper row">
        <div class="title-left-arrow row">
            <div class="spacer-title"></div>
            <div class="circle-title"></div>
        </div>
        <div class="title">
            <h2>Фото работ</h2>
        </div>
        <div class="title-right-arrow row">
            <div class="circle-title"></div>
            <div class="spacer-title"></div>
        </div>
    </div>

    <div class="gallery-category-wrapper row">
        <div class="gallery-category text-16-300 active clickable" data-category="all">Все</div>
        <?php foreach ($categories as $service_id => $cat_name): ?>
            <div class="gallery-category text-16-300 clickable" data-category="<?php echo esc_attr($service_id); ?>">
                <?php echo esc_html($cat_name); ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="gallery-items-wrapper row" id="gallery-items">
        <!-- AJAX контент -->
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const categoryButtons = document.querySelectorAll(".gallery-category");
    const galleryWrapper = document.getElementById("gallery-items");

    function fetchPortfolioWorks(category) {
        const formData = new FormData();
        formData.append("action", "filter_portfolio");
        formData.append("category", category);

        fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            galleryWrapper.innerHTML = data;
        });
    }

    categoryButtons.forEach(button => {
        button.addEventListener("click", function() {
            categoryButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            const selectedCategory = this.getAttribute("data-category");
            fetchPortfolioWorks(selectedCategory);
        });
    });

    fetchPortfolioWorks("all");
});
</script>
