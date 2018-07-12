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

			<div class="signmeup">
				<a href="#" title="">Close</a>
				<div class="wrapper">
					<div class="table">
						<div class="cell">
							<h3>Sign up for news &amp; Updates</h3>
							<!-- Begin MailChimp Signup Form -->
							<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
							<div id="mc_embed_signup">
								<form action="https://charliewinston.us4.list-manage.com/subscribe/post?u=ded4b2c3aa668046861f32698&amp;id=acd2eb22e5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
									<div id="mc_embed_signup_scroll">

										<div id="mce-responses" class="clear">
											<div class="response" id="mce-error-response" style="display:none"></div>
											<div class="response" id="mce-success-response" style="display:none"></div>
										</div>

										<div class="mc-field-group">
											<input type="text" value="" placeholder="First Name" name="FNAME" class="required" id="mce-FNAME">
										</div>
										<div class="mc-field-group">
											<input type="text" value="" placeholder="Last Name" name="LNAME" class="required" id="mce-LNAME">
										</div>
										<div class="mc-field-group">
											<input type="email" value="" placeholder="Email Address" name="EMAIL" class="required email" id="mce-EMAIL">
										</div>
										
										<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ded4b2c3aa668046861f32698_acd2eb22e5" tabindex="-1" value=""></div>

										<div class="clear">
											<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
										</div>
									</div>
								</form>
							</div>
							<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='dropdown';fnames[4]='SOURCE';ftypes[4]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
							<!--End mc_embed_signup-->
						</div>
					</div>
				</div>
			</div>
			<script>
				function explode(){
					jQuery('.signmeup').addClass('display');
				}
				jQuery('.close').on('click', function(event) {
					event.preventDefault();
					jQuery('.signmeup').removeClass('display');
				});
				setTimeout(explode, 230000);
			</script>
		</main>
	</div>

	<?php get_template_part( 'template-parts/get', 'tweets' ); ?>

	<?php get_template_part( 'template-parts/get', 'quicklink' ); ?>

<?php
get_footer();
