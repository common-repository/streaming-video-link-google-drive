<?php

namespace Stream3s\Controllers;

class MenuController {
	
	public function init() {
		add_action('admin_menu', [$this, 'admin_menu']);
	}
	
	public function admin_menu() {
		add_submenu_page(
			'options-general.php',
			'Google Drive Stream Setting',
			'Google Drive Stream',
			'manage_options',
			'stream3s-setting',
			[new SettingController(), 'index']
		);
	}
}