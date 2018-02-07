<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package malvern
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function malvern_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'malvern_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function malvern_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'malvern_pingback_header' );



//This file only unsets the errors
//You'll still need to override the app/views/checkout/form.php file to remove the password fields HTML
//You can find instructions on overriding template files here: https://www.memberpress.com/1.1.7
function unset_password_validation_errors($errors) {
	if(empty($errors)) { return $errors; } //Should never happen if the password fields are hidden
	//Unset the password field errors
	foreach($errors as $i => $v) {
		if($v == 'You must enter a Password.') {
			unset($errors[$i]);
		}
		if($v == 'You must enter a Password Confirmation.') {
			unset($errors[$i]);
		}
		if(stripslashes($v) == "Your Password and Password Confirmation don't match.") {
			unset($errors[$i]);
		}
	}
	//Artificially set a password here
	$_POST['mepr_user_password'] = uniqid(); //Deprecated?
	$_REQUEST['mepr_user_password'] = uniqid();
	return $errors;
}
add_filter('mepr-validate-signup', 'unset_password_validation_errors');


/* Require Authentication for Intranet */

function my_force_login() {
	global $post;

	if (!is_user_logged_in()) {
		auth_redirect();
	}
} 



//ADD A SUPPORT TAB TO THE NAV MENU
function mepr_add_some_tabs($user) {
  $support_active = (isset($_GET['action']) && $_GET['action'] == 'personal-information')?'mepr-active-nav-tab':'';
  ?>
    <span class="mepr-nav-item personal-information <?php echo $support_active; ?>">
      <a href="<?php echo home_url( '/' ); ?>account/?action=personal-information">Personal Information</a>
    </span>
  <?php
}
add_action('mepr_account_nav', 'mepr_add_some_tabs');

//YOU CAN DELETE EVERYTHING BELOW THIS LINE -- IF YOU PLAN TO REDIRECT
//THE USER TO A DIFFERENT PAGE INSTEAD OF KEEPING THEM ON THE SAME PAGE
//ADD THE CONTENT FOR THE NEW SUPPORT TAB ABOVE
function mepr_add_tabs_content($action) {
  if($action == 'personal-information'): //Update this 'premium-support' to match what you put above (?action=premium-support)
  ?>
    <div id="personal-information-form">
      <?php do_shortcode( '[gravityform id="6" title="false" description="false" ajax="true"]' ); ?>
    </div>
  <?php
  endif;
}
add_action('mepr_account_nav_content', 'mepr_add_tabs_content');