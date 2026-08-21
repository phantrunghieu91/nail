<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Global - Hero section
 */
$sectionData = get_field('hero');
if( empty( $sectionData['banner'] )) {
  return;
}
?>
<section class="hero">
  <?= wp_get_attachment_image( $sectionData['banner'], 'full', false, ['class' => 'hero__bg', 'alt' => 'Hero banner']) ?>
  <div class="section__inner">
    <?php if( true === $sectionData['show_page_title'] ) : ?>
      <h1 class="hero__title"><?= get_the_title() ?></h1>
    <?php endif ?>
  </div>
</section>
