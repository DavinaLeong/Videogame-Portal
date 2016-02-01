<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Videogame_model.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 12 Dec 2015

    - Contact Info -
        Email	: leong.shi.yun@gmail.com
        Mobile	: (+65) 9369 3752 [Singapore]

    All content � DAVINA Leong Shi Yun. All Rights Reserved.
 ***********************************************************************************/

class Videogame_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_VIDEOGAMES);
    }

    public function get_all()
    {
        $this->db->order_by("vg_name");
        $query = $this->db->get(TABLE_VIDEOGAMES);
        return $query->result_array();
    }

    public function get_by_id($vg_id=FALSE)
    {
        $this->db->get_where(TABLE_VIDEOGAMES, array('vg_id' => $vg_id));
        return $this->db->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("vg_name");
        $this->db->get(TABLE_VIDEOGAMES, $limit, $offset);
        return $this->db->result_array();
    }

    public function insert($videogame)
    {
        $data = array(
            "vg_name" => $videogame["vg_name"],
            "vg_abbr" => $videogame["vg_abbr"],
            "genre_id" => $videogame["genre_id"],
            "platform_id" => $videogame["platform_id"],
            "date_purchased" => $videogame["date_purchased"],
            "from_steam" => $videogame["from_steam"]
        );

        $now = new DateTime("now");
        $this->db->set('date_added', $now->format('c'));
        $this->db->set('last_updated', $now->format('c'));
        $this->db->insert(TABLE_VIDEOGAMES, $data);
        return $this->db->insert_id();
    }

    public function update($videogame)
    {
        $data = array(
            "vg_name" => $videogame["vg_name"],
            "vg_abbr" => $videogame["vg_abbr"],
            "genre_id" => $videogame["genre_id"],
            "platform_id" => $videogame["platform_id"],
            "date_purchased" => $videogame["date_purchased"],
            "from_steam" => $videogame["from_steam"]
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $this->db->update(TABLE_VIDEOGAMES, $data, array("vg_id" => $videogame["vg_id"]));
        return $this->db->affected_rows();
    }

    public function get_all_genre_platform()
    {
        $sql = "SELECT *, videogames.genre_id AS `vg_genre_id`, videogames.platform_id AS `vg_platform_id`, videogames.date_added AS `vg_date_added`, videogames.last_updated AS `vg_last_updated` FROM videogames
LEFT JOIN game_genre ON game_genre.genre_id = videogames.genre_id
LEFT JOIN game_platform ON game_platform.platform_id = videogames.platform_id
ORDER BY videogames.vg_name";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_by_id_genre_platform($vg_id=FALSE)
    {
        $sql = "SELECT *, videogames.genre_id AS `vg_genre_id`, videogames.platform_id AS `vg_platform_id`, videogames.date_added AS `vg_date_added`, videogames.last_updated AS `vg_last_updated` FROM videogames
LEFT JOIN game_genre ON game_genre.genre_id = videogames.genre_id
LEFT JOIN game_platform ON game_platform.platform_id = videogames.platform_id
WHERE videogames.vg_id = ?";

        $query = $this->db->query($sql, array((int) $vg_id));
        return $query->row_array();
    }

    public function delete_by_id($vg_id=FALSE)
    {
        $this->db->delete(TABLE_VIDEOGAMES, array("vg_id" => $vg_id));
        return $this->db->affected_rows();
    }

    public function get_all_ids()
    {
        $sql = "SELECT vg_id FROM videogames";
        $query = $this->db->query($sql);
        $result = array();
        foreach($query->result_array() as $videogame)
        {
            $result[] = $videogame["vg_id"];
        }
        return $result;
    }

} //end Videogame_model class
