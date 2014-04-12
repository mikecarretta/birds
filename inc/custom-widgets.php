<?php
/* -----------------------------------------
	Bird List with Thumbnail - Custom Post Widget
----------------------------------------- */

/* Custom Post Class */
class CustomPostWidget extends WP_Widget
{
	function CustomPostWidget() {
		/* Widget settings */
    	$widget_ops = array('classname' => 'CustomPostWidget', 'description' => 'Displays the last 5 birds added to the bird list with thumbnails' );

		/* Create the widget */
		$this->WP_Widget('CustomPostWidget', 'Bird List and Thumbnail', $widget_ops);
	}

	/* The Form - Title */
	function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'show_count' => 5 ) );
?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">Show:</label>
		<input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" size="2" /> posts
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Select Sort by Type:</label>
		<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
			<option value="id" <?php if ( 'id' == $instance['orderby'] ) echo 'selected="selected"'; ?>></option>
			<option value="date" <?php if ( 'date' == $instance['orderby'] ) echo 'selected="selected"'; ?>>Posted Date</option>
			<option value="modified" <?php if ( 'modified' == $instance['orderby'] ) echo 'selected="selected"'; ?>>Modified Date</option>
		</select>
	</p>

<?php }

	/* The Widget */
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

	/* User-selected settings. */
	$title 			= $instance['title'];
	$show_count 	= $instance['show_count'];
	$orderby 		= isset( $instance['orderby'] ) ? $instance['orderby'] : false;

    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

    if (!empty($title))
      echo $before_title . $title . $after_title;;

	/* The Widget Query */
	$thumbnail = 'birds-thumb-sm';
	$type = 'birds';
	$args=array(
	  	'post_type' => $type,
	  	'post_status' => 'publish',
		'posts_per_page' => $show_count,
		'orderby' => $orderby,
		'order' => 'DESC',
	);
	query_posts( $args );

	/* The Widget Loop */
	if (have_posts()) :
	while (have_posts()) : the_post();
?>
	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'bird-portfolio' ); ?> <?php the_title_attribute(); ?>" class="pull-left">
	<?php the_post_thumbnail( $thumbnail ); ?>
	</a>
<?php
	endwhile;
	endif;

	/* Reset the Query */
	wp_reset_query();

    echo $after_widget;
  }

	/* Update - Title */
	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
		$instance['show_count'] = $new_instance['show_count'];
		$instance['orderby'] = $new_instance['orderby'];
    return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("CustomPostWidget");') );

/* -----------------------------------------
	Portfolio - Custom Post Widget
----------------------------------------- */

/* Custom Post Class */
class portfolioWidget extends WP_Widget
{
	function portfolioWidget() {
		/* Widget settings */
    	$widget_ops = array('classname' => 'portfolioWidget', 'description' => 'Displays current Portfolio images' );

		/* Create the widget */
		$this->WP_Widget('portfolioWidget', 'Bird Portfolio Widget', $widget_ops);
	}

	/* The Form - Title */
	function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'show_count' => 6 ) );

?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">Show:</label>
		<input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" size="2" /> posts
	</p>

<?php }

	/* The Widget */
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

	/* User-selected settings. */
	$title 			= $instance['title'];
	$show_count 	= $instance['show_count'];

    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

    if (!empty($title))
      echo $before_title . $title . $after_title;;

	/* The Widget Query */
	$thumbnail = 'birds-thumb-sm';
	$type = 'portfolio';
	$args=array(
	  	'post_type' => $type,
	  	'post_status' => 'publish',
		'posts_per_page' => $show_count,
		'orderby' => 'date',
		'order' => 'DESC',
	);
	query_posts( $args );

	/* The Widget Loop */
	if (have_posts()) :
		echo "<ul>";
	while (have_posts()) : the_post();
?>
		<li>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'bird-portfolio' ); ?> <?php the_title_attribute(); ?>" class="thumb"><?php the_post_thumbnail( $thumbnail ); ?></a>
		</li>
<?php
	endwhile;
		echo "</ul>";
	endif;
	/* Reset the Query */
	wp_reset_query();

    echo $after_widget;
  }

	/* Update - Title */
	function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['title'] = $new_instance['title'];
		$instance['show_count'] = $new_instance['show_count'];
    return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("portfolioWidget");') );

/* -----------------------------------------
	Birds Custom Post - Bird Order and Family Category Widget
----------------------------------------- */

/* Custom Post Class */
class birdCategoryWidget extends WP_Widget {

	function birdCategoryWidget() {
		/* Widget settings */
    	$widget_ops = array('classname' => 'birdCategoryWidget', 'description' => 'Displays the categories for the Bird Orders or Bird Families' );

		/* Create the widget */
		$this->WP_Widget('birdCategoryWidget', 'Bird Order or Family Widget', $widget_ops);
	}

	/* The Form - Title */
	function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array( 'title' => '') );

?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br />
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>">Select Category:</label>
		<select id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
			<option value="id" <?php if ( 'id' == $instance['taxonomy'] ) echo 'selected="selected"'; ?>></option>
			<option value="bird-order" <?php if ( 'bird-order' == $instance['taxonomy'] ) echo 'selected="selected"'; ?>>Bird Order</option>
			<option value="bird-family" <?php if ( 'bird-family' == $instance['taxonomy'] ) echo 'selected="selected"'; ?>>Bird Family</option>
		</select>
	</p>
<?php }

	/* The Widget */
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

	/* User-selected settings. */
	$title 		= $instance['title'];
	$taxonomy 	= isset( $instance['taxonomy'] ) ? $instance['taxonomy'] : false;

    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

    if (!empty($title))
      echo $before_title . $title . $after_title;;

	/* The Widget Query */
	$bird_order_args = array(
		'taxonomy'     => $taxonomy,
		'orderby'      => 'name',
		'order' 	   => 'ASC',
		'show_count'   => 0,
		'pad_counts'   => 0,
		'hierarchical' => 1,
		'title_li'     => ''
	);
?>
	<ul class="tags">
		<?php wp_list_categories( $bird_order_args ); ?>
	</ul>
<?php

	/* Reset the Query */
	wp_reset_query();

    echo $after_widget;
  }

	/* Update - Title */
	function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['title'] = $new_instance['title'];
		$instance['taxonomy'] = $new_instance['taxonomy'];
    return $instance;
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("birdCategoryWidget");') );

?>