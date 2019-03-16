<?php
/**
 * preferred magazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package preferred_magazine
 */

if ( ! function_exists( 'preferred_magazine_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function preferred_magazine_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        /*
         * Define custom image size
         */
        add_image_size( 'preferred-magazine-lg-thumb', 800, '700', true );
        add_image_size( 'preferred-magazine-md-thumb', 550, '', true );
        add_image_size( 'preferred-magazine-sm-thumb', 400, '400', true );
        add_image_size( 'preferred-magazine-xs-thumb', 100, '100', true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'preferred-magazine' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'preferred_magazine_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'preferred_magazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function preferred_magazine_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'preferred_magazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'preferred_magazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function preferred_magazine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'preferred-magazine' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'preferred-magazine' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title text-uppercase">',
		'after_title'   => '</h2>',
	) );
	// Hamburg Widget
    register_sidebar( array(
        'name'          => esc_html__( 'Hamburg', 'preferred-magazine' ),
        'id'            => 'hamburg',
        'description'   => esc_html__( 'Add widgets here.', 'preferred-magazine' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-uppercase">',
        'after_title'   => '</h4>',
    ) );

    $args_footer_widgets = array(
        'name'          => __( 'Footer %d', 'preferred-magazine' ),
        'id'            => 'footer-widget',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="footer-widget mt-20 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="footer-widget-title mb-20">',
        'after_title'   => '</h5>'
    );

    register_sidebars( 4, $args_footer_widgets );
}

add_action( 'widgets_init', 'preferred_magazine_widgets_init' );

/**
 * Custom Elementor widgets
 */
function preferred_magazine_register_elementor_widgets() {

    if ( defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base') ) {
        require get_template_directory() . '/inc/widgets/category-post-slider.php';
        require get_template_directory() . '/inc/widgets/category-post.php';
        require get_template_directory() . '/inc/widgets/most-popular-post.php';
        require get_template_directory() . '/inc/widgets/trading-post.php';
        require get_template_directory() . '/inc/widgets/featured-news.php';
        require get_template_directory() . '/inc/widgets/product-filter.php';
    }
}
add_action( 'elementor/widgets/widgets_registered', 'preferred_magazine_register_elementor_widgets' );

/**
 * Enqueue scripts and styles.
 */
function preferred_magazine_scripts() {
    if ( ! class_exists( 'Kirki' ) ) {
        wp_enqueue_style('preferred-magazine-body-fonts', '//fonts.googleapis.com/css?family=Roboto:400:500');
        wp_enqueue_style('preferred-magazine-heading-fonts', '//fonts.googleapis.com/css?family=Oswald:500');
    }

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '1.8.0' );
    wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array(), '4.7.0' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3' );
	wp_enqueue_style( 'preferred-magazine-style', get_stylesheet_uri() );

    wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.8.0', true );
    wp_enqueue_script( 'jquery-popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '1.12.5', true );
    wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), '3.0.4', true );
    wp_enqueue_script( 'jquery-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.3', true );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'preferred-magazine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'preferred_magazine_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WP Bootstrap Nav Walker file.
 */
if ( ! class_exists( 'WP_Bootstrap_Navwalker' )) {
    require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

/**
 * Reading Time WP.
 */
function preferred_magazine_readingWP(){
    if ( class_exists( 'Reading_Time_WP' )) {
        echo '<span class="mr-2">'.do_shortcode('[rt_reading_time postfix="mins read"]').'</span>';
    }
}

/**
 * Post Category BG Color
 */
function preferred_magazine_cat_bg(){
    ?>
    <div class="category-bg">
        <?php
        $categories_list = get_the_category();
        foreach( $categories_list as $category ){
            $preferred_magazine_cat_bg_color = get_theme_mod( 'category_color_' . $category->term_id );

            if ( $preferred_magazine_cat_bg_color != '' ){
                echo '<a class="category-has-bg" href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background:' . esc_attr( $preferred_magazine_cat_bg_color ) . '">'. esc_html( $category->cat_name ) .'</a>';
            }else{
                echo '<a class="category-no-bg" href="' . esc_url( get_category_link( $category->term_id ) ) . '">'. esc_html( $category->cat_name ) .'</a>';
            }
        } ?>
    </div>
    <?php
}

/**
 * Load TGM Plugin
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'preferred_magazine_active_plugins' );

function preferred_magazine_active_plugins() {
    $plugins = array(
        array(
            'name'      => __( 'Elementor Page Builder by Elementor', 'preferred-magazine' ),
            'slug'      => 'elementor',
            'required'  => false,
        ),
        array(
            'name'      => __( 'Contact Form 7', 'preferred-magazine' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => __( 'Reading Time WP', 'preferred-magazine' ),
            'slug'      => 'reading-time-wp',
            'required'  => false,
        ),
        array(
            'name'      => __( 'kirki Customizer', 'preferred-magazine' ),
            'slug'      => 'kirki',
            'required'  => false,
        ),
        array(
            'name'      => __( 'WooCommerce', 'preferred-magazine' ),
            'slug'      => 'woocommerce',
            'required'  => false,
        )
    );
    tgmpa( $plugins );
}

/**
 * Kirki Plugin Admin Notice Dismiss
 */
add_action( 'admin_notices', 'preferred_magazine_plugin_dismiss_notice' );
function preferred_magazine_plugin_dismiss_notice() {
    global  $pagenow;
    if( $pagenow == 'customize.php' ) :
    $user_id = get_current_user_id();
    if ( !get_user_meta( $user_id, 'preferred_magazine_kirki_plugin_dismissed' ) )
        echo '<p class="dismiss-button"><a href="?preferred_magazine_kirki_dismissed">'.esc_html( 'Dismiss' ).'</a></p>';
    endif;
}

add_action( 'admin_init', 'preferred_magazine_kirki_plugin_dismissed' );
function preferred_magazine_kirki_plugin_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['preferred_magazine_kirki_dismissed'] ) )
        add_user_meta( $user_id, 'preferred_magazine_kirki_plugin_dismissed', 'true', true );
}

/**
 * Margin Top
 */
function preferred_magazine_MarginTop(){
    if ( ! is_front_page() ){
        echo ' margin-top';
    }
}

/**
 * WooCommerce
 * Add To Cart Button to icon
 */
add_filter( 'add_to_cart_text', 'preferred_magazine_product_add_to_cart_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'preferred_magazine_product_add_to_cart_text' );
function preferred_magazine_product_add_to_cart_text() {
    return __( ' ', 'preferred-magazine' );
}
// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * @param $elements_manager
 * elementor Category Name
 */
function preferred_magazine_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'preferred_magazine',
        [
            'title' => __( 'PM Widgets', 'preferred-magazine' ),
            'icon' => 'fa fa-plug',
        ]
    );

}
add_action( 'elementor/elements/categories_registered', 'preferred_magazine_elementor_widget_categories' );