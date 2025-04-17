<?php

// Add the typography panel.
$wp_customize->add_panel('total_typography_panel', array(
    'priority' => 20,
    'title' => esc_html__('Typography Settings', 'total')
));

// Add the body typography section.
$wp_customize->add_section('total_body_typography_section', array(
    'panel' => 'total_typography_panel',
    'title' => esc_html__('Body', 'total')
));

$wp_customize->add_setting('total_body_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_body_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_body_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_body_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_body_size', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('total_body_line_height', array(
    'default' => '1.6',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_body_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_body_color', array(
    'default' => '#444444',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new Total_Typography_Control($wp_customize, 'total_body_typography', array(
    'label' => esc_html__('Body Typography', 'total'),
    'description' => __('Select how you want your body to appear.', 'total'),
    'section' => 'total_body_typography_section',
    'settings' => array(
        'family' => 'total_body_family',
        'style' => 'total_body_style',
        'text_decoration' => 'total_body_text_decoration',
        'text_transform' => 'total_body_text_transform',
        'size' => 'total_body_size',
        'line_height' => 'total_body_line_height',
        'letter_spacing' => 'total_body_letter_spacing',
        'color' => 'total_body_color'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 40,
        'step' => 1
    )
)));


// Add Header typography section.
$wp_customize->add_section('total_header_typography_section', array(
    'panel' => 'total_typography_panel',
    'title' => esc_html__('Header', 'total')
));

// Add H typography section.
$wp_customize->add_setting('total_h_family', array(
    'default' => 'Oswald',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_h_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_h_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_h_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_h_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('total_h_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(new Total_Typography_Control($wp_customize, 'total_h_typography', array(
    'label' => esc_html__('Header Typography', 'total'),
    'description' => __('Select how you want your Header to appear.', 'total'),
    'section' => 'total_header_typography_section',
    'settings' => array(
        'family' => 'total_h_family',
        'style' => 'total_h_style',
        'text_decoration' => 'total_h_text_decoration',
        'text_transform' => 'total_h_text_transform',
        'line_height' => 'total_h_line_height',
        'letter_spacing' => 'total_h_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

