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


// Snippet from PHP Share: http://www.phpshare.org

function filesize_formatted($path)
{
    $size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
}


//ADD A SUPPORT TAB TO THE NAV MENU
function mepr_mydetails_tab($user) {
	$support_active = (isset($_GET['action']) && $_GET['action'] == 'my-details')?'mepr-active-nav-tab':'';
	?>
	<span class="mepr-nav-item my-details <?php echo $support_active; ?>">
		<a href="<?php echo home_url( '/' ); ?>account/?action=my-details">My Details</a>
	</span>
	<?php
}
add_action('mepr_account_nav', 'mepr_mydetails_tab');

//ADD A SUPPORT TAB TO THE NAV MENU
function mepr_studentdetails_tab($user) {
	$support_active = (isset($_GET['action']) && $_GET['action'] == 'student-details')?'mepr-active-nav-tab':'';
	?>
	<span class="mepr-nav-item student-details <?php echo $support_active; ?>">
		<a href="<?php echo home_url( '/' ); ?>account/?action=student-details">Student Details</a>
	</span>
	<?php
}
add_action('mepr_account_nav', 'mepr_studentdetails_tab');

//ADD A SUPPORT TAB TO THE NAV MENU
function mepr_add_personalinformation_tab($user) {
	$support_active = (isset($_GET['action']) && $_GET['action'] == 'personal-information')?'mepr-active-nav-tab':'';
	?>
	<span class="mepr-nav-item personal-information <?php echo $support_active; ?>">
		<a href="<?php echo home_url( '/' ); ?>account/?action=personal-information">Personal Information</a>
	</span>
	<?php
}
add_action('mepr_account_nav', 'mepr_add_personalinformation_tab');

//ADD A SUPPORT TAB TO THE NAV MENU
function mepr_add_memberassets_tab($user) {
	$support_active = (isset($_GET['action']) && $_GET['action'] == 'member-assets')?'mepr-active-nav-tab':'';
	?>
	<span class="mepr-nav-item member-assets <?php echo $support_active; ?>">
		<a href="<?php echo home_url( '/' ); ?>account/?action=member-assets">Downloads</a>
	</span>
	<?php
}
add_action('mepr_account_nav', 'mepr_add_memberassets_tab');

//ADD A SUPPORT TAB TO THE NAV MENU
function mepr_add_memberimg_tab($user) {
	$support_active = (isset($_GET['action']) && $_GET['action'] == 'member-img')?'mepr-active-nav-tab':'';
	?>
	<span class="mepr-nav-item member-img <?php echo $support_active; ?>">
		<a href="<?php echo home_url( '/' ); ?>account/?action=member-img">My Picture</a>
	</span>
	<?php
}
add_action('mepr_account_nav', 'mepr_add_memberimg_tab');

//YOU CAN DELETE EVERYTHING BELOW THIS LINE -- IF YOU PLAN TO REDIRECT
//THE USER TO A DIFFERENT PAGE INSTEAD OF KEEPING THEM ON THE SAME PAGE
//ADD THE CONTENT FOR THE NEW SUPPORT TAB ABOVE
function mepr_add_img_tab_content($action) {
	if($action == 'member-img'): //Update this 'premium-support' to match what you put above (?action=premium-support)
	?>
	<div id="member-img-form">
		<?php echo do_shortcode( '[avatar_upload]' ); ?>
	</div>
	<?php
	endif;
}
add_action('mepr_account_nav_content', 'mepr_add_img_tab_content');

function mepr_mydetails_content($action) {
	if($action == 'my-details'): //Update this 'premium-support' to match what you put above (?action=premium-support)
	?>
	<div id="my-details">
		<?php echo do_shortcode( '[gravityview id="790"]' ); ?>
	</div>
	<?php
	endif;
}
add_action('mepr_account_nav_content', 'mepr_mydetails_content');

function mepr_studentdetails_content($action) {
	if($action == 'student-details'): //Update this 'premium-support' to match what you put above (?action=premium-support)
	?>
	<div id="student-details">
		<?php echo do_shortcode( '[gravityview id="806"]' ); ?>
	</div>
	<?php
	endif;
}
add_action('mepr_account_nav_content', 'mepr_studentdetails_content');

function mepr_add_personalinformation_tab_content($action) {
	if($action == 'personal-information'): //Update this 'premium-support' to match what you put above (?action=premium-support)
	?>
	<div id="personal-information-form">

		<?php echo do_shortcode( '[gravityview id="803"]' ); ?>

		<div class="btnhlder">
			<a class="button" href="#newpif">New Personal Information Form</a>
		</div>
		<div id="newpif" style="display: none;">
			<?php echo do_shortcode( '[gravityform id="6" title="false" description="false" ajax="true"]' ); ?>
		</div>


	</div>
	<?php
	endif;
}
add_action('mepr_account_nav_content', 'mepr_add_personalinformation_tab_content');

function mepr_add_memberassets_tab_content($action) {
	if($action == 'member-assets'): //Update this 'premium-support' to match what you put above (?action=premium-support)
	?>
	<div id="member-assets-form">

		<?php 
			$user_info = get_userdata(get_current_user_id()); 
			$user_roles = current($user_info->roles);
		?>

		<?php 
		$args = array(
			'numberposts'	=> -1,
			'post_type'		=> 'downloads',
		);
		$loop = new WP_Query($args); 
		
		if ($loop->have_posts()):
		while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php 
			$role_lock = get_field( 'role_lock' ); 
			$role_lock = current($role_lock);
		?>
		
		<?php if ($role_lock == $user_roles): ?>
		<div class="index">
			<?php
			if( have_rows('files') ):
				while ( have_rows('files') ) : the_row();
					$file = get_sub_field( 'file' );
				?>
				<dl>
					<dt>
						<?php the_sub_field( 'name' ); ?>
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
		<?php endif; ?>
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
	<?php
	endif;
}
add_action('mepr_account_nav_content', 'mepr_add_memberassets_tab_content');


function custom_menu_page_removing() {
	global $current_user;
	wp_get_current_user();

	$email = (string) $current_user->user_email;
	$emailDomain = explode('@', $email);
	$emailDomain = $emailDomain[1];

	if ($emailDomain !== 'wearebeard.com') {
		remove_menu_page( 'themes.php' );                 //Appearance
		remove_menu_page( 'plugins.php' );                //Plugins
		remove_menu_page( 'tools.php' );                  //Tools
		remove_menu_page( 'options-general.php' );                  //Tools
		remove_menu_page( 'edit.php?post_type=acf-field-group' );                  //Tools
		remove_menu_page( 'users.php' );                  //Tools
	}
}
add_action( 'admin_menu', 'custom_menu_page_removing' );


add_action( 'gform_user_registered', 'vc_gf_registration_autologin',  10, 4 );
function vc_gf_registration_autologin( $user_id, $user_config, $entry, $password ) {
	$user = get_userdata( $user_id );
	$user_login = $user->user_login;
	$user_password = $password;

    wp_signon( array(
		'user_login' => $user_login,
		'user_password' =>  $user_password,
		'remember' => false

    ) );
}