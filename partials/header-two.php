<?php 
	$nav_position = get_theme_mod( 'tygershark_header_navigation_position', 'center' );
?>
<header>
	<div class="header-top">
		<div class="row">
			<div class="col">
				<?php if ( is_active_sidebar( 'header-1' ) ) : ?>
					<?php dynamic_sidebar( 'header-1' ); ?>
				<?php endif; ?>
			</div>
			<div class="col logo-col">
				<!-- Your site title as branding in the menu -->
				<?php if ( ! has_custom_logo() ) { ?>

					<?php if ( is_front_page() && is_home() ) : ?>

						<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
						
					<?php else : ?>

						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
					
					<?php endif; ?>
				
				<?php } else {
					the_custom_logo();
				} ?><!-- end custom logo -->
			</div>
			<div class="col">
				<?php if ( is_active_sidebar( 'header-2' ) ) : ?>
					<?php dynamic_sidebar( 'header-2' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="header-bottom">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark nav-position-<?php echo $nav_position; ?>">

			<?php if ( 'container' == $container ) : ?>
				<div class="container" >
			<?php endif; ?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'walker'          => new understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->
	</div>
</header>

