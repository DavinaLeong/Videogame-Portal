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
		if($this->db->query($this->_script_create_tables()))
		{
			echo '<p>Tables created.</p>';
			echo '<hr/>';
			$this->_generate_users();
		}
		else
		{
			echo '<p>Failed to create Tables.</p>';
			echo '<hr/>';
		}
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
		return "
			DROP TABLE IF EXISTS `ci_sessions`;
			CREATE TABLE IF NOT EXISTS `ci_sessions` (
				`id` varchar(40) NOT NULL,
				`ip_address` varchar(45) NOT NULL,
				`timestamp` int(10) unsigned NOT NULL DEFAULT '0',
				`data` blob NOT NULL,
				KEY `ci_sessions_timestamp` (`timestamp`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			DROP TABLE IF EXISTS `user`;
            CREATE TABLE IF NOT EXISTS `user` (
              `user_id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(512) NOT NULL,
              `password_hash` varchar(512) NOT NULL,
              `name` varchar(512) DEFAULT NULL,
              `image_filename` varchar(512) DEFAULT NULL,
              `image_width` varchar(5) DEFAULT NULL,
              `image_height` varchar(5) DEFAULT NULL,
              `image_filetype` varchar(5) DEFAULT NULL,
              `access` varchar(512) NOT NULL,
              `status` varchar(30) NOT NULL,
              `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`user_id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

            DROP TABLE IF EXISTS `user_log`;
            CREATE TABLE IF NOT EXISTS `user_log` (
              `ulid` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `message` text NOT NULL,
              `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`ulid`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
			
			DROP TABLE IF EXISTS `videogames`;
			CREATE TABLE IF NOT EXISTS `videogames` (
				`vg_id` INT NOT NULL AUTO_INCREMENT,
				`vg_name` VARCHAR(64) NULL,
				`vg_abbr` VARCHAR(64) NOT NULL,
				`genre_id` INT NULL,
				`platform_id` INT NULL,
				`date_purchased` DATE NULL,
				`from_steam` INT NOT NULL,
				`date_added` DATETIME NOT NULL,
				`last_updated` TIMESTAMP NOT NULL,
				
				PRIMARY KEY(`vg_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
			
			DROP TABLE IF EXISTS `game_genre`;
			CREATE TABLE IF NOT EXISTS `game_genre` (
				`genre_id` INT NOT NULL AUTO_INCREMENT,
				`genre_name` VARCHAR(32) NOT NULL,
				`genre_abbr` VARCHAR(32) NULL,
				`genre_description` VARCHAR(512) NULL,
				`genre_label_col` VARCHAR(6) NULL,
				`date_added` DATETIME NOT NULL,
				`last_updated` TIMESTAMP NOT NULL,
				
				PRIMARY KEY(`genre_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
			
			DROP TABLE IF EXISTS `game_platform`;
			CREATE TABLE IF NOT EXISTS `game_platform` (
				`platform_id` INT NOT NULL AUTO_INCREMENT,
				`platform_name` VARCHAR(64) NOT NULL,
				`year_intro` INT NOT NULL,
				`platform_developer` VARCHAR(128) NOT NULL,
				`platform_logo_url` VARCHAR(256) NOT NULL,
				`platform_abbr` VARCHAR(16) NOT NULL,
				`platform_logo_col` VARCHAR(6) NOT NULL,
				`date_added` DATETIME NOT NULL,
				`last_updated` TIMESTAMP NOT NULL,
				
				PRIMARY KEY(`platform_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
			
			DROP TABLE IF EXISTS `screenshots`;
			CREATE TABLE IF NOT EXISTS `screenshots` (
				`ss_id` INT NOT NULL AUTO_INCREMENT,
				`ss_name` VARCHAR(512) NOT NULL DEFAULT \"Screenshot Name\",
				`ss_url` VARCHAR(512) NOT NULL DEFAULT 'screenshots/default_screenshot.png',
				`ss_thumb_url` VARCHAR(512) NOT NULL DEFAULT 'screenshots/thumbnails/default_thumbnail.png',
				`ss_description` VARCHAR(512) NOT NULL,
				`ss_type_id` INT NOT NULL,
				`vg_id` INT NOT NULL,
				`ss_width` INT NULL unsigned DEFAULT '854',
				`ss_height` INT NULL unsigned DEFAULT '480',
				`ss_img_type` VARCHAR(64) NULL DEFAULT 'image/png',
				`ss_thumb_width` INT NULL unsigned DEFAULT '854',
				`ss_thumb_height` INT NULL unsigned DEFAULT '480',
				`ss_thumb_img_type` VARCHAR(64) NULL DEFAULT 'image/png',
				`date_added` DATETIME NOT NULL,
				`last_updated` TIMESTAMP NOT NULL,
				
				PRIMARY KEY(`ss_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
			
			DROP TABLE IF EXISTS `screenshot_type`;
			CREATE TABLE IF NOT EXISTS `screenshot_type` (
				`ss_type_id` INT NOT NULL AUTO_INCREMENT,
				`ss_type_name` VARCHAR(20) NOT NULL,
				`ss_type_description` VARCHAR(128) NOT NULL,
				`date_added` DATETIME NOT NULL,
				`last_updated` TIMESTAMP NOT NULL,
				
				PRIMARY KEY(`ss_type_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		";
	}
	
	private function _script_drop_tables()
	{
		return "
			DROP TABLE IF EXISTS `user`;

			DROP TABLE IF EXISTS `user_log`;

			DROP TABLE IF EXISTS `videogames`;

			DROP TABLE IF EXISTS `game_genre`;
			
			DROP TABLE IF EXISTS `game_platform`;
			
			DROP TABLE IF EXISTS `screenshots`;
			
			DROP TABLE IF EXISTS `screenshot_type`;
		";
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