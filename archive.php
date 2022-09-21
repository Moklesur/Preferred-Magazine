<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package preferred_magazine
 */

get_header();
?>

    <main id="content" class="site-main<?php preferred_magazine_MarginTop(); ?>">
        <section class="archive-pm">
            <div class="page-header col-12 text-center mb-20">
                <?php
                the_archive_title( '<h1 class="page-title m-0 text-capitalize">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </div><!-- .page-header -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12 mt-30">
                        <?php if ( have_posts() ) :

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
                    get_sidebar();
                    ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->

<?php
get_footer();
