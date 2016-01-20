<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gannet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php
				$thumb_id = get_post_thumbnail_id();
				gannet_responsive_thumbnail( $thumb_id );
			?>
		</a>
	<?php endif; ?>

	<div class="inner">

		<header class="entry-header">
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php gannet_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				if ( is_single() ) {
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gannet' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				} else {
					the_excerpt();
				}

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gannet' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php gannet_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-## -->
