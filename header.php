<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package birds
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

 <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#birds-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bird-icon.png" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="birds-navbar-collapse">

      <?php birds_main_nav(); ?>

      <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="navbar-form navbar-right">
      	<input type="text" name="s" id="s" placeholder="<?php _e('Search', 'birds'); ?>" class="form-control search-field"> <button type="submit" class="btn btn-search"><span class="glyphicon glyphicon-search"></span></button>
      </form>

    </div><!-- /.navbar-collapse -->
    </div>
  </nav>