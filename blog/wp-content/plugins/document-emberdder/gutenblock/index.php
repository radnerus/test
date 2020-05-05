<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



function ppv_ter_block_type($kahfBlockName, $kahfBlockOption = array()) {
	register_block_type(
		'ppv-kit/' . $kahfBlockName,
		array_merge(
			array(
				'editor_script' => 'ppv-kit-editor-script',
				'editor_style' => 'ppv-kit-editor-style',
				'script' => 'ppv-kit-front-script',
				'style' => 'ppv-kit-front-style'
			),
			$kahfBlockOption
		)
	);
}

function ppv_blocks_script() {
	wp_register_script(
		'ppv-kit-editor-script',
		plugins_url('dist/js/editor-script.js', __FILE__),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor',
			'wp-components',
			'wp-compose',
			'wp-data',
			'wp-autop',
		)
	);	
	ppv_ter_block_type('kahf-banner-k27f', array(
		'render_callback' => 'ppv_block_custom_post_fun',
		'attributes' => array(
			'postName' => array(	
				'type' => 'string',
				'source' => 'html',
			),
		)
	));
	
}
add_action('init', 'ppv_blocks_script');



function ppv_block_custom_post_fun ( $attributes, $content ) {
	
	return wpautop( $content );
}