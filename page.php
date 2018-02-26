<?php
/**
 * The hpmpage template file (static not dynamic)
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

			<?php
			// rows
			if( have_rows('page_builder') ):
			?>
			<div class="sections">
				<div class="container">
				<?php
				while ( have_rows('page_builder') ) : the_row();
				?>
					<div class="row">
					<?php
						// items
						if( have_rows('element') ):
							while ( have_rows('element') ) : the_row();
								$element_width = get_sub_field( 'element_width' );
								?>
								<div class="element columns <?php echo $element_width ?>">

									<?php
									if( have_rows('item') ):
										while ( have_rows('item') ) : the_row();

											if( get_row_layout() == 'image' ):

												$file = get_sub_field('image');

												?>
												<img src="<?php echo $file['url'] ?>" alt="">
												<?php

											elseif( get_row_layout() == 'text' ): 

												?>
												<div class="text">
													<div class="table">
														<div class="cell middle">
															<?php the_sub_field('text'); ?>	
														</div>
													</div>
												</div>
												<?php
											
											elseif( get_row_layout() == 'link' ): 

												?>
												<div class="text">
													<a class="link" href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('link_text'); ?>"><?php the_sub_field('link_text'); ?></a>
												</div>
												<?php
											
											elseif( get_row_layout() == 'file' ): 

												?>
												<div class="text">
													<?php $file = get_sub_field( 'file' ); ?>
													<a class="link" href="<?php echo $file['url']; ?>" title="<?php the_sub_field('link_text'); ?>"><?php the_sub_field('link_text'); ?></a>
												</div>
												<?php
											
											elseif( get_row_layout() == 'social_icons_block' ): 

												?>
												<div class="text">
													<div class="sociallinks">
														<ul>
															<?php if (get_field( 'facebook', 'options' )): ?>
															<li><a href="<?php echo get_field( 'facebook', 'options' ); ?>" title="Follow us on Facebook"><i class="fab fa-facebook-f"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'twitter', 'options' )): ?>
															<li><a href="<?php echo get_field( 'twitter', 'options' ); ?>" title="Follow us on Twitter"><i class="fab fa-twitter"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'youtube', 'options' )): ?>
															<li><a href="<?php echo get_field( 'youtube', 'options' ); ?>" title="Follow us on YouTube"><i class="fab fa-youtube"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'google', 'options' )): ?>
															<li><a href="<?php echo get_field( 'google', 'options' ); ?>" title="Follow us on google plus"><i class="fab fa-google-plus-g"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'blogger', 'options' )): ?>
															<li><a href="<?php echo get_field( 'blogger', 'options' ); ?>" title="Follow us on blogger"><i class="fab fa-blogger"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'flickr', 'options' )): ?>
															<li><a href="<?php echo get_field( 'flickr', 'options' ); ?>" title="Follow us on Flickr"><i class="fab fa-flickr"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'linkedin', 'options' )): ?>
															<li><a href="<?php echo get_field( 'linkedin', 'options' ); ?>" title="Follow us on linkedin"><i class="fab fa-linkedin-in"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'vimeo', 'options' )): ?>
															<li><a href="<?php echo get_field( 'vimeo', 'options' ); ?>" title="Follow us on vimeo"><i class="fab fa-vimeo-v"></i></a></li>
															<?php endif; ?>
															<?php if (get_field( 'instagram', 'options' )): ?>
															<li><a href="<?php echo get_field( 'instagram', 'options' ); ?>" title="Follow us on instagram"><i class="fab fa-instagram"></i></a></li>
															<?php endif; ?>
														</ul>
													</div>
												</div>
												<?php

											elseif( get_row_layout() == 'map' ): 

												$location = get_sub_field('map');
												if( !empty($location) ):
												?>
												<div class="map">
													<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
												</div>
												<?php 
												endif; 

											endif;

										endwhile;
									endif;
									?>

								</div>
								<?php
							// end while for items
							endwhile;
						endif;

					?>
					</div>
					<?php
					// end while for rows
					endwhile;
				?>
				</div>
			</div>
			<?php
			endif;
			?>

		</main>
	</div>

<?php
get_footer();
