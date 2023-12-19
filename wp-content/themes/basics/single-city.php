<?php
/**
 * The template for displaying all single of city
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php
			// Do the left sidebar check and open div#primary.
			get_template_part( 'global-templates/left-sidebar-check' );
			?>

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post(); ?>
					<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

						<header class="entry-header">

							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							<div class="entry-meta">

								<?php understrap_posted_on(); ?>

							</div><!-- .entry-meta -->

						</header><!-- .entry-header -->

						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

						<div class="entry-content">

							<?php
							the_content();
							understrap_link_pages();
							?>

						</div><!-- .entry-content -->

						<footer class="entry-footer">

							<?php understrap_entry_footer(); ?>

						</footer><!-- .entry-footer -->

					</article><!-- #post-<?php the_ID(); ?> -->
					<?php 
						$parent_city = get_the_ID();

						wp_reset_postdata();

						$args = array( 
									'post_type' => 'realty',
									'posts_per_page' => 10,
									'orderby' => 'date',
									'order'   => 'DESC',
									'post_parent' => $parent_city
									);
						$query2 = new WP_Query( $args );

						// Цикл
						if ( $query2->have_posts() ) : ?>
							<div class="row">
								<?php while ( $query2->have_posts() ) : $query2->the_post(); ?>
									<?php get_template_part( 'templates/realty' ); ?>
								<?php endwhile; ?>
							</div>
						<?php else :
							_e('Недвижимости нет');
						endif;

						// Возвращаем оригинальные данные поста. Сбрасываем $post.
						wp_reset_postdata();
					
					?>
				<?php // If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
				?>

			</main>

			<?php
			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();