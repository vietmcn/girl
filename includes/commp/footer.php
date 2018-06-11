<?php 
if ( !defined('ABSPATH') ) {
    exit;
}
add_action( 'girl_footer', function() {
    ?>
        <footer class="trangfox-cp <?php ninja_class();?>">
            <div class="cp flex">trangfox © 2018</div>
        </footer>
    <?php 
} );