<?php
/**
 * @package birds
 */
?>

<?php $thumb = 'birds-thumb-portfolio'; ?>

<ul class="search-list">
  <li id="post-<?php the_ID(); ?>">

    <div class="search-inner">
      <?php if (has_post_thumbnail() ) : ?>
        <figure class="search-image">
          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( $thumb ); ?>
          </a>
        </figure>
      <?php endif; ?>

      <div class="search-text">
        <h3 class="li-head"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

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
          <div>Order: <?php echo get_the_term_list( $post->ID, 'bird-order', '', ', ', '' ); ?></div>
          <?php endif; ?>

          <?php if (get_the_term_list( $post->ID, 'bird-family' ) != null ) : ?>
            <div>Family: <?php echo get_the_term_list( $post->ID, 'bird-family', '', ', ', '' ); ?></div>
          <?php endif; ?>

          <?php if (get_the_term_list( $post->ID, 'bird-tags' ) != null ) : ?>
            <div>Tags: <?php echo get_the_term_list( $post->ID, 'bird-tags', '', ', ', '' ); ?></div>
          <?php endif; ?>
        </p>
        <?php edit_post_link( __( 'Edit', 'birds' ), '<span class="edit-link">', '</span>' ); ?>
      </div>

    </div>
  </li>
</ul>
