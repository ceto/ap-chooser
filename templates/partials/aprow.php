<p class="datarow">
  <a id="ap-<?= get_the_ID();  ?>" class="datarow--link statsuz-<?= get_field('statusz'); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
  data-name="<?php the_title(); ?>"
  data-alapterulet="<?= get_field('alapterulet') ?>"
  data-etkezo="<?= get_field('etkezo') ?>"
  data-konyha="<?= get_field('konyha') ?>"
  data-szobak="<?= count(get_field('szobak')) ?>"
  data-pris="<?= get_field('pris') ?>"
  data-statsuz="<?= get_field('statusz') ?>"
  data-svgdata="<?= get_field('svg_data') ?>"
  data-url="<?php the_permalink(); ?>"
  >
    <span class="datarow--cell"><?php the_title(); ?></span>
    <span class="datarow--cell"><?= get_field('alapterulet') ?>m<sup>2</sup></span>
    <span class="datarow--cell"><?= count( get_field('szobak')) ?></span>
    <span class="datarow--cell"><?= get_field('konyha') ?>m<sup>2</sup></span>
    <span class="datarow--cell"><?= get_field('etkezo') ?>m<sup>2</sup></span>
    <?php if ( get_field('statsuz') === 'free' ) : ?>
      <span class="datarow--cell"><i class="<?= get_field('statusz') ?>"></i><?= get_field('pris') ?></span>
    <?php else : ?>
      <span class="datarow--cell"><i class="<?= get_field('statusz') ?>"></i><?= get_field('statusz') ?></span>
    <?php endif; ?>
  </a>
</p>