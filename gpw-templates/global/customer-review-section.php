<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Global - Customer review
 */
$sectionData = get_field( 'customer_review' , 'jins_settings' );
if( empty( $sectionData['review'] ) || is_page([32]) ) {
  return;
}
$reviews         = $sectionData['review'];
$platforms       = $sectionData['platform'];
$tabNavItems     = [];
$tabPanelItems   = [];
$platformIconIds = [];
$backgroundImgID = $sectionData['background_image'];

function renderStars( $starNum ) {
  for( $i = 0; $i < $starNum; $i++ ) {
    echo '<i class="fa-solid fa-star"></i>';
  }
}

foreach( $platforms as $platform ) {
  $slug          = sanitize_title( $platform['name'] );
  $rating        = floatval( $platform['stars'] );
  $ratingCeil    = ceil( $rating );
  $reviewNum     = floatval( $platform['review_number'] );
  $tabNavItems[] = [
    'id'    => $slug,
    'title' => sprintf( '%s<span>%s</span>',
      !empty( $platform['icon'] ) ? wp_get_attachment_image( $platform['icon'], 'thumbnail', true ) : '',
      $platform['name']
    ),
  ];
  $platformIconIds[ $slug ] = $platform['icon'];
  ob_start();
  ?>
  <div class="customer-review__platform">
    <strong><?= esc_html( $platform['rating_text'] ) ?></strong>
    <div class="rating">
      <?php renderStars( $ratingCeil ) ?>
      <strong><?= esc_html( $rating ) ?></strong>
    </div>
    <strong class="number"><?= esc_html( number_format( $reviewNum, 0, '', ',' ) ) ?> <?= __('reviews', 'gpw') ?></strong>
  </div>
  <?php
  $tabPanelItems[] = [
    'id'      => $slug,
    'content' => ob_get_clean()
  ];
}
$slideItems = [];
foreach( $reviews as $review ) {
  $platform       = $review['platform'];
  $platformIconID = $platformIconIds[ $platform ];
  ob_start();
  ?>
  <article class="review" data-platform="<?= esc_attr( $platform ) ?>">
    <header class="review__header">
      <div class="review__avatar">
        <?= !empty( $review['avatar'] )
          ? wp_get_attachment_image( $review['avatar'], 'thumbnail', false, [ 'alt' => $review['name'] ] )
          : '<i class="fa-solid fa-circle-user"></i>' ?>
      </div>
      <?php if( !empty( $review['name'] ) ): ?>
        <strong class="review__name"><?= esc_html( $review['name'] ) ?></strong>
      <?php endif ?>
      <?php if( !empty( $review['meta'] ) ) : ?>
        <p class="review__meta"><?= esc_html( $review['meta'] ) ?></p>
      <?php endif ?>
      <?php if( !empty( $platformIconID ) ) {
        echo wp_get_attachment_image( $platformIconID, 'thumbnail', true, [ 'class' => 'review__platform-icon', 'alt' => $platform ] );
      } ?>
      <div class="review__rating">
        <?php renderStars( $review['stars'] ) ?>
      </div>
    </header>
    <main class="review__message line-clamp"><?= wp_kses_post( $review['feedback'] ) ?></main>
  </article>
  <?php
  $slideItems[] = ob_get_clean();
}
?>
<section class="customer-review"
  <?php if( !empty( $backgroundImgID ) ) echo sprintf( 'style="background-image:url(%s)";', wp_get_attachment_image_url( $backgroundImgID, 'full' ) ); ?>
>
  <div class="section__inner">
    <header class="customer-review__header">
      <?php if( !empty( $sectionData['sub_title'] ) ) : ?>
        <span class="section__sub-title section__sub-title--center"><?= esc_html( $sectionData['sub_title'] ) ?></span>
      <?php endif ?>
      <?php if( !empty( $sectionData['title'] ) ) : ?>
        <h2 class="section__title section__title--center"><?= esc_html( $sectionData['title'] ) ?></h2>
      <?php endif ?>
      <?php if( !empty( $sectionData['description'] ) ) : ?>
        <div class="section__description section__description--center"><?= wp_kses_post( $sectionData['description'] ) ?></div>
      <?php endif ?>
    </header>
    <main class="customer-review__main">
      <?php get_template_part( 'gpw-templates/global/tabs/tabs-nav', null, [
        'nav_items' => $tabNavItems,
        'style'     => 'underline'
      ] ) ?>
      <?php get_template_part( 'gpw-templates/global/tabs/tabs-content', null, [
        'panels' => $tabPanelItems
      ] ) ?>
      <div class="customer-review__carousel">
        <?php get_template_part( 'gpw-templates/global/swiper-template', null, [ 'slide_items' => $slideItems, 'has_nav' => true ] ) ?>
      </div>
    </main>
  </div>
</section>
