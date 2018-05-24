<?php
if ( !defined('ABSPATH') ) {
    exit;
}
/**
 * Custom Meta Box 
 * @link {https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/}
 * @since 1.0
 * @author Trangfox
 */
if ( !class_exists('Content_metabox') ) {
    class Content_metabox
    {
        public function __construct()
        {
            add_action( 'add_meta_boxes',        array( $this, 'metabox_add'  ) );
            add_action( 'save_post',             array( $this, 'metabox_save'  ) );
            add_action( 'admin_footer',          array( $this, 'print_script' ) );
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
        }
        public function mb_callback( $post )
        {
            //import field
            require_once ( N_EXTEND_FOLDER .'/includes/class/admin/custom-field.php' );

            wp_nonce_field( 'car_nonce_action', 'car_nonce' );

            $field = new Set_Field;
            
            $field->Metabox_field( array(
                'type' => 'textbox',
                'keyname' => '_meta_thumbnail',
                'post_id' => $post->ID,
                'content' => array(
                    'id_1' => 'meta_thumbnail',
                    'id_2' => 'meta_count',
                    'id_3' => 'meta_filesize',
                    'id_4' => 'meta_download',
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
            

                $old = get_post_meta( $post_id, '_meta_thumbnail', false );

                $new = $_POST['_meta_thumbnail'];

                if ( $new && $new != $old ) {

                    update_post_meta( $post_id, '_meta_thumbnail', $new );

                } elseif ( '' == $new ) {

                    delete_post_meta( $post_id, '_meta_thumbnail' );

                }
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