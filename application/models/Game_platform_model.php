<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Game_platform_model.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Game_platform_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_GAME_PLATFORM);
    }

    public function get_all()
    {
        $this->db->order_by("platform_name");
        $query = $this->db->get(TABLE_GAME_PLATFORM);
        return $query->result_array();
    }

    public function get_by_id($platform_id=FALSE)
    {
        $query = $this->db->get_where(TABLE_GAME_PLATFORM, array('platform_id' => $platform_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("year_intro", "DESC");
        $query = $this->db->get(TABLE_GAME_PLATFORM, $limit, $offset);
        return $query->result_array();
    }

    public function insert($game_platform)
    {
        $data = array(
            "platform_name" => $game_platform["platform_name"],
            "year_intro" => $game_platform["year_intro"],
            "platform_developer" => $game_platform["platform_developer"],
            "platform_logo_url" => $game_platform["platform_logo_url"],
            "platform_abbr" => $game_platform["platform_abbr"],
            "platform_label_col" => $game_platform["platform_label_col"]
        );

        $now = new DateTime("now");
        $this->db->set('date_added', $now->format('c'));
        $this->db->set('last_updated', $now->format('c'));
        $this->db->insert(TABLE_GAME_PLATFORM, $data);
        return $this->db->insert_id();
    }

    public function update($game_platform)
    {
        $data = array(
            "platform_name" => $game_platform["platform_name"],
            "year_intro" => $game_platform["year_intro"],
            "platform_developer" => $game_platform["platform_developer"],
            "platform_logo_url" => $game_platform["platform_logo_url"],
            "platform_abbr" => $game_platform["platform_abbr"],
            "platform_label_col" => $game_platform["platform_label_col"]
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_GAME_PLATFORM, $data, array("platform_id" => $game_platform["platform_id"]));
        return $this->db->affected_rows();
    }

    public function update_logo_url($game_platform=FALSE)
    {
        $data = array(
            "platform_logo_url" => $game_platform["platform_logo_url"],
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_GAME_PLATFORM, $data, array("platform_id" => $game_platform["platform_id"]));
        return $this->db->affected_rows();
    }

    public function delete_by_id($platform_id=FALSE)
    {
        $this->db->delete(TABLE_GAME_PLATFORM, array("platform_id" => $platform_id));
        return $this->db->affected_rows();
    }

} //end Game_platform_model class
