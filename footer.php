<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
$footer_num_cols = intval( get_theme_mod( 'tygershark_footer_columns', '4' ) );
$enable_copyright = 'show' === get_theme_mod( 'tygershark_footer_enable_copyright', 'show' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">
			<?php for ( $i = 1; $i <= $footer_num_cols; $i++ ) : ?>
				<div class="col footer-col-<?php echo $i; ?>">
					<?php if ( is_active_sidebar( 'footer-col-' . $i ) ) : ?>
						<?php dynamic_sidebar( 'footer-col-' . $i ); ?>
					<?php endif; ?>
				</div>
			<?php endfor; ?>
		</div>

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">
						<?php if ( $enable_copyright && is_active_sidebar( 'footer-copyright' ) ) : ?>
							<?php dynamic_sidebar( 'footer-copyright' ); ?>
						<?php endif; ?>
					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

