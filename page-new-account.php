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

			<?php if (have_posts()): ?>
			<div class="container maincopy left">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'enroll' );

			endwhile; // End of the loop.
			?>
			</div>
			<?php endif ?>

		</main>
	</div>

<?php
get_footer();
