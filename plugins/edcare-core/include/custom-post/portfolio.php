<?php 
class TpPortfoliosPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'portfolios_template_include' ) );
	}
	
	public function portfolios_template_include( $template ) {
		if ( is_singular( 'tp-portfolios' ) ) {
			return $this->get_template( 'single-tp-portfolios.php');
		}
		return $template;
	}
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = EDCARE_CORE_ADDONS_DIR . '/include/template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}
	
	
	public function register_custom_post_type() {
		$ishpat_portfolios_slug = get_theme_mod( 'ishpat_portfolios_slug', __( 'tp-portfolios', 'tpcore' ) );
		$labels = array(
			'name'                  => esc_html_x( 'Portfolios', 'Post Type General Name', 'tpcore' ),
			'singular_name'         => esc_html_x( 'Portfolio', 'Post Type Singular Name', 'tpcore' ),
			'menu_name'             => esc_html__( 'Portfolios', 'tpcore' ),
			'name_admin_bar'        => esc_html__( 'Portfolios', 'tpcore' ),
			'archives'              => esc_html__( 'Item Archives', 'tpcore' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'tpcore' ),
			'all_items'             => esc_html__( 'All Items', 'tpcore' ),
			'add_new_item'          => esc_html__( 'Add New Portfolio', 'tpcore' ),
			'add_new'               => esc_html__( 'Add New', 'tpcore' ),
			'new_item'              => esc_html__( 'New Item', 'tpcore' ),
			'edit_item'             => esc_html__( 'Edit Item', 'tpcore' ),
			'update_item'           => esc_html__( 'Update Item', 'tpcore' ),
			'view_item'             => esc_html__( 'View Item', 'tpcore' ),
			'search_items'          => esc_html__( 'Search Item', 'tpcore' ),
			'not_found'             => esc_html__( 'Not found', 'tpcore' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'tpcore' ),
			'featured_image'        => esc_html__( 'Featured Image', 'tpcore' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'tpcore' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'tpcore' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'tpcore' ),
			'inserbt_into_item'     => esc_html__( 'Insert into item', 'tpcore' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'tpcore' ),
			'items_list'            => esc_html__( 'Items list', 'tpcore' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'tpcore' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'tpcore' ),
		);

		$args   = array(
			'label'                 => esc_html__( 'Portfolio', 'tpcore' ),
			'labels'                => $labels,
			'supports'              => ['title', 'editor', 'thumbnail', 'elementor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-media-document',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $ishpat_portfolios_slug,
				'with_front' => false
			),
		);

		register_post_type( 'tp-portfolios', $args );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Portfolio Categories', 'Taxonomy General Name', 'tpcore' ),
			'singular_name'              => esc_html_x( 'Portfolio Categories', 'Taxonomy Singular Name', 'tpcore' ),
			'menu_name'                  => esc_html__( 'Portfolio Categories', 'tpcore' ),
			'all_items'                  => esc_html__( 'All Portfolio Category', 'tpcore' ),
			'parent_item'                => esc_html__( 'Parent Item', 'tpcore' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'tpcore' ),
			'new_item_name'              => esc_html__( 'New Portfolio Category Name', 'tpcore' ),
			'add_new_item'               => esc_html__( 'Add New Portfolio Category', 'tpcore' ),
			'edit_item'                  => esc_html__( 'Edit Portfolio Category', 'tpcore' ),
			'update_item'                => esc_html__( 'Update Portfolio Category', 'tpcore' ),
			'view_item'                  => esc_html__( 'View Portfolio Category', 'tpcore' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'tpcore' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'tpcore' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'tpcore' ),
			'popular_items'              => esc_html__( 'Popular Portfolio Category', 'tpcore' ),
			'search_items'               => esc_html__( 'Search Portfolio Category', 'tpcore' ),
			'not_found'                  => esc_html__( 'Not Found', 'tpcore' ),
			'no_terms'                   => esc_html__( 'No Portfolio Category', 'tpcore' ),
			'items_list'                 => esc_html__( 'Portfolio Category list', 'tpcore' ),
			'items_list_navigation'      => esc_html__( 'Portfolio Category list navigation', 'tpcore' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('portfolios-cat','tp-portfolios', $args );
	}

}

new TpPortfoliosPost();