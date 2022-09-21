<?php
/**
 * preferred magazine Theme Customizer
 *
 * @package preferred_magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function preferred_magazine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'preferred_magazine_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'preferred_magazine_customize_partial_blogdescription',
		) );
	}

    // Category Color
    $wp_customize->add_setting('primary_color',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    ## Sections ##
    $wp_customize->add_section(
        'category_color_section',
        array(
            'title'       => __( 'Category BG Color', 'preferred-magazine' ),
            'description' => __( 'Choose BG color for specific category.', 'preferred-magazine' ),
            'priority' => 45
        )
    );
    $args = array(
        'type'                     => 'post',
        'orderby'                  => 'name',
        'hide_empty'               => 0,
        'taxonomy'                 => 'category'
    );
    $category_lists = get_categories( $args );
    foreach( $category_lists as $category ){

        $wp_customize->add_setting( 'category_color_' . $category->term_id,
            array(
                'default'           => '#222627',
                'sanitize_callback' => 'sanitize_hex_color'
            )
        );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'category_color_' . $category->term_id,
            array(
                'label'    => ucwords( esc_html( $category->name ) ),
                'section'  => 'category_color_section',
                'settings' => 'category_color_' . $category->term_id,
            )
        ));
    }
}

add_action( 'customize_register', 'preferred_magazine_customize_register' );

/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
if( class_exists( 'WP_Customize_Section' ) ) :

    class preferred_magazine_Customize_Section_Pro extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'pro-section';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand get-pro-theme" style="display: block !important;">
                <h3 class="accordion-section-title">
                    {{ data.title }}
                    <# if ( data.pro_text && data.pro_url ) { #>
                    <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }
endif;

add_action( 'customize_register', 'preferred_magazine_sections_pro' );
function preferred_magazine_sections_pro( $wp_customize ) {
    // Register custom section types.
    $wp_customize->register_section_type( 'preferred_magazine_Customize_Section_Pro' );

    // Register sections.
    $wp_customize->add_section(
        new preferred_magazine_Customize_Section_Pro(
            $wp_customize,
            'preferred_magazine_get_pro',
            array(
                'title'    => esc_html__( 'Pro Available', 'preferred-magazine' ),
                'priority' => 5,
                'pro_text' => esc_html__( 'Get Pro Theme', 'preferred-magazine' ),
                'pro_url'  => 'https://www.themetim.com/wordpress-themes/preferred-magazine/'
            )
        )
    );
}


/**
 * Early exit if Kirki exists.
 */
$user_id = get_current_user_id();
if ( !get_user_meta( $user_id, 'preferred_magazine_kirki_plugin_dismissed' ) ){
    require get_template_directory() . '/inc/kirki/include-kirki.php';
}
require get_template_directory() . '/inc/kirki/preferred-magazine-kirki.php';

/**
 * Kirki Customizer settings
 */
Preferred_Magazine_Kirki::add_config( 'preferred_magazine', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );
require get_template_directory() . '/inc/kirki/kirki-customizer.php';

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function preferred_magazine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function preferred_magazine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function preferred_magazine_customize_preview_js() {
	wp_enqueue_script( 'preferred-magazine-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'preferred_magazine_customize_preview_js' );
