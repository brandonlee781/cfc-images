<?php
/**
 * Single Page file.
 *
 * @package WordPress
 *
 * @subpackage cfc-images
 */

$context              = Timber::get_context();
$post                 = new Timber\Post();
$context['image']     = new TimberImage( $post->id );
$context['uploadDir'] = wp_upload_dir();

Timber::render( 'single.twig', $context );
