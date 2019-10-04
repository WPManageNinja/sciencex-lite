<?php
/**
 * ScienceX Lite Theme Customizer
 *
 * @package sciencexlite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sciencexlite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'sciencexlite_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sciencexlite_customize_partial_blogdescription',
		) );
	}


	// Theme options panel
    $wp_customize->add_panel( 'sciencexlite_theme_options', array(
    	'priority' => 25,
    	'capability' => 'edit_theme_options',
    	'theme_supports' => '',
    	'title'  => __('Theme Options', 'sciencex-lite')
    ));



    // General settings 
    $wp_customize->add_section( 'sciencexlite_general_settings', array(
    	'title'		=> __( 'General Settings', 'sciencex-lite' ),
    	'priority'	=> 1000,
    	'panel'		=> 'sciencexlite_theme_options'
    ));

    $wp_customize->add_setting( 'sciencexlite_page_wrapper_top_padding', array(
    	'default' 	        => '0',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'absint'
    ));
    
    $wp_customize->add_control( 'sciencexlite_page_wrapper_top_padding', array(
		'label' => __('Page Wrapper Padding Top', 'sciencex-lite'),
		'type' => 'number',
		'section' => 'sciencexlite_general_settings',
		'settings' => 'sciencexlite_page_wrapper_top_padding',
		'input_attrs' => array(
                'min'   => 0,
                'max'   => 150,
                'step'  => 1,
        ),  
    ) );

    $wp_customize->add_setting( 'sciencexlite_page_wrapper_bottom_padding', array(
    	'default' 	        => '0',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'absint'
    ));
    
    $wp_customize->add_control( 'sciencexlite_page_wrapper_bottom_padding', array(
		'label' => __('Page Wrapper Padding Bottom', 'sciencex-lite'),
		'type' => 'number',
		'section' => 'sciencexlite_general_settings',
		'settings' => 'sciencexlite_page_wrapper_bottom_padding',
		'input_attrs' => array(
                'min'   => 0,
                'max'   => 150,
                'step'  => 1,
        ),  
    ) );


    $wp_customize->add_setting( 'sciencexlite_page_layout_style', array(
    	'default' 	        => false,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'sciencexlite_page_layout_style', array(
		'label' => __('Active/Deactivate Website Boxed Layout?', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_general_settings',
		'settings' => 'sciencexlite_page_layout_style'
    ) );


    $wp_customize->add_setting( 'sciencexlite_preloader', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'sciencexlite_preloader', array(
		'label' => __('Show/hide your website preloader?', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_general_settings',
		'settings' => 'sciencexlite_preloader'
    ) );

    $wp_customize->add_setting( 'sciencexlite_sticky_menu', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'sciencexlite_sticky_menu', array(
        'label' => __('Active/Deactivate your website sticky menu?', 'sciencex-lite'),
        'type' => 'checkbox',
        'section' => 'sciencexlite_general_settings',
        'settings' => 'sciencexlite_sticky_menu'
    ) );


    // Logo settings 
    $wp_customize->add_section( 'sciencexlite_logo_settings', array(
        'title'     => __( 'Logo Settings', 'sciencex-lite' ),
        'priority'  => 1005,
        'panel'     => 'sciencexlite_theme_options',
        'description' => __( 'To upload custom logo image - go to Appearance > Customize > Site Identity', 'sciencex-lite' )
    ));

    $wp_customize->add_setting( 'sciencexlite_logo_width', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_number'
    ));

    $wp_customize->add_control( 'sciencexlite_logo_width', array(
        'label' => __('Logo Width (px) ', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_logo_width',
    ) );

    $wp_customize->add_setting( 'sciencexlite_logo_height', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_number'
    ));

    $wp_customize->add_control( 'sciencexlite_logo_height', array(
        'label' => __('Logo Height (px) ', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_logo_height',
    ) );

    $wp_customize->add_setting( 'sciencexlite_logo_uc', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'sciencexlite_logo_uc', array(
        'label' => __('Site Title Uppercase', 'sciencex-lite'),
        'type'   => 'checkbox',
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_logo_uc',
    ) );

    $wp_customize->add_setting( 'sciencexlite_logo_font_color', array(
        'default'           => '#36a4de',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_logo_font_color', array(
        'label' => __('Site Title Text color', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_logo_font_color'
    )) );
   
    $wp_customize->add_setting( 'sciencexlite_logo_font_size', array(
        'default'           => '36',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_number'
    ));

    $wp_customize->add_control( 'sciencexlite_logo_font_size', array(
        'label' => __('Site Title Font Size (px) ', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_logo_font_size',
    ) );

    $wp_customize->add_setting( 'sciencexlite_logo_font_weight', array(
        'default'           => '700',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_number'
    ));

    $wp_customize->add_control( 'sciencexlite_logo_font_weight', array(
        'label' => __('Site Title Font Weight ', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_logo_font_weight',
    ) );
    
    $wp_customize->add_setting( 'sciencexlite_tagline_visibility', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'sciencexlite_tagline_visibility', array(
        'label' => __('Show/Hide Site Tagline', 'sciencex-lite'),
        'type'   => 'checkbox',
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_tagline_visibility',
    ) );

    $wp_customize->add_setting( 'sciencexlite_tagline_uc', array(
        'default'           => false,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));

    $wp_customize->add_control( 'sciencexlite_tagline_uc', array(
        'label' => __('Site Tagline Uppercase?', 'sciencex-lite'),
        'type'   => 'checkbox',
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_tagline_uc',
    ) );

    $wp_customize->add_setting( 'sciencexlite_tagline_font_size', array(
        'default'           => '21',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_number'
    ));

    $wp_customize->add_control( 'sciencexlite_tagline_font_size', array(
        'label' => __('Tagline Font Size (px) ', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_tagline_font_size',
    ) );

    $wp_customize->add_setting( 'sciencexlite_tagline_font_color', array(
        'default'           => '#183c55',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_tagline_font_color', array(
        'label' => __('Tagline Text color', 'sciencex-lite'),
        'section' => 'sciencexlite_logo_settings',
        'settings' => 'sciencexlite_tagline_font_color'
    )) );


        // Menu section
    $wp_customize->add_section( 'sciencexlite_main_menu_section', array(
        'title'     => __( 'Main Menu Settings', 'sciencex-lite' ),
        'priority'  => 1010,
        'panel'     => 'sciencexlite_theme_options'
    ));

    $wp_customize->add_setting( 'sciencexlite_main_menu_btn_title', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_text'
    ));

    $wp_customize->add_control('sciencexlite_main_menu_btn_title', array(
        'label'      => __('Button Title', 'sciencex-lite'),
        'section'    => 'sciencexlite_main_menu_section',
        'settings'   => 'sciencexlite_main_menu_btn_title',
    ));

    $wp_customize->add_setting( 'sciencexlite_main_menu_btn_link', array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_text'
    ));

    $wp_customize->add_control('sciencexlite_main_menu_btn_link', array(
        'label'      => __('Button Link', 'sciencex-lite'),
        'section'    => 'sciencexlite_main_menu_section',
        'settings'   => 'sciencexlite_main_menu_btn_link',
    ));

    $wp_customize->add_setting( 'sciencexlite_menu_bg_color', array(
        'default'           => '#fff',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_menu_bg_color', array(
        'label' => __('Main Menu Background color', 'sciencex-lite'),
        'section' => 'sciencexlite_main_menu_section',
        'settings' => 'sciencexlite_menu_bg_color'
    )) );
    
    $wp_customize->add_setting( 'sciencexlite_menu_text_color', array(
        'default'           => '#183c55',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_menu_text_color', array(
        'label' => __('Main Menu Text color', 'sciencex-lite'),
        'section' => 'sciencexlite_main_menu_section',
        'settings' => 'sciencexlite_menu_text_color'
    )) );

    $wp_customize->add_setting( 'sciencexlite_menu_text_hover_color', array(
        'default'           => '#183c55',
        'type'              => 'theme_mod',
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_menu_text_hover_color', array(
        'label' => __('Main Menu Text Hover color', 'sciencex-lite'),
        'section' => 'sciencexlite_main_menu_section',
        'settings' => 'sciencexlite_menu_text_hover_color'
    )) );



    // Footer section
    $wp_customize->add_section( 'sciencexlite_copyright_section', array(
    	'title'		=> __( 'Footer Settings', 'sciencex-lite' ),
    	'priority'	=> 1015,
    	'panel'		=> 'sciencexlite_theme_options'
    ));

     $wp_customize->add_setting( 'sciencexlite_footer_widgets_section_visiblity', array(
        'default'           => true,
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_footer_widgets_section_visiblity', array(
        'label' => __('Show/Hide Footer Widgets Section?', 'sciencex-lite'),
        'type' => 'checkbox',
        'section' => 'sciencexlite_copyright_section',
        'settings' => 'sciencexlite_footer_widgets_section_visiblity'
    ) );

    $wp_customize->add_setting( 'sciencexlite_copyright_section_visiblity', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_copyright_section_visiblity', array(
		'label' => __('Show/Hide Copyright Section', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_copyright_section',
		'settings' => 'sciencexlite_copyright_section_visiblity'
    ) );

    $wp_customize->add_setting( 'sciencexlite_copyright_section_bg_color', array(
    	'default' 	        => '#ffffff',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_copyright_section_bg_color', array(
		'label' => __('Copyright Section Background color', 'sciencex-lite'),
		'section' => 'sciencexlite_copyright_section',
		'settings' => 'sciencexlite_copyright_section_bg_color'
    )) );

    $wp_customize->add_setting( 'sciencexlite_copyright_section_text_color', array(
    	'default' 	        => '#183c55',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_copyright_section_text_color', array(
		'label' => __('Copyright Text color', 'sciencex-lite'),
		'section' => 'sciencexlite_copyright_section',
		'settings' => 'sciencexlite_copyright_section_text_color'
    )) );


    $wp_customize->add_setting( 'sciencexlite_copyright_section_text_link_color', array(
    	'default' 	        => '#36a4de',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_copyright_section_text_link_color', array(
		'label' => __('Copyright Text Link color', 'sciencex-lite'),
		'section' => 'sciencexlite_copyright_section',
		'settings' => 'sciencexlite_copyright_section_text_link_color'
    )) );

    // Banner section
    $wp_customize->add_section( 'sciencexlite_banner_section', array(
    	'title'		=> __( 'Banner Settings', 'sciencex-lite' ),
    	'priority'	=> 1020,
    	'panel'		=> 'sciencexlite_theme_options'
    ));


    $wp_customize->add_setting( 'sciencexlite_site_banner', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_site_banner', array(
		'label' => __('Show/Hide Site Banner?', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_banner_section',
		'settings' => 'sciencexlite_site_banner'
    ) );

    $wp_customize->add_setting( 'sciencexlite_site_banner_bg_color', array(
    	'default' 	        => '#3a89c6',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_site_banner_bg_color', array(
		'label' => __('Banner Background Color', 'sciencex-lite'),
		'section' => 'sciencexlite_banner_section',
		'settings' => 'sciencexlite_site_banner_bg_color'
    )) );

    $wp_customize->add_setting( 'sciencexlite_site_banner_text_color', array(
    	'default' 	        => '#fff',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sciencexlite_site_banner_text_color', array(
		'label' => __('Banner Background Color', 'sciencex-lite'),
		'section' => 'sciencexlite_banner_section',
		'settings' => 'sciencexlite_site_banner_text_color'
    )) );


    // Blog section
    $wp_customize->add_section( 'sciencexlite_blog_section', array(
    	'title'		=> __( 'Blog Settings', 'sciencex-lite' ),
    	'priority'	=> 1020,
    	'panel'		=> 'sciencexlite_theme_options'
    ));

    $wp_customize->add_setting( 'sciencexlite_blog_page_title', array(
    	'default' 	        => '',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_text'
    ));

    $wp_customize->add_control('sciencexlite_blog_page_title', array(
        'label'      => __('Title Text', 'sciencex-lite'),
        'section'    => 'sciencexlite_blog_section',
        'settings'   => 'sciencexlite_blog_page_title',
    ));

    $wp_customize->add_setting( 'sciencexlite_blog_sidebar_layout', array(
    	'default' 	        => 'right_sidebar',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_blog_sidebar_layout'
    ));
    $wp_customize->add_control( 'sciencexlite_blog_sidebar_layout', array(
		'label' => __('Blog Sidebar Layout', 'sciencex-lite'),
		'type' => 'radio',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_blog_sidebar_layout',
		'choices' => array(
			'no_sidebar' => __( 'No Sidebar', 'sciencex-lite' ), 
			'right_sidebar' => __( 'Blog With Right Sidebar', 'sciencex-lite' ), 
			'left_sidebar' => __( 'Blog With Left Sidebar', 'sciencex-lite' ), 
		)
    ) );

    $wp_customize->add_setting( 'sciencexlite_blog_image', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_blog_image', array(
		'label' => __('Show/Hide Featured Image On Blog Post', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_blog_image'
    ) );


    $wp_customize->add_setting( 'sciencexlite_blog_header_meta', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_blog_header_meta', array(
		'label' => __('Show/Hide Post Header Meta On Blog Post', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_blog_header_meta'
    ) );

    $wp_customize->add_setting( 'sciencexlite_blog_category', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_blog_category', array(
		'label' => __('Show/Hide Blog Category On Blog Post', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_blog_category'
    ) );

    $wp_customize->add_setting( 'sciencexlite_blog_read_more_btn', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_blog_read_more_btn', array(
		'label' => __('Show/Hide Blog Read More Button', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_blog_read_more_btn'
    ) );


    $wp_customize->add_setting( 'sciencexlite_blog_read_more_btn_text', array(
    	'default' 	        => '',
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_text'
    ));

    $wp_customize->add_control('sciencexlite_blog_read_more_btn_text', array(
        'label'      => __('Link Text', 'sciencex-lite'),
        'section'    => 'sciencexlite_blog_section',
        'settings'   => 'sciencexlite_blog_read_more_btn_text',
    ));

    $wp_customize->add_setting( 'sciencexlite_blog_content_length', array(
    	'default' 	        => 200,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'absint'
    ));
    
    $wp_customize->add_control( 'sciencexlite_blog_content_length', array(
		'label' => __('Blog Content Length', 'sciencex-lite'),
		'type' => 'number',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_blog_content_length',
		'input_attrs' => array(
                'min'   => 10,
                'max'   => 500,
                'step'  => 1,
        ),  
    ) );


    $wp_customize->add_setting( 'sciencexlite_single_blog_image', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_single_blog_image', array(
		'label' => __('Show/Hide Featured Image On Single Blog Post', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_single_blog_image'
    ) );

    $wp_customize->add_setting( 'sciencexlite_single_blog_meta', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_single_blog_meta', array(
		'label' => __('Show/Hide Meta Single Blog Post', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_single_blog_meta'
    ) );
    
    $wp_customize->add_setting( 'sciencexlite_single_blog_footer', array(
    	'default' 	        => true,
    	'type'		        => 'theme_mod',
    	'capability'        => 'edit_theme_options',
    	'sanitize_callback' => 'sciencexlite_sanitize_checkbox'
    ));
    $wp_customize->add_control( 'sciencexlite_single_blog_footer', array(
		'label' => __('Show/Hide Footer On Single Blog Post', 'sciencex-lite'),
		'type' => 'checkbox',
		'section' => 'sciencexlite_blog_section',
		'settings' => 'sciencexlite_single_blog_footer'
    ) );


    /* ===== Upgrade to pro child class ==== */
    class ScienceX_Lite_Customize_Upgrade_Control extends WP_Customize_Control {
        public function render_content() {  ?>
            <p class="sciencexlite-upgrade-title">
                <span class="customize-control-title">
                    <h3 style="text-align:center;"><div class="dashicons dashicons-megaphone"></div> <?php esc_html_e('Get ScienceX PRO WP Theme for only', 'sciencex-lite'); ?> &#36;49.00</h3>
                </span>
            </p>
            <p style="text-align:center;" class="sciencexlite-upgrade-button">
                <a style="margin: 10px;" target="_blank" href="https://sciencex.wpninjathemes.com/" class="button button-secondary">
                    <?php esc_html_e('Live Demo', 'sciencex-lite'); ?>
                </a>
                <a style="margin: 10px;" target="_blank" href="https://wpmanageninja.com/downloads/sciencex-multipurpose-researcher-professor-education-wordpress-theme/" class="button button-secondary">
                    <?php esc_html_e('Get ScienceX PRO', 'sciencex-lite'); ?>
                </a>
            </p>
            <ul>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Advanced Theme Options', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Drag and Drop Page Builder', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Theme Features Core Plugin', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Upload Your Own Logo', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('850+ Google Fonts', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Unlimited Colors and Skin', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('One Click Demo Import', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('4 Exclusive Widgets', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Custom Slider', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Shop Page', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Footer Widgets', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Breadcrumb', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Stick menu', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('18+ Shortcodes/Addons', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('4 Exclusive Widgets', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Background image/video', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Parallax effect', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('Documentation', 'sciencex-lite'); ?></b></li>
                <li><div class="dashicons dashicons-yes" style="color: #1bda24;"></div><b><?php esc_html_e('And much more...', 'sciencex-lite'); ?></b></li>
            <ul><?php
        }
    }

    $wp_customize->add_section( 'sciencexlite_up_pro_section', array(
         'title'    => esc_html__( 'More features? Upgrade to PRO', 'sciencex-lite' ),
         'priority' => 999,
    ));

    $wp_customize->add_setting('sciencexlite_upgrade_pro', array(
        'default' => '',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_attr'
    ));

    $wp_customize->add_control(new ScienceX_Lite_Customize_Upgrade_Control($wp_customize, 'sciencexlite_upgrade_pro', array(
        'section' => 'sciencexlite_up_pro_section',
        'settings' => 'sciencexlite_upgrade_pro',
    )));
}
add_action( 'customize_register', 'sciencexlite_customize_register' );



function sciencexlite_custom_styling(){

	$sciencexlite_page_wrapper_top_padding = get_theme_mod('sciencexlite_page_wrapper_top_padding');
	$sciencexlite_page_wrapper_bottom_padding = get_theme_mod('sciencexlite_page_wrapper_bottom_padding');

    $sciencexlite_logo_width = get_theme_mod('sciencexlite_logo_width');
    $sciencexlite_logo_height = get_theme_mod('sciencexlite_logo_height');

    $sciencexlite_logo_uc = get_theme_mod('sciencexlite_logo_uc');
    $sciencexlite_logo_font_color = get_theme_mod('sciencexlite_logo_font_color');
    $sciencexlite_logo_font_size = get_theme_mod('sciencexlite_logo_font_size');
    $sciencexlite_logo_font_weight = get_theme_mod('sciencexlite_logo_font_weight');
    $sciencexlite_tagline_visibility = get_theme_mod('sciencexlite_tagline_visibility');
    $sciencexlite_tagline_uc = get_theme_mod('sciencexlite_tagline_uc');
    $sciencexlite_tagline_font_size = get_theme_mod('sciencexlite_tagline_font_size');
    $sciencexlite_tagline_font_color = get_theme_mod('sciencexlite_tagline_font_color');

    $sciencexlite_site_banner_bg_color = get_theme_mod('sciencexlite_site_banner_bg_color');
    $sciencexlite_site_banner_text_color = get_theme_mod('sciencexlite_site_banner_text_color');

	$sciencexlite_menu_bg_color = get_theme_mod('sciencexlite_menu_bg_color');
	$sciencexlite_menu_text_color = get_theme_mod('sciencexlite_menu_text_color');
	$sciencexlite_menu_text_hover_color = get_theme_mod('sciencexlite_menu_text_hover_color');

    $sciencexlite_copyright_section_bg_color = get_theme_mod('sciencexlite_copyright_section_bg_color');
    $sciencexlite_copyright_section_text_color = get_theme_mod('sciencexlite_copyright_section_text_color');
    $sciencexlite_copyright_section_text_link_color = get_theme_mod('sciencexlite_copyright_section_text_link_color');


	$output = '';

    if( $sciencexlite_logo_width ){
        $output .= '.logo img{ width:' . $sciencexlite_logo_width .'px'.' }';
    }

    if( $sciencexlite_logo_height ){
        $output .= '.logo img{ height:' . $sciencexlite_logo_height .'px'.' }';
    }
   

    if( $sciencexlite_logo_uc && $sciencexlite_logo_uc == true ){
        $output .= '.sabbi-site-head h1.sciencex-logo, .sabbi-site-head h1.sciencex-logo a { text-transform: uppercase; }';
    }
    
    if( $sciencexlite_logo_font_color ){
        $output .= '.sabbi-site-head h1.sciencex-logo, .sabbi-site-head h1.sciencex-logo a { color:' . $sciencexlite_logo_font_color .' }';
    }

    if( $sciencexlite_logo_font_size ){
        $output .= '.sabbi-site-head h1.sciencex-logo, .sabbi-site-head h1.sciencex-logo a { font-size:' . $sciencexlite_logo_font_size .'px'.' }';
    }

    if( $sciencexlite_logo_font_weight ){
        $output .= '.sabbi-site-head h1.sciencex-logo, .sabbi-site-head h1.sciencex-logo a { font-weight:' . $sciencexlite_logo_font_weight .' }';
    }

    if( $sciencexlite_tagline_visibility && $sciencexlite_tagline_visibility == true ){
        $output .= '.sabbi-site-head h3.site-description { display: block; }';
    } else {
        $output .= '.sabbi-site-head h3.site-description { display: none; }';
    }

    if( $sciencexlite_tagline_uc && $sciencexlite_tagline_uc == true ){
        $output .= '.sabbi-site-head h3.site-description { text-transform: uppercase; }';
    }

    if( $sciencexlite_tagline_font_size ){
        $output .= '.sabbi-site-head h3.site-description { font-size:' . $sciencexlite_tagline_font_size .'px'.' }';
    }

    if( $sciencexlite_tagline_font_color ){
        $output .= '.sabbi-site-head h3.site-description { color:' . $sciencexlite_tagline_font_color .' }';
    }


    if( $sciencexlite_site_banner_bg_color ){
        $output .= '.sabbi-page-header { background-color:' . $sciencexlite_site_banner_bg_color .' }';
    }

    if( $sciencexlite_site_banner_text_color ){
        $output .= '.sabbi-page-header .page-title { color:' . $sciencexlite_site_banner_text_color .' }';
    }

	if( $sciencexlite_menu_bg_color ){
		$output .= '.navbar-white { background-color:' . $sciencexlite_menu_bg_color .' }';
	}

	if( $sciencexlite_menu_text_color ){
		$output .= '.navbar-nav-hov_underline .navbar-nav li a{ color:' . $sciencexlite_menu_text_color .' }';
	}

	if( $sciencexlite_menu_text_hover_color ){
		$output .= '.navbar-nav-hov_underline .navbar-nav li a:hover{ color:' . $sciencexlite_menu_text_hover_color .' }';
	}

	if( $sciencexlite_page_wrapper_top_padding ){
		$output .= '.sciencexlite-content-area { padding-top:' . $sciencexlite_page_wrapper_top_padding .'px'.' }';
	}

	if( $sciencexlite_page_wrapper_bottom_padding ){
		$output .= '.sciencexlite-content-area { padding-bottom:' . $sciencexlite_page_wrapper_bottom_padding .'px'.' }';
	}

	if( $sciencexlite_copyright_section_bg_color ){
		$output .= '.site-footer { background-color:' . $sciencexlite_copyright_section_bg_color .' }';
	}

	if( $sciencexlite_copyright_section_text_color ){
		$output .=  '.powredby, .copyright{ color:' . $sciencexlite_copyright_section_text_color .' }';
	}

	if( $sciencexlite_copyright_section_text_link_color ){
		$output .=  '.powredby a, .copyright a{ color:' . $sciencexlite_copyright_section_text_link_color .' }';
	}

    $output = esc_attr($output);

    wp_add_inline_style( 'sciencexlite-style', $output );

}
add_action( 'wp_enqueue_scripts', 'sciencexlite_custom_styling' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sciencexlite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sciencexlite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


// Sanitization to validate that the input value is an integer
function sciencexlite_sanitize_number( $input ){
    return absint( $input );
}

function sciencexlite_sanitize_checkbox( $input ){
    return ( isset( $input ) && true == $input ? true : false );
}

function sciencexlite_sanitize_text( $input ) {     
	return wp_kses_post( $input );
}

// Sanitization for blog sidebar layout
function sciencexlite_sanitize_blog_sidebar_layout( $value ){
	$default = sciencexlite_blog_sidebar_layout();
	if( array_key_exists( $value, $default ) ){
		return $value;
	}
	return apply_filters( 'sciencexlite_blog_sidebar_layout', current( $default ) );
}

function sciencexlite_blog_sidebar_layout(){
	$default = array(
		'no_sidebar' => __( 'No Sidebar', 'sciencex-lite' ), 
		'right_sidebar' => __( 'Blog With Right Sidebar', 'sciencex-lite' ), 
		'left_sidebar' => __( 'Blog With Left Sidebar', 'sciencex-lite' ), 
    );

    return apply_filters( 'sciencexlite_blog_sidebar_layout', $default );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sciencexlite_customize_preview_js() {
	wp_enqueue_script( 'sciencexlite-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '2.0.2', true );
}
add_action( 'customize_preview_init', 'sciencexlite_customize_preview_js' );
