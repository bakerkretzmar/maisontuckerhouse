<time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date( 'M Y' ); ?></time> – <p class="byline author vcard"><a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="tags"><?php the_tags('', ' '); ?></p>