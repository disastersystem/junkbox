<?php
/**
 * Handles setting up the database and all its tables.
 */
class DBSetup
{
	private $db_instance = null;

	public function __construct() {
		$this->db_instance = Database::instance();
	}

	public function first() {
		// todo: show mysql username and password prompt if database isn't set up
	}

	public function create() {
		$password = '$2y$10$Dy5tG3IIvDwwC2qNKjoj0eXvW2Yf5rmEtC.SJUtfRV3jm3VG/bU6C';
		$this->db_instance->run_query("
		    CREATE DATABASE IF NOT EXISTS educational_videos;
		    USE educational_videos;

			CREATE TABLE IF NOT EXISTS `playlists` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(250) NOT NULL,
			  `description` text NOT NULL,
			  `user_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `playlist_videos` (
			  `playlist_id` int(11) NOT NULL DEFAULT '0',
			  `video_id` int(11) NOT NULL DEFAULT '0',
			  `sort_order` int(11) NOT NULL,
			  PRIMARY KEY (`playlist_id`,`video_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			CREATE TABLE IF NOT EXISTS `transcripts` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `video_id` int(11) NOT NULL,
			  `src` varchar(100) NOT NULL,
			  `srclang` varchar(20) NOT NULL,
			  `type` varchar(10) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

			CREATE TABLE IF NOT EXISTS `users` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `email` varchar(250) NOT NULL,
			  `passphrase` varchar(100) NOT NULL,
			  `joined` date NOT NULL,
			  `permissions` tinyint(1) NOT NULL COMMENT '1=Normal user 2=Admin user',
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

			INSERT INTO `users` (`id`, `email`, `passphrase`, `joined`, `permissions`) VALUES
			(7, 'admin@admin.com', '{$password}', '2016-03-03', 2);

			CREATE TABLE IF NOT EXISTS `videos` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `src` varchar(100) NOT NULL,
			  `type` varchar(10) NOT NULL,
			  `title` varchar(200) NOT NULL,
			  `user_id` int(11) NOT NULL,
			  `uploaded` date NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		");
	}

}

?>
