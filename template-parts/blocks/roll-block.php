<?php 
$roll_content = get_field('roll_content'); 
$skip_roll = get_field('skip_roll_block'); // Получаем значение чекбокса
if ($roll_content): 
?>
    <div class="roll-block wrapper wrapper-laptop col <?php echo $skip_roll ? 'skip' : ''; ?>">
        <?php foreach ($roll_content as $block): ?>
            <?php if ($block['acf_fc_layout'] == 'links_block'): ?>
                <div class="roll-block-links text-16-300">
                    <?php if (!empty($block['links'])): ?>
                        <?php foreach ($block['links'] as $link): ?>
                            <a href="/#<?php echo esc_html($link['text']); ?>" rel="noopener" class="roll-block-link">
                                <?php echo esc_html($link['text']); ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php elseif ($block['acf_fc_layout'] == 'title_block'): ?>
                <div class="roll-block-title text-30-400">
                    <?php echo esc_html($block['title']); ?>
                </div>
            <?php elseif ($block['acf_fc_layout'] == 'text_block'): ?>
                <div class="roll-block-text text-16-300">
                    <?php echo wp_kses_post($block['text']); ?>
                </div>
            <?php elseif ($block['acf_fc_layout'] == 'list_item'): ?>
                <div class="roll-block-items-wrapper col">
                    <div class="roll-block-item-wrapper row">
                        <div class="roll-block-item-icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/liIcon.svg" alt="icon-li" width="8" height="14">
                        </div>
                        <div class="roll-block-item-title text-16-700">
                            <?php echo esc_html($block['list_title']); ?>
                        </div>
                        <div class="roll-block-item-text text-16-300">
                            <?php echo wp_kses_post($block['list_text']); ?>
                        </div>
                    </div>
                </div>
            <?php elseif ($block['acf_fc_layout'] == 'danger_block'): ?>
                <div class="roll-block-dangerous-wrapper col">
                    <div class="roll-block-dangerous-text-wrapper row">
                        <div class="roll-block-dangerous-text-icon">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/dangerous-icon.png" alt="icon-dangerous" width="60px" height="66px">
                        </div>
                        <div class="roll-block-dangerous-text text-16-300">
                            <?php echo wp_kses_post($block['danger_text']); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <?php if (!$skip_roll): // Если чекбокс не включен, показываем кнопку ?>
        <div class="button-roll-block text-16-300 clickable">
            Свернуть текст
        </div>
    <?php endif; ?>

<?php endif; ?>
