<?php
  if ( !defined('ABSPATH') ){ die(); }
  get_header();
?>
<?php while (have_posts()) : the_post(); ?>
  <main class='apc-ns' role="main">
    <?php $blokklist = wp_get_post_terms($post->ID, 'blokk', array('orderby' => 'id', 'order' => 'ASC')); ?>
    <header class="apc-pageheader">
      <div class="row">
        <div class="columns">
          <ul class="breadcrumbs">
            <?php foreach ($blokklist as $key => $blokkitem) :?>
              <li><a href="<?php echo get_term_link( $blokkitem ); ?>"><?php echo $blokkitem->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
          <h1 class='apc-pageheader__title'><?php the_title(); ?> lakás</h1>
        </div>
      </div>
    </header>
    <div class="row">
      <div class="columns medium-7 large-8">
        <?php
          $alaprajz = get_field('szines_alaprajz');
          if ( !empty($alaprajz) ): ?>
            <figure class="apc-alaprajz">
              <a href="<?= $alaprajz['url']; ?>">
                <?= wp_get_attachment_image( $alaprajz['id'], 'large' ); ?>
              </a>
            </figure>
        <?php endif;?>
      </div>

      <div class="columns medium-5 large-4">
        <?php
          $blockmap = get_field('tomb_terkep');
          if ( !empty($blockmap) ): ?>
            <figure class="apc-blockmap">
              <a href="<?= $blockmap['url']; ?>">
                  <?= wp_get_attachment_image( $blockmap['id'], 'large' ); ?>
              </a>
            </figure>
        <?php endif;?>

        <section class="apc-infopanel">
          <h2>Adatlap</h2>
          <dl class="apc-paramlist">
            <dt class="apc-featlistitem">Alapterület</dt><dd class="apc-featlistitem"><?= get_field('alapterulet') ?>m<sup>2</sup></dd>
            <dt class="apc-featlistitem">Szobák száma</dt><dd class="apc-featlistitem"><?= get_field('nagyszobak') ?><?= get_field('felszobak')>0?'+'.get_field('felszobak'):'' ?></dd>
            <dt class="apc-featlistitem">Tájolás</dt><dd class="apc-featlistitem"><?= get_field('tajolas') ?></dd>
          </dl>
          <hr>
          <dl class="apc-paramlist">
            <?php if ( get_field('kozlekedo') ) : ?>
              <dt>Közlekedő</dt><dd><?= get_field('kozlekedo') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('wc') ) : ?>
              <dt>WC</dt><dd><?= get_field('wc') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('furdoszoba') ) : ?>
              <dt>Fürdőszoba</dt><dd><?= get_field('furdoszoba') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('zuhanyzomosdo') ) : ?>
              <dt>Zuhanyzó/mosdó</dt><dd><?= get_field('zuhanyzomosdo') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('konyha') ) : ?>
              <dt>Konyha</dt><dd><?= get_field('konyha') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('etkezo') ) : ?>
              <dt>Étkező</dt><dd><?= get_field('etkezo') ?>m<sup>2</sup></dd>
            <?php endif; ?>

            <?php if ( get_field('konyhaetkezo') ) : ?>
              <dt>Konyha/Étkező</dt><dd><?= get_field('konyhaetkezo') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('nappali') ) : ?>
              <dt>Nappali</dt><dd><?= get_field('nappali') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('kamra') ) : ?>
              <dt>Kamra</dt><dd><?= get_field('kamra') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('gardrob') ) : ?>
              <dt>Gardrób</dt><dd><?= get_field('gardrob') ?>m<sup>2</sup></dd>
            <?php endif; ?>

            <?php if ( have_rows('szobak') ) : ?>
              <?php  while ( have_rows('szobak') ) : the_row(); ?>
                <dt>Szoba</dt><dd><?= get_sub_field('szoba') ?>m<sup>2</sup></dd>
              <?php endwhile; ?>
            <?php endif; ?>
          </dl>
          <hr>
          <dl class="apc-paramlist apc-paramlist--secondary">
            <?php if ( get_field('erkely') ) : ?>
              <dt>Erkély</dt><dd><?= get_field('erkely') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('terasz') ) : ?>
              <dt>Terasz</dt><dd><?= get_field('terasz') ?>m<sup>2</sup></dd>
            <?php endif; ?>
            <?php if ( get_field('loggia') ) : ?>
              <dt>Loggia</dt><dd><?= get_field('loggia') ?>m<sup>2</sup></dd>
            <?php endif; ?>
          </dl>
          <hr>
          <dl class="apc-paramlist apc-paramlist--secondary">
            <?php if ( $post_objects = get_field('hasonlo_lakasok') ) : ?>
              <dt>Hasonló lakások</dt>
              <dd class="listapista">
                <?php foreach( $post_objects as $post_object): ?>
                  <a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a>
                <?php endforeach; ?>

              </dd>
            <?php endif; ?>
          </dl>

          <div class="apc-infopanel__actions">
            <a class="button small" href="tel:1123412">Részletek: +36 (1) 398 4589</a>
            <?php if ( $file = get_field('csatolmany')) : ?>
            <a class="button small secondary" href="<?= $file['url']  ?>">Alaprajz (PDF)</a>
            <?php endif; ?>
          </div>

        </section>
      </div>

    </div>
  </main>
<?php endwhile; ?>

<?php get_footer(); ?>