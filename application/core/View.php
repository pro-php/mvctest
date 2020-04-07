<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($title, $vars = []) {		
		$path = 'application/views/'.$this->path.'.php';
		if (file_exists($path)) {
			@extract($this->check($vars));

			ob_start();
			require $path;
			$content = ob_get_clean();

			require 'application/views/layouts/'.$this->layout.'.php';
		}
	}

	public function check($vars) {
		if (empty($vars)) return '';

		if(is_array($vars)) {
			array_walk_recursive($vars, function(&$value, $key) {
				if ($key!='pagination')
					$value = $this->html2chars($value);
			});
		}
		else
			$vars = $this->html2chars($vars);

		return $vars;		
	}

	public function html2chars($value) {
		return htmlspecialchars($value, ENT_QUOTES);		  
	}

	public function redirect($url) {
		header('Location: /'.$url);
		exit;
	}

	public static function redirect301($path) { 
		$protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
		$host = $_SERVER['SERVER_NAME'];
		$url = "$protocol://$host/$path/";

		http_response_code(301);
		header("Location: $url");
		exit();
	}

	public static function errorCode($code,$path='') {
		if ($code==301 && !empty($path))
			self::redirect301($path);
		else {
			http_response_code($code);
			$path = 'application/views/errors/'.$code.'.php';
			if (file_exists($path)) {
				require $path;
			}
			exit;
		}
	}

	public function message($status, $message, $url='') {
		exit(json_encode(['status' => $status, 'message' => $message, 'url' => $url]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}
 
}	