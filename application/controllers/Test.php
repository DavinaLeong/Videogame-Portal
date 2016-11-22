<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Test.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12th Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/
class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect("test/test");
    }

    public function test()
    {
        $data = array(
            "header" => "Video Game Portal"
        );
        $this->load->view("templates/test_page", $data);
    }

} //end Test
