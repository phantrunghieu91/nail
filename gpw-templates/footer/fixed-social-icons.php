<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Footer - Fixed social icons
 */
$data = get_field( 'fixed_social_icon', 'jins_settings' );
if( empty( $data ) ) {
  return;
}
$bookingFormSC = '[contact-form-7 id="7593bc8" title="GLOBAL: Booking form"]';
?>
<div class="fixed-social-icons">
  <ul class="fixed-social-icons__list">
    <?php foreach( $data as $social ): ?>
    <li class="fixed-social-icons__item" data-slug="<?= esc_attr( sanitize_title( $social['name'] ) ) ?>">
      <a href="<?= !empty( $social['link'] ) ? esc_url( $social['link'] ) : 'javascript:void(0);' ?>">
        <?= wp_get_attachment_image( $social['icon'], 'thumbnail', false, ['alt' => $social['name'] ] ) ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</div>
<div class="booking-popover" id="booking-popover" popover="auto">
  <button class="jins-button booking-popover__close-btn" type="button" popovertarget="booking-popover" popovertargetaction="hide">
    <i class="fa-solid fa-xmark"></i>
  </button>
  <h2 class="section__title section__title--center"><?= __( 'Booking form', 'gpw' ) ?></h2>
  <?= do_shortcode( $bookingFormSC ) ?>
</div>