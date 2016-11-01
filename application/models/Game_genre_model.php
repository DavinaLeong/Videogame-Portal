<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Game_genre_model.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Game_genre_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_GAME_GENRE);
    }

    public function get_all()
    {
        $this->db->order_by("genre_name");
        $query = $this->db->get(TABLE_GAME_GENRE);
        return $query->result_array();
    }

    public function get_by_id($genre_id=FALSE)
    {
        $query = $this->db->get_where(TABLE_GAME_GENRE, array('genre_id' => $genre_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("genre_name");
        $query = $this->db->get(TABLE_GAME_GENRE, $limit, $offset);
        return $query->result_array();
    }

    public function insert($game_genre)
    {
        $data = array(
            "genre_name" => $game_genre["genre_name"],
            "genre_abbr" => $game_genre["genre_abbr"],
            "genre_label_col" => $game_genre["genre_label_col"]
        );

        $this->load->library("Datetime_helper");
        $this->db->set("date_added", $this->datetime_helper->now());
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->insert(TABLE_GAME_GENRE, $data);
        return $this->db->insert_id();
    }

    public function update($game_genre)
    {
        $data = array(
            "genre_name" => $game_genre["genre_name"],
            "genre_abbr" => $game_genre["genre_abbr"],
            "genre_label_col" => $game_genre["genre_label_col"]
        );

        $this->load->library("Datetime_helper");
        $this->db->set("last_updated", $this->datetime_helper->now());
        $this->db->update(TABLE_GAME_GENRE, $data, array("genre_id" => $game_genre["genre_id"]));
        return $this->db->affected_rows();
    }

    public function delete_by_id($genre_id=FALSE)
    {
        $this->db->delete(TABLE_GAME_GENRE, array("genre_id" => $genre_id));
        return $this->db->affected_rows();
    }
    
} //end Game_genre_model class