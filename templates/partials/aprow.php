<p class="datarow" data-emeletslug="<?= emeletslug(get_the_ID()) ?>">
  <a id="ap-<?= get_the_ID();  ?>" class="datarow--link statusz-<?= get_field('statusz'); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
  data-name="<?php the_title(); ?>"
  data-alapterulet="<?= get_field('alapterulet') ?>"
  data-etkezo="<?= get_field('etkezo') ?>"
  data-konyha="<?= get_field('konyha') ?>"
  data-szobak="<?= count(get_field('szobak')) ?>"
  data-pris="<?= get_field('pris') ?>"
  data-statsuz="<?= get_field('statusz') ?>"
  data-svgdata="<?= get_field('svg_data') ?>"
  data-url="<?php the_permalink(); ?>"
  data-emeletslug="<?= emeletslug(get_the_ID()) ?>"
  >
    <span class="datarow--cell"><?php the_title(); ?></span>
    <span class="datarow--cell"><?= emeletinfo(get_the_ID()) ?></span>
    <span class="datarow--cell"><?= get_field('alapterulet') ?>m<sup>2</sup></span>
    <span class="datarow--cell"><?= get_field('nagyszobak') ?> <?= get_field('felszobak')>0?' + '.get_field('felszobak'):'' ?></span>
    <span class="datarow--cell"><?= get_field('tajolas') ?></span>
    <?php if ( get_field('statusz') === 'free' ) : ?>
      <span class="datarow--cell"><?= get_field('price') ?>m Ft</span>
    <?php else : ?>
      <span class="datarow--cell"><?= stateinfo(get_field('statusz')) ?></span>
    <?php endif; ?>
  </a>
</p>