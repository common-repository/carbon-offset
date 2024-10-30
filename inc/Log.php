<?php
/**
 * Data logging.
 *
 * @package CarbonOffset
 *
 * @since 1.0.0
 */

namespace CarbonOffset;

/**
 * Data logging.
 *
 * @since 1.0.0
 */
class Log {

	/**
	 * The saved data.
	 *
	 * @access protected
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * The the logger's processes.
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function run() {

		// Add the footer script.
		$footer_script = new FooterScript();
		$footer_script->run();

		// Log a visit.
		add_action( 'wp_footer', [ $this, 'maybe_log_visit' ], 999999 );
	}

	/**
	 * Check if this request is a logging request.
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_log_request() {
		return ( isset( $_GET['action'] ) && 'carbonOffset' === $_GET['action'] ); // phpcs:ignore WordPress.Security.NonceVerification
	}

	/**
	 * Log a visit.
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function maybe_log_visit() {

		if ( ! $this->is_log_request() ) {
			return;
		}

		$data    = new Data();
		$options = get_option( 'carbon_offset_settings', [] );

		$websitecarbon = new \CarbonOffset\WebsiteCarbon();
		$emissions     = $websitecarbon->get_carbon_data();

		$data->add( (float) $emissions );
	}
}
