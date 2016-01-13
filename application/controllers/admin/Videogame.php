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
 * @property Videogame_model $Videogame_model
 * @property Upload_helper $upload_helper
 * @property Game_genre_model $Game_genre_model
 * @property Game_platform_model $Game_platform_model
 *
 * @property Datetime_helper $datetime_helper
 */

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
        $this->form_validation->set_rules("genre_id", "Genre", "trim|required");
        $this->form_validation->set_rules("platform_id", "Platform", "trim|required");
        $this->form_validation->set_rules("date_purchased", "Date Purchased", "trim|required|callback_valid_date_check");
    }

    private function _prepare_new_videogame()
    {
        $vg["vg_name"] = $this->input->post("vg_name");
        $vg["genre_id"] = $this->input->post("genre_id");
        $vg["platform_id"] = $this->input->post("platform_id");
        $this->load->library("datetime_helper");
        $date = new DateTime($this->datetime_helper->format_date_str($this->input->post("date_purchased")), new DateTimeZone(DATETIMEZONE));
        $vg["date_purchased"] = $date->format("Y-m-d");

        return $vg;
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
        show_error("<b>edit_videogame</b> not implemented");
    }

    public function delete_videogame()
    {
        show_error("<b>delete_videogame</b> not implemented");
    }

    public function valid_date_check($str)
    {
        $this->load->library("datetime_helper");
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

} //end Videogame controller class
