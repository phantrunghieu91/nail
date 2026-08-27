<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Pricing page - General price section
 */
$sectionData = get_field( 'general_price' );
if( empty( $sectionData['service_group'] ) ) {
  return;
}
function displayService( $serviceData ) {
  ?>
  <article class="general-price__services" aria-orientation="<?= esc_attr( $serviceData['display_style'] ) ?>">
    <?php if( !empty( $serviceData['image'] ) ) {
      echo wp_get_attachment_image( $serviceData['image'], 'large', false, [ 'class' => 'general-price__services-image', 'alt' => $serviceData['name']] );
    } ?>
    <div class="general-price__services-content">
      <?php if( !empty( $serviceData['name'] ) ): ?>
        <h4 class="general-price__services-name"><?= esc_html( $serviceData['name'] ) ?></h4>
      <?php endif ?>
      <?php if( !empty( $serviceData['description'] ) ): ?>
        <div class="general-price__services-desc"><?= wp_kses_post( $serviceData['description'] ) ?></div>
      <?php endif ?>
      <?php if( !empty( $serviceData['table'] ) ): ?>
        <ul class="general-price__services-list">
          <?php foreach( $serviceData['table'] as $item ) : ?>
            <li class="general-price__service">
              <?php if( !empty( $item['name'] ) ) :?>
                <h5 class="general-price__service-name"><?= esc_html( $item['name' ] ) ?></h5>
              <?php endif ?>
              <?php if( !empty( $item['description'] ) ) :?>
                <div class="general-price__service-description"><?= wp_kses_post( $item['description' ] ) ?></div>
              <?php endif ?>
              <?php if( !empty( $item['price'] ) ) {
                echo jins_render_price( $item['price'], 'general-price__service' );
              } ?>
              
            </li>
          <?php endforeach ?>
        </ul>
      <?php endif ?>
    </div>
  </article>
  <?php
}
?>
<section class="general-price">
  <div class="section__inner">
    <?php if( !empty( $sectionData['title'] ) ) : ?>
    <header class="general-price__header">
      <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php if( $sectionData['description'] ) : ?>
        <div class="section__description section__description--center"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </header>
    <?php endif ?>
    <main class="general-price__main">
      <?php foreach( $sectionData['service_group'] as $serviceGroup ) :
        if( empty( $serviceGroup['price'] ) ) continue;
        $serviceGroupID = sanitize_title( $serviceGroup['title'] );
        ?>
        <div class="general-price__services-group" id="<?= esc_html( $serviceGroupID ) ?>">
          <?php if( true === $serviceGroup['show_group_title'] ) : ?>
            <h3 class="general-price__services-group-title"><?= esc_html( $serviceGroup['title'] ) ?></h3>
          <?php endif ?>
          <?php foreach( $serviceGroup['price'] as $price ) {
            if( empty( $price ) ) continue;
            displayService( $price );
          } ?>
        </div>
      <?php endforeach ?>
    </main>
  </div>
</section>