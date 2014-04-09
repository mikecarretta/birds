<?php

// Add new post type for Bird List
add_action('init', 'bird_list_init');
function bird_list_init() 
{
	$birds_labels = array(
		'name' => _x('Birds', 'post type general name'),
		'singular_name' => _x('Bird List', 'post type singular name'),
		'all_items' => __('All Birds'),
		'add_new' => _x('Add new bird', 'birds'),
		'add_new_item' => __('Add new bird'),
		'edit_item' => __('Edit bird'),
		'new_item' => __('New bird'),
		'view_item' => __('View birds'),
		'search_items' => __('Search birds'),
		'not_found' =>  __('No birds found'),
		'not_found_in_trash' => __('No birds found in trash'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $birds_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 4,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
		'has_archive' => 'birds'
	); 
	register_post_type('birds',$args);
}
// Add new Custom Post Type icons
add_action( 'admin_head', 'bird_icon' );
function bird_icon() {
?>
	<style type="text/css" media="screen">
		#menu-posts-birds .wp-menu-image {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/bird-portfolio/images/birds-icon.png) no-repeat 6px 6px !important;
		}
		#menu-posts-birds:hover .wp-menu-image, #menu-posts-birds.wp-has-current-submenu .wp-menu-image {
			background-position:6px -16px !important;
		}
		.icon32-posts-birds {
			background: url(<?php bloginfo('url') ?>/wp-content/themes/bird-portfolio/images/birds-32x32.png) no-repeat !important;
		}
    </style>
<?php }
// Add custom taxonomies
add_action( 'init', 'bird_taxonomies', 0 );
function bird_taxonomies() 
{
	// Bird Order
	$bird_order_labels = array(
		'name' => _x( 'Bird Order', 'taxonomy general name' ),
		'singular_name' => _x( 'Bird Order', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search bird order' ),
		'all_items' => __( 'All bird order' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit bird order' ), 
		'update_item' => __( 'Update bird order' ),
		'add_new_item' => __( 'Add new bird order' ),
		'new_item_name' => __( 'New bird order' ),
		'menu_name' => __( 'Bird Order' ),
	);
	// This adds the bird order type to the custom posts
	register_taxonomy('bird-order', 'birds', array(
		'hierarchical' => true,
		'labels' => $bird_order_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'bird-order' )
	));
	// Bird Family
	$bird_family_labels = array(
		'name' => _x( 'Bird Family', 'taxonomy general name' ),
		'singular_name' => _x( 'Bird Family', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search bird family' ),
		'all_items' => __( 'All bird family' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit bird family' ), 
		'update_item' => __( 'Update bird family' ),
		'add_new_item' => __( 'Add new bird family' ),
		'new_item_name' => __( 'New bird family' ),
		'menu_name' => __( 'Bird family' ),
	);
	// This adds the bird family type to the custom posts
	register_taxonomy('bird-family', 'birds', array(
		'hierarchical' => true,
		'labels' => $bird_family_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'bird-family' )
	));
	// Bird Name
	$bird_name_labels = array(
		'name' => _x( 'Bird Name', 'taxonomy general name' ),
		'singular_name' => _x( 'Bird Name', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search bird name' ),
		'all_items' => __( 'All bird name' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit bird name' ), 
		'update_item' => __( 'Update bird name' ),
		'add_new_item' => __( 'Add new bird name' ),
		'new_item_name' => __( 'New bird name' ),
		'menu_name' => __( 'Bird name' ),
	);
	// This adds the bird family type to the custom posts
	register_taxonomy('bird-name', 'birds', array(
		'hierarchical' => true,
		'labels' => $bird_name_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'bird-name' )
	));	
	// Tags
		$bird_tags_labels = array(
		'name' => _x( 'Bird Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Bird Tags', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in bird tags' ),
		'popular_items' => __( 'Popular bird tags' ),
		'all_items' => __( 'All bird tags' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit bird tag' ), 
		'update_item' => __( 'Update bird tag' ),
		'add_new_item' => __( 'Add new bird tags' ),
		'new_item_name' => __( 'New bird tag name' ),
		'separate_items_with_commas' => __( 'Separate bird tags with commas' ),
	    'add_or_remove_items' => __( 'Add or remove bird tag' ),
	    'choose_from_most_used' => __( 'Choose from the most used bird tags' ),
		'menu_name' => __( 'Bird Tags' ),
	);
	register_taxonomy('bird-tags', 'birds', array(
		'hierarchical' => false,
		'labels' => $bird_tags_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'bird-tags' )
	));
}
add_action("manage_posts_custom_column",  "birds_custom_columns");
add_filter("manage_edit-birds_columns", "birds_edit_columns");
 
function birds_edit_columns($columns){
  	$columns = array(
    	"cb" => "<input type=\"checkbox\" />",
		"title" => "Bird Title",
    	"thumbnail" => __('Thumbnail'),
    	"bird-tags" => "Tags",
		"bird-order" => "Bird Order",
		"bird-family" => "Bird Family",
		"author" => __('Author'),
		"comments" => __('Comments'),
		"date" => __('Date'),
  		);
		$columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
		return $columns;
}
function birds_custom_columns($column){

  	switch ($column) {
    	case "bird-tags":
      		echo get_the_term_list($post->ID, 'bird-tags', '', ', ','');
      		break;
		case "bird-order":
	      	echo get_the_term_list($post->ID, 'bird-order');
	      	break;
		case "bird-family":
		    echo get_the_term_list($post->ID, 'bird-family');
		    break;
  }
}
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	// for post and page
	add_theme_support('post-thumbnails', array( 'birds') );
	function fb_AddThumbColumn($cols) {
		$cols['thumbnail'] = __('Thumbnail');
		return $cols;
	}
	function fb_AddThumbValue($column_name, $post_id) {
			$width = (int) 100;
			$height = (int) 100;
			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );

					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None');
					}
			}
	}
	// for posts
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
}
/**
 * Add Bird count to "Right Now" Dashboard Widget
*/
function add_bird_counts() {
        if ( ! post_type_exists( 'birds' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'birds' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Birds', 'Birds', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=birds'>$num</a>";
            $text = "<a href='edit.php?post_type=birds'>$text</a>";
        }
        echo '<td class="first b b-birds">' . $num . '</td>';
        echo '<td class="t birds">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'Bird Item Pending', 'Bird Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=birds'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=birds'>$text</a>";
            }
            echo '<td class="first b b-birds">' . $num . '</td>';
            echo '<td class="t birds">' . $text . '</td>';

            echo '</tr>';
        }
}
add_action( 'right_now_content_table_end', 'add_bird_counts' );
?>