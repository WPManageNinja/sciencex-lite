<?php 
    $sciencexlite_single_blog_image = get_theme_mod('sciencexlite_single_blog_image', true);
    $sciencexlite_single_blog_meta = get_theme_mod('sciencexlite_single_blog_meta', true);
    $sciencexlite_single_blog_footer = get_theme_mod('sciencexlite_single_blog_footer', true);
?>
<!--blog single section start here-->
<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-image">
        <?php if( has_post_thumbnail() && $sciencexlite_single_blog_image ){ ?>
        <figure>
            <?php the_post_thumbnail( 'full' , array( 'class' => 'img-responsive') ) ?>
        </figure>
        <?php } ?>

        <?php if( $sciencexlite_single_blog_meta ){ ?>
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

    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
    
        <?php if( has_tag() && $sciencexlite_single_blog_footer ){ ?>
        <div class="blog-tag"><i class="ion-folder"></i><strong><?php esc_html_e('Tags: ','sciencex-lite'); ?></strong><?php the_tags('', ''); ?></div>
        <?php } ?>
        <?php   
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sciencex-lite' ),
                'after'  => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>

    </div><!-- .entry-content -->

</article> <!-- /.blog-single -->
