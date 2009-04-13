Rubberduck TODO
===============

Preface
-------

This project has not been under active development for sometime now.

Ok this is kinda beta software, although there wasnt much to test and I did not
find bugs so I  guess it works :)

Introduction
------------

This piece of software is called Rubberduck! Its part of the PowerAdmin project
which can be found at <http://www.poweradmin.org>. Rubberduck is licensed under the GPL 
but if you rip anything off.. just be so nice to mention my name.. we all want 
a bit of fame dont we?

Installation
------------

Ok what do you have to do install it? Easy, fire up your favourite editor and
open inc/config.inc.php and toy ahead with the variables. Dont touch the MySQL
(yet) because we only support, well counted, _ONE_ backend! Woah!

After that smack the rubberduck.sql into MySQL. If you dont like .sql files, 
here is the syntax:

>CREATE TABLE `todolist` (
>  `id` int(11) unsigned NOT NULL auto_increment,
>  `level` tinyint(1) NOT NULL default '0',
>  `short` varchar(255) NOT NULL default '',
>  `long` text NOT NULL,
>  `created` int(11) NOT NULL default '0',
>  PRIMARY KEY  (`id`)
>) TYPE=MyISAM;

Credits
-------

+ Roeland Nieuwenhuis - *Trancer @ IRCNet - PowerAdmin project maintainer*
+ Nicholas Penree - * drudge @ FreeNode - PowerAdmin user*
