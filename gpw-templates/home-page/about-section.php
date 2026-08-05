<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Home page - about section
 */
use gpweb\inc\base\Utilities as Utils;
$sectionData = get_field( 'about' );
if( empty( $sectionData['images'] ) ) {
  return;
}
$slideItems = [];
foreach( $sectionData['images'] as $imgID ) {
  $slideItems[] = wp_get_attachment_image( $imgID, 'large', false, [ 'class' => 'about__img' ] );
}
?>
<section class="about">
  <div class="section__inner">
    <div class="about__carousel">
      <?php get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true ] ) ?>
    </div>
    <div class="about__content">
      <?php if( !empty( $sectionData['sub_title'] ) ) : ?>
        <span class="section__sub-title"><?= esc_html( $sectionData['sub_title'] ) ?></span>
      <?php endif ?>
      <?php if( !empty( $sectionData['title'] ) ) : ?>
        <h2 class="section__title"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ) : ?>
        <div class="section__description"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
      <?php if( !empty( $sectionData['link_to']['label'] ) ) {
        get_template_part( 'gpw-templates/global/jins-button', null, [
          'label'   => $sectionData['link_to']['label'],
          'href'    => Utils::getUrl( $sectionData['link_to'] ),
          'variant' => $sectionData['link_to']['style'],
          'theme'   => 'primary',
          'size'    => 'medium',
          'rounded' => 'full'
        ] );
      } ?>
    </div>
  </div>
</section>