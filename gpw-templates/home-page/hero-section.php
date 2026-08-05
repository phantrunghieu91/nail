<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Home page - Hero section
 */
use gpweb\inc\base\Utilities as Utils;
$sectionData = get_field( 'hero' );
if( empty( $sectionData ) ) {
  return;
}
$slideItems = [];
foreach( $sectionData as $section ) {
  ob_start();
  ?>
  <div class="hero__item">
    <?= wp_get_attachment_image( $section['banner'], 'full', false, ['class' => 'hero__item-banner'] ) ?>
    <div class="hero__item-content">
      <?php if( !empty( $section['sub_title'] ) ) : ?>
        <span class="hero__item-sub-title"><?= esc_html( $section['sub_title'] ) ?></span>
      <?php endif ?>
      <?php if( !empty( $section['title'] ) ) : ?>
        <h2 class="hero__item-title"><?= esc_html( $section['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $section['description'] ) ) : ?>
        <div class="hero__item-description"><?= wp_kses_post( $section['description'] ) ?></div>
      <?php endif ?>
      <?php if( !empty( $section['link_to']['label'] ) ) {
        get_template_part( 'gpw-templates/global/jins-button', null, [
          'label'    => $section['link_to']['label'],
          'href'     => Utils::getUrl( $section['link_to'] ),
          'variant'  => $section['link_to']['style'],
          'size'     => 'medium',
          'position' => 'center',
        ] );
      } ?>
    </div>
  </div>
  <?php
  $slideItems[] = ob_get_clean();
}
$section = $sectionData[0];
?>
<section class="hero">
  <div class="section__inner" data-width="full">
    <?php get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true, 'has_pagination' => true ] ) ?>
  </div>
</section>