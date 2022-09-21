<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package preferred_magazine
 */

get_header();
?>

    <main id="content" class="site-main<?php preferred_magazine_MarginTop(); ?>">
        <section class="search-pm">
            <div class="page-header col-12 text-center">
                <h1 class="page-title m-0">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'preferred-magazine' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12 mt-30">
                        <?php if ( have_posts() ) :

                            /* Start the Loop */
                            while ( have_posts() ) :
                                the_post();

                                /**
                                 * Run the loop for the search to output the results.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-search.php and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', 'search' );

                            endwhile;

                            the_posts_navigation();

                        else :

                            get_template_part( 'template-parts/content', 'none' );

                        endif;
                        ?>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->

<?php
get_footer();
