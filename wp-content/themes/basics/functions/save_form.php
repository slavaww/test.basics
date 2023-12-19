<?php
// defined( 'ABSPATH' ) || exit;

/**
 * Save 
 */
function ajax_action_callback() {
	// Массив ошибок
	$errors = [];

	// Если не прошла проверка nonce, то блокируем отправку
	if ( !wp_verify_nonce( $_POST['nonce'], 'ajax-form-nonce' ) ) {
		wp_die( 'Данные отправлены с некорректного адреса' );
	}

	if ( empty( $_POST['value']['name_realty'] ) || !isset( $_POST['value']['name_realty'] ) ) {
		$errors['#nameRealty'] = 'Пожалуйста, укажите название объекта недвижимости.';
	} else {
		$post_title = sanitize_text_field( $_POST['value']['name_realty'] );
	}
	
	if ( !empty( $_POST['value']['city_rly'] ) ) {
		$post_city = sanitize_text_field( $_POST['value']['city_rly'] );
	}
	
	if ( empty( $_POST['value']['address_realty'] ) || !isset( $_POST['value']['address_realty'] ) ) {
		$errors['#addressRealty'] = 'Пожалуйста, укажите адрес.';
	} else {
		$post_address = sanitize_text_field( $_POST['value']['address_realty'] );
	}

	if ( empty( $_POST['value']['ss_realty'] ) || !isset( $_POST['value']['ss_realty'] ) ) {
		$errors['#ssRealty'] = 'Пожалуйста, укажите общую площадь объекта.';
	} elseif (!preg_match('/[.0-9]/', $_POST['value']['ss_realty'])) {
		$errors['#ssRealty'] = 'Пожалуйста, укажите общую площадь только цифрами';
	} else {
		$post_ss = sanitize_text_field( $_POST['value']['ss_realty'] );
	}

	if ( empty( $_POST['value']['price_realty'] ) || !isset( $_POST['value']['price_realty'] ) ) {
		$errors['#priceRealty'] = 'Пожалуйста, цену.';
	} elseif (!preg_match('/[.0-9]/', $_POST['value']['price_realty'])) {
		$errors['#priceRealty'] = 'Пожалуйста, укажите цену только цифрами';
	} else {
		$post_price = sanitize_text_field( $_POST['value']['price_realty'] );
	}

	if ( empty( $_POST['value']['s_realty'] ) || !isset( $_POST['value']['s_realty'] ) ) {
		$errors['#sRealty'] = 'Пожалуйста, укажите жилую площадь объекта.';
	} elseif (!preg_match('/[.0-9]/', $_POST['value']['s_realty'])) {
		$errors['#sRealty'] = 'Пожалуйста, укажите жилую площадь только цифрами';
	} else {
		$post_s = sanitize_text_field( $_POST['value']['s_realty'] );
	}

	if ( empty( $_POST['value']['level_realty'] ) || !isset( $_POST['value']['level_realty'] ) ) {
		$errors['#levelRealty'] = 'Пожалуйста, укажите этаж.';
	} elseif (!preg_match('/[0-9]/', $_POST['value']['level_realty'])) {
		$errors['#levelRealty'] = 'Пожалуйста, укажите этаж только цифрами';
	} else {
		$post_level = sanitize_text_field( $_POST['value']['level_realty'] );
	}

	if ( empty( $_POST['value']['text_realty'] ) || !isset( $_POST['value']['text_realty'] ) ) {
		$errors['#textRealty'] = 'Пожалуйста, сделайте описание объекту.';
	} else {
		$post_description = sanitize_text_field( $_POST['value']['text_realty'] );
	}
	
	if (empty($errors)) {

		$args = [
			'post_title'=> $post_title,
			'post_content' => $post_description,
			'post_status'=> 'pending',
			'post_type'=>'realty',
			'post_date'=> get_the_date(),
			'post_parent' => $post_city,
			'meta_input' => [ 
					'ploshhad' => $post_ss,
					'stoimost' => $post_price,
					'adres' => $post_address,
					'zhilaya_ploshhad' => $post_s,
					'etazh' => $post_level,
				]
		];
	
		$is_post_inserted = wp_insert_post($args);
 
		if ($is_post_inserted) {
			$message_success = 'Объект недвижимости добавлен<br>и будет опубликован после утверждения';
			wp_send_json_success( $message_success );
		}

	} else {
		wp_send_json_error( $errors );
	}
}
add_action( 'wp_ajax_ajax_form_action', 'ajax_action_callback' );
add_action( 'wp_ajax_nopriv_ajax_form_action', 'ajax_action_callback' );