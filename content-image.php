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
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'medium' );
			} else if ( $image = gannet_catch_that_image() ) {
				$image_id = gannet_get_attachment_id_from_url( $image );
				$image = wp_get_attachment_image( $image_id, 'medium' );
			}

			if ( $image ) {
				printf( '<a href="%s">%s</a>', get_permalink(), $image );
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
