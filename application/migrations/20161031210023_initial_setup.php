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
        $this->_script_create_tables();
		$this->_generate_users();
	}
	
	public function down()
	{
        $this->_script_drop_tables();
	}
	
	// Private Functions ---------------------------------------------------------------
	private function _script_create_tables()
	{
		echo '<h1>Creating Tables ...</h1>';

        // --- ci sessions ---
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
        $this->dbforge->add_field($ci_sessions);
		$this->dbforge->add_key('timestamp', TRUE);
		if($this->dbforge->create_table('ci_sessions'))
		{
			echo '<div><small>CI Sessions</small></div>';
		}

        // --- user ---
        $this->dbforge->drop_table('user', TRUE);
        $user = array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '512'
            ),
            'password_hash' => array(
                'type' => 'VARCHAR',
                'constraint' => '512'
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '512'
            ),
            'avatar_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'null' => TRUE,
                'default' => 'admin_avatar/default_avatar.png'
            ),
            'access' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'default' => 'A'
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'default' => 'Active'
            ),
            'date_added' => array(
                'type' =>' TIMESTAMP'
            ),
            'last_updated' => array(
                'type' =>' TIMESTAMP'
            )
        );
        $this->dbforge->add_field($user);
        $this->dbforge->add_key('user_id', TRUE);
        if($this->dbforge->create_table('user', TRUE))
        {
            echo '<div><small>User</small></div>';
        }

        // --- user log ---
        $this->dbforge->drop_table('user_log', TRUE);
        $user_log = array(
            'ulid' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_incremnt' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE
            ),
            'message' => array(
                'type' => 'text'
            ),
            'timestamp' => array(
                'type' => 'TIMESTAMP'
            )
        );
        $this->dbforge->add_field($user_log);
        $this->dbforge->add_key('ulid', TRUE);
        if($this->dbforge->create_table('user_log', TRUE))
        {
            echo '<div><small>User Log</small></div>';
        }

        // -- videogames ---
        $this->dbforge->drop_table('videogames', TRUE);
        $videogames = array(
            'vg_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'vg_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => TRUE
            ),
            'vg_abbr' => array(
                'type' => 'VARCHAR',
                'constraint' => '64'
            ),
            'genre_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'platform_id' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'date_purchased' => array(
                'type' => 'DATE',
            ),
            'from_steam' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'date_added' => array(
                'type' => 'DATETIME'
            ),
            'last_updated' => array(
                'type' => 'TIMESTAMP',
            )
        );
        $this->dbforge->add_field($videogames);
        $this->dbforge->add_key('vg_id', TRUE);
        if($this->dbforge->create_table('videogames', TRUE))
        {
            echo '<div><small>Videogames</small></div>';
        }

        // --- game genre ---
        $this->dbforge->drop_table('game_genre', TRUE);
        $game_genre = array(
            'genre_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'genre_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '32'
            ),
            'genre_abbr' => array(
                'type' => 'VARCHAR',
                'constraint' => '32',
                'null' => TRUE
            ),
            'genre_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'null' => TRUE
            ),
            'genre_label_col' => array(
                'type' => 'VARCHAR',
                'constraint' => '6',
                'null' => TRUE
            ),
            'date_added' => array(
                'type' => 'DATETIME'
            ),
            'last_updated' => array(
                'type' => 'TIMESTAMP',
            )
        );
        $this->dbforge->add_field($game_genre);
        $this->dbforge->add_key('genre_id', TRUE);
        if($this->dbforge->create_table('game_genre', TRUE))
        {
            echo '<div><small>Game Genre</small></div>';
        }

        // --- game platform ---
        $this->dbforge->drop_table('game_platform', TRUE);
        $game_platform = array(
            'platform_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'platform_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '64'
            ),
            'year_intro' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'platform_developer' => array(
                'type' => 'VARCHAR',
                'constraint' => '11'
            ),
            'platform_logo_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '256'
            ),
            'platform_abbr' => array(
                'type' => 'VARCHAR',
                'constraint' => '16'
            ),
            'platform_logo_col' => array(
                'type' => 'VARCHAR',
                'constraint' => '6'
            ),
            'date_added' => array(
                'type' => 'DATETIME'
            ),
            'last_updated' => array(
                'type' => 'TIMESTAMP'
            )
        );
        $this->dbforge->add_field($game_platform);
        $this->dbforge->add_key('platform_id', TRUE);
        if($this->dbforge->create_table('game_platform', TRUE))
        {
            echo '<div><small>Game Platform</small></div>';
        }

        // --- screenshot ---
        $this->dbforge->drop_table('screenshot', TRUE);
        $screenshot = array(
            'ss_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ss_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'default' => 'Screenshot Name'
            ),
            'ss_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'default' => 'screenshots/default_screenshot.png'
            ),
            'ss_thumb_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '512',
                'default' => 'screenshots/thumbnails/default_thumbnail.png'
            ),
            'ss_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '512'
            ),
            'ss_type_id' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'vg_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE
            ),
            'ss_width' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE,
                'default' => '854'
            ),
            'ss_height' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE,
                'default' => '480'
            ),
            'ss_img_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => TRUE,
                'default' => 'image/png'
            ),
            'ss_thumb_width' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'null' => TRUE,
                'default' => '854'
            ),
            'ss_thumb_height' => array(
                'type' => 'INT',
                'constraint' => '64',
                'unsigned' => TRUE,
                'null' => TRUE,
                'default' => '480'
            ),
            'date_added' => array(
                'type' => 'DATETIME'
            ),
            'last_updated' => array(
                'type' => 'TIMESTAMP'
            )
        );
        $this->dbforge->add_field($screenshot);
        $this->dbforge->add_key('ss_id', TRUE);
        if($this->dbforge->create_table('screenshot', TRUE))
        {
            echo '<div><small>Screenshot</small></div>';
        }

        // --- screenshot type ---
        $this->dbforge->drop_table('screenshot_type', TRUE);
        $screenshot_type = array(
            'ss_type_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ss_type_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20'
            ),
            'ss_type_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '128'
            ),
            'date_added' => array(
                'type' => 'DATETIME'
            ),
            'last_updated' => array(
                'type' => 'TIMESTAMP'
            )
        );
        $this->dbforge->add_field($screenshot_type);
        $this->dbforge->add_key('ss_type_id', TRUE);
        if($this->dbforge->create_table('screenshot_type', TRUE))
        {
            echo '<div><small>Screenshot Type</small></div>';
        }

        echo '<hr/>';
	}
	
	private function _script_drop_tables()
	{
		echo '<h1>Dropping Tables ...</h1>';

		if($this->dbforge->drop_table('user', TRUE))
		{
			echo '<div><small>User</small></div>';
		}

		if($this->dbforge->drop_table('user_log', TRUE))
		{
			echo '<div><small>User Log</small></div>';
		}

		if($this->dbforge->drop_table('videogames', TRUE))
		{
			echo '<div><small>Videogames</small></div>';
		}

		if($this->dbforge->drop_table('game_genre', TRUE))
		{
			echo '<div><small>Game Genre</small></div>';
		}

		if($this->dbforge->drop_table('game_platform', TRUE))
		{
			echo '<div><small>Game Platform</small></div>';
		}

		if($this->dbforge->drop_table('screenshot', TRUE))
		{
			echo '<div><small>Screenshot</small></div>';
		}

		if($this->dbforge->drop_table('screenshot_type', TRUE))
		{
			echo '<div><small>Screenshot Type</small></div>';
		}
        echo '<hr/>';
	}
	
	private function _generate_users()
	{
        echo '<h1>Generate Users</h1>';
		$this->load->model('User_log_model');
		$this->load->model('User_model');
		$users = array(
			array(
                'username' => 'admin',
                'name' => 'Default Admin',
                'password_hash' => password_hash('password', PASSWORD_DEFAULT),
                'avatar_url' => NULL,
                'access' => 'A',
                'status' => 'Active'
            )
		);

        foreach($users as $user)
        {
            $insert_id = $this->User_model->insert($user);
            echo '<p><small>User (' . $insert_id . ', ' . $user['username'] . ')</small></p>';
        }
        echo '<hr/>';
	}
	
} // end 20161031210023_initial_setup class