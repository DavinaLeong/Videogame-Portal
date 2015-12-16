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
        $this->load->model("User_model");
        $this->load->model("User_log_model");
    }

    public function index()
    {
        redirect("admin/user/load_page/add_user");
    }

    public function add_user()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_add_user_set_form_validation_rules();

            if($this->form_validation->run())
            {
                if($uid = $this->User_model->insert($this->_prepare_add_user() ))
                {
                    $this->session->set_userdata("message", "New user record added.");
                    $this->User_log_model->log_message("New user recorded added |  uid: " . $uid);
                    //TODO: redirect to browse users
                    redirect("admin/user/browse_user");
                }
                else
                {
                    $this->session->set_userdata("message", "Unable to add new user record.");
                    $this->User_log_model->log_message("Unable to add new user record.");
                }
            }

            $this->load->view("admin/user/add_user_page");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function browse_user($offset=0)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->load->library("Pagination");
            $this->load->library("Pagination_helper");

            $per_page = 20;
            $data = array(
                "users" => $this->User_model->get_all_limit_offset($per_page, $offset),
                "per_page" => $per_page,
                "offset" => $offset,
                "total_rows" => $this->User_model->count_all()
            );

            $this->load->view("admin/user/browse_user_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function view_user($uid=0)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "user" => $this->User_model->get_by_uid($uid)
            );
            $this->load->view("admin/user/view_user_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function edit_user($uid)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $user = $this->User_model->get_by_uid($uid);
            $this->_edit_user_set_form_validation_rules();

            if($this->form_validation->run())
            {
                if($uid = $this->User_model->update($this->_prepare_edit_user($user) ))
                {
                    $this->session->set_userdata("message", "User record updated successfully.");
                    $this->User_log_model->log_message("User record updated successfully. | uid: " . $uid);
                    redirect("admin/user/browse_user");
                }
                else
                {
                    $this->session->set_userdata("message", "An error has occured. Unable to update user record.");
                    $this->User_log_model->log_message("Unable to update user record. | uid: " . $uid);
                }
            }

            $data = array(
                "user" => $user
            );
            $this->load->view("admin/user/edit_user_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    private function _add_user_set_form_validation_rules()
    {
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("username", "Username", "trim|required|alpha_dash|is_unique[user.username]");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]|min_length[8]");
        $this->form_validation->set_rules("status", "Status", "required|in_list[Active,Not Active]");
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

    private function _edit_user_set_form_validation_rules()
    {
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("username", "Username", "trim|required|alpha_dash|is_unique[user.username]");
        $this->form_validation->set_rules("status", "Status", "required|in_list[Active,Not Active]");
    }

    private function _prepare_edit_user($user)
    {
        $user["name"] = $this->input->post("name");
        $user["username"] = $this->input->post("username");
        $user["status"] = $this->input->post("status");
        $user["access"] = $this->input->post("access");
        return $user;
    }

} //end User class
