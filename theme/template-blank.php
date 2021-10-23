<?php 

/*
	Template Name: Blank
*/


/**
 * The template for displaying just the header and footer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hartsoft
 * @subpackage GenLite
 * @since 1.4.2
 * @version 1.4.2
 */

$context = Timber::context();

$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

Timber::render( 'page-blank.twig' , $context );

