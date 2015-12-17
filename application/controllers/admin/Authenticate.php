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

/**
 * @property CI_DB_driver $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
 * @property User_log_model $User_log_model
 * @property User_model $User_model
 */

class Authenticate extends CI_Controller
{
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
            $this->User_log_model->log_message("User has been logged out. | uid: " . $this->session->userdata("uid"));
            $this->session->unset_userdata("uid");
            $this->session->unset_userdata("access");
            $this->session->unset_userdata("name");
            $this->session->unset_userdata("avatar_url");
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

    public function logout()
    {
        $this->session->set_userdata("message", "You've logged out.");
        $this->User_log_model->log_message("User has logged out. | uid: " . $this->session->userdata("uid"));
        redirect("/admin/authenticate/login");
    }

    public function change_password()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->load->model("User_model");
            $this->form_validation->set_rules("old_password", "Old Password", "required");
            $this->form_validation->set_rules("new_password", "New Password", "required|min_length[6]");
            $this->form_validation->set_rules("confirm_password", "Confirm New Password",
                "required|matches[new_password]|min_length[6]");

            $user = $this->User_model->get_by_id($this->session->userdata("uid"));

            if($this->form_validation->run())
            {
                $this->load->model("User_model");

                if(password_verify($this->input->post("old_password"), $user["password_hash"]))
                {
                    $user["password_hash"] = password_hash($this->input->post("new_password"), PASSWORD_DEFAULT);
                    if($this->User_model->update_password($user) )
                    {
                        $this->session->set_userdata("message", "Password changed successfully.");
                        $this->User_log_model->log_message("Password changed successfully.");
                        redirect("admin/user/view_user/" . $user["uid"]);
                    }
                    else
                    {
                        $this->session->set_userdata("message", "An error has occured. Please try a different password or contact the administrator.");
                        $this->User_log_model->log_message("ERR: An error has occured. Please try a different password or contact the administrator.");
                    }
                }
                else
                {
                    $this->session->set_userdata("message", "Old Password is incorrect.");
                }
            }

            $data = array(
                "user" => $user
            );
            $this->load->view("/admin/authenticate/change_password_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
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
                        $this->session->set_userdata("name", $user["name"]);
                        $this->session->set_userdata("avatar_url", $user["avatar_url"]);
                        $this->User_log_model->log_message("User has logged in. | uid: " . $user["uid"]);

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
