<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package preferred_magazine
 */

?>

<footer id="colophon" class="site-footer">

    <section class="footer-top">
        <div class="container-fluid">
            <div class="row">
                <?php

                if ( esc_attr( get_theme_mod( 'footer_columns' ) ) == 'four' ) { ?>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget' ) ) :
                            dynamic_sidebar( 'footer-widget' );
                        endif;
                        ?>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget-2' ) ) :
                            dynamic_sidebar( 'footer-widget-2' );
                        endif;
                        ?>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget-3' ) ) :
                            dynamic_sidebar( 'footer-widget-3' );
                        endif;
                        ?>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget-4' ) ) :
                            dynamic_sidebar( 'footer-widget-4' );
                        endif;
                        ?>
                    </div>

                    <?php

                } elseif ( esc_attr( get_theme_mod( 'footer_columns' ) ) == 'three' ) { ?>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget' ) ) :
                            dynamic_sidebar( 'footer-widget' );
                        endif;
                        ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget-2' ) ) :
                            dynamic_sidebar( 'footer-widget-2' );
                        endif;
                        ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget-3' ) ) :
                            dynamic_sidebar( 'footer-widget-3' );
                        endif;
                        ?>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget' ) ) :
                            dynamic_sidebar( 'footer-widget' );
                        endif;
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 footer-top-padding">
                        <?php
                        if ( is_active_sidebar( 'footer-widget-2' ) ) :
                            dynamic_sidebar( 'footer-widget-2' );
                        endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section><!-- .footer-top -->

    <section class="footer-copy-right">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-info text-center">
                        <a href="<?php echo esc_url( 'https://www.themetim.com/' ); ?>">
                            <?php
                            $copyright = get_theme_mod( 'footer_copyright', 'Preferred Magazine powered by themetim' );
                            echo esc_html( $copyright );
                            ?>
                        </a>
                    </div><!-- .site-info -->
                </div>
            </div>
        </div>
    </section>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>