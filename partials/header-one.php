<nav id="primary-nav" class="navbar navbar-light navbar-expand-lg header-style-one">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

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

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div id="navbarNavDropdown" class="collapse navbar-collapse">
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container'       => false,
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'walker'          => new understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>

					<span id="close-menu"></span>

					<?php if ( is_active_sidebar( 'under-mobile-nav' ) ) : ?>
						<div class="under-mobile-nav">
							<?php dynamic_sidebar( 'under-mobile-nav' ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->