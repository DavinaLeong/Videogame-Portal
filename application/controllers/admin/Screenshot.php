<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Screenshot.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
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
                $this->User_log_model->_set_common_message("create", "Screenshot", "ssid", $ss_id);
                redirect("admin/screenshot/edit_screenshot/" . $ss_id);
            }
            else
            {
                $this->User_log_model->_set_common_message("create failed", "Screenshot");
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
        $screenshot["ss_type_id"] = 2;
        $screenshot["ss_width"] = 854;
        $screenshot["ss_height"] = 480;
        $screenshot["ss_img_type"] = "image/png";
        $screenshot["ss_thumb_url"] = "screenshots/thumbnails/default_thumbnail.png";
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

    public function edit_screenshot($ss_id)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->session->set_userdata("ss_id", $ss_id);
            $screenshot = $this->Screenshot_model->get_by_id($ss_id);
            $this->_set_validation_rules_edit_screenshot();

            if($this->form_validation->run())
            {
                if($this->Screenshot_model->update($this->_prepare_edit_screenshot($screenshot)))
                {
                    $this->User_log_model->_set_common_message("update", "Screenshot", "ssid", $ss_id);
                    //redirect("admin/videogame/view_videogame/" . $screenshot["vg_id"]);
                    redirect("admin/screenshot/browse_screenshot");
                }
                else
                {
                    $this->User_log_model->_set_common_message("update failed", "Screenshot", "ssid", $ss_id);
                }
            }

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

    private function _set_validation_rules_edit_screenshot()
    {
        $vg_ids = $this->Videogame_model->get_all_ids();
        $ss_type_ids = $this->Screenshot_type_model->get_all_ids();

        $str_vg_ids = implode(",", $vg_ids);
        $str_ss_type_ids = implode(",", $ss_type_ids);

        $this->form_validation->set_rules("ss_name", "Name", "trim|required|max_length[512]");
        $this->form_validation->set_rules("ss_description", "Description", "trim|max_length[512]");
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

    public function upload_screenshot()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->load->library("upload_helper");

            $screenshot = $this->Screenshot_model->get_by_id($this->session->userdata("ss_id"));
            $screenshot_type = $this->Screenshot_type_model->get_by_id($screenshot["ss_type_id"]);

            // File name:
            // vg<vg_id>_ss<ss_id>_<ss_type_name>
            $upload_config = $this->upload_helper->upload_config_images(
            "vg".$screenshot["vg_id"]."_ss".$screenshot["ss_id"]."_".implode("", explode(" ", strtolower($screenshot_type["ss_type_name"]))),
            "./uploads/screenshots/",
            1024, 1024);
            $this->load->library("upload", $upload_config);

            if ($this->upload->do_upload("ss_url"))
            {
                //Get new uploaded file data
                $file_upload_data = $this->upload->data();

                //If a url exists, delete file of url
                if ($screenshot["ss_url"])
                {
                    $this->load->helper("file");
                    delete_files("./uploads/screenshots/" . $screenshot["ss_url"]);
                }

                //Update database with new image url
                $screenshot["ss_url"] = "screenshots/" . $file_upload_data["file_name"];
                $screenshot["ss_width"] = $file_upload_data["image_width"];
                $screenshot["ss_height"] = $file_upload_data["image_height"];
                $screenshot["ss_img_type"] = $file_upload_data["file_type"];

                $this->Screenshot_model->update_screenshot_image($screenshot);

                $this->session->set_userdata("message", "Screenshot <mark>uploaded</mark> successfully.");
                $this->User_log_model->log_message("Screenshot UPLOADED sucessfully. | ss_id: " . $this->session->userdata("ss_id"));
                $this->session->unset_userdata("avatar_upload_errors");
            }
            else
            {
                $this->session->set_userdata("message", "<mark>Unable</mark> to upload screenshot.");
                $this->User_log_model->log_message("Unable to UPLOAD screenshot. | ss_id: " . $this->session->userdata("ss_id"));
                $this->session->set_userdata("ss_upload_errors", $this->upload->display_errors());
            }

            redirect("/admin/screenshot/edit_screenshot/" . $this->session->userdata("ss_id"));
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function view_screenshot($ss_id)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "screenshot" => $this->Screenshot_model->get_by_id_videogames_screenshotTypes($ss_id)
            );

            $this->load->view("admin/screenshot/view_screenshot_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function delete_screenshot($ss_id)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            if($this->Screenshot_model->delete_by_id($ss_id))
            {
                $this->session->set_userdata("message", "Screenshot <mark>deleted</mark>.");
                $this->User_log_model->log_message("Screenshot DELETED. | ss_id: " . $ss_id);
            }
            else
            {
                $this->session->set_userdata("message", "<mark>Unable</mark> to delete Screenshot.");
                $this->User_log_model->log_message("Unable to DELETE Screenshot. | ss_id: " . $ss_id);
            }

            redirect("admin/screenshot/browse_screenshot");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

} //end Screenshot controller class
