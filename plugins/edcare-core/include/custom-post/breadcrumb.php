<?php
class Tp_Breadcrumb_Post
{

    private $type = 'tp-breadcrumb';
    private $slug;
    private $name;
    private $plural_name;

    public function __construct()
    {
        $this->name = __('Breadcrumb', 'tpcore');
        $this->slug = 'tp-breadcrumb';
        $this->plural_name = __('Breadcrumb', 'tpcore');

        add_action('init', array($this, 'register_custom_post_type'));

    }


    public function register_custom_post_type()
    {
        $icon = EDCARE_CORE_ADDONS_URL . '/assets/img/icons/menu-icon.png';
        $labels = array(
            'name' => $this->name,
            'singular_name' => $this->name,
            'add_new' => sprintf(__('Add New Template', 'tpcore'), $this->name),
            'add_new_item' => sprintf(__('Add New %s', 'tpcore'), $this->name),
            'edit_item' => sprintf(__('Edit %s', 'tpcore'), $this->name),
            'new_item' => sprintf(__('New %s', 'tpcore'), $this->name),
            'all_items' => sprintf(__('All Templates', 'tpcore'), $this->plural_name),
            'view_item' => sprintf(__('View %s', 'tpcore'), $this->name),
            'search_items' => sprintf(__('Search %s', 'tpcore'), $this->name),
            'not_found' => sprintf(__('No %s found', 'tpcore'), strtolower($this->name)),
            'not_found_in_trash' => sprintf(__('No %s found in Trash', 'tpcore'), strtolower($this->name)),
            'parent_item_colon' => '',
            'menu_name' => $this->name,
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'rewrite' => ['slug' => $this->slug],
            'menu_position' => 10,
            'supports' => ['title', 'editor', 'thumbnail', 'page-attributes', 'elementor'],
            'menu_icon' => 'dashicons-admin-page'
        );

        register_post_type($this->type, $args);

        $cpt_support = get_option('elementor_cpt_support');
        if (!$cpt_support) {
            $cpt_support = ['page', 'post', 'tp-header', 'tp-footer', 'elementor_disable_color_schemes']; //create array of our default supported post types
            update_option('elementor_cpt_support', $cpt_support); //write it to the database
        }
    }

}

new Tp_Breadcrumb_Post();