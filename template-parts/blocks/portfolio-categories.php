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
            <h2><?= esc_html(get_field('title') ?: 'Фото работ'); ?></h2>
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

    <?php if (count($portfolio_works) > 10) : ?>
        <div class="gallery-load-more-wrapper row">
            <div id="load-more-button" class="button button-primary">
                Загрузить еще
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const categoryButtons = document.querySelectorAll(".gallery-category");
    const galleryWrapper = document.getElementById("gallery-items");
    const loadMoreBtn = document.getElementById("load-more-button");

    let currentOffset = 0;
    const itemsPerPage = 10;
    let currentCategory = "all";

    function fetchPortfolioWorks(category, append = false) {
        const formData = new FormData();
        formData.append("action", "filter_portfolio");
        formData.append("category", category);
        formData.append("offset", currentOffset);
        formData.append("limit", itemsPerPage);

        fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (!append) galleryWrapper.innerHTML = '';
            galleryWrapper.insertAdjacentHTML('beforeend', data.html);
            window.galleryDataMap["sliderGallery"] = append
                ? (window.galleryDataMap["sliderGallery"] || []).concat(data.galleryData)
                : data.galleryData;

            if (data.has_more) {
                loadMoreBtn.style.display = "flex";
            } else {
                loadMoreBtn.style.display = "none";
            }
        });
    }

    categoryButtons.forEach(button => {
        button.addEventListener("click", function() {
            categoryButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            currentCategory = this.getAttribute("data-category");
            currentOffset = 0;
            fetchPortfolioWorks(currentCategory);
        });
    });

    loadMoreBtn.addEventListener("click", () => {
        currentOffset += itemsPerPage;
        fetchPortfolioWorks(currentCategory, true);
    });

    fetchPortfolioWorks("all");
});


</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const galleryDataExample = <?php echo json_encode($gallery_data); ?>;

    document.querySelectorAll(".gallery-photo").forEach((el, index) => {
        el.addEventListener("click", () => {
            openGallery(index, galleryDataExample);
        });
    });
});
</script>