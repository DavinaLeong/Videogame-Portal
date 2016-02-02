<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Screenshot.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content © DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Screenshot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Screenshot_model");
        $this->load->model("Screenshot_type_model");
        $this->load->model("Videogame_model");
    }

    public function index()
    {
        redirect("/admin/screenshot/browse_screenshot");
    }

    public function new_screenshot()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            if($ss_id = $this->Screenshot_model->insert($this->_prepare_add_screenshot()))
            {
                $this->session->set_userdata("message", "New Screenshot recored <mark>created</mark>.");
                $this->User_log_model->log_message("New Screenshot recored CREATED. | ss_id: " . $ss_id);
                redirect("admin/screenshot/edit_screenshot/" . $ss_id);
            }
            else
            {
                $this->session->set_userdata("message", "<mark>Unable</mark> to create new Screenshot record.");
                $this->User_log_model->log_message("Unable to CREATE new Screenshot record.");
                redirect("admin/screenshot/browse_screenshot");
            }
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    private function _prepare_add_screenshot()
    {
        $screenshot = array();
        $screenshot["ss_name"] = "Screenshot Name";
        $screenshot["vg_id"] = 1;
        $screenshot["ss_url"] = "screenshots/default_screenshot.png";
        $screenshot["ss_description"] = "";
        $screenshot["ss_type_id"] = 1;
        $screenshot["ss_width"] = 854;
        $screenshot["ss_height"] = 480;
        $screenshot["ss_img_type"] = "image/png";
        $screenshot["ss_thumb_url"] = "screenshots/default_thumbnail.png";
        $screenshot["ss_thumb_width"] = 150;
        $screenshot["ss_thumb_height"] = 84;
        $screenshot["ss_thumb_img_type"] = "image/png";
        return $screenshot;
    }

    public function browse_screenshot()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "screenshots" => $this->Screenshot_model->get_all_videogames_screenshotTypes()
            );

            $this->load->view("admin/screenshot/browse_screenshot_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function view_screenshot()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            show_error("view_screenshot not implemented");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function edit_screenshot($ss_id)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $screenshot = $this->Screenshot_model->get_by_id($ss_id);
            $this->_set_validation_rules_edit_screenshot();

            // TODO: update db

            $data = array(
                "screenshot" => $screenshot,
                "screenshot_types" => $this->Screenshot_type_model->get_all(),
                "videogames" => $this->Videogame_model->get_all()
            );

            $this->load->view("admin/screenshot/edit_screenshot_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function upload_screenshot()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->load->library("upload_helper");

            $screenshot = $this->User_model->get_by_id($this->session->userdata("edit_uid"));

            // Davina: upload_helper is a custom library
            $upload_config = $this->upload_helper->upload_config_filename(strtolower($screenshot
                ["username"] . "_avatar"), "./uploads/admin_avatar/", "gif|jpg|png");
            $this->load->library("upload", $upload_config);

            if ($this->upload->do_upload("avatar_url"))
            {
                //Get new uploaded file data
                $file_upload_data = $this->upload->data();

                //If a url exists, delete file of url
                if ($screenshot["avatar_url"])
                {
                    $this->load->helper("file");
                    delete_files("./uploads/admin_avatar/" . $screenshot["avatar_url"]);
                }

                //Update database with new image url
                $screenshot["avatar_url"] = "admin_avatar/" . $file_upload_data["file_name"];
                $this->User_model->update($screenshot);

                //If the edit uid matches the logged in user's id, update the session's
                // avatar url.
                if($this->session->userdata("uid") == $this->session->userdata("edit_uid"))
                {
                    $this->session->set_userdata($screenshot["avatar_url"]);
                }

                $this->session->set_userdata("message", "Avatar uploaded successfully.");
                $this->User_log_model->log_message("Avatar uploaded sucessfully. | uid: " . $this->session->userdata("edit_uid"));
                $this->session->unset_userdata("avatar_upload_errors");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    private function _set_validation_rules_edit_screenshot()
    {
        $vg_ids = $this->Videogame_model->get_all_ids();
        $ss_type_ids = $this->Screenshot_type_model->get_all_ids();

        $str_vg_ids = implode(",", $vg_ids);
        $str_ss_type_ids = implode(",", $ss_type_ids);

        $this->form_validation->set_rules("ss_name", "Name", "trim|required|max_length[128]");
        $this->form_validation->set_rules("ss_description", "Description", "trim|max_length[256]");
        $this->form_validation->set_rules("vg_id", "Videogame", "in_list[". $str_vg_ids . "]");
        $this->form_validation->set_rules("ss_type_id", "Type", "in_list[" . $str_ss_type_ids . "]");
    }

    private function _prepare_edit_screenshot($screenshot)
    {
        $screenshot["ss_name"] = $this->input->post("ss_name");
        $screenshot["vg_id"] = $this->input->post("vg_id");
        $screenshot["ss_description"] = $this->input->post("ss_description");
        $screenshot["ss_type_id"] = $this->input->post("ss_type_id");
        return $screenshot;
    }

    public function delete_screenshot()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            show_error("delete_screenshot not implemented");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

} //end Screenshot controller class