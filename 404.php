<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package malvern
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="container maincopy">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">

				</div>

				</article>
			</div>

		</main>
	</div>

<?php
get_footer();
