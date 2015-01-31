<?php
/**
 * @package Gannet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gannet_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			$content = get_the_content();
			$pattern = '#(www\.|https?://)?[a-z0-9]+\.[a-z0-9]{2,4}\S*#i';
			$urls = preg_match_all( $pattern, $content, $matches, PREG_PATTERN_ORDER );

			if ( $urls ) { ?>
				<p>
					<?php
					foreach ( $matches[0] as $m ) {
						printf( '<a href="%s">%s</a><br>', $m, $m );
					} ?>
				</p>
			<?php
			}
		?>

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
