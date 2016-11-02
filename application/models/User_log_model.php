<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: User_log_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

	All content © DAVINA Leong Shi Yun. All Rights Reserved.
***********************************************************************************/
class User_log_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("timestamp", "DESC");
        $query = $this->db->get(TABLE_USER_LOG);
        return $query->result_array();
    }

    public function get_all_user()
    {
        $sql = "SELECT user_log.*, user.name, user.username, user.access FROM user_log
        LEFT JOIN user ON user_log.user_id = user.user_id
        ORDER BY user_log.timestamp DESC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_all_limit_offset($limit=1000, $offset=0)
    {
        $this->db->order_by("timestamp", "DESC");
        $query = $this->db->get(TABLE_USER_LOG, $limit, $offset);
        return $query->result_array();
    }

    public function get_all_user_limit_offset($limit=1000, $offset=0)
    {
        $sql = "SELECT user_log.*, user.name, user.username, user.access FROM user_log
        LEFT JOIN user ON user_log.user_id = user.user_id
        ORDER BY user_log.timestamp DESC
        LIMIT ? OFFSET ?";

        $query = $this->db->query($sql, array((int) $limit, (int) $offset));
        return $query->result_array();
    }

    public function log_message($message)
    {
        $data = array(
            'user_id'=>$this->session->userdata('user_id'),
            'message'=>$message
        );

        $this->load->library('Datetime_helper');
        $this->db->set('timestamp', $this->datetime_helper->now());
        $this->db->insert(TABLE_USER_LOG, $data);
        return $this->db->insert_id();
    }

    public function _set_common_message($action, $item, $id_value = "", $id_name = "")
    {
        switch(strtolower($action))
        {
            case 1:
            case "1":
            case "insert":
            case "create":
            case "add":
            case "new":
            $this->session->set_userdata("message", "New " . $item . " record <mark>created</mark> successfully.");
            $this->log_message($item . " record CREATED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 2:
            case "2":
            case "update":
            case "edit":
            $this->session->set_userdata("message", $item . " record <mark>updated</mark> successfully.");
            $this->log_message($item . " record UPDATED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 3:
            case "3":
            case "delete":
            case "remove":
            $this->session->set_userdata("message", $item . " record <mark>deleted</mark> successfully.");
            $this->log_message($item . " record DELETED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 4:
            case "4":
            case "retrive":
            case "get":
            $this->session->set_userdata("message", $item . " record <mark>retrieved</mark> successfully.");
            $this->log_message($item . " record RETRIEVED successfully. | " . $id_name . ": " . $id_value);
                break;

            case 5:
            case "5":
            case "retrieve all":
            case "get all":
            $this->session->set_userdata("message", "All " . $item . "(s) <mark>retrieved</mark> successfully.");
            $this->log_message("All " . $item . "(s) RETRIEVED successfully.");
                break;

            case 6:
            case "6":
            case "unable to insert":
            case "unable to create":
            case "unable to new":
            case "unable to add":
            case "insert failed":
            case "create failed":
            case "new failed":
            case "add failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to create " . $item . " record.");
            $this->log_message("Unable to CREATE " . $item . " record.");
                break;

            case 7:
            case "7":
            case "unable to update":
            case "unable to edit":
            case "update failed":
            case "edit failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to update " . $item . " record.");
            $this->log_message("Unable to UPDATE " . $item . " record. | " . $id_name . ": " . $id_value);
                break;

            case 8:
            case "8":
            case "unable to delete":
            case "unable to remove":
            case "delete failed":
            case "remove failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to delete " . $item . " record.");
            $this->log_message("Unable to DELETE " . $item . " record. | " . $id_name . ": " . $id_value);
                break;

            case 9:
            case "9":
            case "unable to retrieve":
            case "unable to get":
            case "retieve failed":
            case "get failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to retieve " . $item . ".");
            $this->log_message("Unable to RETRIEVE " . $item . ". | " . $id_name . ": " . $id_value);
                break;

            case 10:
            case "10":
            case "unable retrieve all":
            case "unable get all":
            case "retrieve all failed":
            case "get all failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to retrieve all " . $item . "(s).");
            $this->log_message("Unable to RETRIEVE all " . $item . "(s).");
                break;

            case 11:
            case "11":
            case "login":
            case "log-in":
            case "log in":
            case "logged in":
            case "signin":
            case "sign-in":
            case "sign in":
            case "signed in":
            $this->session->set_userdata("message", "Log in successful.");
            $this->log_message("User has logged in. | uid: " . $id_value);
                break;

            case 12:
            case "12":
            case "logout":
            case "log-out":
            case "log out":
            case "logged out":
            case "signout":
            case "sign-out":
            case "sign out":
            case "signed out":
            $this->session->set_userdata("message", "Log out successful.");
            $this->log_message("User has logged out. | uid: " . $id_value);
                break;

            case 13:
            case "13":
            case "change password":
            $this->session->set_userdata("message", "Password <mark>changed</mark> successfully.");
            $this->log_message("User's password changed succesfully. | uid: " . $id_value);
                break;

            case 14:
            case "14":
            case "reset password":
            $this->session->set_userdata("message", "Password <mark>reset</mark> successful.");
            $this->log_message("User's RESET PASSWORD successful. | uid: " . $id_value);
                break;

            case 15:
            case "15":
            case "unable to change password":
            case "change password failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to change password.");
            $this->log_message("Unable to CHANGE PASSWORD. | uid: " . $id_value);
                break;

            case 16:
            case "16":
            case "unable to reset password":
            case "reset password failed":
            $this->session->set_userdata("message", "<mark>Unable</mark> to rest password.");
            $this->log_message("Unable to RESET PASSWORD. | uid: " . $id_value);
                break;

            default:
                show_error("User_log->_set_common_message, " . $action . " is not assigned.");
                break;
        }
    }

    public function _set_message($message, $log_to_db=TRUE)
    {
        $this->session->set_userdata("message", $message);
        if($log_to_db) $this->User_log_model->log_mesage($message);
    }

    public function validate_access($requiredAccess,$userAccess)
    {
        $valid=false;

        for($i=0;$i<strlen($userAccess);$i++)
        {
            if(strpos($requiredAccess,substr($userAccess,$i,1))!==false)
            {
                $valid=true;
                break;
            }
        }
        return $valid;
    }
}// end User_log_model class
