<?php
/**
 * Add styles and scripts
 * 
 * */
defined( 'ABSPATH' ) || exit;
 
function wr_stili_frontend() {
     wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css', array(), 0.1 );
     wp_enqueue_script('ajax-form', get_stylesheet_directory_uri() . '/js/form_upload.js', array( 'jquery' ) , 0.2, true );
     wp_localize_script( 'ajax-form', 'ajax_form_object', array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-form-nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'wr_stili_frontend', 25 );
