<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package sciencexlite
 */

get_header(); 
?>

	<div class="sciencexlite-content-area site-padding">
		<div class="container">
			<div class="row">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'sciencex-lite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'sciencex-lite' ); ?></p>

					<?php
						get_search_form();
					?>

					<div class="col-md-3">
						<div class="error-page-widget">
							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
						</div>
					</div>

					<div class="col-md-3">
						<div class="error-page-widget widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'sciencex-lite' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="error-page-widget">
							<?php

								/* translators: %1$s: smiley */
								$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'sciencex-lite' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="error-page-widget widget">
							<?php
								the_widget( 'WP_Widget_Tag_Cloud' );
							?>
						</div>
					</div>
					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
	        </div>
        </div>
	</div>

<?php
get_footer();
