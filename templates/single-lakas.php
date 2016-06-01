<?php
  if ( !defined('ABSPATH') ){ die(); }
  get_header();
?>
<main class='apc' role="main">

  <h1><?php the_title() ?></h1>
  <?= get_the_content( ); ?>
  <?php the_field('alapterulet') ?>

</main>

<?php get_footer(); ?>