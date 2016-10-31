<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_model extends CI_Model
{
    public function reset()
    {
        $this->load->library('migration');
        $this->migration->version('0');
        $this->migration->current();
    }

    public function get_version_from_db()
    {
        $query = $this->db->get('migrations');
        return $query->row_array()['version'];
    }

    public function _get_versions_array()
    {
        $versions_array = array();
        foreach($this->migration->find_migrations() as $key=>$file)
        {
            $versions_array[] = $key;
        }

        // Add version numbers as new migration files are created
        return $versions_array;
    }
}