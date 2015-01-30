<?php
/**
 * @package Gannet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<blockquote>
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gannet' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>

			<cite>
				&mdash; <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
			</cite>
		</blockquote>

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
