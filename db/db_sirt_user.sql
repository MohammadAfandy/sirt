/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - db_sirt_user
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sirt_user` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_sirt_user`;

/*Table structure for table `tbl_auth_assignment` */

DROP TABLE IF EXISTS `tbl_auth_assignment`;

CREATE TABLE `tbl_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `tbl_idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_assignment` */

insert  into `tbl_auth_assignment`(`item_name`,`user_id`,`created_at`) values ('admin-role','5',1552141559);

/*Table structure for table `tbl_auth_item` */

DROP TABLE IF EXISTS `tbl_auth_item`;

CREATE TABLE `tbl_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `tbl_idx-auth_item-type` (`type`),
  CONSTRAINT `tbl_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `tbl_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_item` */

insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/assignment/*',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/assignment/assign',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/assignment/index',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/assignment/revoke',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/assignment/view',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/default/*',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/default/index',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/menu/*',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/menu/create',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/menu/delete',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/menu/index',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/menu/update',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/menu/view',2,NULL,NULL,NULL,1552141413,1552141413);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/*',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/assign',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/create',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/delete',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/index',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/remove',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/update',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/permission/view',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/*',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/assign',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/create',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/delete',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/index',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/remove',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/update',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/role/view',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/route/*',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/route/assign',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/route/create',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/route/index',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/route/refresh',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/route/remove',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/rule/*',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/rule/create',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/rule/delete',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/rule/index',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/rule/update',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/admin/rule/view',2,NULL,NULL,NULL,1552141414,1552141414);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/*',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/default/*',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/default/db-explain',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/default/download-mail',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/default/index',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/default/toolbar',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/default/view',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/user/*',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/user/reset-identity',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/debug/user/set-identity',2,NULL,NULL,NULL,1552141415,1552141415);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/*',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/default/*',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/default/action',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/default/diff',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/default/index',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/default/preview',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/gii/default/view',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/rt/*',2,NULL,NULL,NULL,1552210730,1552210730);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/rt/create',2,NULL,NULL,NULL,1552210730,1552210730);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/rt/delete',2,NULL,NULL,NULL,1552210730,1552210730);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/rt/index',2,NULL,NULL,NULL,1552210730,1552210730);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/rt/update',2,NULL,NULL,NULL,1552210730,1552210730);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/rt/view',2,NULL,NULL,NULL,1552210730,1552210730);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/*',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/about',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/captcha',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/contact',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/error',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/index',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/login',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/site/logout',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/*',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/change-password',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/create',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/delete',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/index',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/update',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/user/view',2,NULL,NULL,NULL,1552141416,1552141416);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/warga/*',2,NULL,NULL,NULL,1552145239,1552145239);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/warga/create',2,NULL,NULL,NULL,1552145239,1552145239);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/warga/delete',2,NULL,NULL,NULL,1552145239,1552145239);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/warga/index',2,NULL,NULL,NULL,1552145238,1552145238);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/warga/update',2,NULL,NULL,NULL,1552145239,1552145239);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/warga/view',2,NULL,NULL,NULL,1552145239,1552145239);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('admin-permission',2,'Permission for Admin',NULL,NULL,1552141461,1552141461);
insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('admin-role',1,'Role for admin',NULL,NULL,1552141553,1552141553);

/*Table structure for table `tbl_auth_item_child` */

DROP TABLE IF EXISTS `tbl_auth_item_child`;

CREATE TABLE `tbl_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_item_child` */

insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/assignment/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/default/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/menu/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/permission/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/role/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/route/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/admin/rule/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/rt/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/site/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/user/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-permission','/warga/*');
insert  into `tbl_auth_item_child`(`parent`,`child`) values ('admin-role','admin-permission');

/*Table structure for table `tbl_auth_rule` */

DROP TABLE IF EXISTS `tbl_auth_rule`;

CREATE TABLE `tbl_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_rule` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
