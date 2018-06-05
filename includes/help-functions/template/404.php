<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'girl_404', function(){
    ?>
        <div class="page_404">
            <figure class="image-404">
                <img src="<?php echo get_template_directory_uri().'/assets/img/404.gif';?>" />
                <figcaption>
                    <h2>Oop!! 404</h2>
                    <a class="comback-home" href="<?php echo get_bloginfo( 'url' );?>" title="Back To Home">Back Home</a>
                </figcaption>
            </figure>
        </div>
    <?php
} );