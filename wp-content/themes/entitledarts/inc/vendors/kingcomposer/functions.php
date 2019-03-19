<?php

add_action('init', 'entitledarts_kingcomposer_init');
function entitledarts_kingcomposer_init() {
    if ( function_exists( 'kc_add_icon' ) ) {
    	$css_folder = entitledarts_get_css_folder();
		$min = entitledarts_get_asset_min();
        kc_add_icon( $css_folder . '/font-monia'.$min.'.css' );
    }
 
}