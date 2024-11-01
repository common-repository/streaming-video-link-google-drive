<?php

namespace Stream3s\Controllers;

use Stream3s\Helpers\Request;

class SettingController {
	public function init() {
		add_action('wp_ajax_stream3s_save_setting', [$this, 'save']);
	}
	
	public function index() {
		include (STREAM3S_CORE_DIRECTORY . '/Views/setting.php');
	}
	
	public function save() {
		$client_id = Request::post('stream3s_client_id', '', Request::$TEXT);
		$secret_key = Request::post('stream3s_secret_key', '', Request::$TEXT);
		
		update_option('stream3s_client_id', $client_id);
		update_option('stream3s_secret_key', $secret_key);
		
		wp_redirect('options-general.php?page=stream3s-setting');
		die();
	}
}