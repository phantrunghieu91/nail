<?php
/**
 * Button 1 element.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.19.0
 */
$variant  = get_theme_mod('jins_header_button_variant', 'link');
$size     = get_theme_mod('jins_header_button_size', 'extra-small');
$size     = $size !== 'extra-small' ? $size : '';
$iconCode = get_theme_mod('jins_header_button_icon', '');

$buttonArgs = [
  'label'   => get_theme_mod('jins_header_button_label', 'Jins button'),
  'href'    => get_theme_mod('jins_header_button_link', ''),
  'variant' => $variant,
  'theme'   => get_theme_mod('jins_header_button_theme', 'primary'),
  'size'    => $size,
  'rounded' => get_theme_mod('jins_header_button_rounded', 'none'),
];

if (!empty($iconCode) && $iconCode !== 'none') {
    $buttonArgs['icon_code'] = $iconCode;
}
?>
<li class="html header-button-1">
	<div class="header-button">
		<?php get_template_part('gpw-templates/global/jins-button', null, $buttonArgs); ?>
	</div>
</li>
