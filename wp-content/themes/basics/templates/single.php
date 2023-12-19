<?php
/**
 * Template part for view single realty
 */
defined( 'ABSPATH' ) || exit;
?>
<header>
	<h1><?php the_title(); ?></h1>
</header>
<?php
for ($i=1; $i <= 4; $i++) { 
	# Get all pictures
	if ($i === 1) {
		$field_img = 'photo_realty';
	} else {
		$field_img = 'photo_realty_' . $i;
	}
	if (get_field($field_img) !== '') : 
		$image = get_field($field_img);	
		if ( ! empty( $image ) ) : ?>
			<img class="wrimg__cover" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<?php endif; ?>
	<?php endif; 
}
?>
<dl class="row mt-2">
	<?php $city = get_post( $post->post_parent ); ?>
	<dt class="col-sm-3"><?php _e('Город:'); ?></dt>
	<dd class="col-sm-9"><?php echo $city->post_title; ?></dd>
	<dt class="col-sm-3"><?php _e('Общая площадь:'); ?></dt>
	<dd class="col-sm-9"><?php the_field('ploshhad'); ?> <?php _e('кв.м');?></dd>
	<dt class="col-sm-3"><?php _e('Цена:'); ?></dt>
	<dd class="col-sm-9"><?php the_field('stoimost'); ?> <?php _e('руб.');?></dd>
	<dt class="col-sm-3"><?php _e('Адрес:'); ?></dt>
	<dd class="col-sm-9"><?php the_field('adres'); ?></dd>
	<dt class="col-sm-3"><?php _e('Жилая площадь:'); ?></dt>
	<dd class="col-sm-9"><?php the_field('zhilaya_ploshhad'); ?> <?php _e('кв.м');?></dd>
	<dt class="col-sm-3"><?php _e('Этаж:'); ?></dt>
	<dd class="col-sm-9"><?php the_field('etazh'); ?><?php _e('-й');?></dd>
</dl>
<div class="c-text"><?php the_content(); ?></div>