<?php
  if ( !defined('ABSPATH') ){ die(); }
  get_header();
?>
<?php $aktblokk = get_term_by( 'slug', get_query_var(term), 'blokk'); ?>
<?php $parentblokk = get_term($aktblokk->parent, 'blokk' );

  if ( $aktblokk->parent == 0) {
    $blokktype='root';
  } elseif ($parentblokk->parent == 0) {
    $blokktype='building';
  } else {
    $blokktype='floor';
  }
?>
<main class='apc-ns' role="main">
  <header class="apc-pageheader">
    <div class="row">
      <div class="columns">
        <ul class="breadcrumbs">
          <li><a href="<?= get_term_link('deltaliget','blokk') ?>">Deltaliget</a></li>
        </ul>
        <h1 class='apc-pageheader__title'><?= $blokktype!='root'? $parentblokk->name.' - ':'' ?><?= $aktblokk->name; ?></h1>
      </div>
    </div>
  </header>
  <div class="row">
    <div class="columns">
      <?php // Output all Taxonomies names with their respective items
        $terms = get_terms('blokk', array(
         'parent' => $aktblokk->term_id,
         'orderby' => 'slug'
        ));
        foreach( $terms as $term ):  ?>
          <h2><a href="<?= get_term_link($term );  ?>"><?php echo $term->name;?></a></h2>
          <?php
              $posts = get_posts(array(
                'post_type' => 'lakas',
                'taxonomy' => $term->taxonomy,
                'term' => $term->slug,
                'nopaging' => true, // to show all posts in this taxonomy, could also use 'numberposts' => -1 instead
                'orderby' => 'title',
                'order' => 'ASC'
              ));
              foreach($posts as $post): // begin cycle through posts of this taxonmy
                setup_postdata($post); //set up post data for use in the loop (enables the_title(), etc without specifying a post ID)
              ?>
                <?php require('partials/aprow.php'); ?>
              <?php endforeach; ?>
              <hr>
        <?php endforeach; ?>
    </div>
  </div>
</main>



<?php get_footer(); ?>
