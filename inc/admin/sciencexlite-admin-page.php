<?php
/**
 * SciencexLite Admin Class.
 *
 * @author  CrestaProject
 * @package SciencexLite
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sciencex_Lite_Admin' ) ) :

/**
 * Sciencex_Lite_Admin Class.
 */
class Sciencex_Lite_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );
		global $sciencexlite_adminpage;
		$sciencexlite_adminpage = add_theme_page( esc_html__( 'About', 'sciencex-lite' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'sciencex-lite' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'sciencexlite-welcome', array( $this, 'welcome_screen' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_admin_scripts() {
		global $sciencexlite_adminpage;
		$screen = get_current_screen();
		if ( $screen->id != $sciencexlite_adminpage ) {
			return;
		}
		wp_enqueue_style( 'sciencexlite-welcome', get_template_directory_uri() . '/inc/admin/welcome.css', array(), '1.0' );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'sciencexlite-message', get_template_directory_uri() . '/inc/admin/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'sciencexlite_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'sciencexlite_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['sciencexlite-hide-notice'] ) && isset( $_GET['_sciencexlite_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_key($_GET['_sciencexlite_notice_nonce'] ), 'sciencexlite_hide_notices_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'sciencex-lite' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'sciencex-lite' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash($_GET['sciencexlite-hide-notice'] ));
			update_option( 'sciencexlite_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		$theme = wp_get_theme( get_template() );
		?>
		<div id="message" class="updated sciencexlite-message">
			<h1><?php esc_html_e( 'Welcome to ', 'sciencex-lite' ); ?><?php echo esc_html($theme->get( 'Name' )) ." ". esc_html($theme->get( 'Version' )); ?></h1>
			<a class="sciencexlite-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'sciencexlite-hide-notice', 'welcome' ) ), 'sciencexlite_hide_notices_nonce', '_sciencexlite_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'sciencex-lite' ); ?></a>
			<p>
			<?php
			/* translators: 1: start option panel link, 2: end option panel link */
			printf( esc_html__( 'Thank you for choosing SciencexLite! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'sciencex-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=sciencexlite-welcome' ) ) . '">', '</a>' );
			?>
			</p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=sciencexlite-welcome' ) ); ?>"><?php esc_html_e( 'Get started with SciencexLite', 'sciencex-lite' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="sciencexlite-theme-info">
				
			<div class="welcome-description-wrap">
				<div class="about-text">
					<h1>
						<?php esc_html_e('About', 'sciencex-lite'); ?>
						<?php echo esc_html($theme->get( 'Name' )) ." ". esc_html($theme->get( 'Version' )); ?>
					</h1>
					<?php echo esc_html($theme->display( 'Description' )); ?>
				</div>
				<div class="sciencexlite-screenshot">
					<a target="_blank" href="<?php echo esc_url( apply_filters( 'sciencexlite_pro_theme_url', 'https://wpmanageninja.com/downloads/sciencex-multipurpose-researcher-professor-education-wordpress-theme/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
					</a>
				</div>
			</div>
			<div class="welcome-description-wrap-action">
				<p class="sciencexlite-actions">
					<span><?php esc_html_e( 'Sciencex Pro', 'sciencex-lite' ); ?></span>
					<a href="<?php echo esc_url( apply_filters( 'sciencexlite_pro_theme_url', 'http://sciencex.wpmanageninja.com/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View Live Demo', 'sciencex-lite' ); ?></a>
					<a href="<?php echo esc_url( apply_filters( 'sciencexlite_pro_theme_url', 'https://wpmanageninja.com/downloads/sciencex-multipurpose-researcher-professor-education-wordpress-theme/' ) ); ?>" class="button button-secondary bg-success docs" target="_blank"><?php esc_html_e( 'Get PRO', 'sciencex-lite' ); ?></a>
					<a href="<?php echo esc_url( apply_filters( 'sciencexlite_pro_theme_url', 'https://wordpress.org/themes/sciencex-lite/reviews/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'sciencex-lite' ); ?></a>
				</p>
			</div>
		</div>

		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( wp_unslash($_GET['tab']) );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>

		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="sciencexlite-table-wrap">
			<table>
				<thead>
					<tr>
						<th class="table-feature-title"></th>
						<th><h3><?php esc_html_e('LITE', 'sciencex-lite'); ?></h3></th>
						<th><h3><?php esc_html_e('PRO', 'sciencex-lite'); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e('Responsive Design', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Translation Ready', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Header Seetings', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Settings', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Banner & Breadcrumbs', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Upload Your Own Logo', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Woocommerce Compatible', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Manage sidebar position', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Demo Content Ready', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Custom Widgets', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Parallax effect', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Background image/video', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Powerful theme options', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Unlimited Color', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Sticky Header', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('Footer Copyright & Layout', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e('One Click Demo Import', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Theme Features Core Plugin', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Drag and Drop Page Builder', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Documentation', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('850+ Google Fonts', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('18+ Shortcodes/Addons', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('24/7 Support', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Based on real content', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Pre Made Pages', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e('Pre Made Contact Forms', 'sciencex-lite'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
				</tbody>
			</table>
			<div class="sciencexlite-theme-actions btn-wrapper">
				<a href="<?php echo esc_url( apply_filters( 'sciencexlite_pro_theme_url', 'http://sciencex.wpmanageninja.com/' ) ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Live Demo', 'sciencex-lite' ); ?></a>
				<a href="<?php echo esc_url( apply_filters( 'sciencexlite_pro_theme_url', 'https://wpmanageninja.com/downloads/sciencex-multipurpose-researcher-professor-education-wordpress-theme/' ) ); ?>" class="button button-secondary bg-success" target="_blank"><?php esc_html_e( 'Get Pro', 'sciencex-lite' ); ?></a>
			</div>
		   </div>


			<div class="sciencexlite-theme-premade-demo">
				<h3><?php esc_html_e('PREMADE DEMO', 'sciencex-lite'); ?></h3>
				<div class="col-img">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/books-page.png'; ?>" />
				</div>
				<div class="col-img">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/journal-articles.png'; ?>" />
				</div>
				<div class="col-img">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/conferences-talks.png'; ?>" />
				</div>
				<div class="col-img">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/events.png'; ?>" />
				</div>
				<div class="col-img">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/shop.png'; ?>" />
				</div>
				<div class="col-img">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/personal-timeline.png'; ?>" />
				</div>
				<div class="col-img">
					<a target="_blank" href="<?php echo esc_url( 'http://sciencex.wpmanageninja.com/' ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/more.png'; ?>" />
					</a>
				</div>
			</div>

		</div>
		<?php
	}


}

endif;

return new Sciencex_Lite_Admin();
