DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
	`id` VARCHAR(40) NOT NULL,
	`ip_address` VARCHAR(45) NOT NULL,
	`timestamp` INT(10) unsigned NOT NULL DEFAULT '0',
	`data` BLOB NOT NULL,
	KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
	`user_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(512) NOT NULL,
	`password_hash` VARCHAR(512) NOT NULL,
	`name` VARCHAR(512) DEFAULT NULL,
	`avatar_url` VARCHAR(512) NULL DEFAULT 'admin_avatar / default_avatar.png',
	`access` VARCHAR(512) NOT NULL,
	`status` VARCHAR(30) NOT NULL,
	`last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` (
	`ulid` INT(11) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) unsigned NOT NULL,
	`message` TEXT NOT NULL,
	`timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`ulid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `videogames`;
CREATE TABLE IF NOT EXISTS `videogames` (
	`vg_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
	`vg_name` VARCHAR(64) NULL,
	`vg_abbr` VARCHAR(64) NOT NULL,
	`genre_id` INT(11) unsigned NULL,
	`platform_id` INT(11) unsigned NULL,
	`date_purchased` DATE NULL,
	`from_steam` INT(11) NOT NULL,
	`date_added` DATETIME NOT NULL,
	`last_updated` TIMESTAMP NOT NULL,
	
	PRIMARY KEY(`vg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `game_genre`;
CREATE TABLE IF NOT EXISTS `game_genre` (
	`genre_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
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
	`platform_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
	`platform_name` VARCHAR(64) NOT NULL,
	`year_intro` INT(11) NOT NULL,
	`platform_developer` VARCHAR(128) NOT NULL,
	`platform_logo_url` VARCHAR(256) NOT NULL,
	`platform_abbr` VARCHAR(16) NOT NULL,
	`platform_logo_col` VARCHAR(6) NOT NULL,
	`date_added` DATETIME NOT NULL,
	`last_updated` TIMESTAMP NOT NULL,
	
	PRIMARY KEY(`platform_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `screenshot`;
CREATE TABLE IF NOT EXISTS `screenshot` (
	`ss_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
	`ss_name` VARCHAR(512) NOT NULL DEFAULT "Screenshot Name",
	`ss_url` VARCHAR(512) NOT NULL DEFAULT 'screenshots/default_screenshot.png',
	`ss_thumb_url` VARCHAR(512) NOT NULL DEFAULT 'screenshots/thumbnails/default_thumbnail.png',
	`ss_description` VARCHAR(512) NOT NULL,
	`ss_type_id` INT(11) NOT NULL,
	`vg_id` INT(11) unsigned NOT NULL,
	`ss_width` INT(11) unsigned NULL DEFAULT '854',
	`ss_height` INT(11) unsigned NULL DEFAULT '480',
	`ss_img_type` VARCHAR(64) NULL DEFAULT 'image/png',
	`ss_thumb_width` INT(11) unsigned NULL DEFAULT '854',
	`ss_thumb_height` INT(11) unsigned NULL DEFAULT '480',
	`ss_thumb_img_type` VARCHAR(64) NULL DEFAULT 'image/png',
	`date_added` DATETIME NOT NULL,
	`last_updated` TIMESTAMP NOT NULL,
	
	PRIMARY KEY(`ss_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `screenshot_type`;
CREATE TABLE IF NOT EXISTS `screenshot_type` (
	`ss_type_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
	`ss_type_name` VARCHAR(20) NOT NULL,
	`ss_type_description` VARCHAR(128) NOT NULL,
	`date_added` DATETIME NOT NULL,
	`last_updated` TIMESTAMP NOT NULL,
	
	PRIMARY KEY(`ss_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;