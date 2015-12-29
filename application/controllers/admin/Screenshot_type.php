<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Screenshot_type.php
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
 * @property Screenshot_type_model $Screenshot_type_model
 */

class Screenshot_type extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Screenshot_type_model");
    }

    public function index()
    {
        redirect("/admin/screenshot_type/browse_screenshot_type");
    }

    public function browse_screenshot_type()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $data = array(
                "screenshot_types" => $this->Screenshot_type_model->get_all()
            );

            $this->load->view("admin/screenshot_type/browse_screenshot_type_page", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function new_screenshot_type()
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $this->_new_screenshot_type_validation_rules();

            if($this->form_validation->run())
            {
                if($ss_type_id = $this->Screenshot_type_model->insert($this->_prepare_new_screenshot_type()) )
                {
                    $this->User_log_model->log_message("New Screenshot Type created successfully. | ss_type_id: " . $ss_type_id);
                    $this->session->set_userdata("message" , "New Screenshot Type created successfully.");
                    redirect("/admin/screenshot_type/browse_screenshot_type");
                }
                else
                {
                    $this->User_log_model->log_message("Unable to create new Screenshot Type.");
                    $this->session->set_userdata("message" , "Unable to create new Screenshot Type.");
                }
            }
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    private function _new_screenshot_type_validation_rules()
    {
        $this->form_validation->set_rules("ss_type_name", "Screenshot Type Name", "trim|required|max_length[32]");
        $this->form_validation->set_rules("ss_type_description", "Screenshot Type Description", "trim|max_length[128]");
    }

    private function _prepare_new_screenshot_type()
    {
        $screenshot_type["ss_type_name"] = $this->input->post("ss_type_name");
        $screenshot_type["ss_type_description"] = $this->input->post("ss_type_description");
        return $screenshot_type;
    }

} //end Screenshot_type controller class
