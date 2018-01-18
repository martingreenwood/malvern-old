<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package malvern
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container">
			<div class="row">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>

			</div>

			<div class="row">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-3',
						'menu_id'        => 'course-menu',
					) );
				?>
			</div>
		</main>
	</div>

	<?php get_template_part( 'template-parts/get', 'tweets' ); ?>

	<?php get_template_part( 'template-parts/get', 'quicklink' ); ?>

<?php
get_footer();
