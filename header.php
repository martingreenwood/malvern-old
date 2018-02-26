<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package malvern
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class($pagename); ?>>
<div id="page" class="site">

	<div id="loader">
		<div id="loading">
			<div id="progstat"></div>
			<div id="progress"></div>
		</div>
	</div>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">

				<div class="site-branding">
					<div class="logo desktop">
						<?php $logo = get_field( 'logo', 'options' ); ?>
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo['url']; ?>" alt="">
						</a>
					</div>
					<div class="logo small">
						<?php $logo_sticky_mobile = get_field( 'logo_sticky_mobile', 'options' ); ?>
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo_sticky_mobile['url']; ?>" alt="">
						</a>
					</div>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<button class="hamburger menu-toggle hamburger--spin" type="button" aria-controls="primary-menu" aria-expanded="false">
						<span class="hamburger-box ">
							<span class="hamburger-inner"></span>
						</span>
					</button>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>
				</nav>
			
			</div>
		</div>
	</header>

	<?php $bannerimage = get_field( 'banner_image' ); if (!$bannerimage): $bannerimage = get_template_directory_uri() . '/assets/img/inner-bg.jpg'; else: $bannerimage = $bannerimage['url']; endif; ?>
	<section id="banner" class="parallax-window" data-parallax="scroll" data-bleed="50" data-image-src="<?php echo $bannerimage; ?>">
		<div class="blurb">
			<div class="before">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/top-strip.png" alt="">
			</div>
			<div class="table">
				<div class="cell middle">

				<?php if (is_page(get_option( 'page_for_posts' ))): ?>
					

					<?php if (get_field( 'banner_text', get_option( 'page_for_posts' ) )): ?>
					<h2><?php the_field( 'banner_text', get_option( 'page_for_posts' ) ); ?></h2>
					<?php endif; ?>
					<?php if (get_field( 'banner_link', get_option( 'page_for_posts' ) )): ?>
					<a href="<?php the_field( 'banner_link', get_option( 'page_for_posts' ) ); ?>" title="Find out more">Find out more</a>
					<?php endif; ?>

				<?php elseif (is_page( 'account' )): ?>
					

					<?php
					  if ( has_wp_user_avatar(get_current_user_id()) ) {
					    echo get_wp_user_avatar(get_current_user_id(), 96);
					  }
					?>

					<?php $user_info = get_userdata(get_current_user_id()); ?>
					<h1><?php echo $user_info->first_name .  " " . $user_info->last_name; ?></h1>
					<?php if (get_field( 'banner_text' )): ?>
					<h2><?php the_field( 'banner_text' ); ?></h2>
					<?php endif; ?>

				<?php else: ?>

					<?php if (get_field( 'banner_text' )): ?>
					<h2><?php the_field( 'banner_text' ); ?></h2>
					<?php endif; ?>
					<?php if (get_field( 'banner_link' )): ?>
					<a href="<?php the_field( 'banner_link' ); ?>" title="Find out more">Find out more</a>
					<?php endif; ?>

				<?php endif ?>
					
				</div>
			</div>
			<div class="after">
			<?php if (is_front_page()): ?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bottom-strip-home.png" alt="">
			<?php else: ?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bottom-strip.png" alt="">
			<?php endif; ?>
			</div>
		</div>
	</section>

	<div id="content" class="site-content">
