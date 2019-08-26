<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sciencexlite
 */
    $sciencexlite_copyright_section_visiblity = get_theme_mod('sciencexlite_copyright_section_visiblity', true);
    $sciencexlite_footer_widgets_section_visiblity = get_theme_mod('sciencexlite_footer_widgets_section_visiblity', true);
?>
	<footer id="colophon" class="site-footer section-footer">
        
         <?php if( $sciencexlite_footer_widgets_section_visiblity ) : ?>
         <div class="container">
            <div class="row">
                <?php for( $col_class = 1; $col_class <= 3 ; $col_class++ ) { ?>
                <div class="col-sm-4">
                    <div class="footer-site-info footer-widget">
                        <?php dynamic_sidebar( 'sciencexlite-footer-' . esc_html($col_class) ); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div> 
        <?php endif; ?>

        <?php if( $sciencexlite_copyright_section_visiblity ) : ?>
        <div id="site-footer-bar" class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="widget_black_studio_tinymce" id="black-studio-tinymce-4">
                            <div class="copyright">
                                <?php
                                    $site_title = get_bloginfo( 'name' );
                                    /* translators: %s: CMS name, i.e. Sciencex Lite. */
                                    printf( esc_html__( 'Copyright &copy; 2018 %s', 'sciencex-lite' ), esc_html($site_title) );
                                ?>
                            </div>
                        </div>
                    </div>
          
                    <div class="col-sm-4 ">
                        <div class="powredby">
                            <?php
                                /* translators: 1: Theme name, 2: Theme author. */
                                printf( esc_html__( 'Theme: %1$s by %2$s.', 'sciencex-lite' ), 'Sciencex Lite', '<a href=" '.esc_url('https://wpmanageninja.com/').'">WpManageNinja</a>' );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->
</div> <!-- end site main -->

<?php wp_footer(); ?>

</body>
</html>
