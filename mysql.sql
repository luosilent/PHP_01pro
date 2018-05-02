//用户基本跟订餐一样,但是存储引擎用了innodb编码用了utf8
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

//部门上面一样不过为了区分还是创建了表
CREATE TABLE IF NOT EXISTS `luo_prodepart` (
    `id` int(11) unsigned NOT NULL auto_increment,
    `depart_name` varchar(32) NOT NULL default '',
    PRIMARY KEY  (`id`)
) ENGINE=Innodb  DEFAULT CHARSET=utf8 ;

INSERT INTO `luo_prodepart` (depart_name)VALUES('开发部'),('运维部'),('一部'),('二部');


//任务表单,字段名称可以整理一下
-- uid：创建者的id
-- number：编号应该插入的时候根据之前的进行判断,uid创建的id
-- date:创建日期，其实可以省略，直接查创建时间
-- depart_id:部门id
-- name:项目名称
-- username:项目负责人
-- end_time:预计完成日期
-- content:项目内容
-- depart_gm:部门经理
-- check_username:审核人
-- create_time:创建时间
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