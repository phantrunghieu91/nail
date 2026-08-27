<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Pricing page - Packages section
 */
$sectionData = get_field( 'special_package' );
if( empty ( $sectionData['package'] ) ) {
  return;
}
?>
<section class="packages">
  <div class="section__inner" data-width="extra-large">
    <?php if( !empty( $sectionData['title'] ) ) : ?>
    <header class="packages__header">
      <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php if( $sectionData['description'] ) : ?>
        <div class="section__description section__description--center"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </header>
    <?php endif ?>
    <main class="packages__main">
      <?php foreach( $sectionData['package'] as $package ) :
        $slideItems = [];
        $slug = sanitize_title( $package['name'] );
        foreach( $package['images'] as $imgID ) {
          $slideItems[] = sprintf( '<a href="%s" data-fancybox="gallery-%s">%s</a>',
            wp_get_attachment_image_url( $imgID, 'full' ),
            esc_attr( $slug ),
            wp_get_attachment_image( $imgID, 'large', false, ['alt' => $package['name'] ] )
          );
        }
        ?>
        <article class="jins-card packages__item" data-slug="<?= esc_attr( $slug ) ?>">
          <div class="jins-card__thumbnail">
            <?php if( empty( $slideItems ) ) {
              wp_get_attachment_image( PLACEHOLDER_IMAGE_ID, 'large', false, ['alt' => $package['name']] );
            } else {
              get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true ] );
            } ?>
          </div>
          <div class="jins-card__content">
            <?php if( !empty( $package['name'] ) ) : ?>
              <h3 class="jins-card__title"><?= esc_html( $package['name'] ) ?></h3>
            <?php endif ?>
            <?php if( !empty( $package['description'] ) ) : ?>
              <div class="jins-card__excerpt"><?= wp_kses_post( $package['description'] ) ?></div>
            <?php endif ?>
            <div class="packages__item-meta">
              <?php if( !empty( $package['place'] ) ) : ?>
                <p class="packages__item-place"><?= esc_html( $package['place'] ) ?></p>
              <?php endif ?>
              <?php if( !empty( $package['price'] ) ) : ?>
                <div class="packages__item-price-wrapper">
                  <?= jins_render_price( $package['price'], 'packages__item' ) ?>
                </div>
              <?php endif ?>
            </div>
          </div>
        </article>
      <?php endforeach ?>
    </main>
  </div>
</section>