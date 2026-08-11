<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: CONTACT PAGE - Contact information section
 */
$sectionData = get_field( 'contact_information' );
if( empty( $sectionData['cf7_sc'] ) ) {
  return;
}
?>
<section class="contact-information">
  <div class="section__inner">
    <header class="contact-information__header">
      <?php if( !empty( $sectionData['title'] ) ) : ?>
        <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ) : ?>
        <div class="section__description section__description--center"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </header>
    <main class="contact-information__main">
      <?php if( !empty( $sectionData['extra_content'] ) ): ?>
      <aside class="contact-information__extra-content">
        <?php foreach( $sectionData['extra_content'] as $content ) :
          if( empty( $content['label'] ) && empty( $content['content'] ) ) continue;
          ?>
          <div class="contact-information__content">
            <?php if( !empty( $content['label'] ) ) : ?>
              <h3 class="contact-information__content-title"><?= esc_html( $content['label'] ) ?></h3>
            <?php endif ?>
            <?php if( !empty( $content['content'] ) ) : ?>
              <div class="contact-information__content-desc"><?= wp_kses_post( $content['content'] ) ?></div>
            <?php endif ?>
          </div>
        <?php endforeach ?>
      </aside>
      <?php endif ?>
      <?= do_shortcode( $sectionData['cf7_sc'] ) ?>
    </main>
  </div>
</section>