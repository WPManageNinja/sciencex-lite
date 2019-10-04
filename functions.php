<?php
/**
 * sciencexlite functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sciencexlite
 */

if ( ! function_exists('sciencexlite_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function sciencexlite_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on sciencexlite, use a find and replace
         * to change 'sciencex-lite' to the name of your theme in all the template files.
         */
        load_theme_textdomain('sciencex-lite', get_template_directory().'/languages');

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');


        // WooCommerce Support
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'sciencexlite-primary' => esc_html__('Primary', 'sciencex-lite')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         */
        add_theme_support('post-formats', array('gallery', 'image', 'quote', 'video', 'audio'));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('sciencexlite_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        add_image_size('sciencexlite-blog-thumb', '100', '80', true);

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
        
	    /*
		 * Enable support for wide alignment class for Gutenberg blocks.
		*/
	    add_theme_support( 'align-wide' );
    }
endif;
add_action('after_setup_theme', 'sciencexlite_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sciencexlite_content_width()
{
    $GLOBALS['content_width'] = apply_filters('sciencexlite_content_width', 640);
}

add_action('after_setup_theme', 'sciencexlite_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sciencexlite_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'sciencex-lite'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'sciencex-lite'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Footer widget
    for ($footer_col = 1; $footer_col <= 3; $footer_col++) {
        register_sidebar(array(
            'name'          => esc_html__('Footer Widgets', 'sciencex-lite').$footer_col,
            'id'            => 'sciencexlite'.'-footer-'.$footer_col,
            'description'   => esc_html__('Add footer widgets here.', 'sciencex-lite'),
            'before_widget' => '<div id="%1$s" class="f-top-center widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}

add_action('widgets_init', 'sciencexlite_widgets_init');


/**
 * Enqueue google fonts.
 */
function sciencexlite_google_fonts_url()
{
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Mina, translate this to 'off'. Do not translate
    * into your own language.
    */
    $mina = _x('on', 'Mina font: on or off', 'sciencex-lite');

    /* Translators: If there are characters in your language that are not
    * supported by Slabo+27px, translate this to 'off'. Do not translate
    * into your own language.
    */
    $slabo_27px = _x('on', 'Slabo 27px font: on or off', 'sciencex-lite');

    if ('off' !== $mina || 'off' !== $slabo_27px) {
        $font_families = array();

        if ('off' !== $mina) {
            $font_families[] = 'Mina:400,700';
        }

        if ('off' !== $slabo_27px) {
            $font_families[] = 'Slabo 27px:400';
        }

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Enqueue scripts and styles.
 */
function sciencexlite_scripts()
{

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('sciencexlite-fonts', sciencexlite_google_fonts_url(), array(), null);

    //Load CSS
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '3.3.2');
    wp_enqueue_style('ionicons-min', get_template_directory_uri().'/assets/css/ionicons.min.css', array(), '2.0.0');
    wp_enqueue_style('animate-min', get_template_directory_uri().'/assets/css/animate.min.css', array(), '1.0.0');
    wp_enqueue_style('bootstrap-dropdownhover-min',
        get_template_directory_uri().'/assets/css/bootstrap-dropdownhover.min.css', array(), '1.0.0');

    wp_enqueue_style('sciencexlite-main', get_template_directory_uri().'/assets/css/main.css', array(), '1.0.2');
    wp_enqueue_style('sciencexlite-style', get_stylesheet_uri(), array(), '1.0.7');


    //Load JS
    wp_enqueue_script('bootstrap-dropdownhover-min',
        get_template_directory_uri().'/assets/js/bootstrap-dropdownhover.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), '3.3.2',
        true);
    wp_enqueue_script('sciencexlite-main-jquery', get_template_directory_uri().'/assets/js/sciencexlite-main-jquery.js',
        array('jquery'), '1.0.2', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'sciencexlite_scripts');


/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function sciencexlite_gutenberg_editor_styles() {
	wp_enqueue_style( 'sciencexlite-gutenberg-editor', get_theme_file_uri( '/assets/css/gutenberg-editor.css' ), false, '1.0.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'sciencexlite_gutenberg_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory().'/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory().'/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory().'/inc/jetpack.php';
}


/**
 * Bootstrap wp menu walker
 */
require_once get_template_directory().'/inc/wp-sciencexlite-bootstrap-navwalker.php';

/**
 * Load theme custom functions
 */
require_once get_template_directory().'/inc/global-functions.php';


/**
 * Load TGM
 */
require get_template_directory() . '/inc/tgm-plugin/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgm-plugin/sciencex-lite-required-plugins.php';

/**
 * Modify search widget
 */
function sciencexlite_blog_search_widget()
{
    $form
        = '
	    <div class="search-form">
			<form role="search" method="get" id="searchform" class="searchform" action="'.esc_url(home_url('/')).'" >
			    <input type="search" value="'.get_search_query()
          .'" name="s" class="search-field form-control"  placeholder="'.esc_attr__('Search', 'sciencex-lite').'">
			    <label class="hide">'.esc_html('Search for', 'sciencex-lite').':</label>
			    <button type="submit" class="search-submit"><i class="ion-search"></i></button>
			</form>
		</div>';

    return $form;
}

add_filter('get_search_form', 'sciencexlite_blog_search_widget');

// remove pages from search
function sciencexlite_remove_pages_from_search()
{
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}

add_action('init', 'sciencexlite_remove_pages_from_search');

/**
 * Modify excerpt length
 */
function sciencexlite_excerpt_length($length)
{
    $sciencexlite_blog_content_length = (get_theme_mod('sciencexlite_blog_content_length'))
        ? get_theme_mod('sciencexlite_blog_content_length') : 55;

    return $sciencexlite_blog_content_length;
}

add_filter('excerpt_length', 'sciencexlite_excerpt_length', 999);

/**
 * Modify archive widget
 */
function sciencexlite_archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', ' <span>(', $links);
    $links = str_replace(')', ')</span></a>', $links);

    return $links;
}

add_filter('get_archives_link', 'sciencexlite_archive_count_span');
/**
 * Modify category widget
 */
function sciencexlite_category_count_span($links)
{
    $links = str_replace('</a> (', ' <span>(', $links);
    $links = str_replace(')', ')</span></a>', $links);

    return $links;
}

add_filter('wp_list_categories', 'sciencexlite_category_count_span');


function sciencexlite_comment_reform($arg)
{
    $arg['title_reply'] = esc_html__('Leave a Reply', 'sciencex-lite');
    $col_class = (is_user_logged_in()) ? 'col-sm-12' : 'col-sm-6';
    $row_end = (is_user_logged_in()) ? '</div>' : '';

    $arg['comment_field'] = '<div class="row"><div class="'.esc_attr($col_class)
                            .'"><div class="form-group"><label for="author">'.esc_html__("Comment", "sciencex-lite")
                            .' <span class="required">*</span></label><textarea id="comment" class="form-control" name="comment" rows="6" placeholder="'
                            .esc_html__("Type your comment...", "sciencex-lite")
                            .'" aria-required="true"></textarea></div></div>'.$row_end.'';

    return $arg;
}

add_filter('comment_form_defaults', 'sciencexlite_comment_reform');


// Comment form modify
function sciencexlite_modify_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $row_end = ( ! is_user_logged_in()) ? '</div>' : '';

    $fields['author'] = '<div class="col-sm-6"><div class="form-group"><label for="author">'.esc_html__("Name",
            "sciencex-lite")
                        .' <span class="required">*</span></label><input type="text" name="author" id="author" value="'
                        .esc_attr($commenter['comment_author']).'" placeholder="'.esc_attr__("Your Name",
            "sciencex-lite").'" size="22" tabindex="1" '.($req ? 'aria-required="true"' : '')
                        .' class="form-control" /></div>';

    $fields['email'] = '<div class="form-group"><label for="email">'.esc_html__("Email", "sciencex-lite")
                       .' <span class="required">*</span></label><input type="text" name="email" id="email" value="'
                       .esc_attr($commenter['comment_author_email']).'" placeholder="'.esc_attr__("Your Email",
            "sciencex-lite").'" size="22" tabindex="2" '.($req ? 'aria-required="true"' : '')
                       .' class="form-control"  /></div></div>'.$row_end.'';

    $fields['url'] = '';

    return $fields;
}

add_filter('comment_form_default_fields', 'sciencexlite_modify_comment_form_fields'); 



/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
    require get_template_directory() . '/inc/admin/sciencexlite-admin-page.php';
}

/**
 * Load upsell button in the customizer
 */
require get_template_directory() . '/inc/upsell/class-customize.php';