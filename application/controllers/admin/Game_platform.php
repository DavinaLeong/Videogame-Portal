<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Game_platform.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Game_platform extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Game_platform_model");
    }

    public function index()
    {
        redirect("/admin/game_platform/browse_game_platform");
    }

    public function new_game_platform()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_add_game_platform_validation_rules();

            if($this->form_validation->run())
            {
                if($platform_id = $this->Game_platform_model->insert($this->_prepare_add_game_platform()))
                {
                    $this->session->set_userdata("message", 'New Game Platform record <mark>created</mark> successfully.<br>Either upload a platform logo or click <mark><i class="fa fa-ban"></i> Cancel</mark> to finish.');
                    $this->User_log_model->log_message("Game Platform reeord CREATED successfully. | platform_id: " . $platform_id);
                    redirect("admin/game_platform/edit_game_platform/" . $platform_id);
                }
                else
                {
                    $this->User_log_model->_set_common_message("create failed", "Game Platform");
                }
            }

            $data = array(
                "total_entries" => $this->Game_platform_model->count_all()
            );

            $this->load->view("admin/game_platform/new_game_platform_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function browse_game_platform($use_react=false)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->session->unset_userdata("logo_upload_errors");

            $data = array(
                "game_platforms" => $this->Game_platform_model->get_all(),
                "total_entries" => $this->Game_platform_model->count_all()
            );

            $this->load->view("admin/game_platform/browse_game_platform_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function delete_game_platform($platform_id)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            if($this->Game_platform_model->delete_by_id($platform_id))
            {
                $this->User_log_model->_set_common_message("delete_by_id", "Game Platform", "platform_id", $platform_id);
            }
            else
            {
                $this->User_log_model->_set_common_message("delete failed", "Game Platform", "platform_id", $platform_id);
            }

            redirect("admin/game_platform/browse_game_platform");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function view_game_platform($platform_id)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "game_platform" => $this->Game_platform_model->get_by_id($platform_id)
            );
            $this->load->view("admin/game_platform/view_game_platform_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function edit_game_platform($platform_id=0)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->session->set_userdata("platform_id", $platform_id);
            $game_platform = $this->Game_platform_model->get_by_id($platform_id);
            $this->_edit_game_platform_validation_rules();

            if($this->form_validation->run())
            {
                if($this->Game_platform_model->update($this->_prepare_edit_game_platform($game_platform) ) ||
                    $this->session->userdata("logo_upload_errors") == "")
                {
                    $this->User_log_model->_set_common_message("update", "Game Platform", "platform_id", $platform_id);
                    redirect("admin/game_platform/view_game_platform/" . $platform_id);
                }
                else
                {
                    $this->User_log_model->_set_common_message("update failed", "Game Platform", "platform_id", $platform_id);
                }
            }

            $data = array(
                "game_platform" => $game_platform
            );
            $this->load->view("admin/game_platform/edit_game_platform_page", $data);
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

        $platform = $this->Game_platform_model->get_by_id($this->session->userdata("platform_id"));

        $upload_config = $this->upload_helper->upload_config_filename(strtolower($platform
            ["platform_abbr"] . "_logo"), "./uploads/platform_logo/", "gif|jpg|jpeg|png|bmp");
        $this->load->library("upload", $upload_config);

        if ($this->upload->do_upload("platform_logo_url"))
        {
            //Get new uploaded file data
            $file_upload_data = $this->upload->data();

            //If a url exists, delete file of url
            if ($platform["logo_url"])
            {
                $this->load->helper("file");
                delete_files("./uploads/platform_logo/" . $platform["platform_logo_url"]);
            }

            //Update database with new image url
            $platform["platform_logo_url"] = "platform_logo/" . $file_upload_data["file_name"];
            $this->Game_platform_model->update_logo_url($platform);

            $this->session->set_userdata("message", "Logo <mark>uploaded</mark> successfully.");
            $this->User_log_model->log_message("Logo UPLOADED sucessfully. | platform_id: " . $this->session->userdata("platform_id"));
            $this->session->unset_userdata("logo_upload_errors");
        }
        else
        {
            $this->session->set_userdata("message", "Unable to upload logo.");
            $this->User_log_model->log_message("Unable to upload logo. | platform_id: " . $this->session->userdata("platform_id"));
            $this->session->set_userdata("logo_upload_errors", $this->upload->display_errors());
        }

        redirect("/admin/game_platform/edit_game_platform/" . $this->session->userdata("platform_id"));
    }

    private function _add_game_platform_validation_rules()
    {
        $this->form_validation->set_rules("platform_name", "Platform Name", "trim|required|max_length[64]");
        $this->form_validation->set_rules("year_intro", "Year Introduced", "trim|required|is_natural|max_length[4]");
        $this->form_validation->set_rules("platform_developer", "Developer", "trim|max_length[128]");
        $this->form_validation->set_rules("platform_abbr", "Abbreviation", "trim|required|alpha_numeric|max_length[16]");
        $this->form_validation->set_rules("platform_label_col", "Label Color", "trim|max_length[7]|callback_validate_hex_col");
    }

    private function _prepare_add_game_platform()
    {
        $game_platform["platform_name"] = $this->input->post("platform_name");
        $game_platform["year_intro"] = $this->input->post("year_intro");
        $game_platform["platform_developer"] = $this->input->post("platform_developer");
        $game_platform["platform_abbr"] = $this->input->post("platform_abbr");
        $game_platform["platform_logo_url"] = "platform_logo/default_logo.png";
        if($this->input->post("platform_label_col"))
        {
            $game_platform["platform_label_col"] = $this->input->post("platform_label_col");
        }
        else
        {
            $game_platform["platform_label_col"] = "#5CB85C";
        }
        return $game_platform;
    }

    private function _edit_game_platform_validation_rules()
    {
        $this->form_validation->set_rules("platform_name", "Platform Name", "trim|max_length[64]");
        $this->form_validation->set_rules("year_into", "Year Introduced", "trim|is_natural|max_length[4]");
        $this->form_validation->set_rules("platform_developer", "Developer", "trim|max_length[128]");
        $this->form_validation->set_rules("platform_abbr", "Abbreviation", "trim|alpha_numeric|max_length[16]");
        $this->form_validation->set_rules("platform_label_col", "Label Color", "trim|max_length[7]callback_validate_hex_col");
    }

    private function _prepare_edit_game_platform($game_platform)
    {
        $game_platform["platform_name"] = $this->input->post("platform_name");
        $game_platform["year_intro"] = $this->input->post("year_intro");
        $game_platform["platform_developer"] = $this->input->post("platform_developer");
        $game_platform["platform_abbr"] = $this->input->post("platform_abbr");
        if($this->input->post("platform_label_col"))
        {
            $game_platform["platform_label_col"] = $this->input->post("platform_label_col");
        }
        else
        {
            $game_platform["platform_label_col"] = "#5CB85C";
        }
        return $game_platform;
    }

    public function validate_hex_col($hex_col)
    {
        if(preg_match("/#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]", $hex_col))
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_rules("platform_label_col", "{field} is not a valid hexadecimal value.");
            return FALSE;
        }
    }

} //end Game_platform controller class
