<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
- File Info -
File name		: Screenshot_model.php
Author(s)		: DAVINA Leong Shi Yun
Date Created	: 12 Dec 2015

- Contact Info -
Email	: leong.shi.yun@gmail.com
Mobile	: (+65) 9369 3752 [Singapore]

All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Screenshot_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_SCREENSHOTS);
    }

    public function get_all()
    {
        $query = $this->db->get(TABLE_SCREENSHOTS);
        return $query->result_array();
    }

    public function get_by_id($ss_id=FALSE)
    {
        $query = $this->db->get_where(TABLE_SCREENSHOTS, array('ss_id' => $ss_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("ss_id");
        $query = $this->db->get(TABLE_SCREENSHOTS, $limit, $offset);
        return $query->result_array();
    }

    public function insert($screenshot)
    {
        $data = array(
            "ss_name" => $screenshot["ss_name"],
            "ss_url" => $screenshot["ss_url"],
            "ss_width" => $screenshot["ss_width"],
            "ss_height" => $screenshot["ss_height"],
            "ss_description" => $screenshot["ss_description"],
            "ss_type_id" => $screenshot["ss_type_id"],
            "vg_id" => $screenshot["vg_id"],
            "ss_img_type" => $screenshot["ss_img_type"]
        );

        $now = new DateTime("now");
        $this->db->set('date_added', $now->format('c'));
        $this->db->set('last_updated', $now->format('c'));
        $this->db->insert(TABLE_SCREENSHOTS, $data);
        return $this->db->insert_id();
    }

    public function update($screenshot)
    {
        $data = array(
            "ss_name" => $screenshot["ss_name"],
            "ss_url" => $screenshot["ss_url"],
            "ss_width" => $screenshot["ss_width"],
            "ss_height" => $screenshot["ss_height"],
            "ss_description" => $screenshot["ss_description"],
            "ss_type_id" => $screenshot["ss_type_id"],
            "vg_id" => $screenshot["vg_id"],
            "ss_img_type" => $screenshot["ss_img_type"]
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_SCREENSHOTS, $data, array("ss_id" => $screenshot["ss_id"]));
        return $this->db->affected_rows();
    }

    public function update_screenshot_image($screenshot)
    {
        $data = array(
            "ss_url" => $screenshot["ss_url"],
            "ss_width" => $screenshot["ss_width"],
            "ss_height" => $screenshot["ss_height"],
            "ss_img_type" => $screenshot["ss_img_type"],
            "ss_thumb_url" => $screenshot["ss_thumb_url"]
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_SCREENSHOTS, $data, array("ss_id" => $screenshot["ss_id"]));
        return $this->db->affected_rows();
    }

    public function get_all_videogames_screenshotTypes()
    {
        $sql = "SELECT screenshots.*,
videogames.vg_name, videogames.vg_abbr,
screenshot_type.ss_type_name
FROM screenshots
LEFT JOIN videogames ON screenshots.vg_id = videogames.vg_id
LEFT JOIN screenshot_type ON screenshots.ss_type_id = screenshot_type.ss_type_id
ORDER BY screenshots.ss_name";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_by_id_videogames_screenshotTypes($ss_id=FALSE)
    {
        if($ss_id)
        {
            $sql = "SELECT screenshots.*,
    videogames.vg_name, videogames.vg_abbr,
    screenshot_type.ss_type_name
    FROM screenshots
    LEFT JOIN videogames ON screenshots.vg_id = videogames.vg_id
    LEFT JOIN screenshot_type ON screenshots.ss_type_id = screenshot_type.ss_type_id
    WHERE screenshots.ss_id = ?
    ORDER BY screenshots.ss_name";
            $query = $this->db->query($sql, array((int) $ss_id));
            return $query->result_array();
        }
        else
        {
            return 0;
        }
    }

} //end Screenshot_model class
