<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Footer - Main section
 */
$data         = get_field( 'footer_main', 'jins_settings' );
$footerMenuID = 5;
$menuItems    = wp_get_nav_menu_items( $footerMenuID );
$companyInfo  = gpweb\inc\controller\CompanyInfo::getInstance();
$socials      = $companyInfo->getSocials();
?>
<section class="footer__main">
  <div class="section__inner">
    <div class="footer__menu">
      <?php if( !empty( $menuItems ) ) : ?>
      <ul class="footer__menu-list">
        <?php foreach( $menuItems as $menuItem ) :
          if( $menuItem->post_parent !== 0 ) continue;
          $isCurrent = get_queried_object_id() === intval( $menuItem->object_id );
          ?>
        <li class="footer__menu-item" <?= $isCurrent ? 'aria-current="page"' : '' ?> >
          <a href="<?= esc_url( $menuItem->url ) ?>"><?= esc_html( $menuItem->title ) ?></a>
        </li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>
      <?php if( !empty( $socials ) ): ?>
        <ul class="footer__socials">
          <?php foreach( $socials as $social ) : ?>
            <li class="footer__social">
              <a href="<?= esc_url( $social['link'] ) ?>" class="footer__social-link">
                <?= wp_get_attachment_image( $social['icon'], 'thumbnail', true, [ 'class' => 'footer__social-icon' ] ) ?>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      <?php endif ?>
    </div>
    <?php if( !empty( $data['subscribe_form']['ctf7_sc'] ) ) : ?>
      <div class="footer__subscribe">
        <?php if( !empty( $data['subscribe_form']['title'] ) ) : ?>
          <h3 class="footer__title"><?= esc_html( $data['subscribe_form']['title'] ) ?></h3>
        <?php endif ?>
        <?= do_shortcode( $data['subscribe_form']['ctf7_sc'] ) ?>
      </div>
    <?php endif ?>
  </div>
</section>