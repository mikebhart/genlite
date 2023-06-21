<?php

function genlite_customize_register( $wp_customize ) {

$wp_customize->add_panel('genlite_home_theme_panel', array(
    'priority' => 4,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => esc_html__('Theme Options', 'genlite'),
    'description' => esc_html__('Change your theme settings here.', 'genlite'),
));

  //  =============================
  //  = General Settings          =
  //  =============================


$wp_customize->add_section( 'genlite_general_section', array(
  'priority'       => 16,
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __( 'General Settings', 'genlite' ),
  'description'    => esc_html__( 'Change your General Settings here.', 'genlite' ),
  'panel'          => 'genlite_home_theme_panel',
) );


// Header Code
$wp_customize->add_setting( 'genlite_general_headercode', array(
   'type'   => 'theme_mod',
   'sanitize_callback' => 'genlite_sanitize_scriptcode'
));

$wp_customize->add_control( 'genlite_general_headercode', array(
    'type' => 'textarea',
    'section' => 'genlite_general_section', // // Add a default or your own section
    'label' => __('Header Code','genlite'),
    'description' => __('Add your Header Code e.g. Google Analytics.','genlite'),
    'priority' => 5
));

// Body Code
$wp_customize->add_setting( 'genlite_general_bodycode', array(
    'type'   => 'theme_mod',
    'sanitize_callback' => 'genlite_sanitize_scriptcode'
 ));
 
 $wp_customize->add_control( 'genlite_general_bodycode', array(
     'type' => 'textarea',
     'section' => 'genlite_general_section', // // Add a default or your own section
     'label' => __('Body Code','genlite'),
     'description' => __('Add your Body Code e.g. Google Tag Manager.','genlite'),
     'priority' => 6
 ));

 // Show Load Lightbox
 $wp_customize->add_setting( 'genlite_general_lightbox' , array(
  'type'   => 'theme_mod',
  'sanitize_callback' => 'genlite_sanitize_checkbox'
));

$wp_customize->add_control( 'genlite_general_lightbox', array(
 'type' => 'checkbox',
 'label' =>__('Load Lightbox','genlite'),
 'section' => 'genlite_general_section',
 'priority' => 7
));


 // Show Shop Filter
 $wp_customize->add_setting( 'genlite_general_shop_filter' , array(
  'type'   => 'theme_mod',
  'sanitize_callback' => 'genlite_sanitize_checkbox'
));

$wp_customize->add_control( 'genlite_general_shop_filter', array(
 'type' => 'checkbox',
 'label' =>__('Show Shop Filter','genlite'),
 'section' => 'genlite_general_section',
 'priority' => 8
));

  //  =============================
  //  = Social Icons              =
  //  =============================

$genlite_social_links = $GLOBALS[GENLITE_SOCIAL_IDS];


$wp_customize->add_section( 'genlite_social_section', array(
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __( 'Social', 'genlite' ),
  'description'    => esc_html__( 'Paste your Social Media Link Urls in here. Max of 9', 'genlite' ),
  'panel'          => 'genlite_home_theme_panel',
));


  for($ii=0, $array_length=count($genlite_social_links); $ii<$array_length; $ii++) {

      $socialId = GENLITE_SOCIAL_PREFIX . $genlite_social_links[$ii];
      $socialDisplayName = genlite_social_get_display_name($genlite_social_links[$ii]) . ' URL';

      $wp_customize->add_setting( $socialId , array(
         'default'     => '',
         'type'   => 'theme_mod',
         'sanitize_callback' => 'esc_url_raw'
      ));

      $wp_customize->add_control($socialId, array(
        'label' =>$socialDisplayName,
        'section' => 'genlite_social_section',
        'type'   => 'text'
      ));

  }

}
add_action( 'customize_register', 'genlite_customize_register' );


function genlite_sanitize_scriptcode( $value ) {
  return $value;
}

function genlite_sanitize_checkbox( $checked ) {
  // Boolean check.
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function genlite_sanitize_radio( $input, $setting ) {
         
  //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
  $input = sanitize_key($input);
 
  //get the list of possible radio box options 
  $choices = $setting->manager->get_control( $setting->id )->choices;
                         
  //return input if valid or return default option
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
             
}