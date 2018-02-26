<?php
/**
 * The account pages
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
				<h1>Downloads</h1>
			</div>
			<?php endif ?>

			<div class="accinfo container">
				<div class="row">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

				endwhile; // End of the loop.
				?>
				</div>
			</div>

			<div class="sections">
				<div class="container">
					<div class="row">
						<div id="member-assets-form">

							<?php 
							$args = array(
								'numberposts'	=> -1,
								'post_type'		=> 'downloads',
								'meta_key'		=> 'field_role_lock',
								'meta_value'	=> 'Conductor'
							);
							$loop = new WP_Query($args); 
							
							if ($loop->have_posts()):
								while ( $loop->have_posts() ) : $loop->the_post(); ?>
								
								<!-- <h3 style="margin: 20px 0;"><?php the_title(); ?></h3> -->
								<div class="index">
									<?php
									if( have_rows('files') ):
										while ( have_rows('files') ) : the_row();
											$file = get_sub_field( 'file' );
										?>
										<dl>
											<dt>
												<?php the_sub_field( 'name' ); ?> (<span><?php the_field( 'role_lock' ); ?></span>)
											</dt>
											<dd>
												<a href="<?php $file['url'] ?>" target="_blank">
													<i class="fas fa-download"></i> Download File
												</a>
											</dd>
										</dl>
										<?php
										endwhile;
									endif;
									?>
								</div>
								<?php endwhile; ?>
							<?php else: ?>
							<div class="index">
								<dl>
									<dt>
										No Downloads Available.
									</dt>
									<dd>
										&nbsp;
									</dd>
								</dl>
							</div>
							<?php endif; wp_reset_query(); ?>

						</div>
					</div>
				</div>
			</div>

		</main>
	</div>

<?php
get_footer();
