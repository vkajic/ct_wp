<?php
include_once( 'settings.php' );
include_once( 'libs/app_db.php' );
require_once get_template_directory() . '/libs/wp-bootstrap-navwalker.php';

function ct_init() {
	add_theme_support( 'title-tag' );
}

add_action( 'init', 'ct_init' );

function add_theme_scripts() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.3.1.slim.min.js', [], '3.3.1' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', [ 'jquery' ], '1.14.7' );
	wp_enqueue_script( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', [
		'jquery',
		'popper'
	], '4.3.1' );
	wp_enqueue_script( 'feather', '//cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js', [ 'jquery' ], '0.0.1' );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', [ 'jquery' ], '0.0.2' );

	$css = cryptotask_get_option( 'app_css' );

	if ( $css ) {
		wp_enqueue_style( 'app', cryptotask_get_option( 'app_css' ), array(), '0.0.1', 'all' );
	}
	wp_enqueue_style( 'style', get_stylesheet_uri(), [ 'app' ], '0.0.3' );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function add_body_class( $classes ) {
	$classes[] = 'ct-landing';

	return $classes;
}

add_filter( 'body_class', 'add_body_class' );

function custom_new_menu() {
	register_nav_menu( 'main-menu', __( 'Main Menu' ) );
	register_nav_menu( 'mobile-menu', __( 'Mobile Menu' ) );
}

add_action( 'init', 'custom_new_menu' );

function menu_classes( $classes, $item, $args ) {
	if ( $args->theme_location == 'main-menu' ) {
		$classes[] = 'list-inline-item';
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'menu_classes', 1, 3 );

function nav_menu_link_atts( $atts, $item, $args, $depth ) {
	$lang = ICL_LANGUAGE_CODE;
	if ( '/' === substr( $atts['href'], 0, 1 ) ) {
		$atts['href'] = cryptotask_get_option( 'app_url_' . $lang ) . $atts['href'];
		$atts['class'] = 'app-link';
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'nav_menu_link_atts', 20, 4 );

function latest_post_from_date( $task ) {
	$timestamp = strtotime( $task->createdAt );
	$diff      = time() - $timestamp;
	$minutes   = floor( $diff / 60 );

	if ( $minutes < 60 ) {
		return $minutes . ' ' . __( 'minutes', 'cryptotask' );
	}

	$hours = floor( $minutes / 60 );

	if ( $hours < 24 ) {
		return $hours . ' ' . __( 'hours', 'cryptotask' );
	}

	return floor( $hours / 24 ) . ' ' . __( 'days', 'cryptotask' );
}

function ct_task_type_mapping( $type ) {
	if ( $type === 'fulltime' ) {
		return __( 'Full time', 'cryptotask' );
	}

	return __( 'Part time', 'cryptotask' );
}

function ct_task_location_mapping( $location ) {
	if ( $location === 'onsite' ) {
		return __( 'On Site', 'cryptotask' );
	}

	return __( 'Remote', 'cryptotask' );
}