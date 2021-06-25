<footer class="tw_w-full tw_py-6 tw_px-4">
    <p class="tw_text-center tw_mb-2"><?php echo mth_trans('Thanks to our sponsors and partners:'); ?></p>

    <div class="tw_flex tw_flex-wrap tw_-mx-4">
        <?php
            $logos = get_posts([
                'post_type' => 'attachment',
                'numberposts' => '-1',
                'tax_query' => [
                    [
                        'taxonomy' => 'media_tag',
                        'field' => 'slug',
                        'terms' => 'sponsor_logo',
                    ],
                ],
            ]);

            foreach ($logos as $logo) {
                $meta = wp_get_attachment_metadata($logo->ID);

                echo '<div class="tw_m-8 tw_text-center"><a href="' . esc_url($logo->media_link) . '" target="_blank">' . wp_get_attachment_image($logo->ID, 'full') . '</a></div>';
            }
        ?>
    </div>
</footer>
