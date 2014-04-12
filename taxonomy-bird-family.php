<?php
/**
 * @package birds
 */
?>
<?php get_header(); ?>

<main id="main" class="birds-main" role="main">
  <div id="primary" class="container">
    <div class="row">
      <div class="col-md-12">
        <article id="post-<?php the_ID(); ?>">
          <section class="post_content birds" itemprop="articleBody">

            <header>
              <h1 class="page-header">
                <?php single_tag_title(); ?> <span class="label label-info">
                  <?php _e( 'Bird Family', 'birds' ); ?></span>
              </h1>
            </header>

            <ul class="list img-list">

            <?php
            $thumb = 'birds-sm';
            if ( !is_tax() ) {
              // WP 3.0 PAGED BUG FIX
              if ( get_query_var( 'paged' ) )
                $paged = get_query_var( 'paged' );
              elseif ( get_query_var( 'page' ) )
                $paged = get_query_var( 'page' );
              else
                $paged = 1;

              $args = array( 'post_type' => 'birds',
                'posts_per_page' => 18,
                'orderby' => 'name',
                'order' => 'ASC',
                'paged' => $paged );
              query_posts( $args );
            }
            ?>
            <?php  if ( have_posts() ) : $count = 0; while ( have_posts() ) : the_post(); $count++; global $post; ?>

              <li id="post-<?php the_ID(); ?>">

                <a href="<?php the_permalink() ?>" class="inner" title="<?php the_title_attribute(); ?>">
                  <figure class="inner-img">
                    <?php the_post_thumbnail( $thumb ); ?>
                  </figure>

                  <div class="li-text">
                    <h3><?php the_title() ?></h3>
                  </div>
                </a>
              </li>

              <?php endwhile; ?>

              </ul>

              <?php else: ?>

              <h2 class="title"><?php _e( 'Sorry, no posts matched your criteria.', 'bird-portfolio' ) ?></h2>

              <?php endif; ?>

              <div class="row">
                <div class="col-md-12">
                  <?php if (function_exists('wp_pagenavi') ) {
                    wp_pagenavi();
                  } else {
                    birds_paging_nav();
                  } ?>
                </div>
              </div>

          </section>
        </article>

        </div>
    </div>
  </div><!-- #primary -->
</main><!-- #main -->

<?php wp_reset_query(); ?>

<?php get_footer(); ?>
