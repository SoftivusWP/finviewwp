<?php

class TpLoansPost
{
    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post_type'));
        add_action('init', array($this, 'create_cat'));
        add_filter('template_include', array($this, 'loans_template_include'));
    }

    public function loans_template_include($template)
    {
        if (is_singular('loans')) {
            return $this->get_template('single-loan.php');
        }
        return $template;
    }

    public function get_template($template)
    {
        if ($theme_file = locate_template(array($template))) {
            $file = $theme_file;
        } else {
            $file = TPCORE_ADDONS_DIR . '/include/template/' . $template;
        }
        return apply_filters(__FUNCTION__, $file, $template);
    }

    public function register_custom_post_type()
    {
        $finview_loan_slug = get_theme_mod('finview_loan_slug', __('loans', 'finview'));
        $labels = array(
            'name'                  => esc_html_x($finview_loan_slug, ' Post Type General Name', 'finview'),
            'singular_name'         => esc_html_x('Loan', 'Post Type Singular Name', 'finview'),
            'menu_name'             => esc_html__($finview_loan_slug, 'finview'),
            'name_admin_bar'        => esc_html__('Loan', 'finview'),
            'archives'              => esc_html__('Item Archives', 'finview'),
            'parent_item_colon'     => esc_html__('Parent Item:', 'finview'),
            'all_items'             => esc_html__('All Items', 'finview'),
            'add_new_item'          => esc_html__('Add New Item', 'finview'),
            'add_new'               => esc_html__('Add New', 'finview'),
            'new_item'              => esc_html__('New Item', 'finview'),
            'edit_item'             => esc_html__('Edit Item', 'finview'),
            'update_item'           => esc_html__('Update Item', 'finview'),
            'view_item'             => esc_html__('View Item', 'finview'),
            'search_items'          => esc_html__('Search Item', 'finview'),
            'not_found'             => esc_html__('Not found', 'finview'),
            'not_found_in_trash'    => esc_html__('Not found in Trash', 'finview'),
            'featured_image'        => esc_html__('Featured Image', 'finview'),
            'set_featured_image'    => esc_html__('Set featured image', 'finview'),
            'remove_featured_image' => esc_html__('Remove featured image', 'finview'),
            'use_featured_image'    => esc_html__('Use as featured image', 'finview'),
            'insert_into_item'      => esc_html__('Insert into item', 'finview'), // Corrected typo
            'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'finview'),
            'items_list'            => esc_html__('Items list', 'finview'),
            'items_list_navigation' => esc_html__('Items list navigation', 'finview'),
            'filter_items_list'     => esc_html__('Filter items list', 'finview'),
        );

        $args = array(
            'label'                 => esc_html__('Loan', 'finview'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'comments'),
            'taxonomies'            => array('post_tag'), // Add support for post tags
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-shield',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'rewrite' => array(
                'slug' => $finview_loan_slug,
                'with_front' => false,
                'menu_name' => $finview_loan_slug,
                'name'      => $finview_loan_slug,

            ),
        );

        register_post_type('loans', $args);
    }

    public function create_cat()
    {
        $finview_loan_slug = get_theme_mod('finview_loan_slug', __('loans', 'finview'));
        $taxonomy_slug = $finview_loan_slug . '-cat';
        $labels = array(
            'name'                       => esc_html_x($finview_loan_slug . ' Categories', 'Taxonomy General Name', 'finview'),
            'singular_name'              => esc_html_x('Category', 'Taxonomy Singular Name', 'finview'),
            'menu_name'                  => esc_html__('Categories', 'finview'),
            'all_items'                  => esc_html__('All' . $finview_loan_slug . 'Categories', 'finview'),
            'parent_item'                => esc_html__('Parent ' . $finview_loan_slug . ' Category', 'finview'),
            'parent_item_colon'          => esc_html__('Parent ' . $finview_loan_slug . ' Category:', 'finview'),
            'new_item_name'              => esc_html__('New ' . $finview_loan_slug . ' Category Name', 'finview'),
            'add_new_item'               => esc_html__('Add New ' . $finview_loan_slug . ' Category', 'finview'),
            'edit_item'                  => esc_html__('Edit ' . $finview_loan_slug . ' Category', 'finview'),
            'update_item'                => esc_html__('Update ' . $finview_loan_slug . ' Category', 'finview'),
            'view_item'                  => esc_html__('View ' . $finview_loan_slug . ' Category', 'finview'),
            'separate_items_with_commas' => esc_html__('Separate ' . $finview_loan_slug . ' categories with commas', 'finview'),
            'add_or_remove_items'        => esc_html__('Add or remove ' . $finview_loan_slug . ' categories', 'finview'),
            'choose_from_most_used'      => esc_html__('Choose from the most used ' . $finview_loan_slug . ' categories', 'finview'),
            'popular_items'              => esc_html__('Popular ' . $finview_loan_slug . ' Categories', 'finview'),
            'search_items'               => esc_html__('Search ' . $finview_loan_slug . ' Categories', 'finview'),
            'not_found'                  => esc_html__('Not Found', 'finview'),
            'no_terms'                   => esc_html__('No ' . $finview_loan_slug . ' categories', 'finview'),
            'items_list'                 => esc_html__($finview_loan_slug . ' categories list', 'finview'),
            'items_list_navigation'      => esc_html__($finview_loan_slug . ' categories list navigation', 'finview'),
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'           => array(
                'slug'       => $taxonomy_slug,
                'with_front' => false,
            ),
        );

        register_taxonomy('loans-cat', 'loans', $args);
    }
}

new TpLoansPost();
