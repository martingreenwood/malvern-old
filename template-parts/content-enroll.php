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
		swal("Thank you for registering.", "Please complete the NSSO application form to enrol your instrumentalist(s).", "success");
	})(jQuery);
</script>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content(  ); ?>
	</div>

</article>
