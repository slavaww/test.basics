<?php
/**
 * Theme setups
 */
defined( 'ABSPATH' ) || exit;

 if (!function_exists( 'wr_theme_setup' ) ) {
	function wr_theme_setup() {
		/**
		 * Меню
		 */
		register_nav_menus( array(
			'main' => __( 'Main Menu' ),
			'side' => __( 'Side Menu' ),
		) );

		/**
		 * Поддержка картинки
		 */
		add_theme_support( 'post-thumbnails', array( 'city', 'realty' ) );
	}
}
add_action( 'after_setup_theme', 'wr_theme_setup' );

/**
 * Add city & realty to home page
 */
function wr_add_city_realty_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'city', 'realty' ) );
	return $query;
}
add_action( 'pre_get_posts', 'wr_add_city_realty_to_query' );

## Dialog Form в конце документа
function wr_form_add_content() {
	?>
	<dialog id="addrealty">
		<form id="arealty">
			<div class="form-group">
				<label for="name_realty">Наименование объекта:</label>
				<input type="text" class="form-control" id="name_realty" name="name_realty" aria-describedby="nameRealty" value="">
				<small id="nameRealty" class="form-text text-muted">Введите наименование объекта недвижимости</small>
			</div>
			<div class="form-group">
				<label for="city_rly">Город, где находится объект:</label>
				<select class="form-control" id="city_rly">
					<?php $cities = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));
						foreach( $cities as $city ) {
							echo '<option value="' . $city->ID . '">' . esc_html($city->post_title) . '</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="address_realty">Адрес объекта:</label>
				<input type="text" class="form-control" name="address_realty" id="address_realty" aria-describedby="addressRealty" value="">
				<small id="addressRealty" class="form-text text-muted">Введите адрес объекта недвижимости</small>
			</div>
			<div class="form-group">
				<label for="ss_realty">Общая площадь:</label>
				<input type="text" class="form-control" name="ss_realty" id="ss_realty" aria-describedby="ssRealty" value="">
				<small id="ssRealty" class="form-text text-muted">Введите общую площадь кв.м</small>
			</div>
			<div class="form-group">
				<label for="price_realty">Цена:</label>
				<input type="text" class="form-control" name="price_realty" id="price_realty" aria-describedby="priceRealty" value="">
				<small id="priceRealty" class="form-text text-muted">Укажите цену в рублях</small>
			</div>
			<div class="form-group">
				<label for="s_realty">Жилая площадь:</label>
				<input type="text" class="form-control" name="s_realty" id="s_realty" aria-describedby="sRealty" value="">
				<small id="sRealty" class="form-text text-muted">Введите жилую площадь кв.м</small>
			</div>
			<div class="form-group">
				<label for="level_realty">Этаж:</label>
				<input type="text" class="form-control" name="level_realty" id="level_realty" aria-describedby="levelRealty" value="">
				<small id="levelRealty" class="form-text text-muted">Укажите этаж цифрами</small>
			</div>
			<div class="form-group">
				<label for="text_realty">Описание:</label>
				<textarea class="form-control" name="text_realty" id="text_realty" rows="3"></textarea>
				<small id="textRealty" class="form-text text-muted"></small>
			</div>
			<div id="mess" class="row">
				<div class="col-sm-6">
					<button type="button" class="btn btn-secondary" onclick="window.addrealty.close()">Отменить</button>
				</div>
				<div class="col-sm-6">
					<input type="submit" id="form_submit" class="button btn btn-primary form_button" value="Отправить"/>
				</div>
			</div>
		</form>
	</dialog>
	<?php
}
add_action( 'wp_footer', 'wr_form_add_content', 10 );