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
  <section class="chooserblock" id="finndinbolig">
    <div class="thechooser">
      <?php
        $nezeti_kep = get_field('nezeti_kep', $aktblokk);
        //var_dump($nezeti_kep['sizes']['apcfull-height']);
        if ( !empty($nezeti_kep) ): ?>
          <div id="visualchooser" class="visualchooser" data-width="<?= $nezeti_kep['sizes']['apcfull-width'] ?>" data-height="<?= $nezeti_kep['sizes']['apcfull-height'] ?>">
            <?= wp_get_attachment_image( $nezeti_kep['id'], 'apcfull' ); ?>
          </div>
      <?php endif;?>

      <header class="apc-pageheader">
        <div class="row">
          <div class="columns">
            <?php if ($blokktype!='root') : ?>
              <ul class="breadcrumbs">
                <li><a href="<?= get_term_link('deltaliget','blokk') ?>">Deltaliget</a></li>
                <?php if ($blokktype=='floor') : ?>
                <li><a href="<?= get_term_link($parentblokk );  ?>"><?php echo $parentblokk->name;?></a></li>
                <?php endif; ?>
              </ul>
            <?php endif; ?>

            <h1 class="apc-pageheader__title" title="baazz sdalf"><?= $aktblokk->name; ?></h1>
            <p>
The <span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover="false" tabindex="1" title="Fancy word for a beetle.">scarabaeus</span> hung quite clear of any branches, and, if allowed to fall, would have fallen at our feet. Legrand immediately took the scythe, and cleared with it a circular space, three or four yards in diameter, just beneath the insect, and, having accomplished this, ordered Jupiter to let go the string and come down from the tree.
</p>
          </div>
        </div>
      </header>

      <div class="row">
        <div class="columns">

          <?php
            if ($blokktype == 'floor') {
              $terms = array($aktblokk);
            } else {
              $terms = get_terms('blokk', array(
               'parent' => $aktblokk->term_id,
               'orderby' => 'slug'
              ));
            }


          foreach( $terms as $term ):  ?>
            <?php if ($blokktype!='floor') : ?>
            <h2><a href="<?= get_term_link($term );  ?>"><?php echo $term->name;?></a></h2>
            <?php endif; ?>

            <?php if ($blokktype=='root') : ?>
              <ul class="floorlist">
                <?php
                  $the_floors = get_terms( array(
                    'taxonomy' => 'blokk',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'taxonomy' => 'blokk',
                    'parent'=> $term->term_id
                  ));
                  foreach ($the_floors as $key => $floor) :?>
                   <li><a id="<?= $floor->slug ?>" class="datarow--floor"
                     data-url="<?= get_term_link($floor);?>"
                     data-svgdata="<?= get_field('svg_data', $floor) ?>"
                     href="<?= get_term_link($floor);?>">
                      <?= $floor->name;  ?>
                   </a></li>
                  <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <div class="datatable">
              <p class="datarow datatable--head">
                <span class="datarow--cell">Lakás</span>
                <span class="datarow--cell">Emelet</span>
                <span class="datarow--cell">Alapterület</span>
                <span class="datarow--cell">Szobák</span>
                <span class="datarow--cell">Tájolás</span>
                <span class="datarow--cell">Ár</span>
              </p>
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
              </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</main>



<?php get_footer(); ?>
