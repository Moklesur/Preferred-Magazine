<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package preferred_magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-thumb-items<?php echo ( has_post_thumbnail() ) ? ' mb-30 has-items-thumb' : ''; ?> position-relative">
        <?php preferred_magazine_post_thumbnail(); ?>
        <div class="block-cats">
            <?php preferred_magazine_cat_bg(); ?>
        </div>
    </div>

    <div class="entry-header">
        <?php
        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        if ( 'post' === get_post_type() ) :
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
        the_excerpt();
        echo '<a class="read-more" href="'. esc_url( get_the_permalink() ) .'">'. esc_html( 'read more >' ) .'</a>';

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'preferred-magazine' ),
            'after'  => '</div>',
        ) );
        ?>
	</div><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
