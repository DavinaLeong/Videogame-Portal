<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Common_functions.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/
class Common_functions
{
    public function log_message($uid, $message="")
    {
        $this->load->model("User_model");
        $this->load->model("User_log_model");

        $user = $this->User_model->get_by_uid($uid);
        $this->User_log_model->log_message("User | " . $user["uid"] . " | " .  $user["username"] . " " . $message);
    }
} //end Common_functions class
