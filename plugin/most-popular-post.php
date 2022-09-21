<?phpnamespace Elementor;if ( ! defined( 'ABSPATH' ) ) {    exit; // Exit if accessed directly.}/** * Blog block * * @since 1.0.0 */class Preferred_Magazine_Most_Popular_Post extends Widget_Base {    /**     * Get widget name.     *     * Retrieve oEmbed widget name.     *     * @since 1.0.0     * @access public     *     * @return string Widget name.     */    public function get_name() {        return 'Most Popular Post';    }    /**     * Get widget title.     *     * Retrieve oEmbed widget title.     *     * @since 1.0.0     * @access public     *     * @return string Widget title.     */    public function get_title() {        return __( 'Most Popular Post', 'preferred-magazine' );    }    /**     * Get widget icon.     *     * Retrieve oEmbed widget icon.     *     * @since 1.0.0     * @access public     *     * @return string Widget icon.     */    public function get_icon() {        return 'fa fa-fire';    }    /**     * Get widget categories.     *     * Retrieve the list of categories the oEmbed widget belongs to.     *     * @since 1.0.0     * @access public     *     * @return array Widget categories.     */    public function get_categories() {        return [ 'preferred_magazine' ];    }    /**     * Register oEmbed widget controls.     *     * Adds different input fields to allow the user to change and customize the widget settings.     *     * @since 1.0.0     * @access protected     */    protected function _register_controls() {        $this->start_controls_section(            'most_popular_section',            [                'label' => __( 'Setting', 'preferred-magazine' ),                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,            ]        );        $this->add_control(            'title',            [                'label' => __( 'Title', 'preferred-magazine' ),                'type' => \Elementor\Controls_Manager::TEXT,                'default' => __( 'Most Popular Post', 'preferred-magazine' ),                'placeholder' => __( 'Title', 'preferred-magazine' ),            ]        );        $this->add_control(            'category_style',            [                'label' => __( 'Select Layout Style', 'preferred-magazine' ),                'type' => \Elementor\Controls_Manager::SELECT,                'options' => [                    '1' => __( 'Layout 1', 'preferred-magazine' ),                    '2' => __( 'Layout 2', 'preferred-magazine' ),                    '3' => __( 'Layout 3 ( slideshow )', 'preferred-magazine' ),                ],                'default' => '1',            ]        );        $this->add_control(            'limit',            [                'label' => __( 'Post Limit', 'preferred-magazine' ),                'type' => \Elementor\Controls_Manager::NUMBER,                'min' => 1,                'max' => 25,                'step' => 1,                'default' => 3,            ]        );        $this->add_control(            'hr',            [                'type' => \Elementor\Controls_Manager::DIVIDER,                'style' => 'thick',            ]        );        $this->add_control(            'hide_meta',            [                'label' => __( 'Hide Meta?', 'preferred-magazine' ),                'type' => \Elementor\Controls_Manager::SWITCHER,                'label_on' => __( 'Show', 'preferred-magazine' ),                'label_off' => __( 'Hide', 'preferred-magazine' ),                'return_value' => 'yes',                'default' => 'yes',            ]        );        $this->add_control(            'hide_category',            [                'label' => __( 'Hide Category?', 'preferred-magazine' ),                'type' => \Elementor\Controls_Manager::SWITCHER,                'label_on' => __( 'Show', 'preferred-magazine' ),                'label_off' => __( 'Hide', 'preferred-magazine' ),                'return_value' => 'yes',                'default' => 'yes',            ]        );        $this->add_control(            'hide_read_time',            [                'label' => __( 'Hide Reading Time?', 'preferred-magazine' ),                'type' => \Elementor\Controls_Manager::SWITCHER,                'label_on' => __( 'Show', 'preferred-magazine' ),                'label_off' => __( 'Hide', 'preferred-magazine' ),                'return_value' => 'yes',                'default' => 'yes',            ]        );        $this->end_controls_section();    }    /**     * Render oEmbed widget output on the frontend.     *     * Written in PHP and used to generate the final HTML.     *     * @since 1.0.0     * @access protected     */    protected function render() {        $settings = $this->get_settings_for_display();        $query = new \WP_Query( array(            'posts_per_page'      => $settings['limit'],            'no_found_rows'       => true,            'post_stairis'         => 'publish',            'orderby' 			  => 'comment_count',            'ignore_sticky_posts' => false,            'date_query' => array(                array(                    'year' => date( 'Y' )                ),            )        ) );        $layout = $settings['category_style'];        ?>        <div class="pm-most-popular-post pm-most-popular-post-<?php echo esc_attr( $layout ); ?>">            <?php if( $settings['title'] != '' ) : ?>                <div class="most-popular-post-title">                    <h2 class="mb-0"><?php echo esc_html( $settings['title'] ); ?></h2>                </div>            <?php endif; ?>            <div class="row">                <?php                if ( $query->have_posts() ) :                    $col = $close_div = $mt = '';                    if( $layout != "2" ){                        $col = '<div class="col-md-4 col-sm-6 col-12 mt-30">';                        $close_div = '</div>';                    }                    while ( $query->have_posts() ) : $query->the_post();                        if( $layout == "2" ) {                            // First Post                            if ( $query->current_post == 0 ) {                                $col = '<div class="col-md-6 col-sm-6 col-12 mt-30">';                                $close_div = '</div>';                            } elseif ( $query->current_post == 1 ) {                                $col = '<div class="col-md-6 col-sm-6 col-12 p-0 pm-most-popular-'.$layout.'">';                                $close_div = '';                                $mt = ' mt-30';                            } else {                                $col = '';                            }                            // Last Post                            if ( ( $query->current_post + 1 ) == ( $query->post_count ) ) {                                $close_div = '</div>';                            }                        }                        echo $col;                        ?>                        <div class="post-item<?php echo $mt; ?>">                            <?php if ( has_post_thumbnail() ) : ?>                                <div class="cat-over-img position-relative mb-30">                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">                                        <?php the_post_thumbnail( 'preferred-magazine-md-thumb' ); ?>                                    </a>                                    <?php                                    if ( 'yes' === $settings['hide_category'] ) {  ?>                                        <div class="block-cats">                                            <?php preferred_magazine_cat_bg(); ?>                                        </div>                                    <?php } ?>                                </div>                            <?php endif; ?>                            <div class="block-contents">                                <?php if ( !has_post_thumbnail() && 'yes' === $settings['hide_category'] ) {  ?>                                    <div class="block-cats">                                        <?php preferred_magazine_cat_bg(); ?>                                    </div>                                <?php }  ?>                                <h2>                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>                                </h2>                                <div class="meta-data mb-10">                                    <?php if ( 'yes' === $settings['hide_read_time'] ) {                                        preferred_magazine_readingWP();                                    }                                    if ( 'yes' === $settings['hide_meta'] ) {                                        ?>                                        <span>                                                <i class="ion-ios-time-outline"></i> <?php echo get_the_date(); ?>                                            </span>                                    <?php } ?>                                </div>                                <?php                                if( $layout != "2" ) { ?>                                    <p class="mb-05"><?php echo esc_html( wp_trim_words( get_the_content(), 15, '...' ) ); ?></p>                                    <a class="read-more" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php esc_html_e( 'read more', 'preferred-magazine' )?></a>                                <?php } else {                                    if ( $query->current_post == 0 ) { ?>                                        <p class="mb-05"><?php echo esc_html( wp_trim_words( get_the_content(), 15, '...' ) ); ?></p>                                        <a class="read-more" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php esc_html_e( 'read more', 'preferred-magazine' )?></a>                                    <?php }                                } ?>                            </div>                        </div>                        <?php                        echo $close_div;                    endwhile;                    wp_reset_postdata();                endif;                ?>            </div>        </div>        <?php    }}Plugin::instance()->widgets_manager->register_widget_type( new Preferred_Magazine_Most_Popular_Post() );