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
                if($platform_id = $this->Game_platform_model->insert($this->_prepare_add_game_platform()))
                {
                    $this->session->set_userdata("message", "New Game Platform added.");
                    $this->User_log_model->log_message("New user recorded added |  platform_id: " . $platform_id);
                    $this->session->set_userdata("message", "Upload a Platform Logo, or click <b class='text-phrase'><i class='fa fa-ban'></i> Cancel</b> to cancel.");
                    redirect("admin/game_platform/edit_game_platform/" . $platform_id);
                }
                else
                {
                    $this->session->set_userdata("message", "Unable to add new Game Platform.");
                    $this->User_log_model->log_message("Unable to add new Game Platform.");
                }
            }

            $this->load->view("admin/game_platform/new_game_platform_page");
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
            );

            if($use_react)
            {
                $this->load->view("admin/game_platform/browse_game_platform_page_react", $data);
            }
            else
            {
                $this->load->view("admin/game_platform/browse_game_platform_page", $data);
            }
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
                $this->session->set_userdata("message", "Game Platform deleted successfully.");
                $this->User_log_model->log_message("Game Platform deleted successfully. | platform_id: " . $platform_id);
                redirect("admin/game_platform/browse_game_platform");
            }
            else
            {
                $this->session->set_userdata("message", "Unable to delete Game Platform record.");
                $this->User_log_model->log_message("Unable to delete Game Platform record. | platform_id: " . $platform_id);
            }
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
                    $this->session->set_userdata("message", "Game Platform record updated successfully.");
                    $this->User_log_model->log_message("Game Platform record updated successfully. | platform_id: " . $platform_id);
                    redirect("admin/game_platform/view_game_platform/" . $platform_id);
                }
                else
                {
                    $this->session->set_userdata("message", "An error has occured. Unable to update Game Platform record.");
                    $this->User_log_model->log_message("Unable to update Game Platform record. | platform_id: " . $platform_id);
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

    public function json_get_all_platforms()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $json_response = array(
                "gamePlatforms" => $this->Game_platform_model->get_all(),
                "status" => "success"
            );

            $this->output->set_content_type("application/json")->set_output(json_encode($json_response));
        }
        else
        {
            $json_response = array(
                "message" => "Invalid access rights.",
                "status" => "error"
            );

            $this->output->set_content_type("application/json")->set_output(json_encode($json_response));
        }
    }

    public function json_delete_by_platform_id()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->form_validation->set_rules("platform_id", "Platform ID", "trim|required");

            if($this->form_validation->run())
            {
                if($this->Game_platform_model->delete_by_id($this->input->post("platform_id")) ) {
                    $this->session->set_userdata("message", "Game Platform deleted successfully.");
                    $this->User_log_model->log_message("Game Platform deleted successfully. | platform_id: " .
                        $this->input->post("platform_id"));

                    $json_response = array(
                        "message" => "Game Platform deleted successfully",
                        "status" => "success"
                    );

                    $this->output->set_content_type("application/json")->set_output(json_encode($json_response));
                }
                else
                {
                    $this->session->set_userdata("message", "Unable to delete Game Platform.");
                    $this->User_log_model->log_message("Unable to delete Game Platform. |
                    platform_id: " .
                        $this->input->post("platform_id"));

                    $json_response = array(
                        "message" => "Unable to delete Game Platform",
                        "status" => "error"
                    );

                    $this->output->set_content_type("application/json")->set_output(json_encode($json_response));
                }
            }
            else
            {
                $json_response = array(
                    "message" => "<b class='text-phrase'>platform_id</b> not found",
                    "status" => "error"
                );

                $this->output->set_content_type("application/json")->set_output(json_encode($json_response));
            }
        }
        else
        {
            $json_response = array(
                "message" => "Invalid access rights.",
                "status" => "error"
            );

            $this->output->set_content_type("application/json")->set_output(json_encode($json_response));
        }
    }

    public function upload_image()
    {
        $this->load->library("upload_helper");

        $platform = $this->Game_platform_model->get_by_id($this->session->userdata("platform_id"));

        // Davina: upload_helper is a custom library
        $upload_config = $this->upload_helper->upload_config_filename(strtolower($platform
            ["abbr"] . "_logo"), "./uploads/platform_logo/", "gif|jpg|png");
        $this->load->library("upload", $upload_config);

        if ($this->upload->do_upload("logo_url"))
        {
            //Get new uploaded file data
            $file_upload_data = $this->upload->data();

            //If a url exists, delete file of url
            if ($platform["logo_url"])
            {
                $this->load->helper("file");
                delete_files("./uploads/platform_logo/" . $platform["logo_url"]);
            }

            //Update database with new image url
            $platform["logo_url"] = "platform_logo/" . $file_upload_data["file_name"];
            $this->Game_platform_model->update_logo_url($platform);

            $this->session->set_userdata("message", "Logo uploaded successfully.");
            $this->User_log_model->log_message("Logo uploaded sucessfully. | platform_id: " . $this->session->userdata("platform_id"));
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
        $this->form_validation->set_rules("year_intro", "Year Introduced", "trim|required|is_natural");
        $this->form_validation->set_rules("developer", "Developer", "trim|max_length[128]");
        $this->form_validation->set_rules("abbr", "Abbreviation", "trim|required|alpha_numeric|max_length[64]");
    }

    private function _prepare_add_game_platform()
    {
        $game_platform["platform_name"] = $this->input->post("platform_name");
        $game_platform["year_intro"] = $this->input->post("year_intro");
        $game_platform["developer"] = $this->input->post("developer");
        $game_platform["abbr"] = $this->input->post("abbr");
        $game_platform["logo_url"] = "platform_logo/default_logo.png";
        return $game_platform;
    }

    private function _edit_game_platform_validation_rules()
    {
        $this->form_validation->set_rules("platform_name", "Platform Name", "trim|max_length[64]");
        $this->form_validation->set_rules("year_into", "Year Introduced", "trim|is_natural");
        $this->form_validation->set_rules("developer", "Developer", "trim|max_length[128]");
        $this->form_validation->set_rules("abbr", "Abbreviation", "trim|alpha_numeric|max_length[64]");
    }

    private function _prepare_edit_game_platform($game_platform)
    {
        $game_platform["platform_name"] = $this->input->post("platform_name");
        $game_platform["year_intro"] = $this->input->post("year_intro");
        $game_platform["developer"] = $this->input->post("developer");
        $game_platform["abbr"] = $this->input->post("abbr");
        return $game_platform;
    }

} //end Game_platform controller class
