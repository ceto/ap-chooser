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
  <section class="chooserblock">
    <div class="thechooser">
      <?php
        $nezeti_kep = get_field('nezeti_kep', $aktblokk);
        if ( $blokktype!=='building' && !empty($nezeti_kep) ): ?>
          <div id="visualchooser" class="visualchooser" data-width="<?= $nezeti_kep['sizes']['apcfull-width'] ?>" data-height="<?= $nezeti_kep['sizes']['apcfull-height'] ?>">
            <?= wp_get_attachment_image( $nezeti_kep['id'], 'apcfull' ); ?>
            <div data-magellan>
              <a href="#fulllist"  class="csiki alert button">Mutasd az összes lakást</a>
            </div>
            <div class="chooserhelper" data-magellan>
              <div class="row">
                <div class="columns tablet-8">
                  <h2>Virtuális lakásválasztó</h2>
                  <p>Lakás kiválasztásához klikkeljen az épületek szintjeire</p>
                </div>
              </div>
            </div>
          </div>
      <?php endif;?>



      <section id="fulllist" class="fulllist <?= ($blokktype!=='building')?'is-hidden':'';  ?>"  data-magellan-target="fulllist">

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
              <h1 class="apc-pageheader__title"><?= $aktblokk->name; ?></h1>
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
              <h2 class="tabletitle"><a href="<?= get_term_link($term );  ?>"><?php echo $term->name;?></a></h2>
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
                       data-building="<?= $term->name; ?>"
                       data-url="<?= get_term_link($floor);?>"
                       data-svgdata="<?= get_field('svg_data', $floor) ?>"
                       href="<?= get_term_link($floor);?>">
                        <?= $term->name; ?>: <?= $floor->name;  ?>
                     </a></li>
                    <?php endforeach; ?>
                </ul>

                <?php
                  foreach ($the_floors as $key => $floor) :?>
                     <div class="reveal" id="floorModal<?= $floor->slug ?>" data-reveal>
                      <h3><?= $term->name; ?>: <?= $floor->name;  ?></h3>
                      <?php
                        $floormap = get_field('nezeti_kep', $floor);
                        if ( !empty($floormap) ): ?>
                          <figure class="apc-blockmap">
                            <?= wp_get_attachment_image( $floormap['id'], 'large' ); ?>
                          </figure>
                      <?php endif;?>
                       <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                       </button>
                    </div>
                <?php endforeach; ?>
              <?php endif; ?>

              <div class="datatable">
                <p class="datarow datatable--head">
                  <span class="datarow--cell">Lakás</span>
                  <span class="datarow--cell">Emelet</span>
                  <span class="datarow--cell">Alapterület</span>
                  <span class="datarow--cell">Szobák</span>
                  <span class="datarow--cell">Erkély/Terasz</span>
                  <span class="datarow--cell">Tájolás</span>
                  <span class="datarow--cell">Ár (Ft)</span>
                </p>
                <?php
                    $posts = get_posts(array(
                      'post_type' => 'lakas',
                      'taxonomy' => $term->taxonomy,
                      'term' => $term->slug,
                      'nopaging' => true, // to show all posts in this taxonomy, could also use 'numberposts' => -1 instead
                      'orderby' => 'date',
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

      </section>

    </div>
  </section>
</main>



<?php get_footer(); ?>
