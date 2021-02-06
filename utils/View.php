<?php

namespace Bihin\steampunkLibrary\utils;

class View
{
	private $file;

	public function __construct($file){
		$this->file = $file;
	}

	public function render($params = []){
		extract($params);
		$file = $this->file;
		ob_start();
		require_once 'view/' . $file . '.php';
		$content = ob_get_clean();
		require_once 'view/template.php';
	}
}
