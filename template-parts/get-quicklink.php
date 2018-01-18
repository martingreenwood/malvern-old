
<section id="quicklink">
	<div class="container">
		<div class="row">

		<?php if( have_rows('quick_links_nav', 'options') ): ?>

			<ul class="links">

			<?php while( have_rows('quick_links_nav', 'options') ): the_row(); 

				// vars
				$image = get_sub_field('icon');
				$name = get_sub_field('name');
				$link = get_sub_field('link');

				?>

				<li class="link">

					<?php if( $link ): ?>
					<a href="<?php echo $link; ?>">
					<?php endif; ?>

						<div class="icon" style="background-image: url(<?php echo $image; ?>);"></div>
						<h3><?php echo $name ?></h3>
						<span class="outline">Find Out More</span>


					<?php if( $link ): ?>
					</a>
					<?php endif; ?>

				</li>

			<?php endwhile; ?>

			</ul>

		<?php endif; ?>

		</div>
	</div>
</section>