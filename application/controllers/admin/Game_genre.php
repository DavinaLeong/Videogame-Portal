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
 * @property Game_genre_model $Game_genre_model
 * @property Upload_helper $upload_helper
 */

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
                    $this->User_log_model->log_message("New Game Genre CREATED successfully. | genre_id: " . $genre_id);
                    $this->session->set_userdata("message" , "New Game Genre <mark>created</mark> successfully.");
                    redirect("admin/game_genre/browse_game_genre");
                }
                else
                {
                    $this->User_log_model->log_message("<mark>Unable</mark> to create new Game Genre.");
                    $this->session->set_userdata("message" , "Unable to CREATE new Game Genre");
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
                    $this->session->set_userdata("message", "Game Genre <mark>updated</mark> successfully.");
                    $this->User_log_model->log_message("Game Genre UPDATED successfully. | genre_id: " . $genre_id);
                    redirect("admin/game_genre/browse_game_genre");
                }
                else
                {
                    $this->session->set_userdata("message", "<mark>Unable</mark> to update Game Genre.");
                    $this->User_log_model->log_message("Unable to UPDATE Game Genre record. | genre_id: " . $genre_id);
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
                $this->session->set_userdata("message", "Game Genre <mark>deleted</mark> successfully.");
                $this->User_log_model->log_message("Game Genre DELETED successfully. | genre_id: " . $genre_id);
                redirect("admin/game_genre/browse_game_genre");
            }
            else
            {
                $this->session->set_userdata("message", "<mark>Unable</mark> to delete Game Genre.");
                $this->User_log_model->log_message("Unable to DELETE Game Genre record. | genre_id: " . $genre_id);
            }
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
        return $game_genre;
    }

    private function _form_validation_rules_new_game_genre()
    {
        $this->form_validation->set_rules("genre_name", "Game Genre Name", "trim|required|max_length[32]");
        $this->form_validation->set_rules("genre_abbr", "Game Genre Abbr", "trim|required|max_length[32]");
    }

    private function _prepare_edit_game_genre($game_genre)
    {
        $game_genre["genre_name"] = $this->input->post("genre_name");
        $game_genre["genre_abbr"] = $this->input->post("genre_abbr");
        return $game_genre;
    }

    private function _form_validation_rules_edit_game_genre()
    {
        $this->form_validation->set_rules("genre_name", "Game Genre Name", "trim|required|max_length[32]");
        $this->form_validation->set_rules("genre_abbr", "Game Genre Abbr", "trim|required|max_length[32]");
    }
    
} //end Game_genre controller class