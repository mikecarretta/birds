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
				<div class="col-md-12">
					<header class="page-header">
						<h1 class="page-header">
                <?php printf(get_search_query()); ?> <span class="label label-info">
                  <?php _e( 'Search Results', 'birds' ); ?></span>
              </h1>
					</header><!-- .page-header -->
				</div>
			</div>
		</div>

		<div id="primary" class="container">
			<div class="row">
		  	<div class="col-md-9">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>
					</div>

					<div class="col-md-3">
						<?php get_sidebar(); ?>
					</div>

					<div class="row">
		        <div class="col-md-12">
		          <?php if (function_exists('wp_pagenavi') ) {
			              	wp_pagenavi();
			              } else {
			                birds_paging_nav();
			              }
			        ?>
		        </div>
		      </div>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				</div>

			</div>
		</div><!-- #primary -->

	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>
