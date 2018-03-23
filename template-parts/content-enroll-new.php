<?php
/**
 * Template part for displaying enroll logic
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package malvern
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
			
		<div class="logmein">
			<h3>Existing Account Holder?</h3>
			<p>If you are an exsiting account holder, please login to enroll your child/chiddren.</p>
			<?php if ($_GET['login'] === 'failed'): ?>
				<h3 class="error">Sorry, there seems to be an issue with your username/password. Please try again.</h3>
			<?php endif; ?>
			<div class="linform">
			<?php
			$args = array(
				'echo'           => true,
				'remember'       => false,
				'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
				'form_id'        => 'loginform',
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_submit'      => 'wp-submit',
				'label_username' => __( 'Email Address' ),
				'label_password' => __( 'Password' ),
				'label_log_in'   => __( 'Log In' ),
				'value_username' => '',
				'value_remember' => false
			);
			wp_login_form( $args );
			?>
			</div>
		</div>

		<div class="new-stu">
			<h3>Need an Account?</h3>
			<p>Please follow the link below to create a new account.</p>
			<a href="<?php echo home_url( '/new-account' ); ?>" title="">Register Here</a>
		</div>
	</div>

</article>
