<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Helper functions
 */
if( !function_exists( 'jins_render_image' ) ) {
  function jins_render_image( $img_id, $size = 'medium', $wrapper_class = '', $image_options = [] ) {
    $classes = ['jins-image-wrapper'];
    $classes = [ ...$classes, ...explode( ' ', $wrapper_class ) ];
    return sprintf( '<div class="%s">%s</div>',
      implode( ' ', $classes ),
      wp_get_attachment_image( $img_id, $size, false, $image_options )
    );
  }
}

if( !function_exists( 'jins_render_price' ) ) {
  function jins_render_price( $price_text, $class ) {
    if( empty( $price_text ) ) {
      return '';
    }
    return sprintf( '<div class="%s-price">%s</div><span class="general-price__service-price-note">%s</span>',
      $class ? esc_attr( $class ) : 'jins',
      esc_html( $price_text ),
      __( '(inclusive of GST)', 'gpw' )
    );
  }
}