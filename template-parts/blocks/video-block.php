<?php
$args = array(
    'post_type'      => 'video',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'video_show',
            'value' => '1',
        ),
    ),
);
$videos = new WP_Query($args);

if ($videos->have_posts()) {
    echo '<div class="video wrapper wrapper-laptop col">';
    echo '    <div class="title-wrapper row">';
    echo '        <div class="title-left-arrow row">';
    echo '            <div class="spacer-title"></div>';
    echo '            <div class="circle-title"></div>';
    echo '        </div>';
    echo '        <div class="title">';
    echo '            <h2>'.get_field('title').'</h2>';
    echo '        </div>';
    echo '        <div class="title-right-arrow row">';
    echo '            <div class="circle-title"></div>';
    echo '            <div class="spacer-title"></div>';
    echo '        </div>';
    echo '    </div>';

    echo '    <div class="video-subtitle text-16-300">';
    echo '        Этот вид процедуры выбирает большинство посетительниц салонов красоты. ';
    echo '        Его особенностью является детальная прорисовка – мастер рисует каждый отдельный волосок, что придает естественный вид бровям. ';
    echo '        Делают волосковый татуаж в 2-х техниках:';
    echo '    </div>';

    echo '    <div class="video-wrapper row">';
    while ($videos->have_posts()) {
        $videos->the_post();
        $video_thumbnail = get_field('video_thumbnail', get_the_ID());
        $video_url = get_field('video_url', get_the_ID());
        
        if ($video_thumbnail && $video_url) {
            echo '        <div class="video-item row" style="background-image: url(' . esc_url($video_thumbnail['url']) . ');" >';
            echo '            <div class="video-filter">';
            echo '                <div  class="video-button row">';
            echo '                                               <svg width="30" height="33" viewBox="0 0 30 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.5347 12.1699C29.868 14.0944 29.868 18.9056 26.5347 20.8301L7.78466 31.6554C4.45133 33.5799 0.284666 31.1743 0.284667 27.3253L0.284667 5.67467C0.284668 1.82567 4.45133 -0.579946 7.78467 1.34455L26.5347 12.1699Z" fill="white"/>
                            </svg>';
            echo '                </div>';
            echo '            </div>';
            echo '        </div>';
        }
    }
    echo '    </div>';

    echo '    <div class="button button-primary all-video">';
    echo '        Посмотреть все видео';
    echo '    </div>';
    echo '</div>';
}
wp_reset_postdata(); 

?>