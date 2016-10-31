<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: 20161031210023_initial_setup.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 31 Oct 2016
	
	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]
	
***********************************************************************************/
/* Migration version: 
 * 31 Oct 2016, 09:00PM
 * 20161031210023
 */
class Migration_Initial_setup extends CI_Migration
{
	// Public Functions ----------------------------------------------------------------
	public function up()
	{
		_script_create_tables();
		$this->_generate_users();
	}
	
	public function down()
	{
		if($this->db->query($this->_script_drop_tables()))
		{
			echo '<p>Tables dropped.</p>';
			echo '<hr/>';
			$this->_generate_users();
		}
		else
		{
			echo '<p>Failed to drop Tables.</p>';
			echo '<hr/>';
		}
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _script_create_tables()
	{
		echo '<h1>Creating Tables ...</h1>';

		$this->dbforge->drop_table('ci_sessions', TRUE);
		$ci_sessions = array(
			'id' => array(
				'type' => 'VARCHAR',
				'constraint' => '40'
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '45'
			),
			'timestamp' => array(
				'type' => 'INT',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => '0'
			),
			'data' => array(
				'type' => 'BLOB',
			)
		);
		$this->dbforge->add_key('timestamp', TRUE);
		if($this->dbforge->create_table('ci_sessions'))
		{
			echo '<p><small>CI Sessions</small></p>';
		}


	}
	
	private function _script_drop_tables()
	{
		echo '<h1>Dropping Tables ...</h1>';

		if($this->dbforge->drop_table('user', TRUE))
		{
			echo '<p><small>User</small></p>';
		}

		if($this->dbforge->drop_table('user_log', TRUE))
		{
			echo '<p><small>User Log</small></p>';
		}

		if($this->dbforge->drop_table('videogames', TRUE))
		{
			echo '<p><small>Videogames</small></p>';
		}

		if($this->dbforge->drop_table('game_genre', TRUE))
		{
			echo '<p><small>Game Genre</small></p>';
		}

		if($this->dbforge->drop_table('game_platform', TRUE))
		{
			echo '<p><small>Game Platform</small></p>';
		}

		if($this->dbforge->drop_table('screenshot', TRUE))
		{
			echo '<p><small>Screenshot</small></p>';
		}

		if($this->dbforge->drop_table('screenshot_type', TRUE))
		{
			echo '<p><small>Screenshot Type</small></p>';
		}
	}
	
	private function _generate_users()
	{
		$this->load->model('User_log_model');
		$this->load->model('User_model');
		$user = array(
			'username' => 'admin',
			'name' => 'Default Admin',
			'password_hash' => password_hash('password', PASSWORD_DEFAULT),
			'access' => 'A',
			'status' => 'Active'
		);
		$this->User_model->insert($user);
	}
	
} // end 20161031210023_initial_setup class