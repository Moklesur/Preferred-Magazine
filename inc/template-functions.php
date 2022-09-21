<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package preferred_magazine
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function preferred_magazine_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed themetim';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // Adds a class of wide & boxed to site layout
    if ( esc_attr( get_theme_mod( 'site_layout', 'wide' ) ) == 'wide' ) {
        $classes[] =  "wide";

    }else{
        $classes[] = "boxed";
    }

    return $classes;
}
add_filter( 'body_class', 'preferred_magazine_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function preferred_magazine_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'preferred_magazine_pingback_header' );

/**
 *  Block Category / Featured post
 *  Only Show Home page
 */
function block_category_action(){
    $show_featured_posts = absint( get_theme_mod( 'show_featured_posts' ) );
    $layout_style = esc_attr( get_theme_mod( 'featured_posts_layout', '1' ) );
    $featured_post_types = esc_attr( get_theme_mod( 'featured_post_types' ) );
    $featured_post_types_1 = esc_attr( get_theme_mod( 'featured_post_types_1' ) );
    $featured_post_types_2 = esc_attr( get_theme_mod( 'featured_post_types_2' ) );
    $featured_post_limit = esc_attr( get_theme_mod( 'featured_post_limit', '3' ) );

    $category = $featured_post_types .','. $featured_post_types_1 .','. $featured_post_types_2;

    if( is_front_page() && $show_featured_posts ) : ?>
        <section class="mb-30 block-category pm-block-category-<?php echo esc_attr( $layout_style ); ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="width-100 featured-post-<?php echo esc_attr( $layout_style ); ?> featured-post-layout-<?php echo esc_attr( $layout_style ); ?>">

                        <?php

                        $block_category = array(
                            'posts_per_page'   => esc_attr( $featured_post_limit ),
                            'cat'   => array( $category ),
                            'no_found_rows' => true,
                            'post_status'   => 'publish',
                            'ignore_sticky_posts'   => true
                        );

                        $block_query = new WP_Query( $block_category );

                        if( $block_query->have_posts() ):

                            while( $block_query->have_posts() ) : $block_query->the_post();

                                global $post;
                                $thumb_img = 'none';
                                if ( has_post_thumbnail() ) :
                                    $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'preferred-magazine-lg-thumb' );
                                    if( isset( $thumb_url[0] ) )
                                        $thumb_img = $thumb_url[0];
                                endif;
                                ?>
                                <div class="featured-post-wrap slider-item">

                                    <div class="block-category-contents position-relative<?php echo ( has_post_thumbnail() ) ? ' has-img-shadow has-block-thumb' : ' no-block-thumb'; ?>" style="background: url('<?php echo esc_url( $thumb_img ); ?>')">
                                        <div class="block-contents">
                                            <a class="featured-post-xs" href="<?php echo esc_url( get_the_permalink() ); ?>">
                                                <img src="<?php echo esc_url( $thumb_img ); ?>" class="img-fluid" />
                                            </a>
                                            <div class="img-shadow">
                                                <div class="block-cats">
                                                    <?php preferred_magazine_cat_bg(); ?>
                                                </div>
                                                <h2>
                                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                                </h2>
                                                <div class="meta-data">
                                                    <?php preferred_magazine_readingWP(); ?>
                                                    <span>
                                                            <i class="ion-ios-time-outline"></i>
                                                        <?php echo get_the_date(); ?>
                                                        </span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            <?php

                            endwhile;
                            // Restore original Post Data
                            wp_reset_postdata();
                        endif;

                        ?>

                    </div>
                </div>
            </div>
        </section><!-- .block-category -->
    <?php endif;
}
add_action( 'preferred_magazine_block_category', 'block_category_action' );
/**
 *  News Feeds
 *  Top header
 */
function preferred_magazine_top_news_feeds(){

    $top_news = get_theme_mod( 'top_news', 'Top News' );

    ?>
    <div class="col-md-6 col-12 top-news d-flex">
        <p class="d-inline-block mr-1 mb-0">
            <span class="top-news-title"><?php echo esc_html( $top_news ); ?></span>
        </p>
        <div class="top-news-feed d-inline-block">

            <div id="preferred-magazine-news-feed" class="carousel slide carousel-fade breaking-news-feed" data-ride="carousel">
                <div class="carousel-inner">
                    <?php

                    $top_news_category = esc_attr( get_theme_mod( 'top_news_category' ) );

                    $top_news_cat = '';

                    if ( $top_news_category != '' ){
                        $top_news_cat = $top_news_category;
                    }

                    $query = new WP_Query( array(
                        'posts_per_page'      => 4,
                        'no_found_rows'       => true,
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => true,
                        'cat'   => array( $top_news_cat )
                    ) );

                    if ( $query->have_posts() ) :
                        while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div class="carousel-item">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <?php echo esc_html( get_the_title() ); ?>
                                </a>
                            </div>
                        <?php
                        endwhile; // End of the loop.
                        // Restore original Post Data
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div><!-- .top-news -->
    <?php
}
add_action( 'preferred_magazine_news_feed', 'preferred_magazine_top_news_feeds' );
/**
 *  Social Media Links
 */
function preferred_magazine_social_action() {
    if( get_theme_mod( 'fb_link' ) ) {
        echo '<a class="fb" href="'.esc_url( get_theme_mod( 'fb_link' ) ).'"  target="_blank"><i class="ion-social-facebook"></i></a>';
    }
    if( get_theme_mod( 'tw_link' ) ) {
        echo '<a class="tw"  href="'.esc_url( get_theme_mod( 'tw_link' ) ).'" target="_blank"><i class="ion-social-twitter"></i></a>';
    }
    if( get_theme_mod('yo_link') ) {
        echo '<a class="yo" href="'.esc_url( get_theme_mod('yo_link') ).'" target="_blank"><i class="ion-social-youtube"></i></a>';
    }
    if( get_theme_mod( 'li_link') ) {
        echo '<a class="li" href="'.esc_url( get_theme_mod('li_link') ).'" target="_blank"><i class="ion-social-linkedin"></i></a>';
    }
    if( get_theme_mod('pi_link') ) {
        echo '<a class="pi" href="'.esc_url( get_theme_mod('pi_link') ).'" target="_blank"><i class="ion-social-pinterest"></i></a>';
    }
    if( get_theme_mod('in_link') ) {
        echo '<a class="in" href="'.esc_url( get_theme_mod('in_link') ).'" target="_blank"><i class="ion-social-instagram"></i></a>';
    }
    if( get_theme_mod('dri_link') ) {
        echo '<a class="dr" href="'.esc_url( get_theme_mod('dri_link') ).'" target="_blank"><i class="ion-social-dribbble"></i></a>';
    }
    if( get_theme_mod('gp_link') ) {
        echo '<a class="gp" href="'.esc_url( get_theme_mod('gp_link') ).'" target="_blank"><i class="ion-social-googleplus"></i></a>';
    }
}
add_action( 'preferred_magazine_social', 'preferred_magazine_social_action' );