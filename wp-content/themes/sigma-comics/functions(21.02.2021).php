<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'top'    => __( 'Top Menu', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'footer-copyright' => __( 'Footer Copyright Menu', 'twentynineteen' ),
				
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Blue', 'twentynineteen' ) : null,
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'twentynineteen' ) : null,
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {


	register_sidebar(
		array(
			'name'          => __( 'Header Footer Social Link', 'twentyseventeen' ),
			'id'            => 'header-footer-social-link',
			'description'   => __( 'Add widgets here to appear in your aboutus in footer', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Header English', 'twentyseventeen' ),
			'id'            => 'header-english',
			'description'   => __( 'Add widgets here to appear in your aboutus in footer', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Header Spanish', 'twentyseventeen' ),
			'id'            => 'header-spanish',
			'description'   => __( 'Add widgets here to appear in your aboutus in footer', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer English', 'twentyseventeen' ),
			'id'            => 'footer-english',
			'description'   => __( 'Add widgets here to appear in your aboutus in footer', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Spanish', 'twentyseventeen' ),
			'id'            => 'footer-spanish',
			'description'   => __( 'Add widgets here to appear in your aboutus in footer', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Copyright Text', 'twentyseventeen' ),
			'id'            => 'footer-copyright-text',
			'description'   => __( 'Add widgets here to appear in your aboutus in footer', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Digital Subscription Box', 'twentyseventeen' ),
			'id'            => 'digital-subscription-box',
			'description'   => __( 'DIGITAL DASHBOARD section after login', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Digital Subscription Box Spanish', 'twentyseventeen' ),
			'id'            => 'digital-subscription-box-spanish',
			'description'   => __( 'DIGITAL DASHBOARD section after login', 'twentyseventeen' ),
			'class'         => '',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
	

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );



/** Digital Issue Custom Post Type */

add_action( 'init', 'codex_custom_field_init' );
function codex_custom_field_init(){
	
	$labels = array(
		'name'               => _x( 'Digital Issue', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Digital Issue', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Digital Issue', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Digital Issue', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Digital Issue', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Digital Issue', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Digital Issue', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Digital Issue', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Digital Issue', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Digital Issue', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Digital Issue', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Digital Issue:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Digital Issue found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Digital Issue found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Digital Issue.', 'your-plugin-textdomain' ),
		'taxonomies'         => array('tag','category'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
        'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'digital-issue' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'advanced-custom-fields' )
	);

	register_post_type( 'digital-issue', $args );
}


/** custom field Post Type */

add_action( 'init', 'codex_digital_issue_init' );
function codex_digital_issue_init(){
	
	$labels = array(
		'name'               => _x( 'Custom Field', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Custom Field', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Custom Field', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Custom Field', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Custom Field', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Custom Field', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Custom Field', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Custom Field', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Custom Field', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Custom Field', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Custom Field', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Custom Field:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Custom field found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Custom field found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Custom Field.', 'your-plugin-textdomain' ),
		'taxonomies'         => array('tag','category'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
        'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'custom-field' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'advanced-custom-fields' )
	);

	register_post_type( 'custom-field', $args );
}


/** custom field spanish Post Type */

add_action( 'init', 'codex_custom_field_spanish_init' );
function codex_custom_field_spanish_init(){
	
	$labels = array(
		'name'               => _x( 'Custom Field Spanish', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Custom Field Spanish', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'CF Spanish', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Custom Field Spanish', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Custom Field Spanish', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Custom Field Spanish', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Custom Field Spanish', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Custom Field Spanish', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Custom Field Spanish', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Custom Field Spanish', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Custom Field Spanish', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Custom Field Spanish:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Custom field found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Custom field found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Custom Field Spanish.', 'your-plugin-textdomain' ),
		'taxonomies'         => array('tag','category'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
        'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'custom-field-spanish' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'advanced-custom-fields' )
	);

	register_post_type( 'custom-field-spanish', $args );
}


/** API & Links Post Type */

add_action( 'init', 'codex_api_links_init' );
function codex_api_links_init(){
	
	$labels = array(
		'name'               => _x( 'Menu & links', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Menu & links', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Menu & links', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Menu & links', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Menu & links', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Menu & links', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Menu & links', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Menu & links', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Menu & links', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Menu & links', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Menu & links', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Menu & links:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Menu & links found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Menu & links found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Menu & links.', 'your-plugin-textdomain' ),
		'taxonomies'         => array('tag','category'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
        'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'menu-links' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'advanced-custom-fields' )
	);

	register_post_type( 'menu-links', $args );
}


/** News Custom Post Type */

/*add_action( 'init', 'codex_news_init' );
function codex_news_init(){
	

	$labels = array(
		'name'               => _x( 'News', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'News', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'News', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'News', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New News', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New News', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit News', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View News', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All News', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search News', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent News:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No News found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No News found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'News.', 'your-plugin-textdomain' ),
		'taxonomies'         => array('tag','category'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
        'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'news' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'advanced-custom-fields' )
	);

	register_post_type( 'news', $args );
}*/

/**
 * Add application widget to the dashboard.
 */
function addApplicationWidget() {
    wp_add_dashboard_widget(
                 'submitted_applications',         
                 'Digital Members',        
                 'showApplicants' 
        );  
}
add_action( 'wp_dashboard_setup', 'addApplicationWidget' );

function showApplicants() {
    global $wpdb;

    $appTable = "users";
    $query = $wpdb->prepare("SELECT * FROM $appTable");
    $applications = $wpdb->get_results($query);

    foreach ( $applications as $application ) {
        echo $application->email . "<br/>";
    }
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '20181214', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '20181231', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Common theme functions.
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
