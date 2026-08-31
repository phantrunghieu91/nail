<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Global - Sub banner section
 */
$bannerImg = get_field('banner');
if( empty( $bannerImg )) {
  return;
}
?>
<section class="jins-banner">
  <div class="section__inner" data-width="full">
    <?= wp_get_attachment_image( $bannerImg['ID'], 'full', false, [ 'class' => 'jins-banner__image' ]) ?>
  </div>
</section>