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