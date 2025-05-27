<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package My_Growth_Tools
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function my_growth_tools_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'my_growth_tools_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function my_growth_tools_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	} else {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_action( 'body_class', 'my_growth_tools_body_classes' );

/**
 * Add a class to the navigation menu items if they have children
 */
function my_growth_tools_add_menu_parent_class( $items ) {
	$parents = array();
	
	// Collect menu items with parents.
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	// Add class to menu items that are parents.
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-item-has-children';
		}
	}
	
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'my_growth_tools_add_menu_parent_class' );

/**
 * Add meta tag for mobile viewport
 */
function my_growth_tools_add_mobile_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}
add_action( 'wp_head', 'my_growth_tools_add_mobile_viewport', 1 );

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function my_growth_tools_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'my-growth-tools-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'my_growth_tools_resource_hints', 10, 2 );

/**
 * Add featured post meta box
 */
function my_growth_tools_add_meta_boxes() {
	add_meta_box(
		'my_growth_tools_featured_post',
		__( 'Featured Post', 'my-growth-tools' ),
		'my_growth_tools_featured_post_callback',
		'post',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'my_growth_tools_add_meta_boxes' );

/**
 * Featured post meta box callback
 */
function my_growth_tools_featured_post_callback( $post ) {
	wp_nonce_field( 'my_growth_tools_featured_post_nonce', 'my_growth_tools_featured_post_nonce' );
	$featured = get_post_meta( $post->ID, '_featured', true );
	?>
	<p>
		<input type="checkbox" id="my_growth_tools_featured_post" name="my_growth_tools_featured_post" <?php checked( $featured, 'yes' ); ?> />
		<label for="my_growth_tools_featured_post"><?php esc_html_e( 'Mark as featured post', 'my-growth-tools' ); ?></label>
	</p>
	<?php
}

/**
 * Save featured post meta box
 */
function my_growth_tools_save_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['my_growth_tools_featured_post_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['my_growth_tools_featured_post_nonce'], 'my_growth_tools_featured_post_nonce' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$featured = isset( $_POST['my_growth_tools_featured_post'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_featured', $featured );
}
add_action( 'save_post', 'my_growth_tools_save_meta_boxes' );

/**
 * Add Schema.org markup for better SEO
 */
function my_growth_tools_schema_org() {
	// Check if is single post and not a page
	if ( is_singular( 'post' ) ) {
		echo '<script type="application/ld+json">';
		echo json_encode(
			array(
				'@context'      => 'https://schema.org',
				'@type'         => 'BlogPosting',
				'headline'      => esc_html( get_the_title() ),
				'datePublished' => get_the_date( 'c' ),
				'dateModified'  => get_the_modified_date( 'c' ),
				'author'        => array(
					'@type' => 'Person',
					'name'  => esc_html( get_the_author() ),
				),
				'publisher'     => array(
					'@type' => 'Organization',
					'name'  => esc_html( get_bloginfo( 'name' ) ),
					'logo'  => array(
						'@type' => 'ImageObject',
						'url'   => esc_url( get_site_icon_url() ),
					),
				),
				'description'   => esc_html( get_the_excerpt() ),
			)
		);
		echo '</script>';
	}
}
add_action( 'wp_head', 'my_growth_tools_schema_org' );
