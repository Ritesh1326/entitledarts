<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('entitledarts_Redux_Framework_Config')) {

    class entitledarts_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $ReduxFramework;

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            add_action('init', array($this, 'initSettings'), 10);
        }

        public function initSettings()
        {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {
            global $wp_registered_sidebars;
            $sidebars = array();

            if ( !empty($wp_registered_sidebars) ) {
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                }
            }
            $columns = array( '1' => esc_html__('1 Column', 'entitledarts'),
                '2' => esc_html__('2 Columns', 'entitledarts'),
                '3' => esc_html__('3 Columns', 'entitledarts'),
                '4' => esc_html__('4 Columns', 'entitledarts'),
                '5' => esc_html__('5 Columns', 'entitledarts'),
                '6' => esc_html__('6 Columns', 'entitledarts')
            );
            
            $general_fields = array();
            if ( !function_exists( 'wp_site_icon' ) ) {
                $general_fields[] = array(
                    'id' => 'media-favicon',
                    'type' => 'media',
                    'title' => esc_html__('Favicon Upload', 'entitledarts'),
                    'desc' => esc_html__('', 'entitledarts'),
                    'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'entitledarts'),
                );
            }
            $general_fields[] = array(
                'id' => 'preload',
                'type' => 'switch',
                'title' => esc_html__('Preload Website', 'entitledarts'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'image_lazy_loading',
                'type' => 'switch',
                'title' => esc_html__('Image Lazy Loading', 'entitledarts'),
                'default' => true,
            );
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General', 'entitledarts'),
                'fields' => $general_fields
            );
            // Header
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Header', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Upload', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'entitledarts'),
                    ),
                    array(
                        'id' => 'media-mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Mobile Logo Upload', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'entitledarts'),
                    ),
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Header Layout Type', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a header for your website.', 'entitledarts'),
                        'options' => entitledarts_get_header_layouts()
                    ),
                    array(
                        'id' => 'keep_header',
                        'type' => 'switch',
                        'title' => esc_html__('Keep Header When Scroll Mouse', 'entitledarts'),
                        'default' => false
                    ),
                    array(
                        'id' => 'show_top_info',
                        'type' => 'switch',
                        'title' => esc_html__('Show Top Information', 'entitledarts'),
                        'default' => false
                    ),
                    array(
                        'id' => 'top_info_text',
                        'type' => 'editor',
                        'title' => esc_html__('Top Information Text', 'entitledarts'),
                        'required' => array('show_top_info', '=', true)
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Search Form', 'entitledarts'),
                'fields' => array(
                    array(
                        'id'=>'show_searchform',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Form', 'entitledarts'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'entitledarts'),
                        'off' => esc_html__('No', 'entitledarts'),
                    ),
                    array(
                        'id'=>'search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Content Type', 'entitledarts'),
                        'required' => array('show_searchform','equals',true),
                        'options' => array('all' => esc_html__('All', 'entitledarts'), 'post' => esc_html__('Post', 'entitledarts'), 'product' => esc_html__('Product', 'entitledarts')),
                        'default' => 'all'
                    ),
                    array(
                        'id'=>'search_category',
                        'type' => 'switch',
                        'title' => esc_html__('Show Categories', 'entitledarts'),
                        'required' => array('search_type', 'equals', array('post', 'product')),
                        'default' => false,
                        'on' => esc_html__('Yes', 'entitledarts'),
                        'off' => esc_html__('No', 'entitledarts'),
                    ),
                    array(
                        'id' => 'autocomplete_search',
                        'type' => 'switch',
                        'title' => esc_html__('Autocomplete search?', 'entitledarts'),
                        'required' => array('show_searchform','equals',true),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Image', 'entitledarts'),
                        'required' => array('autocomplete_search', '=', '1'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_price',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Price', 'entitledarts'),
                        'required' => array(array('autocomplete_search', '=', '1'), array('search_type', '=', 'product')),
                        'default' => 1
                    ),
                )
            );
            // Footer
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Footer', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Footer Layout Type', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a footer for your website.', 'entitledarts'),
                        'options' => entitledarts_get_footer_layouts()
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'entitledarts'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'entitledarts'),
                        'default' => true,
                    ),
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Blog', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'entitledarts'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'entitledarts').'</em>',
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'entitledarts'),
                    ),
                )
            );
            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'entitledarts'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'entitledarts'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'entitledarts'),
                                'alt' => esc_html__('Main Only', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left - Main Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Main - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'entitledarts'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entitledarts'),
                        'options' => $sidebars
                        
                    ),
                    array(
                        'id' => 'blog_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'entitledarts'),
                        'options' => array(
                            'grid' => esc_html__('Grid Layout', 'entitledarts'),
                            'mansory' => esc_html__('Mansory Layout', 'entitledarts'),
                            'list' => esc_html__('List Layout', 'entitledarts'),
                            'chess' => esc_html__('Chess Layout', 'entitledarts'),
                            'timeline' => esc_html__('Timeline Layout', 'entitledarts'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Blog Columns', 'entitledarts'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'blog_item_style',
                        'type' => 'select',
                        'title' => esc_html__('Blog Item Style', 'entitledarts'),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'entitledarts'),
                            'list' => esc_html__('List', 'entitledarts')
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_item_thumbsize',
                        'type' => 'text',
                        'title' => esc_html__('Thumbnail Size', 'entitledarts'),
                        'desc' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme.', 'entitledarts'),
                    ),

                )
            );
            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'entitledarts'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'entitledarts'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'entitledarts'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'entitledarts'),
                                'alt' => esc_html__('Main Only', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left - Main Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Main - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'entitledarts'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Left Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Right Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Releated Posts', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'text',
                        'title' => esc_html__('Number of related posts to show', 'entitledarts'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Blogs Columns', 'entitledarts'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 4
                    ),

                )
            );
            // Woocommerce
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('Woocommerce', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'show_product_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'entitledarts'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'entitledarts').'</em>',
                        'id' => 'woo_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'woo_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'entitledarts'),
                    )
                )
            );
            // Archive settings
            $custom_menus = array();
            if ( is_admin() ) {
                $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
                if ( is_array( $menus ) && ! empty( $menus ) ) {
                    foreach ( $menus as $single_menu ) {
                        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
                            $custom_menus[ $single_menu->slug ] = $single_menu->name;
                        }
                    }
                }
            }
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Shop Archives', 'entitledarts'),
                'fields' => array(
                    array (
                        'id' => 'products_heading_general',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3> '.esc_html__('General Setting', 'entitledarts').'</h3>',
                    ),
                    array(
                        'id' => 'product_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'entitledarts'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_archive_show_categories',
                        'type' => 'switch',
                        'title' => esc_html__('Show Top Categories', 'entitledarts'),
                        'default' => true
                    ),
                    array(
                        'id' => 'product_archive_categories',
                        'type' => 'select',
                        'title' => esc_html__('Choose a categories menu', 'entitledarts'),
                        'options' => $custom_menus,
                        'required' => array('product_archive_show_categories', 'equals', true)
                    ),
                    array(
                        'id' => 'product_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a default layout archive product.', 'entitledarts'),
                        'options' => array('grid' => esc_html__('Grid', 'entitledarts'), 'list' => esc_html__('List', 'entitledarts')),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'number_products_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'entitledarts'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Columns', 'entitledarts'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'show_swap_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Second Image (Hover)', 'entitledarts'),
                        'default' => 1
                    ),
                    array (
                        'id' => 'products_heading_sidebar',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3> '.esc_html__('Sidebar Setting', 'entitledarts').'</h3>',
                    ),
                    array(
                        'id' => 'product_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'entitledarts'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'entitledarts'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'entitledarts'),
                                'alt' => esc_html__('Main Content', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'entitledarts'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    
                )
            );
            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Shop Single Product', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'product_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'entitledarts'),
                        'default' => false
                    ),
                    array(
                        'id' => 'show_product_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array (
                        'id' => 'product_heading_sidebar',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3> '.esc_html__('Sidebar Setting', 'entitledarts').'</h3>',
                    ),
                    array(
                        'id' => 'product_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'entitledarts'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'entitledarts'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'entitledarts'),
                                'alt' => esc_html__('Main Only', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left - Main Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Main - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'entitledarts'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'entitledarts'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'entitledarts'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entitledarts'),
                        'options' => $sidebars
                    ),
                    array (
                        'id' => 'product_heading_tab',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3> '.esc_html__('Tabs Setting', 'entitledarts').'</h3>',
                    ),
                    array(
                        'id' => 'show_product_accessories_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Accessories Tab', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'product_accessories_tab_icon',
                        'type' => 'media',
                        'title' => esc_html__('Accessories Tab Icon', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_accessories_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'product_accessories_tab_icon_hover',
                        'type' => 'media',
                        'title' => esc_html__('Accessories Tab Icon (Hover)', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_accessories_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'show_product_description_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Description Tab', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'product_description_tab_icon',
                        'type' => 'media',
                        'title' => esc_html__('Description Tab Icon', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_description_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'product_description_tab_icon_hover',
                        'type' => 'media',
                        'title' => esc_html__('Description Tab Icon (Hover)', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_description_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'show_product_specification_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Specification Tab', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'product_specification_tab_icon',
                        'type' => 'media',
                        'title' => esc_html__('Specification Tab Icon', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_specification_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'product_specification_tab_icon_hover',
                        'type' => 'media',
                        'title' => esc_html__('Specification Tab Icon (Hover)', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_specification_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'show_product_review_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Review Tab', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'product_review_tab_icon',
                        'type' => 'media',
                        'title' => esc_html__('Review Tab Icon', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_review_tab', 'equals', true)
                    ),
                    array(
                        'id' => 'product_review_tab_icon_hover',
                        'type' => 'media',
                        'title' => esc_html__('Review Tab Icon (Hover)', 'entitledarts'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your icon.', 'entitledarts'),
                        'required' => array('show_product_review_tab', 'equals', true)
                    ),
                    array (
                        'id' => 'product_heading_releated',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3> '.esc_html__('Releated Setting', 'entitledarts').'</h3>',
                    ),
                    array(
                        'id' => 'show_product_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products Releated', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_product_releated',
                        'title' => esc_html__('Number of related/upsells products to show', 'entitledarts'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider',
                        'required' => array('show_product_releated', 'equals', true)
                    ),
                    array(
                        'id' => 'releated_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Products Columns', 'entitledarts'),
                        'options' => $columns,
                        'default' => 4,
                        'required' => array('show_product_releated', 'equals', true)
                    ),
                    array (
                        'id' => 'product_heading_upsells',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3> '.esc_html__('Upsells Setting', 'entitledarts').'</h3>',
                    ),
                    array(
                        'id' => 'show_product_upsells',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products upsells', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_product_upsells',
                        'title' => esc_html__('Number of upsells products to show', 'entitledarts'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider',
                        'required' => array('show_product_upsells', 'equals', true)
                    ),
                    array(
                        'id' => 'upsells_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Upsells Products Columns', 'entitledarts'),
                        'options' => $columns,
                        'default' => 4,
                        'required' => array('show_product_upsells', 'equals', true)
                    ),

                )
            );
            //Style
            $this->sections[] = array(
                'icon' => 'el el-icon-css',
                'title' => esc_html__('Style', 'entitledarts'),
                'fields' => array(
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Content', 'entitledarts').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('Main Theme Color', 'entitledarts'),
                        'subtitle' => esc_html__('The main color of the site.', 'entitledarts'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'id' => 'site_background',
                        'type' => 'background',
                        'title' => esc_html__('Site Background', 'entitledarts'),
                        'output' => 'body'
                    ),
                    array (
                        'id' => 'container_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Container Background Color', 'entitledarts'),
                        'output' => array(
                            'background-color' =>'.wrapper-container, .apus-mfp-zoom-in .mfp-inline-holder .mfp-content, .dropdown-menu'
                        )
                    ),
                    array (
                        'id' => 'forms_inputs_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Forms inputs Color', 'entitledarts'),
                        'output' => array(
                            'background-color' =>'.form-control, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea, textarea.form-control, .mail-form .input-group .form-control'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'entitledarts'),
                'fields' => array(
                    
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Body Font', 'entitledarts').'</h3>',
                    ),
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the Main Font for your site.', 'entitledarts').'</em>',
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'default' => array (
                            'font-family' => 'Montserrat',
                            'subsets' => '',
                        ),
                        'output' => array(
                            'body, p, .product-block.grid .name, .product-block.grid .groups-button .addcart > .add-cart > a.button .title-cart,
                            .apus-products-list .name, .apus-footer, .widget-testimonials,
                            .widget-testimonials .testimonials-body .testimonials-profile .testimonial-meta .info .name-client, .apus-topbar,
                            .widget_apus_recent_post .media-post-layout .posts-list .entry-title, .archive-shop div.product .information .product-navs .post-navigation .nav-links .product-nav, .archive-shop div.product .information .compare, .archive-shop div.product .information .add_to_wishlist, .archive-shop div.product .information .yith-wcwl-wishlistexistsbrowse > a, .archive-shop div.product .information .yith-wcwl-wishlistaddedbrowse > a, .information .price .woocs_price_code .woocommerce-Price-amount, .information, .archive-shop div.product .information .cart button, .tabs-v1 .tab-content, .apus-breadscrumb .breadcrumb, .kc-team .overlay .content-subtitle,
                            .kc-team:hover .overlay .content-desc, .kc_accordion_wrapper *, .widget-features-box.style3 .fbox-content .ourservice-heading,
                            .widget-features-box.style3 .fbox-content .description, .single-post, .layout-blog .entry-content, .layout-blog .info-content, .entry-description'
                        )
                    ),
                    
                    // Header
                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Heading', 'entitledarts').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('H1 Font', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the H1 Font for your site.', 'entitledarts').'</em>',
                        'id' => 'h1_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h1'
                        )
                    ),
                    array (
                        'title' => esc_html__('H2 Font', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the H2 Font for your site.', 'entitledarts').'</em>',
                        'id' => 'h2_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h2'
                        )
                    ),
                    array (
                        'title' => esc_html__('H3 Font', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the H3 Font for your site.', 'entitledarts').'</em>',
                        'id' => 'h3_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h3, .navbar-nav.megamenu > li > a, ul.nav.style1, .price .woocs_price_code .woocommerce-Price-amount,
                            .widgettitle, .newletters-1 .widgettitle, .about .tt-about, .about .author-about, ul.nav.style2, .hotline .tt-hotline, .hotline .phone,
                            .widget-ground-banner .banner-title span, .newletters-2 .widgettitle, .btn, .button, .banner1 .bn-sale, .widget .widget-title, .widget .widgettitle, .widget .widget-heading, .newletters-3 .widgettitle, .woocommerce div.product .product_title, .tabs-v1 .nav-tabs li > a,
                            .entry-title'
                        )
                    ),
                    array (
                        'title' => esc_html__('H4 Font', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the H4 Font for your site.', 'entitledarts').'</em>',
                        'id' => 'h4_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h4'
                        )
                    ),
                    array (
                        'title' => esc_html__('H5 Font', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the H5 Font for your site.', 'entitledarts').'</em>',
                        'id' => 'h5_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h5'
                        )
                    ),
                    array (
                        'title' => esc_html__('H6 Font', 'entitledarts'),
                        'subtitle' => '<em>'.esc_html__('Pick the H6 Font for your site.', 'entitledarts').'</em>',
                        'id' => 'h6_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h6'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Top Bar', 'entitledarts'),
                'fields' => array(
                    array(
                        'id'=>'topbar_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'entitledarts'),
                        'output' => '#apus-topbar'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'entitledarts'),
                        'id' => 'topbar_text_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar,  #apus-topbar p, #apus-topbar p::after'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'entitledarts'),
                        'id' => 'topbar_link_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color When Hover', 'entitledarts'),
                        'id' => 'topbar_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'entitledarts'),
                'fields' => array(
                    array(
                        'id'=>'header_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'entitledarts'),
                        'output' => '#apus-header .header-main'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'entitledarts'),
                        'id' => 'header_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'entitledarts'),
                        'id' => 'header_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'entitledarts'),
                        'id' => 'header_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .active > a, #apus-header a:active, #apus-header a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Menu', 'entitledarts'),
                'fields' => array(
                    array(
                        'title' => esc_html__('Link Color', 'entitledarts'),
                        'id' => 'main_menu_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#primary-menu a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'entitledarts'),
                        'id' => 'main_menu_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#primary-menu a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'entitledarts'),
                'fields' => array(
                    array(
                        'id'=>'footer_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'entitledarts'),
                        'output' => '.apus-footer .dark'
                    ),
                    array(
                        'title' => esc_html__('Heading Color', 'entitledarts'),
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer h1, #apus-footer h2, #apus-footer h3, #apus-footer h4, #apus-footer h5, #apus-footer h6 ,#apus-footer .widget-title'
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'entitledarts'),
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer, .apus-footer .contact-info, .apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'entitledarts'),
                        'id' => 'footer_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'entitledarts'),
                        'id' => 'footer_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a:hover'
                        )
                    ),
                )
            );
            
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Copyright', 'entitledarts'),
                'fields' => array(
                    array(
                        'id'=>'copyright_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'entitledarts'),
                        'output' => '.apus-copyright'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'entitledarts'),
                        'id' => 'copyright_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'entitledarts'),
                        'id' => 'copyright_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a, .apus-copyright a i'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'entitledarts'),
                        'id' => 'copyright_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a:hover .apus-copyright a i:hover'
                        )
                    ),
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'el el-file',
                'title' => esc_html__('Social Media', 'entitledarts'),
                'fields' => array(
                    array(
                        'id' => 'facebook_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'twitter_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable twitter Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'linkedin_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable linkedin Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'tumblr_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable tumblr Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'google_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable google plus Share', 'entitledarts'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'pinterest_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable pinterest Share', 'entitledarts'),
                        'default' => 1
                    )
                )
            );
            // Custom Code
            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'title' => esc_html__('Custom CSS/JS', 'entitledarts'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Custom CSS', 'entitledarts'),
                        'subtitle' => esc_html__('Paste your custom CSS code here.', 'entitledarts'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'entitledarts'),
                        'subtitle' => esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'entitledarts'),
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'entitledarts'),
                        'subtitle' => esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'entitledarts'),
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'entitledarts'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'entitledarts'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => esc_html__('Import Export', 'entitledarts'),
                        'subtitle' => esc_html__('Save and restore your Redux options', 'entitledarts'),
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $preset = entitledarts_get_demo_preset();
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'entitledarts_theme_options'.$preset,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Options', 'entitledarts'),
                'page_title' => esc_html__('Theme Options', 'entitledarts'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'entitledarts_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                'use_cdn' => true
            );

            return $this->args;
        }

    }

    global $reduxConfig;
    $reduxConfig = new entitledarts_Redux_Framework_Config();
}
