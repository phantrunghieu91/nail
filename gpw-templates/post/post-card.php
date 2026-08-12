<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Template: Post - Post card
 * ! Arguments:
 * - orientation: horizontal | vertical
 * - displayDate: true | false
 * - displayExcerpt: true | false
 * - haveReadMore: true | false
 */
$orientation    = $args['orientation']     ?? 'vertical';
$displayDate    = $args['display_date']    ?? true;
$displayExcerpt = $args['display_excerpt'] ?? true;
$haveReadMore   = $args['have_read_more']  ?? true;

$postID          = get_the_ID();
$postThumbnailID = get_post_thumbnail_id() ?: PLACEHOLDER_IMAGE_ID;
$title           = get_the_title();
$url             = get_permalink();
$postedDate      = get_the_date( 'M d, Y' );
$excerpt         = wp_trim_words( get_the_excerpt(), 30 );

$class = 'jins-card';
?>
<article <?php post_class( $class ) ?> aria-orientation="<?= esc_attr( $orientation ) ?>" data-variant="padded">
  <a href="<?= $url ?>" class="<?= esc_attr( "{$class}__thumbnail" ) ?>"><?= wp_get_attachment_image( $postThumbnailID, 'medium_large', false, [ 'alt' => $title ] ) ?></a>
  <div class="<?= esc_attr( "{$class}__content" ) ?>">
    <h4 class="<?= esc_attr( "{$class}__title" ) ?> line-clamp">
      <a href="<?= $url ?>"><?= esc_html( $title ) ?></a>
    </h4>
    <?php if( $displayExcerpt ) : ?>
      <div class="<?= esc_attr( "{$class}__excerpt line-clamp" ) ?>"><?= wp_kses_post( $excerpt ) ?></div>
    <?php endif ?>
    <?php if( $displayDate || $haveReadMore ) : ?>
      <div class="<?= esc_attr( "{$class}__meta" ) ?>">
        <?php if( $displayDate ) : ?>
          <span class="<?= esc_attr( "{$class}__date" ) ?>"><?= esc_html( $postedDate ) ?></span>
        <?php endif ?>
        <?php if( $haveReadMore ) {
          get_template_part( 'gpw-templates/global/jins-button', false, [
            'class' => 'jins-card__read-more',
            'label' => __( 'Read more', 'gpw' ),
            'href'  => $url,
          ] );
        } ?>
      </div>
    <?php endif ?>
  </div>
</article>