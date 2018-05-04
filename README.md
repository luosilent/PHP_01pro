# PHP_01pro


## 功能如下

<li>任务管理</li>
<li>订餐管理</li>

## 数据库
<em>MySQL PDO连接数据库</em>
</pre>
<pre><code>

CREATE DATABASE `dtest`;

CREATE TABLE IF NOT EXISTS `luo_prousers` (
    `id` int(11) unsigned NOT NULL auto_increment,
    `username` varchar(24) NOT NULL DEFAULT '',
    `password` varchar(20) NOT NULL DEFAULT '',
    `depart_id` int(11) NOT NULL DEFAULT '0',
    `role` varchar(10) NOT NULL DEFAULT '',
    `create_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY  (`id`),
    UNIQUE KEY (`username`),
    index(`depart_id`)
) ENGINE=Innodb  DEFAULT CHARSET=utf8 ;

INSERT INTO `luo_prousers` (`id`, `username`, `password`, `depart_id`, `role`, `create_time`) VALUES
('1', 'luoyi', 'test', '2', 'admin', '2018-04-23 00:00:00');

CREATE TABLE IF NOT EXISTS `luo_prodepart` (
    `id` int(11) unsigned NOT NULL auto_increment,
    `depart_name` varchar(32) NOT NULL default '',
    PRIMARY KEY  (`id`)
) ENGINE=Innodb  DEFAULT CHARSET=utf8 ;

INSERT INTO `luo_prodepart` (depart_name)VALUES('开发部'),('运维部'),('销售部'),('后勤部');

CREATE TABLE IF NOT EXISTS `luo_project` (
    `id` int(11) unsigned NOT NULL auto_increment,
    `uid` int(11) unsigned NOT NULL default '0',
    `number` char(16)  NOT NULL default '0',
    `date` date NOT NULL default '0000-00-00',
    `depart_id` int(11) NOT NULL DEFAULT '0',
    `name` varchar(250) NOT NULL DEFAULT '',
    `username` varchar(24) NOT NULL DEFAULT '',
    `end_time` date NOT NULL DEFAULT '0000-00-00',
    `content` text NOT NULL ,
    `depart_gm` varchar(24) NOT NULL DEFAULT '',
    `check_username` varchar(24) NOT NULL DEFAULT '',
    `create_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY  (`id`),
    index(`uid`),
    index(`date`),
    index(`create_time`)
) ENGINE=Innodb  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `luo_record` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `create_time` datetime NOT NULL default '0000-00-00 00:00:00',
  index(uid),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

</code></pre>
