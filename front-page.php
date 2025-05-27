<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My_Growth_Tools
 */

get_header();
?>

	<main id="primary" class="site-main">
		
		<section class="hero">
			<div class="container">
				<div class="hero-content">
					<h1 class="hero-title"><?php echo esc_html( get_theme_mod( 'hero_title', __( 'Welcome to My Growth Tools', 'my-growth-tools' ) ) ); ?></h1>
					<p class="hero-description"><?php echo esc_html( get_theme_mod( 'hero_description', __( 'A modern, minimal WordPress theme for personal blogging and portfolios.', 'my-growth-tools' ) ) ); ?></p>
					<?php if ( get_theme_mod( 'hero_button_text', __( 'Learn More', 'my-growth-tools' ) ) ) : ?>
						<a href="<?php echo esc_url( get_theme_mod( 'hero_button_url', '#' ) ); ?>" class="hero-button"><?php echo esc_html( get_theme_mod( 'hero_button_text', __( 'Learn More', 'my-growth-tools' ) ) ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php if ( get_theme_mod( 'show_featured_section', true ) ) : ?>
		<section class="featured-section">
			<div class="container">
				<div class="section-header">
					<h2 class="section-title"><?php echo esc_html( get_theme_mod( 'featured_section_title', __( 'Featured', 'my-growth-tools' ) ) ); ?></h2>
					<?php if ( get_theme_mod( 'featured_section_link_text' ) ) : ?>
						<a href="<?php echo esc_url( get_theme_mod( 'featured_section_link_url', '#' ) ); ?>" class="section-link"><?php echo esc_html( get_theme_mod( 'featured_section_link_text', __( 'See all', 'my-growth-tools' ) ) ); ?></a>
					<?php endif; ?>
				</div>

				<div class="posts-grid">
					<?php
					$featured_posts = new WP_Query(
						array(
							'post_type'      => 'post',
							'posts_per_page' => 3,
							'meta_key'       => '_featured',
							'meta_value'     => 'yes',
						)
					);

					if ( $featured_posts->have_posts() ) :
						while ( $featured_posts->have_posts() ) :
							$featured_posts->the_post();
							get_template_part( 'template-parts/content/content', 'card' );
						endwhile;
						wp_reset_postdata();
					else :
						// If no featured posts, show recent posts
						$recent_posts = new WP_Query(
							array(
								'post_type'      => 'post',
								'posts_per_page' => 3,
							)
						);

						while ( $recent_posts->have_posts() ) :
							$recent_posts->the_post();
							get_template_part( 'template-parts/content/content', 'card' );
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'show_categories_section', true ) ) : ?>
		<section class="categories-section">
			<div class="container">
				<div class="section-header">
					<h2 class="section-title"><?php echo esc_html( get_theme_mod( 'categories_section_title', __( 'Explore', 'my-growth-tools' ) ) ); ?></h2>
					<?php if ( get_theme_mod( 'categories_section_link_text' ) ) : ?>
						<a href="<?php echo esc_url( get_theme_mod( 'categories_section_link_url', '#' ) ); ?>" class="section-link"><?php echo esc_html( get_theme_mod( 'categories_section_link_text', __( 'See all', 'my-growth-tools' ) ) ); ?></a>
					<?php endif; ?>
				</div>

				<div class="categories-grid">
					<?php
					$categories = get_categories( array(
						'orderby' => 'count',
						'order'   => 'DESC',
						'number'  => 5,
					) );

					foreach ( $categories as $category ) :
						?>
						<div class="category-card">
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="category-link">
								<h3 class="category-title"><?php echo esc_html( $category->name ); ?></h3>
								<p class="category-description"><?php echo esc_html( $category->description ); ?></p>
							</a>
						</div>
						<?php
					endforeach;
					?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'show_recommendations_section', true ) ) : ?>
		<section class="recommendations-section">
			<div class="container">
				<div class="section-header">
					<h2 class="section-title"><?php echo esc_html( get_theme_mod( 'recommendations_section_title', __( 'Recommendations', 'my-growth-tools' ) ) ); ?></h2>
					<?php if ( get_theme_mod( 'recommendations_section_link_text' ) ) : ?>
						<a href="<?php echo esc_url( get_theme_mod( 'recommendations_section_link_url', '#' ) ); ?>" class="section-link"><?php echo esc_html( get_theme_mod( 'recommendations_section_link_text', __( 'See all', 'my-growth-tools' ) ) ); ?></a>
					<?php endif; ?>
				</div>

				<div class="recommendations-grid">
					<?php
					// Placeholder recommendations
					$recommendations = array(
						array(
							'title' => __( 'Growth Strategy', 'my-growth-tools' ),
							'description' => __( 'Learn about effective growth strategies for your business or personal brand.', 'my-growth-tools' ),
							'url' => '#',
						),
						array(
							'title' => __( 'Digital Marketing', 'my-growth-tools' ),
							'description' => __( 'Explore digital marketing techniques to reach your target audience.', 'my-growth-tools' ),
							'url' => '#',
						),
						array(
							'title' => __( 'Content Creation', 'my-growth-tools' ),
							'description' => __( 'Discover how to create engaging content that resonates with your audience.', 'my-growth-tools' ),
							'url' => '#',
						),
						array(
							'title' => __( 'Analytics', 'my-growth-tools' ),
							'description' => __( 'Learn how to use data and analytics to make informed decisions.', 'my-growth-tools' ),
							'url' => '#',
						),
					);

					foreach ( $recommendations as $recommendation ) :
						?>
						<div class="recommendation-card">
							<a href="<?php echo esc_url( $recommendation['url'] ); ?>" class="recommendation-link">
								<h3 class="recommendation-title"><?php echo esc_html( $recommendation['title'] ); ?></h3>
								<p class="recommendation-description"><?php echo esc_html( $recommendation['description'] ); ?></p>
							</a>
						</div>
						<?php
					endforeach;
					?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'show_newsletter_section', true ) ) : ?>
		<section class="newsletter-section">
			<div class="container">
				<h2 class="newsletter-title"><?php echo esc_html( get_theme_mod( 'newsletter_title', __( 'Receive new posts straight to your inbox.', 'my-growth-tools' ) ) ); ?></h2>
				<p class="newsletter-description"><?php echo esc_html( get_theme_mod( 'newsletter_description', __( 'No spam ever. Unsubscribe anytime, no questions asked.', 'my-growth-tools' ) ) ); ?></p>
				
				<form class="newsletter-form" action="#" method="post">
					<input type="email" name="email" placeholder="<?php echo esc_attr( get_theme_mod( 'newsletter_placeholder', __( 'Your best email', 'my-growth-tools' ) ) ); ?>" required>
					<button type="submit"><?php echo esc_html( get_theme_mod( 'newsletter_button_text', __( 'Subscribe', 'my-growth-tools' ) ) ); ?></button>
				</form>
			</div>
		</section>
		<?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
