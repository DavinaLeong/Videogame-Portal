<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
    - File Info -
        File name		: Game_platform_model.php
        Author(s)		: DAVINA Leong Shi Yun
        Date Created	: 17 Dec 2015

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
 *
 * @property User_log_model $User_log_model
 * @property User_model $User_model
 * @property Upload_helper $upload_helper
 */

class Game_platform_model extends CI_Model
{
    public function count_all()
    {
        return $this->db->count_all(TABLE_GAME_PLATFORM);
    }

    public function get_all()
    {
        $this->db->order_by("year_intro", "DESC");
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
            "manufacturer" => $game_platform["manufacturer"],
            "logo_url" => "platform_logo/default_logo.png"
        );

        $this->db->insert(TABLE_GAME_PLATFORM, $data);
        return $this->db->insert_id();
    }

    public function update($game_platform)
    {
        $data = array(
            "platform_name" => $game_platform["platform_name"],
            "year_intro" => $game_platform["year_intro"],
            "manufacturer" => $game_platform["manufacturer"]
        );

        $query = $this->db->update(TABLE_GAME_PLATFORM, $data, array("platform_id" => $game_platform["platform_id"]));
        return $query->affected_rows();
    }

    public function update_logo_url($game_platform)
    {
        $data = array(
            "logo_url" => $game_platform["logo_url"],
        );

        $query = $this->db->update(TABLE_GAME_PLATFORM, $data, array("platform_id" => $game_platform["platform_id"]));
        return $query->affected_rows();
    }
    
} //end Game_platform_model class