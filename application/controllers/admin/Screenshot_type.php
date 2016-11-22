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
                "screenshot_types" => $this->Screenshot_type_model->get_all(),
                "total_entries" => $this->Screenshot_type_model->count_all()
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
                    $this->User_log_model->_set_common_message("create", "Screenshot Type", "ss_type_id", $ss_type_id);
                }
                else
                {
                    $this->User_log_model->_set_common_message("create failed", "Screenshot Type");
                }
            }

            redirect("/admin/screenshot_type/browse_screenshot_type");
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
        $this->form_validation->set_rules("ss_type_description", "Screenshot Type Description", "trim|max_length[512]");
    }

    private function _prepare_new_screenshot_type()
    {
        $screenshot_type["ss_type_name"] = $this->input->post("ss_type_name");
        $screenshot_type["ss_type_description"] = $this->input->post("ss_type_description");
        return $screenshot_type;
    }

    public function edit_screenshot_type($ss_type_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            $screenshot_type = $this->Screenshot_type_model->get_by_id($ss_type_id);
            $this->_edit_screenshot_type_validation_rules();

            if($this->form_validation->run())
            {
                if($ss_type_id = $this->Screenshot_type_model->update($this->_prepare_edit_screenshot_type($screenshot_type)) )
                {
                    $this->User_log_model->_set_common_message("update", "Screenshot Type", "ss_type_id", $ss_type_id);
                    redirect("/admin/screenshot_type/browse_screenshot_type");
                }
                else
                {
                    $this->User_log_model->_set_common_message("create failed", "Screenshot Type", "ss_type_id", $ss_type_id);
                }
            }

            $data = array(
                "screenshot_type" => $screenshot_type
            );
            $this->load->view("admin/screenshot_type/edit_screenshot_type", $data);
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    public function delete_screenshot_type($ss_type_id=FALSE)
    {
        if($this->User_log_model->validate_access("A", $this->session->userdata("access")))
        {
            if($this->Screenshot_type_model->delete_by_id($ss_type_id) )
            {
                $this->User_log_model->_set_common_message("delete", "Screenshot Type", "ss_type_id", $ss_type_id);
            }
            else
            {
                $this->User_log_model->_set_common_message("delete failed", "Screenshot Type", "ss_type_id", $ss_type_id);
            }

            redirect("/admin/screenshot_type/browse_screenshot_type");
        }
        else
        {
            $this->session->set_userdata("message", "This user has invalid access rights.");
            redirect('/admin/authenticate/login/');
        }
    }

    private function _edit_screenshot_type_validation_rules()
    {
        $this->form_validation->set_rules("ss_type_name", "Screenshot Type Name", "trim|required|max_length[32]");
        $this->form_validation->set_rules("ss_type_description", "Screenshot Type Description", "trim|max_length[512]");
    }

    private function _prepare_edit_screenshot_type($screenshot_type)
    {
        $screenshot_type["ss_type_name"] = $this->input->post("ss_type_name");
        $screenshot_type["ss_type_description"] = $this->input->post("ss_type_description");
        return $screenshot_type;
    }

} //end Screenshot_type controller class
