<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package birds
 */
?>
	<div id="secondary" class="widget-area" role="complementary">

		<aside id="archives" class="widget">
			<ul>
				<?php if ( ! dynamic_sidebar('sidebar') ) : ?>
					<?php endif; // end sidebar widget area ?>
			</ul>
		</aside>
	</div><!-- #secondary -->
