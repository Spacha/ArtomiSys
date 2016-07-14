<?php

// Products Controller

Class Products {

	private $model;
	private $view;

	function __construct($action = "none", $id = 0) {
		
		$this->model = new Model();
		$this->view = new View("products", $action);
		
		switch($action) {
			case "view":
				$this->view($id);
				break;
			case "edit":
				$this->edit($id);
				break;
			case "saveProduct":
				$this->saveProduct($id);
				break;
			case "delete":
				$this->delete($id);
			case "confirmDelete":
				$this->confirmDelete($id);
				break;
			case "none":
				$this->productList();
				break;
			default:
				die("An error occurred.");
				break;
		}
	}
	
	public function view($id) {
		$this->view->data = $this->model->fetchPostData($id, true);
		$this->view->render("products/view");
	}
	
	public function productList() {
		$this->view->data = $this->model->fetchPosts("DESC");
		$this->view->render("products/index");
	}
	
	public function edit($id = false) {
	
		if(isset($id) && $id > 0) {
			$this->view->data = $this->model->fetchPostData($id);
			$this->view->render("products/edit");
		} else {
			$this->view->render("products/create");
		}
	}
	
	public function saveProduct($id = 0) {
		
		if ($id > 0) {
			// die("Editing is not yet possible.");
		
			// Go through images to remove them
			// Search all matching images, upload new images with free names (e.g. 1,3 used -> use 2)
			// Save data to database
			
			$old_data = $this->model->fetchPostData($id);
			$uniqid = $old_data['uniqid'];
			
			$remove_1 = isset($_POST['remove_1']) ? $_POST['remove_1'] : null;
			$remove_2 = isset($_POST['remove_2']) ? $_POST['remove_2'] : null;
			$remove_3 = isset($_POST['remove_3']) ? $_POST['remove_3'] : null;
			
			$removables = array(
				$remove_1,
				$remove_2,
				$remove_3
			);
			
			$this->model->deleteImgFiles($uniqid, $removables);
			
			$img_name[0] = isset($_FILES["img_file1"]) ? $this->checkImgFile($_FILES["img_file1"], $uniqid."_1") : null;
			$img_name[1] = isset($_FILES["img_file2"]) ? $this->checkImgFile($_FILES["img_file2"], $uniqid."_2") : null;
			$img_name[2] = isset($_FILES["img_file3"]) ? $this->checkImgFile($_FILES["img_file3"], $uniqid."_3") : null;
			
			$header = $_POST['header'];
			$content = $_POST['content'];
			
			$this->model->saveProduct($uniqid, $header, $content, null, $id);
			
			header("Location: index.php?p=products&action=view&id={$id}");
			return true;
		}
		
		$header = $_POST["header"];
		$content = $_POST["content"];
				
		$uniqid = date("U");
		$date = date("U");
		
		$img_name[0] = $this->checkImgFile($_FILES["img_file1"], $uniqid."_1");
		$img_name[1] = $this->checkImgFile($_FILES["img_file2"], $uniqid."_2");
		$img_name[2] = $this->checkImgFile($_FILES["img_file3"], $uniqid."_3");
		
		$this->model->saveProduct($uniqid, $header, $content, $date);
		header("Location: index.php?p=products&action=view&id={$this->model->latestId}");
	}
	
	public function confirmDelete($id) {
		$this->view->data["id"] = $id;
		$this->view->render("products/deleteConfirm");
	}
	
	public function delete($id) {
		if ($this->model->delete($id)) {
			header("Location: index.php?p=products");
		} else {
			die("FUCK!");
		}
	}
	
	private function checkImgFile($img_file, $name) {
		if (isset($img_file) && $img_file["size"] > 0) {
			return $this->uploadImage($img_file, $name);
		} else {
			return false;
		}
	}
	
	// maybe this method should be inside Model?
	private function uploadImage($img, $name) {
		$target_dir = "uploads/products/";
		// $target_file = $target_dir . basename($img["name"]);
		$temp = explode(".", $img["name"]);
		$new_filename = $name .".". end($temp);
		$target_file = $target_dir . $new_filename;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		/*
		if(isset($_POST["submit"])) {
		    $check = getimagesize($img["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        return false;
		        $uploadOk = 0;
		    }
		}
		*/
		// Check file size
		if ($img["size"] > 500000) {
		    return false;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    return false;
		}
		if (move_uploaded_file($img["tmp_name"], $target_file)) {
			return $new_filename;
		} else {
			return false;
		}
	}
}