<?php
/**
 * The main plugin class.
 *
 * @package CarbonOffset
 *
 * @since 1.0.0
 */

namespace CarbonOffset;

/**
 * The plugin object.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Init the plugin.
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		$this->include_files();
		$this->run();
	}

	/**
	 * Include required files.
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function include_files() {
		require_once __DIR__ . '/WebsiteCarbon.php';
		require_once __DIR__ . '/Data.php';
		require_once __DIR__ . '/Log.php';
		require_once __DIR__ . '/PaymentAPI.php';
		require_once __DIR__ . '/PaymentAPICloverly.php';
		require_once __DIR__ . '/AdminPage.php';
		require_once __DIR__ . '/FooterScript.php';
	}

	/**
	 * Instantiates the class objects.
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function run() {

		// Add the admin page.
		$admin_page = new AdminPage();
		$admin_page->init();

		// Log frontend visits.
		$log = new Log();
		$log->run();

		$cloverly = new PaymentAPICloverly();
		$cloverly->init();
	}
}
