CREATE TABLE `todolist` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `level` tinyint(1) NOT NULL default '0',
  `short` varchar(255) NOT NULL default '',
  `long` text NOT NULL,
  `created` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
