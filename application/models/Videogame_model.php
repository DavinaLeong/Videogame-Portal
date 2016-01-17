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
class Videogame_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_VIDEOGAMES);
    }

    public function get_all()
    {
        $query = $this->db->get(TABLE_VIDEOGAMES);
        return $query->result_array();
    }

    public function get_by_id($vg_id=FALSE)
    {
        $query = $this->db->get_where(TABLE_VIDEOGAMES, array('vg_id' => $vg_id));
        return $query->row_array();
    }

    public function get_all_limit_offset($limit, $offset)
    {
        $this->db->order_by("vg_id");
        $query = $this->db->get(TABLE_VIDEOGAMES, $limit, $offset);
        return $query->result_array();
    }

    public function insert($videogame)
    {
        $data = array(
            "vg_name" => $videogame["vg_name"],
            "genre_id" => $videogame["genre_id"],
            "platform_id" => $videogame["platform_id"],
            "date_purchased" => $videogame["date_purchased"],
            "from_steam" => $videogame["from_steam"]
        );

        $this->db->insert(TABLE_VIDEOGAMES, $data);
        return $this->db->insert_id();
    }

    public function update($videogame)
    {
        $data = array(
            "vg_name" => $videogame["vg_name"],
            "genre_id" => $videogame["genre_id"],
            "platform_id" => $videogame["platform_id"],
            "date_purchased" => $videogame["date_purchased"],
            "from_steam" => $videogame["from_steam"]
        );

        $query = $this->db->update(TABLE_VIDEOGAMES, $data, array("vg_id" => $videogame["vg_id"]));
        return $query->affected_rows();
    }

    public function get_all_genre_platform()
    {
        $sql = "SELECT * FROM videogames
LEFT JOIN game_genre ON game_genre.genre_id = videogames.genre_id
LEFT JOIN game_platform ON game_platform.platform_id = videogames.platform_id
ORDER BY videogames.vg_name";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_by_id_genre_platform($vg_id=FALSE)
    {
        $sql = "SELECT * FROM videogames
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

} //end Videogame_model class
