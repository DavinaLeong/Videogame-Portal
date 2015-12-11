<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Authenticate.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/

class Authenticate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }

    public function login()
    {
        $this->load->view("admin/authenticate/login_page");
    }

} //end class Authenticate
