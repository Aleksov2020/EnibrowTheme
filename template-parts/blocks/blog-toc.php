<?php if( have_rows('content_items') ): ?>
    <div class="blogpage-content-wrapper col">
        <div class="blogpage-content-title-wrapper row">
            <div class="dash-part"></div>
            <div class="popular-faq-title text-30-400"> Содержание статьи </div>
            <div class="dash-part"></div>
        </div>

        <div class="blogpage-content row">
            <?php $index = 1; ?>
            <?php while( have_rows('content_items') ): the_row(); 
                $title = get_sub_field('content_title');
            ?>
                <div class="blogpage-content-item-wrapper row" data-index="<?= $index; ?>">
                    <div class="blogpage-content-item-number-wrapper">
                        <div class="blogpage-content-item-number"><?= $index; ?></div>
                    </div>
                    <div class="blogpage-content-item-value"><?= esc_html($title); ?></div>
                </div>
                <?php $index++; ?>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll(".blogpage-content-item-wrapper");
            const headings = document.querySelectorAll("h2");

            items.forEach((item, index) => {
                item.addEventListener("click", function() {
                    if (headings[index]) {
                        window.scrollTo({
                            top: headings[index].offsetTop - 100, // небольшой отступ
                            behavior: "smooth"
                        });
                    }
                });
            });
        });

    </script>

<?php endif; ?>
