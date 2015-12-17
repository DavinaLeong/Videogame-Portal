<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Game_platform.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

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
 * @property Game_platform_model $Game_platform_model
 * @property Upload_helper $upload_helper
 */

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

    public function add_game_platform()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_add_game_platform_validation_rules();

            if($this->form_validation->run())
            {

            }

            $this->load->view("admin/game_platform/new_game_platform_page");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function browse_game_platform()
    {
        show_error("browse_game_platform not implemented");
    }

    public function view_game_platform()
    {
        show_error("view_game_platform not implemented");
    }

    public function edit_game_platform()
    {
        show_error("edit_game_platform not implemented");
    }

    private function _add_game_platform_validation_rules()
    {
        $this->form_validation->set_rules("platform_name", "Platform Name", "trim|required|max_length[20]");
        $this->form_validation->set_rules("year_into", "Year Introduced", "trim|required|is_natural");
        $this->form_validation->set_rules("manufacturer", "Manufacturer Name", "trim|required|max_length[20]");
    }

    private function _edit_game_platform_validation_rules()
    {
        $this->form_validation->set_rules("platform_name", "Platform Name", "trim|required|max_length[20]");
        $this->form_validation->set_rules("year_into", "Year Introduced", "trim|required|is_natural");
        $this->form_validation->set_rules("manufacturer", "Manufacturer Name", "trim|required|max_length[20]");
    }
    
} //end Game_platform controller class