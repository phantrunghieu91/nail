<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Home page - Services section
 */
use gpweb\inc\base\Utilities as Utils;
$sectionData = get_field( 'our_services' );
if( empty( $sectionData['service'] ) ) {
  return;
}
?>
<section class="our-services">
  <div class="section__inner">
    <div class="our-services__title-wrapper">
      <?php if( !empty( $sectionData['sub_title'] ) ) : ?>
        <span class="section__sub-title"><?= esc_html( $sectionData['sub_title'] ) ?></span>
      <?php endif ?>
      <?php if( !empty( $sectionData['title'] ) ) : ?>
        <h2 class="section__title"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ) : ?>
        <div class="section__description"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </div>
    <div class="our-services__services">
      <div class="our-services__services-grid">
        <?php foreach( $sectionData['service'] as $service ) :
          $url = Utils::getUrl( $service['link_to'] );
          ?>
          <article class="jins-card our-services__item" data-variant="padded">
            <a href="<?= $url ?>" class="jins-card__thumbnail">
              <?= wp_get_attachment_image( $service['image'], 'medium_large', false, [ 'alt' => $service['label'] ] ) ?>
            </a>
            <div class="jins-card__content">
              <?php if( !empty( $service['label'] ) ) : ?>
              <h3 class="jins-card__title line-clamp">
                <a href="<?= $url ?>"><?= esc_html( $service['label'] ) ?></a>
              </h3>
              <?php endif ?>
              <?php if( !empty( $service['description'] ) ) : ?>
                <div class="jins-card__excerpt line-clamp"><?= wp_kses_post( $service['description'] ) ?></div>
              <?php endif ?>
              <?php if( !empty( $service['link_to']['label'] ) ) {
                get_template_part('gpw-templates/global/jins-button', null, [
                  'label' => $service['link_to']['label'],
                  'href' => $url,
                  'class' => 'jins-card__read-more'
                ]);
              } ?>
            </div>
          </article>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
   
 