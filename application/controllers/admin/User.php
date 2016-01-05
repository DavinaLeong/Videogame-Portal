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
 * @property Upload_helper $upload_helper
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
    }

    public function index()
    {
        redirect("admin/user/load_page/browse_user");
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
                    $this->session->set_userdata("message", "New User Record <mark>added</mark>.");
                    $this->User_log_model->log_message("New User Record ADDED |  uid: " . $uid);
                    $this->session->set_userdata("message", "Upload a <mark>Personal Avatar</mark>, or click \"Back\" to cancel.");
                    redirect("admin/user/edit_user/" . $uid);
                }
                else
                {
                    $this->session->set_userdata("message", "Unable to ADD new User Record.");
                    $this->User_log_model->log_message("<mark>Unable</mark> to add new User Record.");
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

    public function browse_user()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->session->unset_userdata("avatar_upload_errors");

            $data = array(
                "users" => $this->User_model->get_all(),
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
                "user" => $this->User_model->get_by_id($uid)
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
            $this->session->set_userdata("edit_uid", $uid);
            $user = $this->User_model->get_by_id($uid);
            $this->_edit_user_set_form_validation_rules();

            if($this->form_validation->run())
            {
                if($uid = $this->User_model->update($this->_prepare_edit_user($user) ) ||
                    $this->session->userdata("avatar_upload_errors") == "")
                {
                    $this->session->set_userdata("message", "User record <mark>updated</mark> successfully.");
                    $this->User_log_model->log_message("User record UPDATED successfully. | uid: " . $uid);
                    redirect("admin/user/view_user/" . $uid);
                }
                else
                {
                    $this->session->set_userdata("message", "An error has occured. <mark class='highlight-red'>Unable</mark> to update User record.");
                    $this->User_log_model->log_message("<mark class='highlight-red'>Unable</mark> to UPDATE user record. | uid: " . $uid);
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

    public function upload_image()
    {
        $this->load->library("upload_helper");

        $user = $this->User_model->get_by_id($this->session->userdata("edit_uid"));

        // Davina: upload_helper is a custom library
        $upload_config = $this->upload_helper->upload_config_filename(strtolower($user
            ["username"] . "_avatar"), "./uploads/admin_avatar/", "gif|jpg|png");
        $this->load->library("upload", $upload_config);

        if ($this->upload->do_upload("avatar_url"))
        {
            //Get new uploaded file data
            $file_upload_data = $this->upload->data();

            //If a url exists, delete file of url
            if ($user["avatar_url"])
            {
                $this->load->helper("file");
                delete_files("./uploads/admin_avatar/" . $user["avatar_url"]);
            }

            //Update database with new image url
            $user["avatar_url"] = "admin_avatar/" . $file_upload_data["file_name"];
            $this->User_model->update($user);

            //If the edit uid matches the logged in user's id, update the session's
            // avatar url.
            if($this->session->userdata("uid") == $this->session->userdata("edit_uid"))
            {
                $this->session->set_userdata($user["avatar_url"]);
            }

            $this->session->set_userdata("message", "Avatar uploaded successfully.");
            $this->User_log_model->log_message("Avatar uploaded sucessfully. | uid: " . $this->session->userdata("edit_uid"));
            $this->session->unset_userdata("avatar_upload_errors");
        }
        else
        {
            $this->session->set_userdata("message", "Unable to upload image.");
            $this->User_log_model->log_message("Unable to upload image. | uid: " . $this->session->userdata("edit_uid"));
            $this->session->set_userdata("avatar_upload_errors", $this->upload->display_errors());
        }

        redirect("/admin/user/edit_user/" . $this->session->userdata("edit_uid"));
    }

    private function _add_user_set_form_validation_rules()
    {
        $this->form_validation->set_rules("name", "Name", "trim|required|max_length[512]");
        $this->form_validation->set_rules("username", "Username", "trim|required|max_length[512]|alpha_dash|is_unique[user.username]");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]|min_length[8]");
        $this->form_validation->set_rules("status", "Account Status", "in_list[Active,Not Active]");
        $this->form_validation->set_rules("access", "Access Rights", "in_list[A,M,U]");
    }

    private function _prepare_add_user()
    {
        $user["name"] = $this->input->post("name");
        $user["username"] = $this->input->post("username");
        $user["password_hash"] = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
        $user["status"] = $this->input->post("status");
        $user["access"] = $this->input->post("access");
        $user["avatar_url"] = "admin_avatar/default_avatar.png";
        return $user;
    }

    private function _edit_user_set_form_validation_rules()
    {
        $this->form_validation->set_rules("name", "Name", "trim|max_length[512]|required");
        $this->form_validation->set_rules("username", "Username", "trim|max_length[512]|required|alpha_dash");
        $this->form_validation->set_rules("status", "Account Status", "in_list[Active,Not Active]");
        $this->form_validation->set_rules("access", "Access Rights", "in_list[A,M,U]");
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