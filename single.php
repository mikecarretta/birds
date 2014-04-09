<?php
/**
 * The Template for displaying all single posts.
 *
 * @package birds
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div id="primary" class="container">
		<div class="row">
	  	<div class="col-md-9">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php birds_post_nav(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</div>
			<div class="col-md-3">

				<?php get_sidebar(); ?>

			</div>
		</div>
	</div><!-- #primary -->
</main><!-- #main -->

<?php get_footer(); ?>