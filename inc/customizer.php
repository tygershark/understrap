<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section( 'understrap_theme_layout_options', array(
			'title'       => __( 'Theme Layout Settings', 'understrap' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'understrap' ),
			'priority'    => 160,
		) );

		 //select sanitization function
        function understrap_theme_slug_sanitize_select( $input, $setting ){
         
            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
            $input = sanitize_key($input);
 
            //get the list of possible select options 
            $choices = $setting->manager->get_control( $setting->id )->choices;
                             
            //return input if valid or return default option
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
             
        }

		$wp_customize->add_setting( 'understrap_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_container_type', array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( "Choose between Bootstrap's container and container-fluid", 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => '10',
				)
			) );

		$wp_customize->add_setting( 'understrap_sidebar_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position', array(
					'label'       => __( 'Sidebar Positioning', 'understrap' ),
					'description' => __( "Set sidebar's default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.",
					'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_sidebar_position',
					'type'        => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'    => '20',
				)
			) );

		/**
		 * Header section
		 */
		$wp_customize->add_section( 'tygershark_theme_header_options', array(
			'title'       => __( 'Header', 'understrap' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Theme header settings', 'understrap' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'tygershark_header_style', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> 'one',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_header_style', array(
					'label'       => __( 'Header Style', 'understrap' ),
					'description' => __( 'Set\'s the desired header template.',
					'understrap' ),
					'section'     => 'tygershark_theme_header_options',
					'settings'    => 'tygershark_header_style',
					'type'        => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'one' => __( 'One', 'understrap' ),
						'two'  => __( 'Two', 'understrap' ),
						'three'  => __( 'Three', 'understrap' )
					),
					'priority'    => '20'
				)
			)
		);

		$wp_customize->add_setting( 'tygershark_header_navigation_position', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> 'middle',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_header_navigation_position', array(
					'label'       => __( 'Navigation Position', 'understrap' ),
					'description' => __( 'Set\'s the main navigation position',
					'understrap' ),
					'section'     => 'tygershark_theme_header_options',
					'settings'    => 'tygershark_header_navigation_position',
					'type'        => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'left' => __( 'Left', 'understrap' ),
						'middle'  => __( 'Middle', 'understrap' ),
						'right'  => __( 'Right', 'understrap' )
					),
					'priority'    => '20',
					'active_callback' => 'tygershark_header_navigation_position_active_callback'
				)
			)
		);

		$wp_customize->add_setting( 'tygershark_header_enable_topbar', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> 'show',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_header_enable_topbar', array(
					'label'       => __( 'Enable Top Bar', 'understrap' ),
					'description' => __( 'Set\'s the main navigation position',
					'understrap' ),
					'section'     => 'tygershark_theme_header_options',
					'settings'    => 'tygershark_header_enable_topbar',
					'type'        => 'radio',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'hide' => __( 'Hide', 'understrap' ),
						'show'  => __( 'Show', 'understrap' )
					),
					'priority'    => '20'
				)
			)
		);

		$wp_customize->add_setting( 'tygershark_header_topbar_num_columns', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> '2',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_header_topbar_num_columns', array(
					'label'       => __( 'Top Bar # Columns', 'understrap' ),
					'description' => __( 'Set\'s the main navigation position',
					'understrap' ),
					'section'     => 'tygershark_theme_header_options',
					'settings'    => 'tygershark_header_topbar_num_columns',
					'type'        => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'1' => __( '1', 'understrap' ),
						'2' => __( '2', 'understrap' ),
						'3' => __( '3', 'understrap' ),
						'4' => __( '4', 'understrap' )
					),
					'priority'    => '20',
					'active_callback' => 'tygershark_header_topbar_active_callback'
				)
			)
		);

		$wp_customize->add_setting( 'tygershark_header_topbar_container', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> 'on',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_header_topbar_container', array(
					'label'       => __( 'Top Bar Container', 'understrap' ),
					'description' => __( 'Whether the top bar content is in a container or not',
					'understrap' ),
					'section'     => 'tygershark_theme_header_options',
					'settings'    => 'tygershark_header_topbar_container',
					'type'        => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'on' => __( 'Yes', 'understrap' ),
						'off' => __( 'No', 'understrap' )
					),
					'priority'    => '20',
					'active_callback' => 'tygershark_header_topbar_active_callback'
				)
			)
		);

		/**
		 * Footer section
		 */
		$wp_customize->add_section( 'tygershark_theme_footer_options', array(
			'title'       => __( 'Footer', 'understrap' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Theme footer settings', 'understrap' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'tygershark_footer_columns', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> '4',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_footer_columns', array(
					'label'       => __( '# of Footer Columns', 'understrap' ),
					'description' => __( 'Set\'s the number of footer columns.',
					'understrap' ),
					'section'     => 'tygershark_theme_footer_options',
					'settings'    => 'tygershark_footer_columns',
					'type'        => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'1' => __( '1', 'understrap' ),
						'2'  => __( '2', 'understrap' ),
						'3'  => __( '3', 'understrap' ),
						'4'  => __( '4', 'understrap' )
					),
					'priority'    => '20'
				)
			)
		);

		$wp_customize->add_setting( 'tygershark_footer_enable_copyright', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
			'capability'        => 'edit_theme_options',
			'default' 			=> 'show',
			'transport'			=> 'refresh'
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tygershark_footer_enable_copyright', array(
					'label'       => __( 'Copyright Section', 'understrap' ),
					'description' => __( 'Show or hide the footer copyright section',
					'understrap' ),
					'section'     => 'tygershark_theme_footer_options',
					'settings'    => 'tygershark_footer_enable_copyright',
					'type'        => 'radio',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'     => array(
						'hide' => __( 'Hide', 'understrap' ),
						'show'  => __( 'Show', 'understrap' )
					),
					'priority'    => '20'
				)
			)
		);
	}
} // endif function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Whether to display the header position option or not
 * @return bool Yes/no
 */
function tygershark_header_navigation_position_active_callback() {
	return in_array( get_theme_mod( 'tygershark_header_style', 'one' ), ['two', 'three'] );
}

/**
 * Is the top bar enabled or not
 * @return bool Yes/no
 */
function tygershark_header_topbar_active_callback() {
	return 'show' === get_theme_mod( 'tygershark_header_enable_topbar', 'show' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script( 'understrap_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true );
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );
