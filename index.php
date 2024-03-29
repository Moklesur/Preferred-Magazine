<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package preferred_magazine
 */

get_header();

$col = '12';
if ( absint( get_theme_mod( 'hide_sidebar', true ) ) ) {
    $col = '9 ';
}
$blog_layout = get_theme_mod( 'blog_layout', 'blog-layout-2' );

?>
    <main id="content" class="site-main<?php preferred_magazine_MarginTop(); ?>">
        <section class="pm-index">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-<?php echo esc_attr( $col ); ?> <?php echo esc_attr( $blog_layout ); ?> col-md-8 col-12 mt-30">
                        <?php
                        if ( have_posts() ) :

                            if ( is_home() && ! is_front_page() ) :
                                ?>
                                <header>
                                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                </header>
                            <?php
                            endif;

                            /* Start the Loop */
                            while ( have_posts() ) :
                                the_post();

                                /*
                                 * Include the Post-Type-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', get_post_type() );

                            endwhile;

                            the_posts_navigation();

                        else :

                            get_template_part( 'template-parts/content', 'none' );

                        endif;
                        ?>
                    </div>
                    <?php
                    if ( absint( get_theme_mod( 'hide_sidebar', true ) ) ) {
                        get_sidebar();
                    } ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->

<?php
get_footer();