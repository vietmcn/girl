<?php
if ( !defined('ABSPATH') ) {
    exit;
}
//import field
require_once ( N_EXTEND_FOLDER .'/includes/class/admin/custom-field.php' );

/**
 * Custom Meta Box 
 * @link {https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/}
 * @since 1.0
 * @author Trangfox
 */
if ( !class_exists('Content_metabox') ) {
    
    class Content_metabox
    {
        protected $fields = NULL;
        
        public function __construct()
        {
            add_action( 'add_meta_boxes',        array( $this, 'metabox_add'  ) );
            add_action( 'save_post',             array( $this, 'metabox_save'  ) );
            add_action( 'admin_footer',          array( $this, 'print_script' ) );

            $this->fields = new Set_Field;

        }
        public function metabox_add()
        {
            /**
             * add_meta_boxes
             * @link {https://developer.wordpress.org/reference/functions/add_meta_box/}
             * @since 1.0
             * @author Trangfox
             */
            add_meta_box(
                '_meta_thumbnail',
                __( 'Thuộc Tính' ),
                array( $this, 'mb_callback' ),
                'photo',
                'normal', 
                'default'
            );
            add_meta_box(
                '_meta_seo',
                __( 'Thuộc Tính SEO' ),
                array( $this, 'mb_callbackseo' ),
                array( 'photo', 'page' ),
                'normal', 
                'default'
            );
        }
        public function mb_callbackseo( $post ) 
        {
            wp_nonce_field( 'car_nonce_action', 'car_nonce' );
            
            $this->fields->Metabox_field( array(
                'type' => 'textbox',
                'keyname' => '_meta_thumbnail',
                'post_id' => $post->ID,
                'content' => array(
                    'id_1' => [
                                'title' => 'Title Seo',
                                'Desc'  => 'Thêm Tiêu Đề Dành Cho Content',
                                'value' => 'meta_seo_title'
                    ],
                ),
            ) );

        }
        public function mb_callback( $post )
        {
            wp_nonce_field( 'car_nonce_action', 'car_nonce' );
            
            $this->fields->Metabox_field( array(
                'type' => 'textbox',
                'keyname' => '_meta_thumbnail',
                'post_id' => $post->ID,
                'content' => array(
                    'id_1' => [ 
                                'title' => 'Thumbnail', 
                                'value' => 'meta_thumbnail' 
                    ],
                    'id_2' => [ 
                                'title' => 'Count Pic', 
                                'value' => 'meta_count' 
                    ],
                    'id_3' => [
                                'title' => 'File Size',
                                'value' => 'meta_filesize'
                    ],
                    'id_4' => [
                                'title' => 'File Download',
                                'value' => 'meta_download' 
                    ],
                ),
            ) );
        }
        public function metabox_save( $post_id )
        {
            // Save logic goes here. Don't forget to include nonce checks!
            $nonce_name   =  isset( $_POST['car_nonce'] ) ? $_POST['car_nonce'] : '';
        
            $nonce_action = 'car_nonce_action';
            // Check if a nonce is set.
            if ( ! isset( $nonce_name ) )
               return;
        
            // Check if a nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
                return $post_id;

            // check autosave
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
                return $post_id;

            // check permissions
            if ( 'page' == $_POST['post_type'] ) {

                if (!current_user_can('edit_page', $post_id)) 

                    return $post_id;

            } elseif (! current_user_can('edit_post', $post_id) ) {

                return $post_id;

            }
            // loop through fields and save the data
            
                $new_Thumbnail = $_POST['_meta_thumbnail'];
                $new_Seo       = $_POST['_meta_seo'];

                update_post_meta( $post_id, '_meta_thumbnail', $new_Thumbnail );
                update_post_meta( $post_id, '_meta_seo', $new_Seo );

        }
        public function print_script()
        {
            $screen = get_current_screen(); // This is how we will check what page we are on
            #if ( in_array( $screen->id, array( 'post', 'page' ) ) ) {
                ?>
                    <style>
                        .button_plus {
                            background: #e02222;
                            padding: 0px 5px 3px;
                            color: #fff;
                            border-radius: 5px;
                            font-size: 15px;
                            display: inline-flex;
                            font-weight: 700;
                            cursor: pointer;
                            margin-left: 5px;
                            vertical-align: -3px;
                            line-height: 15px;
                        }
                        .address input {
                            width: 90%;
                            margin-bottom: 5px;
                        }
                    </style>
                    <script> 
                        jQuery(document).ready(function ($) {
                            $(document).ready(function(){
                                $("#add-address").click(function(e){
                                    e.preventDefault();
                                    var numberOfAddresses = $(".postbox").find("input[name^='_meta_thumbnail[meta_download]']").length;
                                    var input = '<input type="text" name="_meta_thumbnail[meta_download][' + numberOfAddresses + ']" />';
                                    var removeButton = '<span class="remove-address button_plus">-</span>';
                                    var html = "<div class='address'>" + input + removeButton + "</div>";
                                    $(".postbox").find(".meta_label").after(html);
                                });
                            });

                            $(document).on("click", ".remove-address",function(e){
                                e.preventDefault();
                                $(this).parents(".address").remove();
                                //update labels
                                $(".postbox").find("label[for^='_meta_thumbnail']").each(function(){
                                    //$(this).html("Ảnh Đại Diện " + ($(this).parents('.address').index() + 1));
                                });
                            });
                        });
                    </script>
                <?php 
            #}
        }
    }
}
return new Content_metabox;