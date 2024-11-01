<?php

namespace SimpleStage\WebScript;

class AdminSetup
{
	public function __construct()
	{
		$this->register();
	}

	public function register()
	{
		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_filter( 'plugin_action_links_simplestage/simplestage.php', array( $this, 'settings_link' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_init', array( $this, 'maybe_redirect' ) );
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
	}


	/**
	 * since 1.0.3
	 */
	public function activate()
	{
		add_option( 'simplestage_do_activation_redirect', true );
	}

	/**
	 * since 1.0.3
	 */
	public function maybe_redirect()
	{
		if ( get_option( 'simplestage_do_activation_redirect', false ) ) {
			delete_option( 'simplestage_do_activation_redirect' );
			exit( wp_redirect( "options-general.php?page=simplestage" ) );
		}
	}

	public function settings_link( $links )
	{
		$settings_link = '<a href="/wp-admin/options-general.php?page=simplestage">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}

	function enqueue_assets()
	{
		//wp_enqueue_style( "$this->plugin-css", plugins_url('/public/styles.css', __FILE__) );
		//wp_enqueue_script( "$this->plugin-js", plugins_url('/public/scripts.js', __FILE__), null, null, true );
	}

	public function add_admin_page()
	{
		add_submenu_page( 'options-general.php', 'SimpleStage', 'SimpleStage', 'manage_options', 'simplestage', array( $this, 'admin_index' ) );
	}

	public function admin_index()
	{
		require_once plugin_dir_path( __FILE__ ) . 'admin-view.php';
	}


	public function register_settings()
	{
		register_setting( 'simplestage_settings', 'simplestage_settings', array( $this, 'settings_validate' ) );
	}

	public function settings_validate( $args )
	{
		//$args will contain the values posted in your settings form, you can validate them as no spaces allowed, no special chars allowed or validate emails etc.
		// if(!isset($args['enabled']) || !is_email($args['wpse61431_email'])){
		// 	//add a settings error because the email is invalid and make the form field blank, so that the user can enter again
		// 	$args['wpse61431_email'] = '';
		// 	add_settings_error('wpse61431_settings', 'wpse61431_invalid_email', 'Please enter a valid email!', $type = 'error');
		// }

		//make sure you return the args
		return $args;
	}
}