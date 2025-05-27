<?php
/**
 * My Growth Tools Theme Customizer
 *
 * @package My_Growth_Tools
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function my_growth_tools_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'my_growth_tools_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'my_growth_tools_customize_partial_blogdescription',
			)
		);
	}

	// Add color customization options
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => '#2DD4BF',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'    => __( 'Primary Color', 'my-growth-tools' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
			)
		)
	);

	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'           => '#3B82F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color',
			array(
				'label'    => __( 'Secondary Color', 'my-growth-tools' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
			)
		)
	);

	$wp_customize->add_setting(
		'text_color',
		array(
			'default'           => '#374151',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'text_color',
			array(
				'label'    => __( 'Text Color', 'my-growth-tools' ),
				'section'  => 'colors',
				'settings' => 'text_color',
			)
		)
	);

	// Add Hero Section
	$wp_customize->add_section(
		'hero_section',
		array(
			'title'    => __( 'Hero Section', 'my-growth-tools' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hero_title',
		array(
			'default'           => __( 'Welcome to My Growth Tools', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hero_title',
		array(
			'label'    => __( 'Hero Title', 'my-growth-tools' ),
			'section'  => 'hero_section',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'hero_description',
		array(
			'default'           => __( 'A modern, minimal WordPress theme for personal blogging and portfolios.', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hero_description',
		array(
			'label'    => __( 'Hero Description', 'my-growth-tools' ),
			'section'  => 'hero_section',
			'type'     => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'hero_button_text',
		array(
			'default'           => __( 'Learn More', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hero_button_text',
		array(
			'label'    => __( 'Button Text', 'my-growth-tools' ),
			'section'  => 'hero_section',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'hero_button_url',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hero_button_url',
		array(
			'label'    => __( 'Button URL', 'my-growth-tools' ),
			'section'  => 'hero_section',
			'type'     => 'url',
		)
	);

	// Add Featured Section
	$wp_customize->add_section(
		'featured_section',
		array(
			'title'    => __( 'Featured Section', 'my-growth-tools' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'show_featured_section',
		array(
			'default'           => true,
			'sanitize_callback' => 'my_growth_tools_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'show_featured_section',
		array(
			'label'    => __( 'Show Featured Section', 'my-growth-tools' ),
			'section'  => 'featured_section',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'featured_section_title',
		array(
			'default'           => __( 'Featured', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'featured_section_title',
		array(
			'label'    => __( 'Section Title', 'my-growth-tools' ),
			'section'  => 'featured_section',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'featured_section_link_text',
		array(
			'default'           => __( 'See all', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'featured_section_link_text',
		array(
			'label'    => __( 'Link Text', 'my-growth-tools' ),
			'section'  => 'featured_section',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'featured_section_link_url',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'featured_section_link_url',
		array(
			'label'    => __( 'Link URL', 'my-growth-tools' ),
			'section'  => 'featured_section',
			'type'     => 'url',
		)
	);

	// Add Newsletter Section
	$wp_customize->add_section(
		'newsletter_section',
		array(
			'title'    => __( 'Newsletter Section', 'my-growth-tools' ),
			'priority' => 50,
		)
	);

	$wp_customize->add_setting(
		'show_newsletter_section',
		array(
			'default'           => true,
			'sanitize_callback' => 'my_growth_tools_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'show_newsletter_section',
		array(
			'label'    => __( 'Show Newsletter Section', 'my-growth-tools' ),
			'section'  => 'newsletter_section',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'newsletter_title',
		array(
			'default'           => __( 'Receive new posts straight to your inbox.', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'newsletter_title',
		array(
			'label'    => __( 'Newsletter Title', 'my-growth-tools' ),
			'section'  => 'newsletter_section',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'newsletter_description',
		array(
			'default'           => __( 'No spam ever. Unsubscribe anytime, no questions asked.', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'newsletter_description',
		array(
			'label'    => __( 'Newsletter Description', 'my-growth-tools' ),
			'section'  => 'newsletter_section',
			'type'     => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'newsletter_placeholder',
		array(
			'default'           => __( 'Your best email', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'newsletter_placeholder',
		array(
			'label'    => __( 'Email Placeholder', 'my-growth-tools' ),
			'section'  => 'newsletter_section',
			'type'     => 'text',
		)
	);

	$wp_customize->add_setting(
		'newsletter_button_text',
		array(
			'default'           => __( 'Subscribe', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'newsletter_button_text',
		array(
			'label'    => __( 'Button Text', 'my-growth-tools' ),
			'section'  => 'newsletter_section',
			'type'     => 'text',
		)
	);

	// Add Footer Options
	$wp_customize->add_section(
		'footer_options',
		array(
			'title'    => __( 'Footer Options', 'my-growth-tools' ),
			'priority' => 60,
		)
	);

	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'default'           => __( 'Copyright © 2025 My Growth Tools. All rights reserved.', 'my-growth-tools' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'footer_copyright',
		array(
			'label'    => __( 'Copyright Text', 'my-growth-tools' ),
			'section'  => 'footer_options',
			'type'     => 'text',
		)
	);
}
add_action( 'customize_register', 'my_growth_tools_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function my_growth_tools_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function my_growth_tools_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Sanitize checkbox values.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool
 */
function my_growth_tools_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function my_growth_tools_customize_preview_js() {
	wp_enqueue_script( 'my-growth-tools-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), MY_GROWTH_TOOLS_VERSION, true );
}
add_action( 'customize_preview_init', 'my_growth_tools_customize_preview_js' );

/**
 * Generate CSS for the color customization options.
 */
function my_growth_tools_customizer_css() {
	$primary_color = get_theme_mod( 'primary_color', '#2DD4BF' );
	$secondary_color = get_theme_mod( 'secondary_color', '#3B82F6' );
	$text_color = get_theme_mod( 'text_color', '#374151' );
	
	$css = '
		:root {
			--primary-color: ' . esc_attr( $primary_color ) . ';
			--secondary-color: ' . esc_attr( $secondary_color ) . ';
			--text-color: ' . esc_attr( $text_color ) . ';
		}
		
		a {
			color: ' . esc_attr( $primary_color ) . ';
		}
		
		a:hover {
			color: ' . esc_attr( $secondary_color ) . ';
		}
		
		body {
			color: ' . esc_attr( $text_color ) . ';
		}
		
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button,
		.hero-button,
		.wp-block-button__link {
			background-color: ' . esc_attr( $primary_color ) . ';
		}
		
		button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		.button:hover,
		.hero-button:hover,
		.wp-block-button__link:hover {
			background-color: ' . esc_attr( $secondary_color ) . ';
		}
		
		.main-navigation ul li:hover > a,
		.main-navigation ul li.focus > a,
		.main-navigation ul li.current-menu-item > a {
			color: ' . esc_attr( $primary_color ) . ';
		}
		
		.card-link,
		.section-link {
			color: ' . esc_attr( $primary_color ) . ';
		}
		
		.social-links a:hover {
			background-color: ' . esc_attr( $primary_color ) . ';
		}
		
		.wp-block-quote {
			border-left-color: ' . esc_attr( $primary_color ) . ';
		}
		
		.wp-block-pullquote {
			border-top-color: ' . esc_attr( $primary_color ) . ';
			border-bottom-color: ' . esc_attr( $primary_color ) . ';
		}
	';
	
	wp_add_inline_style( 'my-growth-tools-style', $css );
}
add_action( 'wp_enqueue_scripts', 'my_growth_tools_customizer_css' );
