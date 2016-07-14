<?php

Class View {
	
	public $data;
	
	function __construct($page, $action) {
		
	}
	
	public function render($sheet) {
		require_once("views/header.php");
		require_once("views/" .$sheet. ".php");
		require_once("views/footer.php");
	}
}