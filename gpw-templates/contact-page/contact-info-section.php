<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: CONTACT PAGE - Contact information section
 */
$sectionData = get_field( 'contact_information' );
if( empty( $sectionData['cf7_sc'] ) ) {
  return;
}
$companyInfo = gpweb\inc\controller\CompanyInfo::getInstance();
$email = $companyInfo->getEmail();
$phone = $companyInfo->getPhoneNumber();
$socials = $companyInfo->getSocials();
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
      <aside class="contact-information__info">
        <?php if( !empty( $sectionData['contact_content']['title'] ) ): ?>
          <h3 class="contact-information__title"><?= esc_html( $sectionData['contact_content']['title'] ) ?></h3>
        <?php endif ?>
        <?php if( !empty( $email ) ) : ?>
          <p class="contact-information__info-item email">
            <strong><?= __('Email', 'gpweb') ?>: </strong>
            <a href="mailto:<?= esc_attr( $email ) ?>"><?= esc_html( $email ) ?></a>
          </p>
        <?php endif ?>
        <?php if( !empty( $phone ) ) : ?>
          <p class="contact-information__info-item phone">
            <strong><?= __('Phone number', 'gpweb') ?>: </strong>
            <a href="tel:<?= esc_attr( $phone ) ?>"><?= esc_html( $phone ) ?></a>
          </p>
        <?php endif ?>
        <?php if( !empty( $socials )): ?>
          <ul class="contact-information__socials">
            <?php foreach( $socials as $social ) : ?>
              <li class="contact-information__social">
                <a href="<?= !empty( $social['link']) ? esc_url( $social['link'] ) : 'javascript:void(0);' ?>" class="contact-information__social-link">
                  <?= wp_get_attachment_image( $social['icon'], 'thumbnail', true, [ 'class' => 'contact-information__social-icon' ] ) ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </aside>
      <?= do_shortcode( $sectionData['cf7_sc'] ) ?>
    </main>
  </div>
</section>