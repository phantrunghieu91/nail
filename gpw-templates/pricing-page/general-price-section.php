<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Pricing page - General price section
 */
$sectionData = get_field( 'general_price' );
if( empty( $sectionData['price'] ) ) {
  return;
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
      <?php foreach( $sectionData['price'] as $price ) :
        if( empty( $price['table'] ) ) continue;
        $serviceID = sanitize_title( $price['name'] );
        ?>
        <article class="general-price__services" id="<?= esc_attr( $serviceID ) ?>" aria-orientation="<?= esc_attr( $price['display_style'] ) ?>">
          <?php if( !empty( $price['image'] ) ) {
            echo wp_get_attachment_image( $price['image'], 'large', false, [ 'class' => 'general-price__services-image', 'alt' => $price['name']] );
          } ?>
          <div class="general-price__services-content">
            <?php if( !empty( $price['name'] ) ): ?>
              <h3 class="general-price__services-name"><?= esc_html( $price['name'] ) ?></h3>
            <?php endif ?>
            <?php if( !empty( $price['description'] ) ): ?>
              <div class="general-price__services-desc"><?= esc_html( $price['description'] ) ?></div>
            <?php endif ?>
            <ul class="general-price__services-list">
              <?php foreach( $price['table'] as $item ) : ?>
                <li class="general-price__service">
                  <?php if( !empty( $item['name'] ) ) :?>
                    <h4 class="general-price__service-name"><?= esc_html( $item['name' ] ) ?></h4>
                  <?php endif ?>
                  <?php if( !empty( $item['description'] ) ) :?>
                    <div class="general-price__service-description"><?= esc_html( $item['description' ] ) ?></div>
                  <?php endif ?>
                  <?php if( !empty( $item['price'] ) ) {
                    echo jins_render_price( $item['price'], 'general-price__service' );
                  } ?>
                  
                </li>
              <?php endforeach ?>
            </ul>
          </div>
        </article>
      <?php endforeach ?>
    </main>
  </div>
</section>