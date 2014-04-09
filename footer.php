<?php
/**
 * The template for displaying the footer.
 *
 * @package birds
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div id="site-info" class="container">
    <div class="row">
      <div class="col-md-12">

       <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'birds' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'birds' ), 'WordPress' ); ?></a>
		   <span class="sep"> | </span>
		   <?php printf( __( 'Theme: %1$s by %2$s.', 'birds' ), 'birds', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
	    </div>
    </div>
  </div><!-- #site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
