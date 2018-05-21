<?php 
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( !class_exists( 'Girl_Shortcode' ) ) {
    class Girl_Shortcode
    {
        public function __construct()
        {
            add_shortcode( 'json', array( $this, 'photo' ) );
        }
        public function photo( $atts, $content )
        {
            $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); // Remove all instances of "<p>&nbsp;</p>" to avoid extra lines.
            $Old     = array( '<br />', '<br>' );
            $New     = array( '','' );
            $content = str_replace( $Old, $New, $content );
            $content = explode( ',', $content );
            $items = '';
            $i = 1;
            $size = count( $content );

            foreach( $content as $item ) {
                
                $items .= '{';
                $items .= '"id":'.$i++.',';
                $items .= '"photo":"'.$item.'"';
                $items .= '},';
            }
            ob_start();
            $out = '
                <figure id="photo"></figure>
                <div class="control-nextpic flex">
                    <button id="previous" class="flex">Previous</button>
                    <span class="count-pic flex">Photos(<i id="count"></i>/'.$size.')</span>
                    <button id="next" class="flex">Next</button>
                </div>
                <script type="text/javascript"> var blogs= {"blogItem":['.$items.']};</script>
            ';
            $out .= ob_get_clean();
            return $out;
        }
    }
}
return new Girl_Shortcode;

