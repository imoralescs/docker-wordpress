<?php get_header(); ?>

<?php
  echo "Menu";

  // Adding Main Menu
  $defaults = array(
    'container' => false,
    'theme_location' => 'primary-menu',
    'menu_class' => 'name-class'
  );

  wp_nav_menu($defaults);

  // Wordpress Loop
  if (have_posts()) : while(have_posts()) : the_post();
    the_title();
    echo "<hr>";
    the_content();
  endwhile; else :
    _e("Sorry, no pages found");
  endif;
?>

<?php get_footer(); ?>
