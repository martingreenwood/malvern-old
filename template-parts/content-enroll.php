	<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package malvern
 */

?>

<?php if (isset($_GET['signup'])): ?>
<script type="text/javascript">
	(function($){
		swal("Thank you for registering.", "Please complete the NSSO course application form.", "success");
	})(jQuery);
</script>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php //the_content(  ); ?>

		<?php
			$depsit_start_str = "31 august this year";
			$depsit_start_date = strtotime($depsit_start_str);

			$depsit_end_str = "31 may next year"; //next year
			$depsit_end_date = strtotime($depsit_end_str);

			$final_payment_start_str = "1 june next year"; // mnext year
			$final_payment_start_date = strtotime($final_payment_start_str);
			
			$final_payment_end_str = "10 july next year"; // next year
			$final_payment_end_date = strtotime($final_payment_end_str);

			$todays_date = strtotime(now);
			if ($_GET['date']) {
				$todays_date = strtotime($_GET['date']);
			} else {
				$todays_date = strtotime(now);
			}

			if (($todays_date >= $depsit_start_date) && ($todays_date <= $depsit_end_date)) 
			{
				?>

				<h1><?php the_field( 'deposit_title' ); ?></h1>
				<p><?php the_field( 'deposit_copy' ); ?></p>

				<?php echo do_shortcode( '[gravityform id="4" title="false" description="false" ajax="true"]' ); ?>

				<?php
			} 
			else if (($todays_date >= $final_payment_start_date) && ($todays_date <= $final_payment_end_date)) 
			{
				?>

				<h1><?php the_field( 'final_title_copy' ); ?></h1>
				<p><?php the_field( 'final_copy' ); ?></p>

				<?php echo do_shortcode( '[gravityform id="9" title="false" description="false" ajax="true"]' ); ?>

				<?php
			
			} else { ?>
				
				<h1><?php the_field( 'closed_title_copy' ); ?></h1>
				<p><?php the_field( 'closed_copy' ); ?></p>

			<?php 
			}
		?>

	</div>

</article>
