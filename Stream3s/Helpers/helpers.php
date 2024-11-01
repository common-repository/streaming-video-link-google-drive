<?php

use Stream3s\Helpers\Stream3sApi;

if (!function_exists('dd')) {
	function dd($var) {
		var_dump($var);
		die();
	}
}

if (!function_exists('stream3s_is_url')) {
	function stream3s_is_url($string) {
		if (filter_var($string, FILTER_VALIDATE_URL)) {
			return true;
		}
		
		return false;
	}
}

if (!function_exists('stream3s_load_php')) {
	function stream3s_load_php($directory) {
		if(is_dir($directory)) {
			$scan = scandir($directory);
			unset($scan[0], $scan[1]);
			
			foreach($scan as $file) {
				if ( is_dir( $directory . "/" . $file ) ) {
					stream3s_load_php( $directory . "/" . $file );
				} else {
					if ( strpos( $file, '.php' ) !== false ) {
						require_once( $directory . "/" . $file );
					}
				}
			}
		}
	}
}

if (!function_exists('stream3s_get_client_ip')) {
	function stream3s_get_client_ip() {
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			return $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		
		if (isset($_SERVER)) {
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && ip2long($_SERVER["HTTP_X_FORWARDED_FOR"]) !== false) {
				$ipadres = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} elseif (isset($_SERVER["HTTP_CLIENT_IP"])  && ip2long($_SERVER["HTTP_CLIENT_IP"]) !== false) {
				$ipadres = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$ipadres = $_SERVER["REMOTE_ADDR"];
			}
		} else {
			if (getenv('HTTP_X_FORWARDED_FOR') && ip2long(getenv('HTTP_X_FORWARDED_FOR')) !== false) {
				$ipadres = getenv('HTTP_X_FORWARDED_FOR');
			} elseif (getenv('HTTP_CLIENT_IP') && ip2long(getenv('HTTP_CLIENT_IP')) !== false) {
				$ipadres = getenv('HTTP_CLIENT_IP');
			} else {
				$ipadres = getenv('REMOTE_ADDR');
			}
		}
		return $ipadres;
	}
}

if (!function_exists('stream3s_get_embed_stream')) {
	function stream3s_get_embed_stream($video_url) {
		$client_id = get_option('stream3s_client_id');
		$secret_key = get_option('stream3s_secret_key');
		
		if (empty($client_id) || empty($secret_key)) {
			return false;
		}
		
		$stream3s = new Stream3sApi();
		if ($stream3s->login($client_id, $secret_key)) {
			$link = $stream3s->addAndGetEmbedLink($video_url);
			if ($link) {
				return $link;
			}
		}
		
		return false;
	}
}

if (!function_exists('stream3s_get_direct_stream')) {
	function stream3s_get_direct_stream($video_url) {
		$client_id = get_option('stream3s_client_id');
		$secret_key = get_option('stream3s_secret_key');
		
		if (empty($client_id) || empty($secret_key)) {
			return false;
		}
		
		$stream3s = new Stream3sApi();
		if ($stream3s->login($client_id, $secret_key)) {
			$files = $stream3s->addAndGetDirectLink($video_url);
			if ($files) {
				return $files;
			}
		}
		
		return false;
	}
}