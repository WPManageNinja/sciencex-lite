<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sciencexlite
 */

get_header(); 
$sciencexlite_site_banner = get_theme_mod('sciencexlite_site_banner', true);
?>

    <?php if( $sciencexlite_site_banner ) : ?>
	<header class="sabbi-page-header page-header-lg" <?php if( has_post_thumbnail() ) { ?> style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>);" <?php } ?>>
        <div class="page-header-content conternt-center">
            <div class="header-title-block">
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            </div>
	    </div>
    </header>
	<?php endif; ?>

    
	<div class="sciencexlite-content-area">
		<div class="container">
			<div class="row">
			    <div class="col-md-12">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
			</div>
        </div>
	</div>

<?php
get_footer();
