DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
	`id` varchar(40) NOT NULL,
	`ip_address` varchar(45) NOT NULL,
	`timestamp` int(10) unsigned NOT NULL DEFAULT '0',
	`data` blob NOT NULL,
	KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `screenshots`;
CREATE TABLE IF NOT EXISTS `screenshots` (
	`ss_id` INT NOT NULL AUTO_INCREMENT,
	`ss_name` VARCHAR(512) NOT NULL DEFAULT "Screenshot Name",
	`ss_url` VARCHAR(512) NOT NULL DEFAULT 'screenshots/default_screenshot.png',
	`ss_thumb_url` VARCHAR(512) NOT NULL DEFAULT 'screenshots/thumbnails/default_thumbnail.png',
	`ss_description` VARCHAR(512) NOT NULL,
	`ss_type_id` INT NOT NULL,
	`vg_id` INT NOT NULL,
	`ss_width` INT NULL UNSIGNED DEFAULT '854',
	`ss_height` INT NULL UNSIGNED DEFAULT '480',
	`ss_img_type` VARCHAR(64) NULL DEFAULT 'image/png',
	`ss_thumb_width` INT NULL UNSIGNED DEFAULT '854',
	`ss_thumb_height` INT NULL UNSIGNED DEFAULT '480',
	`ss_thumb_img_type` VARCHAR(64) NULL DEFAULT 'image/png',
	`date_added` DATETIME NOT NULL,
	`last_updated` TIMESTAMP NOT NULL,
	
	PRIMARY KEY(`ss_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `screenshot_type`;
CREATE TABLE IF NOT EXISTS `screenshot_type` (
	`ss_type_id` INT NOT NULL AUTO_INCREMENT,
	`ss_type_name` VARCHAR(20) NOT NULL,
	`ss_type_description` VARCHAR(128) NOT NULL,
	`date_added` DATETIME NOT NULL,
	`last_updated` TIMESTAMP NOT NULL,
	
	PRIMARY KEY(`ss_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;