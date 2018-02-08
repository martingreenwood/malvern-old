<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package malvern
 */

?>

	</div><!-- #content -->

	<section id="prefooter">

		<div class="container">
			<div class="row">

				<div class="four columns company-info">
					
					<?php the_custom_logo(); ?>

					<?php the_field( 'company_info', 'options' ); ?>

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
							<?php if (get_field( 'flickr', 'options' )): ?>
							<li><a href="<?php echo get_field( 'flickr', 'options' ); ?>" title="Follow us on Flickr"><i class="fab fa-flickr"></i></a></li>
							<?php endif; ?>
						</ul>
					</div>
					
				</div>

				<div class="eight columns latest-news">
					<h2>Latest News</h2>
					
					<div class="stories">
						
						<?php
						$args = array( 
							'post_type' => 'post', 
							'posts_per_page' => 3,
						);
						$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
							?>
							
							<div class="story">
								<h4><a href="<?php the_permalink( $post ); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> <small><?php echo get_the_date(); ?></small></h4>
								<p><?php the_excerpt(); ?></p>
							</div>

							<?php
							// end while has team
							endwhile;
						wp_reset_query();
						?>
						
					</div>
				</div>

			</div>
		</div>
		
	</section>

	<footer id="colophon" class="site-footer">
		
		<div class="container">
			<div class="row">

				<div class="copyright five columns">
					<p>2010 — <?php echo date("Y"); ?> <?php echo bloginfo( 'name' ); ?></p>
					<p><?php echo bloginfo( 'name' ); ?> (NSSO) is operated<br>
					by Malvern College, registered charity no 527528</p>
				</div>

				<div class="footer-nav seven columns">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'footer-menu',
						) );
					?>
				</div>
				
			</div>
		</div>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
