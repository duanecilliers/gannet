<?php
/**
 * @package Gannet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			$title = get_the_title();
			$content = get_the_content();
			$pattern = '#(www\.|https?://)?[a-z0-9]+\.[a-z0-9]{2,4}\S*#i';
			$urls = preg_match_all( $pattern, $content, $matches, PREG_PATTERN_ORDER );

			if ( isset( $matches[0] ) && ! empty( $matches ) ) {
				$url = array_shift( $matches[0] );
			} else {
				$url = get_permalink();
			}
			$url = esc_url( $url );

			if ( empty( $title ) ) {
				$title = $url;
			}

			$target = ( strpos( $url, home_url() ) === false ) ? 'target="_blank"' : '';

			printf( '<h1 class="entry-title"><a href="%s" %s>%s</a></h1>', $url, $target, $title );
		?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gannet_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'gannet' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gannet_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
