<?php
/**
 * new studnet
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package malvern
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php 
			if ( is_user_logged_in() ):
			?>

				<?php if (have_posts()): ?>
				<div class="container maincopy">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'enroll-new' );

				endwhile; // End of the loop.
				?>
				</div>
				<?php endif ?>

			<?php
			//user is logged in, put your regular codes
			else:
			
				get_template_part ( 'content', 'login' );
			
			endif;
			?>

		</main>
	</div>

<?php
get_footer();
