<?php
/**
 * Post Type: realty
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add the custom type post: realty
 */
function wr_post_type__realty()
{
	$labels = array(
		'name'				=> 'Недвижимость',
		'singular_name' 	=> 'Недвижимость',
		'add_new'			=> 'Добавить недвижимость', // для добавления новой записи
		'add_new_item'		=> 'Добавление недвижимости', // заголовка у вновь создаваемой записи в админ-панели.
		'edit_item'         => 'Редактирование недвижимости', // для редактирования типа записи
		'new_item'          => 'Новая недвижимость', // текст новой записи
		'view_item'         => 'Смотреть недвижимость', // для просмотра записи этого типа.
		'search_items'      => 'Искать недвижимость', // для поиска по этим типам записи
		'not_found'         => 'Не найдено', // если в результате поиска ничего не было найдено
		'not_found_in_trash'=> 'Не найдено в корзине', // если не было найдено в корзине
		'parent_item_colon' => '', // для родителей (у древовидных типов)
		'menu_name'         => 'Недвижимость', // название меню
	);

	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'has_archive'   => false,
		'menu_icon'     => 'dashicons-building',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
		'taxonomies'	=> array(),
	);

	register_post_type( 'realty', $args);
}

add_action( 'init', 'wr_post_type__realty' );

/**
 * Add taxonomy
 */
function create_taxonomy__reality() {
	$args = array(
			'label' => 'Тип недвижимости',
			'labels' => array(
				'name' => 'Тип недвижимости',
				'add_new_item' => 'Добавить тип недвижимости',
				'new_item_name' => "Новый тип недвижимости",
				'menu_name' => __( 'Типы недвижимости' ),
			),
			'public' => true, 
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		);

    register_taxonomy( 'realty_types', array('realty'), $args );
}
add_action( 'init', 'create_taxonomy__reality', 0 );

/**
 * Add metabox inside realty with the cities
 */
function city_metabox_callback( $post ) {
 
	$cities = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));
	
    if ( $cities ) {
		
		echo '<select name="post_parent">';
        foreach( $cities as $city ) {
			echo '<option value="' . $city->ID . '" '
			. selected($city->ID, $post->post_parent) 
			. '>'
			. esc_html($city->post_title) 
			. '</option>';
        }
        echo '</select>';
		
    } else {
		echo 'Города не найдены!';
	}
}
function wr_add_city_metabox() {
 
	add_meta_box(
		'cyty_metabox', // ID 
		'Город расположения', // заголовок
		'city_metabox_callback', // Callback функция
		'realty', // типы постов, для которых его подключим
		'side', // расположение (normal, side, advanced)
		'default' // приоритет (default, low, high, core)
	);
 
}
add_action( 'add_meta_boxes', 'wr_add_city_metabox' );
// Save meta
function wr_save_meta( $post_id, $post ) {
	
	// ничего не делаем для автосохранений
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}
	
	// проверяем тип записи
	if( 'realty' !== $post->post_type ) {
		return $post_id;
	}
	
	if( isset( $_POST[ 'cyty_metabox' ] ) ) {
		update_post_meta( $post_id, 'cyty_metabox', sanitize_text_field( $_POST[ 'cyty_metabox' ] ) );
	} else {
		delete_post_meta( $post_id, 'cyty_metabox' );
	}
	
	return $post_id;
	
}
add_action( 'save_post', 'wr_save_meta', 10, 2 );