<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sciencexlite
 */

get_header(); 

$sciencexlite_blog_sidebar_layout = ( get_theme_mod('sciencexlite_blog_sidebar_layout') ) ? get_theme_mod('sciencexlite_blog_sidebar_layout') : 'right_sidebar';
$sciencexlite_blog_page_title = ( get_theme_mod('sciencexlite_blog_page_title') ) ? get_theme_mod('sciencexlite_blog_page_title') : '';

$col_class = ( get_theme_mod('sciencexlite_blog_sidebar_layout') === 'no_sidebar') ? '8 col-md-offset-2' : '8';
$sciencexlite_site_banner = get_theme_mod('sciencexlite_site_banner', true);
?>

    <?php if( $sciencexlite_site_banner ) : ?>
    <header class="sabbi-page-header page-header-lg" <?php if( get_header_image() ) { ?> style="background-image: url('<?php esc_url( header_image() ); ?>');" <?php } ?>>
        <div class="page-header-content conternt-center">
            <div class="header-title-block">
            	<?php if($sciencexlite_blog_page_title) { ?>
            	<h1 class="page-title"><?php echo esc_html($sciencexlite_blog_page_title); ?></h1>
            	<?php } else { ?>
            	<h1 class="page-title"><?php esc_html_e('Blog', 'sciencex-lite'); ?></h1>
            	<?php } ?>
            </div>
	    </div>
    </header>
	<?php endif; ?>

	<div class="sciencexlite-content-area blog">
		<div class="container">
			<div class="row">

				<?php if($sciencexlite_blog_sidebar_layout === 'left_sidebar' ) { get_sidebar(); } ?>
				
			    <div class="col-md-<?php echo esc_attr($col_class); ?>">
					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php
						endif;


						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content' );

						endwhile;

						sciencexlite_pagination();
                    ?>

				    <?php
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</div>
				<?php if($sciencexlite_blog_sidebar_layout === 'right_sidebar' ) { get_sidebar(); } ?>
				
			</div>
        </div>
	</div>

<?php
get_footer();
