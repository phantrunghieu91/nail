<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: About page - Introduction section
 */
$sectionData = get_field( 'introduction' );
if( empty( $sectionData['content'] ) ) {
  return;
}
?>
<section class="introduction">
  <div class="section__inner">
    <?php if( !empty( $sectionData['image'] ) ) {
      echo wp_get_attachment_image( $sectionData['image'], 'large', false, [ 'class' => 'introduction__image', ] );
    } ?>
    <div class="introduction__content-wrapper">
      <?php if( !empty( $sectionData['sub_title'] ) ) : ?>
        <span class="section__sub-title section__sub-title--center"><?= esc_html( $sectionData['sub_title'] ) ?></span>
      <?php endif ?>
      <?php if( !empty( $sectionData['title'] ) ) : ?>
        <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['content'] ) ) : ?>
        <div class="section__content section__content--center"><?= wp_kses_post( $sectionData['content'] ) ?></div>
      <?php endif ?>
    </div>
  </div>
</section>