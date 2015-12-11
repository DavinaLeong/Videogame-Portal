<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: ShiYun
 * Date: 10/11/2015
 * Time: 6:53 PM
 */
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
