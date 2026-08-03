<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Handle override Flatsome customizer
 */
namespace gpweb\inc\controller;
use WP_Customize_Manager;
class OverrideFlatsomeCustomizer {
  private static OverrideFlatsomeCustomizer $instance;
  public static function getInstance() {
    if( !isset( self::$instance ) ) {
      self::$instance = new OverrideFlatsomeCustomizer();
    }
    return self::$instance;
  }
  public function register() {
    add_action( 'init', [ $this, 'removeFlatsomeCustomize' ], 100 );
    add_action( 'customize_register', [ $this, 'jinsRefreshHeaderButtonsPartials'], 100 );
  }
  public function removeFlatsomeCustomize() {
    remove_action( 'customize_register', 'flatsome_refresh_header_buttons_partials' );
  }
  public function jinsRefreshHeaderButtonsPartials( WP_Customize_Manager $wp_customize ) {
    // ! remove flatsome header buttons settings and control
    foreach( array_keys( $wp_customize->controls() ) as $key ) {
      if( str_contains( $key, 'header_button_' ) ) {
        $this->jinsRemoveFlatsomeControlAndSetting( $wp_customize, $key );
      }
    }
    $this->jinsRemoveFlatsomeControlAndSetting( $wp_customize, 'custom_title_button_1' );
    $this->jinsRemoveFlatsomeControlAndSetting( $wp_customize, 'custom_title_button_2' );

    // * Register my own buttons
    $buttonSection = 'header_buttons';
    $fields        = [
      [
        'id'          => 'jins_header_button_label',
        'type'        => 'text',
        'sanitize_cb' => 'sanitize_text_field',
        'default'     => "Jin's button",
        'label'       => _x( 'Button label', 'Header button customize', 'gpw' ),
      ],
      [
        'id'          => 'jins_header_button_link',
        'type'        => 'text',
        'sanitize_cb' => 'esc_url_raw',
        'default'     => "",
        'label'       => _x( 'Button link', 'Header button customize', 'gpw' ),
      ],
      [
        'id'      => 'jins_header_button_variant',
        'type'    => 'select',
        'label'   => _x( 'Button variant', 'Header button customize', 'gpw' ),
        'default' => 'link',
        'choices' => [
          'link'     => _x( 'Link', 'Header button customize variants', 'gpw' ),
          'filled'   => _x( 'Filled', 'Header button customize variants', 'gpw' ),
          'outline'  => _x( 'Outlined', 'Header button customize variants', 'gpw' ),
          'gradient' => _x( 'Gradient', 'Header button customize variants', 'gpw' ),
          'slide-bg' => _x( 'Slide Background', 'Header button customize variants', 'gpw' ),
        ],
      ],
      [
        'id'      => 'jins_header_button_theme',
        'type'    => 'select',
        'label'   => _x( 'Button theme', 'Header button customize', 'gpw' ),
        'default' => 'none',
        'choices' => [
          'none'      => _x( 'None', 'Header button customize theme', 'gpw' ),
          'primary'   => _x( 'Primary', 'Header button customize theme', 'gpw' ),
          'secondary' => _x( 'Secondary', 'Header button customize theme', 'gpw' ),
        ],
      ],
      [
        'id'      => 'jins_header_button_size',
        'type'    => 'select',
        'label'   => _x( 'Button size', 'Header button customize', 'gpw' ),
        'default' => 'extra-small',
        'choices' => [
          'extra-small' => _x( 'Extra-small', 'Header button customize size', 'gpw' ),
          'small'       => _x( 'Small', 'Header button customize size', 'gpw' ),
          'medium'      => _x( 'Medium', 'Header button customize size', 'gpw' ),
          'large'       => _x( 'Large', 'Header button customize size', 'gpw' ),
        ],
      ],
      [
        'id'      => 'jins_header_button_rounded',
        'type'    => 'select',
        'label'   => _x( 'Button rounded', 'Header button customize', 'gpw' ),
        'default' => 'none',
        'choices' => [
          'none'   => _x( 'None', 'Header button customize rounded', 'gpw' ),
          'small'  => _x( 'Small', 'Header button customize rounded', 'gpw' ),
          'medium' => _x( 'Medium', 'Header button customize rounded', 'gpw' ),
          'large'  => _x( 'Large', 'Header button customize rounded', 'gpw' ),
          'full'   => _x( 'Full', 'Header button customize rounded', 'gpw' ),
        ],
      ],
      [
        'id'      => 'jins_header_button_icon',
        'type'    => 'select',
        'label'   => _x( 'Button icon (Google icon)', 'Header button customize', 'gpw' ),
        'default' => 'none',
        'choices' => [
          'none'                 => _x( 'None', 'Header button customize icon', 'gpw' ),
          'arrow_outward'        => _x( 'Arrow Outward', 'Header button customize icon', 'gpw' ),
          'keyboard_arrow_right' => _x( 'Chevron right', 'Header button customize icon', 'gpw' ),
          'call'                 => _x( 'Phone', 'Header button customize icon', 'gpw' ),
        ],
      ],
    ];
    foreach( $fields as $field ) {
      $wp_customize->add_setting( $field['id'], [
        'default'           => $field['default'],
        'sanitize_callback' => $field['sanitize_cb'] ?? false,
        'transport'         => 'postMessage',
      ] );
      $ctrlArgs = [
        'type'     => $field['type'],
        'label'    => $field['label'],
        'section'  => $buttonSection,
        'settings' => $field['id'],
      ];
      if( isset( $field['choices'] ) && !empty( $field['choices'] ) ) {
        $ctrlArgs['choices'] = $field['choices'];
      }
      $wp_customize->add_control( $field['id'], $ctrlArgs );
    }

    $settings = wp_list_pluck( $fields, 'id' );

    if( isset( $wp_customize->selective_refresh ) ) {
      $wp_customize->selective_refresh->add_partial( $field['id'], [
        'selector'            => '.jin-header-button',
        'container_inclusive' => true,
        'settings'            => $settings,
        'render_callback'     => function() {
          get_template_part( 'template-parts/header/partials/element-button' );
        },
      ] );
    }
  }
  private function jinsRemoveFlatsomeControlAndSetting( $wp_customize, $key ) {
    $wp_customize->remove_control( $key );
    $wp_customize->remove_setting( $key );
  }
}