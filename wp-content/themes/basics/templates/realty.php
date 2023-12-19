<?php
/**
 * This part of realty
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="col">
	<div class="card mb-3" style="width: 300px;">
		<?php if (has_post_thumbnail()) : ?>
			<?php the_post_thumbnail( 'medium', 'class=card-img-top wrimg__cover'); ?>
		<?php elseif (get_field('photo_realty') !== '') : ?>
			<?php
				$image = get_field('photo_realty');	
				if ( ! empty( $image ) ) : ?>
					<img class="wrimg__cover" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
		<?php endif; ?>
		<div class="card-body">
			<h5><?php the_title(); ?></h5>
			<dl class="row">
				<?php $city = get_post( $post->post_parent ); ?>
				<dt class="col-sm-5"><?php _e('Город:'); ?></dt>
				<dd class="col-sm-7"><?php echo $city->post_title; ?></dd>
				<dt class="col-sm-7"><?php _e('Общая площадь:'); ?></dt>
				<dd class="col-sm-5"><?php the_field('ploshhad'); ?> <?php _e('кв.м');?></dd>
				<dt class="col-sm-5"><?php _e('Цена:'); ?></dt>
				<dd class="col-sm-7"><?php the_field('stoimost'); ?> <?php _e('руб.');?></dd>
			</dl>
			<p class="card-text"><?php the_excerpt(); ?></p>
		</div>
	</div>
</div>