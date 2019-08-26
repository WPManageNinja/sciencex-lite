<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sciencexlite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="<?php echo esc_url( 'gmpg.org/xfn/11'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
    $sciencexlite_preloader = get_theme_mod('sciencexlite_preloader', true);
    $sciencexlite_page_layout_style = get_theme_mod('sciencexlite_page_layout_style', false);
    $sciencexlite_sticky_menu = get_theme_mod('sciencexlite_sticky_menu', false);
    $sciencexlite_main_menu_btn_title = get_theme_mod('sciencexlite_main_menu_btn_title');
    $sciencexlite_main_menu_btn_link = get_theme_mod('sciencexlite_main_menu_btn_link');
?>

<!-- start preloader -->
<?php if( $sciencexlite_preloader ){ ?>
<div class="preloader-wrap">
    <div class="preloader-spinner">
        <div class="preloader-dot1"></div>
        <div class="preloader-dot2"></div>
    </div>
</div>
<?php } ?>
<!-- / end preloader -->


<div class="site-main">
<div id="page" class="site <?php if( $sciencexlite_page_layout_style ){ echo esc_attr('box-layout'); } ?>">

        <header class="sabbi-site-head">
        <nav class="navbar navbar-white navbar-kawsa <?php if( $sciencexlite_sticky_menu ){ echo esc_attr('navbar-fixed-top'); } ?> <?php if( $sciencexlite_page_layout_style ){ echo esc_attr('box-layout-navbar'); }  ?>" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button"><span class="sr-only"> <?php esc_html_e('Toggle navigation', 'sciencex-lite'); ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button> 
                    
                    
                    <?php if( has_custom_logo() ) { ?>
                        <div class="logo">
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" data-scroll>
                            <?php the_custom_logo(); ?>
                        </a>
                        </div>
                    <?php } else { ?>
                        <h1 class="sciencex-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>   
                    <?php } ?>

                </div>
                <div class="navbar-collapse collapse sabbi-navbar-collapse  navbar-nav-hov_underline" id="navbar">
                    
                    <?php if( $sciencexlite_main_menu_btn_link && $sciencexlite_main_menu_btn_title ){ ?>
                    <div class="nav-btn-wrap"><a href="<?php echo esc_url($sciencexlite_main_menu_btn_link);?>" class="btn btn-primary pull-right"><?php echo esc_html($sciencexlite_main_menu_btn_title);?></a></div>
                    <?php } ?>
                   
                    <?php if( function_exists('sciencexlite_main_menu') ){ sciencexlite_main_menu(); } ?>
                </div>
            </div>
        </nav><!-- /.navbar -->
    </header><!-- #masthead -->