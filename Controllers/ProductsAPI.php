<?php

// Public products Controller

Class ProductsAPI {

	private $model;

	function __construct($action = "none", $id = 0) {
		
		$this->model = new Model();
	}
	
	public function fetchAll() {
		
		$data = $this->model->fetchPosts("DESC");
		
		// Koodihelvetti!
		for($i = 0; $i < count($data); $i++)
		{
			$preview_img = ROOT_PATH."/uploads/products/".$data[$i]['uniqid']."_1";
			$file_form = $this->model->image_exists($preview_img);
			$preview_img = end(explode("/",$preview_img));
			
			if ($file_form !== false) {
				$data[$i]['img'] = "../ArtomiSys/uploads/products/".$preview_img.".".$file_form;
			} else {
				$data[$i]['img'] = "../ArtomiSys/uploads/products/".DEFAULT_PREVIEW_IMG;
			}
		}
		return $data;
	}
}