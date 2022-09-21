<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package preferred_magazine
 */

get_header();
?>

    <main id="content" class="site-main<?php preferred_magazine_MarginTop(); ?>">

        <section class="error-404 not-found">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'preferred-magazine' ); ?></h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'preferred-magazine' ); ?></p>

                            <?php
                            get_search_form();
                            ?>
                        </div><!-- .page-content -->
                    </div>
                </div>
            </div>
        </section><!-- .error-404 -->

    </main><!-- #main -->

<?php
get_footer();
