<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Screenshot_type_model.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Screenshot_type_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_SCREENSHOT_TYPE);
    }

    public function get_all()
    {
        $query = $this->db->get(TABLE_SCREENSHOT_TYPE);
        return $query->result_array();
    }

    public function get_by_id($ss_type_id=FALSE)
    {
        $query = $this->db->get_where(TABLE_SCREENSHOT_TYPE, array('ss_type_id' => $ss_type_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("ss_type_id");
        $query = $this->db->get(TABLE_SCREENSHOT_TYPE, $limit, $offset);
        return $query->result_array();
    }

    public function insert($screenshot_type)
    {
        $data = array(
            "ss_type_name" => $screenshot_type["ss_type_name"],
            "ss_type_description" => $screenshot_type["ss_type_description"],
        );

        $this->load->library("Datetime_helper");
        $this->db->set("date_added", $this->datetime_helper->now());
        $this->db->set("last_updated", $this->datetime_helper->now());        $this->db->insert(TABLE_SCREENSHOT_TYPE, $data);
        return $this->db->insert_id();
    }

    public function update($screenshot_type)
    {
        $data = array(
            "ss_type_name" => $screenshot_type["ss_type_name"],
            "ss_type_description" => $screenshot_type["ss_type_description"],
        );

        $this->load->library("Datetime_helper");
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->update(TABLE_SCREENSHOT_TYPE, $data, array("ss_type_id" => $screenshot_type["ss_type_id"]));
        return $this->db->affected_rows();
    }

    public function delete_by_id($ss_type_id=FALSE)
    {
        var_dump($ss_type_id);
        $this->db->delete(TABLE_SCREENSHOT_TYPE, array("ss_type_id" => $ss_type_id));
        return $this->db->affected_rows();
    }

    public function get_all_ids()
    {
        $sql = "SELECT ss_type_id FROM screenshot_type";
        $query = $this->db->query($sql);
        $result = array();
        foreach($query->result_array() as $ss_type)
        {
            $result[] = $ss_type["ss_type_id"];
        }
        return $result;
    }

} //end Screenshot_type_model class