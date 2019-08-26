<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sciencexlite
 */


$sciencexlite_blog_image = get_theme_mod('sciencexlite_blog_image', true);
$sciencexlite_blog_header_meta = get_theme_mod('sciencexlite_blog_header_meta', true);
$sciencexlite_blog_category = get_theme_mod('sciencexlite_blog_category', true);
$sciencexlite_blog_read_more_btn = get_theme_mod('sciencexlite_blog_read_more_btn', true);
$sciencexlite_blog_read_more_btn_text = ( get_theme_mod('sciencexlite_blog_read_more_btn_text') ) ? get_theme_mod('sciencexlite_blog_read_more_btn_text') : 'Read More';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	 <div class="post-image">

	 	<?php if( has_post_thumbnail() && $sciencexlite_blog_image ){ ?>
		<figure>
		    <?php the_post_thumbnail( 'full' , array( 'class' => 'img-responsive') ) ?>
		</figure>
		<?php } ?>

	 	<?php if( $sciencexlite_blog_header_meta ){ ?>
		<div class="entry-meta">
			<ul class="post-meta">
				<li><i class="ion-calendar"></i><span><?php echo get_the_date(); ?></span></li>
				<li>
					<i class="ion-chatbox"></i>
					<span>
						<?php comments_popup_link( esc_html__('N/A','sciencex-lite'), esc_html__('1 Comment','sciencex-lite'), esc_html__('% Comments','sciencex-lite'), ' ', esc_html__('Comments off','sciencex-lite')); ?>
					</span>
				</li>
			</ul>
		</div><!-- .entry-meta -->
		<?php } ?>

	</div>
	
	<div class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        ?>
	</div><!-- .entry-header -->

	<div class="entry-content">
		
		<?php the_excerpt(); ?>
       
		<?php if( has_category() && $sciencexlite_blog_category ): ?>
			<div class="blog-cat"><i class="ion-folder"></i><?php the_category(', '); ?></div>
		<?php endif; ?>

		<?php if( $sciencexlite_blog_read_more_btn ): ?>
		<a href="<?php echo esc_url( get_permalink()); ?>" class="read-more">
			<?php 
				if( $sciencexlite_blog_read_more_btn ):
					echo esc_html($sciencexlite_blog_read_more_btn_text);
				endif;
			?>
			</a>
		<?php endif; ?>
		
		<?php	
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sciencex-lite' ),
				'after'  => '</div>',
				'link_before' => '<span>',
	            'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

</article>
