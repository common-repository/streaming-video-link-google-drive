<?php

namespace Stream3s\Helpers;

class Stream3sApi {

	public static $API_URL = 'https://stream3s.com/api';
	
	protected $session_id;
	protected $errors = [];
	
	public function login($client_id, $secret_key) {
		$response = $this->_callApi('session/login', [
			'client_id' => $client_id,
			'secret_key' => $secret_key
		], 'POST');
		
		if (empty($response['status'])) {
			$this->errors[] = $response['data']['message'];
			return false;
		}
		
		$this->session_id = $response['data']['session_id'];
		return true;
	}
	
	public function getEmbedLink($video_id) {
		if (empty($this->session_id)) {
			return false;
		}
		
		$response = $this->_callApi('video/info/' . $video_id, [
			'session_id' => $this->session_id
		]);
		
		if (empty($response['status'])) {
			$this->errors[] = $response['data']['message'];
			return false;
		}
		
		return $response['data']['security_embed_link'];
	}
	
	public function addAndGetEmbedLink($video_url) {
		if (empty($this->session_id)) {
			return false;
		}
		
		$response = $this->_callApi('embed/add', [
			'session_id' => $this->session_id,
			'video_url' => $video_url,
		], 'POST');
		
		if (empty($response['status'])) {
			$this->errors[] = $response['data']['message'];
			return false;
		}
		
		return $response['data']['security_embed_link'];
	}
	
	public function getDirectLink($video_id) {
		if (empty($this->session_id)) {
			return false;
		}
		
		$response = $this->_callApi('direct/' . $video_id, [
			'session_id' => $this->session_id,
			'client_ip' => stream3s_get_client_ip(),
		]);
		
		if (empty($response['status'])) {
			$this->errors[] = $response['data']['message'];
			return false;
		}
		
		return $response['data']['files'];
	}
	
	public function addAndGetDirectLink($video_url) {
		if (empty($this->session_id)) {
			return false;
		}
		
		$response = $this->_callApi('direct/add', [
			'session_id' => $this->session_id,
			'video_url' => $video_url,
			'client_ip' => stream3s_get_client_ip(),
		]);
		
		if (empty($response['status'])) {
			$this->errors[] = $response['data']['message'];
			return false;
		}
		
		return $response['data']['files'];
	}
	
	public function getErrors() {
		return $this->errors;
	}
	
	private function _callApi($uri, $params = [], $method = 'GET') {
		if ($method === 'GET') {
			$response = wp_remote_get(static::$API_URL . '/' . $uri, $params);
		}
		else {
			$response = wp_remote_post(static::$API_URL . '/' . $uri, [
				'body' => $params
			]);
		}
		
		return json_decode(wp_remote_retrieve_body($response), true);
	}
	
}