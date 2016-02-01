<?php defined("BASEPATH") OR exit("No direct script access allowed");
/**********************************************************************************
    - File Info -
        File name		: Videogame.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Videogame extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Videogame_model");
    }

    public function index()
    {
        redirect("/admin/videogame/browse_videogame");
    }

    public function new_videogame()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_new_videogame_validation_rules();
            if($this->form_validation->run())
            {
                if($vg_id = $this->Videogame_model->insert($this->_prepare_new_videogame()))
                {
                    $this->session->set_userdata("message", "New Videogame record <mark>added</mark>.");
                    $this->User_log_model->log_message("New Videogame record ADDED. | vg_id: " . $vg_id);
                    redirect("admin/videogame/browse_videogame");
                }
                else
                {
                    $this->session->set_userdata("message", "<mark>Unable</mark> to ADDED new Videogame record.");
                    $this->User_log_model->log_message("Unable to ADD new Videogame record.");
                }
            }

            $this->load->model("Game_genre_model");
            $this->load->model("Game_platform_model");

            $data = array(
                "game_genres" => $this->Game_genre_model->get_all(),
                "game_platforms" => $this->Game_platform_model->get_all()
            );

            $this->load->view("admin/videogame/new_videogame_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    private function _new_videogame_validation_rules()
    {
        $this->load->library("common_functions");
        $this->form_validation->set_rules("vg_name", "Name", "trim|required|max_length[64]");
        $this->form_validation->set_rules("vg_abbr", "Abbr", "trim|max_length[32]");
        $this->form_validation->set_rules("genre_id", "Genre", "trim");
        $this->form_validation->set_rules("platform_id", "Platform", "trim");
        $this->form_validation->set_rules("date_purchased", "Date Purchased", "trim|callback_valid_date_check");
    }

    private function _prepare_new_videogame()
    {
        $videogame["vg_name"] = $this->input->post("vg_name");
        $videogame["vg_abbr"] = strtoupper($this->input->post("vg_abbr"));
        $videogame["genre_id"] = $this->input->post("genre_id");
        $videogame["platform_id"] = $this->input->post("platform_id");
        $videogame["date_purchased"] = NULL;

        if($this->input->post("date_purchased"))
        {
            $this->load->library("datetime_helper");
            $date = new DateTime($this->datetime_helper->format_date_str($this->input->post("date_purchased")), new DateTimeZone(DATETIMEZONE));
            $videogame["date_purchased"] = $date->format("Y-m-d");
        }

        if($this->input->post(["from_steam"]))
        {
            $videogame["from_steam"] = 1;
        }
        else
        {
            $videogame["from_steam"] = 0;
        }

        return $videogame;
    }

    public function browse_videogame()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "videogames" => $this->Videogame_model->get_all_genre_platform(),
                "total_entries" => count($this->Videogame_model->get_all_genre_platform())
            );

            $this->load->view("admin/videogame/browse_videogame_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function view_videogame($vg_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "videogame" => $this->Videogame_model->get_by_id_genre_platform($vg_id)
            );
            $this->load->view("admin/videogame/view_videogame_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function edit_videogame($vg_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_edit_videogame_validation_rules();
            $videogame = $this->Videogame_model->get_by_id_genre_platform($vg_id);

            if($this->form_validation->run())
            {
                if($this->Videogame_model->update($this->_prepare_edit_videogame($videogame)))
                {
                    $this->session->set_userdata("message", "Videogame record <mark>updated</mark> successfully.");
                    $this->User_log_model->log_message("Videogame record UPDATED successfully. | vg_id: " . $vg_id);
                    redirect("admin/videogame/browse_videogame");
                }
                else
                {
                    $this->session->set_userdata("message", "<mark>Unable</mark> to update Videogame record.");
                    $this->User_log_model->log_message("Unable to UPDATE Videogame record. | vg_id: " . $vg_id);
                }
            }

            $this->load->model("Game_genre_model");
            $this->load->model("Game_platform_model");

            $data = array(
                "videogame" => $videogame,
                "game_genres" => $this->Game_genre_model->get_all(),
                "game_platforms" => $this->Game_platform_model->get_all()
            );

            $this->load->view("admin/videogame/edit_videogame_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    private function _edit_videogame_validation_rules()
    {
        $this->load->library("common_functions");
        $this->form_validation->set_rules("vg_name", "Name", "trim|required|max_length[64]");
        $this->form_validation->set_rules("vg_abbr", "Abbr", "trim|max_length[32]");
        $this->form_validation->set_rules("genre_id", "Genre", "trim");
        $this->form_validation->set_rules("platform_id", "Platform", "trim");
        $this->form_validation->set_rules("date_purchased", "Date Purchased", "trim|callback_valid_date_check");
    }

    private function _prepare_edit_videogame($videogame)
    {
        $videogame["vg_name"] = $this->input->post("vg_name");
        $videogame["vg_abbr"] = strtoupper($this->input->post("vg_abbr"));
        $videogame["genre_id"] = $this->input->post("genre_id");
        $videogame["platform_id"] = $this->input->post("platform_id");
        $videogame["date_purchased"] = NULL;

        if($this->input->post("date_purchased"))
        {
            $this->load->library("datetime_helper");
            $date = new DateTime($this->datetime_helper->format_date_str($this->input->post("date_purchased")), new DateTimeZone(DATETIMEZONE));
            $videogame["date_purchased"] = $date->format("Y-m-d");
        }

        if($this->input->post(["from_steam"]))
        {
            $videogame["from_steam"] = 1;
        }
        else
        {
            $videogame["from_steam"] = 0;
        }

        return $videogame;
    }

    public function delete_videogame($vg_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            if($this->Videogame_model->delete_by_id($vg_id))
            {
                $this->session->set_userdata("message", "Videogame record <mark>deleted</mark> successfully.");
                $this->User_log_model->log_message("Videogame record DELETED successfully. | vg_id: " . $vg_id);
            }
            else
            {
                $this->session->set_userdata("message", "<mark>Unaable</mark> to delete Videogame record.");
                $this->User_log_model->log_message("Unable to DELETE Videogame record. | vg_id: " . $vg_id);
            }

            redirect("admin/videogame/browse_videogame");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect("/admin/authenticate/login/");
        }
    }

    public function valid_date_check($str)
    {
        $this->load->library("datetime_helper");
        if($str)
        {
            if (preg_match("/\d{2}-\d{2}-\d{4}/", $str))
            {
                if ($datetime = new DateTime($this->datetime_helper->format_date_str($str), new DateTimeZone(DATETIMEZONE)))
                {
                    //show_error($datetime->format("d-m-Y"));
                    if ($datetime->format("d-m-Y") !== $str)
                    {
                        $this->form_validation->set_message("valid_date_check", "Invalid date.");
                        return FALSE;
                    }
                    else
                    {
                        return TRUE;
                    }
                }
                else
                {
                    $this->form_validation->set_message("valid_date_check", "Invalid date.");
                    return FALSE;
                }
            }
            else
            {
                $this->form_validation->set_message("valid_date_check", "Invalid date.");
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

} //end Videogame controller class
