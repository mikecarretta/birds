<?php
/**
 * @package birds
 */
?>

<?php $thumb = 'birds-thumb-portfolio'; ?>

<ul class="search-list">

  <li id="post-<?php the_ID(); ?>" class="<?php if ( 'portfolio' == get_post_type() ) {?>search-portfolio<?php } elseif ( 'birds' == get_post_type() ) {?>search-bird<?php } else {?>search-post<?php } ?>">

    <div class="search-inner">
      <?php if (has_post_thumbnail() ) : ?>
        <figure class="search-image">
          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( $thumb ); ?>
          </a>
        </figure>
      <?php endif; ?>

      <div class="search-text">
        <h3 class="li-head">
          <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?> <span class="label label-info">
                  <?php if ( 'portfolio' == get_post_type() ) {?>Portfolio<?php } elseif ( 'birds' == get_post_type() ) {?>Bird<?php } else {?>Post<?php } ?>
                </span>
          </a>
        </h3>

        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
          <p class="entry-summary">
            <?php the_excerpt(); ?>
          </p>

        <?php else : ?>
          <p class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'birds' ) ); ?>
            <?php
              wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'birds' ),
                'after'  => '</div>',
              ) );
            ?>
          </p><!-- .entry-content -->
        <?php endif; ?>

        <p class="meta">
          <?php if (get_the_term_list( $post->ID, 'bird-order' ) != null ) : ?>
          <div>Bird Order: <?php echo get_the_term_list( $post->ID, 'bird-order', '', ', ', '' ); ?></div>
          <?php endif; ?>

          <?php if (get_the_term_list( $post->ID, 'bird-family' ) != null ) : ?>
            <div>Bird Family: <?php echo get_the_term_list( $post->ID, 'bird-family', '', ', ', '' ); ?></div>
          <?php endif; ?>

          <?php if (get_the_term_list( $post->ID, 'bird-tags' ) != null ) : ?>
            <div>Bird Tags: <?php echo get_the_term_list( $post->ID, 'bird-tags', '', ', ', '' ); ?></div>
          <?php endif; ?>

          <?php if (get_the_term_list( $post->ID, 'portfolio_category' ) != null ) : ?>
          <div>Category: <?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ); ?></div>
          <?php endif; ?>

          <?php if (get_the_term_list( $post->ID, 'portfolio_tag' ) != null ) : ?>
          <div>Portfolio Tags: <?php echo get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' ); ?></div>
          <?php endif; ?>
        </p>
        <?php edit_post_link( __( 'Edit', 'birds' ), '<span class="edit-link">', '</span>' ); ?>
      </div>

    </div>
  </li>
</ul>
