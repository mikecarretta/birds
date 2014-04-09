<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package birds
 */

get_header(); ?>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div id="primary" class="container">
			<div class="row">
		  	<div class="col-md-9">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'birds' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>

					<div class="row">
		        <div class="col-md-12">
		          <?php birds_post_nav(); ?>
		        </div>
		      </div>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</div>
				<div class="col-md-3">

					<?php get_sidebar(); ?>

				</div>
			</div>
		</div><!-- #primary -->

	</main><!-- #main -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
