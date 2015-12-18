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
 *
 * @property User_log_model $User_log_model
 * @property User_model $User_model
 * @property Upload_helper $upload_helper
 */

class Game_genre_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_GAME_GENRE);
    }

    public function get_all()
    {
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
        $this->db->order_by("genre_id");
        $query = $this->db->get(TABLE_GAME_GENRE, $limit, $offset);
        return $query->result_array();
    }

    public function insert($game_genre)
    {
        $data = array(
            "genre_name" => $game_genre["genre_name"],
        );

        $this->db->insert(TABLE_GAME_GENRE, $data);
        return $this->db->insert_id();
    }

    public function update($game_genre)
    {
        $data = array(
            "genre_name" => $game_genre["genre_name"],
        );

        $query = $this->db->update(TABLE_GAME_GENRE, $data, array("genre_id" => $game_genre["genre_id"]));
        return $query->affected_rows();
    }
    
} //end Game_genre_model class