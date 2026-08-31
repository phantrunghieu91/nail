<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: About page - Mission & Vision section
 */
$sectionData = get_field( 'mission_vision' );
if( empty( $sectionData ) ) {
  return;
}
?>
<section class="mission-vision">
  <div class="section__inner grid-repeated-cols">
    <?php foreach( $sectionData as $block ) : ?>
      <article class="mission-vision__block">
        <?php if( !empty( $block['image'] ) ) {
          echo wp_get_attachment_image( $block['image'], 'large', false, ['class' => 'mission-vision__block-image', 'alt' => $block['title']] );
        } ?>
        <div class="mission-vision__block-content">
          <?php if( !empty( $block['sub_title'] ) ) : ?>
            <span class="section__sub-title"><?= esc_html( $block['sub_title'] ) ?></span>
          <?php endif ?>
          <?php if( !empty( $block['title'] ) ) : ?>
            <h2 class="section__title"><?= esc_html( $block['title'] ) ?></h2>
          <?php endif ?>
          <?php if( !empty( $block['content'] ) ) : ?>
            <div class="section__description"><?= wp_kses_post( $block['content'] ) ?></div>
          <?php endif ?>
        </div>
      </article>
    <?php endforeach ?>
  </div>
</section>