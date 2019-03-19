<?php
/**
 * Entitledarts functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Entitledarts
 * @since Entitledarts 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Entitledarts 1.0
 */
define( 'entitledarts_THEME_VERSION', '1.0' );
define( 'entitledarts_DEMO_MODE', false );
define( 'entitledarts_MIN_CSS_JS', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'entitledarts_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Entitledarts 1.0
 */
function entitledarts_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on entitledarts, use a find and replace
	 * to change 'entitledarts' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'compre', get_template_directory() . '/languages' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Main Menu', 'entitledarts' ),
		'topmenu'  => esc_html__( 'Top Menu', 'entitledarts' ),
		// 'my-account'  => esc_html__( 'My Account Menu', 'entitledarts' )
	) );

	/*
	 * Theme Option
	 */

	// Add our CSS Styling
	add_action( 'admin_menu', 'admin_enqueue_scripts' );
	function admin_enqueue_scripts() {
	    wp_enqueue_style( 'theme-options', get_template_directory_uri() . '/themeoption/css/theme-options.css' );
	    wp_enqueue_script( 'theme-options', get_template_directory_uri() . '/themeoption/js/theme-options.js' );   
	}

	function cptui_register_my_cpts_gallery() {

	 /**
	  * Post Type: Gallery.
	  */

	 $labels = array(
	  "name" => __( "Gallery", "entitledarts" ),
	  "singular_name" => __( "Gallery", "entitledarts" ),
	 );

	 $args = array(
	  "label" => __( "Gallery", "entitledarts" ),
	  "labels" => $labels,
	  "description" => "",
	  "public" => true,
	  "publicly_queryable" => true,
	  "show_ui" => true,
	  "show_in_rest" => false,
	  "rest_base" => "",
	  "has_archive" => false,
	  "show_in_menu" => true,
	  "exclude_from_search" => false,
	  "capability_type" => "post",
	  "map_meta_cap" => true,
	  "hierarchical" => false,
	  "rewrite" => array( "slug" => "gallery", "with_front" => true ),
	  "query_var" => true,
	  "supports" => array( "title", "editor", "thumbnail", "custom-fields" ),
	  "taxonomies" => array( "category" ),
	 );

	 register_post_type( "gallery", $args );
	}

	add_action( 'init', 'cptui_register_my_cpts_gallery' );

	function add_theme_menu_item()
		{
			add_menu_page("Theme Option", "Theme Option", "manage_options", "theme-option", "theme_settings_page", null, 99);
		}
	add_action("admin_menu", "add_theme_menu_item");

	function theme_settings_page() {
	?>
	    <!-- Create a header in the default WordPress 'wrap' container -->
	    <div class="wrap theme-option">
	        <h2>Theme Options</h2>
	        <?php settings_errors(); ?>



	        <div class="theme-container">
				<form method="post" action="options.php">
					<!-- Header Block -->
					<div class="theme-header">
						<?php $theme = wp_get_theme( ); ?>
						<h2><?php echo $theme->name; ?><span> <?php echo $theme->version; ?> </span></h2>
						<div class="clear"></div>
					</div>

					<!-- Intro Text -->
					<div class="theme-sidebar">
					    <ul class="theme-group-menu">
							<li class="theme-group-tab-link-li">
								<a href="javascript:void(0)" id="0_section_group" class="theme-group-tab-link-a">
									<span class="group_title">General</span>
								</a>
							</li>
							<li class="theme-group-tab-link-li">
								<a href="javascript:void(0)" id="1_section_group" class="theme-group-tab-link-a">
									<span class="group_title">Footer</span>
								</a>
							</li>
							<li class="theme-group-tab-link-li">
								<a href="javascript:void(0)" id="2_section_group" class="theme-group-tab-link-a">
									<span class="group_title">Social</span>
								</a>
							</li>
							<li class="theme-group-tab-link-li">
								<a href="javascript:void(0)" id="3_section_group" class="theme-group-tab-link-a">
									<span class="group_title">Custom CSS/JS</span>
								</a>
							</li>
					    </ul>
					</div>

					<div class="theme-main">
						<div class="theme-sticky">
	    					<div class="info_bar">
	        					<div class="theme-action_bar">
	        						<?php submit_button(); ?>
	        					</div>
	        					<div class="clear"></div>
	    					</div>
						</div>

						<div id="0_section_group" class="theme-group-tab visible">
							<?php
								settings_fields( 'section' );
				            	do_settings_sections( 'general' );
				            ?>
						</div>
						<div id="1_section_group" class="theme-group-tab">
							<?php
								settings_fields( 'section' );
				            	do_settings_sections( 'footer' );
				            ?>
						</div>
						<div id="2_section_group" class="theme-group-tab">
							<?php
								settings_fields( 'section' );
				            	do_settings_sections( 'social' );
				            ?>
						</div>
						<div id="3_section_group" class="theme-group-tab">
							<?php
								settings_fields( 'section' );
				            	do_settings_sections( 'custom' );
				            ?>
						</div>

						<div class="theme-sticky">
	    					<div class="info_bar">
	        					<div class="theme-action_bar">
	        						<?php submit_button(); ?>
	        					</div>
	        					<div class="clear"></div>
	    					</div>
						</div>
					</div>
				</form>
         	</div>
	    </div><!-- /.wrap -->
	<?php
	}

add_action( 'admin_footer', 'media_selector_print_scripts' );
function media_selector_print_scripts() {
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					$( '.image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script><?php
}

	function display_main_logo_element()
	{
		?>
		<?php
			if ( isset( $_POST['submit'] ) && isset( $_POST['image_attachment_id'] ) ) :
					update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
				endif;
				wp_enqueue_media();
		?>
			<div class='image-preview-wrapper'>
				<img class='image-preview' id="main_logo" src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100'>
			</div>
			<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
			<input id="remove_image_button" type="button" class="button" value="<?php _e( 'Remove' ); ?>" />
			<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
			<p><?php echo "Upload a .png or .gif image that will be your logo." ?><p>
		<?php
	}

	function display_sidemenu_logo_element()
	{
		?>
		<?php
			if ( isset( $_POST['submit'] ) && isset( $_POST['image_attachment_id'] ) ) :
					update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
				endif;
				wp_enqueue_media();
		?>
			<div class='image-preview-wrapper'>
				<img class='image-preview' id="sidemenu_logo" src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100'>
			</div>
			<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
			<input id="remove_image_button" type="button" class="button" value="<?php _e( 'Remove' ); ?>" />
			<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
			<p><?php echo "Upload a .png or .gif image that will be your logo." ?><p>
		<?php
	}

	function display_preload_element()
	{
		?>
			<div class="switch">
			    <input type="checkbox" name="preload_website" class="switch-checkbox" id="preload_website" value="1" <?php checked(1, get_option('preload_website'), true); ?> />
			    <label class="switch-label" for="preload_website">
			        <span class="switch-inner"></span>
			        <span class="switch-switch"></span>
			    </label>
			</div>
		<?php
	}

	function display_scrolltotop_element()
	{
		?>
			<div class="switch">
			    <input type="checkbox" name="scrolltotop" class="switch-checkbox" id="scrolltotop" value="1" <?php checked(1, get_option('scrolltotop'), true); ?> />
			    <label class="switch-label" for="scrolltotop">
			        <span class="switch-inner"></span>
			        <span class="switch-switch"></span>
			    </label>
			</div>
		<?php
	}

	function display_multiparalax_element()
	{
		?>
			<div class="switch">
			    <input type="checkbox" name="multiparalax" class="switch-checkbox" id="multiparalax" value="1" <?php checked(1, get_option('multiparalax'), true); ?> />
			    <label class="switch-label" for="multiparalax">
			        <span class="switch-inner"></span>
			        <span class="switch-switch"></span>
			    </label>
			</div>
		<?php
	}


	function display_sidemenu_copyright_element()
	{
		?>
    		<textarea name="sidemenu_copyright_text" id="sidemenu_copyright_text" class="large-text" rows="6" /><?php echo get_option('sidemenu_copyright_text'); ?></textarea>
	    <?php
	} 

	function display_footer_copyright_element()
	{
		?>
    		<textarea name="footer_copyright_text" id="footer_copyright_text" rows="6" class="large-text"/><?php echo get_option('footer_copyright_text'); ?></textarea>
	    <?php
	}

	function display_footersocial_element()
	{
		?>

			<div class="switch">
			    <input type="checkbox" name="footersocial" class="switch-checkbox" id="footersocial" value="1" <?php checked(1, get_option('footersocial'), true); ?> />
			    <label class="switch-label" for="footersocial">
			        <span class="switch-inner"></span>
			        <span class="switch-switch"></span>
			    </label>
			</div>
		<?php
	}

	function display_twitter_element()
	{
		?>
	    	<input type="text" name="twitter_url" id="twitter_url" class="regular-text" value="<?php echo get_option('twitter_url'); ?>" />
	    <?php
	}

	function display_facebook_element()
	{
		?>
	    	<input type="text" name="facebook_url" id="facebook_url" class="regular-text" value="<?php echo get_option('facebook_url'); ?>" />
	    <?php
	}

	function display_youtube_element()
	{
		?>
	    	<input type="text" name="youtube_url" id="youtube_url" class="regular-text" value="<?php echo get_option('youtube_url'); ?>" />
	    <?php
	}

	function display_linkedin_element()
	{
		?>
	    	<input type="text" name="linkedin_url" id="linkedin_url" class="regular-text" value="<?php echo get_option('linkedin_url'); ?>" />
	    <?php
	}

	function display_googleplus_element()
	{
		?>
	    	<input type="text" name="googleplus_url" id="googleplus_url" class="regular-text" value="<?php echo get_option('googleplus_url'); ?>" />
	    <?php
	}

	function display_custom_css_element()
	{
		?>
    		<textarea name="custom_css" id="custom_css" class="large-text" rows="15" /><?php echo get_option('custom_css'); ?></textarea>
	    <?php
	} 

	function display_custom_js_element()
	{
		?>
    		<textarea name="custom_js" id="custom_js" rows="15" class="large-text"/><?php echo get_option('custom_js'); ?></textarea>
	    <?php
	}

	function display_theme_panel_fields()
	{
		// General Tab Content
	    add_settings_section("section", "General Settings", null, "general");

	    add_settings_field("main_logo", "Main Logo", "display_main_logo_element", "general", "section");
	    add_settings_field("sidemenu_logo", "Sidemenu Logo", "display_sidemenu_logo_element", "general", "section");
	    add_settings_field("preload_website", "Preload website", "display_preload_element", "general", "section");
	    add_settings_field("scrolltotop", "Scroll to top button", "display_scrolltotop_element", "general", "section");
	    add_settings_field("multiparalax", "Multi Paralax Efect", "display_multiparalax_element", "general", "section");

	    register_setting("section", "main_logo");
	    register_setting("section", "sidemenu_logo");
	    register_setting("section", "preload_website");
	    register_setting("section", "scrolltotop");
	    register_setting("section", "multiparalax");

	    // Footer Tab Content
		add_settings_section("section", "Footer Settings", null, "footer");

		add_settings_field("sidemenu_copyright_text", "Side menu copyright", "display_sidemenu_copyright_element", "footer", "section");
		add_settings_field("footer_copyright_text", "Footer Copyright", "display_footer_copyright_element", "footer", "section");
		add_settings_field("footersocial", "Toggle social links in footer", "display_footersocial_element", "footer", "section");

		register_setting("section", "sidemenu_copyright_text");
		register_setting("section", "footer_copyright_text");
	    register_setting("section", "footersocial");

	    // Social Icon Tab Content
		add_settings_section("section", "Social Settings", null, "social");
		
		add_settings_field("twitter_url", "Twitter Url", "display_twitter_element", "social", "section");
	    add_settings_field("facebook_url", "Facebook Url", "display_facebook_element", "social", "section");
	    add_settings_field("youtube_url", "Youtube Url", "display_youtube_element", "social", "section");
	    add_settings_field("linkedin_url", "LinkedIn Url", "display_linkedin_element", "social", "section");
	    add_settings_field("googleplus_url", "Google Plus Url", "display_googleplus_element", "social", "section");

	    register_setting("section", "twitter_url");
	    register_setting("section", "facebook_url");
	    register_setting("section", "youtube_url");
	    register_setting("section", "linkedin_url");
	    register_setting("section", "googleplus_url");

	    // Custom CSS/JS Tab Content
		add_settings_section("section", "Custom CSS/JS", null, "custom");

		add_settings_field("custom_css", "Custom CSS", "display_custom_css_element", "custom", "section");
		add_settings_field("custom_js", "Custom JS", "display_custom_js_element", "custom", "section");

		register_setting("section", "custom_css");
		register_setting("section", "custom_js");
	}

	add_action("admin_init", "display_theme_panel_fields");

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = entitledarts_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'entitledarts_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	entitledarts_get_load_plugins();
}
endif; // entitledarts_setup
add_action( 'after_setup_theme', 'entitledarts_setup' );


/**
 * Display descriptions in main navigation.
 *
 * @since entitledarts 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function entitledarts_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'entitledarts_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since entitledarts 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function entitledarts_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'entitledarts_search_form_modify' );

/**
 * Function for remove srcset (WP4.4)
 *
 */
function entitledarts_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'entitledarts_disable_srcset' );

/**
 * Function get opt_name
 *
 */
function entitledarts_get_opt_name() {
	return 'entitledarts_theme_options';
}
add_filter( 'apus_themer_get_opt_name', 'entitledarts_get_opt_name' );

function entitledarts_register_demo_mode() {
	if ( defined('entitledarts_DEMO_MODE') && entitledarts_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_themer_register_demo_mode', 'entitledarts_register_demo_mode' );

function entitledarts_get_demo_preset() {
	$preset = '';
    if ( defined('entitledarts_DEMO_MODE') && entitledarts_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_themer_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_themer_preset_default' );
        }
    }
    return $preset;
}

function entitledarts_get_config($name, $default = '') {
	global $entitledarts_options;
    if ( isset($entitledarts_options[$name]) ) {
        return $entitledarts_options[$name];
    }
    return $default;
}

function entitledarts_get_global_config($name, $default = '') {
	$options = get_option( 'entitledarts_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function entitledarts_get_image_lazy_loading() {
	return entitledarts_get_config('image_lazy_loading');
}

add_filter( 'apus_themer_get_image_lazy_loading', 'entitledarts_get_image_lazy_loading');

function entitledarts_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'entitledarts' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'entitledarts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'entitledarts' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'entitledarts' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'entitledarts' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'entitledarts' ),
		'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'entitledarts' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'entitledarts' ),
		'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'entitledarts' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'entitledarts' ),
		'before_widget' => '<aside id="%1$s" class="widget sidebar-v2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

}
add_action( 'widgets_init', 'entitledarts_register_sidebar' );

/*
 * Init widgets
 */
function entitledarts_widgets_init($widgets) {
	$widgets = array_merge($widgets, array( 'woo-price-filter', 'woo-product-sorting', 'vertical_menu' ));
	return $widgets;
}
add_filter( 'apus_themer_register_widgets', 'entitledarts_widgets_init' );

function entitledarts_get_load_plugins() {
	// framework
	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Themer For Themes', 'entitledarts' ),
        'slug'                     => 'apus-themer',
        'required'                 => true,
        'source'				   => esc_url( 'http://apusthemes.com/themeplugins/apus-themer.zip' )
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__('King Composer - Page Builder', 'entitledarts'),
	    'slug'                     => 'kingcomposer',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'entitledarts' ),
        'slug'                     => 'revslider',
        'required'                 => true,
        'source'				   => esc_url( 'http://apusthemes.com/themeplugins/revslider.zip' )
	));

	// for other plugins
	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'entitledarts' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));
	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_THEMER_theme_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/theme-framework/theme-config.php';
	define( 'entitledarts_theme_THEMER_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	require get_template_directory() . '/inc/vendors/cmb2/product.php';
	define( 'entitledarts_CMB2_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/woo-custom.php';
	define( 'entitledarts_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/kingcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/kingcomposer/maps.php';
	define( 'entitledarts_KINGCOMPOSER_ACTIVED', true );
}
if( in_array( 'apus-themer/apus-themer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/widgets/popup_newsletter.php';
}
function woocommerce_button_proceed_to_checkout() {
       $checkout_url = WC()->cart->get_checkout_url();
       ?>
       <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Finalizar Compra', 'woocommerce' ); ?></a>
       <?php
     }
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';

