<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Common_functions.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/

class Common_functions
{
    public function _error_not_implemented($func_name)
    {
        show_error("<b>" . $func_name . "</b> not implementd.");
    }

    public function _error_not_implemented_dialogue($func_name, $error = "Error Name")
    {
        echo "<div style='margin: 10px; padding: 10px; border: thin solid #600; background-color: #fee; border-radius: 5px; font-family: consolas, \"Courier New\", monotype'>" .
                "\t<h4 style='color: darkRed;'>" . $error . ":</h4>" .
                "\t<p><strong style='color: darkRed;'>" . $func_name . "</strong> not implemented.</p>" .
            "</div>";
    }

    public function _do_var_dump($var, $var_name = "Variable Name")
    {
        echo "<div style='margin: 10px; padding: 10px; border: thin solid #ccc; background-color: #eee; border-radius: 5px; font-family: consolas, \"Courier New\", monotype'>" .
                "<h4>var_dump - (<strong style='color: #009;'>" . $var_name . "</strong>):</h4>";
        var_dump($var);
        echo "</div>";
    }

    public function _do_var_export($var, $var_name = "Variable Name", $start_tag = "<p>", $end_tag = "</p>")
    {
        echo "<div style='margin: 10px; padding: 10px; border: thin solid #ccc; background-color: #eee; border-radius: 5px;'>" .
                "<h4>var_export - (<strong style='color: #009;". $var_name . "</strong>):</h4>" . $start_tag;
        var_export($var);
        echo $end_tag . "</div>";
    }

    public function _send_common_message($action, $item, $id_name = "", $id_value = "")
    {
        switch(strtolower($action))
        {
            case 1:
            case "1":
            case "insert":
            case "create":
            $this->session->set_userdata("message", "New " . $item . " record <mark>created</mark> successfully.");
            $this->User_log_model->log_mesage("Screenshot record CREATED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 2:
            case "2":
            case "update":
            case "edit":
            $this->session->set_userdata("message", $item . " record <mark>updated</mark> successfully.");
            $this->User_log_model->log_mesage($item . " record UPDATED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 3:
            case "3":
            case "delete":
            case "remove":
            $this->session->set_userdata("message", $item . " record <mark>deleted</mark> successfully.");
            $this->User_log_model->log_mesage($item . " record DELETED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 4:
            case "4":
            case "unable to insert":
            case "unable to create":
            case "insert failed":
            case "create failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to create " . $item . " record.");
            $this->User_log_model->log_message("Unable to CREATE " . $item . " record.");
                break;

            case 5:
            case "5":
            case "unable to update":
            case "unable to edit":
            case "update failed":
            case "edit failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to update " . $item . " record.");
            $this->User_log_model->log_message("Unable to UPDATE " . $item . " record.");
                break;

            case 6:
            case "6":
            case "unable to delete":
            case "unable to remove":
            case "delete failed":
            case "remove failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to delete " . $item . " record.");
            $this->User_log_model->log_message("Unable to DELETE " . $item . " record.");
                break;

            default:
                return show_error($action . " is not assigned.");
        }
    }

    public function send_message($message)
    {
        $this->session->set_userdata("message", $message);
        $this->User_log_model->log_mesage($message);
    }

} //end Common_functions class
