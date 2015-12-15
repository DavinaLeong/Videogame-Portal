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
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database("videogame_catalogue");
    }

    public function get_all()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_by_username($username=FALSE)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->row_array();
    }

    public function get_by_uid($uid=FALSE)
    {
        $query = $this->db->get_where('user', array('uid' => $uid));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("uid");
        $query = $this->db->get('user', $limit, $offset);
        return $query->result_array();
    }

    public function count_all()
    {
        return $this->db->count_all('user');
    }

    public function insert($user)
    {
        $temp_array = array(
            'username'=>$user['username'],
            'password_hash'=>$user['password_hash'],
            'name'=>$user['name'],
            'access'=>$user['access'],
            'status'=>$user['status']
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->set('date_added', $now->format('c'));
        $this->db->insert('user', $temp_array);
        return $this->db->insert_id();
    }

    public function update($user)
    {
        $temp_array = array(
            'username'=>$user['username'],
            'password_hash'=>$user['password_hash'],
            'name'=>$user['name'],
            'access'=>$user['access'],
            'status'=>$user['status']
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update('user', $temp_array, array('uid' => $user['uid']));
        return $this->db->affected_rows();
    }

    public function delete_by_uid($uid=FALSE)
    {
        if($uid!==FALSE){
            $this->db->delete('user', array('uid' => $uid));
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }

    public function delete_by_username($username=FALSE)
    {
        if($username!==FALSE){
            $this->db->delete('user', array('username' => $username));
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }
} //end User_model class
