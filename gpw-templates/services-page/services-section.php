<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Services page - Services section
 */
use gpweb\inc\base\Utilities as Utils;
$sectionData = get_field( 'services' );
if( empty( $sectionData['service'] ) ) {
  return;
}
?>
<section class="services">
  <div class="section__inner">
    <?php if( !empty( $sectionData['title'] ) ) : ?>
      <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
    <?php endif ?>
    <?php if( !empty( $sectionData['description'] ) ) : ?>
      <div class="section__description section__description--center"><?= wp_kses_post( $sectionData['description'] ) ?></div>
    <?php endif ?>
    <div class="services__grid">
      <?php foreach( $sectionData['service'] as $service ):
        $slug = sanitize_title( $service['label'] );
        $url = Utils::getUrl( $service['link_to'] );
        if( $slug ) {
          $url .= "#$slug";
        }
        ?>
        <article class="service jins-card" data-variant="padded">
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
              get_template_part( 'gpw-templates/global/jins-button', null, [
                'label' => $service['link_to']['label'],
                'href'  => $url,
                'class' => 'jins-card__read-more'
              ] );
            } ?>
          </div>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>