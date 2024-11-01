<?php

namespace SimpleStage\WebScript;

class ScriptInclude
{
	public $options;

	public function __construct()
	{
		$this->options = get_option( 'simplestage_settings' );
		if ( !isset( $this->options[ 'enabled' ] ) || $this->options[ 'enabled' ] !== 'on' ) return;
		if ( !isset( $this->options[ 'key' ] ) || $this->options[ 'key' ] === '' ) return;
		$this->register();
	}

	public function register()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_script' ) );
		add_filter( 'script_loader_tag', array( $this, 'add_key_to_script' ), 10, 3 );
	}

	public function enqueue_script()
	{
		wp_enqueue_script( 'simplestage_web_request', 'https://web-tools.simplestage.com/web-request-handler.js' );
	}

	public function add_key_to_script( $tag, $handle, $src )
	{
		if ( $handle === 'simplestage_web_request' ) {
			$key = esc_attr( $this->options[ 'key' ] );
			$tag = '<script api_key="' . $key . '" src="' . esc_url( $src ) . '"></script>' . PHP_EOL;
		}
		return $tag;
	}
}