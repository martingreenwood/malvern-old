<?php
/**
 * The our team page tempate
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package malvern
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php if (have_posts()): ?>
			<div class="container maincopy">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			</div>
			<?php endif ?>

			<div class="sections">
				<div class="container">
				<?php
				$args = array( 
					'post_type' => 'team', 
					'posts_per_page' => -1,
					'team_type'  => 'base'
				);
				$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					?>

					<?php if ($loop->current_post % 2 == 0): ?>
					<div class="row">
						<div class="element columns eight whois">
							<div class="avatar"><?php the_post_thumbnail( 'full' ) ?></div>
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field( 'position' ); ?></h3>
							<?php the_content(); ?>
						</div>
						<div class="element columns four image">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
					</div>
					<?php else: ?>
					<div class="row">
						<div class="element columns four image">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
						<div class="element columns eight whois">
							<div class="avatar"><?php the_post_thumbnail( 'full' ) ?></div>
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field( 'position' ); ?></h3>
							<?php the_content(); ?>
						</div>
					</div>
					<?php endif ?>
					
					<?php
					// end while has team
					endwhile;
				wp_reset_query();
				?>
				</div>
			</div>

			<div class="sections support-staff">
				<div class="container">
					<div class="maincopy">
						<?php the_field( 'support_content' ); ?>
					</div>
				<?php
				$args = array( 
					'post_type' => 'team', 
					'posts_per_page' => -1,
					'team_type'  => 'support'
				);
				$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					?>

					<?php if ($loop->current_post % 2 == 0): ?>
					<div class="row">
						<div class="element columns eight whois">
							<div class="avatar"><?php the_post_thumbnail( 'full' ) ?></div>
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field( 'position' ); ?></h3>
							<?php the_content(); ?>
						</div>
						<div class="element columns four image">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
					</div>
					<?php else: ?>
					<div class="row">
						<div class="element columns four image">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
						<div class="element columns eight whois">
							<div class="avatar"><?php the_post_thumbnail( 'full' ) ?></div>
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field( 'position' ); ?></h3>
							<?php the_content(); ?>
						</div>
					</div>
					<?php endif ?>

					<?php
					// end while has team
					endwhile;
				wp_reset_query();
				?>
				</div>
			</div>
			
			<div class="sections additional-support">
				<div class="container">
					<div class="maincopy">
						<?php the_field( 'additional_support_content' ); ?>
					</div>
				<?php
				$args = array( 
					'post_type' => 'team', 
					'posts_per_page' => -1,
					'team_type'  => 'additional-support'
				);
				$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					?>

					<?php if ($loop->current_post % 2 == 0): ?>
					<div class="row">
						<div class="element columns eight whois">
							<div class="avatar"><?php the_post_thumbnail( 'full' ) ?></div>
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field( 'position' ); ?></h3>
							<?php the_content(); ?>
						</div>
						<div class="element columns four image">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
					</div>
					<?php else: ?>
					<div class="row">
						<div class="element columns four image">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
						<div class="element columns eight whois">
							<div class="avatar"><?php the_post_thumbnail( 'full' ) ?></div>
							<h2><?php the_title(); ?></h2>
							<h3><?php the_field( 'position' ); ?></h3>
							<?php the_content(); ?>
						</div>
					</div>
					<?php endif ?>

					<?php
					// end while has team
					endwhile;
				wp_reset_query();
				?>
				</div>
			</div>

		</main>
	</div>

<?php
get_footer();
