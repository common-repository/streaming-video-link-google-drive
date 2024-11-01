<?php

namespace Stream3s\Core;

class Stream3s {
	
	public function init() {
		foreach (glob(STREAM3S_CORE_DIRECTORY . "/Controllers/*.php") as $filename) {
			$class_name = str_replace('.php', '', basename($filename));
			$class_name = 'Stream3s\Controllers\\' . $class_name;
			
			if (class_exists($class_name)) {
				$obj = new $class_name();
				$obj->init();
			}
		}
	}
	
}