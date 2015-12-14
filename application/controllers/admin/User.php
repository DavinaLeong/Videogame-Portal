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
        redirect("admin/user/load_page/add_user");
    }

    public function do_validate_access($page="")
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            switch($page)
            {
                case "add_user":
                    redirect("admin/user/add_user");
                    break;

                default:
                    show_404();
                    break;
            }
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function add_user()
    {
        $this->load->model("User_model");
        $this->load->library("form_validation");

        $this->_add_user_set_form_validation_rules();

        if($this->form_validation->run())
        {
            if($uid = $this->User_model->insert($this->_prepare_add_user() ))
            {
                $this->session->set_userdata("message", "New user record added.");
                $this->User_log_model->log_message("New user recorded added |  uid: " . $uid);
                //TODO: redirect to browse users
                $this->load->view("admin/start_page");
            }
            else
            {
                $this->session->set_userdata("message", "Unable to add new user record.");
            }
        }

        $this->load->view("admin/user/add_user_page");
    }

    private function _add_user_set_form_validation_rules()
    {
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("username", "Username", "trim|required|alpha_dash|is_unique[user.username]");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]|min_length[8]");
        $this->form_validation->set_rules("status", "Status", "required|in_list[Active,Not Active]");
        $this->form_validation->set_rules("access", "Access Rights", "required|in_list[A,U]");
    }

    private function _prepare_add_user()
    {
        $user["name"] = $this->input->post("name");
        $user["username"] = $this->input->post("username");
        $user["password_hash"] = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
        $user["status"] = $this->input->post("status");
        $user["access"] = $this->input->post("access");
        return $user;
    }

} //end User class
