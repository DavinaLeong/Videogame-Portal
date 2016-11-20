<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Game_genre.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Game_genre extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Game_genre_model");
    }

    public function index()
    {
        redirect("/admin/game_genre/browse_game_genre");
    }

    public function new_game_genre()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_form_validation_rules_new_game_genre();

            if($this->form_validation->run())
            {
                if($genre_id = $this->Game_genre_model->insert($this->_prepare_add_game_genre()) )
                {
                    $this->User_log_model->_set_common_message("create", "Game Genre", "genre_id", $genre_id);
                    redirect("admin/game_genre/browse_game_genre");
                }
                else
                {
                    $this->common_functions->_set_common_message("create failed", "Game Genre", "genre_id", $genre_id);
                }
            }

            $this->load->view("admin/game_genre/new_game_genre_page");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function browse_game_genre()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->session->unset_userdata("logo_upload_errors");

            $data = array(
                "game_genres" => $this->Game_genre_model->get_all(),
                "total_entries" => $this->Game_genre_model->count_all()
            );

            $this->load->view("admin/game_genre/browse_game_genre_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function edit_game_genre($genre_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $game_genre = $this->Game_genre_model->get_by_id($genre_id);
            $this->_form_validation_rules_edit_game_genre();

            if($this->form_validation->run())
            {
                if($this->Game_genre_model->update($this->_prepare_edit_game_genre($game_genre)))
                {
                    $this->User_log_model->_set_common_message("edit", "Game Genre", "genre_id", $genre_id);
                    redirect("admin/game_genre/browse_game_genre");
                }
                else
                {
                    $this->User_log_model->_set_common_message("edit failed", "Game Genre", "genre_id", $genre_id);
                }
            }

            $data = array(
                "game_genre" => $game_genre
            );

            $this->load->view("admin/game_genre/edit_game_genre_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function delete_game_genre($genre_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            if($this->Game_genre_model->delete_by_id($genre_id))
            {
                $this->User_log_model->_set_common_message("delete", "Game Genre", "genre_id", $genre_id);
            }
            else
            {
                $this->User_log_model->_set_common_message("delete failed", "Game Genre", "genre_id", $genre_id);
            }
            redirect("admin/game_genre/browse_game_genre");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    private function _prepare_add_game_genre()
    {
        $game_genre["genre_name"] = $this->input->post("genre_name");
        $game_genre["genre_abbr"] = $this->input->post("genre_abbr");
        if($this->input->post("genre_label_col"))
        {
            $game_genre["genre_label_col"] = $this->input->post("genre_label_col");
        }
        else
        {
            $game_genre["genre_label_col"] = "5BC0DE";
        }
        return $game_genre;
    }

    private function _form_validation_rules_new_game_genre()
    {
        $this->form_validation->set_rules("genre_name", "Game Genre Name", "trim|required|max_length[32]");
        $this->form_validation->set_rules("genre_abbr", "Game Genre Abbr", "trim|required|max_length[32]");
        $this->form_validation->set_rules("genre_label_col", "Label Color", "trim|max_length[7]callback_validate_hex_col");
    }

    private function _prepare_edit_game_genre($game_genre)
    {
        $game_genre["genre_name"] = $this->input->post("genre_name");
        $game_genre["genre_abbr"] = $this->input->post("genre_abbr");
        if($this->input->post("genre_label_col"))
        {
            $game_genre["genre_label_col"] = $this->input->post("genre_label_col");
        }
        else
        {
            $game_genre["genre_label_col"] = "5BC0DE";
        }
        return $game_genre;
    }

    private function _form_validation_rules_edit_game_genre()
    {
        $this->form_validation->set_rules("genre_name", "Game Genre Name", "trim|required|max_length[32]");
        $this->form_validation->set_rules("genre_abbr", "Game Genre Abbr", "trim|required|max_length[32]");
        $this->form_validation->set_rules("genre_label_col", "Label Color", "trim|max_length[7]callback_validate_hex_col");
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

} //end Game_genre controller class
