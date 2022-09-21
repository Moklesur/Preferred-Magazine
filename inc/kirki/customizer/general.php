<?php/** * General Setting */Preferred_Magazine_Kirki::add_panel('general_panel', array(    'priority' => 10,    'title' => esc_html__('General Settings', 'preferred-magazine'),    'description' => esc_html__('General Settings', 'preferred-magazine'),));// Site Layout SectionPreferred_Magazine_Kirki::add_section('site_layout_section', array(    'title' => esc_html__('Site Width', 'preferred-magazine'),    'panel' => 'general_panel',    'priority' => 10,));// Site LayoutPreferred_Magazine_Kirki::add_field('preferred_magazine', array(    'type' => 'radio-buttonset',    'settings' => 'site_layout',    'label' => __('Site Layout', 'preferred-magazine'),    'section' => 'site_layout_section',    'default' => 'wide',    'priority' => 10,    'choices' => array(        'wide' => esc_html__('Wide', 'preferred-magazine'),        'boxed' => esc_html__('Boxed', 'preferred-magazine'),    ),));// Body Background ImagePreferred_Magazine_Kirki::add_section('background_image', array(    'title' => __('Body Background Image', 'preferred-magazine'),    'theme_supports' => 'custom-background',    'panel' => 'general_panel',    'priority' => 20,));// Margin TopPreferred_Magazine_Kirki::add_field('preferred_magazine', array(    'type' => 'slider',    'settings' => 'section_margin_top',    'label' => esc_html__('Margin Top', 'preferred-magazine' ),    'description' => esc_html__('Margin Top not work in front page', 'preferred-magazine' ),    'section' => 'site_layout_section',    'default' => 0,    'transport' => 'auto',    'choices' => array(        'min' => 5,        'max' => 100,        'step' => 1,    ),    'output' => array(        array(            'element' => '.margin-top',            'property' => 'margin-top',            'units' => 'px',        ),    )));// Woocommerce product icon hidePreferred_Magazine_Kirki::add_section('woo_section', array(    'title' => esc_html__('Add To Cart Icon', 'preferred-magazine'),    'panel' => 'woocommerce',    'priority' => 10,));Preferred_Magazine_Kirki::add_field('preferred_magazine', array(    'type' => 'toggle',    'settings' => 'product_hide_cart',    'label' => __('Enable add to cart Icon', 'preferred-magazine'),    'section' => 'woo_section',    'default' => true,    "description" => "Enable Add to cart icon for shop and category",    'priority' => 10));