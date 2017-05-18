<?php get_header(); ?>

<?php
  echo "Menu";

  // Adding Main Menu
  $defaults = array(
    'container' => false,
    'theme_location' => 'primary-menu',
    'menu_class' => 'no-bullet'
  );

  wp_nav_menu($defaults);
  echo "This is your Home Page template :P";

  // Wordpress Loop
  if(have_posts()):
    while(have_posts()):
      the_post();
      //
      // Post Content Here
      the_title();
      the_content();
      //
    endwhile;
  else:
    _e("Sorry, no posts matched");
  endif;
?>

<?php get_footer(); ?>
