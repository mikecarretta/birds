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

      <footer class="entry-footer">
      <?php edit_post_link( __( 'Edit', 'birds' ), '<span class="edit-link">', '</span>' ); ?>
      </footer><!-- .entry-footer -->

      <div class="col-md-6 widgets">
        <h3 >Overview</h3>
        <?php the_content(); ?>
      </div>

      <div class="col-md-3 widgets">
        <h3>Bird Meta Data</h3>
        <div class="entry-meta-custom">
        <?php if (get_the_term_list( $post->ID, 'bird-name' ) != null ) { ?>
          <div>Name: <?php echo get_the_term_list( $post->ID, 'bird-name', '', ', ', '' ); ?></div>
        <?php } ?>
        <?php if (get_the_term_list( $post->ID, 'bird-order' ) != null ) { ?>
          <div>Order: <?php echo get_the_term_list( $post->ID, 'bird-order', '', ', ', '' ); ?></div>
        <?php } ?>
        <?php if (get_the_term_list( $post->ID, 'bird-family' ) != null ) { ?>
          <div>Family: <?php echo get_the_term_list( $post->ID, 'bird-family', '', ', ', '' ); ?></div>
        <?php } ?>
        <?php if (get_the_term_list( $post->ID, 'bird-tags' ) != null ) { ?>
          <div>Tags: <?php echo get_the_term_list( $post->ID, 'bird-tags', '', ', ', '' ); ?></div>
        <?php } ?>

      </div><!-- END.entry-meta-custom -->
      </div>

      <div class="col-md-3 widgets">

        <?php
        // http://www.kristarella.com/exifography/
        // Download and install to use EXIF for feature photos

        if (function_exists('exifography_display_exif'))
        ?>
          <h3>Feature Image Exif</h3>
        <?php echo exifography_display_exif(); ?>
      <?php endwhile; // end of the loop. ?>
      </div>

      <div class="row">
        <div class="col-md-12 post-nav">
          <?php birds_post_nav(); ?>
        </div>
      </div>

    </div>
  </div><!-- #primary -->
</main><!-- #main -->

<?php get_footer(); ?>