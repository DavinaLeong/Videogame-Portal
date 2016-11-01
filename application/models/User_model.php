<?php defined("BASEPATH") OR exit("No direct script access allowed");
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
    public function get_all()
    {
        $query = $this->db->get(TABLE_USER);
        return $query->result_array();
    }

    public function get_by_username($username=FALSE)
    {
        $query = $this->db->get_where(TABLE_USER, array("username" => $username));
        return $query->row_array();
    }

    public function get_by_id($user_id=FALSE)
    {
        $query = $this->db->get_where(TABLE_USER, array("uid" => $user_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("user_id");
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
            "username"=>$user["username"],
            "password_hash"=>$user["password_hash"],
            "name"=>$user["name"],
            "access"=>$user["access"],
            "status"=>$user["status"],
            "avatar_url"=>$user["avatar_url"]
        );

        $this->load->library("Datetime_helper");
        $this->db->set("date_added", $this->datetime_helper->now());
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->insert(TABLE_USER, $data);
        return $this->db->insert_id();
    }

    public function update($user)
    {
        $data = array(
            "username"=>$user["username"],
            "name"=>$user["name"],
            "access"=>$user["access"],
            "status"=>$user["status"],
            "avatar_url"=>$user["avatar_url"]
        );

        $this->load->library("Datetime_helper");
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->update(TABLE_USER, $data, array("uid" => $user["uid"]));
        return $this->db->affected_rows();
    }

    public function update_password($user)
    {
        $data = array(
            "password_hash"=>$user["password_hash"]
        );

        $this->load->library("Datetime_helper");
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->update(TABLE_USER, $data, array("uid" => $user["uid"]));
        return $this->db->affected_rows();
    }

    public function update_avatar_url($user)
    {
        $data = array(
            "avatar_url"=>$user["avatar_url"]
        );

        $this->load->library("Datetime_helper");
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->update(TABLE_USER, $data, array("uid" => $user["uid"]));
        return $this->db->affected_rows();
    }

    public function delete_by_uid($user_id=FALSE)
    {
        if($user_id!==FALSE){
            $this->db->delete(TABLE_USER, array("uid" => $user_id));
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }

    public function delete_by_username($username=FALSE)
    {
        if($username!==FALSE){
            $this->db->delete(TABLE_USER, array("username" => $username));
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }
} //end User_model class
