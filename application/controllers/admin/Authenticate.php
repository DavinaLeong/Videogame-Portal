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
        $this->load->model("User_log_model");
    }

    public function index()
    {
        if($this->session->userdata("id") || $this->session->userdata("access"))
        {
            $this->session->unset_userdata("uid");
            $this->session->unset_userdata("access");
            redirect("/admin/authenticate/start");
        }
        else
        {
            redirect("/admin/authenticate/login");
        }
    }

    public function login()
    {
        // Check if there is an existing session
        if($this->session->userdata("uid") || $this->session->userdata("access"))
        {
            $this->Common_functions->log_message($this->session->userdata("uid"), "has been logged out.");
            $this->session->unset_userdata("uid");
            $this->session->unset_userdata("access");
            $this->session->set_userdata("message", "Session has expired and you've been logged out.");
        }

        // Handle Login form
        $this->_handle_login_form();
    }

    public function start()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->load->view("admin/start_page");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("admin/authenticate/login");
        }
    }

    private function _handle_login_form()
    {
        $this->_set_login_validation_rules();
        if($this->form_validation->run())
        {
            $this->load->model("User_model");
            if($user = $this->User_model->get_by_username($this->input->post("username")))
            {
                if($user["status"] == "Active")
                {
                    if(password_verify($this->input->post("password"), $user["password_hash"]))
                    {
                        $this->session->set_userdata("uid", $user["uid"]);
                        $this->session->set_userdata("access", $user["access"]);
                        $this->User_log_model->log_message($user["uid"], " has logged in.");

                        redirect("admin/authenticate/start", "refresh");
                    }
                    else
                    {
                        $this->session->set_userdata("message", "Username and password do not match");
                        $this->load->view("admin/authenticate/login_page");
                    }
                }
                else
                {
                    $this->session->set_userdata("message", "This account has been deactivated");
                    $this->load->view("admin/authenticate/login_page");
                }
            }
            else
            {
                $this->session->set_userdata("message", "Username does not exist.");
                $this->load->view("admin/authenticate/login_page");
            }
        }
        else
        {
            $this->load->view("admin/authenticate/login_page");
        }
    }

    private function _set_login_validation_rules()
    {
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
    }

} //end class Authenticate
