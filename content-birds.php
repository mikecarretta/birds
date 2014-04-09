<?php
/**
 * @package birds
 */
?>

<article id="post-<?php the_ID(); ?>">
  <section class="post_content birds" itemprop="articleBody">
    <header>
      <h1 class="page-header"><?php the_title(); ?></h1>
    </header>
    <ul class="list img-list">

    <?php
    $thumb = 'birds-sm';
    $args = array(
      'post_type' => 'birds',
      'posts_per_page' => 18,
      'orderby' => 'name',
      'order' => 'ASC'
    );
    $birds = new WP_Query( $args );

    if( $birds->have_posts() ) {
      while( $birds->have_posts() ) {
        $birds->the_post();
    ?>
      <li id="post-<?php the_ID(); ?>">

        <a href="<?php the_permalink() ?>" class="inner" title="<?php the_title_attribute(); ?>">
          <figure>
            <?php the_post_thumbnail( $thumb ); ?>
          </figure>

          <div class="li-text">
            <h3><?php the_title() ?></h3>
          </div>
        </a>
      </li>

    <?php
      }
    } else {
      echo 'Oh ohm no birds!';
    } ?>

    </ul>
    <div class="row">
      <div class="col-md-12">
        <?php birds_navi() ?>
      </div>
    </div>
  </section>
</article>