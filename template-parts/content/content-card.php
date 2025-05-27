<?php
/**
 * Template part for displaying posts in card format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_Growth_Tools
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" class="card-thumbnail">
		<?php the_post_thumbnail('my-growth-tools-card'); ?>
	</a>
	<?php endif; ?>
	
	<div class="card-content">
		<header class="entry-header">
			<?php the_title( '<h3 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="card-meta">
				<?php
				my_growth_tools_posted_on();
				?>
			</div><!-- .card-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="card-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .card-excerpt -->
		
		<a href="<?php the_permalink(); ?>" class="card-link"><?php esc_html_e( 'Read more', 'my-growth-tools' ); ?></a>
	</div><!-- .card-content -->
</article><!-- #post-<?php the_ID(); ?> -->
