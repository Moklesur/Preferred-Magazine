<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package preferred_magazine
 */
$class[] = 'block-contents mb-30';
$class[] .= ( has_post_thumbnail() && absint( get_theme_mod('blog_featured_image', true ) ) ) ? ' blog-content-wrap-fix' : ' off-featured-image';

$blog_layout_2 = esc_attr( get_theme_mod( 'blog_layout', 'blog-layout-2' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <?php
    if ( has_post_thumbnail() && absint( get_theme_mod('blog_featured_image', true ) ) ) : ?>
        <div class="post-thumb-items<?php echo ( has_post_thumbnail() ) ? ' has-items-thumb' : ''; ?> position-relative">
            <?php
            preferred_magazine_post_thumbnail();
            if ( $blog_layout_2 != 'blog-layout-2' && absint( get_theme_mod('blog_post_meta', true ) ) ) :
                ?>
                <div class="block-cats">
                    <?php preferred_magazine_cat_bg(); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="blog-content-wrap">
        <?php if ( $blog_layout_2 == 'blog-layout-2' && absint(get_theme_mod('blog_post_meta', true ) ) ) : ?>
            <div class="block-cats">
                <?php preferred_magazine_cat_bg(); ?>
            </div>
        <?php
        elseif ( ! has_post_thumbnail() && $blog_layout_2 == 'blog-layout-1' && absint( get_theme_mod('blog_post_meta', true ) ) ) : ?>
            <div class="block-cats">
                <?php preferred_magazine_cat_bg(); ?>
            </div>
        <?php endif; ?>
        <div class="entry-header mb-20">
            <?php
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
            if ( 'post' === get_post_type() && absint( get_theme_mod('blog_post_meta', true ) ) ) :
                ?>
                <div class="entry-meta">
                    <?php

                    preferred_magazine_readingWP();

                    preferred_magazine_posted_on();
                    preferred_magazine_posted_by();

                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </div><!-- .entry-header -->

        <div class="entry-content">
            <?php

            if ( is_singular() ) :
                the_content( sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'preferred-magazine' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ) );

            else :
                the_excerpt();
                echo '<a class="read-more" href="'. esc_url( get_the_permalink() ) .'">'. esc_html( 'read more >' ) .'</a>';
            endif;


            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'preferred-magazine' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->
    </div><!-- .blog-content-wrap -->

</article><!-- #post-<?php the_ID(); ?> -->
<div class="clearfix"></div>