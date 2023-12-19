<?php
/**
 * Post Type: City
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add custome type post city
 */
function wr_post_type__sity()
{
	$labels = array(
		'name'				=> 'Город',
		'singular_name' 	=> 'Город',
		'add_new'			=> 'Добавить город', // для добавления новой записи
		'add_new_item'		=> 'Добавление города', // заголовка у вновь создаваемой записи в админ-панели.
		'edit_item'         => 'Редактирование города', // для редактирования типа записи
		'new_item'          => 'Новый город', // текст новой записи
		'view_item'         => 'Смотреть город', // для просмотра записи этого типа.
		'search_items'      => 'Искать город', // для поиска по этим типам записи
		'not_found'         => 'Не найдено', // если в результате поиска ничего не было найдено
		'not_found_in_trash'=> 'Не найдено в корзине', // если не было найдено в корзине
		'parent_item_colon' => '', // для родителей (у древовидных типов)
		'menu_name'         => 'Города', // название меню
	);

	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'has_archive'   => true,
		'menu_icon'     => 'dashicons-location-alt',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
	);

	register_post_type( 'city', $args);
}

add_action( 'init', 'wr_post_type__sity' );