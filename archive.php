<?php
/**
 * The template for displaying archive pages
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
            	<h1 class="page-title">
            	<?php 
            		if ( is_day() ) :
            		 /* translators: %s: Date of daily arcive post */
			          printf( esc_html__( 'Daily Archives: %s', 'sciencex-lite' ), '<span>' . esc_html(get_the_date()) . '</span>' );
			        elseif ( is_month() ) :
			          /* translators: %s: Date of Monthly arcive post */
			          printf( esc_html__( 'Monthly Archives: %s', 'sciencex-lite' ), '<span>' . esc_html(get_the_date( _x( 'F Y', 'monthly archives date format', 'sciencex-lite' ) )) . '</span>' );
			        elseif ( is_year() ) :
			          /* translators: %s: Date of Yearly arcive post */
			          printf( esc_html__( 'Yearly Archives: %s', 'sciencex-lite' ), '<span>' . esc_html(get_the_date( _x( 'Y', 'yearly archives date format', 'sciencex-lite' ) )) . '</span>' );
			        else :
			          esc_html_e( 'Archives', 'sciencex-lite' );
			        endif;
            	 ?>
            	</h1>
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
	         <?php if( $sciencexlite_blog_sidebar_layout == 'right_sidebar' ) { get_sidebar(); } ?>
        </div>
	</div>
	</div>

<?php
get_footer();

