<?php

class TS_Override_CSS {

	public function __construct() {
		if ( session_status() == PHP_SESSION_NONE ) {
			session_start();
		}

		add_action( 'admin_bar_menu', [ $this, 'inject_form' ], 10, 1 );
		add_action( 'init', [ $this, 'form_submit' ], 10, 0 );
		add_action( 'wp_enqueue_scripts', [ $this, 'replace_css' ], 11, 0 );
	}

	public function inject_form() {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'id' => 'ts-override-css',
			'parent' => 'top-secondary',
			'title' => $this->form_markup()
		) );
	}

	public function form_submit() {
		if ( isset( $_POST['override-css-url'] ) ) {
			$_SESSION['override-css-url'] = sanitize_text_field( $_POST['override-css-url'] );
		}

		if ( isset( $_POST['remove-css-override'] ) ) {
			unset( $_SESSION['override-css-url'] );
		}
	}

	public function replace_css() {
		if ( isset( $_SESSION['override-css-url'] ) ) {
			wp_dequeue_style( 'understrap-styles' );
			wp_enqueue_style( 'ts-override', $_SESSION['override-css-url'], [], time() );
		}
	}

	private function form_markup() {
		if ( isset( $_SESSION['override-css-url'] ) ) {
			return '<form method="post" id="css-override-form"><input type="submit" name="remove-css-override" value="Remove CSS Override" id="remove-css-override" /></form>';
		} else {
			return '<form method="post" id="css-override-form"><input type="text" name="override-css-url" placeholder="Override theme css" /><input type="submit" /></form>';
		}
	}

}

if ( is_user_logged_in() && ! is_admin() ) {
	if ( current_user_can( 'administrator' ) ) {
		$GLOBALS['TS_Override_CSS'] = new TS_Override_CSS();
	}
}
