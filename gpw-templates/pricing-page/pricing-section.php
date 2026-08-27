<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Pricing page - pricing section
 */
$sectionData = get_field( 'pricing' );
$pricingData = $sectionData['pricing_data'] ?: [];
if( empty( $pricingData ) ) {
  return;
}
?>
<section class="pricing">
  <div class="section__inner" data-width="extra-large">
    <header class="section__header">
      <?php if( !empty( $sectionData['title'] ) ): ?>
        <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ): ?>
        <div class="section__description section__description--center"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </header>
    <main class="pricing__table">
      <?php foreach( $pricingData as $pricing ) :
        $slug       = sanitize_title( $pricing['name'] );
        $slideItems = [];
        foreach( $pricing['images'] as $imgID ) {
          $slideItems[] = sprintf( '<a class="pricing__item-img" data-fancybox="service-%s" href="%s">%s</a>',
            esc_attr( $slug ),
            wp_get_attachment_image_url( $imgID, 'full' ),
            wp_get_attachment_image( $imgID, 'large' )
          );
        }
        ?>
        <article class="pricing__item" id="<?= esc_attr( $slug ) ?>">
          <?php if( !empty( $pricing['name'] ) ) : ?>
            <h3 class="pricing__item-title"><?= esc_html( $pricing['name'] ) ?></h3>
          <?php endif ?>
          <div class="pricing__item-images">
            <?php get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true ] ); ?>
          </div>
          <div class="pricing__item-menu">
            <?= wp_get_attachment_image( $pricing['menu_image'], 'large' ) ?>
          </div>
        </article>
      <?php endforeach ?>
    </main>
  </div>
</section>