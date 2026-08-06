<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Home page - Why choose us
 */
use gpweb\inc\base\Utilities as Utils;
$sectionData = get_field( 'why_choose_us' );
if( empty( $sectionData['reason'] ) ) {
  return;
}
?>
<section class="why-choose-us">
  <div class="section__inner">
    <header class="why-choose-us__header">
      <?php if( !empty( $sectionData['sub_title'] ) ) : ?>
        <span class="section__sub-title"><?= esc_html( $sectionData['sub_title'] ) ?></span>
      <?php endif ?>
      <?php if( !empty( $sectionData['title'] ) ) : ?>
        <h2 class="section__title"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ) : ?>
        <div class="section__description"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </header>
    <main class="why-choose-us__reasons">
      <?php foreach( $sectionData['reason'] as $reason ) :
        $url = Utils::getUrl( $reason['link_to'] );
        ?>
        <article class="jins-card why-choose-us__reason">
          <a href="<?= $url ?>" class="jins-card__thumbnail">
            <?= wp_get_attachment_image( $reason['image'], 'medium_large', false, [ 'alt' => $reason['label'] ] ) ?>
          </a>
          <div class="jins-card__content">
            <?php if( !empty( $reason['label'] ) ) : ?>
            <h3 class="jins-card__title line-clamp">
              <a href="<?= $url ?>"><?= esc_html( $reason['label'] ) ?></a>
            </h3>
            <?php endif ?>
            <?php if( !empty( $reason['description'] ) ) : ?>
              <div class="jins-card__excerpt line-clamp"><?= wp_kses_post( $reason['description'] ) ?></div>
            <?php endif ?>
            <?php if( !empty( $reason['link_to']['label'] ) ) {
              get_template_part( 'gpw-templates/global/jins-button', null, [
                'label'   => $reason['link_to']['label'],
                'href'    => $url,
                'class'   => 'jins-card__read-more',
                'variant' => 'outline',
                'size'    => 'medium',
                'rounded' => 'full',
                'position' => 'center'
              ] );
            } ?>
          </div>
        </article>
        <?php endforeach ?>
    </main>
  </div>
</section>

