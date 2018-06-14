<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Custom_Menu 
{
    protected $att = array();
    protected $link = NULL;
    protected $current = NULL;

    function current( $url )
	{
		$pagenum_link = html_entity_decode( get_pagenum_link() );
        $url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
            
			if ( $url_parts[1] == $url ){
                return 'current';
			}
		} else {
			if ( $url_parts[0] == $url ) {
				return 'current';
			}
		}
		
		return 'no-current';
	}
    public function menu( $att )
    {   
        if ( !empty( $att['query'] ) ) {
            $query = $att['query'];
        } else {
            $query = $att['link'];
        }
        return '<a class="'.$this->current( $query ).'" href="'.$att['link'].'" title="'.$att['name'].'">'.$att['name'].'</a>';
    }
    
}
$custom_menu = new Custom_Menu();