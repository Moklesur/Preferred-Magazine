<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package preferred_magazine
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'preferred-magazine' ); ?></a>
<a href="#" id="back-to-top" title="<?php esc_attr_e( 'Back to top', 'preferred-magazine' ); ?>">&uarr;</a>
<div id="page" class="site">

    <header id="masthead" class="site-header">

        <?php if ( absint( get_theme_mod( 'hide_top_bar', true ) ) ) : ?>
        <section class="top-bar pt-2 pb-2">
            <div class="container-fluid">
                <div class="row">
                    <?php do_action( 'preferred_magazine_news_feed' ); ?>
                    <div class="col-md-6 col-12 social-top-bar text-left text-md-right ">
                        <?php

                        if ( get_theme_mod( 'hide_top_bar_social', false ) === true ){
                            do_action( 'preferred_magazine_social' );
                        }

                        ?>
                    </div><!-- .social-top-bar -->
                </div>
            </div>
        </section><!-- .top-bar -->
        <?php endif; ?>

        <section class="header-main pt-3 pb-3 main-menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <nav class="navbar navbar-expand-lg p-0">
                            <div class="site-branding">
                                <?php
                                the_custom_logo();
                                if ( is_front_page() && is_home() ) :
                                    ?>
                                    <h1 class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php
                                else :
                                    ?>
                                    <h2 class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                                <?php
                                endif;
                                $preferred_magazine_description = get_bloginfo( 'description', 'display' );
                                if ( $preferred_magazine_description || is_customize_preview() ) :
                                    ?>
                                    <p class="site-description mb-0"><?php echo esc_html( $preferred_magazine_description ) /* WPCS: xss ok. */ ?></p>
                                <?php endif; ?>
                            </div><!-- .site-branding -->

                            <?php
                            wp_nav_menu( array(
                                    'theme_location'    => 'menu-1',
                                    'container'			=> 'div',
                                    'container_class'	=> 'collapse navbar-collapse',
                                    'container_id'		=> 'preferred-magazine-navbar-collapse',
                                    'menu_class'		=> 'navbar-nav ml-auto',
                                    'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                                    'walker'			=> new WP_Bootstrap_Navwalker()
                                )
                            ); ?>
                            <div class="search-cart-mobile">
                                <?php

                                if ( get_theme_mod( 'hide_search', true ) ) : ?>
                                    <div class="search-modal d-inline">
                                        <a href="#" class="search-action"><i class="ion-search"></i></a>
                                    </div>
                                <?php endif;

                                if ( get_theme_mod( 'woo_hide_cart' ) && class_exists( 'WooCommerce' ) ) : ?>
                                    <div class="mini-cart-fix d-inline">
                                        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" >
                                            <i class="ion-android-cart"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="mobile-bar d-inline">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#preferred-magazine-navbar-collapse" aria-controls="preferred-magazine-navbar-collapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'preferred-magazine' ); ?>">
                                        <span><?php esc_html_e('Menu', 'preferred-magazine'); ?></span><i class="ion-android-menu"></i>
                                    </button>
                                </div>
                            </div>
                        </nav><!-- #site-navigation -->
                    </div>
                </div>
            </div>

        </section><!-- .header-main -->

    </header><!-- #masthead -->

    <div class="search-dropdown">
        <?php get_search_form(); ?>
    </div>

    <?php

    do_action( 'preferred_magazine_block_category' );

    if ( get_theme_mod( 'header_ads_show' ) ) : ?>

        <div class="ads-banner text-center">
            <?php if ( get_header_image() ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'ads_url' ) );  ?>">
                    <img src="<?php header_image(); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" class="img-fluid">
                </a>
            <?php endif; ?>
        </div>

    <?php endif; ?>
