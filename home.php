<?php
/**
 * Home Page file.
 *
 * @package WordPress
 *
 * @subpackage cfc-images
 */

global $wpdb;
$context           = Timber::get_context();
$query_images_args = array(
	'post_type'      => 'attachment',
	'post_mime_type' => 'image',
	'post_status'    => 'inherit',
	'posts_per_page' => - 1,
);

if ( isset( $_GET['q'] ) ) {
	// TODO: split by spaces and commas.
	$tags                            = str_replace( ' ', '', explode( ',', $_GET['q'] ) );
	$query_images_args['meta_query'] = array( 'relation' => 'AND' );
	foreach ( $tags as $tag ) {
		array_push( $query_images_args['meta_query'], array (
			'key'     => 'tags',
			'value'   => sanitize_text_field( $tag ),
			'compare' => 'LIKE',
		));
	}
	$context['search'] = sanitize_text_field( $_GET['q'] );
}

/**
 * Load scripts for the home page
 */
function load_home_scripts() {
	wp_enqueue_script( 'home', get_template_directory_uri() . '/dist/app.js', array( 'jquery', 'jquery-masonry' ) );
}
add_action( 'wp_enqueue_scripts', 'load_home_scripts' );

$query_images = new WP_Query( $query_images_args );
$images       = array();
foreach ( $query_images->posts as $image ) {
	$images[] = new TimberImage( $image->ID );
}


$context['uploadDir'] = wp_upload_dir();
$context['images']    = $images;

Timber::render( 'home.twig', $context );
