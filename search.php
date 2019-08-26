<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
    <header class="sabbi-page-header page-header-lg">
        <div class="page-header-content conternt-center">
            <div class="header-title-block">
            	<h1 class="page-title">
            	<?php 
            	    /* translators: %s: Title of Search Result */
            		printf( esc_html__( 'Search Results for: &ldquo;%s&rdquo;', 'sciencex-lite' ), '<span>' . esc_html(get_search_query()) . '</span>' );
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

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

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
