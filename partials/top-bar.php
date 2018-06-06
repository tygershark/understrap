<?php $num_columns = intval( get_theme_mod( 'tygershark_header_topbar_num_columns', '2' ) ); ?>
<div id="top-bar">

	<?php if ( 'container' == $container ) : ?>
		<div class="container">
	<?php endif; ?>

	<div class="row">
		<?php for ( $i = 1; $i <= $num_columns; $i++ ) : ?>
			<div class="col top-bar-col-<?php echo $i; ?>">
				<?php if ( is_active_sidebar( 'top-bar-' . $i ) ) : ?>
					<?php dynamic_sidebar( 'top-bar-' . $i ); ?>
				<?php endif; ?>
			</div>
		<?php endfor; ?>
	</div>

	<?php if ( 'container' == $container ) : ?>
		</div>
	<?php endif; ?>
</div>