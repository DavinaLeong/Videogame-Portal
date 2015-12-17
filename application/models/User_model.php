<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: User_model.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 12 Dec 2015

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
 */

class User_model extends CI_Model
{
    public function get_all()
    {
        $query = $this->db->get(TABLE_USER);
        return $query->result_array();
    }

    public function get_by_username($username=FALSE)
    {
        $query = $this->db->get_where(TABLE_USER, array('username' => $username));
        return $query->row_array();
    }

    public function get_by_id($uid=FALSE)
    {
        $query = $this->db->get_where(TABLE_USER, array('uid' => $uid));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("uid");
        $query = $this->db->get(TABLE_USER, $limit, $offset);
        return $query->result_array();
    }

    public function count_all()
    {
        return $this->db->count_all(TABLE_USER);
    }

    public function insert($user)
    {
        $data = array(
            'username'=>$user['username'],
            'password_hash'=>$user['password_hash'],
            'name'=>$user['name'],
            'access'=>$user['access'],
            'status'=>$user['status'],
            'avatar_url'=>$user['avatar_url']
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->set('date_added', $now->format('c'));
        $this->db->insert(TABLE_USER, $data);
        return $this->db->insert_id();
    }

    public function update($user)
    {
        $data = array(
            'username'=>$user['username'],
            'name'=>$user['name'],
            'access'=>$user['access'],
            'status'=>$user['status'],
            'avatar_url'=>$user['avatar_url']
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_USER, $data, array('uid' => $user['uid']));
        return $this->db->affected_rows();
    }

    public function update_password($user)
    {
        $data = array(
            'password_hash'=>$user['password_hash']
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_USER, $data, array('uid' => $user['uid']));
        return $this->db->affected_rows();
    }

    public function update_avatar_url($user)
    {
        $data = array(
            'avatar_url'=>$user['avatar_url']
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_USER, $data, array('uid' => $user['uid']));
        return $this->db->affected_rows();
    }

    public function delete_by_uid($uid=FALSE)
    {
        if($uid!==FALSE){
            $this->db->delete(TABLE_USER, array('uid' => $uid));
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }

    public function delete_by_username($username=FALSE)
    {
        if($username!==FALSE){
            $this->db->delete(TABLE_USER, array('username' => $username));
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }
} //end User_model class
