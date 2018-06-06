<?php
/**
 * Declaring widgets
 *
 * @package understrap
 */

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
if ( ! function_exists( 'understrap_slbd_count_widgets' ) ) {
	function understrap_slbd_count_widgets( $sidebar_id ) {
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		global $_wp_sidebars_widgets;
		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
			if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
				// Four widgets per row if there are exactly four or more than six
				$widget_classes .= ' col-md-3';
			elseif ( 6 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-2';
			elseif ( $widget_count >= 3 ) :
				// Three widgets per row if there's three or more widgets 
				$widget_classes .= ' col-md-4';
			elseif ( 2 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-6';
			elseif ( 1 == $widget_count ) :
				// If just on widget is active
				$widget_classes .= ' col-md-12';
			endif; 
			return $widget_classes;
		endif;
	}
}

if ( ! function_exists( 'understrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function understrap_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Right Sidebar', 'understrap' ),
			'id'            => 'right-sidebar',
			'description'   => 'Right sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Left Sidebar', 'understrap' ),
			'id'            => 'left-sidebar',
			'description'   => 'Left sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Full', 'understrap' ),
			'id'            => 'footerfull',
			'description'   => 'Widget area below main content and above footer',
		    'before_widget'  => '<div id="%1$s" class="footer-widget %2$s '. understrap_slbd_count_widgets( 'footerfull' ) .'">', 
		    'after_widget'   => '</div><!-- .footer-widget -->', 
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );

		$num_columns = intval( get_theme_mod( 'tygershark_header_topbar_num_columns', '2' ) );
		$footer_num_cols = intval( get_theme_mod( 'tygershark_footer_columns', '4' ) );

		for ( $i = 1; $i <= $num_columns; $i++ ) {
			register_sidebar( array(
				'name'          => __( 'Top Bar ' . $i, 'understrap' ),
				'id'            => 'top-bar-' . $i,
				'description'   => 'Top bar widget area ' . $i,
			    'before_widget' => '',
				'after_widget'  => '',
			    'before_title'   => '<h3 class="widget-title">', 
			    'after_title'    => '</h3>', 
			) );
		}

		for ( $i = 1; $i <= $footer_num_cols; $i++ ) {
			register_sidebar( array(
				'name'          => __( 'Footer col ' . $i, 'understrap' ),
				'id'            => 'footer-col-' . $i,
				'description'   => 'Footer col ' . $i,
			    'before_widget' => '',
				'after_widget'  => '',
			    'before_title'   => '<h3 class="widget-title">', 
			    'after_title'    => '</h3>', 
			) );
		}

		register_sidebar( array(
			'name'          => __( 'Header Bar 1', 'understrap' ),
			'id'            => 'header-1',
			'description'   => 'Header widget area 1',
		    'before_widget' => '<aside id="%1$s" class="header-widget-1 header-widget widget %2$s">',
			'after_widget'  => '</aside>',
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );

		register_sidebar( array(
			'name'          => __( 'Header Bar 2', 'understrap' ),
			'id'            => 'header-2',
			'description'   => 'Header widget area 2',
		    'before_widget' => '<aside id="%1$s" class="header-widget-2 header-widget widget %2$s">',
			'after_widget'  => '</aside>',
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Copyright', 'understrap' ),
			'id'            => 'footer-copyright',
			'description'   => 'Footer copyright section',
		    'before_widget' => '',
			'after_widget'  => '',
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );

	}
} // endif function_exists( 'understrap_widgets_init' ).
add_action( 'widgets_init', 'understrap_widgets_init' );
