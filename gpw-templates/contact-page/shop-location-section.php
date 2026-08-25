<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Contact page - Shop location section
 */
$sectionData = get_field( 'address_with_map' );
if( empty( $sectionData['shop'] ) ) {
  return;
}
$navItems   = [];
$panelItems = [];
foreach( $sectionData['shop'] as $shop ) {
  if( empty( $shop['name'] ) && empty( $shop['google_map'] ) ) continue;
  $id         = sanitize_title( $shop['name'] );
  $navItems[] = [
    'id'    => $id,
    'title' => $shop['name'],
  ];
  $addressHTML = !empty( $shop['address'] ) ? sprintf( '<p class="shop__address">%s</p>', esc_html( $shop['address'] ) ) : '';
  $descriptionHTML = !empty( $shop['description'] ) ? sprintf( '<div class="shop__description">%s</div>',  wp_kses_post( $shop['description'] ) ) : '';
  $googleMapHTML = !empty( $shop['google_map'] ) ? '<div class="shop__google-map">' . preg_replace( '/width="\d+"|height="\d+"/', '', $shop['google_map'] ) . '</div>' : '';
  $panelItems[] = [
    'id'      => $id,
    'content' => '<div class="shop"><h3 class="shop__name">' . esc_html( $shop['name'] ) . '</h3>' . $descriptionHTML . $addressHTML . $googleMapHTML . '</div>',
  ];
}
?>
<section class="shop-locations">
  <div class="section__inner">
    <header class="shop-locations__header">
      <?php if( $sectionData['title'] ): ?>
        <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
    </header>
    <main class="shop-locations__main">
      <?php get_template_part( 'gpw-templates/global/tabs/tabs-nav', null, [
        'nav_items' => $navItems,
        'style'     => 'underline'
      ] ) ?>
      <?php get_template_part( 'gpw-templates/global/tabs/tabs-content', null, [
        'panels' => $panelItems,
      ] ) ?>
    </main>
  </div>
</section>