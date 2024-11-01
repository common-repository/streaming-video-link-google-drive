<?php

namespace Stream3s\Controllers;

class EmbedController {
	public function init() {
		add_shortcode( 'STREAM3S_EMBED', [$this, 'create_shortcode'] );
	}
	
	function create_shortcode($args, $content) {
		$url = isset($args['url']) ? $args['url'] : null;
		$height = isset($args['height']) ? $args['height'] : null;
		$width = isset($args['width']) ? $args['width'] : null;
		
		if (empty($url)) {
			return '';
		}
		
		$client_id = get_option('stream3s_client_id');
		$secret_key = get_option('stream3s_secret_key');
		
		if (empty($client_id) || empty($secret_key)) {
			return '';
		}
		
		$embed_link = stream3s_get_embed_stream($url);
		
		$params = [];
		if ($width) {
			$params['width'] = $width;
		}
		
		if ($height) {
			$params['height'] = $height;
		}
		
		$text_params = '';
		foreach ($params as $key => $param) {
			$text_params .= $key .'="'. esc_attr($param) .'"';
		}
		
		return '<iframe src="'. esc_url($embed_link) .'" '. $text_params .' frameborder="0" allowfullscreen></iframe>';
	}
	
}