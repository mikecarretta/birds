<?php
/**
 * The Template for displaying all single posts.
 *
 * @package birds
 */
?>
<?php
get_header();

$largePhoto = 'birds-lg';
?>

<main id="main" class="site-main" role="main">
  <div id="primary" class="container">
    <div class="row">
      <div class="col-md-12">

      <?php while ( have_posts() ) : the_post(); ?>

        <header>
          <h1 class="page-header"><?php the_title(); ?></h1>
        </header>

        <?php the_post_thumbnail( $largePhoto ); ?>

      </div>

      <div class="col-md-6 widgets">
        <h3 >Overview</h3>

        <?php the_content(); ?>

        <?php edit_post_link( __( 'Edit Bird', 'birds' ), '<p class="edit">', '</p>' ); ?>
      </div>

      <div class="col-md-3 widgets">
        <h3>Portfolio Meta Data</h3>
        <div class="entry-meta-custom">
          <?php if (get_the_term_list( $post->ID, 'portfolio_category' ) != null ) : ?>
            <div>Category: <?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ); ?></div>
            <?php endif; ?>

            <?php if (get_the_term_list( $post->ID, 'portfolio_tag' ) != null ) : ?>
            <div>Portfolio Tags: <?php echo get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' ); ?></div>
            <?php endif; ?>

        </div><!-- END.entry-meta-custom -->
      </div>

      <div class="col-md-3 widgets">

        <?php
        // http://www.kristarella.com/exifography/
        // Download and install to use EXIF for feature photos

        if (function_exists('exifography_display_exif')) {
        ?>
          <h3>Portfolio Image Exif</h3>
        <?php echo exifography_display_exif(); ?>
        <?php } ?>

      <?php endwhile; // end of the loop. ?>

      </div>

      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <?php birds_post_nav(); ?>
        </div>
      </div>

    </div>
  </div><!-- #primary -->
</main><!-- #main -->

<?php get_footer(); ?>