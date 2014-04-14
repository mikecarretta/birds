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
		   <?php printf( __( '%1$s developed by %2$s, Starter Theme: %3$s.', 'birds' ), '<a href="https://github.com/mikecarretta/birds" rel="designer">Birds Theme</a>', '<a href="http://mikecarretta.github.io/" rel="designer">Mike Carretta</a>', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
	    </div>
    </div>
  </div><!-- #site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
