<?php
/**
 * Plugin Name: SimpleStage
 * Plugin URI: https://simplestage.com
 * Description: Add the Simplestage Web Request script to your site
 * Version: 1.0.3
 * Author: SimpleStage
 * Tested up to: 5.9
 * Requires: 4.6 or higher
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Requires PHP: 5.6
 * Text Domain: simplestage
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

include_once plugin_dir_path( __FILE__ ) . 'AdminSetup.php';
include_once plugin_dir_path( __FILE__ ) . 'ScriptInclude.php';

class SimpleStageWebScript
{
	public function __construct()
	{
		$this->setup();
	}

	public function setup()
	{
		new SimpleStage\WebScript\AdminSetup();
		new SimpleStage\WebScript\ScriptInclude();
	}

}

new SimpleStageWebScript();