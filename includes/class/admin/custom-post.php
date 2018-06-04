<?php 
/**
 * Custom Post Type 
 * @link {https://codex.wordpress.org/Post_Types}
 * @since 1.0
 * @author Trangfox
 */
if ( !defined('ABSPATH') ) {
    exit;
}
if ( !class_exists('Content_thumbnail') ) {
    class Content_thumbnail
    {
        public function __construct()
        {
            add_action( 'init', array( $this, 'Thumbnail' ), 0 );
            add_action( 'pre_get_posts', array( $this, 'pre_get_post' ) );
        }
        public function Thumbnail() {

            $labels = array(
                'name'                  => _x( 'Thumbnail', 'Post Type General Name', 'girl' ),
                'singular_name'         => _x( 'Thumbnail', 'Post Type Singular Name', 'girl' ),
                'menu_name'             => __( 'Thumbnail', 'girl' ),
                'name_admin_bar'        => __( 'Thumbnail', 'girl' ),
                'archives'              => __( 'Item Archives', 'girl' ),
                'attributes'            => __( 'Item Attributes', 'girl' ),
                'parent_item_colon'     => __( 'Parent Item:', 'girl' ),
                'all_items'             => __( 'All Items', 'girl' ),
                'add_new_item'          => __( 'Add New Item', 'girl' ),
                'add_new'               => __( 'Add New', 'girl' ),
                'new_item'              => __( 'New Item', 'girl' ),
                'edit_item'             => __( 'Edit Item', 'girl' ),
                'update_item'           => __( 'Update Item', 'girl' ),
                'view_item'             => __( 'View Item', 'girl' ),
                'view_items'            => __( 'View Items', 'girl' ),
                'search_items'          => __( 'Search Item', 'girl' ),
                'not_found'             => __( 'Not found', 'girl' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'girl' ),
                'featured_image'        => __( 'Featured Image', 'girl' ),
                'set_featured_image'    => __( 'Set featured image', 'girl' ),
                'remove_featured_image' => __( 'Remove featured image', 'girl' ),
                'use_featured_image'    => __( 'Use as featured image', 'girl' ),
                'insert_into_item'      => __( 'Insert into item', 'girl' ),
                'uploaded_to_this_item' => __( 'Uploaded to this item', 'girl' ),
                'items_list'            => __( 'Items list', 'girl' ),
                'items_list_navigation' => __( 'Items list navigation', 'girl' ),
                'filter_items_list'     => __( 'Filter items list', 'girl' ),
            );
            $args = array(
                'label'                 => __( 'Post Type', 'girl' ),
                'description'           => __( 'Post Type Description', 'girl' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'excerpt' ),
                'taxonomies'            => array( 'category', 'post_tag' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'menu_icon'             => 'dashicons-format-gallery',
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => true,
                'publicly_queryable'    => true,
                'rewrite'               => array(
                                                'slug'       => 'photo', // if you need slug
                                                'with_front' => false,
                                        ),
                'capability_type'       => 'post',
            );
            register_post_type( 'photo', $args );
        }
        public function pre_get_post( $query ) 
        {
            /**
            * Set Pre Post
            * @link {}
            * @since 1.0
            * @author Girl 
            */
            if ( $query->is_main_query() && !$query->is_feed() && !is_admin() && ( is_category() || is_tag() ) ) {
                $query->set( 'page_cat', get_query_var('paged') );
                $query->set( 'page_tag', get_query_var('paged') );
                $query->set( 'post_type', array( 'photo' ) );
                $query->set( 'paged', 0 );
            }
        }
    }
}
return new Content_thumbnail;