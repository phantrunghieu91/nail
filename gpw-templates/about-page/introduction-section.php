<?php 
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: About page - Introduction section
 */
$sectionData = get_field('introduction');
if( empty( $sectionData )) {
  return;
}
?>
<section class="introduction">
  <div class="section__inner">
    <?php foreach( $sectionData as $block ) : ?>
      <div class="introduction__block">
        <?php if( !empty( $block['image'] )) {
          echo wp_get_attachment_image( $block['image'], 'large', false, [ 'class' => 'introduction__block-image', ]);
        } ?>
        <div class="introduction__block-content">
          <?php if( !empty( $block['sub_title'] )) : ?>
            <span class="section__sub-title"><?= esc_html( $block['sub_title'] ) ?></span>
          <?php endif ?>
          <?php if( !empty( $block['title'] )) : ?>
            <h2 class="section__title"><?= esc_html( $block['title'] ) ?></h2>
          <?php endif ?>
          <?php if( !empty( $block['content'] )) : ?>
            <div class="section__content"><?= wp_kses_post( $block['content'] ) ?></div>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</section>