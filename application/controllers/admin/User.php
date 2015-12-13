<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: User.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_log_model");
    }

    public function index()
    {
        redirect("admin/user/browse_users");
    }

    public function new_user()
    {
        
    }

} //end User class
