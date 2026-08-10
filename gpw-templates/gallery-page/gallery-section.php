<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Gallery page - Gallery section
 */
$galleries = get_field( 'gallery' );
if( empty( $galleries ) ) {
  return;
}
$navItems   = [];
$panelItems = [];
foreach( $galleries as $gallery ) {
  $slug       = sanitize_title( $gallery['label'] );
  $navItems[] = [
    'id'    => $slug,
    'title' => $gallery['label']
  ];
  ob_start();
  ?>
  <div class="galleries__grid grid-repeated-cols">
    <?php foreach( $gallery['images'] as $image ) :
      if( empty( $image['image'] ) ) continue;
      ?>
      <figure class="galleries__item">
        <div class="galleries__item-img">
          <?= wp_get_attachment_image( $image['image'], 'medium_large', false, [ 'alt' => $image['label'] ] ) ?>
        </div>
        <?php if( !empty( $image['label'] ) ) : ?>
          <figcaption class="galleries__item-label"><?= esc_html( $image['label'] ) ?></figcaption>
        <?php endif ?>
      </figure>
    <?php endforeach ?>
  </div>
  <?php
  $panelItems[] = [
      'id'      => $slug,
      'content' => ob_get_clean(),
  ];
}
?>
<section class="galleries">
  <div class="section__inner">
    <h2 class="section__title section__title--center"><?= get_the_title() ?></h2>
    <?php get_template_part( 'gpw-templates/global/tabs/tabs-nav', null, [ 'nav_items' => $navItems, 'style' => 'pills' ] ); ?>
    <?php get_template_part( 'gpw-templates/global/tabs/tabs-content', null, [ 'panels' => $panelItems ] ) ?>
  </div>
</section>