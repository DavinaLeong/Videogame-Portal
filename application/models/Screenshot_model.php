<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
- File Info -
File name		: Screenshot_model.php
Author(s)		: DAVINA Leong Shi Yun
Date Created	: 12 Dec 2015

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
 */
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
            "ss_type_id" => $screenshot["ss_type_id"],
            "vg_id" => $screenshot["vg_id"],
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
            "ss_type_id" => $screenshot["ss_type_id"],
            "vg_id" => $screenshot["vg_id"],
        );

        $now = new DateTime("now");
        $this->db->set('last_updated', $now->format('c'));
        $query = $this->db->update(TABLE_SCREENSHOTS, $data, array("ss_id" => $screenshot["ss_id"]));
        return $query->affected_rows();
    }

} //end Screenshot_model class