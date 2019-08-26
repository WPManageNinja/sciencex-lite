<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Sciencex_Lite_Customize_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		get_template_part( 'inc/upsell/section', 'pro' );

		// Register custom section types.
		$manager->register_section_type( 'Sciencex_Lite_Customize_Upsell_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Sciencex_Lite_Customize_Upsell_Section_Pro(
				$manager,
				'sciencexlite_upsell',
				array(
					'title'    => esc_html__( 'Ready for more?', 'sciencex-lite' ),
					'pro_text' => esc_html__( 'Get Sciencex PRO',  'sciencex-lite' ),
					'pro_url'  => '//wpmanageninja.com/downloads/sciencex-multipurpose-researcher-professor-education-wordpress-theme/',
					'priority' => 10,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'sciencexlite-upsell-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/upsell/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'sciencexlite-upsell-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/upsell/customize-controls.css' );
	}
}

// Doing this customizer thang!
Sciencex_Lite_Customize_Upsell::get_instance();
