/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 5.6.26 : Database - wm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wm_amp_bopoy` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `wm_amp_bopoy`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `article_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) DEFAULT NULL,
  `article_detail` text,
  `article_type_id` int(5) DEFAULT NULL,
  `article_date` datetime DEFAULT NULL,
  `article_who` int(5) DEFAULT NULL,
  `article_active` varchar(1) DEFAULT 'Y',
  `article_read_count` int(5) DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `article_title` (`article_title`),
  KEY `article_type_id` (`article_type_id`),
  KEY `article_date` (`article_date`),
  KEY `article_who` (`article_who`),
  KEY `article_read_count` (`article_read_count`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `article_type` */

DROP TABLE IF EXISTS `article_type`;

CREATE TABLE `article_type` (
  `article_type_id` int(5) NOT NULL AUTO_INCREMENT,
  `article_type_title` varchar(255) DEFAULT NULL,
  `article_type_active` varchar(1) DEFAULT 'Y',
  PRIMARY KEY (`article_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=tis620;

/*Table structure for table `cage` */

DROP TABLE IF EXISTS `cage`;

CREATE TABLE `cage` (
  `age` int(3) NOT NULL,
  `groupcode190` int(3) DEFAULT NULL,
  `groupname190` varchar(255) DEFAULT NULL,
  `groupcode1560` int(3) DEFAULT NULL,
  `groupname1560` varchar(255) DEFAULT NULL,
  `groupcode060` int(3) DEFAULT NULL,
  `groupname060` varchar(255) DEFAULT NULL,
  `groupcode3560` int(3) DEFAULT NULL,
  `groupname3560` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`age`),
  KEY `idx_st_en` (`age`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cagegroup` */

DROP TABLE IF EXISTS `cagegroup`;

CREATE TABLE `cagegroup` (
  `groupcode` int(2) NOT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `startage` int(2) NOT NULL,
  `endage` int(3) NOT NULL,
  PRIMARY KEY (`groupcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `campur` */

DROP TABLE IF EXISTS `campur`;

CREATE TABLE `campur` (
  `ampurcode` varchar(2) NOT NULL,
  `ampurname` varchar(255) DEFAULT NULL,
  `ampurcodefull` varchar(4) NOT NULL,
  `changwatcode` varchar(2) NOT NULL,
  `flag_status` char(1) DEFAULT '0' COMMENT 'สถานนะของพื้นที่ 0=ปกติ 1=เลิกใช้(แยก/ย้ายไปพื้นที่อื่น)',
  PRIMARY KEY (`ampurcode`,`ampurcodefull`,`changwatcode`),
  KEY `idx1` (`ampurcodefull`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cchangwat` */

DROP TABLE IF EXISTS `cchangwat`;

CREATE TABLE `cchangwat` (
  `changwatcode` varchar(2) NOT NULL,
  `changwatname` varchar(255) DEFAULT NULL,
  `zonecode` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cchronic` */

DROP TABLE IF EXISTS `cchronic`;

CREATE TABLE `cchronic` (
  `id_chronic` varchar(6) NOT NULL,
  `echronic` varchar(255) NOT NULL,
  `tchronic` varchar(255) NOT NULL,
  PRIMARY KEY (`id_chronic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cdisease504` */

DROP TABLE IF EXISTS `cdisease504`;

CREATE TABLE `cdisease504` (
  `group504code` varchar(2) NOT NULL,
  `group504name` varchar(255) DEFAULT NULL,
  `group504nameeng` varchar(255) DEFAULT NULL,
  `group504icd10interval` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`group504code`),
  KEY `idx` (`group504code`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cdisease505` */

DROP TABLE IF EXISTS `cdisease505`;

CREATE TABLE `cdisease505` (
  `groupcode` varchar(2) NOT NULL DEFAULT '',
  `groupname` varchar(255) DEFAULT NULL,
  `groupname_en` varchar(200) DEFAULT NULL,
  `diseasecodeinterval` varchar(150) DEFAULT NULL,
  `reportgrp` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`groupcode`),
  KEY `reportgrp` (`reportgrp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cdisease506` */

DROP TABLE IF EXISTS `cdisease506`;

CREATE TABLE `cdisease506` (
  `group506code` char(2) NOT NULL DEFAULT '',
  `group506name` varchar(255) DEFAULT NULL,
  `group506icd10interval` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`group506code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cdrug_asu` */

DROP TABLE IF EXISTS `cdrug_asu`;

CREATE TABLE `cdrug_asu` (
  `drugcode` varchar(19) NOT NULL,
  `drugname` varchar(255) DEFAULT NULL,
  `STRENGTH` varchar(255) DEFAULT NULL,
  `dosage_form` varchar(255) DEFAULT NULL,
  `Subcom` varchar(255) DEFAULT NULL,
  `ed_group_01` varchar(255) DEFAULT NULL,
  `ed_group_02` varchar(255) DEFAULT NULL,
  `ed_group_03` varchar(255) DEFAULT NULL,
  `ed_group_04` varchar(255) DEFAULT NULL,
  `ed_group_05` varchar(255) DEFAULT NULL,
  `expr1` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`drugcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cgroup298disease` */

DROP TABLE IF EXISTS `cgroup298disease`;

CREATE TABLE `cgroup298disease` (
  `cgroup_id` varchar(3) NOT NULL,
  `icd10` varchar(250) DEFAULT NULL,
  `cgroup` varchar(5) DEFAULT NULL,
  `e_name` varchar(200) DEFAULT NULL,
  `t_name` varchar(200) DEFAULT NULL,
  `showrp` varchar(1) DEFAULT '1',
  PRIMARY KEY (`cgroup_id`),
  KEY `idx1` (`cgroup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `chospcode` */

DROP TABLE IF EXISTS `chospcode`;

CREATE TABLE `chospcode` (
  `hospcode` varchar(5) NOT NULL,
  `hospname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hospcode`),
  KEY `idx` (`hospcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `chospital` */

DROP TABLE IF EXISTS `chospital`;

CREATE TABLE `chospital` (
  `hoscode` char(5) NOT NULL DEFAULT '',
  `hosname` varchar(255) DEFAULT NULL,
  `hostype` char(2) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `road` varchar(50) DEFAULT NULL,
  `mu` varchar(2) DEFAULT NULL,
  `subdistcode` char(2) DEFAULT NULL,
  `distcode` char(2) DEFAULT NULL,
  `provcode` char(2) DEFAULT NULL,
  `postcode` char(5) DEFAULT NULL,
  `hoscodenew` char(9) DEFAULT NULL,
  `bed` char(5) DEFAULT '0' COMMENT 'จำนวนเตียง',
  `level_service` varchar(255) DEFAULT NULL COMMENT 'ระดับการบริการ',
  `bedhos` char(5) DEFAULT NULL,
  `hdc_regist` int(1) DEFAULT '0',
  PRIMARY KEY (`hoscode`),
  KEY `provcode` (`provcode`) USING BTREE,
  KEY `zipcode` (`postcode`) USING BTREE,
  KEY `changwatcode` (`provcode`,`distcode`,`subdistcode`,`hoscode`) USING BTREE,
  KEY `hoscode` (`hoscode`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `chostype` */

DROP TABLE IF EXISTS `chostype`;

CREATE TABLE `chostype` (
  `hostypecode` char(2) NOT NULL DEFAULT '' COMMENT 'รหัสประเภทสถานบริการ',
  `hostypename` varchar(255) DEFAULT NULL COMMENT 'ขื่อประเภทสถานบริการ',
  PRIMARY KEY (`hostypecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cicd21group` */

DROP TABLE IF EXISTS `cicd21group`;

CREATE TABLE `cicd21group` (
  `diag_21group` varchar(2) NOT NULL,
  `diagcode` varchar(6) NOT NULL,
  `diagename` varchar(255) NOT NULL,
  `diagtname` varchar(255) NOT NULL,
  PRIMARY KEY (`diag_21group`,`diagcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cicd298group` */

DROP TABLE IF EXISTS `cicd298group`;

CREATE TABLE `cicd298group` (
  `groupcode298` varchar(10) NOT NULL DEFAULT '',
  `icd10` varchar(20) NOT NULL DEFAULT '',
  `diagnameeng` varchar(255) DEFAULT NULL,
  `diagnamethai` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`groupcode298`,`icd10`),
  KEY `idx_298` (`icd10`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `clabtest_new` */

DROP TABLE IF EXISTS `clabtest_new`;

CREATE TABLE `clabtest_new` (
  `code` varchar(10) NOT NULL,
  `EN` varchar(255) DEFAULT NULL,
  `TH` varchar(255) DEFAULT NULL,
  `old_code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `code` (`code`),
  KEY `old_code` (`old_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cmastercup` */

DROP TABLE IF EXISTS `cmastercup`;

CREATE TABLE `cmastercup` (
  `oid` int(11) NOT NULL,
  `province_id` varchar(9) DEFAULT NULL COMMENT 'จังหวัด',
  `hospcode5` varchar(13) DEFAULT NULL,
  `hmain` varchar(13) DEFAULT NULL COMMENT 'แม่ข่าย',
  `hsub` varchar(13) NOT NULL COMMENT 'ลูกข่าย',
  `hmainname` varchar(255) DEFAULT NULL COMMENT 'ชื่อแม่ข่าย',
  `hmaintype` varchar(13) DEFAULT NULL COMMENT 'ประเภทโรงพยาบาลแม่ข่าย',
  `d_update` varchar(18) DEFAULT NULL,
  `changwatcode` varchar(13) DEFAULT NULL,
  `changwatname` varchar(255) DEFAULT NULL,
  `ampurcode` varchar(13) DEFAULT NULL,
  `ampurname` varchar(255) DEFAULT NULL,
  `tamboncode` varchar(13) DEFAULT NULL,
  `tambonname` varchar(255) DEFAULT NULL,
  `villagecode` varchar(13) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `address` varchar(13) DEFAULT NULL,
  `postcode` varchar(13) DEFAULT NULL,
  `catma` varchar(255) DEFAULT NULL,
  `catm` varchar(18) DEFAULT NULL,
  `datecancelcode` varchar(18) DEFAULT NULL,
  `edit_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hospcode9` varchar(13) DEFAULT NULL,
  `is_pcu` char(1) DEFAULT 'Y',
  `area_code` varchar(12) DEFAULT NULL,
  `hsubname` varchar(255) NOT NULL,
  PRIMARY KEY (`hsub`),
  KEY `HOSCODE5` (`hospcode9`) USING BTREE,
  KEY `IS_PCU` (`is_pcu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `colorchart` */

DROP TABLE IF EXISTS `colorchart`;

CREATE TABLE `colorchart` (
  `id` int(5) NOT NULL,
  `has` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `chronic` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `sex` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `smoke` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `bp` int(3) DEFAULT NULL,
  `cholesterol` int(3) DEFAULT NULL,
  `color` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chronic` (`chronic`,`sex`,`age`,`smoke`,`bp`,`cholesterol`,`color`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `colorchart_th` */

DROP TABLE IF EXISTS `colorchart_th`;

CREATE TABLE `colorchart_th` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `has` varchar(1) DEFAULT NULL,
  `chronic` varchar(1) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `smoke` varchar(1) DEFAULT NULL,
  `bp` int(3) DEFAULT NULL,
  `cholesterol` int(3) DEFAULT NULL,
  `wh_2` varchar(1) DEFAULT NULL,
  `color` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1281 DEFAULT CHARSET=utf8;

/*Table structure for table `ctambon` */

DROP TABLE IF EXISTS `ctambon`;

CREATE TABLE `ctambon` (
  `tamboncode` varchar(2) NOT NULL,
  `tambonname` varchar(255) DEFAULT NULL,
  `tamboncodefull` varchar(6) NOT NULL,
  `ampurcode` varchar(4) NOT NULL,
  `changwatcode` varchar(2) NOT NULL,
  `flag_status` char(1) DEFAULT '0' COMMENT 'สถานนะของพื้นที่ 0=ปกติ 1=เลิกใช้(แยก/ย้ายไปพื้นที่อื่น)',
  PRIMARY KEY (`tamboncode`,`tamboncodefull`,`ampurcode`,`changwatcode`),
  KEY `idx1` (`tamboncodefull`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `cvaccinetype` */

DROP TABLE IF EXISTS `cvaccinetype`;

CREATE TABLE `cvaccinetype` (
  `id_vaccinetype` varchar(3) NOT NULL,
  `vaccinecode` varchar(3) NOT NULL,
  `engvaccine` varchar(100) NOT NULL,
  `thvaccine` varchar(100) NOT NULL,
  `vaccinetype` varchar(10) NOT NULL,
  `vaccinefor` varchar(255) NOT NULL,
  `protect` varchar(255) NOT NULL,
  `vaccineicd10` varchar(50) NOT NULL,
  `outplan` varchar(1) NOT NULL,
  PRIMARY KEY (`id_vaccinetype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cwh_referen` */

DROP TABLE IF EXISTS `cwh_referen`;

CREATE TABLE `cwh_referen` (
  `age_low` int(10) unsigned NOT NULL,
  `age_max` int(10) unsigned NOT NULL,
  `sex` int(10) unsigned NOT NULL,
  `height` float(5,1) NOT NULL,
  `nutri_level` int(10) unsigned NOT NULL,
  `weight_low` float(5,1) NOT NULL,
  `weight_max` float(5,1) NOT NULL,
  PRIMARY KEY (`age_low`,`age_max`,`sex`,`height`,`nutri_level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `cwhpa_referen` */

DROP TABLE IF EXISTS `cwhpa_referen`;

CREATE TABLE `cwhpa_referen` (
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `sex` int(1) NOT NULL,
  `nutri_level` int(1) NOT NULL,
  `nutri_type` int(1) NOT NULL,
  `low` float(5,1) DEFAULT NULL,
  `hi` float(5,1) DEFAULT NULL,
  PRIMARY KEY (`year`,`month`,`sex`,`nutri_level`,`nutri_type`),
  KEY `low_hi` (`low`,`hi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hospcode` */

DROP TABLE IF EXISTS `hospcode`;

CREATE TABLE `hospcode` (
  `amppart` char(2) DEFAULT NULL,
  `chwpart` char(2) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `hosptype` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `tmbpart` char(2) DEFAULT NULL,
  `moopart` char(2) DEFAULT NULL,
  `sss_code` varchar(12) DEFAULT NULL,
  `sss_code_sub` varchar(12) DEFAULT NULL,
  `hospcode506` varchar(15) DEFAULT NULL,
  `addressid` char(6) DEFAULT NULL,
  PRIMARY KEY (`hospcode`),
  KEY `ix_amppart` (`amppart`),
  KEY `ix_chwpart` (`chwpart`),
  KEY `ix_hosptype` (`hosptype`),
  KEY `ix_sss` (`sss_code`),
  KEY `ix_name` (`name`),
  KEY `ix_tmbpart` (`tmbpart`),
  KEY `ix_tmbpart_amppart` (`tmbpart`,`amppart`,`chwpart`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `hospital_base_status` */

DROP TABLE IF EXISTS `hospital_base_status`;

CREATE TABLE `hospital_base_status` (
  `hbs_hospital_id` varchar(6) CHARACTER SET tis620 NOT NULL,
  `hbs_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hbs_ip` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_browser` varchar(255) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_info` varchar(255) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_secretkey` varchar(255) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_sync_start` datetime DEFAULT '0000-00-00 00:00:00',
  `hbs_sync_finish` datetime DEFAULT '0000-00-00 00:00:00',
  `hbs_status_process` varchar(10) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_error` varchar(255) DEFAULT NULL,
  `hbs_upload_size` double(12,2) DEFAULT NULL,
  `hbs_version` varchar(45) DEFAULT NULL,
  `hbs_sync` varchar(45) DEFAULT NULL,
  `hbs_update` varchar(45) DEFAULT NULL,
  `hbs_command` text,
  `hbs_db_version` varchar(255) DEFAULT NULL,
  `hbs_dlc_status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`hbs_hospital_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `icd10` */

DROP TABLE IF EXISTS `icd10`;

CREATE TABLE `icd10` (
  `code` varchar(7) CHARACTER SET tis620 NOT NULL DEFAULT '',
  `name` varchar(200) CHARACTER SET tis620 DEFAULT NULL,
  `spclty` char(2) CHARACTER SET tis620 DEFAULT NULL,
  `tname` varchar(150) CHARACTER SET tis620 DEFAULT NULL,
  `code3` char(3) CHARACTER SET tis620 DEFAULT NULL,
  `code4` char(1) CHARACTER SET tis620 DEFAULT NULL,
  `code5` char(1) CHARACTER SET tis620 DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `ipd_valid` char(1) CHARACTER SET tis620 DEFAULT NULL,
  `icd10compat` char(1) CHARACTER SET tis620 DEFAULT NULL,
  `icd10tmcompat` char(1) CHARACTER SET tis620 DEFAULT NULL,
  `active_status` char(1) CHARACTER SET tis620 DEFAULT NULL,
  `hos_guid` char(38) CHARACTER SET tis620 DEFAULT NULL,
  `hos_guid_ext` varchar(64) CHARACTER SET tis620 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `menu_group` */

DROP TABLE IF EXISTS `menu_group`;

CREATE TABLE `menu_group` (
  `menu_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `menu_group_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อกลุ่มเมนู',
  `menu_group_active` varchar(1) DEFAULT NULL COMMENT 'สถานะการใช้งาน',
  `menu_group_comment` text COMMENT 'หมายเหตุ',
  `menu_group_submenu` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Table structure for table `menu_items` */

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `menu_items_id` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `menu_items_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อเมนู',
  `menu_items_active` varchar(1) DEFAULT NULL COMMENT 'สถานะการใช้งาน',
  `menu_items_comment` text COMMENT 'หมายเหตุ',
  `menu_group_id` int(11) NOT NULL,
  `menu_items_url` varchar(255) DEFAULT NULL,
  `menu_items_sqlquery` text,
  `menu_items_columns` text,
  `menu_items_typeprocess` varchar(45) DEFAULT NULL,
  `menu_items_datasource` varchar(45) DEFAULT NULL,
  `menu_items_create` datetime DEFAULT NULL,
  `menu_items_update` datetime DEFAULT NULL,
  `menu_items_param` text,
  `menu_items_status` varchar(45) DEFAULT NULL,
  `menu_items_user_create` varchar(100) DEFAULT NULL,
  `menu_items_user_update` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`menu_items_id`),
  KEY `menu_group_id` (`menu_group_id`),
  FULLTEXT KEY `items_name` (`menu_items_name`),
  FULLTEXT KEY `menu_items_comment` (`menu_items_comment`)
) ENGINE=MyISAM AUTO_INCREMENT=437 DEFAULT CHARSET=utf8;

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_header` varchar(200) COLLATE utf8_bin NOT NULL,
  `news_detail` text COLLATE utf8_bin NOT NULL,
  `news_date` date NOT NULL,
  `news_count` int(11) DEFAULT '0',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`access_token`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_access_tokens_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_authorization_codes` */

DROP TABLE IF EXISTS `oauth_authorization_codes`;

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `redirect_uri` varchar(1000) NOT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_authorization_codes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `client_id` varchar(32) NOT NULL,
  `client_secret` varchar(32) DEFAULT NULL,
  `redirect_uri` varchar(1000) NOT NULL,
  `grant_types` varchar(100) NOT NULL,
  `scope` varchar(2000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_jwt` */

DROP TABLE IF EXISTS `oauth_jwt`;

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(32) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_public_keys` */

DROP TABLE IF EXISTS `oauth_public_keys`;

CREATE TABLE `oauth_public_keys` (
  `client_id` varchar(255) NOT NULL,
  `public_key` varchar(2000) DEFAULT NULL,
  `private_key` varchar(2000) DEFAULT NULL,
  `encryption_algorithm` varchar(100) DEFAULT 'RS256'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_refresh_tokens_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_scopes` */

DROP TABLE IF EXISTS `oauth_scopes`;

CREATE TABLE `oauth_scopes` (
  `scope` varchar(2000) NOT NULL,
  `is_default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `oauth_users` */

DROP TABLE IF EXISTS `oauth_users`;

CREATE TABLE `oauth_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(2000) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `pcu_hos_allow` */

DROP TABLE IF EXISTS `pcu_hos_allow`;

CREATE TABLE `pcu_hos_allow` (
  `hospcode` varchar(5) NOT NULL,
  `hospcode_cup` varchar(5) DEFAULT NULL,
  `hospcode_amp` varchar(5) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`hospcode`),
  KEY `hospcode_cup` (`hospcode_cup`),
  KEY `hospcode_amp` (`hospcode_amp`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `register_anc` */

DROP TABLE IF EXISTS `register_anc`;

CREATE TABLE `register_anc` (
  `cid` varchar(13) NOT NULL DEFAULT '',
  `person_name` varchar(50) DEFAULT NULL,
  `regplace` text,
  `register_date` text,
  `discharge` varchar(1) DEFAULT NULL,
  `typearea` text,
  `risk_list` text,
  `labor_status` text,
  `preg_no` varchar(3) NOT NULL,
  `bs1` text,
  `bs2` text,
  `bs3` text,
  `bs4` text,
  `bs5` text,
  `as1` text,
  `as2` text,
  `as3` text,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `idx` (`cid`,`preg_no`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_chronic` */

DROP TABLE IF EXISTS `report_chronic`;

CREATE TABLE `report_chronic` (
  `hospcode` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `date_diag` date DEFAULT NULL,
  `chronic` varchar(5) DEFAULT NULL,
  `hosp_dx` varchar(5) DEFAULT NULL,
  `hosp_rx` varchar(5) DEFAULT NULL,
  `date_disch` date DEFAULT NULL,
  `typedisch` varchar(2) CHARACTER SET utf8 DEFAULT '',
  KEY `idx_cid` (`cid`),
  KEY `idx_pid` (`pid`),
  KEY `idx_h` (`hospcode`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_chronic_opd_ipd` */

DROP TABLE IF EXISTS `report_chronic_opd_ipd`;

CREATE TABLE `report_chronic_opd_ipd` (
  `hospcode` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `date_diag` date DEFAULT NULL,
  `chronic` varchar(5) DEFAULT NULL,
  `diagcode` varchar(5) DEFAULT NULL,
  `hosp_dx` varchar(5) DEFAULT NULL,
  `hosp_rx` varchar(5) DEFAULT NULL,
  `date_disch` date DEFAULT NULL,
  `typedisch` varchar(2) CHARACTER SET utf8 DEFAULT '',
  `pt_from` varchar(20) DEFAULT NULL,
  KEY `idx_cid` (`cid`),
  KEY `idx_pid` (`pid`),
  KEY `idx_diagcode` (`diagcode`),
  KEY `idx_h` (`hospcode`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_chronicfu` */

DROP TABLE IF EXISTS `report_chronicfu`;

CREATE TABLE `report_chronicfu` (
  `HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `CID` varchar(13) DEFAULT NULL,
  `SEQ` varchar(16) NOT NULL,
  `DATE_SERV` date NOT NULL,
  `WEIGHT` mediumint(9) NOT NULL,
  `HEIGHT` smallint(6) NOT NULL,
  `WAIST_CM` smallint(6) NOT NULL,
  `SBP` smallint(6) NOT NULL,
  `DBP` smallint(6) NOT NULL,
  `RETINA` char(1) NOT NULL,
  `FOOT` char(1) NOT NULL,
  `SMOKING` char(1) NOT NULL,
  `source` varchar(25) DEFAULT NULL,
  `rpt_date` date DEFAULT '0000-00-00',
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`),
  KEY `DATE_SERV` (`DATE_SERV`),
  KEY `SBP` (`SBP`),
  KEY `DBP` (`DBP`),
  KEY `FOOT` (`FOOT`),
  KEY `SMOKING` (`SMOKING`),
  KEY `RETINA` (`RETINA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_cvdrisk` */

DROP TABLE IF EXISTS `report_cvdrisk`;

CREATE TABLE `report_cvdrisk` (
  `cid` varchar(13) NOT NULL DEFAULT '',
  `person_name` varchar(50) DEFAULT NULL,
  `regplace` varchar(250) NOT NULL DEFAULT '',
  `last_visit` date DEFAULT NULL,
  `bps` text,
  `tc` text,
  `smoke` text,
  `age` varchar(3) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `clinic` varchar(255) DEFAULT NULL,
  `aid` varchar(255) DEFAULT NULL,
  `typearea` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cid`,`regplace`),
  KEY `cid` (`cid`),
  KEY `regplace` (`regplace`),
  KEY `last_visit` (`last_visit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_diag_opd` */

DROP TABLE IF EXISTS `report_diag_opd`;

CREATE TABLE `report_diag_opd` (
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(15) NOT NULL DEFAULT '0',
  `diagtype` varchar(1) NOT NULL DEFAULT '0',
  `diagcode` varchar(6) DEFAULT NULL,
  `date_serv` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cid` varchar(13) DEFAULT NULL,
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_pid` (`pid`),
  KEY `idx_cid` (`cid`),
  KEY `idx_diagcode` (`diagcode`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_dulperson` */

DROP TABLE IF EXISTS `report_dulperson`;

CREATE TABLE `report_dulperson` (
  `cid` varchar(13) DEFAULT NULL,
  `person_name` varchar(105) NOT NULL DEFAULT '',
  `dul_typearea` text,
  `cc_all` bigint(21) NOT NULL DEFAULT '0',
  `hcode` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `report_epi` */

DROP TABLE IF EXISTS `report_epi`;

CREATE TABLE `report_epi` (
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(15) DEFAULT '',
  `vn` varchar(15) DEFAULT NULL,
  `name` varchar(50) DEFAULT '',
  `lname` varchar(50) DEFAULT '',
  `sex` varchar(1) DEFAULT '',
  `birth` date DEFAULT '0000-00-00',
  `nation` varchar(3) DEFAULT '',
  `typearea` varchar(1) DEFAULT '',
  `service_date` date DEFAULT '0000-00-00',
  `service_time` time DEFAULT '00:00:00',
  `vaccine_type` varchar(3) DEFAULT '',
  `vaccine_name` varchar(100) DEFAULT '',
  `vaccine_lotno` varchar(30) DEFAULT '',
  `yy` varchar(2) DEFAULT '',
  `mm` varchar(2) DEFAULT '',
  `dd` varchar(2) DEFAULT '',
  `service_hospcode` varchar(5) DEFAULT NULL,
  `vaccine_hospcode` varchar(5) DEFAULT NULL,
  `source` varchar(25) DEFAULT NULL,
  `rpt_date` date DEFAULT '0000-00-00',
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `vaccine_type` (`vaccine_type`),
  KEY `service_date` (`service_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_labfu` */

DROP TABLE IF EXISTS `report_labfu`;

CREATE TABLE `report_labfu` (
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(15) DEFAULT '',
  `cid` varchar(13) DEFAULT NULL,
  `labtest` varchar(7) DEFAULT NULL,
  `labname` varchar(20) DEFAULT NULL,
  `labresult` varchar(20) DEFAULT NULL,
  `date_serv` date DEFAULT NULL,
  `source` varchar(25) DEFAULT NULL,
  `rpt_date` date DEFAULT '0000-00-00',
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`),
  KEY `date_serv` (`date_serv`),
  KEY `labtest` (`labtest`),
  KEY `labresult` (`labresult`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_ncdscreen` */

DROP TABLE IF EXISTS `report_ncdscreen`;

CREATE TABLE `report_ncdscreen` (
  `HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `SEQ` varchar(16) DEFAULT NULL,
  `DATE_SERV` date NOT NULL,
  `SERVPLACE` varchar(1) NOT NULL,
  `SMOKE` varchar(1) DEFAULT NULL,
  `ALCOHOL` varchar(1) DEFAULT NULL,
  `DMFAMILY` varchar(1) DEFAULT NULL,
  `HTFAMILY` varchar(1) DEFAULT NULL,
  `WEIGHT` decimal(5,1) NOT NULL,
  `HEIGHT` int(3) NOT NULL,
  `WAIST_CM` int(3) NOT NULL,
  `SBP_1` int(3) NOT NULL,
  `DBP_1` int(3) NOT NULL,
  `SBP_2` int(3) DEFAULT NULL,
  `DBP_2` int(3) DEFAULT NULL,
  `BSLEVEL` int(6) DEFAULT NULL,
  `BSTEST` char(1) DEFAULT NULL,
  `SCREENPLACE` varchar(5) DEFAULT NULL,
  `PROVIDER` varchar(15) DEFAULT NULL,
  `D_UPDATE` datetime DEFAULT NULL,
  KEY `idx1` (`HOSPCODE`,`PID`),
  KEY `idx2` (`HOSPCODE`),
  KEY `idx3` (`DATE_SERV`),
  KEY `idx4` (`SBP_1`,`DBP_1`),
  KEY `idx5` (`SBP_2`,`DBP_2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_newborn` */

DROP TABLE IF EXISTS `report_newborn`;

CREATE TABLE `report_newborn` (
  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT NULL,
  `mpid` int(11) DEFAULT NULL,
  `gravida` int(11) DEFAULT NULL,
  `ga` int(11) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `btime` varchar(6) DEFAULT NULL,
  `bplace` varchar(1) DEFAULT NULL,
  `bhosp` varchar(5) DEFAULT NULL,
  `birthno` varchar(1) DEFAULT NULL,
  `btype` varchar(1) DEFAULT NULL,
  `bdoctor` varchar(1) DEFAULT NULL,
  `bweight` int(4) DEFAULT NULL,
  `asphyxia` bigint(1) NOT NULL DEFAULT '0',
  `vitk` bigint(1) NOT NULL DEFAULT '0',
  `tsh` bigint(1) NOT NULL DEFAULT '0',
  `thsresult` double(15,1) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `mcid` varchar(13) DEFAULT NULL,
  `fpid` int(11) DEFAULT NULL,
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_pid` (`pid`),
  KEY `idx_mpid` (`mpid`),
  KEY `idx_bdate` (`bdate`),
  KEY `idx_bhosp` (`bhosp`),
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_nutrition` */

DROP TABLE IF EXISTS `report_nutrition`;

CREATE TABLE `report_nutrition` (
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `date_serv` date DEFAULT NULL,
  `height` varchar(3) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `childdevelop` varchar(1) DEFAULT NULL,
  `age_y` int(3) DEFAULT NULL,
  `source` varchar(20) DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`),
  KEY `date_serv` (`date_serv`),
  KEY `childdevelop` (`childdevelop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_opvisit` */

DROP TABLE IF EXISTS `report_opvisit`;

CREATE TABLE `report_opvisit` (
  `hserv` varchar(5) NOT NULL DEFAULT '',
  `hospmain` varchar(5) DEFAULT NULL,
  `hospsub` varchar(5) DEFAULT NULL,
  `yy` int(4) DEFAULT NULL,
  `mm` int(2) DEFAULT NULL,
  `cc` bigint(21) NOT NULL DEFAULT '0',
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `hserv` (`hserv`),
  KEY `hospmain` (`hospmain`),
  KEY `hospsub` (`hospsub`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_ovstdiag` */

DROP TABLE IF EXISTS `report_ovstdiag`;

CREATE TABLE `report_ovstdiag` (
  `hcode` varchar(5) DEFAULT NULL,
  `cc_times` bigint(21) NOT NULL DEFAULT '0',
  `cc` bigint(21) NOT NULL DEFAULT '0',
  `pdx` varchar(9) DEFAULT NULL,
  `yy` int(4) DEFAULT NULL,
  `mm` varbinary(2) DEFAULT NULL,
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `idx_hcode` (`hcode`),
  KEY `idx_pdx` (`pdx`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_person_anc` */

DROP TABLE IF EXISTS `report_person_anc`;

CREATE TABLE `report_person_anc` (
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `regplace` varchar(5) NOT NULL DEFAULT '',
  `person_name` varchar(150) NOT NULL DEFAULT '',
  `anc_register_date` date DEFAULT NULL,
  `discharge` varchar(1) NOT NULL DEFAULT '',
  `typearea` varchar(1) DEFAULT NULL,
  `labor_status` varchar(1) DEFAULT NULL,
  `lmp` date DEFAULT NULL,
  `age_preg` varchar(2) DEFAULT NULL,
  `labor_date` date DEFAULT NULL,
  `labour_hospcode` varchar(5) NOT NULL DEFAULT '',
  `preg_no` varchar(2) NOT NULL DEFAULT '',
  `nationality` varchar(3) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` varchar(1) DEFAULT NULL,
  `risk_list` varchar(250) NOT NULL DEFAULT '',
  `bresult` varchar(250) NOT NULL DEFAULT '',
  `labour_type` varchar(2) NOT NULL DEFAULT '',
  `labor_place` varchar(2) NOT NULL DEFAULT '',
  `labor_doctor_type` varchar(2) NOT NULL DEFAULT '',
  `alive_child_count` varchar(1) NOT NULL DEFAULT '',
  `dead_child_count` varchar(1) NOT NULL DEFAULT '',
  `thalasseima_preg_age` int(11) NOT NULL DEFAULT '0',
  `thalassemia_screen_date` date DEFAULT NULL,
  `thalassemia_confirm_date` date DEFAULT NULL,
  `thalassemia_prenatal_date` date DEFAULT NULL,
  `thalassemia_prenatal_confirm` varchar(1) NOT NULL DEFAULT '',
  `thalassemia_prenatal_confirm_date` date DEFAULT NULL,
  `first_doctor_date` date DEFAULT NULL,
  `blood_check1_date` date DEFAULT NULL,
  `blood_check2_date` date DEFAULT NULL,
  `blood_vdrl1_result` varchar(10) NOT NULL DEFAULT '',
  `blood_vdrl2_result` varchar(10) NOT NULL DEFAULT '',
  `blood_hiv1_result` varchar(10) NOT NULL DEFAULT '',
  `blood_hiv2_result` varchar(10) NOT NULL DEFAULT '',
  `blood_of_result` varchar(10) NOT NULL DEFAULT '',
  `blood_hct_result` varchar(10) NOT NULL DEFAULT '',
  `blood_hct_grade` int(11) NOT NULL DEFAULT '0',
  `source` varchar(25) DEFAULT NULL,
  `rpt_date` date DEFAULT '0000-00-00',
  KEY `idx_cid` (`cid`),
  KEY `idx_pid` (`pid`),
  KEY `idx_labor_date` (`labor_date`),
  KEY `idx_birthdate` (`birthdate`),
  KEY `idx_regplace` (`regplace`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_persondeath` */

DROP TABLE IF EXISTS `report_persondeath`;

CREATE TABLE `report_persondeath` (
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(10) DEFAULT NULL,
  `pdeath` date DEFAULT NULL,
  `discharge` varchar(1) DEFAULT NULL,
  `hoscode` varchar(5) DEFAULT NULL,
  `death_date` date DEFAULT NULL,
  `death_diag` varchar(100) DEFAULT NULL,
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_postnatal` */

DROP TABLE IF EXISTS `report_postnatal`;

CREATE TABLE `report_postnatal` (
  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT NULL,
  `gravida` int(11) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `ppcare` date DEFAULT NULL,
  `ppresult` varchar(1) DEFAULT NULL,
  `ppplace` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `source` varchar(25) DEFAULT NULL,
  `rpt_date` date DEFAULT '0000-00-00',
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_pid` (`pid`),
  KEY `idx_ppcare` (`ppcare`),
  KEY `idx_bdate` (`bdate`),
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_r506` */

DROP TABLE IF EXISTS `report_r506`;

CREATE TABLE `report_r506` (
  `hcode` varchar(5) DEFAULT NULL,
  `hn` varchar(15) DEFAULT NULL,
  `vn` varchar(15) DEFAULT NULL,
  `vstdate` date DEFAULT NULL,
  `pdx` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `age_y` varchar(3) DEFAULT NULL,
  `age_m` varchar(3) DEFAULT NULL,
  `age_d` varchar(3) DEFAULT NULL,
  `aid` varchar(10) DEFAULT NULL,
  `pcode` varchar(5) DEFAULT NULL,
  `id` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `rpt_date` date DEFAULT NULL,
  KEY `hcode` (`hcode`),
  KEY `vstdate` (`vstdate`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_service` */

DROP TABLE IF EXISTS `report_service`;

CREATE TABLE `report_service` (
  `hcode` varchar(5) NOT NULL,
  `yy` varchar(4) NOT NULL,
  `mm` varchar(2) NOT NULL,
  `cc` int(11) NOT NULL,
  `times` int(11) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `report_service_anc` */

DROP TABLE IF EXISTS `report_service_anc`;

CREATE TABLE `report_service_anc` (
  `hospcode` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `precare_hospcode` varchar(5) DEFAULT NULL,
  `pa_week` int(11) DEFAULT NULL,
  `preg_no` int(11) DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `labor_date` date DEFAULT NULL,
  `edc` date DEFAULT NULL,
  `lmp` date DEFAULT NULL,
  `ga` int(11) DEFAULT NULL,
  `note` varchar(20) CHARACTER SET utf8 DEFAULT '',
  KEY `idx_cid` (`cid`),
  KEY `idx_h` (`hospcode`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `report_specialpp` */

DROP TABLE IF EXISTS `report_specialpp`;

CREATE TABLE `report_specialpp` (
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `seq` varchar(16) DEFAULT NULL,
  `date_serv` date NOT NULL,
  `servplace` char(1) NOT NULL,
  `ppspecial` varchar(6) NOT NULL,
  `ppsplace` varchar(5) DEFAULT NULL,
  `provider` varchar(15) DEFAULT NULL,
  `d_update` datetime NOT NULL,
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_pid` (`pid`),
  KEY `idx_date_serv` (`date_serv`),
  KEY `idx_ppspecial` (`ppspecial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_student` */

DROP TABLE IF EXISTS `report_student`;

CREATE TABLE `report_student` (
  `hospcode` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `school_class` varchar(100) DEFAULT NULL,
  `hn` varchar(13) DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `report_top10opd` */

DROP TABLE IF EXISTS `report_top10opd`;

CREATE TABLE `report_top10opd` (
  `cc_times` bigint(21) NOT NULL DEFAULT '0',
  `cc` bigint(21) NOT NULL DEFAULT '0',
  `pdx` varchar(6) DEFAULT NULL,
  `yy` int(4) DEFAULT NULL,
  `mm` varchar(2) DEFAULT NULL,
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hcode` varchar(5) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `rpt_506_code` */

DROP TABLE IF EXISTS `rpt_506_code`;

CREATE TABLE `rpt_506_code` (
  `id` tinyint(4) DEFAULT NULL,
  `code1` varchar(6) DEFAULT NULL,
  `code2` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

/*Table structure for table `rpt_506_name` */

DROP TABLE IF EXISTS `rpt_506_name`;

CREATE TABLE `rpt_506_name` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(250) DEFAULT NULL,
  `code506` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ix_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

/*Table structure for table `wdep` */

DROP TABLE IF EXISTS `wdep`;

CREATE TABLE `wdep` (
  `hoscode` char(5) NOT NULL,
  `active` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`hoscode`),
  CONSTRAINT `wdep_hoscode` FOREIGN KEY (`hoscode`) REFERENCES `chospital` (`hoscode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `wm_auth_assignment` */

DROP TABLE IF EXISTS `wm_auth_assignment`;

CREATE TABLE `wm_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `wm_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `wm_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `wm_auth_item` */

DROP TABLE IF EXISTS `wm_auth_item`;

CREATE TABLE `wm_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `wm_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `wm_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `wm_auth_item_child` */

DROP TABLE IF EXISTS `wm_auth_item_child`;

CREATE TABLE `wm_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `wm_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `wm_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wm_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `wm_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `wm_auth_rule` */

DROP TABLE IF EXISTS `wm_auth_rule`;

CREATE TABLE `wm_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `wm_log_emr` */

DROP TABLE IF EXISTS `wm_log_emr`;

CREATE TABLE `wm_log_emr` (
  `wm_log_emr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `access_time` datetime DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `access_cid` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`wm_log_emr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=640 DEFAULT CHARSET=tis620;

/*Table structure for table `wm_migration` */

DROP TABLE IF EXISTS `wm_migration`;

CREATE TABLE `wm_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `wm_profile` */

DROP TABLE IF EXISTS `wm_profile`;

CREATE TABLE `wm_profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  `hospcode` varchar(5) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `wm_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `wm_session_user` */

DROP TABLE IF EXISTS `wm_session_user`;

CREATE TABLE `wm_session_user` (
  `id` char(80) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`),
  KEY `expire` (`expire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `wm_social_account` */

DROP TABLE IF EXISTS `wm_social_account`;

CREATE TABLE `wm_social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `wm_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `wm_sync_list` */

DROP TABLE IF EXISTS `wm_sync_list`;

CREATE TABLE `wm_sync_list` (
  `hbs_id` int(11) NOT NULL AUTO_INCREMENT,
  `hbs_hospital_id` varchar(6) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_ip` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_browser` varchar(255) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_info` varchar(255) CHARACTER SET tis620 DEFAULT NULL,
  `hbs_sync_start` datetime DEFAULT '0000-00-00 00:00:00',
  `hbs_sync_finish` datetime DEFAULT '0000-00-00 00:00:00',
  `hbs_upload_size` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`hbs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=984 DEFAULT CHARSET=utf8;

/*Table structure for table `wm_table_sync_list` */

DROP TABLE IF EXISTS `wm_table_sync_list`;

CREATE TABLE `wm_table_sync_list` (
  `wm_table_sync_name` varchar(250) NOT NULL,
  `param1` varchar(150) NOT NULL,
  `param2` varchar(150) NOT NULL,
  `param3` varchar(150) NOT NULL,
  `order_number` int(11) NOT NULL,
  `min_date` date NOT NULL,
  `sync_type_id` int(11) NOT NULL DEFAULT '2',
  `update_time` datetime NOT NULL,
  `sync_time` datetime NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'Y',
  `n_server` varchar(20) NOT NULL DEFAULT '0',
  `n_client` varchar(20) NOT NULL DEFAULT '0',
  `checksum` varchar(100) NOT NULL DEFAULT '0',
  `sync_field_name` text NOT NULL,
  PRIMARY KEY (`wm_table_sync_name`),
  UNIQUE KEY `ix_dw_table_sync_name` (`wm_table_sync_name`),
  KEY `min_date` (`min_date`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `wm_token` */

DROP TABLE IF EXISTS `wm_token`;

CREATE TABLE `wm_token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `wm_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `wm_user` */

DROP TABLE IF EXISTS `wm_user`;

CREATE TABLE `wm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

/*Table structure for table `wm_vaccine_type` */

DROP TABLE IF EXISTS `wm_vaccine_type`;

CREATE TABLE `wm_vaccine_type` (
  `vaccine_name` varchar(150) NOT NULL DEFAULT '',
  `vaccine_code` varchar(20) DEFAULT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `export_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`vaccine_name`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `wmc_config` */

DROP TABLE IF EXISTS `wmc_config`;

CREATE TABLE `wmc_config` (
  `yearprocess` int(11) NOT NULL,
  `proviscode` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `wmc_import` */

DROP TABLE IF EXISTS `wmc_import`;

CREATE TABLE `wmc_import` (
  `groupdata` varchar(100) NOT NULL,
  `starttime` datetime DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `countfiles` int(11) DEFAULT '0',
  PRIMARY KEY (`groupdata`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `wmc_procedure` */

DROP TABLE IF EXISTS `wmc_procedure`;

CREATE TABLE `wmc_procedure` (
  `wmc_procedure_name` varchar(100) NOT NULL,
  `wmc_procedure_seq` float(5,2) NOT NULL,
  `wmc_procedure_comment` text,
  `wmc_procedure_active` int(1) DEFAULT '1',
  `wmc_procedure_startprocess` datetime DEFAULT NULL,
  `wmc_procedure_finishprocess` datetime DEFAULT NULL,
  `wmc_usetime` varchar(50) DEFAULT '00:00:00',
  `wmc_procedure_message` text,
  `wmc_procedure_status` varchar(45) DEFAULT NULL,
  `wmc_procedure_querystring` text,
  PRIMARY KEY (`wmc_procedure_name`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `wmc_xalert` */

DROP TABLE IF EXISTS `wmc_xalert`;

CREATE TABLE `wmc_xalert` (
  `wmc_xalert_id` varchar(50) NOT NULL,
  `wmc_xalert_active` int(1) DEFAULT '1',
  `wmc_xalert_title` varchar(255) DEFAULT NULL,
  `wmc_xalert_query` text,
  `wmc_xalert_status` varchar(255) DEFAULT NULL,
  `wmc_xalert_orderby` float(5,2) DEFAULT '1.00',
  `wmc_xalert_querytype` varchar(45) DEFAULT NULL,
  `wmc_xalert_start` datetime DEFAULT NULL,
  `wmc_xalert_finish` datetime DEFAULT NULL,
  `wmc_xalert_message` varchar(255) DEFAULT NULL,
  `wmc_xalert_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`wmc_xalert_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

/*Table structure for table `wuse_group_local` */

DROP TABLE IF EXISTS `wuse_group_local`;

CREATE TABLE `wuse_group_local` (
  `menu_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `menu_group_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อกลุ่มเมนู',
  `menu_group_active` varchar(1) DEFAULT NULL COMMENT 'สถานะการใช้งาน',
  `menu_group_comment` text COMMENT 'หมายเหตุ',
  `menu_group_submenu` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `wuse_items` */

DROP TABLE IF EXISTS `wuse_items`;

CREATE TABLE `wuse_items` (
  `hoscode` char(5) NOT NULL DEFAULT '',
  `menu_items_id` int(7) unsigned zerofill NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`hoscode`,`menu_items_id`),
  KEY `wuse_items_idx` (`menu_items_id`),
  CONSTRAINT `wuse_hoscode` FOREIGN KEY (`hoscode`) REFERENCES `wdep` (`hoscode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `wuse_items_local` */

DROP TABLE IF EXISTS `wuse_items_local`;

CREATE TABLE `wuse_items_local` (
  `report_id` varchar(8) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `menu_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `xalertsummary` */

DROP TABLE IF EXISTS `xalertsummary`;

CREATE TABLE `xalertsummary` (
  `eid` varchar(36) NOT NULL DEFAULT '',
  `vhid` varchar(8) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `cc` bigint(21) NOT NULL DEFAULT '0',
  `b_year` int(3) NOT NULL DEFAULT '0',
  `dtstmp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `eid` (`eid`),
  KEY `vhid` (`vhid`),
  KEY `hospcode` (`hospcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* Function  structure for function  `age` */

/*!50003 DROP FUNCTION IF EXISTS `age` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `age`(`date_n` date,`date_b` date,`ask` varchar(1)) RETURNS int(3)
    DETERMINISTIC
BEGIN 

		##use call age('date_now','date_birth','y or m or d');

			DECLARE year_diff INT; 

			DECLARE month_diff INT; 

			DECLARE day_diff INT; 

				SELECT (YEAR(date_n)-YEAR(date_b)) - (DATE_FORMAT(date_n,'00-%m-%d')<DATE_FORMAT(date_b,'00-%m-%d' )) INTO year_diff; 

				SELECT (CASE SIGN(DATE_FORMAT(date_n,'%m')-DATE_FORMAT(date_b,'%m')) 

											WHEN 0 

													THEN 0 + IF(DAY(date_n) < DAY(date_b), 11, 0) 

											WHEN -1 

													THEN (12 - DATE_FORMAT(date_b,'%m') + DATE_FORMAT(date_n,'%m') - (DATE_FORMAT(date_n,'00-00-%d') < DATE_FORMAT(date_b,'00-00-%d'))) 

											WHEN 1 

													THEN(DATE_FORMAT(date_n,'%m') - DATE_FORMAT(date_b,'%m') - (DATE_FORMAT(date_n,'00-00-%d') < DATE_FORMAT(date_b,'00-00-%d'))) 

										END

									) INTO month_diff; 

					SELECT (CASE SIGN(DATE_FORMAT(date_n,'%d') - DATE_FORMAT(date_b,'%d')) 

											WHEN 0 

													THEN 0 

											WHEN -1 

													THEN (DATE_FORMAT(LAST_DAY(date_b),'%d') + DATE_FORMAT(date_n, '%d')  - DATE_FORMAT(date_b, '%d')) 

											WHEN 1 

													THEN (DATE_FORMAT(date_n,'%d') - DATE_FORMAT(date_b,'%d') - (DATE_FORMAT(date_n,'%d') < DATE_FORMAT(date_b,'%d'))) 

										END

									) INTO day_diff;

				IF ask = 'y' THEN

						RETURN year_diff;

				ELSEIF ask = 'm' THEN

						RETURN month_diff;

				ELSEIF ask = 'd' THEN

						RETURN day_diff;

				ELSE

						RETURN 0;

				END IF;

		END */$$
DELIMITER ;

/* Function  structure for function  `chk_col` */

/*!50003 DROP FUNCTION IF EXISTS `chk_col` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `chk_col`(theDB varchar(100),theTable varchar(100),fullstr varchar(255)) RETURNS int(1)
    DETERMINISTIC
BEGIN

		  DECLARE a INT Default 0 ;

		  DECLARE str VARCHAR(255);

		  simple_loop: LOOP

			 SET a=a+1;

			 SET str=SPLIT_STR(fullstr,',',a);

						IF str='' THEN

				LEAVE simple_loop;

						END IF;

						IF NOT EXISTS (SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = theDB 

								AND TABLE_NAME = theTable AND COLUMN_NAME = str ) 

						THEN					   

						  RETURN 0;  

							LEAVE simple_loop;

						END IF;

				END LOOP simple_loop;

			  RETURN 1;  

	END */$$
DELIMITER ;

/* Function  structure for function  `egfr_fnc` */

/*!50003 DROP FUNCTION IF EXISTS `egfr_fnc` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `egfr_fnc`(cre double(10,2),age int(3),sex int(1)) RETURNS double(10,2)
    DETERMINISTIC
BEGIN

		DECLARE egfr double(10,2) DEFAULT 0.00; 

		   IF sex =1 AND cre <= 0.9  THEN 

						SET egfr = 141 * POWER((0.9/cre),0.411)  * POWER(0.993,age);

			 ELSEIF   sex =1 AND cre > 0.9 THEN

					 SET	egfr = 141 * POWER((0.9/cre),1.209)  * POWER(0.993,age);

		   ELSEIF  sex =2 AND cre <= 0.7 THEN

						SET egfr = 144 * POWER((0.7/cre),0.329)  * POWER(0.993,age);

		   ELSEIF  sex =2 AND cre > 0.7 THEN

						SET egfr = 144 * POWER((0.7/cre),1.209)  * POWER(0.993,age);



			END IF;

			RETURN ROUND(egfr,2);

		END */$$
DELIMITER ;

/* Function  structure for function  `epid_wks` */

/*!50003 DROP FUNCTION IF EXISTS `epid_wks` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `epid_wks`(`start_epid` date,`ask_epid` date) RETURNS int(2)
    DETERMINISTIC
BEGIN

		## use call epid_wks('start_epid_date','ill_date');

			DECLARE r1 DECIMAL(15,2) DEFAULT 0.00;

			DECLARE r2 DECIMAL(5,2) DEFAULT 0.00;

			

			IF start_epid IS NOT NULL THEN

				SET	r1 = DATEDIFF(ask_epid,start_epid);

				SET	r2 = ceil(r1/7);

			END IF;

			IF r2>53 THEN

				SET r2=0;

			END IF;

			RETURN r2;

		END */$$
DELIMITER ;

/* Function  structure for function  `hdc_log` */

/*!50003 DROP FUNCTION IF EXISTS `hdc_log` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `hdc_log`(p_name varchar(255)) RETURNS int(1)
    DETERMINISTIC
BEGIN

					IF p_name !='' THEN

						INSERT INTO hdc_log(p_date,p_name)values(NOW(),p_name);

					END IF;

				RETURN 1;				

			END */$$
DELIMITER ;

/* Function  structure for function  `mod11` */

/*!50003 DROP FUNCTION IF EXISTS `mod11` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `mod11`(v1 varchar(13)) RETURNS int(1)
    DETERMINISTIC
BEGIN

		## use call mod11('cid');

			 DECLARE chkrs int(1) DEFAULT 0;

				 DECLARE vc1 int(1) DEFAULT 0;

				 DECLARE vc2 int(1) DEFAULT 0;

				 DECLARE vc3 int(1) DEFAULT 0;

				 DECLARE vc4 int(1) DEFAULT 0;

				 DECLARE vc5 int(1) DEFAULT 0;

				 DECLARE vc6 int(1) DEFAULT 0;

				 DECLARE vc7 int(1) DEFAULT 0;

				 DECLARE vc8 int(1) DEFAULT 0;

				 DECLARE vc9 int(1) DEFAULT 0;

				 DECLARE vc10 int(1) DEFAULT 0;

				 DECLARE vc11 int(1) DEFAULT 0;

				 DECLARE vc12 int(1) DEFAULT 0;

				 DECLARE vc13 int(1) DEFAULT 0;

				 DECLARE vm int(1) DEFAULT 0;

				 DECLARE vt int(1) DEFAULT 0;



			IF substr(v1,1,1) NOT REGEXP '^[0-9]' OR substr(v1,2,1) NOT REGEXP '^[0-9]' OR substr(v1,3,1) NOT REGEXP '^[0-9]'  OR substr(v1,4,1) NOT REGEXP '^[0-9]'  OR substr(v1,5,1) NOT REGEXP '^[0-9]'  OR substr(v1,6,1) NOT REGEXP '^[0-9]'  OR substr(v1,7,1) NOT REGEXP '^[0-9]'  OR substr(v1,8,1) NOT REGEXP '^[0-9]'  OR substr(v1,9,1) NOT REGEXP '^[0-9]'  OR substr(v1,10,1) NOT REGEXP '^[0-9]'  OR substr(v1,11,1) NOT REGEXP '^[0-9]'  OR substr(v1,12,1) NOT REGEXP '^[0-9]'  OR substr(v1,13,1) NOT REGEXP '^[0-9]'  THEN	

					SET chkrs=9;	

			ELSE

	



					SET vc1=13*substr(v1,1,1);

					SET vc2=12*substr(v1,2,1);

					SET vc3=11*substr(v1,3,1);

					SET vc4=10*substr(v1,4,1);

					SET vc5=9*substr(v1,5,1);

					SET vc6=8*substr(v1,6,1);

					SET vc7=7*substr(v1,7,1);

					SET vc8=6*substr(v1,8,1);

					SET vc9=5*substr(v1,9,1);

					SET vc10=4*substr(v1,10,1);

					SET vc11=3*substr(v1,11,1);

					SET vc12=2*substr(v1,12,1);

					SET vc13=substr(v1,13,1);



						SET vt=vc1+vc2+vc3+vc4+vc5+vc6+vc7+vc8+vc9+vc10+vc11+vc12;

						set vt=mod(vt,11);

						IF vt<=1 THEN 

								SET vm=1-vt;

						ELSE 

								SET vm=11-vt;

						END IF;				

						IF vm=vc13 THEN	

								SET chkrs=1;

						ELSE 

								SET chkrs=0;

						END IF;



						IF vc1='0' AND vc2='0'  THEN  

								SET chkrs=0;				

						END IF;



						IF length(trim(v1))<>13  THEN 

								SET chkrs=0;				

						END IF;



		END IF;

			RETURN chkrs;

		END */$$
DELIMITER ;

/* Function  structure for function  `nutri_cal` */

/*!50003 DROP FUNCTION IF EXISTS `nutri_cal` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `nutri_cal`(agem int(3),isex varchar(1),ntype int(1),h int(3),w int(3)) RETURNS varchar(1) CHARSET utf8
    DETERMINISTIC
BEGIN

	     DECLARE chkrs int(1) DEFAULT 0;

		 DECLARE ay int(3) DEFAULT 0;

		 DECLARE am int(2) DEFAULT 0;

	

		SET chkrs=NULL;

		SET ay=truncate(agem/12,0);

		SET am=MOD(agem,12);

					

					IF ntype=1 THEN  

							SELECT nutri_level INTO chkrs  FROM cwhpa_referen WHERE year=ay AND month=am AND sex=isex AND nutri_type='1' AND (w BETWEEN low AND hi)=1;				

					END IF;



					IF ntype=2 THEN 

								SELECT nutri_level INTO chkrs  FROM cwhpa_referen WHERE year=ay AND month=am AND sex=isex AND nutri_type='2' AND (h BETWEEN low AND hi)=1;				

					END IF;



				IF ntype=3 THEN 

								SELECT nutri_level INTO chkrs  FROM cwh_referen WHERE (ay BETWEEN age_low AND age_max)=1 AND sex=isex AND h=height AND  (w BETWEEN weight_low AND weight_max)=1;				

					END IF;



		RETURN chkrs;

		END */$$
DELIMITER ;

/* Function  structure for function  `repl_digits_pipe` */

/*!50003 DROP FUNCTION IF EXISTS `repl_digits_pipe` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `repl_digits_pipe`(str VARCHAR(255)) RETURNS varchar(255) CHARSET utf8
    DETERMINISTIC
BEGIN

				DECLARE i, len SMALLINT DEFAULT 1; 

				  DECLARE ret varchar(255) DEFAULT ''; 

				  DECLARE c CHAR(1); 

				  SET len = CHAR_LENGTH( str ); 

				  REPEAT 

					BEGIN 

					  SET c = substr( str, i, 1 );

					   IF c BETWEEN '0' AND '9' THEN  

						SET ret=CONCAT(ret,'|'); 

							ELSE

								SET ret=CONCAT(ret,c); 

					  END IF; 

					  SET i = i + 1; 

					END; 

				  UNTIL i > len END REPEAT; 

				  RETURN ret; 

		END */$$
DELIMITER ;

/* Function  structure for function  `SPLIT_STR` */

/*!50003 DROP FUNCTION IF EXISTS `SPLIT_STR` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR`(x VARCHAR(255),

	  delim VARCHAR(12),

	  pos INT) RETURNS varchar(255) CHARSET utf8
    DETERMINISTIC
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),

		   LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),

		   delim, '') */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
