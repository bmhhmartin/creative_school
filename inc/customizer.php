<?php
/**
 * VW One Page Theme Customizer
 *
 * @package VW One Page
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_one_page_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_one_page_custom_controls' );

function vw_one_page_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_one_page_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-one-page' ),
	    'description' => __( 'Description of what this panel does.', 'vw-one-page' ),
	) );

	$wp_customize->add_section( 'vw_one_page_left_right', array(
    	'title'      => __( 'General Settings', 'vw-one-page' ),
		'priority'   => 30,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting('vw_one_page_width_option',array(
        'default' => __('Full Width','vw-one-page'),
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-one-page'),
        'description' => __('Here you can change the width layout of Website.','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Full Width' => get_template_directory_uri().'/images/full-width.png',
            'Wide Width' => get_template_directory_uri().'/images/wide-width.png',
            'Boxed' => get_template_directory_uri().'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_one_page_theme_options',array(
        'default' => __('Right Sidebar','vw-one-page'),
        'sanitize_callback' => 'vw_one_page_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_one_page_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-one-page'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
            'One Column' => __('One Column','vw-one-page'),
            'Three Columns' => __('Three Columns','vw-one-page'),
            'Four Columns' => __('Four Columns','vw-one-page'),
            'Grid Layout' => __('Grid Layout','vw-one-page')
        ),
	));

	$wp_customize->add_setting('vw_one_page_page_layout',array(
        'default' => __('One Column','vw-one-page'),
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-one-page'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
            'One Column' => __('One Column','vw-one-page')
        ),
	) );

	//Topbar
	$wp_customize->add_section( 'vw_one_page_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-one-page' ),
		'priority'   => 30,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting('vw_one_page_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_phone_number',array(
		'label'	=> __('Add Phone Number','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_email_address',array(
		'label'	=> __('Add Email Address','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_timing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_timing',array(
		'label'	=> __('Add Timming','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_search_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_search_hide_show',array(
		'label' => esc_html__( 'Show / Hide Search','vw-one-page' ),
		'section' => 'vw_one_page_topbar'
    )));
    
	//Slider
	$wp_customize->add_section( 'vw_one_page_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-one-page' ),
		'priority'   => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting( 'vw_one_page_slider_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_slider_hide_show', array(
		'label' => esc_html__( 'Show / Hide Slider','vw-one-page' ),
		'section' => 'vw_one_page_slidersettings'
	)));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_one_page_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_one_page_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_one_page_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-one-page' ),
			'description' => __('Slider image size (1500 x 590)','vw-one-page'),
			'section'  => 'vw_one_page_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//content layout
	$wp_customize->add_setting('vw_one_page_slider_content_option',array(
        'default' => __('Right','vw-one-page'),
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-one-page'),
        'section' => 'vw_one_page_slidersettings',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/slider-content1.png',
            'Center' => get_template_directory_uri().'/images/slider-content2.png',
            'Right' => get_template_directory_uri().'/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_one_page_slider_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_one_page_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_one_page_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('vw_one_page_slider_opacity_color',array(
		'default'              => 0.5,
		'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_one_page_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','vw-one-page' ),
		'section'     => 'vw_one_page_slidersettings',
		'type'        => 'select',
		'settings'    => 'vw_one_page_slider_opacity_color',
		'choices' => array(
			'0' =>  esc_attr('0','vw-one-page'),
			'0.1' =>  esc_attr('0.1','vw-one-page'),
			'0.2' =>  esc_attr('0.2','vw-one-page'),
			'0.3' =>  esc_attr('0.3','vw-one-page'),
			'0.4' =>  esc_attr('0.4','vw-one-page'),
			'0.5' =>  esc_attr('0.5','vw-one-page'),
			'0.6' =>  esc_attr('0.6','vw-one-page'),
			'0.7' =>  esc_attr('0.7','vw-one-page'),
			'0.8' =>  esc_attr('0.8','vw-one-page'),
			'0.9' =>  esc_attr('0.9','vw-one-page')
	),
	));

	//Services
	$wp_customize->add_section( 'vw_one_page_service_section' , array(
    	'title'      => __( 'Services', 'vw-one-page' ),
		'priority'   => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_one_page_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_one_page_sanitize_choices',
	));
	$wp_customize->add_control('vw_one_page_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display services','vw-one-page'),
		'section' => 'vw_one_page_service_section',
	));	

	//About us
	$wp_customize->add_section( 'vw_one_page_about_section' , array(
    	'title'      => __( 'About us', 'vw-one-page' ),
		'priority'   => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting( 'vw_one_page_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'vw_one_page_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'vw_one_page_about_page', array(
		'label'    => __( 'Select About Page', 'vw-one-page' ),
		'section'  => 'vw_one_page_about_section',
		'type'     => 'dropdown-pages'
	) );

	//About excerpt
	$wp_customize->add_setting( 'vw_one_page_about_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_one_page_about_excerpt_number', array(
		'label'       => esc_html__( 'About Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_about_section',
		'type'        => 'range',
		'settings'    => 'vw_one_page_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog Post
	$wp_customize->add_section('vw_one_page_blog_post',array(
		'title'	=> __('Blog Post Settings','vw-one-page'),
		'panel' => 'vw_one_page_panel_id',
	));	

	$wp_customize->add_setting( 'vw_one_page_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-one-page' ),
        'section' => 'vw_one_page_blog_post'
    )));

    $wp_customize->add_setting( 'vw_one_page_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_author',array(
		'label' => esc_html__( 'Author','vw-one-page' ),
		'section' => 'vw_one_page_blog_post'
    )));

    $wp_customize->add_setting( 'vw_one_page_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-one-page' ),
		'section' => 'vw_one_page_blog_post'
    )));

    $wp_customize->add_setting( 'vw_one_page_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_one_page_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_blog_post',
		'type'        => 'range',
		'settings'    => 'vw_one_page_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Content Creation
	$wp_customize->add_section( 'vw_one_page_content_section' , array(
    	'title' => __( 'Customize Home Page Settings', 'vw-one-page' ),
		'priority' => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting('vw_one_page_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new vw_one_page_Content_Creation( $wp_customize, 'vw_one_page_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-one-page' ),
		),
		'section' => 'vw_one_page_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-one-page' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_one_page_footer',array(
		'title'	=> __('Footer','vw-one-page'),
		'description'=> __('This section will appear in the footer','vw-one-page'),
		'panel' => 'vw_one_page_panel_id',
	));	
	
	$wp_customize->add_setting('vw_one_page_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_footer_text',array(
		'label'	=> __('Copyright Text','vw-one-page'),
		'section'=> 'vw_one_page_footer',
		'setting'=> 'vw_one_page_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting( 'vw_one_page_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-one-page' ),
      	'section' => 'vw_one_page_footer'
    )));

	$wp_customize->add_setting('vw_one_page_scroll_top_alignment',array(
        'default' => __('Right','vw-one-page'),
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'settings' => 'vw_one_page_scroll_top_alignment',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/layout1.png',
            'Center' => get_template_directory_uri().'/images/layout2.png',
            'Right' => get_template_directory_uri().'/images/layout3.png'
    ))));
}

add_action( 'customize_register', 'vw_one_page_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_One_Page_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_One_Page_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_One_Page_Customize_Section_Pro($manager,'example_1',array(
			'priority'   => 1,
			'title'    => esc_html__( 'One Page Pro', 'vw-one-page' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-one-page' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/one-page-wordpress-theme/'),
		)));

		$manager->add_section(new VW_One_Page_Customize_Section_Pro($manager,'example_2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-one-page' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-one-page' ),
			'pro_url'  => admin_url('themes.php?page=vw_one_page_guide'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-one-page-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-one-page-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_One_Page_Customize::get_instance();