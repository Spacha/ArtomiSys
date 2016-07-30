<?php

Class Image extends Products
{
    private $uniqid;
    private $target_dir = "uploads/products/";
    
    public function __construct($uniqid)
    {
        $this->uniqid = $uniqid;
    }
    
    public function upload(array $images)
    {   
        $i = 1;
        
        foreach($images as $image) {
            $file_parts = explode(".", $image['name']);
            $imageFileType = pathinfo($image['name'], PATHINFO_EXTENSION);
            $target_file = $this->target_dir . $this->uniqid . "_" . $i . end($file_parts);
            
            if (!move_uploaded_file($image['tmp_name'], $target_file)) {
                return false;
            }
            
            $i++;
        }
    }
    
    public function fecthImages()
    {
        
    }
}