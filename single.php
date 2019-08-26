<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sciencexlite
 */

get_header(); 
$sciencexlite_blog_sidebar_layout = ( get_theme_mod('sciencexlite_blog_sidebar_layout') ) ? get_theme_mod('sciencexlite_blog_sidebar_layout') : 'right_sidebar';
$col_class = ( get_theme_mod('sciencexlite_blog_sidebar_layout') === 'no_sidebar') ? '8 col-md-offset-2' : '8';
?>

	<div class="sciencexlite-content-area blog <?php if(isset($kc_class)) { echo esc_attr($kc_class); }; ?>">
		<div class="container">
			<div class="row">
				<?php if($sciencexlite_blog_sidebar_layout === 'left_sidebar' ) { get_sidebar(); } ?>
			    <div class="col-md-<?php echo esc_attr($col_class); ?>">
						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'single');

							the_post_navigation(
						        array(
						        'prev_text'                  => esc_html__( 'Previous post', 'sciencex-lite'),
						        'next_text'                  => esc_html__( 'Next post', 'sciencex-lite'),
						    ) ); 

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						endwhile; // End of the loop.
						?>
				</div>
				<?php if($sciencexlite_blog_sidebar_layout === 'right_sidebar' ) { get_sidebar(); } ?>
			</div>
        </div>
	</div>

<?php
get_footer();
