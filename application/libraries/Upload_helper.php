<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Upload_helper.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 3rd Dec 2015

		Email	        : davina_leong.@theshipyard.sg

	All content © The Shipyard Private Limited. All Rights Reserved.
***********************************************************************************/
class Upload_helper
{
    public function upload_config($upload_path="", $allowed_types="", $max_size=2048,
                                           $min_width=50,
                                           $min_height=50, $remove_spaces=FALSE)
    {
        $config["upload_path"] = $upload_path;
        $config["allowed_types"] = $allowed_types;
        $config["max_size"] = $max_size; // in KB
        $config["min_width"] = $min_width;
        $config["min_height"] = $min_height;
        $config["max_width"] = 1024;
        $config["max_height"] = 1024;
        $config["remove_spaces"] = $remove_spaces;
        $config["file_ext_tolower"] = TRUE;
        $config["overwrite"] = TRUE;

        return $config;
    }

    public function upload_config_filename($file_name="", $upload_path="", $allowed_types="", $max_size=2048)
    {
        $config["file_name"] = $file_name;
        $config["upload_path"] = $upload_path;
        $config["allowed_types"] = $allowed_types;
        $config["max_size"] = $max_size; // in KB
        $config["max_width"] = 200;
        $config["max_height"] = 200;
        $config["remove_spaces"] = TRUE;
        $config["file_ext_tolower"] = TRUE;
        $config["overwrite"] = TRUE;

        return $config;
    }

    public function upload_config_images(
        $file_name="", $upload_path="",
        $max_width=2048, $max_height=2048,
        $remove_spaces = TRUE, $overwrite = FALSE,
        $min_width = 50, $min_height = 50
    )
    {
        $config["file_name"] = $file_name;
        $config["upload_path"] = $upload_path;
        $config["max_width"] = $max_width;
        $config["max_height"] = $max_height;
        $config["remove_spaces"] = $remove_spaces;
        $config["overwrite"] = $overwrite;
        $config["min_width"] = $min_width;
        $config["min_width"] = $min_height;

        return $config
    }

}//end class upload_helper
