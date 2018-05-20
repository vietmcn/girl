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
            $out = '
                <script type="text/javascript"> 
                var blogs= {
                    "blogItem":['.$items.']
                };
                </script>
                <div>
                    <div id="photo"></div>
                </div>
                <button id="previous">Previous</button>
                <button id="next">Next</button>
            ';
            return $out;
        }
    }
}
return new Girl_Shortcode;