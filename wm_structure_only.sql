/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 5.7.11-4 : Database - wm_webservice
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wm_webservice` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `wm_webservice`;

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

/*Table structure for table `ccervix_year` */

DROP TABLE IF EXISTS `ccervix_year`;

CREATE TABLE `ccervix_year` (
  `year` varchar(4) NOT NULL,
  `note` text,
  PRIMARY KEY (`year`),
  KEY `year` (`year`)
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

/*Table structure for table `cicd10rua` */

DROP TABLE IF EXISTS `cicd10rua`;

CREATE TABLE `cicd10rua` (
  `icd10` varchar(7) COLLATE utf8_bin NOT NULL,
  `disease` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`icd10`,`disease`),
  KEY `icd10` (`icd10`),
  KEY `disease` (`disease`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

/*Table structure for table `death_moi` */

DROP TABLE IF EXISTS `death_moi`;

CREATE TABLE `death_moi` (
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `discharge` varchar(1) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  `deathage` varchar(5) DEFAULT NULL,
  `deathcause` text,
  `deathdate` date DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `cid` (`cid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `geojson` */

DROP TABLE IF EXISTS `geojson`;

CREATE TABLE `geojson` (
  `areatype` char(1) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `hcode` varchar(5) NOT NULL DEFAULT '00000' COMMENT 'รหัสสถานพยาบาล',
  `geojson` mediumtext,
  `lat` varchar(45) DEFAULT NULL,
  `lon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `hbs_sync` varchar(1) DEFAULT NULL,
  `hbs_update` varchar(1) DEFAULT NULL,
  `hbs_command` text,
  `hbs_db_version` varchar(255) DEFAULT NULL,
  `hbs_dlc_status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`hbs_hospital_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `icd10` */

DROP TABLE IF EXISTS `icd10`;

CREATE TABLE `icd10` (
  `code` varchar(7) NOT NULL DEFAULT '',
  `name` varchar(200) DEFAULT NULL,
  `spclty` char(2) DEFAULT NULL,
  `tname` varchar(150) DEFAULT NULL,
  `code3` char(3) DEFAULT NULL,
  `code4` char(1) DEFAULT NULL,
  `code5` char(1) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `ipd_valid` char(1) DEFAULT NULL,
  `icd10compat` char(1) DEFAULT NULL,
  `icd10tmcompat` char(1) DEFAULT NULL,
  `active_status` char(1) DEFAULT NULL,
  `hos_guid` char(38) DEFAULT NULL,
  `hos_guid_ext` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_header` varchar(200) COLLATE utf8_bin NOT NULL,
  `news_detail` text COLLATE utf8_bin NOT NULL,
  `news_date` date NOT NULL,
  `news_count` int(11) DEFAULT '0',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

/*Table structure for table `pcounter_save` */

DROP TABLE IF EXISTS `pcounter_save`;

CREATE TABLE `pcounter_save` (
  `save_name` varchar(10) NOT NULL,
  `save_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`save_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `pcounter_users` */

DROP TABLE IF EXISTS `pcounter_users`;

CREATE TABLE `pcounter_users` (
  `user_ip` varchar(255) NOT NULL,
  `user_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_ip`)
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

/*Table structure for table `profiles_fields` */

DROP TABLE IF EXISTS `profiles_fields`;

CREATE TABLE `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
  `pdx` varchar(6) CHARACTER SET tis620 DEFAULT NULL,
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

/*Table structure for table `s_anc5` */

DROP TABLE IF EXISTS `s_anc5`;

CREATE TABLE `s_anc5` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_childdev_specialpp` */

DROP TABLE IF EXISTS `s_childdev_specialpp`;

CREATE TABLE `s_childdev_specialpp` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) NOT NULL,
  `date_com` varchar(14) NOT NULL,
  `b_year` varchar(4) NOT NULL,
  `monthly` varchar(2) NOT NULL,
  `target9` int(10) DEFAULT '0',
  `result9_1` int(10) DEFAULT '0',
  `result9_2` int(10) DEFAULT '0',
  `result9_3` int(10) DEFAULT '0',
  `result9_4` int(10) DEFAULT '0',
  `result9_5` int(10) DEFAULT '0',
  `result9_6` int(10) DEFAULT '0',
  `result9_7` int(10) DEFAULT '0',
  `result9_8` int(10) DEFAULT '0',
  `result9_9` int(10) DEFAULT '0',
  `target18` int(10) DEFAULT '0',
  `result18_1` int(10) DEFAULT '0',
  `result18_2` int(10) DEFAULT '0',
  `result18_3` int(10) DEFAULT '0',
  `result18_4` int(10) DEFAULT '0',
  `result18_5` int(10) DEFAULT '0',
  `result18_6` int(10) DEFAULT '0',
  `result18_7` int(10) DEFAULT '0',
  `result18_8` int(10) DEFAULT '0',
  `result18_9` int(10) DEFAULT '0',
  `target30` int(10) DEFAULT '0',
  `result30_1` int(10) DEFAULT '0',
  `result30_2` int(10) DEFAULT '0',
  `result30_3` int(10) DEFAULT '0',
  `result30_4` int(10) DEFAULT '0',
  `result30_5` int(10) DEFAULT '0',
  `result30_6` int(10) DEFAULT '0',
  `result30_7` int(10) DEFAULT '0',
  `result30_8` int(10) DEFAULT '0',
  `result30_9` int(10) DEFAULT '0',
  `target42` int(10) DEFAULT '0',
  `result42_1` int(10) DEFAULT '0',
  `result42_2` int(10) DEFAULT '0',
  `result42_3` int(10) DEFAULT '0',
  `result42_4` int(10) DEFAULT '0',
  `result42_5` int(10) DEFAULT '0',
  `result42_6` int(10) DEFAULT '0',
  `result42_7` int(10) DEFAULT '0',
  `result42_8` int(10) DEFAULT '0',
  `result42_9` int(10) DEFAULT '0',
  `improper9` int(10) DEFAULT '0',
  `improper18` int(10) DEFAULT '0',
  `improper30` int(10) DEFAULT '0',
  `improper42` int(10) DEFAULT '0',
  PRIMARY KEY (`hospcode`,`areacode`,`b_year`,`monthly`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_dm_control` */

DROP TABLE IF EXISTS `s_dm_control`;

CREATE TABLE `s_dm_control` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `hba1c` int(9) DEFAULT '0',
  `target1` int(9) DEFAULT '0',
  `result1` int(9) DEFAULT '0',
  `hba1c1` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_dm_screen_pop_age` */

DROP TABLE IF EXISTS `s_dm_screen_pop_age`;

CREATE TABLE `s_dm_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_ht_control` */

DROP TABLE IF EXISTS `s_ht_control`;

CREATE TABLE `s_ht_control` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `bp` int(9) DEFAULT '0',
  `target1` int(9) DEFAULT '0',
  `result1` int(9) DEFAULT '0',
  `bp1` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_ht_screen_pop_age` */

DROP TABLE IF EXISTS `s_ht_screen_pop_age`;

CREATE TABLE `s_ht_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_kpi_anc12` */

DROP TABLE IF EXISTS `s_kpi_anc12`;

CREATE TABLE `s_kpi_anc12` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_kpi_ckd_screen` */

DROP TABLE IF EXISTS `s_kpi_ckd_screen`;

CREATE TABLE `s_kpi_ckd_screen` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(10) NOT NULL DEFAULT '0',
  `result` int(10) NOT NULL DEFAULT '0',
  `result1` int(10) NOT NULL DEFAULT '0',
  `result2` int(10) NOT NULL DEFAULT '0',
  `result3` int(10) NOT NULL DEFAULT '0',
  `result4` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_postnatal` */

DROP TABLE IF EXISTS `s_postnatal`;

CREATE TABLE `s_postnatal` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `areacode` varchar(8) NOT NULL DEFAULT '',
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL DEFAULT '',
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `target10` int(9) DEFAULT '0',
  `result10` int(9) DEFAULT '0',
  `target11` int(9) DEFAULT '0',
  `result11` int(9) DEFAULT '0',
  `target12` int(9) DEFAULT '0',
  `result12` int(9) DEFAULT '0',
  `target01` int(9) DEFAULT '0',
  `result01` int(9) DEFAULT '0',
  `target02` int(9) DEFAULT '0',
  `result02` int(9) DEFAULT '0',
  `target03` int(9) DEFAULT '0',
  `result03` int(9) DEFAULT '0',
  `target04` int(9) DEFAULT '0',
  `result04` int(9) DEFAULT '0',
  `target05` int(9) DEFAULT '0',
  `result05` int(9) DEFAULT '0',
  `target06` int(9) DEFAULT '0',
  `result06` int(9) DEFAULT '0',
  `target07` int(9) DEFAULT '0',
  `result07` int(9) DEFAULT '0',
  `target08` int(9) DEFAULT '0',
  `result08` int(9) DEFAULT '0',
  `target09` int(9) DEFAULT '0',
  `result09` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_rdu19` */

DROP TABLE IF EXISTS `s_rdu19`;

CREATE TABLE `s_rdu19` (
  `yymm` varchar(6) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `turl` int(11) NOT NULL DEFAULT '0',
  `ruri` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_rdu20` */

DROP TABLE IF EXISTS `s_rdu20`;

CREATE TABLE `s_rdu20` (
  `yymm` varchar(6) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `turl` int(11) NOT NULL DEFAULT '0',
  `ruri` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_rdu6` */

DROP TABLE IF EXISTS `s_rdu6`;

CREATE TABLE `s_rdu6` (
  `yymm` varchar(6) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `turl` int(11) NOT NULL DEFAULT '0',
  `ruri` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_rdu7` */

DROP TABLE IF EXISTS `s_rdu7`;

CREATE TABLE `s_rdu7` (
  `yymm` varchar(6) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `turl` int(11) NOT NULL DEFAULT '0',
  `ruri` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_rdu8` */

DROP TABLE IF EXISTS `s_rdu8`;

CREATE TABLE `s_rdu8` (
  `yymm` varchar(6) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `turl` int(11) NOT NULL DEFAULT '0',
  `ruri` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `s_rdu9` */

DROP TABLE IF EXISTS `s_rdu9`;

CREATE TABLE `s_rdu9` (
  `yymm` varchar(6) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `turl` int(11) NOT NULL DEFAULT '0',
  `ruri` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_breast_screen` */

DROP TABLE IF EXISTS `t_breast_screen`;

CREATE TABLE `t_breast_screen` (
  `CID` varchar(13) NOT NULL,
  `self_screen` varchar(6) DEFAULT NULL,
  `self_screen_date` date DEFAULT NULL,
  `self_screen_hospcode` varchar(5) DEFAULT NULL,
  `self_screen_input` varchar(5) DEFAULT NULL,
  `doctor_screen` varchar(7) DEFAULT NULL,
  `doctor_screen_date` date DEFAULT NULL,
  `doctor_screen_hospcode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_childdev` */

DROP TABLE IF EXISTS `t_childdev`;

CREATE TABLE `t_childdev` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `PID` varchar(15) NOT NULL DEFAULT '',
  `CID` varchar(13) NOT NULL,
  `BIRTH` date DEFAULT NULL,
  `SEX` varchar(1) NOT NULL DEFAULT '',
  `AREACODE` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `AGE_9` int(1) NOT NULL DEFAULT '0',
  `AGE_18` int(1) NOT NULL DEFAULT '0',
  `AGE_30` int(1) NOT NULL DEFAULT '0',
  `AGE_42` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`HOSPCODE`,`PID`),
  KEY `HOSPCODE` (`HOSPCODE`,`PID`,`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_childdev_specialpp` */

DROP TABLE IF EXISTS `t_childdev_specialpp`;

CREATE TABLE `t_childdev_specialpp` (
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `cid` varchar(15) NOT NULL DEFAULT '',
  `birth` date DEFAULT NULL,
  `sex` varchar(1) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  `agemonth` varchar(3) NOT NULL DEFAULT '',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `date_serv_first` date DEFAULT NULL,
  `status1` varchar(1) DEFAULT NULL,
  `date_serv2` date DEFAULT NULL,
  `sp_first` text,
  `sp_last` text,
  `date_serv_last` date DEFAULT NULL,
  `status2` varchar(1) DEFAULT NULL,
  `status21` varchar(1) DEFAULT NULL,
  `status22` varchar(1) DEFAULT NULL,
  `status23` varchar(1) DEFAULT NULL,
  `status24` varchar(1) DEFAULT NULL,
  `status25` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`hospcode`,`pid`,`cid`,`agemonth`),
  KEY `hospcode` (`hospcode`,`pid`,`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_childdev1830` */

DROP TABLE IF EXISTS `t_childdev1830`;

CREATE TABLE `t_childdev1830` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `PID` varchar(15) NOT NULL DEFAULT '',
  `CID` varchar(13) NOT NULL,
  `BIRTH` date NOT NULL DEFAULT '0000-00-00',
  `AREACODE` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `M10` int(1) NOT NULL DEFAULT '0',
  `M11` int(1) NOT NULL DEFAULT '0',
  `M12` int(1) NOT NULL DEFAULT '0',
  `M01` int(1) NOT NULL DEFAULT '0',
  `M02` int(1) NOT NULL DEFAULT '0',
  `M03` int(1) NOT NULL DEFAULT '0',
  `M04` int(1) NOT NULL DEFAULT '0',
  `M05` int(1) NOT NULL DEFAULT '0',
  `M06` int(1) NOT NULL DEFAULT '0',
  `M07` int(1) NOT NULL DEFAULT '0',
  `M08` int(1) NOT NULL DEFAULT '0',
  `M09` int(1) NOT NULL DEFAULT '0',
  `AGE_18` int(1) NOT NULL DEFAULT '0',
  `AGE_30` int(1) NOT NULL DEFAULT '0',
  `DATE_SERV` date DEFAULT NULL,
  `AGE_SERV` int(1) NOT NULL DEFAULT '0',
  `PASS` int(1) NOT NULL DEFAULT '0',
  `DATE_START` date DEFAULT NULL,
  `DATE_END` date DEFAULT NULL,
  KEY `HOSPCODE` (`HOSPCODE`,`PID`,`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_chronic` */

DROP TABLE IF EXISTS `t_chronic`;

CREATE TABLE `t_chronic` (
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `age_y_dx` int(3) DEFAULT '0',
  `groupcode` int(3) DEFAULT '0',
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `p_hospcode` varchar(5) DEFAULT NULL,
  `d_hospcode` varchar(5) DEFAULT NULL,
  `p_pt_vhid` varchar(8) DEFAULT NULL,
  `d_pt_vhid` varchar(8) DEFAULT NULL,
  `p_typearea` varchar(1) DEFAULT NULL,
  `d_typearea` varchar(1) DEFAULT NULL,
  `input_hosp` varchar(5) DEFAULT NULL,
  `input_pid` varchar(15) DEFAULT NULL,
  `source_tb` varchar(20) DEFAULT NULL,
  `diagcode` varchar(10) DEFAULT NULL,
  `date_dx` date DEFAULT NULL,
  `hosp_dx` varchar(5) DEFAULT NULL,
  `hosp_rx` varchar(5) DEFAULT NULL,
  `typedisch` varchar(2) DEFAULT NULL,
  `datedisch` date DEFAULT NULL,
  `minscl` varchar(5) DEFAULT NULL,
  `inscl` varchar(3) DEFAULT NULL,
  KEY `cid` (`cid`),
  KEY `diagcode` (`diagcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_chronic_hdc` */

DROP TABLE IF EXISTS `t_chronic_hdc`;

CREATE TABLE `t_chronic_hdc` (
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `age_y_dx` int(3) DEFAULT '0',
  `groupcode` int(3) DEFAULT '0',
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `p_hospcode` varchar(5) DEFAULT NULL,
  `d_hospcode` varchar(5) DEFAULT NULL,
  `p_pt_vhid` varchar(8) DEFAULT NULL,
  `d_pt_vhid` varchar(8) DEFAULT NULL,
  `p_typearea` varchar(1) DEFAULT NULL,
  `d_typearea` varchar(1) DEFAULT NULL,
  `input_hosp` varchar(5) DEFAULT NULL,
  `input_pid` varchar(15) DEFAULT NULL,
  `source_tb` varchar(20) DEFAULT NULL,
  `diagcode` varchar(10) NOT NULL,
  `date_dx` date DEFAULT NULL,
  `hosp_dx` varchar(5) DEFAULT NULL,
  `hosp_rx` varchar(5) DEFAULT NULL,
  `typedisch` varchar(2) DEFAULT NULL,
  `datedisch` date DEFAULT NULL,
  `minscl` varchar(5) DEFAULT NULL,
  `inscl` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`cid`,`diagcode`),
  KEY `cid` (`cid`),
  KEY `diagcode` (`diagcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_chronicfu` */

DROP TABLE IF EXISTS `t_chronicfu`;

CREATE TABLE `t_chronicfu` (
  `ld_bp1` date DEFAULT NULL,
  `ld_bp2` date DEFAULT NULL,
  `ld_hba1c` date DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `cid` varchar(13) NOT NULL,
  `sbp_1` varchar(10) DEFAULT NULL,
  `dbp_1` varchar(10) DEFAULT NULL,
  `sbp_2` varchar(10) DEFAULT NULL,
  `dbp_2` varchar(10) DEFAULT NULL,
  `hba1c` varchar(10) DEFAULT NULL,
  `ld_foot` date DEFAULT NULL,
  `foot` varchar(10) DEFAULT NULL,
  `ld_retina` date DEFAULT NULL,
  `retina` varchar(10) DEFAULT NULL,
  `control_dm` int(1) DEFAULT '0',
  `control_ht` int(1) DEFAULT '0',
  PRIMARY KEY (`cid`,`hospcode`),
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_ckd_egfr` */

DROP TABLE IF EXISTS `t_ckd_egfr`;

CREATE TABLE `t_ckd_egfr` (
  `HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `egfr_r1` varchar(20) DEFAULT '0',
  `egfr_d1` date DEFAULT NULL,
  `egfr_r2` varchar(20) DEFAULT '0',
  `egfr_d2` date DEFAULT NULL,
  `egfr_r3` varchar(20) DEFAULT '0',
  `egfr_d3` date DEFAULT NULL,
  `egfr_r4` varchar(20) DEFAULT '0',
  `egfr_d4` date DEFAULT NULL,
  `day1` int(2) DEFAULT '0',
  `day2` int(2) DEFAULT '0',
  `day3` int(2) DEFAULT '0',
  `sumseq` int(2) DEFAULT '0',
  `egfr_avg` varchar(20) DEFAULT NULL,
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `PID` (`PID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_ckd_ill_all` */

DROP TABLE IF EXISTS `t_ckd_ill_all`;

CREATE TABLE `t_ckd_ill_all` (
  `cid` varchar(13) NOT NULL,
  `group_diag` text,
  `group_date` text,
  `group_hos_dx` text,
  `min_date_dx` date DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_ckd_screen` */

DROP TABLE IF EXISTS `t_ckd_screen`;

CREATE TABLE `t_ckd_screen` (
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `mix_dx` varchar(255) DEFAULT NULL,
  `date_dx` varchar(255) DEFAULT NULL,
  `hosp_dx` varchar(255) DEFAULT NULL,
  `lab12_date` date DEFAULT NULL,
  `lab12_hosp` varchar(5) DEFAULT NULL,
  `lab12_result` varchar(10) DEFAULT NULL,
  `lab14_date` date DEFAULT NULL,
  `lab14_hosp` varchar(5) DEFAULT NULL,
  `lab14_result` varchar(10) DEFAULT NULL,
  `lab11_date` date DEFAULT NULL,
  `lab11_hosp` varchar(5) DEFAULT NULL,
  `lab11_result` varchar(10) DEFAULT NULL,
  `lab15_date` date DEFAULT NULL,
  `lab15_hosp` varchar(5) DEFAULT NULL,
  `lab15_result` varchar(10) DEFAULT NULL,
  `lab15_ok_result` varchar(10) DEFAULT NULL,
  `minlab_date` date DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_cvd_screen` */

DROP TABLE IF EXISTS `t_cvd_screen`;

CREATE TABLE `t_cvd_screen` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `source_tb` varchar(255) DEFAULT NULL,
  `mix_dx` varchar(255) DEFAULT NULL,
  `t_mix_dx` varchar(255) DEFAULT NULL,
  `type_dx` varchar(2) DEFAULT NULL,
  `ld_tc` date DEFAULT NULL,
  `rs_tc` varchar(10) DEFAULT NULL,
  `ih_tc` varchar(5) DEFAULT NULL,
  `ld_bp1` date DEFAULT NULL,
  `ih_bp1` varchar(5) DEFAULT NULL,
  `rs_bps1` varchar(10) DEFAULT NULL,
  `rs_bpd1` varchar(10) DEFAULT NULL,
  `ld_bp2` date DEFAULT NULL,
  `ih_bp2` varchar(5) DEFAULT NULL,
  `rs_bps2` varchar(10) DEFAULT NULL,
  `rs_bpd2` varchar(10) DEFAULT NULL,
  `height` smallint(6) DEFAULT '0',
  `weight` mediumint(9) DEFAULT '0',
  `waist_cm` smallint(6) DEFAULT '0',
  `smoking` int(1) DEFAULT '0',
  `cvdrisk_color` int(1) DEFAULT '0',
  `complication` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `type_dx` (`type_dx`)
) ENGINE=MyISAM AUTO_INCREMENT=8566 DEFAULT CHARSET=utf8;

/*Table structure for table `t_cvdrisk` */

DROP TABLE IF EXISTS `t_cvdrisk`;

CREATE TABLE `t_cvdrisk` (
  `CID` varchar(13) NOT NULL DEFAULT '',
  `BIRTH` date DEFAULT NULL,
  `SEX` varchar(1) NOT NULL,
  `TYPEAREA` varchar(1) NOT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `source_tb` varchar(255) DEFAULT NULL,
  `mix_dx` varchar(255) DEFAULT NULL,
  `t_mix_dx` varchar(255) DEFAULT NULL,
  `type_dx` varchar(2) DEFAULT NULL,
  `date_dx` varchar(255) DEFAULT NULL,
  `hosp_dx` varchar(255) DEFAULT NULL,
  `AGE_Y` int(3) NOT NULL DEFAULT '0',
  `SEX_CVD` varchar(1) DEFAULT NULL,
  `QUARTERM` varchar(1) NOT NULL DEFAULT '',
  `SMOKING` varchar(1) DEFAULT NULL,
  `SMOKE_DATE` date DEFAULT NULL,
  `SMOKE_HOSPCODE` varchar(5) DEFAULT NULL,
  `SMOKE_SOURCE` varchar(20) DEFAULT NULL,
  `DM` varchar(1) DEFAULT NULL,
  `SBP` int(3) NOT NULL DEFAULT '0',
  `SBP_DATE` date DEFAULT NULL,
  `SBP_HOSPCODE` varchar(5) DEFAULT NULL,
  `SBP_SOURCE` varchar(20) DEFAULT NULL,
  `CHOL` double(6,2) NOT NULL DEFAULT '0.00',
  `CHOL_DATE` date DEFAULT NULL,
  `CHOL_HOSPCODE` varchar(5) DEFAULT NULL,
  `WAIST_CM` int(3) NOT NULL DEFAULT '0',
  `WAIST_DATE` date DEFAULT NULL,
  `WAIST_HOSPCODE` varchar(5) DEFAULT NULL,
  `WAIST_SOURCE` varchar(20) DEFAULT NULL,
  `HEIGHT` int(3) NOT NULL DEFAULT '0',
  `HEIGHT_DATE` date DEFAULT NULL,
  `HEIGHT_HOSPCODE` varchar(5) DEFAULT NULL,
  `HEIGHT_SOURCE` varchar(20) DEFAULT NULL,
  `RISK_SCORE` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`CID`,`QUARTERM`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_cvdrisk_fl` */

DROP TABLE IF EXISTS `t_cvdrisk_fl`;

CREATE TABLE `t_cvdrisk_fl` (
  `CID` varchar(13) NOT NULL DEFAULT '',
  `BIRTH` date DEFAULT NULL,
  `SEX` varchar(1) NOT NULL,
  `TYPEAREA` varchar(1) NOT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `source_tb` varchar(255) DEFAULT NULL,
  `mix_dx` varchar(255) DEFAULT NULL,
  `t_mix_dx` varchar(255) DEFAULT NULL,
  `type_dx` varchar(2) DEFAULT NULL,
  `date_dx` varchar(255) DEFAULT NULL,
  `hosp_dx` varchar(255) DEFAULT NULL,
  `AGE_Y` int(3) NOT NULL DEFAULT '0',
  `SEX_CVD` varchar(1) DEFAULT NULL,
  `DM` varchar(1) DEFAULT NULL,
  `F_SMOKING` varchar(1) DEFAULT NULL,
  `F_SMOKE_DATE` date DEFAULT NULL,
  `F_SMOKE_HOSPCODE` varchar(5) DEFAULT NULL,
  `F_SMOKE_SOURCE` varchar(20) DEFAULT NULL,
  `L_SMOKING` varchar(1) DEFAULT NULL,
  `L_SMOKE_DATE` date DEFAULT NULL,
  `L_SMOKE_HOSPCODE` varchar(5) DEFAULT NULL,
  `L_SMOKE_SOURCE` varchar(20) DEFAULT NULL,
  `F_SBP` int(3) NOT NULL DEFAULT '0',
  `F_SBP_DATE` date DEFAULT NULL,
  `F_SBP_HOSPCODE` varchar(5) DEFAULT NULL,
  `F_SBP_SOURCE` varchar(20) DEFAULT NULL,
  `L_SBP` int(3) NOT NULL DEFAULT '0',
  `L_SBP_DATE` date DEFAULT NULL,
  `L_SBP_HOSPCODE` varchar(5) DEFAULT NULL,
  `L_SBP_SOURCE` varchar(20) DEFAULT NULL,
  `F_CHOL` double(6,2) NOT NULL DEFAULT '0.00',
  `F_CHOL_DATE` date DEFAULT NULL,
  `F_CHOL_HOSPCODE` varchar(5) DEFAULT NULL,
  `L_CHOL` double(6,2) NOT NULL DEFAULT '0.00',
  `L_CHOL_DATE` date DEFAULT NULL,
  `L_CHOL_HOSPCODE` varchar(5) DEFAULT NULL,
  `F_WAIST_CM` int(3) NOT NULL DEFAULT '0',
  `F_WAIST_DATE` date DEFAULT NULL,
  `F_WAIST_HOSPCODE` varchar(5) DEFAULT NULL,
  `F_WAIST_SOURCE` varchar(20) DEFAULT NULL,
  `L_WAIST_CM` int(3) NOT NULL DEFAULT '0',
  `L_WAIST_DATE` date DEFAULT NULL,
  `L_WAIST_HOSPCODE` varchar(5) DEFAULT NULL,
  `L_WAIST_SOURCE` varchar(20) DEFAULT NULL,
  `F_HEIGHT` int(3) NOT NULL DEFAULT '0',
  `F_HEIGHT_DATE` date DEFAULT NULL,
  `F_HEIGHT_HOSPCODE` varchar(5) DEFAULT NULL,
  `F_HEIGHT_SOURCE` varchar(20) DEFAULT NULL,
  `L_HEIGHT` int(3) NOT NULL DEFAULT '0',
  `L_HEIGHT_DATE` date DEFAULT NULL,
  `L_HEIGHT_HOSPCODE` varchar(5) DEFAULT NULL,
  `L_HEIGHT_SOURCE` varchar(20) DEFAULT NULL,
  `F_RISK_SCORE` decimal(5,2) NOT NULL DEFAULT '0.00',
  `L_RISK_SCORE` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`CID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_diag_opd_ipd` */

DROP TABLE IF EXISTS `t_diag_opd_ipd`;

CREATE TABLE `t_diag_opd_ipd` (
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(13) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `date_serv` date DEFAULT NULL,
  `diagtype` varchar(2) DEFAULT NULL,
  `diagcode` varchar(20) DEFAULT NULL,
  `vn` varchar(20) DEFAULT NULL,
  `hn` varchar(20) DEFAULT NULL,
  `proced` varchar(1) DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`),
  KEY `date_serv` (`date_serv`),
  KEY `proced` (`proced`),
  KEY `diagcode` (`diagcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_dmht` */

DROP TABLE IF EXISTS `t_dmht`;

CREATE TABLE `t_dmht` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `groupcode1560` varchar(100) DEFAULT NULL,
  `groupname1560` varchar(100) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `source_tb` varchar(255) DEFAULT NULL,
  `mix_dx` varchar(255) DEFAULT NULL,
  `t_mix_dx` varchar(255) DEFAULT NULL,
  `type_dx` varchar(2) DEFAULT NULL,
  `date_dx` varchar(255) DEFAULT NULL,
  `hosp_dx` varchar(255) DEFAULT NULL,
  `minscl` varchar(5) DEFAULT NULL,
  `inscl` varchar(3) DEFAULT NULL,
  `ld_hba1c` date DEFAULT NULL,
  `rs_hba1c` varchar(10) DEFAULT NULL,
  `ih_hba1c` varchar(5) DEFAULT NULL,
  `ld_fpg1` date DEFAULT NULL,
  `rs_fpg1` varchar(10) DEFAULT NULL,
  `ih_fpg1` varchar(5) DEFAULT NULL,
  `ld_fpg2` date DEFAULT NULL,
  `rs_fpg2` varchar(10) DEFAULT NULL,
  `ih_fpg2` varchar(5) DEFAULT NULL,
  `ld_fpg3` date DEFAULT NULL,
  `rs_fpg3` varchar(10) DEFAULT NULL,
  `ih_fpg3` varchar(5) DEFAULT NULL,
  `ld_creatinine` date DEFAULT NULL,
  `rs_creatinine` varchar(10) DEFAULT NULL,
  `ih_creatinine` varchar(5) DEFAULT NULL,
  `ld_lipid` date DEFAULT NULL,
  `rs_lipid` varchar(10) DEFAULT NULL,
  `ih_lipid` varchar(5) DEFAULT NULL,
  `ld_foot` date DEFAULT NULL,
  `rs_foot` varchar(10) DEFAULT NULL,
  `ih_foot` varchar(5) DEFAULT NULL,
  `ld_retina` date DEFAULT NULL,
  `rs_retina` varchar(10) DEFAULT NULL,
  `ih_retina` varchar(5) DEFAULT NULL,
  `ld_bp1` date DEFAULT NULL,
  `ih_bp1` varchar(5) DEFAULT NULL,
  `rs_bps1` varchar(10) DEFAULT NULL,
  `rs_bpd1` varchar(10) DEFAULT NULL,
  `ld_bp2` date DEFAULT NULL,
  `ih_bp2` varchar(5) DEFAULT NULL,
  `rs_bps2` varchar(10) DEFAULT NULL,
  `rs_bpd2` varchar(10) DEFAULT NULL,
  `complication_dm` varchar(20) DEFAULT '0',
  `complication_ht` varchar(20) DEFAULT '0',
  `control_dm` int(1) DEFAULT '0',
  `control_ht` int(1) DEFAULT '0',
  `bmi` decimal(10,2) DEFAULT '0.00',
  `obes` int(1) DEFAULT '0',
  `height` smallint(6) DEFAULT '0',
  `weight` mediumint(9) DEFAULT '0',
  `waist_cm` smallint(6) DEFAULT '0',
  `lookup` varchar(20) DEFAULT NULL,
  `lookup_update` date DEFAULT NULL,
  `follow_up` int(1) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`),
  KEY `id` (`id`),
  KEY `type_dx` (`type_dx`)
) ENGINE=MyISAM AUTO_INCREMENT=8566 DEFAULT CHARSET=utf8;

/*Table structure for table `t_dmht_hdc` */

DROP TABLE IF EXISTS `t_dmht_hdc`;

CREATE TABLE `t_dmht_hdc` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `groupcode1560` varchar(100) DEFAULT NULL,
  `groupname1560` varchar(100) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `source_tb` varchar(255) DEFAULT NULL,
  `mix_dx` varchar(255) DEFAULT NULL,
  `t_mix_dx` varchar(255) DEFAULT NULL,
  `type_dx` varchar(2) DEFAULT NULL,
  `date_dx` varchar(255) DEFAULT NULL,
  `hosp_dx` varchar(255) DEFAULT NULL,
  `minscl` varchar(5) DEFAULT NULL,
  `inscl` varchar(3) DEFAULT NULL,
  `ld_hba1c` date DEFAULT NULL,
  `rs_hba1c` varchar(10) DEFAULT NULL,
  `ih_hba1c` varchar(5) DEFAULT NULL,
  `ld_fpg1` date DEFAULT NULL,
  `rs_fpg1` varchar(10) DEFAULT NULL,
  `ih_fpg1` varchar(5) DEFAULT NULL,
  `ld_fpg2` date DEFAULT NULL,
  `rs_fpg2` varchar(10) DEFAULT NULL,
  `ih_fpg2` varchar(5) DEFAULT NULL,
  `ld_fpg3` date DEFAULT NULL,
  `rs_fpg3` varchar(10) DEFAULT NULL,
  `ih_fpg3` varchar(5) DEFAULT NULL,
  `ld_creatinine` date DEFAULT NULL,
  `rs_creatinine` varchar(10) DEFAULT NULL,
  `ih_creatinine` varchar(5) DEFAULT NULL,
  `ld_lipid` date DEFAULT NULL,
  `rs_lipid` varchar(10) DEFAULT NULL,
  `ih_lipid` varchar(5) DEFAULT NULL,
  `ld_foot` date DEFAULT NULL,
  `rs_foot` varchar(10) DEFAULT NULL,
  `ih_foot` varchar(5) DEFAULT NULL,
  `ld_retina` date DEFAULT NULL,
  `rs_retina` varchar(10) DEFAULT NULL,
  `ih_retina` varchar(5) DEFAULT NULL,
  `ld_bp1` date DEFAULT NULL,
  `ih_bp1` varchar(5) DEFAULT NULL,
  `rs_bps1` varchar(10) DEFAULT NULL,
  `rs_bpd1` varchar(10) DEFAULT NULL,
  `ld_bp2` date DEFAULT NULL,
  `ih_bp2` varchar(5) DEFAULT NULL,
  `rs_bps2` varchar(10) DEFAULT NULL,
  `rs_bpd2` varchar(10) DEFAULT NULL,
  `complication_dm` varchar(20) DEFAULT '0',
  `complication_ht` varchar(20) DEFAULT '0',
  `control_dm` int(1) DEFAULT '0',
  `control_ht` int(1) DEFAULT '0',
  `bmi` decimal(10,2) DEFAULT '0.00',
  `obes` int(1) DEFAULT '0',
  `height` smallint(6) DEFAULT '0',
  `weight` mediumint(9) DEFAULT '0',
  `waist_cm` smallint(6) DEFAULT '0',
  `min_date_dx_dm` date DEFAULT NULL,
  `min_date_dx_ht` date DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`),
  KEY `id` (`id`),
  KEY `type_dx` (`type_dx`)
) ENGINE=MyISAM AUTO_INCREMENT=128111 DEFAULT CHARSET=utf8;

/*Table structure for table `t_labor` */

DROP TABLE IF EXISTS `t_labor`;

CREATE TABLE `t_labor` (
  `hospcode` varchar(5) DEFAULT '',
  `pid` varchar(15) DEFAULT '',
  `cid` varchar(13) NOT NULL,
  `bdate` date NOT NULL,
  `birth` date DEFAULT '0000-00-00',
  `bresult` varchar(250) NOT NULL DEFAULT '',
  `bhosp` varchar(5) NOT NULL DEFAULT '',
  `btype` varchar(2) NOT NULL DEFAULT '',
  `gravida` varchar(2) NOT NULL DEFAULT '',
  `age_y` int(3) DEFAULT NULL,
  PRIMARY KEY (`cid`,`bdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_ncdscreen` */

DROP TABLE IF EXISTS `t_ncdscreen`;

CREATE TABLE `t_ncdscreen` (
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
  `CID` varchar(13) DEFAULT NULL,
  `error_code` varchar(255) DEFAULT NULL,
  `age_y` int(3) DEFAULT NULL,
  `check_hosp` varchar(5) DEFAULT NULL,
  `check_typearea` varchar(1) DEFAULT NULL,
  `TYPEAREA` varchar(1) DEFAULT NULL,
  `check_vhid` varchar(8) DEFAULT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `groupcode3560` int(3) DEFAULT NULL,
  `groupname3560` varchar(255) DEFAULT NULL,
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `check_hosp` (`check_hosp`),
  KEY `CID` (`CID`),
  KEY `DATE_SERV` (`DATE_SERV`),
  KEY `BSLEVEL` (`BSLEVEL`),
  KEY `BSTEST` (`BSTEST`),
  KEY `SBP_1` (`SBP_1`,`DBP_1`),
  KEY `SBP_2` (`SBP_2`,`DBP_2`),
  KEY `sex` (`sex`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_newborn` */

DROP TABLE IF EXISTS `t_newborn`;

CREATE TABLE `t_newborn` (
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT NULL,
  `mpid` int(11) DEFAULT NULL,
  `gravida` int(11) DEFAULT NULL,
  `ga` int(11) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `btime` varchar(6) CHARACTER SET tis620 DEFAULT NULL,
  `bplace` varchar(1) CHARACTER SET tis620 DEFAULT NULL,
  `bhosp` varchar(5) CHARACTER SET tis620 DEFAULT NULL,
  `birthno` varchar(1) CHARACTER SET tis620 DEFAULT NULL,
  `btype` varchar(1) CHARACTER SET tis620 DEFAULT NULL,
  `bdoctor` varchar(1) CHARACTER SET tis620 DEFAULT NULL,
  `bweight` int(4) DEFAULT NULL,
  `asphyxia` bigint(1) NOT NULL DEFAULT '0',
  `vitk` bigint(1) NOT NULL DEFAULT '0',
  `tsh` bigint(1) NOT NULL DEFAULT '0',
  `thsresult` double(15,1) DEFAULT NULL,
  `cid` varchar(13) CHARACTER SET tis620 DEFAULT NULL,
  `mcid` varchar(13) CHARACTER SET tis620 DEFAULT NULL,
  `fpid` int(11) DEFAULT NULL,
  `nation` varchar(3) DEFAULT '',
  `sex` varchar(1) DEFAULT '',
  `check_hosp` varchar(5) DEFAULT '',
  `check_vhid` varchar(8) DEFAULT NULL,
  `check_typearea` varchar(1) DEFAULT '',
  `vhid` varchar(8) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT '',
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `bdate` (`bdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_nutrition_service` */

DROP TABLE IF EXISTS `t_nutrition_service`;

CREATE TABLE `t_nutrition_service` (
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `seq` varchar(16) NOT NULL,
  `date_serv` date DEFAULT NULL,
  `weight` decimal(5,1) NOT NULL,
  `height` int(3) NOT NULL,
  `HEADCIRCUM` int(3) DEFAULT NULL,
  `FOOD` varchar(1) DEFAULT NULL,
  `BOTTLE` varchar(1) DEFAULT NULL,
  `BIRTH` date DEFAULT NULL,
  `SEX` varchar(1) NOT NULL,
  `NATION` varchar(3) DEFAULT NULL,
  `quarter_m` int(1) NOT NULL DEFAULT '0',
  `nutri1` int(1) DEFAULT '0',
  `nutri2` int(1) DEFAULT '0',
  `nutri3` int(1) DEFAULT '0',
  PRIMARY KEY (`hospcode`,`pid`,`quarter_m`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_nutrition05` */

DROP TABLE IF EXISTS `t_nutrition05`;

CREATE TABLE `t_nutrition05` (
  `CID` varchar(13) NOT NULL,
  `SEX` varchar(1) NOT NULL,
  `BIRTH` date DEFAULT NULL,
  `AGE_T1` varchar(5) DEFAULT NULL,
  `AGE_T2` varchar(5) DEFAULT NULL,
  `AGE_T3` varchar(5) DEFAULT NULL,
  `AGE_T4` varchar(5) DEFAULT NULL,
  `DATE_SERV1` date DEFAULT NULL,
  `DATE_SERV2` date DEFAULT NULL,
  `DATE_SERV3` date DEFAULT NULL,
  `DATE_SERV4` date DEFAULT NULL,
  `AGE_MS1` varchar(5) DEFAULT NULL,
  `AGE_MS2` varchar(5) DEFAULT NULL,
  `AGE_MS3` varchar(5) DEFAULT NULL,
  `AGE_MS4` varchar(5) DEFAULT NULL,
  `WEIGHT1` decimal(5,1) DEFAULT '0.0',
  `WEIGHT2` decimal(5,1) DEFAULT '0.0',
  `WEIGHT3` decimal(5,1) DEFAULT '0.0',
  `WEIGHT4` decimal(5,1) DEFAULT '0.0',
  `HEIGHT1` int(3) DEFAULT '0',
  `HEIGHT2` int(3) DEFAULT '0',
  `HEIGHT3` int(3) DEFAULT '0',
  `HEIGHT4` int(3) DEFAULT '0',
  `W_S1` varchar(1) DEFAULT NULL,
  `W_S2` varchar(1) DEFAULT NULL,
  `W_S3` varchar(1) DEFAULT NULL,
  `W_S4` varchar(1) DEFAULT NULL,
  `H_S1` varchar(1) DEFAULT NULL,
  `H_S2` varchar(1) DEFAULT NULL,
  `H_S3` varchar(1) DEFAULT NULL,
  `H_S4` varchar(1) DEFAULT NULL,
  `WH1` varchar(1) DEFAULT NULL,
  `WH2` varchar(1) DEFAULT NULL,
  `WH3` varchar(1) DEFAULT NULL,
  `WH4` varchar(1) DEFAULT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_nutrition6up` */

DROP TABLE IF EXISTS `t_nutrition6up`;

CREATE TABLE `t_nutrition6up` (
  `CID` varchar(13) NOT NULL,
  `SEX` varchar(1) NOT NULL,
  `BIRTH` date DEFAULT NULL,
  `AGE_T1` varchar(5) DEFAULT NULL,
  `AGE_T2` varchar(5) DEFAULT NULL,
  `DATE_SERV1` date DEFAULT NULL,
  `DATE_SERV2` date DEFAULT NULL,
  `AGE_MS1` varchar(5) DEFAULT NULL,
  `AGE_MS2` varchar(5) DEFAULT NULL,
  `WEIGHT1` decimal(5,1) DEFAULT '0.0',
  `WEIGHT2` decimal(5,1) DEFAULT '0.0',
  `HEIGHT1` int(3) DEFAULT '0',
  `HEIGHT2` int(3) DEFAULT '0',
  `W_S1` varchar(1) DEFAULT NULL,
  `W_S2` varchar(1) DEFAULT NULL,
  `H_S1` varchar(1) DEFAULT NULL,
  `H_S2` varchar(1) DEFAULT NULL,
  `WH1` varchar(1) DEFAULT NULL,
  `WH2` varchar(1) DEFAULT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `typearea` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_person` */

DROP TABLE IF EXISTS `t_person`;

CREATE TABLE `t_person` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `CID` varchar(13) DEFAULT NULL,
  `PID` varchar(15) NOT NULL DEFAULT '',
  `HID` varchar(14) DEFAULT NULL,
  `PRENAME` varchar(3) NOT NULL DEFAULT '',
  `NAME` varchar(50) NOT NULL DEFAULT '',
  `LNAME` varchar(50) NOT NULL DEFAULT '',
  `HN` varchar(15) DEFAULT NULL,
  `SEX` varchar(1) NOT NULL DEFAULT '',
  `BIRTH` date NOT NULL DEFAULT '0000-00-00',
  `MSTATUS` char(1) DEFAULT NULL,
  `OCCUPATION_OLD` varchar(3) DEFAULT NULL,
  `OCCUPATION_NEW` varchar(4) DEFAULT NULL,
  `RACE` varchar(3) DEFAULT NULL,
  `NATION` varchar(3) NOT NULL DEFAULT '',
  `RELIGION` varchar(2) DEFAULT NULL,
  `EDUCATION` varchar(2) DEFAULT NULL,
  `FSTATUS` varchar(1) DEFAULT NULL,
  `FATHER` varchar(13) DEFAULT NULL,
  `MOTHER` varchar(13) DEFAULT NULL,
  `COUPLE` varchar(13) DEFAULT NULL,
  `VSTATUS` varchar(1) DEFAULT NULL,
  `MOVEIN` date DEFAULT NULL,
  `DISCHARGE` varchar(1) DEFAULT NULL,
  `DDISCHARGE` date DEFAULT NULL,
  `ABOGROUP` varchar(1) DEFAULT NULL,
  `RHGROUP` varchar(1) DEFAULT NULL,
  `LABOR` varchar(2) DEFAULT NULL,
  `PASSPORT` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `D_UPDATE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CHECK_HOSP` varchar(5) NOT NULL DEFAULT '',
  `CHECK_TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `VHID` varchar(8) DEFAULT NULL,
  `CHECK_VHID` varchar(8) DEFAULT NULL,
  `MAININSCL` varchar(5) DEFAULT NULL,
  `INSCL` varchar(5) DEFAULT NULL,
  `LAT` varchar(100) DEFAULT NULL,
  `LNG` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `ERROR_CODE` varchar(255) DEFAULT NULL,
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `CID` (`CID`),
  KEY `PID` (`PID`),
  KEY `TYPEAREA` (`TYPEAREA`),
  KEY `CHECK_TYPEAREA` (`CHECK_TYPEAREA`),
  KEY `LABOR` (`LABOR`),
  KEY `NATION` (`NATION`),
  KEY `BIRTH` (`BIRTH`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_anc` */

DROP TABLE IF EXISTS `t_person_anc`;

CREATE TABLE `t_person_anc` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `typearea` varchar(1) NOT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `occupat_new` varchar(4) DEFAULT NULL,
  `gravida` varchar(2) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `bhosp` varchar(5) DEFAULT NULL,
  `input_bhosp` varchar(5) DEFAULT NULL,
  `g1_ga` varchar(2) DEFAULT NULL,
  `g1_date` date DEFAULT NULL,
  `g1_hospcode` varchar(5) DEFAULT NULL,
  `g1_input_hosp` varchar(5) DEFAULT NULL,
  `g2_ga` varchar(2) DEFAULT NULL,
  `g2_date` date DEFAULT NULL,
  `g2_hospcode` varchar(5) DEFAULT NULL,
  `g2_input_hosp` varchar(5) DEFAULT NULL,
  `g3_ga` varchar(2) DEFAULT NULL,
  `g3_date` date DEFAULT NULL,
  `g3_hospcode` varchar(5) DEFAULT NULL,
  `g3_input_hosp` varchar(5) DEFAULT NULL,
  `g4_ga` varchar(2) DEFAULT NULL,
  `g4_date` date DEFAULT NULL,
  `g4_hospcode` varchar(5) DEFAULT NULL,
  `g4_input_hosp` varchar(5) DEFAULT NULL,
  `g5_ga` varchar(2) DEFAULT NULL,
  `g5_date` date DEFAULT NULL,
  `g5_hospcode` varchar(5) DEFAULT NULL,
  `g5_input_hosp` varchar(5) DEFAULT NULL,
  `lookup` varchar(20) DEFAULT NULL,
  `lookup_update` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `typearea` (`typearea`)
) ENGINE=MyISAM AUTO_INCREMENT=528 DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_anc_hdc` */

DROP TABLE IF EXISTS `t_person_anc_hdc`;

CREATE TABLE `t_person_anc_hdc` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `typearea` varchar(1) NOT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `occupat_new` varchar(4) DEFAULT NULL,
  `gravida` varchar(2) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `bhosp` varchar(5) DEFAULT NULL,
  `input_bhosp` varchar(5) DEFAULT NULL,
  `g1_ga` varchar(2) DEFAULT NULL,
  `g1_date` date DEFAULT NULL,
  `g1_hospcode` varchar(5) DEFAULT NULL,
  `g1_input_hosp` varchar(5) DEFAULT NULL,
  `g2_ga` varchar(2) DEFAULT NULL,
  `g2_date` date DEFAULT NULL,
  `g2_hospcode` varchar(5) DEFAULT NULL,
  `g2_input_hosp` varchar(5) DEFAULT NULL,
  `g3_ga` varchar(2) DEFAULT NULL,
  `g3_date` date DEFAULT NULL,
  `g3_hospcode` varchar(5) DEFAULT NULL,
  `g3_input_hosp` varchar(5) DEFAULT NULL,
  `g4_ga` varchar(2) DEFAULT NULL,
  `g4_date` date DEFAULT NULL,
  `g4_hospcode` varchar(5) DEFAULT NULL,
  `g4_input_hosp` varchar(5) DEFAULT NULL,
  `g5_ga` varchar(2) DEFAULT NULL,
  `g5_date` date DEFAULT NULL,
  `g5_hospcode` varchar(5) DEFAULT NULL,
  `g5_input_hosp` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `typearea` (`typearea`)
) ENGINE=MyISAM AUTO_INCREMENT=24269 DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_ancfu` */

DROP TABLE IF EXISTS `t_person_ancfu`;

CREATE TABLE `t_person_ancfu` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `typearea` varchar(1) NOT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `regdate` date DEFAULT NULL,
  `g_regplace` text,
  `g_typearea` text,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `occupat_new` varchar(4) DEFAULT NULL,
  `gravida` varchar(2) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `bhosp` varchar(5) DEFAULT NULL,
  `input_bhosp` varchar(5) DEFAULT NULL,
  `g1_ga` varchar(2) DEFAULT NULL,
  `g1_date` date DEFAULT NULL,
  `g1_hospcode` varchar(5) DEFAULT NULL,
  `g1_input_hosp` varchar(5) DEFAULT NULL,
  `g2_ga` varchar(2) DEFAULT NULL,
  `g2_date` date DEFAULT NULL,
  `g2_hospcode` varchar(5) DEFAULT NULL,
  `g2_input_hosp` varchar(5) DEFAULT NULL,
  `g3_ga` varchar(2) DEFAULT NULL,
  `g3_date` date DEFAULT NULL,
  `g3_hospcode` varchar(5) DEFAULT NULL,
  `g3_input_hosp` varchar(5) DEFAULT NULL,
  `g4_ga` varchar(2) DEFAULT NULL,
  `g4_date` date DEFAULT NULL,
  `g4_hospcode` varchar(5) DEFAULT NULL,
  `g4_input_hosp` varchar(5) DEFAULT NULL,
  `g5_ga` varchar(2) DEFAULT NULL,
  `g5_date` date DEFAULT NULL,
  `g5_hospcode` varchar(5) DEFAULT NULL,
  `g5_input_hosp` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `pid` (`pid`),
  KEY `typearea` (`typearea`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_cid` */

DROP TABLE IF EXISTS `t_person_cid`;

CREATE TABLE `t_person_cid` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `CID` varchar(13) NOT NULL,
  `PID` varchar(15) NOT NULL DEFAULT '',
  `HID` varchar(14) DEFAULT NULL,
  `PRENAME` varchar(3) NOT NULL DEFAULT '',
  `NAME` varchar(50) NOT NULL DEFAULT '',
  `LNAME` varchar(50) NOT NULL DEFAULT '',
  `HN` varchar(15) DEFAULT NULL,
  `SEX` varchar(1) NOT NULL DEFAULT '',
  `BIRTH` date NOT NULL DEFAULT '0000-00-00',
  `MSTATUS` char(1) DEFAULT NULL,
  `OCCUPATION_OLD` varchar(3) DEFAULT NULL,
  `OCCUPATION_NEW` varchar(4) DEFAULT NULL,
  `RACE` varchar(3) DEFAULT NULL,
  `NATION` varchar(3) NOT NULL DEFAULT '',
  `RELIGION` varchar(2) DEFAULT NULL,
  `EDUCATION` varchar(2) DEFAULT NULL,
  `FSTATUS` varchar(1) DEFAULT NULL,
  `FATHER` varchar(13) DEFAULT NULL,
  `MOTHER` varchar(13) DEFAULT NULL,
  `COUPLE` varchar(13) DEFAULT NULL,
  `VSTATUS` varchar(1) DEFAULT NULL,
  `MOVEIN` date DEFAULT NULL,
  `DISCHARGE` varchar(1) DEFAULT NULL,
  `DDISCHARGE` date DEFAULT NULL,
  `ABOGROUP` varchar(1) DEFAULT NULL,
  `RHGROUP` varchar(1) DEFAULT NULL,
  `LABOR` varchar(2) DEFAULT NULL,
  `PASSPORT` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `D_UPDATE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `check_hosp` varchar(5) NOT NULL DEFAULT '',
  `check_typearea` varchar(1) NOT NULL DEFAULT '',
  `vhid` varchar(8) DEFAULT NULL,
  `check_vhid` varchar(8) DEFAULT NULL,
  `maininscl` varchar(5) DEFAULT NULL,
  `inscl` varchar(5) DEFAULT NULL,
  `age_y` int(3) DEFAULT NULL,
  PRIMARY KEY (`CID`),
  KEY `HOSPCODE_PID` (`HOSPCODE`,`PID`),
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `PID` (`PID`),
  KEY `TYPEAREA` (`TYPEAREA`),
  KEY `vhid` (`vhid`),
  KEY `check_vhid` (`check_vhid`),
  KEY `check_typearea` (`check_typearea`),
  KEY `check_hosp` (`check_hosp`),
  KEY `BIRTH` (`BIRTH`),
  KEY `LABOR` (`LABOR`),
  KEY `NATION` (`NATION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_cid_hdc` */

DROP TABLE IF EXISTS `t_person_cid_hdc`;

CREATE TABLE `t_person_cid_hdc` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `CID` varchar(13) NOT NULL,
  `PID` varchar(15) NOT NULL DEFAULT '',
  `HID` varchar(14) DEFAULT NULL,
  `PRENAME` varchar(3) NOT NULL DEFAULT '',
  `NAME` varchar(50) NOT NULL DEFAULT '',
  `LNAME` varchar(50) NOT NULL DEFAULT '',
  `HN` varchar(15) DEFAULT NULL,
  `SEX` varchar(1) NOT NULL DEFAULT '',
  `BIRTH` date NOT NULL DEFAULT '0000-00-00',
  `MSTATUS` char(1) DEFAULT NULL,
  `OCCUPATION_OLD` varchar(3) DEFAULT NULL,
  `OCCUPATION_NEW` varchar(4) DEFAULT NULL,
  `RACE` varchar(3) DEFAULT NULL,
  `NATION` varchar(3) NOT NULL DEFAULT '',
  `RELIGION` varchar(2) DEFAULT NULL,
  `EDUCATION` varchar(2) DEFAULT NULL,
  `FSTATUS` varchar(1) DEFAULT NULL,
  `FATHER` varchar(13) DEFAULT NULL,
  `MOTHER` varchar(13) DEFAULT NULL,
  `COUPLE` varchar(13) DEFAULT NULL,
  `VSTATUS` varchar(1) DEFAULT NULL,
  `MOVEIN` date DEFAULT NULL,
  `DISCHARGE` varchar(1) DEFAULT NULL,
  `DDISCHARGE` date DEFAULT NULL,
  `ABOGROUP` varchar(1) DEFAULT NULL,
  `RHGROUP` varchar(1) DEFAULT NULL,
  `LABOR` varchar(2) DEFAULT NULL,
  `PASSPORT` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `D_UPDATE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `check_hosp` varchar(5) NOT NULL DEFAULT '',
  `check_typearea` varchar(1) NOT NULL DEFAULT '',
  `vhid` varchar(8) DEFAULT NULL,
  `check_vhid` varchar(8) DEFAULT NULL,
  `maininscl` varchar(5) DEFAULT NULL,
  `inscl` varchar(5) DEFAULT NULL,
  `age_y` int(3) DEFAULT NULL,
  PRIMARY KEY (`CID`),
  KEY `HOSPCODE_PID` (`HOSPCODE`,`PID`),
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `PID` (`PID`),
  KEY `TYPEAREA` (`TYPEAREA`),
  KEY `vhid` (`vhid`),
  KEY `check_vhid` (`check_vhid`),
  KEY `check_typearea` (`check_typearea`),
  KEY `check_hosp` (`check_hosp`),
  KEY `BIRTH` (`BIRTH`),
  KEY `LABOR` (`LABOR`),
  KEY `NATION` (`NATION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_dm_screen` */

DROP TABLE IF EXISTS `t_person_dm_screen`;

CREATE TABLE `t_person_dm_screen` (
  `hospcode` varchar(5) DEFAULT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `typearea` varchar(1) DEFAULT NULL,
  `date_screen` date DEFAULT NULL,
  `bslevel` int(6) DEFAULT '0',
  `bstest` varchar(1) DEFAULT NULL,
  `ill` varchar(1) DEFAULT NULL,
  `risk` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `pid` (`pid`),
  KEY `typearea` (`typearea`),
  KEY `risk` (`risk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_epi` */

DROP TABLE IF EXISTS `t_person_epi`;

CREATE TABLE `t_person_epi` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `typearea` varchar(1) NOT NULL,
  `cid` varchar(13) NOT NULL,
  `birth` date DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `nation` varchar(3) DEFAULT NULL,
  `bweight` int(4) DEFAULT '0',
  `bw_input_hosp` varchar(5) DEFAULT NULL,
  `food` varchar(1) DEFAULT NULL,
  `food_date` date DEFAULT NULL,
  `food_input_hosp` varchar(5) DEFAULT NULL,
  `childdevelop` varchar(1) DEFAULT NULL,
  `childdevelop_date` date DEFAULT NULL,
  `childdevelop_input_hosp` varchar(5) DEFAULT NULL,
  `bcg_date` date DEFAULT NULL,
  `bcg_hospcode` varchar(5) DEFAULT NULL,
  `bcg_input_hosp` varchar(5) DEFAULT NULL,
  `hbv1_date` date DEFAULT NULL,
  `hbv1_hospcode` varchar(5) DEFAULT NULL,
  `hbv1_input_hosp` varchar(5) DEFAULT NULL,
  `hbv2_date` date DEFAULT NULL,
  `hbv2_hospcode` varchar(5) DEFAULT NULL,
  `hbv2_input_hosp` varchar(5) DEFAULT NULL,
  `hbv3_date` date DEFAULT NULL,
  `hbv3_hospcode` varchar(5) DEFAULT NULL,
  `hbv3_input_hosp` varchar(5) DEFAULT NULL,
  `opv1_date` date DEFAULT NULL,
  `opv1_hospcode` varchar(5) DEFAULT NULL,
  `opv1_input_hosp` varchar(5) DEFAULT NULL,
  `opv2_date` date DEFAULT NULL,
  `opv2_hospcode` varchar(5) DEFAULT NULL,
  `opv2_input_hosp` varchar(5) DEFAULT NULL,
  `opv3_date` date DEFAULT NULL,
  `opv3_hospcode` varchar(5) DEFAULT NULL,
  `opv3_input_hosp` varchar(5) DEFAULT NULL,
  `opv4_date` date DEFAULT NULL,
  `opv4_hospcode` varchar(5) DEFAULT NULL,
  `opv4_input_hosp` varchar(5) DEFAULT NULL,
  `opv5_date` date DEFAULT NULL,
  `opv5_hospcode` varchar(5) DEFAULT NULL,
  `opv5_input_hosp` varchar(5) DEFAULT NULL,
  `opvs1_date` date DEFAULT NULL,
  `opvs1_hospcode` varchar(5) DEFAULT NULL,
  `opvs1_input_hosp` varchar(5) DEFAULT NULL,
  `opvs2_date` date DEFAULT NULL,
  `opvs2_hospcode` varchar(5) DEFAULT NULL,
  `opvs2_input_hosp` varchar(5) DEFAULT NULL,
  `opvs3_date` date DEFAULT NULL,
  `opvs3_hospcode` varchar(5) DEFAULT NULL,
  `opvs3_input_hosp` varchar(5) DEFAULT NULL,
  `dtp1_date` date DEFAULT NULL,
  `dtp1_hospcode` varchar(5) DEFAULT NULL,
  `dtp1_input_hosp` varchar(5) DEFAULT NULL,
  `dtp2_date` date DEFAULT NULL,
  `dtp2_hospcode` varchar(5) DEFAULT NULL,
  `dtp2_input_hosp` varchar(5) DEFAULT NULL,
  `dtp3_date` date DEFAULT NULL,
  `dtp3_hospcode` varchar(5) DEFAULT NULL,
  `dtp3_input_hosp` varchar(5) DEFAULT NULL,
  `dtp4_date` date DEFAULT NULL,
  `dtp4_hospcode` varchar(5) DEFAULT NULL,
  `dtp4_input_hosp` varchar(5) DEFAULT NULL,
  `dtp5_date` date DEFAULT NULL,
  `dtp5_hospcode` varchar(5) DEFAULT NULL,
  `dtp5_input_hosp` varchar(5) DEFAULT NULL,
  `bcgs_date` date DEFAULT NULL,
  `bcgs_hospcode` varchar(5) DEFAULT NULL,
  `bcgs_input_hosp` varchar(5) DEFAULT NULL,
  `dts1_date` date DEFAULT NULL,
  `dts1_hospcode` varchar(5) DEFAULT NULL,
  `dts1_input_hosp` varchar(5) DEFAULT NULL,
  `dts2_date` date DEFAULT NULL,
  `dts2_hospcode` varchar(5) DEFAULT NULL,
  `dts2_input_hosp` varchar(5) DEFAULT NULL,
  `dts3_date` date DEFAULT NULL,
  `dts3_hospcode` varchar(5) DEFAULT NULL,
  `dts3_input_hosp` varchar(5) DEFAULT NULL,
  `dts4_date` date DEFAULT NULL,
  `dts4_hospcode` varchar(5) DEFAULT NULL,
  `dts4_input_hosp` varchar(5) DEFAULT NULL,
  `je1_date` date DEFAULT NULL,
  `je1_hospcode` varchar(5) DEFAULT NULL,
  `je1_input_hosp` varchar(5) DEFAULT NULL,
  `je2_date` date DEFAULT NULL,
  `je2_hospcode` varchar(5) DEFAULT NULL,
  `je2_input_hosp` varchar(5) DEFAULT NULL,
  `je3_date` date DEFAULT NULL,
  `je3_hospcode` varchar(5) DEFAULT NULL,
  `je3_input_hosp` varchar(5) DEFAULT NULL,
  `j11_date` date DEFAULT NULL,
  `j11_hospcode` varchar(5) DEFAULT NULL,
  `j11_input_hosp` varchar(5) DEFAULT NULL,
  `j12_date` date DEFAULT NULL,
  `j12_hospcode` varchar(5) DEFAULT NULL,
  `j12_input_hosp` varchar(5) DEFAULT NULL,
  `mmr1_date` date DEFAULT NULL,
  `mmr1_hospcode` varchar(5) DEFAULT NULL,
  `mmr1_input_hosp` varchar(5) DEFAULT NULL,
  `mmr2_date` date DEFAULT NULL,
  `mmr2_hospcode` varchar(5) DEFAULT NULL,
  `mmr2_input_hosp` varchar(5) DEFAULT NULL,
  `mmrs_date` date DEFAULT NULL,
  `mmrs_hospcode` varchar(5) DEFAULT NULL,
  `mmrs_input_hosp` varchar(5) DEFAULT NULL,
  `hpv1_date` date DEFAULT NULL,
  `hpv1_hospcode` varchar(5) DEFAULT NULL,
  `hpv1_input_hosp` varchar(5) DEFAULT NULL,
  `hpv2_date` date DEFAULT NULL,
  `hpv2_hospcode` varchar(5) DEFAULT NULL,
  `hpv2_input_hosp` varchar(5) DEFAULT NULL,
  `hpv3_date` date DEFAULT NULL,
  `hpv3_hospcode` varchar(5) DEFAULT NULL,
  `hpv3_input_hosp` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `typearea` (`typearea`)
) ENGINE=MyISAM AUTO_INCREMENT=8484 DEFAULT CHARSET=utf8;

/*Table structure for table `t_person_ht_screen` */

DROP TABLE IF EXISTS `t_person_ht_screen`;

CREATE TABLE `t_person_ht_screen` (
  `hospcode` varchar(5) DEFAULT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `age_y` int(3) DEFAULT '0',
  `typearea` varchar(1) DEFAULT NULL,
  `date_screen` date DEFAULT NULL,
  `sbp_1` int(3) DEFAULT '0',
  `dbp_1` int(3) DEFAULT '0',
  `sbp_2` int(3) DEFAULT '0',
  `dbp_2` int(3) DEFAULT '0',
  `ill` varchar(1) DEFAULT NULL,
  `sbp` int(3) DEFAULT '0',
  `dbp` int(3) DEFAULT '0',
  `risk` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `pid` (`pid`),
  KEY `typearea` (`typearea`),
  KEY `risk` (`risk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_postnatal` */

DROP TABLE IF EXISTS `t_postnatal`;

CREATE TABLE `t_postnatal` (
  `HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `GRAVIDA` varchar(2) NOT NULL,
  `BDATE` date NOT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `nation` varchar(3) DEFAULT '',
  `occupat` varchar(4) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `ppcare1` date DEFAULT NULL,
  `ppcare1_hosp` varchar(5) DEFAULT NULL,
  `ppcare1_input_hosp` varchar(5) DEFAULT NULL,
  `ppcare2` date DEFAULT NULL,
  `ppcare2_hosp` varchar(5) DEFAULT NULL,
  `ppcare2_input_hosp` varchar(5) DEFAULT NULL,
  `ppcare3` date DEFAULT NULL,
  `ppcare3_hosp` varchar(5) DEFAULT NULL,
  `ppcare3_input_hosp` varchar(5) DEFAULT NULL,
  KEY `cid` (`cid`),
  KEY `HOSPCODE` (`HOSPCODE`,`PID`),
  KEY `BDATE` (`BDATE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `t_target_childdev9183042` */

DROP TABLE IF EXISTS `t_target_childdev9183042`;

CREATE TABLE `t_target_childdev9183042` (
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `PID` varchar(15) NOT NULL DEFAULT '',
  `CID` varchar(13) NOT NULL,
  `BIRTH` date NOT NULL DEFAULT '0000-00-00',
  `AREACODE` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `AGE_9` int(1) NOT NULL DEFAULT '0',
  `AGE_18` int(1) NOT NULL DEFAULT '0',
  `AGE_30` int(1) NOT NULL DEFAULT '0',
  `AGE_42` int(1) NOT NULL DEFAULT '0',
  `DATE_SERV` date DEFAULT NULL,
  `AGE_SERV` int(1) NOT NULL DEFAULT '0',
  `PASS` int(1) NOT NULL DEFAULT '0',
  `DATE_START` date DEFAULT NULL,
  `DATE_END` date DEFAULT NULL,
  KEY `HOSPCODE` (`HOSPCODE`,`PID`,`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `thaiaddress` */

DROP TABLE IF EXISTS `thaiaddress`;

CREATE TABLE `thaiaddress` (
  `addressid` varchar(6) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `chwpart` char(2) DEFAULT NULL,
  `amppart` char(2) DEFAULT NULL,
  `tmbpart` char(2) DEFAULT NULL,
  `codetype` char(1) DEFAULT NULL,
  `pocode` varchar(5) DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`addressid`),
  KEY `ix_amppart` (`amppart`),
  KEY `ix_chwpart` (`chwpart`),
  KEY `ix_codetype` (`codetype`),
  KEY `ix_name` (`name`),
  KEY `ix_tmbpart` (`tmbpart`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

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
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=tis620;

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
  `lastlogin` text,
  `timezone` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `wm_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=12306 DEFAULT CHARSET=utf8;

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
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

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

/*Table structure for table `wmc_import_log` */

DROP TABLE IF EXISTS `wmc_import_log`;

CREATE TABLE `wmc_import_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `importtime` datetime DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `countfiles` int(11) DEFAULT '0',
  `datasize` double(22,2) DEFAULT '0.00',
  `success_no` int(11) DEFAULT '0',
  `error_no` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102465 DEFAULT CHARSET=utf8;

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

/*Table structure for table `wmc_tranfer_command` */

DROP TABLE IF EXISTS `wmc_tranfer_command`;

CREATE TABLE `wmc_tranfer_command` (
  `wtc_id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `usercid` varchar(13) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `person_id` varchar(13) DEFAULT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  `confirmtime` datetime DEFAULT NULL,
  `table` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `column` varchar(50) DEFAULT NULL,
  `oldvalue` text,
  `newvalue` text,
  `sqlquery_cs` varchar(255) DEFAULT NULL,
  `sqlquery` text,
  `process` varchar(50) DEFAULT 'manaual',
  `command_status` varchar(50) DEFAULT 'wait',
  `command_message` text,
  `processtime` datetime DEFAULT NULL,
  `wtc_active` int(1) DEFAULT '1',
  `ref_values` text,
  PRIMARY KEY (`wtc_id`),
  UNIQUE KEY `k_index` (`hospcode`,`cid`,`sqlquery_cs`)
) ENGINE=MyISAM AUTO_INCREMENT=732 DEFAULT CHARSET=utf8;

/*Table structure for table `wmc_tranfer_command_lab` */

DROP TABLE IF EXISTS `wmc_tranfer_command_lab`;

CREATE TABLE `wmc_tranfer_command_lab` (
  `wtc_id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `usercid` varchar(13) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `person_id` varchar(13) DEFAULT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  `confirmtime` datetime DEFAULT NULL,
  `table` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `column` varchar(50) DEFAULT NULL,
  `oldvalue` text,
  `newvalue` text,
  `sqlquery_cs` varchar(255) DEFAULT NULL,
  `sqlquery` text,
  `process` varchar(50) DEFAULT 'manaual',
  `command_status` varchar(50) DEFAULT 'wait',
  `command_message` text,
  `processtime` datetime DEFAULT NULL,
  `wtc_active` int(1) DEFAULT '1',
  `ref_values` text,
  PRIMARY KEY (`wtc_id`),
  UNIQUE KEY `k_index` (`hospcode`,`cid`,`sqlquery_cs`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

/*Table structure for table `ws_anc5` */

DROP TABLE IF EXISTS `ws_anc5`;

CREATE TABLE `ws_anc5` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_cervix_screen60` */

DROP TABLE IF EXISTS `ws_cervix_screen60`;

CREATE TABLE `ws_cervix_screen60` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(7) DEFAULT '0',
  `r11` int(7) DEFAULT '0',
  `r12` int(7) DEFAULT '0',
  `r13` int(7) DEFAULT '0',
  `r21` int(7) DEFAULT '0',
  `r22` int(7) DEFAULT '0',
  `r23` int(7) DEFAULT '0',
  `r24` int(7) DEFAULT '0',
  `r31` int(7) DEFAULT '0',
  `r32` int(7) DEFAULT '0',
  `r33` int(7) DEFAULT '0',
  `r34` int(7) DEFAULT '0',
  `r41` int(7) DEFAULT '0',
  `r42` int(7) DEFAULT '0',
  `r43` int(7) DEFAULT '0',
  `r44` int(7) DEFAULT '0',
  `r51` int(7) DEFAULT '0',
  `r52` int(7) DEFAULT '0',
  `r53` int(7) DEFAULT '0',
  `r54` int(7) DEFAULT '0',
  `p11` int(7) DEFAULT '0',
  `p12` int(7) DEFAULT '0',
  `p13` int(7) DEFAULT '0',
  `p21` int(7) DEFAULT '0',
  `p22` int(7) DEFAULT '0',
  `p23` int(7) DEFAULT '0',
  `p24` int(7) DEFAULT '0',
  `p31` int(7) DEFAULT '0',
  `p32` int(7) DEFAULT '0',
  `p33` int(7) DEFAULT '0',
  `p34` int(7) DEFAULT '0',
  `p41` int(7) DEFAULT '0',
  `p42` int(7) DEFAULT '0',
  `p43` int(7) DEFAULT '0',
  `p44` int(7) DEFAULT '0',
  `p51` int(7) DEFAULT '0',
  `p52` int(7) DEFAULT '0',
  `p53` int(7) DEFAULT '0',
  `p54` int(7) DEFAULT '0',
  `v11` int(7) DEFAULT '0',
  `v12` int(7) DEFAULT '0',
  `v13` int(7) DEFAULT '0',
  `v21` int(7) DEFAULT '0',
  `v22` int(7) DEFAULT '0',
  `v23` int(7) DEFAULT '0',
  `v24` int(7) DEFAULT '0',
  `v31` int(7) DEFAULT '0',
  `v32` int(7) DEFAULT '0',
  `v33` int(7) DEFAULT '0',
  `v34` int(7) DEFAULT '0',
  `v41` int(7) DEFAULT '0',
  `v42` int(7) DEFAULT '0',
  `v43` int(7) DEFAULT '0',
  `v44` int(7) DEFAULT '0',
  `v51` int(7) DEFAULT '0',
  `v52` int(7) DEFAULT '0',
  `v53` int(7) DEFAULT '0',
  `v54` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_childdev_specialpp` */

DROP TABLE IF EXISTS `ws_childdev_specialpp`;

CREATE TABLE `ws_childdev_specialpp` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) NOT NULL,
  `date_com` varchar(14) NOT NULL,
  `b_year` varchar(4) NOT NULL,
  `monthly` varchar(2) NOT NULL,
  `target` int(10) DEFAULT '0',
  `result` int(10) DEFAULT '0',
  `target9` int(10) DEFAULT '0',
  `result9_1` int(10) DEFAULT '0',
  `result9_2` int(10) DEFAULT '0',
  `result9_3` int(10) DEFAULT '0',
  `result9_4` int(10) DEFAULT '0',
  `result9_5` int(10) DEFAULT '0',
  `result9_6` int(10) DEFAULT '0',
  `result9_7` int(10) DEFAULT '0',
  `result9_8` int(10) DEFAULT '0',
  `result9_9` int(10) DEFAULT '0',
  `target18` int(10) DEFAULT '0',
  `result18_1` int(10) DEFAULT '0',
  `result18_2` int(10) DEFAULT '0',
  `result18_3` int(10) DEFAULT '0',
  `result18_4` int(10) DEFAULT '0',
  `result18_5` int(10) DEFAULT '0',
  `result18_6` int(10) DEFAULT '0',
  `result18_7` int(10) DEFAULT '0',
  `result18_8` int(10) DEFAULT '0',
  `result18_9` int(10) DEFAULT '0',
  `target30` int(10) DEFAULT '0',
  `result30_1` int(10) DEFAULT '0',
  `result30_2` int(10) DEFAULT '0',
  `result30_3` int(10) DEFAULT '0',
  `result30_4` int(10) DEFAULT '0',
  `result30_5` int(10) DEFAULT '0',
  `result30_6` int(10) DEFAULT '0',
  `result30_7` int(10) DEFAULT '0',
  `result30_8` int(10) DEFAULT '0',
  `result30_9` int(10) DEFAULT '0',
  `target42` int(10) DEFAULT '0',
  `result42_1` int(10) DEFAULT '0',
  `result42_2` int(10) DEFAULT '0',
  `result42_3` int(10) DEFAULT '0',
  `result42_4` int(10) DEFAULT '0',
  `result42_5` int(10) DEFAULT '0',
  `result42_6` int(10) DEFAULT '0',
  `result42_7` int(10) DEFAULT '0',
  `result42_8` int(10) DEFAULT '0',
  `result42_9` int(10) DEFAULT '0',
  `improper9` int(10) DEFAULT '0',
  `improper18` int(10) DEFAULT '0',
  `improper30` int(10) DEFAULT '0',
  `improper42` int(10) DEFAULT '0',
  PRIMARY KEY (`hospcode`,`areacode`,`b_year`,`monthly`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_dm_control` */

DROP TABLE IF EXISTS `ws_dm_control`;

CREATE TABLE `ws_dm_control` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `hba1c` int(9) DEFAULT '0',
  `target1` int(9) DEFAULT '0',
  `result1` int(9) DEFAULT '0',
  `hba1c1` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_dm_retina` */

DROP TABLE IF EXISTS `ws_dm_retina`;

CREATE TABLE `ws_dm_retina` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `result10` int(7) DEFAULT '0',
  `result11` int(7) DEFAULT '0',
  `result12` int(7) DEFAULT '0',
  `result01` int(7) DEFAULT '0',
  `result02` int(7) DEFAULT '0',
  `result03` int(7) DEFAULT '0',
  `result04` int(7) DEFAULT '0',
  `result05` int(7) DEFAULT '0',
  `result06` int(7) DEFAULT '0',
  `result07` int(7) DEFAULT '0',
  `result08` int(7) DEFAULT '0',
  `result09` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_dm_screen_pop_age` */

DROP TABLE IF EXISTS `ws_dm_screen_pop_age`;

CREATE TABLE `ws_dm_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_epi3` */

DROP TABLE IF EXISTS `ws_epi3`;

CREATE TABLE `ws_epi3` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target10` int(7) DEFAULT '0',
  `target11` int(7) DEFAULT '0',
  `target12` int(7) DEFAULT '0',
  `target01` int(7) DEFAULT '0',
  `target02` int(7) DEFAULT '0',
  `target03` int(7) DEFAULT '0',
  `target04` int(7) DEFAULT '0',
  `target05` int(7) DEFAULT '0',
  `target06` int(7) DEFAULT '0',
  `target07` int(7) DEFAULT '0',
  `target08` int(7) DEFAULT '0',
  `target09` int(7) DEFAULT '0',
  `je3_10` int(7) DEFAULT '0',
  `je3_11` int(7) DEFAULT '0',
  `je3_12` int(7) DEFAULT '0',
  `je3_01` int(7) DEFAULT '0',
  `je3_02` int(7) DEFAULT '0',
  `je3_03` int(7) DEFAULT '0',
  `je3_04` int(7) DEFAULT '0',
  `je3_05` int(7) DEFAULT '0',
  `je3_06` int(7) DEFAULT '0',
  `je3_07` int(7) DEFAULT '0',
  `je3_08` int(7) DEFAULT '0',
  `je3_09` int(7) DEFAULT '0',
  `mmr2_10` int(7) DEFAULT '0',
  `mmr2_11` int(7) DEFAULT '0',
  `mmr2_12` int(7) DEFAULT '0',
  `mmr2_01` int(7) DEFAULT '0',
  `mmr2_02` int(7) DEFAULT '0',
  `mmr2_03` int(7) DEFAULT '0',
  `mmr2_04` int(7) DEFAULT '0',
  `mmr2_05` int(7) DEFAULT '0',
  `mmr2_06` int(7) DEFAULT '0',
  `mmr2_07` int(7) DEFAULT '0',
  `mmr2_08` int(7) DEFAULT '0',
  `mmr2_09` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_ht_control` */

DROP TABLE IF EXISTS `ws_ht_control`;

CREATE TABLE `ws_ht_control` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `bp` int(9) DEFAULT '0',
  `target1` int(9) DEFAULT '0',
  `result1` int(9) DEFAULT '0',
  `bp1` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_ht_screen_pop_age` */

DROP TABLE IF EXISTS `ws_ht_screen_pop_age`;

CREATE TABLE `ws_ht_screen_pop_age` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `pop_group2` int(9) DEFAULT '0',
  `result_group2` int(9) DEFAULT '0',
  `pop_group3` int(9) DEFAULT '0',
  `result_group3` int(9) DEFAULT '0',
  `pop_group4` int(9) DEFAULT '0',
  `result_group4` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_kpi_anc12` */

DROP TABLE IF EXISTS `ws_kpi_anc12`;

CREATE TABLE `ws_kpi_anc12` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_kpi_childev_prov` */

DROP TABLE IF EXISTS `ws_kpi_childev_prov`;

CREATE TABLE `ws_kpi_childev_prov` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) DEFAULT NULL,
  `target` int(7) DEFAULT '0',
  `result` int(7) DEFAULT '0',
  `target1` int(7) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  `target3` int(7) DEFAULT '0',
  `result3` int(7) DEFAULT '0',
  `target4` int(7) DEFAULT '0',
  `result4` int(7) DEFAULT '0',
  UNIQUE KEY `id` (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_kpi_ckd_screen` */

DROP TABLE IF EXISTS `ws_kpi_ckd_screen`;

CREATE TABLE `ws_kpi_ckd_screen` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `areacode` varchar(8) DEFAULT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) DEFAULT NULL,
  `target` int(10) NOT NULL DEFAULT '0',
  `result` int(10) NOT NULL DEFAULT '0',
  `result1` int(10) NOT NULL DEFAULT '0',
  `result2` int(10) NOT NULL DEFAULT '0',
  `result3` int(10) NOT NULL DEFAULT '0',
  `result4` int(10) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_kpi_slender6_14` */

DROP TABLE IF EXISTS `ws_kpi_slender6_14`;

CREATE TABLE `ws_kpi_slender6_14` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target1` int(10) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `target2` int(10) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_kpi_slender6_14_1` */

DROP TABLE IF EXISTS `ws_kpi_slender6_14_1`;

CREATE TABLE `ws_kpi_slender6_14_1` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(10) DEFAULT '0',
  `result1` int(7) DEFAULT '0',
  `result2` int(7) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_nutrition05` */

DROP TABLE IF EXISTS `ws_nutrition05`;

CREATE TABLE `ws_nutrition05` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target1` int(10) DEFAULT '0',
  `result1` int(10) DEFAULT '0',
  `ws1` int(10) DEFAULT '0',
  `hs1` int(10) DEFAULT '0',
  `wh1` int(10) DEFAULT '0',
  `fit1` int(10) DEFAULT '0',
  `target2` int(10) DEFAULT '0',
  `result2` int(10) DEFAULT '0',
  `ws2` int(10) DEFAULT '0',
  `hs2` int(10) DEFAULT '0',
  `wh2` int(10) DEFAULT '0',
  `fit2` int(10) DEFAULT '0',
  `target3` int(10) DEFAULT '0',
  `result3` int(10) DEFAULT '0',
  `ws3` int(10) DEFAULT '0',
  `hs3` int(10) DEFAULT '0',
  `wh3` int(10) DEFAULT '0',
  `fit3` int(10) DEFAULT '0',
  `target4` int(10) DEFAULT '0',
  `result4` int(10) DEFAULT '0',
  `ws4` int(10) DEFAULT '0',
  `hs4` int(10) DEFAULT '0',
  `wh4` int(10) DEFAULT '0',
  `fit4` int(10) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `ws_postnatal` */

DROP TABLE IF EXISTS `ws_postnatal`;

CREATE TABLE `ws_postnatal` (
  `id` varchar(32) NOT NULL,
  `hospcode` varchar(5) NOT NULL,
  `areacode` varchar(8) NOT NULL,
  `flag_sent` varchar(1) DEFAULT NULL,
  `date_com` varchar(14) DEFAULT NULL,
  `b_year` varchar(4) NOT NULL,
  `target` int(9) DEFAULT '0',
  `result` int(9) DEFAULT '0',
  `target10` int(9) DEFAULT '0',
  `result10` int(9) DEFAULT '0',
  `target11` int(9) DEFAULT '0',
  `result11` int(9) DEFAULT '0',
  `target12` int(9) DEFAULT '0',
  `result12` int(9) DEFAULT '0',
  `target01` int(9) DEFAULT '0',
  `result01` int(9) DEFAULT '0',
  `target02` int(9) DEFAULT '0',
  `result02` int(9) DEFAULT '0',
  `target03` int(9) DEFAULT '0',
  `result03` int(9) DEFAULT '0',
  `target04` int(9) DEFAULT '0',
  `result04` int(9) DEFAULT '0',
  `target05` int(9) DEFAULT '0',
  `result05` int(9) DEFAULT '0',
  `target06` int(9) DEFAULT '0',
  `result06` int(9) DEFAULT '0',
  `target07` int(9) DEFAULT '0',
  `result07` int(9) DEFAULT '0',
  `target08` int(9) DEFAULT '0',
  `result08` int(9) DEFAULT '0',
  `target09` int(9) DEFAULT '0',
  `result09` int(9) DEFAULT '0',
  PRIMARY KEY (`id`,`hospcode`,`areacode`,`b_year`),
  KEY `hospcode` (`hospcode`),
  KEY `areacode` (`areacode`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

/*Table structure for table `xdesc_tables` */

DROP TABLE IF EXISTS `xdesc_tables`;

CREATE TABLE `xdesc_tables` (
  `table_schema` varchar(100) NOT NULL DEFAULT '',
  `table_name` varchar(100) NOT NULL DEFAULT '',
  `column_name` varchar(100) NOT NULL DEFAULT '',
  `column_key` varchar(3) NOT NULL DEFAULT '',
  KEY `table_schema` (`table_schema`),
  KEY `table_name` (`table_name`),
  KEY `column_name` (`column_name`),
  KEY `column_key` (`column_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `xws_summary` */

DROP TABLE IF EXISTS `xws_summary`;

CREATE TABLE `xws_summary` (
  `hospcode` varchar(5) NOT NULL,
  `ws_md5` varbinary(32) NOT NULL DEFAULT '',
  `p` decimal(8,2) DEFAULT NULL,
  `ss_target` int(11) DEFAULT NULL,
  `ss_result` int(11) DEFAULT NULL,
  `b_year` int(4) DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `ws_md5` (`ws_md5`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `xws_summary_hdc` */

DROP TABLE IF EXISTS `xws_summary_hdc`;

CREATE TABLE `xws_summary_hdc` (
  `hospcode` varchar(5) NOT NULL,
  `ws_md5` varbinary(32) NOT NULL DEFAULT '',
  `p` decimal(8,2) DEFAULT NULL,
  `ss_target` int(11) DEFAULT NULL,
  `ss_result` int(11) DEFAULT NULL,
  `b_year` int(4) DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `ws_md5` (`ws_md5`),
  KEY `b_year` (`b_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `YiiSession` */

DROP TABLE IF EXISTS `YiiSession`;

CREATE TABLE `YiiSession` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  `user_id` int(11) NOT NULL,
  `last_activity` datetime NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `sync` */

/*!50106 DROP EVENT IF EXISTS `sync`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`ptaung`@`%` EVENT `sync` ON SCHEDULE EVERY 5 MINUTE STARTS '2016-11-10 20:37:16' ON COMPLETION NOT PRESERVE ENABLE DO CALL task_schedule_tranfer */$$
DELIMITER ;

/* Event structure for event `task_anc` */

/*!50106 DROP EVENT IF EXISTS `task_anc`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`ptaung`@`%` EVENT `task_anc` ON SCHEDULE EVERY 3 HOUR STARTS '2017-08-08 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
CALL report_person_anc;
CALL report_service_anc;
CALL dlc_anc;
END */$$
DELIMITER ;

/* Event structure for event `task_epi` */

/*!50106 DROP EVENT IF EXISTS `task_epi`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`ptaung`@`%` EVENT `task_epi` ON SCHEDULE EVERY 1 DAY STARTS '2016-06-01 06:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	    call dlc_epi;
	END */$$
DELIMITER ;

/* Event structure for event `wmwebmanager` */

/*!50106 DROP EVENT IF EXISTS `wmwebmanager`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`ptaung`@`%` EVENT `wmwebmanager` ON SCHEDULE EVERY 1 DAY STARTS '2016-06-01 04:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
CALL xrunscript;
CALL dlc_epi;
END */$$
DELIMITER ;

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

/* Procedure structure for procedure `add_ix_vn` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_ix_vn` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `add_ix_vn`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	#DECLARE EXIT HANDLER FOR SQLEXCEPTION SELECT "SQLException Error Code: 1061. Duplicate key name 'ix_vn'";
	DECLARE CONTINUE HANDLER FOR 1061 SELECT "MySQL error code 1061 Duplicate key name 'ix_vn'";
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     SET @output = CONCAT("/*add_ix_vn ",db," */
		ALTER IGNORE TABLE `dw_",db,"`.`clinicmember_cormobidity_screen` ADD INDEX `ix_vn` (`vn` ASC) ;
     ");
     
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `chk_idx` */

/*!50003 DROP PROCEDURE IF EXISTS  `chk_idx` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `chk_idx`(in theDB varchar(128), in theTable varchar(128), in theIndexName varchar(128), in theIndexColumns varchar(255))
    DETERMINISTIC
BEGIN

		## use call chk_idx('dbname','tbname','idexname','key1,key2,....');

		## use call chk_idx('dbname','tbname','idexname','key1,key2,....');

		IF EXISTS (SELECT * FROM information_schema.STATISTICS WHERE INDEX_SCHEMA = theDB ) 

		THEN

				IF EXISTS (SELECT * FROM information_schema.STATISTICS WHERE INDEX_SCHEMA = theDB AND TABLE_NAME = theTable)

				THEN

						IF chk_col(theDB,theTable,theIndexColumns) =1 THEN

							IF NOT EXISTS (SELECT * FROM information_schema.STATISTICS WHERE INDEX_SCHEMA = theDB AND TABLE_NAME = theTable AND INDEX_NAME = theIndexName) 

							THEN					   

									SET @s = CONCAT('ALTER TABLE ' ,theDB ,'.', theTable , ' ADD KEY ' , theIndexName, '(', theIndexColumns, ')');

							 PREPARE stmt FROM @s;

							 EXECUTE stmt;

							END IF;

					END IF;

				END IF;

		END IF;

		END */$$
DELIMITER ;

/* Procedure structure for procedure `dataset` */

/*!50003 DROP PROCEDURE IF EXISTS  `dataset` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `dataset`()
BEGIN

END */$$
DELIMITER ;

/* Procedure structure for procedure `dlc_anc` */

/*!50003 DROP PROCEDURE IF EXISTS  `dlc_anc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `dlc_anc`()
BEGIN
DECLARE done INT;
DECLARE has_error INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;# WHERE hospcode = '08050';
  #DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET has_error = 1;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
CREATE TABLE IF NOT EXISTS wmc_tranfer_command (
  `wtc_id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `usercid` varchar(13) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `person_id` varchar(13) DEFAULT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  `confirmtime` datetime DEFAULT NULL,
  `table` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `column` varchar(50) DEFAULT NULL,
  `oldvalue` text,
  `newvalue` text,
  `sqlquery_cs` VARCHAR(255) DEFAULT NULL,
  `sqlquery` text,
  `process` varchar(50) DEFAULT 'manaual',
  `command_status` varchar(50) DEFAULT 'wait',
  `command_message` text,
  `processtime` datetime DEFAULT NULL,
  `wtc_active` int(1) DEFAULT '1',
  `ref_values` TEXT,
  PRIMARY KEY (`wtc_id`),
  UNIQUE KEY `k_index` (`hospcode`,`cid`,`sqlquery_cs`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
#UPDATE wmc_tranfer_command SET sqlquery_cs = md5(sqlquery) WHERE sqlquery_cs IS NULL;
SET @output_COUNT =  "SELECT COUNT(*) as cc_before FROM wmc_tranfer_command WHERE sqlquery_cs IS NULL";   
PREPARE output_COUNT FROM @output_COUNT;
EXECUTE output_COUNT;
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
    
SET @output = CONCAT("INSERT IGNORE INTO wmc_tranfer_command (hospcode,cid,person_id,person_name,operation,`table`,inserttime,sqlquery,sqlquery_cs,ref_values)
(
SELECT  hospcode,cid,person_id,person_name,operation,ta,t,sqlquery,md5(sqlquery),ref_values
FROM
(SELECT '",db,"' as hospcode,p.cid,p.person_id,a1.person_name,'INSERT' as operation,'person_anc' as ta,now() as t
,CONCAT(\"INSERT INTO person_anc (person_anc_id, person_id, anc_register_date, anc_register_staff, preg_no, edc, lmp, labor_status_id, labour_type_id, labour_hospcode, labor_icd10, labor_date, labor_place_id, labor_doctor_type_id, alive_child_count, dead_child_count, current_preg_age, force_complete_date, force_complete_export, last_update,first_doctor_date)
SELECT (SELECT get_serialnumber('person_anc_id')), '\",p.person_id,\"', NOW(), 'DataLink-System', '\",a1.preg_no,\"', '\",DATE_ADD(DATE_ADD(a1.lmp, INTERVAL 9 MONTH),INTERVAL 7 DAY),\"', '\",a1.lmp,\"', '\",labor_status,\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NOW(), 'Y', NOW(),'\",ifnull(a1.first_doctor_date,'0000-00-00'),\"'
FROM person_anc WHERE (SELECT COUNT(*) FROM person_anc WHERE person_id = '\",p.person_id,\"' AND preg_no = '\",a1.preg_no,\"') = 0 LIMIT 1\") as sqlquery
,CONCAT('{\"preg_no\":\"',a1.preg_no,'\"}') as ref_values
	FROM (SELECT * FROM report_person_anc ORDER BY labor_date DESC)  a1
		INNER JOIN dw_",db,".person p ON a1.cid = p.cid AND p.house_regist_type_id IN (1,3) 
			WHERE a1.regplace NOT IN ('",db,"')
				AND a1.preg_no > 0
				AND a1.source = 'WMC'
				AND a1.lmp BETWEEN CONCAT(YEAR(CURRENT_DATE)-1,'-10-01') AND CURRENT_DATE
					AND p.person_id NOT IN (SELECT a2.person_id FROM dw_",db,".person_anc a2 WHERE a2.person_id = p.person_id AND a1.preg_no = a2.preg_no)
					GROUP BY a1.cid
					) tmp );");
PREPARE output FROM @output;
EXECUTE output; 
SET @output2 = CONCAT("INSERT IGNORE INTO wmc_tranfer_command (hospcode,cid,person_id,person_name,operation,`table`,updatetime,sqlquery,sqlquery_cs,ref_values)
(
SELECT  hospcode,cid,person_id,person_name,operation,ta,t,sqlquery,md5(sqlquery),ref_values
FROM
(
SELECT '",db,"' as hospcode,p.cid,p.person_id,a1.person_name,'UPDATE' as operation,'person_anc' as ta,now() as t
,CONCAT(\"UPDATE person_anc SET labor_status_id = '\",ifnull(a1.labor_status,''),\"'
	  , labour_type_id = '\",ifnull(a1.labour_type,''),\"'
	  , labour_hospcode = '\",ifnull(a1.labour_hospcode,''),\"'
	  , labor_icd10 = '\",ifnull(a1.bresult,''),\"'
	  , labor_date = '\",ifnull(a1.labor_date,'0000-00-00'),\"'
	  , labor_place_id = '\",ifnull(a1.labor_place,''),\"'
	  , labor_doctor_type_id = '\",ifnull(a1.labor_doctor_type,''),\"'
	  , alive_child_count = '\",ifnull(a1.alive_child_count,''),\"'
	  , dead_child_count = '\",ifnull(a1.dead_child_count,''),\"'
	  , current_preg_age = NULL
	  , force_complete_date = NOW()
	  , force_complete_export = 'Y'
	  , last_update = NOW() 
	WHERE 1		
	  AND person_id = '\",p.person_id,\"' 
	  AND preg_no = '\",a1.preg_no,\"' ; \") as sqlquery
,CONCAT('{\"preg_no\":\"',a1.preg_no,'\"}') as ref_values
FROM
  report_person_anc a1 
  INNER JOIN dw_",db,".person p 
    ON a1.cid = p.cid 
  INNER JOIN dw_",db,".person_anc a2 
    ON a2.person_id = p.person_id 
    AND a1.preg_no = a2.preg_no 
    AND (
      a2.labor_date IS NULL 
      OR a2.labor_date = '0000-00-00' 
      OR a2.labor_date = ''
    ) 
WHERE a1.regplace NOT IN ('",db,"') 
AND a1.source = 'WMC'
AND a1.preg_no > 0
  AND a1.regplace IN 
  (SELECT 
    h.hospcode 
  FROM
    pcu_hos_allow h 
  WHERE h.hospcode = h.hospcode_cup) 
  AND a1.labor_date IS NOT NULL 
  AND a1.labor_date <> '0000-00-00' ) tmp );
");
PREPARE output2 FROM @output2; 
EXECUTE output2;
SET @output3 = CONCAT("INSERT IGNORE INTO wmc_tranfer_command (hospcode,cid,person_id,person_name,operation,`table`,inserttime,sqlquery,sqlquery_cs,ref_values)
(
SELECT  hospcode,cid,person_id,person_name,operation,ta,t,sqlquery,md5(sqlquery),ref_values
FROM
(
SELECT '",db,"' as hospcode,p.cid,p.person_id,CONCAT(p.pname,p.fname,' ',p.lname) as person_name,'INSERT' as operation,'person_anc_other_precare' as ta,now() as t
,CONCAT(\"INSERT INTO person_anc_other_precare (
person_anc_other_precare_id
,person_anc_id
,precare_date
,precare_hospcode
,precare_no
,precare_note_text
) 
SELECT 
  (SELECT get_serialnumber('person_anc_other_precare_id'))
  , '\",a2.person_anc_id,\"'
  , '\",a1.service_date,\"'
  , '\",a1.hospcode,\"'
  , ''
  , CONCAT('DataLink-System (', NOW(), ')')
FROM
  person_anc_other_precare 
WHERE 
  (SELECT 
    COUNT(*) 
  FROM
    person_anc_other_precare 
  WHERE person_anc_id = '\",a2.person_anc_id,\"' 
    AND precare_date = '\",a1.service_date,\"'
    AND precare_hospcode = '\",a1.hospcode,\"'
    ) = 0 
LIMIT 1 ;\") as sqlquery
,CONCAT('{\"preg_no\":\"',a1.preg_no,'\"}') as ref_values
FROM report_service_anc a1
INNER JOIN dw_",db,".person p ON a1.cid = p.cid 
INNER JOIN dw_",db,".person_anc a2 ON a1.preg_no = a2.preg_no AND p.person_id = a2.person_id
LEFT JOIN dw_",db,".person_anc_other_precare a3 ON a2.person_anc_id = a3.person_anc_id AND a3.precare_date = a1.service_date AND a3.precare_hospcode = a1.hospcode
WHERE a1.hospcode NOT IN ('",db,"')
AND a1.note = 'service_care'
AND a1.preg_no > 0
AND a1.lmp >= CONCAT(YEAR(CURRENT_DATE)-1,'-10-01')
AND a3.precare_date IS NULL
GROUP BY a1.service_date
 ) tmp ) ;
");
PREPARE output3 FROM @output3;
EXECUTE output3;
END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
  
  
#UPDATE wmc_tranfer_command SET sqlquery_cs = md5(sqlquery) WHERE sqlquery_cs IS NULL;
#SET @output_COUNT2 =  "SELECT COUNT(*) as cc_after FROM wmc_tranfer_command WHERE sqlquery_cs IS NULL";   
#PREPARE output_COUNT2 FROM @output_COUNT2;
#EXECUTE output_COUNT2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `dlc_epi` */

/*!50003 DROP PROCEDURE IF EXISTS  `dlc_epi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `dlc_epi`()
BEGIN
  DECLARE done INT ;
  DECLARE has_error INT ;
  DECLARE db VARCHAR (255) ;
  DECLARE appDBs CURSOR FOR 
  SELECT 
    hospcode 
  FROM
    pcu_hos_allow ;
  # WHERE hospcode = '08050';
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET has_error = 1 ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1 ;
  CREATE TABLE IF NOT EXISTS wmc_tranfer_command (
    `wtc_id` INT (6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
    `hospcode` VARCHAR (5) NOT NULL,
    `usercid` VARCHAR (13) DEFAULT NULL,
    `username` VARCHAR (100) DEFAULT NULL,
    `cid` VARCHAR (13) DEFAULT NULL,
    `person_id` VARCHAR (13) DEFAULT NULL,
    `person_name` VARCHAR (255) DEFAULT NULL,
    `operation` VARCHAR (50) DEFAULT NULL,
    `confirmtime` DATETIME DEFAULT NULL,
    `table` VARCHAR (50) DEFAULT NULL,
    `inserttime` DATETIME DEFAULT NULL,
    `updatetime` DATETIME DEFAULT NULL,
    `column` VARCHAR (50) DEFAULT NULL,
    `oldvalue` TEXT,
    `newvalue` TEXT,
    `sqlquery_cs` VARCHAR (255) DEFAULT NULL,
    `sqlquery` TEXT,
    `process` VARCHAR (50) DEFAULT 'manaual',
    `command_status` VARCHAR (50) DEFAULT 'wait',
    `command_message` TEXT,
    `processtime` DATETIME DEFAULT NULL,
    `wtc_active` INT (1) DEFAULT '1',
    `ref_values` TEXT,
    PRIMARY KEY (`wtc_id`),
    UNIQUE KEY `k_index` (`hospcode`, `cid`, `sqlquery_cs`)
  ) ENGINE = MYISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8 ;
  
  SET @output_COUNT = "SELECT COUNT(*) as cc_before FROM wmc_tranfer_command WHERE sqlquery_cs IS NULL" ;
  PREPARE output_COUNT FROM @output_COUNT ;
  EXECUTE output_COUNT ;
  OPEN appDBs ;
  SET done = 0 ;
  REPEAT
    FETCH appDBs INTO db ;
    IF NOT done 
    THEN SET @output = CONCAT(
      "INSERT IGNORE  INTO wmc_tranfer_command (hospcode,cid,person_id,person_name,operation,`table`,inserttime,sqlquery,sqlquery_cs,ref_values)
(
SELECT  hospcode,cid,person_id,person_name,operation,ta,t,sqlquery,md5(sqlquery),ref_values
FROM
(SELECT '",db,"' as hospcode,
  p.cid,
  p.person_id,
  CONCAT(p.pname, p.fname, ' ', p.lname) AS person_name,
  'INSERT' AS operation,
  'person_vaccine_elsewhere' AS ta,
  NOW() AS t,
  CONCAT(\"INSERT INTO person_vaccine_elsewhere (person_vaccine_elsewhere_id, person_id, person_vaccine_id, vaccine_date, vaccine_lotno, update_datetime, vaccine_hospcode, hospcode, vaccine_note)
SELECT (SELECT get_serialnumber('person_vaccine_elsewhere_id'))
, '\",p.person_id,\"'
, (SELECT person_vaccine_id FROM person_vaccine WHERE export_vaccine_code ='\",a1.vaccine_type,\"' LIMIT 1) 
, '\",a1.service_date,\"'
, '\",ifnull(a1.vaccine_lotno,''),\"'
, NOW()
, '\",ifnull(a1.service_hospcode,a1.vaccine_hospcode),\"'
, '\",ifnull(a1.service_hospcode,a1.vaccine_hospcode),\"'
, CONCAT('DataLink-System (',NOW(),')')
FROM person_vaccine_elsewhere 
WHERE (
SELECT COUNT(*) FROM person_vaccine_elsewhere 
WHERE person_id = '\",p.person_id,\"' 
AND vaccine_date = '\",a1.service_date,\"' 
AND person_vaccine_id IN (SELECT person_vaccine_id FROM person_vaccine WHERE export_vaccine_code ='\",a1.vaccine_type,\"') 
) = 0 LIMIT 1 \") AS sqlquery 
,CONCAT('{\"vaccine_code\":\"',a1.vaccine_type,'\"}') as ref_values
FROM report_epi a1 
  INNER JOIN dw_",db,".person p ON a1.cid = p.cid AND p.house_regist_type_id IN (1, 3) 
  LEFT JOIN report_epi w ON w.cid = p.cid AND w.vaccine_type = a1.vaccine_type AND w.hospcode IN ('",db,"') 
  LEFT JOIN dw_",db,".person_vaccine wv ON wv.export_vaccine_code = a1.vaccine_type 
WHERE a1.hospcode NOT IN ('",db,"') 
  AND w.vaccine_type IS NULL 
  
  AND p.person_id IN (
  SELECT e1.person_id FROM dw_",db,".person_wbc e1
  UNION
  SELECT e2.person_id FROM dw_",db,".person_epi e2  
  )
  
  AND a1.vaccine_type IN 
  (SELECT 
    v1.export_vaccine_code 
  FROM
    dw_",db,".person_vaccine v1 
  WHERE v1.export_vaccine_code IN 
    (SELECT 
      * 
    FROM
      (SELECT 
        v2.export_vaccine_code 
      FROM
        dw_",db,".wbc_vaccine v2 
      WHERE v2.vaccine_in_use <> 'N' OR v2.vaccine_in_use IS NULL
      UNION
      SELECT 
        v3.export_vaccine_code 
      FROM
        dw_",db,".epi_vaccine v3 
      WHERE v3.vaccine_in_use <> 'N' OR v3.vaccine_in_use IS NULL) t 
    GROUP BY t.export_vaccine_code)) 
  AND (
    a1.service_hospcode <> '' 
    OR a1.vaccine_hospcode <> ''
  ) 
  AND IF(
    a1.vn IS NOT NULL,
    a1.source NOT IN ('HDC'),
    1
  ) 
  AND a1.service_date >= CONCAT(YEAR(CURDATE()) - 2, '-10-01') 
  AND a1.vaccine_hospcode <> '00000' 
GROUP BY p.person_id,
  a1.vaccine_type,
  a1.service_date) tmp );"
    ) ;
    PREPARE output FROM @output ;
    EXECUTE output ;
    
    END IF ;
    UNTIL done 
  END REPEAT ;
  CLOSE appDBs ;
END */$$
DELIMITER ;

/* Procedure structure for procedure `dlc_lab` */

/*!50003 DROP PROCEDURE IF EXISTS  `dlc_lab` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`sa`@`%` PROCEDURE `dlc_lab`()
BEGIN
CREATE TABLE IF NOT EXISTS `report_tranfer_lab` (
  `hospcode` VARCHAR(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `lab_order_number` int(11) DEFAULT '0',
  `confirm` char(1) DEFAULT NULL,
  `lab_items_code` int(11) DEFAULT '0',
  `lab_items_name` varchar(250) DEFAULT NULL,
  `sys_name` varchar(250) DEFAULT '',
  `lab_order_result` varchar(250) DEFAULT NULL,
  `lab_items_normal_value_ref` varchar(150) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `receive_time` time DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `report_time` time DEFAULT NULL,
  `input_time` DATETIME DEFAULT NULL,
  UNIQUE KEY `u_index` (`cid`,`sys_name`,`report_date`),
  KEY (`cid`),
  KEY (`report_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO report_tranfer_lab 
(SELECT
'00000' as hospcode
,p.cid
,lh.vn
,lh.hn
,lh.lab_order_number
,lo.confirm
,li.lab_items_code
,li.lab_items_name
,sv.sys_name
,lo.lab_order_result
,lo.lab_items_normal_value_ref
,lh.receive_date
,lh.receive_time
,lh.report_date
,lh.report_time
,now()
FROM hos.lab_order lo
LEFT JOIN hos.lab_head lh ON lh.lab_order_number = lo.lab_order_number
LEFT JOIN hos.lab_items li ON li.lab_items_code = lo.lab_items_code
INNER JOIN hos.clinicmember c ON lh.hn = c.hn AND c.clinic IN ('001','002')
LEFT JOIN (
SELECT sys_name,sys_value FROM hos.sys_var
UNION
SELECT 'lab_link_egfr' AS sys_name
,(SELECT lab_items_name FROM hos.lab_items WHERE lab_items_name LIKE '%egfr%' AND (active_status = 'Y' OR active_status IS NULL) GROUP BY lab_items_name) AS sys_value
) sv ON sv.sys_value = li.lab_items_name
INNER JOIN hos.patient p ON p.hn = lh.hn 
WHERE lh.report_date BETWEEN SUBDATE(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()
#AND lh.lab_order_number = 60063704
AND lo.confirm = 'Y'
AND lo.lab_items_code IN
(SELECT 
lab_link_code
FROM
(SELECT sys_name,sys_value
,(SELECT GROUP_CONCAT(lab_items_code) FROM hos.lab_items WHERE lab_items_name = sys_value AND (active_status = 'Y' OR active_status IS NULL) GROUP BY lab_items_name) AS lab_link_code
FROM (
SELECT sys_name,sys_value FROM hos.sys_var
UNION
SELECT 'lab_link_egfr' AS sys_name
,(SELECT lab_items_name FROM hos.lab_items WHERE lab_items_name LIKE '%egfr%' AND (active_status = 'Y' OR active_status IS NULL) GROUP BY lab_items_name) AS sys_value
) x1
WHERE sys_name LIKE 'lab_link_%') AS x2
WHERE lab_link_code IS NOT NULL)
ORDER BY lh.report_date DESC);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ex_tchronic` */

/*!50003 DROP PROCEDURE IF EXISTS  `ex_tchronic` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ex_tchronic`()
BEGIN

INSERT INTO t_chronic
SELECT * FROM t_chronic_hdc WHERE cid NOT IN (SELECT t2.cid FROM t_chronic t2);

END */$$
DELIMITER ;

/* Procedure structure for procedure `ex_tdmht` */

/*!50003 DROP PROCEDURE IF EXISTS  `ex_tdmht` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ex_tdmht`()
BEGIN
INSERT INTO t_dmht
(hospcode,pid,vhid,typearea,cid,birth,age_y,groupcode1560,groupname1560,sex,nation,source_tb,mix_dx,t_mix_dx,type_dx,date_dx,hosp_dx,minscl,inscl,ld_hba1c,rs_hba1c,ih_hba1c,ld_fpg1,rs_fpg1,ih_fpg1,ld_fpg2,rs_fpg2,ih_fpg2,ld_fpg3,rs_fpg3,ih_fpg3,ld_creatinine,rs_creatinine,ih_creatinine,ld_lipid,rs_lipid,ih_lipid,ld_foot,rs_foot,ih_foot,ld_retina,rs_retina,ih_retina,ld_bp1,ih_bp1,rs_bps1,rs_bpd1,ld_bp2,ih_bp2,rs_bps2,rs_bpd2,complication_dm,complication_ht,control_dm,control_ht,bmi,obes,height,weight,waist_cm,lookup,lookup_update,follow_up)
(SELECT hospcode,pid,vhid,typearea,cid,birth,age_y,groupcode1560,groupname1560,sex,nation,source_tb,mix_dx,t_mix_dx,type_dx,date_dx,hosp_dx,minscl,inscl,ld_hba1c,rs_hba1c,ih_hba1c,ld_fpg1,rs_fpg1,ih_fpg1,ld_fpg2,rs_fpg2,ih_fpg2,ld_fpg3,rs_fpg3,ih_fpg3,ld_creatinine,rs_creatinine,ih_creatinine,ld_lipid,rs_lipid,ih_lipid,ld_foot,rs_foot,ih_foot,ld_retina,rs_retina,ih_retina,ld_bp1,ih_bp1,rs_bps1,rs_bpd1,ld_bp2,ih_bp2,rs_bps2,rs_bpd2,complication_dm,complication_ht,control_dm,control_ht,bmi,obes,height,weight,waist_cm,'HDC' AS lookup,NOW() AS lookup_update ,follow_up 
FROM t_dmht_hdc t1
WHERE t1.cid NOT IN (SELECT t2.cid FROM t_dmht t2));
UPDATE t_dmht a INNER JOIN (
SELECT cid 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.lookup = 'WMC,HDC';
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_hba1c = g.ld_hba1c,
a.rs_hba1c = g.rs_hba1c,
a.ih_hba1c = g.ih_hba1c
WHERE (a.ld_hba1c IS NULL AND g.ld_hba1c IS NOT NULL) OR a.ld_hba1c < g.ld_hba1c;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_retina = g.ld_retina,
a.rs_retina = g.rs_retina,
a.ih_retina = g.ih_retina
WHERE (a.ld_retina IS NULL AND g.ld_retina IS NOT NULL) OR a.ld_retina < g.ld_retina;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_fpg1 = g.ld_fpg1,
a.rs_fpg1 = g.rs_fpg1,
a.ih_fpg1 = g.ih_fpg1
WHERE (a.ld_fpg1 IS NULL AND g.ld_fpg1 IS NOT NULL) OR a.ld_fpg1 < g.ld_fpg1;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_fpg2 = g.ld_fpg2,
a.rs_fpg2 = g.rs_fpg2,
a.ih_fpg2 = g.ih_fpg2
WHERE (a.ld_fpg2 IS NULL AND g.ld_fpg2 IS NOT NULL) OR a.ld_fpg2 < g.ld_fpg2;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_foot = g.ld_foot,
a.rs_foot = g.rs_foot,
a.ih_foot = g.ih_foot
WHERE a.ld_foot IS NULL AND g.ld_foot IS NOT NULL;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET a.control_dm = g.control_dm
WHERE a.control_dm IS NULL AND g.control_dm IS NOT NULL;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET a.control_ht = g.control_ht
WHERE a.control_ht IS NULL AND g.control_ht IS NOT NULL;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_bp1 = g.ld_bp1,
a.ih_bp1 = g.ih_bp1,
a.rs_bps1 = g.rs_bps1,
a.rs_bpd1 = g.rs_bpd1
WHERE (a.rs_bps1 IS NULL AND g.rs_bps1 IS NOT NULL) 
OR(a.rs_bpd1 IS NULL AND g.rs_bpd1 IS NOT NULL) 
OR (a.ih_bp1 IS NULL AND g.ih_bp1 IS NOT NULL) 
OR a.ld_bp1 < g.ld_bp1;
UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET 
a.ld_bp2 = g.ld_bp2,
a.ih_bp2 = g.ih_bp2,
a.rs_bps2 = g.rs_bps2,
a.rs_bpd2 = g.rs_bpd2
WHERE (a.rs_bps2 IS NULL AND g.rs_bps2 IS NOT NULL) 
OR(a.rs_bpd2 IS NULL AND g.rs_bpd2 IS NOT NULL) 
OR (a.ih_bp2 IS NULL AND g.ih_bp2 IS NOT NULL) OR a.ld_bp2 < g.ld_bp2;

UPDATE t_dmht a INNER JOIN (
SELECT * 
FROM t_dmht_hdc 
) g ON a.cid = g.cid
SET a.type_dx = g.type_dx
,a.source_tb = g.source_tb
,a.mix_dx = g.mix_dx
,a.t_mix_dx = g.t_mix_dx
,a.date_dx = g.date_dx
WHERE a.type_dx < g.type_dx;

END */$$
DELIMITER ;

/* Procedure structure for procedure `ex_tperson_anc` */

/*!50003 DROP PROCEDURE IF EXISTS  `ex_tperson_anc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ex_tperson_anc`()
BEGIN

INSERT INTO t_person_anc
(hospcode,
  pid,
  typearea,
  cid,
  birth,
  sex,
  nation,
  occupat_new,
  gravida,
  bdate,
  bhosp,
  input_bhosp,
  g1_ga,
  g1_date,
  g1_hospcode,
  g1_input_hosp,
  g2_ga,
  g2_date ,
  g2_hospcode,
  g2_input_hosp,
  g3_ga,
  g3_date,
  g3_hospcode,
  g3_input_hosp,
  g4_ga,
  g4_date,
  g4_hospcode,
  g4_input_hosp,
  g5_ga,
  g5_date,
  g5_hospcode,
  g5_input_hosp,
  lookup,
  lookup_update)
(SELECT 
  hospcode,
  pid,
  typearea,
  cid,
  birth,
  sex,
  nation,
  occupat_new,
  gravida,
  bdate,
  bhosp,
  input_bhosp,
  g1_ga,
  g1_date,
  g1_hospcode,
  g1_input_hosp,
  g2_ga,
  g2_date ,
  g2_hospcode,
  g2_input_hosp,
  g3_ga,
  g3_date,
  g3_hospcode,
  g3_input_hosp,
  g4_ga,
  g4_date,
  g4_hospcode,
  g4_input_hosp,
  g5_ga,
  g5_date,
  g5_hospcode,
  g5_input_hosp,
  'HDC' AS lookup,
  NOW() AS lookup_update

FROM t_person_anc_hdc t1
WHERE concat(t1.cid,'-',t1.gravida) NOT IN (SELECT concat(t2.cid,'-',t2.gravida) as cc FROM t_person_anc t2)
);

UPDATE t_person_anc a INNER JOIN (
SELECT cid,gravida,hospcode,bdate 
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
a.lookup = 'WMC,HDC';

UPDATE t_person_anc a INNER JOIN (
SELECT *
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
  a.bdate = g.bdate,
  a.bhosp = g.bhosp,
  a.input_bhosp = g.input_bhosp
  WHERE a.bdate is null and g.bdate IS not NULL;

UPDATE t_person_anc a INNER JOIN (
SELECT * 
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
a.g1_ga = g.g1_ga,
a.g1_date = g.g1_date,
a.g1_hospcode = g.g1_hospcode,
a.g1_input_hosp = g.g1_input_hosp
WHERE a.g1_date IS NULL;

UPDATE t_person_anc a INNER JOIN (
SELECT * 
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
a.g2_ga = g.g2_ga,
a.g2_date = g.g2_date,
a.g2_hospcode = g.g2_hospcode,
a.g2_input_hosp = g.g2_input_hosp
WHERE a.g2_date IS NULL;

UPDATE t_person_anc a INNER JOIN (
SELECT * 
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
a.g3_ga = g.g3_ga,
a.g3_date = g.g3_date,
a.g3_hospcode = g.g3_hospcode,
a.g3_input_hosp = g.g3_input_hosp
WHERE a.g3_date IS NULL;

UPDATE t_person_anc a INNER JOIN (
SELECT * 
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
a.g4_ga = g.g4_ga,
a.g4_date = g.g4_date,
a.g4_hospcode = g.g4_hospcode,
a.g4_input_hosp = g.g4_input_hosp
WHERE a.g4_date IS NULL;

UPDATE t_person_anc a INNER JOIN (
SELECT * 
FROM t_person_anc_hdc 
) g ON a.cid = g.cid AND g.gravida = a.gravida 
SET 
a.g5_ga = g.g5_ga,
a.g5_date = g.g5_date,
a.g5_hospcode = g.g5_hospcode,
a.g5_input_hosp = g.g5_input_hosp
WHERE a.g5_date IS NULL;




END */$$
DELIMITER ;

/* Procedure structure for procedure `qc_anc_ga_error` */

/*!50003 DROP PROCEDURE IF EXISTS  `qc_anc_ga_error` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `qc_anc_ga_error`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
    
    OPEN appDBs;
	SET done = 0;
	REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
		SET @output = CONCAT("/*qc_anc_ga_error ",db," */
        
        ");
    
  		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
	CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `qc_person_duplicate` */

/*!50003 DROP PROCEDURE IF EXISTS  `qc_person_duplicate` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `qc_person_duplicate`()
BEGIN
	CALL report_dulperson;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_chronic` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_chronic` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_chronic`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
DROP TABLE IF EXISTS report_chronic;
CREATE TABLE `report_chronic` (
   `hospcode` varchar(5) DEFAULT NULL,
   `cid` varchar(13) DEFAULT NULL,
   `pid` VARCHAR(13) DEFAULT NULL,
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
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_chronic ",db," */
     INSERT INTO report_chronic
     
		 SELECT 
			SQL_BIG_RESULT '",db,"' AS hospcode,
            p.cid,
			person_id AS pid,
			regdate AS date_diag,
			c2.icd10 AS chronic,
			ifnull(register_hospcode,'",db,"') AS hosp_dx,
			'",db,"' AS hosp_rx,
			dchdate AS date_disch,
			LPAD(provis_typedis,2,'0') AS typedisch
		FROM
			dw_",db,".clinicmember c,
			dw_",db,".person p,
			dw_",db,".clinic c2,
			dw_",db,".clinic_member_status cms
		WHERE
			p.patient_hn = c.hn
				AND c.clinic = c2.clinic
				AND c.clinic_member_status_id = cms.clinic_member_status_id
				AND c2.chronic = 'Y'
				AND c2.icd10 IS NOT NULL;");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;



END */$$
DELIMITER ;

/* Procedure structure for procedure `report_chronicfu` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_chronicfu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_chronicfu`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '0ecdbc306b23e09f92fe091e7ccf053d';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-1,'1001');
    SET @start_d2:=CONCAT(@b_year-2,'1001');
	SET @end_d:=concat(@b_year,'0930');
    
  CREATE TABLE IF NOT EXISTS `report_chronicfu` (
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
   `rpt_date` date NULL DEFAULT '0000-00-00',
  KEY `HOSPCODE` (`HOSPCODE`),
  KEY `PID` (`PID`),
  #KEY `SEQ` (`SEQ`),
  KEY `CID` (`CID`),
  KEY `DATE_SERV` (`DATE_SERV`),
  KEY `SBP` (`SBP`),
  KEY `DBP` (`DBP`),
  KEY `FOOT` (`FOOT`),
  KEY `SMOKING` (`SMOKING`),
  KEY `RETINA` (`RETINA`)
  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#ลบข้อมูลเพื่อเติมข้อมูลใหม่  
  DELETE FROM report_chronicfu WHERE `source` <> 'HDC'; 


    
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     SET @output = CONCAT("/*report_chronicfu ",db," */ 
     INSERT INTO report_chronicfu (`HOSPCODE`,
  `PID`, 
  `CID`,
  `SEQ` ,
  `DATE_SERV`,
  `WEIGHT`,
  `HEIGHT`,
  `WAIST_CM`,
  `SBP`,
  `DBP`, 
  `RETINA`,
  `FOOT`,
  `SMOKING`,
   `source`,
   `rpt_date`)
     SELECT 
			'",db,"' AS hospcode
			,person_id AS pid
            ,p.cid AS cid
            ,NULL AS seq
            ,o.vstdate as date_serv
            ,0 AS WEIGHT
            ,o.height AS HEIGHT
            ,o.waist AS WAIST_CM
            ,o.bps AS SBP
            ,o.bpd AS DBP
			,CASE 
			WHEN e.dmht_eye_screen_type_id = 1 AND a.has_eye_cormobidity <> 'Y' THEN 1
			WHEN e.dmht_eye_screen_type_id = 1 AND a.has_eye_cormobidity = 'Y' THEN 3
			WHEN e.dmht_eye_screen_type_id = 2 AND a.has_eye_cormobidity <> 'Y' THEN 2
			WHEN e.dmht_eye_screen_type_id = 2 AND a.has_eye_cormobidity = 'Y' THEN 4
			ELSE 8
			END AS retina
			,CASE 
			WHEN a.do_foot_screen = 'Y' AND a.has_foot_cormobidity <> 'Y' AND e2.clinicmember_cormobidity_screen_id IS NOT NULL THEN 1
			WHEN e2.clinicmember_cormobidity_screen_id IS NULL THEN 2
			WHEN a.do_foot_screen = 'Y' AND a.has_foot_cormobidity = 'Y' AND e2.clinicmember_cormobidity_screen_id IS NOT NULL THEN 3
			ELSE 9
			END AS foot
            ,if(o.smoking_type_id=2,1,0) as smoking
            ,'WMC' as source 
			,now() as rpt_date
			FROM
				dw_",db,".opdscreen o	
                INNER JOIN dw_",db,".clinic_visit v ON v.vn = o.vn
				LEFT OUTER JOIN dw_",db,".clinicmember_cormobidity_screen a ON a.vn = o.vn
				LEFT OUTER JOIN dw_",db,".clinicmember_cormobidity_eye_screen e ON e.clinicmember_cormobidity_screen_id = a.clinicmember_cormobidity_screen_id
				LEFT OUTER JOIN dw_",db,".clinicmember_cormobidity_foot_screen e2 ON e2.clinicmember_cormobidity_screen_id = a.clinicmember_cormobidity_screen_id
				LEFT OUTER JOIN dw_",db,".person p ON p.patient_hn = o.hn
			WHERE
				o.vstdate BETWEEN @start_d2 AND @end_d
				GROUP BY o.vn
     ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
     
     


END */$$
DELIMITER ;

/* Procedure structure for procedure `report_chronic_opd_ipd` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_chronic_opd_ipd` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_chronic_opd_ipd`()
BEGIN
	DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '9';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET	@start_d:=CONCAT(@b_year-1,'0701');
	SET @end_d:=CONCAT(@b_year,'0930');
  
  
DROP TABLE IF EXISTS report_chronic_opd_ipd;
CREATE TABLE `report_chronic_opd_ipd` (
   `hospcode` varchar(5) DEFAULT NULL,
   `cid` varchar(13) DEFAULT NULL,
   `pid` VARCHAR(13) DEFAULT NULL,
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
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_chronic_opd_ipd ",db," */
     INSERT INTO report_chronic_opd_ipd
     SELECT * FROM
     (SELECT 
		SQL_BIG_RESULT '",db,"' AS hospcode,
		p.cid,
		person_id AS pid,
		vstdate AS date_diag,
		icd10 AS chronic,
        icd10 AS diagcode,
		'",db,"' AS hosp_dx,
		'",db,"' AS hosp_rx,
		NULL AS date_disch,
		NULL AS typedisch,
		'diag_opd' AS pt_from
	FROM
		dw_",db,".ovstdiag o
	LEFT JOIN dw_",db,".person p ON p.patient_hn = o.hn
	WHERE
		vstdate BETWEEN @start_d AND @end_d
			AND (icd10 IN (SELECT id_chronic FROM cchronic) OR icd10 IN ('L030','L031'))
            
       UNION
    SELECT 
		SQL_BIG_RESULT '",db,"' AS hospcode,
		p.cid,
		person_id AS pid,
		regdate AS date_diag,
		icd10 AS chronic,
        icd10 AS diagcode,
		'",db,"' AS hosp_dx,
		'",db,"' AS hosp_rx,
		NULL AS date_disch,
		NULL AS typedisch,
		'diag_ipd' AS pt_from
	FROM
		dw_",db,".iptdiag o
    LEFT JOIN dw_",db,".ipt i ON i.an = o.an
	LEFT JOIN dw_",db,".person p ON p.patient_hn = i.hn
	WHERE
		regdate BETWEEN @start_d AND @end_d
			AND (icd10 IN (SELECT id_chronic FROM cchronic) OR icd10 IN ('L030','L031'))
			
    )   t
    WHERE cid IS NOT NULL AND LENGTH(cid) = 13 
            
            
            ;");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;




END */$$
DELIMITER ;

/* Procedure structure for procedure `report_cvdrisk` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_cvdrisk` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`sa`@`%` PROCEDURE `report_cvdrisk`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode in ('08264') order by hospcode asc;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
DROP TABLE IF EXISTS report_cvdrisk;
CREATE TABLE IF NOT EXISTS report_cvdrisk (
          `cid` varchar(13) NOT NULL DEFAULT '',
          `person_name` varchar(50) DEFAULT NULL,
          `regplace` varchar(250) DEFAULT NULL,
          `last_visit` date,
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
        ) ENGINE=MyISAM DEFAULT CHARSET=UTF8;
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*REGISTER-CVDRISK ",db," */
     INSERT INTO report_cvdrisk
		 
			(cid,regplace ,person_name ,last_visit ,sex ,age,bps ,tc ,smoke,clinic,aid,typearea,lat,lng,address)
            
            SELECT * FROM
               (select
                    p.cid
                     ,'",db,"' as regplace
                    ,concat(pp.pname,pp.fname,' ',pp.lname) as person_name
                    ,max(p.vstdate) as last_visit
                    ,p.sex
                    ,timestampdiff(YEAR,pp.birthday,max(p.vstdate)) as age
                    ,SUBSTRING_INDEX(group_concat(if(bps < 1 ,NULL,bps) order by p.vstdate desc),',',1) as bps
                    ,SUBSTRING_INDEX(group_concat(if(tc < 1 ,NULL,tc) order by p.vstdate desc),',',1) as tc
                    ,SUBSTRING_INDEX(group_concat(if(smoking_type_id not in (0,1,2,3,4) ,NULL,smoking_type_id) order by p.vstdate desc),',',1) as smoke
                    ,group_concat(distinct c.clinic order by c.clinic asc) as clinic
                    ,p.aid
                    ,house_regist_type_id as typearea
                    ,h.latitude as lat
					,h.longitude as lng
                    ,concat(h.address,' หมู่ ',v.village_moo,' ',t.full_name) as address
                    
                    from dw_",db,".vn_stat p
                    inner join (select bps,tc,vn,hn,smoking_type_id from dw_",db,".opdscreen where vstdate between DATE_ADD(curdate(), INTERVAL -1 YEAR) and curdate() group by vn) s on s.vn = p.vn
                    inner join dw_",db,".clinicmember c on c.hn = s.hn
                    inner join dw_",db,".patient pp on pp.hn = p.hn
                    
					LEFT OUTER JOIN dw_",db,".person p2 ON p2.cid = pp.cid
					LEFT OUTER JOIN dw_",db,".house h ON h.house_id = p2.house_id
					LEFT OUTER JOIN dw_",db,".village v ON v.village_id = h.village_id
					LEFT OUTER JOIN thaiaddress t ON t.addressid = v.address_id
                    
                    where p.vstdate between DATE_ADD(curdate(), INTERVAL -1 YEAR) and curdate()
                    and (pp.death  is null or pp.death ='N')
                    and c.clinic in ('001','002')
                    and (c.discharge is null or c.discharge='N')
                    #and right(11-((left(p.cid,1)*13)+(mid(p.cid,2,1)*12)+(mid(p.cid,3,1)*11)+(mid(p.cid,4,1)*10)+(mid(p.cid,5,1)*9)+(mid(p.cid,6,1)*8)+(mid(p.cid,7,1)*7)+(mid(p.cid,8,1)*6)+(mid(p.cid,9,1)*5)+(mid(p.cid,10,1)*4)+(mid(p.cid,11,1)*3)+(mid(p.cid,12,1)*2)) mod 11,1) = right(p.cid,1)
                    #and p.cid not like concat('0','dw_",db,".','%')
                    and p.cid is not null
                    and p.cid <> ''
                    and (p.pdx between 'E10' and 'E1499' or p.pdx between 'I10' and 'I1599')
                    group by p.hn) tmp 
                    
                    #ON DUPLICATE KEY UPDATE
					#regplace = concat(ifnull((select concat(s1.regplace,'|') as tt from report_cvdrisk s1 where s1.cid = tmp.cid and s1.regplace not like concat('%',tmp.regplace,'%') and s1.regplace <> ''),''),tmp.regplace)
                            
						
                    ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_deformed` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_deformed` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_deformed`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode in ('08264') order by hospcode asc;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
DROP TABLE IF EXISTS report_deformed;
CREATE TABLE `report_deformed` (
  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `address_name` varchar(367) DEFAULT NULL,
  `village_name` varchar(200),
  `cid` varchar(13) DEFAULT NULL,
  `person_name` varchar(126) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` bigint(21) DEFAULT NULL,
  `house_regist_type_id` int(11) DEFAULT NULL,
  `nationality` varchar(3) DEFAULT NULL,
  `deformed_no` varchar(25) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `certificate_date` date DEFAULT NULL,
  `person_deformed_type_name` varchar(150),
  `organ` varchar(200) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `lng` varchar(100) DEFAULT NULL,
	KEY `hospcode` (`hospcode`),
	KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_deformed ",db," */
     INSERT INTO report_deformed
		 
                    SELECT
			SQL_BIG_RESULT '",db,"' AS hospcode
                        ,CONCAT(h.address,' หมู่ ',village_moo,' ',v.village_name) AS address_name
                        ,v.village_name
                        ,p.cid
                        ,CONCAT(p.pname,p.fname,' ',p.lname) AS person_name
                        ,birthdate
                        ,TIMESTAMPDIFF(YEAR,p.birthdate,now()) as age
                        ,house_regist_type_id
                        ,nationality
                        ,deformed_no
                        ,register_date
                        ,certificate_date
                        ,person_deformed_type_name
                        ,organ
                        ,h.latitude AS lat
                        ,h.longitude AS lng
                        FROM dw_",db,".person_deformed d
                            LEFT JOIN dw_",db,".person_deformed_detail dd ON d.person_deformed_id = dd.person_deformed_id
                            LEFT JOIN dw_",db,".person_deformed_type dt ON dt.person_deformed_type_id = dd.person_deformed_type_id
                            LEFT JOIN dw_",db,".person p ON p.person_id = d.person_id
                            LEFT JOIN dw_",db,".house h ON p.house_id = h.house_id
                            LEFT JOIN dw_",db,".village v ON v.village_id = h.village_id
                            WHERE p.person_id NOT IN (SELECT * FROM (SELECT person_id FROM dw_",db,".person_death) tmp)
                                    #AND p.house_regist_type_id IN (1,3)
                                        AND p.nationality = 99;
                    
                    ");
		PREPARE output FROM @output;
        EXECUTE output;
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_diag_opd` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_diag_opd` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_diag_opd`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET	@start_d:=concat(@b_year-1,'0701');
	SET @end_d:=concat(@b_year,'0930');
    
	DROP TABLE IF EXISTS report_diag_opd;
    
    CREATE TABLE `report_diag_opd` (
    `hospcode` VARCHAR(5) DEFAULT NULL,
    `pid` VARCHAR(15) NOT NULL DEFAULT '0',
    `diagtype` varchar(1) NOT NULL DEFAULT '0',
    `diagcode` varchar(6) DEFAULT NULL,
    `date_serv` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `cid` varchar(13) DEFAULT NULL,
   KEY `idx_hospcode` (`hospcode`),
   KEY `idx_pid` (`pid`),
   KEY `idx_cid` (`cid`),
   KEY `idx_diagcode` (`diagcode`)
 ) ENGINE=MyISAM DEFAULT CHARSET=tis620;
    

OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_diag_opd ",db," */
     INSERT INTO report_diag_opd
     
     (SELECT SQL_BIG_RESULT
	'",db,"' as hospcode
    ,person_id as pid
	,diagtype
	,icd10
	,vstdate
    ,p.cid
	from dw_",db,".ovstdiag o
    inner join dw_",db,".person p on p.patient_hn = o.hn
	WHERE vstdate BETWEEN @start_d AND @end_d
	and left(icd10,1) between 'A' and 'Z');");
	
        PREPARE output FROM @output;
        EXECUTE output;
        
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;  
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_dulperson` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_dulperson` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_dulperson`()
BEGIN
	DROP TABLE IF EXISTS report_dulperson;
	CREATE table IF NOT EXISTS report_dulperson
		SELECT * FROM
		(SELECT 
			cid,
			CONCAT(PRENAME,' ',NAME,' ',LNAME) as person_name,
			GROUP_CONCAT(TYPEAREA ORDER BY TYPEAREA ASC) AS dul_typearea,
			COUNT(*) AS cc_all,
			GROUP_CONCAT(HOSPCODE ORDER BY HOSPCODE ASC) AS hcode
		FROM
			t_person
		WHERE
			TYPEAREA IN (1 , 3)
            AND DISCHARGE = 9
		GROUP BY cid
		HAVING cc_all > 1) t
		WHERE dul_typearea LIKE '%1,1%' 
		OR dul_typearea LIKE '%1,3%'
		OR dul_typearea LIKE '%3,3%';
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_epi` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_epi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_epi`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode = '08264';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-10,'1001');
	SET @end_d:=concat(@b_year,'0930');
    
  #DROP TABLE IF EXISTS report_epi;
  CREATE TABLE IF NOT EXISTS report_epi (
                `hospcode` varchar(5) NOT NULL DEFAULT '',
                `cid` varchar(13) DEFAULT NULL,
                `pid` varchar(15) NULL DEFAULT '',
                `vn` varchar(15) DEFAULT NULL,
                `name` varchar(50) NULL DEFAULT '',
                `lname` varchar(50) NULL DEFAULT '',
                `sex` varchar(1) NULL DEFAULT '',
                `birth` date NULL DEFAULT '0000-00-00',
                `nation` varchar(3) NULL DEFAULT '',
                `typearea` varchar(1) NULL DEFAULT '',
                `service_date` date NULL DEFAULT '0000-00-00',
                `service_time` time NULL DEFAULT '00:00:00',
                `vaccine_type` varchar(3) NULL DEFAULT '',
                `vaccine_name` varchar(100) NULL DEFAULT '',
                `vaccine_lotno` varchar(30) NULL DEFAULT '',
                `yy` varchar(2) NULL DEFAULT '',
                `mm` varchar(2) NULL DEFAULT '',
                `dd` varchar(2) NULL DEFAULT '',
                `service_hospcode` varchar(5) DEFAULT NULL,
                `vaccine_hospcode` varchar(5) DEFAULT NULL,
                `source` varchar(25) DEFAULT NULL,
                `rpt_date` date NULL DEFAULT '0000-00-00',
                #UNIQUE KEY `INDEX_UNIQUE` (`hospcode`,`vaccine_type`,`service_date`,`cid`,`pid`,`vaccine_lotno`,`source`),
                KEY `cid` (`cid`),
                KEY `hospcode` (`hospcode`),
                KEY `pid` (`pid`),
                KEY `vaccine_type` (`vaccine_type`),
                KEY `service_date` (`service_date`)
              ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
              
	#ลบข้อมูลเพื่อเติมข้อมูลใหม่  
	DELETE FROM report_epi WHERE `source` <> 'HDC';            
              
  OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
    
     IF NOT done THEN
            SET @output = CONCAT("INSERT INTO report_epi
            SELECT
    '",db,"' AS hospcode,
    p.cid,
    p.person_id AS pid,
    vn,
    '' AS name,
    '' AS lname,
    sex,
    birthdate AS birth,
    nationality AS nation,
    house_regist_type_id AS typearea,
    service_date,
    service_time,
    vaccine_type,
    vaccine_name,
    vaccine_lotno,
  
    FLOOR((DATE_FORMAT(service_date, '%Y%m%d') - DATE_FORMAT(birthdate, '%Y%m%d')) / 10000) AS yy,
    FLOOR((1200 + DATE_FORMAT(service_date, '%m%d') - DATE_FORMAT(birthdate, '%m%d')) / 100) % 12 AS mm,
    ROUND((SIGN(DAY(service_date) - DAY(birthdate)) + 1) / 2 * (DAY(service_date) - DAY(birthdate)) + (SIGN(DAY(birthdate) - DAY(service_date)) + 1) / 2 * (DAY(STR_TO_DATE(DATE_FORMAT(birthdate + INTERVAL 1 MONTH, '%Y-%m-01'),
                        '%Y-%m-%d') - INTERVAL 1 DAY) - DAY(birthdate) + DAY(service_date)),
            0) AS dd,
	service_hospcode,
    vaccine_hospcode,
    source,
	now() as rpt_date
FROM
    (SELECT
			vn,
            pw.person_id,
            service_date,
            service_time,
            export_vaccine_code AS vaccine_type,
            wbc_vaccine_name AS vaccine_name,
            '",db,"' AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 3' AS source
    FROM
        dw_",db,".person_wbc pw
    INNER JOIN dw_",db,".person_wbc_service pws ON pw.person_wbc_id = pws.person_wbc_id
    INNER JOIN dw_",db,".person_wbc_vaccine_detail pwv ON pwv.person_wbc_service_id = pws.person_wbc_service_id
    INNER JOIN dw_",db,".wbc_vaccine v ON v.wbc_vaccine_id = pwv.wbc_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        service_date BETWEEN @start_d AND @end_d
UNION ALL SELECT
        vn,
            pw.person_id,
            vaccine_date AS service_date,
            vaccine_time AS service_time,
            export_vaccine_code AS vaccine_type,
            epi_vaccine_name AS vaccine_name,
            '",db,"'  AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 4' AS source
    FROM
        dw_",db,".person_epi pw
    INNER JOIN dw_",db,".person_epi_vaccine pws ON pw.person_epi_id = pws.person_epi_id
    INNER JOIN dw_",db,".person_epi_vaccine_list pwv ON pwv.person_epi_vaccine_id = pws.person_epi_vaccine_id
    INNER JOIN dw_",db,".epi_vaccine v ON v.epi_vaccine_id = pwv.epi_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        vaccine_date BETWEEN @start_d AND @end_d UNION ALL
        SELECT
        ov.vn,
            pp.person_id,
            vstdate AS service_date,
            vsttime AS service_time,
            export_vaccine_code AS vaccine_type,
            vaccine_name,
            '",db,"'  AS service_hospcode,
            vaccine_lot_no AS vaccine_lotno,
            '' AS vaccine_hospcode,
            'onestop service' AS source
    FROM
        dw_",db,".ovst_vaccine ov
    INNER JOIN dw_",db,".ovst o ON o.vn = ov.vn
    LEFT JOIN dw_",db,".patient pt ON o.hn = pt.hn
    LEFT JOIN dw_",db,".person pp ON pt.cid = pp.cid
    INNER JOIN dw_",db,".person_vaccine pv ON ov.person_vaccine_id = pv.person_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        vstdate BETWEEN @start_d AND @end_d UNION ALL
    SELECT
        vn,
            pw.person_id,
            vaccine_date AS service_date,
            vaccine_time AS service_time,
            export_vaccine_code AS vaccine_type,
            student_vaccine_name AS vaccine_name,
            '",db,"'  AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 5' AS source
    FROM
        dw_",db,".village_student pw
    INNER JOIN dw_",db,".village_student_vaccine pws ON pw.village_student_id = pws.village_student_id
    INNER JOIN dw_",db,".village_student_vaccine_list pwv ON pwv.village_student_vaccine_id = pws.village_student_vaccine_id
    INNER JOIN dw_",db,".student_vaccine v ON v.student_vaccine_id = pwv.student_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and
        vaccine_date BETWEEN @start_d AND @end_d UNION ALL SELECT
        vn,
            pw.person_id,
            anc_service_date AS service_date,
            anc_service_time AS service_time,
            export_vaccine_code AS vaccine_type,
            anc_service_name AS vaccine_name,
            '",db,"'  AS service_hospcode,
            vaccine_lotno,
            '' AS vaccine_hospcode,
            'บัญชี 2' AS source
    FROM
        dw_",db,".person_anc pw
    INNER JOIN dw_",db,".person_anc_service pws ON pw.person_anc_id = pws.person_anc_id
    INNER JOIN dw_",db,".person_anc_service_detail pwv ON pwv.person_anc_service_id = pws.person_anc_service_id
    INNER JOIN dw_",db,".anc_service v ON v.anc_service_id = pwv.anc_service_id
    WHERE length(export_vaccine_code) > 1
        and anc_service_date BETWEEN @start_d AND @end_d UNION ALL SELECT
         null as vn,
            a.person_id,
            vaccine_date as service_date,
            update_datetime as service_time,
            export_vaccine_code AS vaccine_type,
            vaccine_name,
            '",db,"'  AS service_hospcode,
            vaccine_lotno,
            vaccine_hospcode,
            'elsewhere' AS source
    FROM
         dw_",db,".person_vaccine_elsewhere a
    INNER JOIN dw_",db,".person_vaccine v ON v.person_vaccine_id = a.person_vaccine_id
    WHERE length(export_vaccine_code) > 1
        and vaccine_date BETWEEN @start_d AND @end_d ) AS tt
        INNER JOIN  dw_",db,".person p ON p.person_id = tt.person_id
");
        
        PREPARE output FROM @output;
        EXECUTE output;
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
 
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_labdmht` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_labdmht` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_labdmht`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;#WHERE hospcode=hospcode_cup
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-2,'1001');
	SET @start_d1:=CONCAT(@b_year-1,'0701');
	SET @end_d:=CONCAT(@b_year,'0930');
DROP TABLE IF EXISTS report_labdmht;
CREATE TABLE `report_labdmht` (
   `hospcode` varchar(5) DEFAULT NULL,
   `pid` VARCHAR(15) DEFAULT '',
   `cid` varchar(13) DEFAULT NULL,
   `labtest` varchar(2) DEFAULT NULL,
   `labname` varchar(20) DEFAULT NULL,
   `labresult` varchar(20) DEFAULT NULL,
   `date_serv` date DEFAULT NULL,
	KEY (hospcode),
	KEY (pid),
	KEY (cid),
	KEY (date_serv),
	KEY (labtest),
	KEY (labresult)
 ) ENGINE=MyISAM ;
 
 
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_labdmht ",db," */
     INSERT INTO report_labdmht
		SELECT 
			'",db,"' AS hospcode
			,p2.person_id AS pid
			,p2.cid
			,labtest
			,labname
			,labresult
			,date_serv 
		FROM (
			SELECT 
			'05' AS labtest
			,'hba1c' AS labname
			,hba1c AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND hba1c IS NOT NULL
		UNION
			SELECT 
			'01' AS labtest
			,'fbs' AS labname
			,fbs AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND fbs IS NOT NULL
		UNION
			SELECT 
			'03' AS labtest
			,'fpg' AS labname
			,dtx1 AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			INNER JOIN dw_",db,".opdscreen_fbs f on f.vn = o.vn
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND dtx1 IS NOT NULL AND dtx1 > 0
		UNION
			SELECT 
			'11' AS labtest
			,'creatinine' AS labname
			,creatinine AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND creatinine IS NOT NULL
		UNION
			SELECT 
			'15' AS labtest
			,'egfr' AS labname
			,egfr AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND egfr IS NOT NULL
		UNION
			SELECT 
			'12' AS labtest
			,'micro_albumin' AS labname
			,micro_albumin AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND micro_albumin IS NOT NULL
		UNION
			SELECT 
			'14' AS labtest
			,'macro_albumin' AS labname
			,macro_albumin AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND macro_albumin IS NOT NULL
		UNION
			SELECT 
			'07' AS labtest
			,'tc' AS labname
			,tc AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND tc IS NOT NULL
		UNION
			SELECT 
			'06' AS labtest
			,'tg' AS labname
			,tg AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND tg IS NOT NULL
		UNION
			SELECT 
			'13' AS labtest
			,'urine_creatinine' AS labname
			,urine_creatinine AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND urine_creatinine IS NOT NULL
		UNION
			SELECT 
			'08' AS labtest
			,'hdl' AS labname
			,hdl AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND hdl IS NOT NULL
		UNION
			SELECT 
			'09' AS labtest
			,'ldl' AS labname
			,ldl AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND ldl IS NOT NULL
		UNION
			SELECT 
			'10' AS labtest
			,'bun' AS labname
			,bun AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND bun IS NOT NULL
				
		UNION
			SELECT 
			'16' AS labtest
			,'hb' AS labname
			,hb AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND hb IS NOT NULL
		UNION
			SELECT 
			'17' AS labtest
			,'upcr' AS labname
			,upcr AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND upcr IS NOT NULL
		UNION
			SELECT 
			'18' AS labtest
			,'potassium' AS labname
			,potassium AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND potassium IS NOT NULL	
		UNION
			SELECT 
			'19' AS labtest
			,'bicarb' AS labname
			,bicarb AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND bicarb IS NOT NULL
		UNION
			SELECT 
			'20' AS labtest
			,'phosphate' AS labname
			,phosphate AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND phosphate IS NOT NULL
		UNION
			SELECT 
			'21' AS labtest
			,'pth' AS labname
			,pth AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND pth IS NOT NULL				
            ) t     
			INNER JOIN dw_",db,".patient p ON p.hn = t.hn
            INNER JOIN dw_",db,".person p2 ON p2.cid = p.cid;
            ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_labfu` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_labfu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_labfu`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;#WHERE hospcode=hospcode_cup
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-2,'1001');
	SET @start_d1:=CONCAT(@b_year-1,'0701');
	SET @end_d:=CONCAT(@b_year,'0930');
#DROP TABLE IF EXISTS report_labdmht;
  CREATE TABLE IF NOT EXISTS `report_labfu` (
   `hospcode` varchar(5) DEFAULT NULL,
   `pid` VARCHAR(15) DEFAULT '',
   `cid` varchar(13) DEFAULT NULL,
   `labtest` varchar(7) DEFAULT NULL,
   `labname` varchar(20) DEFAULT NULL,
   `labresult` varchar(20) DEFAULT NULL,
   `date_serv` date DEFAULT NULL,
   `source` varchar(25) DEFAULT NULL,
   `rpt_date` date NULL DEFAULT '0000-00-00',
	KEY (hospcode),
	KEY (pid),
	KEY (cid),
	KEY (date_serv),
	KEY (labtest),
	KEY (labresult)
 ) ENGINE=MyISAM ;
 
   #ลบข้อมูลเพื่อเติมข้อมูลใหม่  
  DELETE FROM report_labfu WHERE `source` <> 'HDC'; 
 
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_labfu ",db," */
     INSERT INTO report_labfu (hospcode,pid,cid,labtest,labname,labresult,date_serv,`source`,rpt_date)
		SELECT 
			'",db,"' AS hospcode
			,p2.person_id AS pid
			,p2.cid
			,labtest
			,labname
			,labresult
			,date_serv 
            ,'WMC' as source 
			,now() as rpt_date
		FROM (
			SELECT 
			'05' AS labtest
			,'hba1c' AS labname
			,hba1c AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND hba1c IS NOT NULL
		UNION
			SELECT 
			'01' AS labtest
			,'fbs' AS labname
			,fbs AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND fbs IS NOT NULL
		UNION
			SELECT 
			'03' AS labtest
			,'fpg' AS labname
			,dtx1 AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			INNER JOIN dw_",db,".opdscreen_fbs f on f.vn = o.vn
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND dtx1 IS NOT NULL AND dtx1 > 0
		UNION
			SELECT 
			'11' AS labtest
			,'creatinine' AS labname
			,creatinine AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND creatinine IS NOT NULL
		UNION
			SELECT 
			'15' AS labtest
			,'egfr' AS labname
			,egfr AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND egfr IS NOT NULL
		UNION
			SELECT 
			'12' AS labtest
			,'micro_albumin' AS labname
			,micro_albumin AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND micro_albumin IS NOT NULL
		UNION
			SELECT 
			'14' AS labtest
			,'macro_albumin' AS labname
			,macro_albumin AS labresult
			,vstdate AS date_serv
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND macro_albumin IS NOT NULL
		UNION
			SELECT 
			'07' AS labtest
			,'tc' AS labname
			,tc AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND tc IS NOT NULL
		UNION
			SELECT 
			'06' AS labtest
			,'tg' AS labname
			,tg AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND tg IS NOT NULL
		UNION
			SELECT 
			'13' AS labtest
			,'urine_creatinine' AS labname
			,urine_creatinine AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND urine_creatinine IS NOT NULL
		UNION
			SELECT 
			'08' AS labtest
			,'hdl' AS labname
			,hdl AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND hdl IS NOT NULL
		UNION
			SELECT 
			'09' AS labtest
			,'ldl' AS labname
			,ldl AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND ldl IS NOT NULL
		UNION
			SELECT 
			'10' AS labtest
			,'bun' AS labname
			,bun AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND bun IS NOT NULL
				
		UNION
			SELECT 
			'16' AS labtest
			,'hb' AS labname
			,hb AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND hb IS NOT NULL
		UNION
			SELECT 
			'17' AS labtest
			,'upcr' AS labname
			,upcr AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND upcr IS NOT NULL
		UNION
			SELECT 
			'18' AS labtest
			,'potassium' AS labname
			,potassium AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND potassium IS NOT NULL	
		UNION
			SELECT 
			'19' AS labtest
			,'bicarb' AS labname
			,bicarb AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND bicarb IS NOT NULL
		UNION
			SELECT 
			'20' AS labtest
			,'phosphate' AS labname
			,phosphate AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND phosphate IS NOT NULL
		UNION
			SELECT 
			'21' AS labtest
			,'pth' AS labname
			,pth AS labresult
			,vstdate AS date_serv 
			,hn
			FROM dw_",db,".opdscreen o
			WHERE vstdate BETWEEN @start_d AND @end_d
			AND pth IS NOT NULL				
            ) t     
			INNER JOIN dw_",db,".patient p ON p.hn = t.hn
            INNER JOIN dw_",db,".person p2 ON p2.cid = p.cid;
            ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_ncdscreen` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_ncdscreen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_ncdscreen`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '0ecdbc306b23e09f92fe091e7ccf053d';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');
    
DROP TABLE IF EXISTS report_ncdscreen;    
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
   `D_UPDATE` datetime NULL,
   #PRIMARY KEY (`HOSPCODE`,`PID`,`DATE_SERV`),
   KEY `idx1` (`HOSPCODE`,`PID`),
   KEY `idx2` (`HOSPCODE`),
   KEY `idx3` (`DATE_SERV`),
   KEY `idx4` (`SBP_1`,`DBP_1`),
   KEY `idx5` (`SBP_2`,`DBP_2`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_ncdscreen ",db," */
     INSERT INTO report_ncdscreen (hospcode,pid,date_serv,weight,height,waist_cm,sbp_1,dbp_1,sbp_2,dbp_2,bslevel)
	    SELECT 
			'",db,"' as hospcode
			,p.person_id as pid
			,p2.screen_date as date_serv
			,body_weight as weight
			,body_height as height
			,waist as waist_cm
			,p3.bps as sbp_1
			,p3.bpd as dbp_1
			,p4.bps as sbp_2
			,p4.bpd as dbp_2
            ,IF(last_fgc IS NULL OR last_fgc = '' OR last_fgc < 1,last_fgc_no_food_limit,last_fgc) as bslevel
			
		FROM
			dw_",db,".person p
			INNER JOIN dw_",db,".person_dmht_screen_summary p1 ON p.person_id = p1.person_id
			INNER JOIN dw_",db,".person_dmht_risk_screen_head p2 ON p1.person_dmht_screen_summary_id = p2.person_dmht_screen_summary_id
			LEFT JOIN dw_",db,".person_ht_risk_bp_screen p3 ON p2.person_dmht_risk_screen_head_id = p3.person_dmht_risk_screen_head_id AND p3.screen_no=1
			LEFT JOIN dw_",db,".person_ht_risk_bp_screen p4 ON p2.person_dmht_risk_screen_head_id = p4.person_dmht_risk_screen_head_id AND p4.screen_no=2
		WHERE p2.screen_date BETWEEN @start_d AND @end_d;");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_newborn` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_newborn` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_newborn`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
    SET	@id:= '9';
    SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
	SET @date_3:=CONCAT(@b_year-2,'1001');
    
DROP TABLE IF EXISTS report_newborn;
CREATE TABLE `report_newborn` (
  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pid` int(11),
  `mpid` int(11) DEFAULT NULL,
  `gravida` int(11) DEFAULT NULL,
  `ga` int(11) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `btime` varchar(6) DEFAULT NULL,
  `bplace` varchar(1)  DEFAULT NULL,
  `bhosp` varchar(5) DEFAULT NULL,
  `birthno` varchar(1) DEFAULT NULL,
  `btype` varchar(1)  DEFAULT NULL,
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

        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_newborn ",db," */
     INSERT INTO report_newborn
     SELECT 
		'",db,"' AS hospcode
		,p.person_id AS pid
		,p.mother_person_id AS mpid
		,n.gravida AS gravida
		,n.ga AS ga
		,p.birthdate AS bdate
		,IFNULL(TIME_FORMAT(p.birthtime,'%H%i%s'),'000000') AS btime
		,'' AS bplace
		,n.labour_hospcode AS bhosp
		,'' AS birthno
		,'' AS btype
		,'' AS bdoctor
		,n.birth_weight AS bweight
		,IFNULL(IF(n.has_asphyxia = 'Y',1,2),9) AS asphyxia
		,IFNULL(IF(n.has_vitk='Y',1,2),9) AS vitk
		,IFNULL(IF(tsh_result > 0,1,2),9)  AS tsh
		,tsh_result AS thsresult
		,cid AS cid
		,mother_cid AS mcid
		,father_person_id AS fpid
		FROM dw_",db,".person_wbc w 
		LEFT JOIN dw_",db,".person_labour n ON w.person_id = n.person_id
		LEFT JOIN dw_",db,".person p ON p.person_id = n.person_id
		WHERE p.birthdate BETWEEN @date_3 AND @end_d;");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;



END */$$
DELIMITER ;

/* Procedure structure for procedure `report_nutrition` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_nutrition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_nutrition`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;


	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '0ecdbc306b23e09f92fe091e7ccf053d';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');
	SET @begin_d=DATE_ADD(@start_d,INTERVAL -30 month);
	SET @begin_d1=concat(@b_year-5,'1001');
	SET @end_d1:=concat(@b_year,'1030');
    
    DROP TABLE IF EXISTS report_nutrition;

	CREATE TABLE `report_nutrition` (
	   `hospcode` varchar(5) DEFAULT NULL,
	   `pid` VARCHAR(13) DEFAULT NULL,
	   `cid` varchar(13) DEFAULT NULL,
       `date_serv` date DEFAULT NULL,
	   `height` varchar(3) DEFAULT NULL,
	   `weight` varchar(20) DEFAULT NULL,
	   `childdevelop` varchar(1) DEFAULT NULL,
	   `age_y` int(3) DEFAULT NULL,
        `source` varchar(20) DEFAULT NULL,
		KEY (hospcode),
		KEY (pid),
		KEY (cid),
		KEY (date_serv),
		KEY (childdevelop)
	 ) ENGINE=MyISAM ;
    
    
    OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_nutrition ",db," */
     INSERT INTO report_nutrition
     
		SELECT
			'",db,"' as hospcode
			,w.person_id AS pid
            ,p.cid
			,nutrition_date AS date_serv
			,height
			,body_weight AS weight
			,person_nutrition_childdevelop_type_id AS childdevelop
			,age(NOW(),p.birthdate,'y') AS age_y
            ,'wbc' as source
			FROM dw_",db,".person_wbc_nutrition n
			LEFT JOIN dw_",db,".person_wbc w ON w.person_wbc_id = n.person_wbc_id
			LEFT JOIN dw_",db,".person p ON p.person_id = w.person_id
			WHERE nutrition_date BETWEEN @begin_d1 AND @end_d1

			UNION

			SELECT
            '",db,"' as hospcode
			,w.person_id AS pid
            ,p.cid
			,nutrition_date AS date_serv
			,height
			,body_weight AS weight
			,person_nutrition_childdevelop_type_id AS childdevelop
			,age(NOW(),p.birthdate,'y') AS age_y
            ,'epi' as source
			FROM dw_",db,".person_epi_nutrition n
			LEFT JOIN dw_",db,".person_epi w ON w.person_epi_id = n.person_epi_id
			LEFT JOIN dw_",db,".person p ON p.person_id = w.person_id
			WHERE nutrition_date BETWEEN @begin_d1 AND @end_d1

			UNION

			SELECT
            '",db,"' as hospcode
			,w.person_id AS pid
            ,p.cid
			,screen_date AS date_serv
			,height
			,body_weight AS weight
			,person_nutrition_childdevelop_type_id AS childdevelop
			,age(NOW(),p.birthdate,'y') AS age_y
            ,'student' as source
			FROM dw_",db,".village_student_screen n
			LEFT JOIN dw_",db,".village_student w ON w.village_student_id = n.village_student_id
			LEFT JOIN dw_",db,".person p ON p.person_id = w.person_id
			WHERE screen_date BETWEEN @begin_d1 AND @end_d1
     
    ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;


END */$$
DELIMITER ;

/* Procedure structure for procedure `report_opdscreen_dmht` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_opdscreen_dmht` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_opdscreen_dmht`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
  DROP TABLE IF EXISTS report_opdscreen_dmht;
  CREATE TABLE `report_opdscreen_dmht` (
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `cid` varchar(13) DEFAULT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `vstdate` date DEFAULT NULL,
  `vsttime` time DEFAULT NULL,
  `bpd` double(15,3) DEFAULT NULL,
  `bps` double(15,3) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `fbs` double(15,3) DEFAULT NULL,
  `bmi` double(15,3) DEFAULT NULL,
  `tg` double(15,3) DEFAULT NULL,
  `tc` double(15,3) DEFAULT NULL,
  `hba1c` double(15,3) DEFAULT NULL,
  `hdl` double(15,3) DEFAULT NULL,
  `ldl` double(15,3) DEFAULT NULL,
  `egfr` DOUBLE(15,3) DEFAULT NULL,
  `waist` double(15,3) DEFAULT NULL,
  `smoking` int(11) DEFAULT NULL,
  `clinic` varchar(9) NOT NULL,
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_cid` (`cid`),
  KEY `idx_vstdate` (`vstdate`),
  KEY `idx_clinic` (`clinic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE report_opdscreen_dmht DISABLE KEYS;
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_opdscreen_dmht ",db," */
	INSERT INTO report_opdscreen_dmht
		SELECT 
		'",db,"' AS hospcode,p.cid,vn,o.hn,vstdate,vsttime,bpd,bps,o.height,fbs,bmi,tg,tc,hba1c,hdl,ldl,egfr,waist,smoking_type_id AS smoking,c.clinic
		FROM dw_",db,".opdscreen o 
		INNER JOIN dw_",db,".clinicmember c ON o.hn = c.hn AND clinic IN ('001','002')
		INNER JOIN dw_",db,".patient p ON c.hn = p.hn
		WHERE vstdate BETWEEN '2014-10-01' AND NOW()
		AND bpd IS NOT NULL
		AND bps IS NOT NULL
		");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
  
  ALTER TABLE report_opdscreen_dmht ENABLE  KEYS;
  OPTIMIZE TABLE report_opdscreen_dmht;
  
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_opdscreen_dmht_2558` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_opdscreen_dmht_2558` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_opdscreen_dmht_2558`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
  DROP TABLE IF EXISTS report_opdscreen_dmht_2558;
  CREATE TABLE `report_opdscreen_dmht_2558` (
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `cid` varchar(13) DEFAULT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `vstdate` date DEFAULT NULL,
  `vsttime` time DEFAULT NULL,
  `bpd` double(15,3) DEFAULT NULL,
  `bps` double(15,3) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `fbs` double(15,3) DEFAULT NULL,
  `bmi` double(15,3) DEFAULT NULL,
  `tg` double(15,3) DEFAULT NULL,
  `tc` double(15,3) DEFAULT NULL,
  `hba1c` double(15,3) DEFAULT NULL,
  `hdl` double(15,3) DEFAULT NULL,
  `ldl` double(15,3) DEFAULT NULL,
  `egfr` DOUBLE(15,3) DEFAULT NULL,
  `waist` double(15,3) DEFAULT NULL,
  `smoking` int(11) DEFAULT NULL,
  `clinic` varchar(9) NOT NULL,
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_cid` (`cid`),
  KEY `idx_vstdate` (`vstdate`),
  KEY `idx_clinic` (`clinic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE report_opdscreen_dmht_2558 DISABLE KEYS;
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_opdscreen_dmht_2558 ",db," */
	INSERT INTO report_opdscreen_dmht_2558
		SELECT 
		'",db,"' AS hospcode,p.cid,vn,o.hn,vstdate,vsttime,bpd,bps,o.height,fbs,bmi,tg,tc,hba1c,hdl,ldl,egfr,waist,smoking_type_id AS smoking,c.clinic
		FROM dw_",db,".opdscreen o 
		INNER JOIN dw_",db,".clinicmember c ON o.hn = c.hn AND clinic IN ('001','002')
		INNER JOIN dw_",db,".patient p ON c.hn = p.hn
		WHERE vstdate BETWEEN '2014-10-01' AND '2015-09-30'
		AND bpd IS NOT NULL
		AND bps IS NOT NULL
		");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
  
  ALTER TABLE report_opdscreen_dmht_2558 ENABLE  KEYS;
  OPTIMIZE TABLE report_opdscreen_dmht_2558;
  
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_opdscreen_dmht_2559` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_opdscreen_dmht_2559` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_opdscreen_dmht_2559`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
  DROP TABLE IF EXISTS report_opdscreen_dmht_2559;
  CREATE TABLE `report_opdscreen_dmht_2559` (
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `cid` varchar(13) DEFAULT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `vstdate` date DEFAULT NULL,
  `vsttime` time DEFAULT NULL,
  `bpd` double(15,3) DEFAULT NULL,
  `bps` double(15,3) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `fbs` double(15,3) DEFAULT NULL,
  `bmi` double(15,3) DEFAULT NULL,
  `tg` double(15,3) DEFAULT NULL,
  `tc` double(15,3) DEFAULT NULL,
  `hba1c` double(15,3) DEFAULT NULL,
  `hdl` double(15,3) DEFAULT NULL,
  `ldl` double(15,3) DEFAULT NULL,
  `egfr` DOUBLE(15,3) DEFAULT NULL,
  `waist` double(15,3) DEFAULT NULL,
  `smoking` int(11) DEFAULT NULL,
  `clinic` varchar(9) NOT NULL,
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_cid` (`cid`),
  KEY `idx_vstdate` (`vstdate`),
  KEY `idx_clinic` (`clinic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE report_opdscreen_dmht_2559 DISABLE KEYS;
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_opdscreen_dmht_2559 ",db," */
	INSERT INTO report_opdscreen_dmht_2559
		SELECT 
		
		'",db,"' AS hospcode,p.cid,o.vn,o.hn,o.vstdate,o.vsttime,bpd,bps,o.height,fbs,bmi,tg,tc,hba1c,hdl,ldl,egfr,waist,o.smoking_type_id AS smoking,c.clinic
		FROM dw_",db,".opdscreen o 
		INNER JOIN dw_",db,".vn_stat v ON o.vn = v.vn
		INNER JOIN dw_",db,".clinicmember c ON o.hn = c.hn AND clinic IN ('001','002')
		INNER JOIN dw_",db,".patient p ON c.hn = p.hn
		WHERE o.vstdate BETWEEN '2014-10-01' AND now()
		AND bpd IS NOT NULL
		AND bps IS NOT NULL
		AND (pdx between 'E10' and 'E1499' OR pdx between 'I10' and 'I1599')
		");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
  
  ALTER TABLE report_opdscreen_dmht_2559 ENABLE  KEYS;
  OPTIMIZE TABLE report_opdscreen_dmht_2559;
  
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_opvisit` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_opvisit` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_opvisit`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode in ('08264') order by hospcode asc;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
  
  	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-2,'1001');
	SET @end_d:=concat(@b_year,'0930');

  
DROP TABLE IF EXISTS report_opvisit;
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
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_opvisit ",db," */
     INSERT INTO report_opvisit
					SELECT SQL_BIG_RESULT '",db,"' AS hserv,hospmain,hospsub,YEAR(vstdate) AS yy,MONTH(vstdate)AS mm,COUNT(vn) AS cc,now() as reg_date
                    FROM dw_",db,".ovst o
                    LEFT JOIN dw_",db,".pttype p ON p.pttype = o.pttype
                    WHERE vstdate BETWEEN @start_d AND @end_d
                    AND hospsub <> ''
                    AND pcode IN ('A3','A4','A5','A6','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','UC')
                    GROUP BY hospmain ,hospsub,YEAR(vstdate),MONTH(vstdate);");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_ovstdiag` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_ovstdiag` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_ovstdiag`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
	SET @date_3:=CONCAT(@b_year-2,'1001');
    
	DROP TABLE IF EXISTS report_ovstdiag;
    
    CREATE TABLE `report_ovstdiag` (
    `hcode` VARCHAR(5) DEFAULT NULL,
   `cc_times` bigint(21) NOT NULL DEFAULT '0',
   `cc` bigint(21) NOT NULL DEFAULT '0',
   `pdx` varchar(9) DEFAULT NULL,
   `yy` int(4) DEFAULT NULL,
   `mm` varbinary(2) DEFAULT NULL,
   `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
   KEY `idx_hcode` (`hcode`),
   KEY `idx_pdx` (`pdx`)
 ) ENGINE=MyISAM DEFAULT CHARSET=tis620;
    

OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_ovstdiag ",db," */
     INSERT INTO report_ovstdiag
     
     (SELECT SQL_BIG_RESULT
	'",db,"' as hcode
	,count(vn) as cc_times
	,count(DISTINCT hn) as cc
	,icd10 as pdx
	,year(vstdate) as yy
	,LPAD(month(vstdate),2,'0') as mm
	,now() as reg_date
	from dw_",db,".ovstdiag
	WHERE vstdate BETWEEN @date_3 AND @end_d
	and left(icd10,1) between 'A' and 'Z' 
	group by icd10,year(vstdate),month(vstdate));");
	
        PREPARE output FROM @output;
        EXECUTE output;
        
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;  
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_persondeath` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_persondeath` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_persondeath`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode = '08264';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-10,'1001');
	SET @end_d:=concat(@b_year,'0930');


DROP TABLE IF EXISTS report_persondeath;

	CREATE TABLE `report_persondeath` (
	   `cid` varchar(13) DEFAULT NULL,
       `pid` varchar(10),
       `pdeath` date,
       `discharge` varchar(1),
	   `hoscode` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
	   `death_date` date,
	   `death_diag` varchar(100),
	   KEY `idx_cid` (`cid`)
	 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*
	INSERT INTO report_persondeath
		SELECT cid
		,GROUP_CONCAT(DISTINCT hospcode ORDER BY death_date ASC) AS hoscode
		,GROUP_CONCAT(DISTINCT death_date ORDER BY death_date ASC) AS death_date
		,GROUP_CONCAT(DISTINCT death_diag ORDER BY death_date ASC) AS death_diag
		FROM person_death_view
        WHERE death_date <> '' and death_date is not null
		GROUP BY cid ;
*/

OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
    
     IF NOT done THEN
            SET @output = CONCAT("INSERT INTO report_persondeath SELECT cid
		,p.person_id AS pid
        ,p.death as pdeath
        ,p.person_discharge_id as discharge
		,'",db,"' AS hoscode
		,GROUP_CONCAT(DISTINCT d.death_date ORDER BY d.death_date ASC) AS death_date
		,GROUP_CONCAT(DISTINCT d.death_diag_date_1 ORDER BY d.death_date ASC) AS death_diag
		FROM dw_",db,".person_death d,dw_",db,".person p
        WHERE d.death_date <> '' and d.death_date is not null
        AND p.person_id = d.person_id
		GROUP BY cid");
        
        PREPARE output FROM @output;
        EXECUTE output;
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_person_anc` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_person_anc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_person_anc`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET	@start_d:=CONCAT(@b_year-2,'1001');
	SET	@start_d1:=CONCAT(@b_year-1,'0701');
	SET @end_d:=CONCAT(@b_year,'0930');

#DROP TABLE IF EXISTS report_person_anc;

CREATE TABLE IF NOT EXISTS report_person_anc (
              `cid` varchar(13) DEFAULT NULL,
              `pid` VARCHAR(13) DEFAULT NULL,
              `regplace` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
              `person_name` varchar(150) NOT NULL DEFAULT '',
              `anc_register_date` date DEFAULT NULL,
              `discharge` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
              `typearea` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
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
              
			`thalasseima_preg_age` int(11) NOT NULL DEFAULT 0,
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
            `blood_hct_grade` int(11) NOT NULL DEFAULT 0,
            `source` varchar(25) DEFAULT NULL,
			`rpt_date` date NULL DEFAULT '0000-00-00',
            
              
              #UNIQUE KEY `key_UNIQUE` (`regplace`,`cid`,`preg_no`),
              KEY `idx_cid` (`cid`),
              KEY `idx_pid` (`pid`),
              KEY `idx_labor_date` (`labor_date`),
              KEY `idx_birthdate` (`birthdate`),
              KEY `idx_regplace` (`regplace`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
 #ลบข้อมูลเพื่อเติมข้อมูลใหม่  
	DELETE FROM report_person_anc WHERE `source` <> 'HDC'; 
 
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_person_anc ",db," */
     INSERT INTO report_person_anc
		select SQL_BIG_RESULT 
			cid
            ,p.person_id as pid
            ,'",db,"' as regplace
            ,concat(pname,fname,' ',lname) as person_name
            ,anc_register_date
            ,if((discharge is null || discharge = 'N'),'N','Y') as discharge
            ,if(house_regist_type_id is null || house_regist_type_id not in (1,2,3,4,5) ,'9',house_regist_type_id) as typearea
            ,if(labor_status_id is null || labor_status_id = '','',labor_status_id) as labor_status
            ,ifnull(lmp,'') as lmp
            ,timestampdiff(week,lmp,anc_register_date) as age_preg
            ,ifnull(labor_date,'') as labor_date
            ,ifnull(labour_hospcode,'') as labour_hospcode
            ,ifnull(a.preg_no,'') as preg_no
            ,p.nationality
            ,p.birthdate
            ,timestampdiff(year,birthdate,anc_register_date) as age
            ,ifnull(risk_list,'') as risk_list
            ,labor_icd10
            
            ,labour_type_id
            ,labor_place_id
            ,labor_doctor_type_id
            ,alive_child_count
            ,dead_child_count
            
            ,thalasseima_preg_age
            ,thalassemia_screen_date
            ,thalassemia_confirm_date
            ,thalassemia_prenatal_date
            ,thalassemia_prenatal_confirm
            ,thalassemia_prenatal_confirm_date
            ,first_doctor_date
            
            ,blood_check1_date
            ,blood_check2_date
            ,blood_vdrl1_result
            ,blood_vdrl2_result
            ,blood_hiv1_result
            ,blood_hiv2_result
            ,blood_of_result
            ,blood_hct_result
            ,blood_hct_grade
            
            ,'WMC' as source
			,now() as rpt_date
            
            from dw_",db,".person_anc a,dw_",db,".person p
            where p.person_id = a.person_id
            and anc_register_date is not null
            and (anc_register_date >= @start_d or labor_date >= @start_d)
            and anc_register_date <= CURDATE()
     ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;

        
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_postnatal` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_postnatal` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_postnatal`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
    SET	@id:= '9';
    SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
	SET @date_3:=CONCAT(@b_year-2,'1001');
    
#DROP TABLE IF EXISTS report_postnatal;
CREATE TABLE IF NOT EXISTS`report_postnatal` (
  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `pid` int(11),
  `gravida` int(11) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `ppcare` date NULL DEFAULT NULL,
  `ppresult` varchar(1) DEFAULT NULL,
  `ppplace` varchar(5) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `source` varchar(25) DEFAULT NULL,
  `rpt_date` date NULL DEFAULT '0000-00-00',
  KEY `idx_hospcode` (`hospcode`),
  KEY `idx_pid` (`pid`),
  KEY `idx_ppcare` (`ppcare`),
  KEY `idx_bdate` (`bdate`),
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;
#ลบข้อมูลเพื่อเติมข้อมูลใหม่  
DELETE FROM report_postnatal WHERE `source` <> 'HDC';  
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_postnatal ",db," */
     INSERT INTO report_postnatal
     SELECT 
		'",db,"' AS hospcode
		,p.person_id AS pid
		,preg_no AS gravida
		,labor_date AS bdate 
        ,care_date AS ppcare
		,'' AS ppresult
        ,'",db,"' AS pplace
		,cid AS cid
        ,'WMC' AS source
		,now() as rpt_date
		FROM dw_",db,".person_anc w 
		INNER JOIN dw_",db,".person_anc_preg_care n ON w.person_anc_id = n.person_anc_id
		INNER JOIN dw_",db,".person p ON p.person_id = w.person_id
		WHERE labor_date BETWEEN @date_3 AND @end_d;");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_r506` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_r506` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_r506`()
BEGIN
DROP TABLE IF EXISTS report_r506;
CREATE TABLE IF NOT EXISTS report_r506 (
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
        
INSERT INTO report_r506        
(SELECT 
    v.*, r.id, n.name, CURDATE() AS rpt_date
FROM
    vn_stat_view v
        INNER JOIN
    rpt_506_code r ON v.pdx BETWEEN code1 AND code2
        INNER JOIN
    rpt_506_name n ON r.id = n.id
WHERE
    vstdate BETWEEN DATE_ADD(CURDATE(), INTERVAL - 1 YEAR) AND CURDATE());
        
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_service` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_service` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_service`()
BEGIN
DROP TABLE IF EXISTS report_service;

CREATE TABLE report_service (
hcode VARCHAR(5) NOT NULL, 
yy VARCHAR(4) NOT NULL,
mm VARCHAR(2) NOT NULL,
cc INT(11) NOT NULL,
times INT(11) NOT NULL,
reg_date TIMESTAMP
);

INSERT INTO report_service (SELECT SQL_BIG_RESULT
hcode,
year(vstdate) as yy,
LPAD(month(vstdate),2,'0') as mm ,
count(vn) as cc,
count(distinct cid) as cc,
now()
FROM vn_stat_view
where vstdate between DATE_ADD(NOW( ), INTERVAL -12 MONTH ) and now()
group by year(vstdate),month(vstdate),hcode);
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_service_anc` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_service_anc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_service_anc`()
BEGIN
DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-2,'1001');
	SET @end_d:=concat(@b_year,'0930');
  
  DROP TABLE IF EXISTS report_service_anc;
CREATE TABLE `report_service_anc` (
   `hospcode` varchar(5) DEFAULT NULL,
   `cid` varchar(13) DEFAULT NULL,
   `pid` VARCHAR(13) DEFAULT NULL,
   `vn` VARCHAR(13) DEFAULT NULL,
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
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_service_anc ",db," */
     INSERT INTO report_service_anc
	SELECT 
	    SQL_BIG_RESULT '",db,"' AS hospcode,	
	    cid,
	    a.person_id as pid,
	    vn,
	    precare_hospcode,
	    IFNULL(pa_week,
		    TIMESTAMPDIFF(WEEK, lmp, service_date)) AS pa_week,
	    preg_no,
	    service_date,
	    labor_date,
	    edc,
	    lmp,
	    ga,
	    note
	FROM
	    (SELECT 
		person_anc_id,
		    anc_service_date AS service_date,
		    pa_week,
		    NULL AS precare_hospcode,
		    'service_care' AS note,
		    vn
	    FROM
		dw_",db,".person_anc_service UNION ALL SELECT 
		person_anc_id,
		    precare_date AS service_date,
		    NULL AS pa_week,
		    precare_hospcode,
		    'other_precare' AS note,
		    '' as vn
		    
	    FROM
		dw_",db,".person_anc_other_precare UNION ALL SELECT 
		person_anc_id,
		    care_date AS service_date,
		    NULL AS pa_week,
		    NULL AS precare_hospcode,
		    'preg_care' AS note,
		    vn
	    FROM
		dw_",db,".person_anc_preg_care) t
		LEFT JOIN dw_",db,".person_anc a ON a.person_anc_id = t.person_anc_id
		LEFT JOIN dw_",db,".person p ON p.person_id = a.person_id
	WHERE
	    service_date BETWEEN @start_d AND @end_d;");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `report_specialpp` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_specialpp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_specialpp`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '55';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');
	SET @begin_d=DATE_ADD(@start_d,INTERVAL -43 month);
	SET @begin_d1=DATE_ADD(@start_d,INTERVAL -1 month);
	SET @end_d1:=concat(@b_year,'1030');

/*เตรียมข้อมูล*/
DROP TABLE IF EXISTS report_specialpp;
CREATE TABLE IF NOT EXISTS `report_specialpp` (
    `hospcode` VARCHAR(5) NOT NULL,
    `pid` VARCHAR(15) NOT NULL,
    `seq` VARCHAR(16) DEFAULT NULL,
    `date_serv` DATE NOT NULL,
    `servplace` CHAR(1) NOT NULL,
    `ppspecial` VARCHAR(6) NOT NULL,
    `ppsplace` VARCHAR(5) DEFAULT NULL,
    `provider` VARCHAR(15) DEFAULT NULL,
    `d_update` DATETIME NOT NULL,
    #PRIMARY KEY (`hospcode` , `pid` , `date_serv` , `ppspecial`),
	 KEY `idx_hospcode` (`hospcode`),
	  KEY `idx_pid` (`pid`),
	  KEY `idx_date_serv` (`date_serv`),
	  KEY `idx_ppspecial` (`ppspecial`)
)  ENGINE=myisam DEFAULT CHARSET=UTF8;

OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_specialpp ",db," */ 
     INSERT INTO report_specialpp
     SELECT 
		SQL_BIG_RESULT 
        '",db,"' AS hospcode ,
		person_id AS pid ,
		'' AS seq ,
		vstdate AS date_serv ,
		'' AS servplace ,
		pp_special_code AS ppspecial ,
		'' AS ppsplace ,
		'' AS provider ,
		'' AS d_update
		FROM dw_",db,".pp_special p1
		LEFT JOIN dw_",db,".pp_special_type p2 ON p1.pp_special_type_id = p2.pp_special_type_id
		INNER JOIN dw_",db,".vn_stat v ON p1.vn = v.vn
		INNER JOIN dw_",db,".person p ON p.patient_hn = v.hn
		WHERE vstdate BETWEEN @start_d AND @end_d
     
     ");
     
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_student` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_student` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_student`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');
	SET @begin_d=DATE_ADD(@start_d,INTERVAL -30 month);
	SET @begin_d1=concat(@b_year-5,'1001');
	SET @end_d1:=concat(@b_year,'1030');
    
    DROP TABLE IF EXISTS report_student;

	CREATE TABLE `report_student` (
	   `hospcode` varchar(5) DEFAULT NULL,
	   `cid` varchar(13) DEFAULT NULL,
       `pid` varchar(13) DEFAULT NULL,
	   `school_name` varchar(100) DEFAULT NULL,
	   `school_class` varchar(100) DEFAULT NULL,
	   `hn` varchar(13) DEFAULT NULL,
		KEY (hospcode),
		KEY (pid),
		KEY (cid)
	 ) ENGINE=MyISAM ;
    
    OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*report_student ",db," */
     INSERT INTO report_student
     
     SELECT 
		  '",db,"' AS hospcode
		  ,cid
		  ,p.person_id AS pid
		  ,vs.school_name AS school_name
		  ,vc.village_school_class_name AS school_class
		  ,p.patient_hn  AS hn
		FROM
		  dw_",db,".village_student a 
		  LEFT OUTER JOIN dw_",db,".person p ON p.person_id = a.person_id 
		  LEFT OUTER JOIN dw_",db,".village_school vs ON vs.village_school_id = a.village_school_id 
		  LEFT OUTER JOIN dw_",db,".village_school_class vc ON vc.village_school_class_id = a.village_school_class_id 
		WHERE a.discharge <> 'Y' OR a.discharge IS NULL

    ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_thaicvdrisk` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_thaicvdrisk` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_thaicvdrisk`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode in ('08264') order by hospcode asc;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
DROP TABLE IF EXISTS report_thaicvdrisk;
CREATE TABLE `report_thaicvdrisk` (
   `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `cid` varchar(13) DEFAULT NULL,
   `hn` varchar(9) DEFAULT NULL,
   `person_name` varchar(126) DEFAULT NULL,
   `typearea` int(1) DEFAULT NULL,
   `areacode` varchar(6) DEFAULT NULL,
   `lat` varchar(100) DEFAULT NULL,
   `lng` varchar(100) DEFAULT NULL,
   `address` varchar(417) DEFAULT NULL,
   `nationality` varchar(3) DEFAULT NULL,
   `vstdate` date DEFAULT NULL,
   `bps` longblob,
   `height` longblob,
   `waist` longblob,
   `tc` longblob,
   `age_y` bigint(21) DEFAULT NULL,
   `sex` int(1) NOT NULL DEFAULT '0',
   `smoking` int(1) NOT NULL DEFAULT '0',
   `dm` int(1) NOT NULL DEFAULT '0',
   `ht` int(1) NOT NULL DEFAULT '0',
   `dmht` int(1) NOT NULL DEFAULT '0',
   `cc` int(11) NOT NULL DEFAULT '0',
   `yymm` varbinary(6) DEFAULT NULL,
   `wh_2` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `age` int(2) NOT NULL DEFAULT '0',
   `chronic` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `smoke` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `has` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `cholesterol` int(3) NOT NULL DEFAULT '0',
   `bp` int(3) NOT NULL DEFAULT '0',
   KEY `idx_cid` (`cid`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*REGISTER-THAICVDRISK ",db," */
     INSERT INTO report_thaicvdrisk
         (
				SELECT *
				,IF(tc < 1,IF(waist > (height / 2) AND waist > 0 AND height > 0, 'M',IF(waist < (height / 2) AND waist > 0 AND height > 0, 'L',IF(waist > 0 AND height > 0, 'N',''))), 'N') AS wh_2
				,IF(age_y>=65,65,IF(age_y>=60,60,IF(age_y>=55,55,IF(age_y>=50,50,40)))) AS age
				,IF((dmht+dm) > 0,'Y','N') AS chronic
				,IF(smoking = 1,'Y','N') AS smoke
				,IF(tc > 0,'Y','N') AS has
				,IF(tc >= 320, 320, IF(tc >= 280, 280, IF(tc >= 240, 240, IF(tc >= 200, 200,IF(tc < 200 && tc > 0,160,0))))) AS cholesterol
				,IF(bps >= 180, 180, IF(bps >= 160, 160, IF(bps >= 140, 140,IF(bps < 140 && bps > 0,120,0)))) AS bp
				FROM
				(SELECT 
				'",db,"' as hospcode
				,p1.cid
				,c.hn
				,CONCAT(p2.pname,p2.fname,' ',p2.lname) as person_name
				,p2.house_regist_type_id as typearea
				,CONCAT(p1.chwpart,p1.amppart,p1.tmbpart) as areacode
				,h.latitude as lat
				,h.longitude as lng
				,concat(h.address,' หมู่ ',v.village_moo,' ',t.full_name) as address
				,p2.nationality
				,MAX(vstdate) as vstdate
				,SUBSTRING_INDEX(GROUP_CONCAT(IF(bps > 0 && bps is not null ,bps,0) order by vstdate desc),',',1) AS bps
				,SUBSTRING_INDEX(GROUP_CONCAT(IF(c.height > 0 && c.height is not null ,c.height,0) order by vstdate desc,vsttime desc),',',1) AS height
				,SUBSTRING_INDEX(GROUP_CONCAT(IF(c.waist > 0 && c.waist is not null ,c.waist,0) ORDER BY vstdate DESC),',',1) AS waist
				,SUBSTRING_INDEX(GROUP_CONCAT(IF(c.tc > 0 && c.tc is not null ,c.tc,0) ORDER BY vstdate DESC),',',1) AS tc
				,timestampdiff(year,birthday,vstdate) AS age_y
				,p1.sex
				,SUBSTRING_INDEX(GROUP_CONCAT(IF(smoking IN (2,3),1,IF(smoking IN (1,4),0,NULL)) ORDER BY vstdate DESC),',',1) AS smoking
				#,IF(smoking_type_id IN (2,3),1,IF(smoking IN (1,4),0,-1)) as smoking
                
				,IF(cm.clinic = '001' ,1,0) AS dm
				,IF(cm.clinic = '002' ,1,0) AS ht
				,IF(cm.clinic = '001,002' ,1,0) AS dmht
				/*
				,MAX(screen_date) AS screen_date
				,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(last_bps > 0 && last_bps IS NOT NULL ,last_bps,0) ORDER BY screen_date DESC),',',1) AS last_bps
				,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(body_height > 0 && body_height IS NOT NULL ,body_height,0) ORDER BY screen_date DESC),',',1) AS body_height
				,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(s.waist > 0 && s.waist IS NOT NULL ,s.waist,0) ORDER BY screen_date DESC),',',1) AS dmht_waist
				,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(present_smoking IS NOT NULL ,present_smoking,'N') ORDER BY screen_date DESC),',',1) AS present_smoking
				*/
				,count(distinct c.vn) as cc
				,concat(year(c.vstdate),LPAD(month(c.vstdate),2,'0')) as yymm
				#FROM dw_",db,".opdscreen c 
				FROM report_opdscreen_dmht_2559 c 
				LEFT JOIN dw_",db,".patient p1 ON c.hn = p1.hn 
				LEFT JOIN dw_",db,".person p2 ON p1.cid = p2.cid 
				LEFT OUTER JOIN dw_",db,".house h ON h.house_id = p2.house_id
				LEFT OUTER JOIN dw_",db,".village v ON v.village_id = h.village_id
				LEFT OUTER JOIN thaiaddress t ON t.addressid = v.address_id
				#LEFT JOIN person_chronic pc ON pc.person_id = p2.person_id and pc.clinic IN ('001','002')
				INNER JOIN (SELECT hn,group_concat(DISTINCT clinic ORDER BY clinic ASC) AS clinic FROM dw_",db,".clinicmember WHERE clinic IN (select sys_value from dw_",db,".sys_var where sys_name IN ('dm_clinic_code','ht_clinic_code')) GROUP BY hn) cm ON cm.hn = c.hn
				#LEFT JOIN person_dmht_screen_summary ss ON ss.person_id = p2.person_id   
				#LEFT JOIN person_dmht_risk_screen_head s ON ss.person_dmht_screen_summary_id = s.person_dmht_screen_summary_id and s.screen_date between '2015-10-01' and now()
				#LEFT JOIN person_dmht_nhso_screen hs ON ss.person_dmht_screen_summary_id = hs.person_dmht_screen_summary_id 
				WHERE c.vstdate BETWEEN '2014-10-01' AND now()
				AND c.hospcode = '",db,"'
				#AND c.vn IN (select distinct(vn) from ovstdiag where vstdate between '2015-10-01' and  '2016-03-31' and (icd10 between 'E10' and 'E1499' or icd10 between 'I10' and 'I1599'))
				AND bps > 0
				GROUP BY year(c.vstdate),month(c.vstdate),c.hn) as t
         )
			   
						
                    ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_thaicvdrisk_screen` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_thaicvdrisk_screen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_thaicvdrisk_screen`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode in ('08264') order by hospcode asc;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
DROP TABLE IF EXISTS report_thaicvdrisk_screen;
CREATE TABLE `report_thaicvdrisk_screen` (
   `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `cid` varchar(13) DEFAULT NULL,
   `pid` varchar(15) DEFAULT NULL,
   `person_name` varchar(126) DEFAULT NULL,
   `typearea` int(1) DEFAULT NULL,
   `areacode` varchar(6) DEFAULT NULL,
   `lat` varchar(100) DEFAULT NULL,
   `lng` varchar(100) DEFAULT NULL,
   `address` varchar(417) DEFAULT NULL,
   `nationality` varchar(3) DEFAULT NULL,
   `vstdate` date DEFAULT NULL,
   `bps` longblob,
   `height` longblob,
   `waist` longblob,
   `tc` longblob,
   `age_y` bigint(21) DEFAULT NULL,
   `sex` int(1) NOT NULL DEFAULT '0',
   `smoking` int(1) NOT NULL DEFAULT '0',
   `dm` int(1) NOT NULL DEFAULT '0',
   `ht` int(1) NOT NULL DEFAULT '0',
   `dmht` int(1) NOT NULL DEFAULT '0',
   `cc` int(11) NOT NULL DEFAULT '0',
   `yymm` varbinary(6) DEFAULT NULL,
   `wh_2` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `age` int(2) NOT NULL DEFAULT '0',
   `chronic` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `smoke` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `has` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
   `cholesterol` int(3) NOT NULL DEFAULT '0',
   `bp` int(3) NOT NULL DEFAULT '0',
   KEY `idx_cid` (`cid`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*REGISTER-THAICVDRISK-SCREEN ",db," */
     INSERT INTO report_thaicvdrisk_screen
         (
				SELECT *
				,IF(tc < 1,IF(waist > (height / 2) AND waist > 0 AND height > 0, 'M',IF(waist < (height / 2) AND waist > 0 AND height > 0, 'L',IF(waist > 0 AND height > 0, 'N',''))), 'N') AS wh_2
				,IF(age_y>=65,65,IF(age_y>=60,60,IF(age_y>=55,55,IF(age_y>=50,50,40)))) AS age
				,IF((dmht+dm) > 0,'Y','N') AS chronic
				,IF(smoking = 1,'Y','N') AS smoke
				,IF(tc > 0,'Y','N') AS has
				,IF(tc >= 320, 320, IF(tc >= 280, 280, IF(tc >= 240, 240, IF(tc >= 200, 200,IF(tc < 200 && tc > 0,160,0))))) AS cholesterol
				,IF(bps >= 180, 180, IF(bps >= 160, 160, IF(bps >= 140, 140,IF(bps < 140 && bps > 0,120,0)))) AS bp
				FROM
				(
				
				SELECT 
					'",db,"' as hospcode
					,p.cid
					,p.person_id as pid
					,CONCAT(p.pname,p.fname,' ',p.lname) as person_name
					,p.house_regist_type_id as typearea
					,CONCAT(pt.chwpart,pt.amppart,pt.tmbpart) as areacode
					,h.latitude as lat
					,h.longitude as lng
					,concat(h.address,' หมู่ ',v.village_moo,' ',t.full_name) as address
					,p.nationality
					,MAX(screen_date) AS vstdate
					,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(last_bps > 0 && last_bps IS NOT NULL ,last_bps,0) ORDER BY screen_date DESC),',',1) AS bps
					,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(body_height > 0 && body_height IS NOT NULL ,body_height,0) ORDER BY screen_date DESC),',',1) AS height
					,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(s.waist > 0 && s.waist IS NOT NULL ,s.waist,0) ORDER BY screen_date DESC),',',1) AS waist
					,0 as tc
					,timestampdiff(year,birthday,screen_date) AS age_y
					,IF(p.sex = 1 ,1,2) AS sex
					,IF(cm.clinic = '001' ,1,0) AS dm
					,IF(cm.clinic = '002' ,1,0) AS ht
					,IF(cm.clinic = '001,002' ,1,0) AS dmht
					,SUBSTRING_INDEX(GROUP_CONCAT(DISTINCT IF(present_smoking IS NOT NULL ,present_smoking,'N') ORDER BY screen_date DESC),',',1) AS smoking
					,count(distinct s.person_dmht_risk_screen_head_id)as cc
					,concat(year(screen_date),LPAD(month(screen_date),2,'0')) as yymm
					FROM dw_",db,".person p
					LEFT OUTER JOIN dw_",db,".patient pt ON pt.cid = p.cid 
					LEFT OUTER JOIN dw_",db,".clinicmember cm ON cm.hn = pt.hn and cm.clinic IN ('001','002')
					LEFT OUTER join dw_",db,".person_dmht_screen_summary ss ON ss.person_id = p.person_id   
					LEFT OUTER join dw_",db,".person_dmht_risk_screen_head s ON ss.person_dmht_screen_summary_id = s.person_dmht_screen_summary_id and s.screen_date between '2015-10-01' and now()
					LEFT OUTER JOIN dw_",db,".person_dmht_nhso_screen hs ON ss.person_dmht_screen_summary_id = hs.person_dmht_screen_summary_id 
					LEFT OUTER JOIN dw_",db,".house h ON h.house_id = p.house_id
					LEFT OUTER JOIN dw_",db,".village v ON v.village_id = h.village_id
					LEFT OUTER JOIN thaiaddress t ON t.addressid = v.address_id
					WHERE screen_date between '2015-10-01' and now()
					GROUP BY year(screen_date),month(screen_date),p.person_id
				
				) as t
         )
			   
						
                    ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `report_top10opd` */

/*!50003 DROP PROCEDURE IF EXISTS  `report_top10opd` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `report_top10opd`()
BEGIN
DROP TABLE IF EXISTS report_top10opd;
CREATE TABLE report_top10opd (SELECT SQL_BIG_RESULT
count(vn) as cc_times
,count(DISTINCT cid) as cc
,pdx
,year(vstdate) as yy
,LPAD(month(vstdate),2,'0') as mm
,now() as reg_date
,'00000' as hcode
from vn_stat_view
WHERE vstdate BETWEEN '2014-10-01' AND now()
and pdx <> '' 
group by pdx,year(vstdate),month(vstdate));
INSERT INTO report_top10opd
SELECT 
COUNT(vn) AS cc_times
,COUNT(DISTINCT cid) AS cc
,pdx
,YEAR(vstdate) AS yy
,LPAD(MONTH(vstdate),2,'0') AS mm
,NOW() AS reg_date
,hcode
FROM vn_stat_view
WHERE vstdate BETWEEN '2014-10-01' AND NOW()
AND pdx <> '' 
GROUP BY hcode,pdx,YEAR(vstdate),MONTH(vstdate);
END */$$
DELIMITER ;

/* Procedure structure for procedure `run_procedure` */

/*!50003 DROP PROCEDURE IF EXISTS  `run_procedure` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `run_procedure`()
BEGIN
CALL t_person;
call report_epi;
call report_person_anc;
CALL report_service_anc;
CALL report_chronic;
call report_chronicfu;
CALL report_chronic_opd_ipd;
CALL report_labdmht;
CALL t_person_anc;
CALL t_chronic;
CALL t_dmht;
call t_ckd_ill_all;
call t_ckd_screen;
call report_nutrition;

CALL ws_dm_control;
call ws_kpi_ckd_screen;

CALL t_childdev1830;
call ws_kpi_childev_prov;

call report_service;
call report_dulperson;
call report_top10opd;
call report_opvisit;
call report_r506;
call report_persondeath;
call report_ovstdiag;

call report_opdscreen_dmht_2559;
call report_thaicvdrisk;
CALL report_thaicvdrisk_screen;
END */$$
DELIMITER ;

/* Procedure structure for procedure `s_cervix_screen60` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_cervix_screen60` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `s_cervix_screen60`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= 'f50124b9cbc6636272844273980ca42e';
SET @cat_id := '1ed90bc32310b503b7ca9b32af425ae5';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');


CREATE TABLE IF NOT EXISTS s_cervix_screen60(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(7) DEFAULT 0,
r11 int(7) DEFAULT 0,
r12 int(7) DEFAULT 0,
r13 int(7) DEFAULT 0,
r21 int(7) DEFAULT 0,
r22 int(7) DEFAULT 0,
r23 int(7) DEFAULT 0,
r24 int(7) DEFAULT 0,
r31 int(7) DEFAULT 0,
r32 int(7) DEFAULT 0,
r33 int(7) DEFAULT 0,
r34 int(7) DEFAULT 0,
r41 int(7) DEFAULT 0,
r42 int(7) DEFAULT 0,
r43 int(7) DEFAULT 0,
r44 int(7) DEFAULT 0,
r51 int(7) DEFAULT 0,
r52 int(7) DEFAULT 0,
r53 int(7) DEFAULT 0,
r54 int(7) DEFAULT 0,
p11 int(7) DEFAULT 0,
p12 int(7) DEFAULT 0,
p13 int(7) DEFAULT 0,
p21 int(7) DEFAULT 0,
p22 int(7) DEFAULT 0,
p23 int(7) DEFAULT 0,
p24 int(7) DEFAULT 0,
p31 int(7) DEFAULT 0,
p32 int(7) DEFAULT 0,
p33 int(7) DEFAULT 0,
p34 int(7) DEFAULT 0,
p41 int(7) DEFAULT 0,
p42 int(7) DEFAULT 0,
p43 int(7) DEFAULT 0,
p44 int(7) DEFAULT 0,
p51 int(7) DEFAULT 0,
p52 int(7) DEFAULT 0,
p53 int(7) DEFAULT 0,
p54 int(7) DEFAULT 0,
v11 int(7) DEFAULT 0,
v12 int(7) DEFAULT 0,
v13 int(7) DEFAULT 0,
v21 int(7) DEFAULT 0,
v22 int(7) DEFAULT 0,
v23 int(7) DEFAULT 0,
v24 int(7) DEFAULT 0,
v31 int(7) DEFAULT 0,
v32 int(7) DEFAULT 0,
v33 int(7) DEFAULT 0,
v34 int(7) DEFAULT 0,
v41 int(7) DEFAULT 0,
v42 int(7) DEFAULT 0,
v43 int(7) DEFAULT 0,
v44 int(7) DEFAULT 0,
v51 int(7) DEFAULT 0,
v52 int(7) DEFAULT 0,
v53 int(7) DEFAULT 0,
v54 int(7) DEFAULT 0,

PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM s_cervix_screen60 WHERE id=@id AND b_year=(@b_year+543);

/*
PAP '1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124'
VIA '1B0040','1B0041','1B0042','1B0043','1B0045'
*/

SET @b_year_start:='2015';

INSERT IGNORE INTO s_cervix_screen60 
(
SELECT
@id,p.check_hosp,p.check_vhid,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(DISTINCT IF(TIMESTAMPDIFF(YEAR,p.birth, CONCAT(@b_year_start,'0101')) BETWEEN 30 AND 60 , p.CID , NULL)) target

,COUNT(DISTINCT IF(s.screen_status IN(11) , p.CID , NULL)) r11
,COUNT(DISTINCT IF(s.screen_status IN(12) , p.CID , NULL)) r12
,COUNT(DISTINCT IF(s.screen_status IN(13) , p.CID , NULL)) r13

,COUNT(DISTINCT IF(s.screen_status IN(21) , p.CID , NULL)) r21
,COUNT(DISTINCT IF(s.screen_status IN(22) , p.CID , NULL)) r22
,COUNT(DISTINCT IF(s.screen_status IN(23) , p.CID , NULL)) r23
,COUNT(DISTINCT IF(s.on_repleate IN(24) , p.CID , NULL)) r24

,COUNT(DISTINCT IF(s.screen_status IN(31) , p.CID , NULL)) r31
,COUNT(DISTINCT IF(s.screen_status IN(32) , p.CID , NULL)) r32
,COUNT(DISTINCT IF(s.screen_status IN(33) , p.CID , NULL)) r33
,COUNT(DISTINCT IF(s.on_repleate IN(34) , p.CID , NULL)) r34

,COUNT(DISTINCT IF(s.screen_status IN(41) , p.CID , NULL)) r41
,COUNT(DISTINCT IF(s.screen_status IN(42) , p.CID , NULL)) r42
,COUNT(DISTINCT IF(s.screen_status IN(43) , p.CID , NULL)) r43
,COUNT(DISTINCT IF(s.on_repleate IN(44) , p.CID , NULL)) r44

,COUNT(DISTINCT IF(s.screen_status IN(51) , p.CID , NULL)) r51
,COUNT(DISTINCT IF(s.screen_status IN(52) , p.CID , NULL)) r52
,COUNT(DISTINCT IF(s.screen_status IN(53) , p.CID , NULL)) r53
,COUNT(DISTINCT IF(s.on_repleate IN(54) , p.CID , NULL)) r54



,COUNT(DISTINCT IF(s.screen_status IN(11) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p11
,COUNT(DISTINCT IF(s.screen_status IN(12) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p12
,COUNT(DISTINCT IF(s.screen_status IN(13) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p13
,COUNT(DISTINCT IF(s.screen_status IN(21) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p21
,COUNT(DISTINCT IF(s.screen_status IN(22) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p22
,COUNT(DISTINCT IF(s.screen_status IN(23) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p23
,COUNT(DISTINCT IF(s.on_repleate IN(24) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p24

,COUNT(DISTINCT IF(s.screen_status IN(31) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p31
,COUNT(DISTINCT IF(s.screen_status IN(32) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p32
,COUNT(DISTINCT IF(s.screen_status IN(33) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p33
,COUNT(DISTINCT IF(s.on_repleate IN(34) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p34

,COUNT(DISTINCT IF(s.screen_status IN(41) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p41
,COUNT(DISTINCT IF(s.screen_status IN(42) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p42
,COUNT(DISTINCT IF(s.screen_status IN(43) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p43
,COUNT(DISTINCT IF(s.on_repleate IN(44) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p44

,COUNT(DISTINCT IF(s.screen_status IN(51) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p51
,COUNT(DISTINCT IF(s.screen_status IN(52) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p52
,COUNT(DISTINCT IF(s.screen_status IN(53) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p53
,COUNT(DISTINCT IF(s.on_repleate IN(54) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p54


,COUNT(DISTINCT IF(s.screen_status IN(11) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v11
,COUNT(DISTINCT IF(s.screen_status IN(12) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') ,p.CID , NULL)) v12
,COUNT(DISTINCT IF(s.screen_status IN(13) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v13
,COUNT(DISTINCT IF(s.screen_status IN(21) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v21
,COUNT(DISTINCT IF(s.screen_status IN(22) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v22
,COUNT(DISTINCT IF(s.screen_status IN(23) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v23
,COUNT(DISTINCT IF(s.on_repleate IN(24) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v24

,COUNT(DISTINCT IF(s.screen_status IN(31) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v31
,COUNT(DISTINCT IF(s.screen_status IN(32) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v32
,COUNT(DISTINCT IF(s.screen_status IN(33) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v33
,COUNT(DISTINCT IF(s.on_repleate IN(34) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v34

,COUNT(DISTINCT IF(s.screen_status IN(41) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v41
,COUNT(DISTINCT IF(s.screen_status IN(42) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v42
,COUNT(DISTINCT IF(s.screen_status IN(43) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v43
,COUNT(DISTINCT IF(s.on_repleate IN(44) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v44

,COUNT(DISTINCT IF(s.screen_status IN(51) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v51
,COUNT(DISTINCT IF(s.screen_status IN(52) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v52
,COUNT(DISTINCT IF(s.screen_status IN(53) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v53
,COUNT(DISTINCT IF(s.on_repleate IN(54) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v54

FROM t_person_cid p LEFT JOIN t_cervix_screen s ON p.CID=s.CID
WHERE	p.sex IN(2) AND p.DISCHARGE IN(9) AND p.nation IN(99)
AND p.check_typearea in(1,3)	AND substr(p.check_vhid,1,2)=@prov_c
GROUP BY	p.check_hosp,p.check_vhid
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `task_schedule_tranfer` */

/*!50003 DROP PROCEDURE IF EXISTS  `task_schedule_tranfer` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `task_schedule_tranfer`()
BEGIN
	UPDATE hospital_base_status
	SET hbs_sync = 1 
	WHERE (hbs_sync = 0 OR hbs_sync IS NULL)
	AND TIMESTAMPDIFF(HOUR,IFNULL(hbs_sync_start,TIMESTAMPADD(HOUR,-3,NOW())),NOW()) > 3 ;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `t_breast_screen` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_breast_screen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_breast_screen`()
BEGIN

	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @id:= '9';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');

	DROP TABLE IF EXISTS tmp_breast_screen;
	CREATE TABLE IF NOT EXISTS tmp_breast_screen(
	#PRIMARY KEY (HOSPCODE,PID,DATE_SERV,PPSPECIAL) 
	KEY (cid)
	,KEY (hospcode,pid)
	,KEY (date_serv)
	,KEY (ppspecial)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8 AS (
	SELECT 
	s.*,cid
	FROM report_specialpp s 
	LEFT JOIN t_person p ON p.hospcode = s.hospcode AND p.pid = s.pid
	WHERE s.DATE_SERV BETWEEN @start_d AND @end_d AND SUBSTR(s.ppspecial,1,5) IN('1B003')
	);

	DROP TABLE IF EXISTS tmp_breast_screen_doctor;
	CREATE TABLE IF NOT EXISTS tmp_breast_screen_doctor(
	#PRIMARY KEY (HOSPCODE,PID,DATE_SERV,DIAGCODE) 
	KEY (cid)
	,KEY (hospcode,pid)
	,KEY (date_serv)
	,KEY (DIAGCODE)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8 AS (
	SELECT hospcode,pid,'' AS seq,date_serv,diagcode,cid 
	FROM report_diag_opd 
	WHERE date_serv BETWEEN @start_d AND @end_d AND SUBSTR(DIAGCODE,1,4) IN('Z123')
	GROUP BY HOSPCODE,PID,DATE_SERV,DIAGCODE
	);

	DROP TABLE IF EXISTS t_breast_screen;
	CREATE TABLE IF NOT EXISTS t_breast_screen(
	CID VARCHAR(13) NOT NULL,
	self_screen VARCHAR(6) DEFAULT NULL,
	self_screen_date DATE DEFAULT NULL,
	self_screen_hospcode VARCHAR(5) DEFAULT NULL,
	self_screen_input VARCHAR(5) DEFAULT NULL,
	doctor_screen VARCHAR(7) DEFAULT NULL,
	doctor_screen_date DATE DEFAULT NULL,
	doctor_screen_hospcode VARCHAR(5) DEFAULT NULL,
	PRIMARY KEY (CID) 
	) ENGINE=MYISAM DEFAULT CHARSET=utf8 ;

	INSERT IGNORE INTO t_breast_screen (cid)
	(SELECT cid FROM tmp_breast_screen GROUP BY cid);

	INSERT IGNORE INTO t_breast_screen (cid)
	(SELECT cid FROM tmp_breast_screen_doctor GROUP BY cid);

	UPDATE IGNORE t_breast_screen t INNER JOIN (SELECT * FROM tmp_breast_screen ORDER BY DATE_SERV DESC) s ON  t.cid=s.cid
	SET t.self_screen=s.PPSPECIAL ,t.self_screen_date =s.date_serv , t.self_screen_hospcode=s.PPSPLACE,t.self_screen_input=s.hospcode
	WHERE s.PPSPECIAL IN('1B0030','1B0031','1B0034','1B0035')
	;

	UPDATE IGNORE t_breast_screen t INNER JOIN (SELECT * FROM tmp_breast_screen_doctor ORDER BY DATE_SERV DESC) s ON  t.cid=s.cid
	SET t.doctor_screen=s.diagcode ,t.doctor_screen_date =s.date_serv , t.doctor_screen_hospcode=s.hospcode;

	UPDATE IGNORE t_breast_screen t INNER JOIN (SELECT * FROM tmp_breast_screen ORDER BY DATE_SERV DESC) s ON  t.cid=s.cid
	SET t.doctor_screen=s.PPSPECIAL ,t.doctor_screen_date =s.date_serv , t.doctor_screen_hospcode=s.PPSPLACE;

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_cervix_screen` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_cervix_screen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_cervix_screen`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;


SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @year_start:=(SELECT `year` FROM ccervix_year WHERE  `year` <= @b_year LIMIT 1);
SET @start_d:=concat(@year_start,'1001');
SET @end_d:=concat(@b_year,'0930');


DROP TABLE IF EXISTS tmp_cervix_diag5;
CREATE TABLE `tmp_cervix_diag5` (
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(15) NOT NULL,
  `date_serv` date NOT NULL,
  `diagcode` varchar(6) NOT NULL,
  `cid` varchar(13) DEFAULT NULL,
  KEY `hospcode` (`hospcode`),
  KEY `cid` (`cid`),
  KEY `date_serv` (`date_serv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/*
 AS
(SELECT o.hospcode,o.pid,o.seq,o.date_serv,o.diagcode,p.cid
FROM report_diag_opd o  INNER JOIN person p ON o.hospcode=p.hospcode AND o.pid=p.pid
WHERE o.DATE_SERV  BETWEEN @start_d AND @end_d 
AND SUBSTR(o.DIAGCODE,1,4) IN('Z014','Z124')
GROUP BY o.HOSPCODE,o.PID,o.SEQ
);
*/
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*tmp_cervix_diag5 ",db," */
     INSERT INTO tmp_cervix_diag5
     (SELECT SQL_BIG_RESULT
	'",db,"' as hospcode
    ,person_id as pid
	,vstdate as date_serv	
    ,icd10 as diagcode
    ,p.cid
	FROM dw_",db,".ovstdiag o
    INNER JOIN dw_",db,".person p on p.patient_hn = o.hn
	WHERE vstdate BETWEEN @start_d AND @end_d
    AND SUBSTR(icd10,1,4) IN('Z014','Z124')
	AND left(icd10,1) between 'A' and 'Z');");
	
        PREPARE output FROM @output;
        EXECUTE output;
        
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;  





DROP TABLE IF EXISTS t_cervix_screen;
CREATE TABLE IF NOT EXISTS t_cervix_screen(
CID varchar(13) NOT NULL,
screen_code varchar(7) DEFAULT NULL,
screen_date date DEFAULT NULL,
screen_source varchar(30) DEFAULT NULL,
screen_hospcode varchar(5) DEFAULT NULL,
screen_input varchar(5) DEFAULT NULL,
screen_status  int(2) DEFAULT 0  COMMENT '11 = ปี Start : ทำตรงเป้าหมายกับปี Start 
,21 = ปี Start+1 : ทำตรงเป้าหมายกับปี Start 
,22 = ปี Start+1 : ไม่ตรงเป้าหมายกับปี Start แต่อายุในช่วง 
,23 = ปี Start+1 : ไม่ตรงเป้าหมายกับปี Start และอายุไม่อยู่ในช่วง 
,24 = ปี Start+1 : ตรงเป้าหมายกับปี Start แต่ทำซ้ำ  
,31 = ปี Start+2 : ทำตรงเป้าหมายกับปี Start 
,32 = ปี Start+2 : ไม่ตรงเป้าหมายกับปี Start แต่อายุในช่วง 
,33 = ปี Start+2 : ไม่ตรงเป้าหมายกับปี Start และอายุไม่อยู่ในช่วง 
,34 = ปี Start+2 : ตรงเป้าหมายกับปี Start แต่ทำซ้ำ  ...' ,
BIRTH DATE ,
AGE_ONSTART INT(3) DEFAULT 0 ,
on_repleate int(2) DEFAULT 0,
PRIMARY KEY (CID,screen_date) 
,KEY (cid)
,KEY (screen_date)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

INSERT IGNORE INTO t_cervix_screen (
SELECT s.cid,PPSPECIAL,DATE_SERV,'SPECIALPP',PPSPLACE,s.HOSPCODE,0 as screen_status,p.BIRTH,0 as AGE_ONSTART, 0 as on_repleate
FROM tmp_specialpp s INNER JOIN t_person_cid p ON s.cid=p.cid
WHERE s.DATE_SERV BETWEEN @start_d AND @end_d 
AND s.ppspecial IN('1B0040','1B0041 ','1B0042','1B0043 ','1B0044','1B0045','1B0048','1B0049','1B30','1B40')
AND LENGTH(s.cid)=13
AND p.age_y BETWEEN 15 AND 70
GROUP BY s.CID
);

INSERT IGNORE INTO t_cervix_screen (
SELECT s.cid,DIAGCODE,DATE_SERV,'DIAGNOSIS_OPD',s.HOSPCODE,s.HOSPCODE,0 as screen_status,p.BIRTH,0 as AGE_ONSTART, 0 as on_repleate
FROM tmp_cervix_diag5 s INNER JOIN t_person_cid p ON s.cid=p.cid
WHERE s.DATE_SERV BETWEEN @start_d AND @end_d  AND LENGTH(s.cid) = 13
AND p.age_y BETWEEN 15 AND 70
GROUP BY s.CID
);

SET @b_year_start:='2015';
/**********************************************************************************************************************/
UPDATE t_cervix_screen SET  AGE_ONSTART =TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001'));
/*ปีที่ 1 ทำตรงเป้าปีแรก*/
UPDATE  t_cervix_screen SET screen_status =11
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start-1,'1001') AND CONCAT(@b_year_start,'0930')
							AND screen_status IN(0);
/*ปี 1 ทำไม่ตรงเป้าหมายแต่อายุได้ */
UPDATE  t_cervix_screen SET screen_status =12
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) NOT BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start-1,'1001') AND CONCAT(@b_year_start,'0930')
							AND	TIMESTAMPDIFF(YEAR,birth,screen_date)  BETWEEN 30 AND 60
							AND screen_status IN(0);
/*ปี 1 ทำไม่ตรงเป้าหมายและอายุไม่ได้ */
UPDATE  t_cervix_screen SET screen_status =13
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) NOT BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start-1,'1001') AND CONCAT(@b_year_start,'0930')
							AND	TIMESTAMPDIFF(YEAR,birth,screen_date) NOT  BETWEEN 30 AND 60
							AND screen_status IN(0);

/**********************************************************************************************************************/
/*ปี 2 ทำซำ้กับปีก่อนหน้า */
UPDATE  t_cervix_screen s INNER JOIN 
(
SELECT * FROM t_cervix_screen WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001'))  BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start-1,'1001') AND CONCAT(@b_year_start,'0930')
GROUP BY cid
) l ON s.cid=l.cid
SET s.on_repleate =24
WHERE TIMESTAMPDIFF(YEAR,s.birth, CONCAT(@b_year_start-1,'1001'))  BETWEEN 30 AND 60 
							AND s.screen_date BETWEEN CONCAT(@b_year_start,'1001') AND CONCAT(@b_year_start+1,'0930');

/*ปี 2 ทำตรงเป้าปีแรก*/
UPDATE  t_cervix_screen SET screen_status =21
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start,'1001') AND CONCAT(@b_year_start+1,'0930')
							AND screen_status IN(0) AND on_repleate IN(0);
/*ปี 2 ทำไม่ตรงเป้าหมายแต่อายุได้ */
UPDATE  t_cervix_screen SET screen_status =22
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) NOT BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start,'1001') AND CONCAT(@b_year_start+1,'0930')
							AND	TIMESTAMPDIFF(YEAR,birth,screen_date)  BETWEEN 30 AND 60
							AND screen_status IN(0) ;
/*ปี 2 ทำไม่ตรงเป้าหมายและอายุไม่ได้ */
UPDATE  t_cervix_screen SET screen_status =23
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) NOT BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start,'1001') AND CONCAT(@b_year_start+1,'0930')
							AND	TIMESTAMPDIFF(YEAR,birth,screen_date) NOT  BETWEEN 30 AND 60
							AND screen_status IN(0) ;

/**********************************************************************************************************************/
/*ปี 3 ทำซำ้กับปีก่อนหน้า */
UPDATE  t_cervix_screen s INNER JOIN 
(
SELECT * FROM t_cervix_screen WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001'))  BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start-1,'1001') AND CONCAT(@b_year_start+1,'0930')
GROUP BY cid
) l ON s.cid=l.cid
SET s.on_repleate =34
WHERE TIMESTAMPDIFF(YEAR,s.birth, CONCAT(@b_year_start-1,'1001'))  BETWEEN 30 AND 60 
							AND s.screen_date BETWEEN CONCAT(@b_year_start+1,'1001') AND CONCAT(@b_year_start+2,'0930');

/*ปี 3 ทำตรงเป้าปีแรก*/
UPDATE  t_cervix_screen SET screen_status =31
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start+1,'1001') AND CONCAT(@b_year_start+2,'0930')
							AND screen_status IN(0) AND on_repleate IN(0);
/*ปี 3 ทำไม่ตรงเป้าหมายแต่อายุได้ */
UPDATE  t_cervix_screen SET screen_status =32
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) NOT BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start+1,'1001') AND CONCAT(@b_year_start+2,'0930')
							AND	TIMESTAMPDIFF(YEAR,birth,screen_date)  BETWEEN 30 AND 60
							AND screen_status IN(0);
/*ปี 3 ทำไม่ตรงเป้าหมายและอายุไม่ได้ */
UPDATE  t_cervix_screen SET screen_status =33
WHERE TIMESTAMPDIFF(YEAR,birth, CONCAT(@b_year_start-1,'1001')) NOT BETWEEN 30 AND 60 
							AND screen_date BETWEEN CONCAT(@b_year_start+1,'1001') AND CONCAT(@b_year_start+2,'0930')
							AND	TIMESTAMPDIFF(YEAR,birth,screen_date) NOT  BETWEEN 30 AND 60
							AND screen_status IN(0);


END */$$
DELIMITER ;

/* Procedure structure for procedure `t_childdev1830` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_childdev1830` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_childdev1830`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=CONCAT(@b_year-1,'1001');
SET @end_d:=CONCAT(@b_year,'0930');
SET @begin_d=DATE_ADD(@start_d,INTERVAL -30 MONTH);
SET @begin_d1=DATE_ADD(@start_d,INTERVAL -1 MONTH);
SET @end_d1:=CONCAT(@b_year,'1030');
DROP TABLE IF EXISTS t_childdev1830;
CREATE TABLE  IF NOT EXISTS t_childdev1830(INDEX (hospcode,pid,cid)) ENGINE=MYISAM  AS  
(SELECT
 p.HOSPCODE,p.PID,p.CID,p.BIRTH,p.check_vhid AREACODE,p.check_typearea TYPEAREA
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d) IN(18,30),1,0) M10
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 1 MONTH) IN(18,30),1,0) M11
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 2 MONTH) IN(18,30),1,0) M12
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 3 MONTH) IN(18,30),1,0) M01
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 4 MONTH) IN(18,30),1,0) M02
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 5 MONTH) IN(18,30),1,0) M03
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 6 MONTH) IN(18,30),1,0) M04
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 7 MONTH) IN(18,30),1,0) M05
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 8 MONTH) IN(18,30),1,0) M06
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 9 MONTH) IN(18,30),1,0) M07
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 10 MONTH) IN(18,30),1,0) M08
, IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 11 MONTH) IN(18,30),1,0) M09

,IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 1 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 2 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 3 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 4 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 5 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 6 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 7 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 8 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 9 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 10 MONTH) IN(18),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 11 MONTH) IN(18),1,
   0))))))))))))  AGE_18
,IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 1 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 2 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 3 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 4 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 5 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 6 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 7 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 8 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 9 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 10 MONTH) IN(30),1,
IF(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d+ INTERVAL 11 MONTH) IN(30),1,
   0))))))))))))  AGE_30
   

, STR_TO_DATE('0000000','%Y%m%d') DATE_SERV
,0 AGE_SERV
,0 PASS
, STR_TO_DATE('0000000','%Y%m%d') DATE_START
, STR_TO_DATE('0000000','%Y%m%d') DATE_END
FROM t_person_cid  p
WHERE BIRTH BETWEEN @begin_d AND @end_d AND
						check_typearea IN('1','3') AND p.DISCHARGE='9' AND LENGTH(TRIM(p.CID))=13 AND  
						(TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 1 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 2 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 3 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 4 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 5 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 6 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 7 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 8 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 9 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 10 MONTH) IN(18,30) OR 
							TIMESTAMPDIFF(MONTH,p.BIRTH,@start_d + INTERVAL 11 MONTH) IN(18,30) 
						)
);
UPDATE t_childdev1830 SET date_serv=NULL , date_start=NULL ,date_end=NULL  WHERE DATE_FORMAT(date_serv,'%Y%m%d')='00000000';
UPDATE t_childdev1830 SET date_start=DATE_ADD(BIRTH,INTERVAL 18 MONTH) ,date_end=DATE_ADD(DATE_ADD(BIRTH,INTERVAL 19 MONTH),INTERVAL -1 DAY)  WHERE age_18=1;
UPDATE t_childdev1830 SET date_start=DATE_ADD(BIRTH,INTERVAL 30 MONTH) ,date_end=DATE_ADD(DATE_ADD(BIRTH,INTERVAL 31 MONTH),INTERVAL -1 DAY)  WHERE age_30=1;


UPDATE t_childdev1830 c INNER JOIN (SELECT hospcode,pid,cid,date_serv FROM report_nutrition WHERE childdevelop in (1,2,3)) n ON n.cid=c.cid SET c.date_serv=n.DATE_SERV ,c.age_serv=TIMESTAMPDIFF(MONTH,c.BIRTH,n.DATE_SERV),c.pass=1 WHERE TIMESTAMPDIFF(MONTH,c.BIRTH,n.DATE_SERV) IN(18,30) ; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_chronic` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_chronic` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_chronic`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@start_d:=CONCAT(@b_year-1,'0701');
SET @end_d:=CONCAT(@b_year,'0930');
DROP TABLES IF EXISTS t_chronic;
CREATE TABLE IF NOT EXISTS t_chronic(
		cid VARCHAR(13) NOT NULL
		,birth DATE
		,age_y INT(3) DEFAULT 0
		,age_y_dx INT(3) DEFAULT 0
		,groupcode INT(3) DEFAULT 0
		,sex VARCHAR(1) DEFAULT NULL 
		,nation VARCHAR(3) DEFAULT NULL 
		,p_hospcode VARCHAR(5) DEFAULT NULL 
		,d_hospcode VARCHAR(5) DEFAULT NULL 
		,p_pt_vhid VARCHAR(8) DEFAULT NULL 
		,d_pt_vhid VARCHAR(8) DEFAULT NULL 
		,p_typearea VARCHAR(1) DEFAULT NULL 
		,d_typearea VARCHAR(1) DEFAULT NULL 
		,input_hosp VARCHAR(5) DEFAULT NULL 
		,input_pid VARCHAR(15) DEFAULT NULL 
		,source_tb VARCHAR(20) DEFAULT NULL 
		,diagcode VARCHAR(10) DEFAULT NULL 
		,date_dx DATE DEFAULT NULL 
		,hosp_dx VARCHAR(5) DEFAULT NULL 
		,hosp_rx VARCHAR(5) DEFAULT NULL 
		,typedisch VARCHAR(2) DEFAULT NULL 
		,datedisch DATE DEFAULT NULL 
		,minscl VARCHAR(5) DEFAULT NULL 
		,inscl VARCHAR(3) DEFAULT NULL 
		
	,KEY (cid)
	,KEY (diagcode)

) ENGINE=MYISAM DEFAULT CHARSET=utf8;
TRUNCATE TABLE t_chronic;

INSERT IGNORE INTO t_chronic
(
	cid,birth,age_y,age_y_dx,sex,nation,p_hospcode,d_hospcode,p_pt_vhid,d_pt_vhid
	,p_typearea,d_typearea,input_hosp,input_pid,source_tb,diagcode,date_dx
	,hosp_dx,hosp_rx,typedisch,datedisch,minscl,inscl
)
(
SELECT 
    p.CID,
    p.BIRTH,
    AGE(NOW(), p.BIRTH, 'y'),
    AGE(t.date_diag, p.BIRTH, 'y'),
    p.SEX,
    p.NATION,
    p.HOSPCODE,
    p.check_hosp,
    p.vhid,
    p.check_vhid,
    p.TYPEAREA,
    p.check_typearea,
    t.hosp_input,
    t.pid_input,
    t.pt_from,
    t.diagcode,
    t.date_diag,
    t.hosp_dx,
    t.hosp_rx,
    t.typedisch,
    t.datedisch,
    p.maininscl,
    p.inscl
FROM
    (SELECT 
        *
    FROM
        (SELECT 
        c.cid,
            c.hospcode AS hosp_input,
            c.pid AS pid_input,
            date_diag,
            c.chronic AS diagcode,
            c.hosp_dx,
            c.hosp_rx,
            c.typedisch,
            c.date_disch AS datedisch,
            'chronic' AS pt_from
    FROM
        report_chronic c
    GROUP BY c.cid , c.chronic UNION SELECT 
        c.cid,
            c.hospcode AS hosp_input,
            c.pid AS pid_input,
            date_diag,
            c.chronic AS diagcode,
            c.hosp_dx,
            c.hosp_rx,
            c.typedisch,
            c.date_disch AS datedisch,
            pt_from
    FROM
        report_chronic_opd_ipd c
    GROUP BY c.cid , c.chronic) t1
    WHERE
        cid IS NOT NULL AND LENGTH(cid) = 13
    GROUP BY cid , diagcode
    ORDER BY pt_from) t
        INNER JOIN
    t_person_cid p ON p.cid = t.cid
	WHERE p.discharge = 9
);

UPDATE t_chronic c,t_person_cid p SET c.typedisch='02'  
WHERE c.cid=p.cid AND p.DISCHARGE=1;


INSERT INTO t_chronic 
SELECT * FROM t_chronic_hdc WHERE cid NOT IN (SELECT t2.cid FROM t_chronic t2);

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_ckd_ill_all` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_ckd_ill_all` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_ckd_ill_all`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=CONCAT(@b_year-1,'1001');
SET @end_d:=CONCAT(@b_year,'0930');

CREATE TABLE IF NOT EXISTS t_ckd_ill_all (
  cid varchar(13) NOT NULL,
  group_diag text,
  group_date text,
  group_hos_dx text,
  min_date_dx date DEFAULT NULL,
  hospcode varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (cid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO  t_ckd_ill_all (
			SELECT cid 
						,GROUP_CONCAT(trim(diagcode) ORDER BY SUBSTR(diagcode,1,1),date_dx) group_diag
						,GROUP_CONCAT(date_dx ORDER BY SUBSTR(diagcode,1,1),date_dx) group_date
							,GROUP_CONCAT(IF(LENGTH(trim(hosp_dx))=0 OR ISNULL(hosp_dx),input_hosp,hosp_dx) ORDER BY SUBSTR(diagcode,1,1),date_dx)
						,min(date_dx) min_date_dx, space(5) hospcode
  FROM t_chronic 
   WHERE UPPER(diagcode) in('E102', 'E112', 'E122', 'E132', 'E142','I151') 
					OR UPPER(substr(diagcode,1,3)) in('I12','I13','N18')  
	GROUP BY cid
	ORDER BY date_dx  );

UPDATE t_ckd_ill_all  c,t_person_cid p SET c.hospcode=p.check_hosp WHERE c.cid=p.cid;

DROP TABLE IF  EXISTS t_ckd_screen;
CREATE TABLE IF NOT EXISTS t_ckd_screen (
lab12_date date default null,
lab12_hosp VARCHAR(5) DEFAULT NULL,
lab12_result VARCHAR(10) DEFAULT NULL,

lab14_date date default null,
lab14_hosp VARCHAR(5) DEFAULT NULL,
lab14_result VARCHAR(10) DEFAULT NULL,
lab11_date date default null,
lab11_hosp VARCHAR(5) DEFAULT NULL,
lab11_result VARCHAR(10) DEFAULT NULL,
lab15_date date default null,
lab15_hosp VARCHAR(5) DEFAULT NULL,
lab15_result VARCHAR(10) DEFAULT NULL,
lab15_ok_result VARCHAR(10) DEFAULT NULL,
minlab_date date default null,
PRIMARY KEY(cid) ) ENGINE MyIsam as(
SELECT
t.hospcode,t.pid,t.cid,t.vhid,t.typearea,t.birth,t.age_y,t.sex,t.nation,t.mix_dx,t.date_dx,t.hosp_dx
,null as lab12_date 
,null as lab12_hosp
,null as  lab12_result
,null as lab14_date
,null as lab14_hosp
,null as lab14_result
,null as lab11_date
,null as lab11_hosp
,null as lab11_result
,null as lab15_date
,null as lab15_hosp
,null as lab15_result
,null as lab15_ok_result
,null as minlab_date
FROM
t_dmht  t 
	LEFT JOIN (SELECT cid FROM t_ckd_ill_all WHERE min_date_dx < @start_d ) c ON t.cid=c.cid 
WHERE
t.nation in(99) AND t.typearea in(1,3)
AND (c.cid is null ));

UPDATE t_ckd_screen s ,tmp_labfu l SET s.lab12_date=l.DATE_SERV,s.lab12_hosp=l.HOSPCODE ,s.lab12_result=l.LABRESULT
WHERE s.cid=l.cid AND l.LABTEST=12 AND l.DATE_SERV  BETWEEN @start_d AND @end_d;

UPDATE t_ckd_screen s ,tmp_labfu l SET s.lab14_date=l.DATE_SERV,s.lab14_hosp=l.HOSPCODE ,s.lab14_result=l.LABRESULT
WHERE s.cid=l.cid AND l.LABTEST=14 AND l.DATE_SERV  BETWEEN @start_d AND @end_d;

UPDATE t_ckd_screen s ,tmp_labfu l SET s.lab11_date=l.DATE_SERV,s.lab11_hosp=l.HOSPCODE ,s.lab11_result=l.LABRESULT
WHERE s.cid=l.cid AND l.LABTEST=11 AND l.DATE_SERV  BETWEEN @start_d AND @end_d;

UPDATE t_ckd_screen s ,tmp_labfu l SET s.lab15_date=l.DATE_SERV,s.lab15_hosp=l.HOSPCODE ,s.lab15_result=l.LABRESULT
WHERE s.cid=l.cid AND l.LABTEST=15 AND l.DATE_SERV  BETWEEN @start_d AND @end_d;

UPDATE t_ckd_screen SET lab15_ok_result =lab15_result;

UPDATE t_ckd_screen SET lab15_ok_result =egfr_fnc(lab11_result,age_y,sex)
WHERE lab11_result IS NOT NULL AND lab11_result>0 ;

UPDATE t_ckd_screen SET minlab_date =IF(lab12_date is NULL OR lab14_date is NULL 
			,COALESCE(lab12_date,lab14_date),LEAST(lab12_date,lab14_date));

UPDATE t_ckd_screen SET minlab_date =IF(lab15_date is NULL OR minlab_date is NULL 
			,COALESCE(lab15_date,minlab_date),LEAST(lab15_date,minlab_date));

UPDATE t_ckd_screen SET minlab_date =IF(lab11_date is NULL OR minlab_date is NULL 
			,COALESCE(lab11_date,minlab_date),LEAST(lab11_date,minlab_date));

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_ckd_screen` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_ckd_screen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_ckd_screen`()
BEGIN
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '9';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
    
	DROP TABLE IF EXISTS t_ckd_screen;
	CREATE TABLE IF NOT EXISTS t_ckd_screen (
	lab12_date date default null,
	lab12_hosp VARCHAR(5) DEFAULT NULL,
	lab12_result VARCHAR(10) DEFAULT NULL,

	lab14_date date default null,
	lab14_hosp VARCHAR(5) DEFAULT NULL,
	lab14_result VARCHAR(10) DEFAULT NULL,
	lab11_date date default null,
	lab11_hosp VARCHAR(5) DEFAULT NULL,
	lab11_result VARCHAR(10) DEFAULT NULL,
	lab15_date date default null,
	lab15_hosp VARCHAR(5) DEFAULT NULL,
	lab15_result VARCHAR(10) DEFAULT NULL,
	lab15_ok_result VARCHAR(10) DEFAULT NULL,
	minlab_date date default null,
	PRIMARY KEY(cid) ) ENGINE MyIsam as(
	SELECT
	t.hospcode,t.pid,t.cid,t.vhid,t.typearea,t.birth,t.age_y,t.sex,t.nation,t.mix_dx,t.date_dx,t.hosp_dx
	,null as lab12_date 
	,null as lab12_hosp
	,null as lab12_result
	,null as lab14_date
	,null as lab14_hosp
	,null as lab14_result
	,null as lab11_date
	,null as lab11_hosp
	,null as lab11_result
	,null as lab15_date
	,null as lab15_hosp
	,null as lab15_result
	,null as lab15_ok_result
	,null as minlab_date
	FROM
	t_dmht t 
	LEFT JOIN (SELECT cid FROM t_ckd_ill_all WHERE min_date_dx < @start_d ) c ON t.cid=c.cid 
	WHERE
	t.nation in('99') AND t.typearea in(1,3)
	AND (c.cid is null ));
    
    UPDATE t_ckd_screen s ,report_labdmht l SET s.lab12_date=l.DATE_SERV,s.lab12_hosp=l.HOSPCODE ,s.lab12_result=l.LABRESULT
	WHERE s.cid=l.cid AND l.LABTEST=12 AND l.DATE_SERV BETWEEN @start_d AND @end_d;

	UPDATE t_ckd_screen s ,report_labdmht l SET s.lab14_date=l.DATE_SERV,s.lab14_hosp=l.HOSPCODE ,s.lab14_result=l.LABRESULT
	WHERE s.cid=l.cid AND l.LABTEST=14 AND l.DATE_SERV BETWEEN @start_d AND @end_d;

	UPDATE t_ckd_screen s ,report_labdmht l SET s.lab11_date=l.DATE_SERV,s.lab11_hosp=l.HOSPCODE ,s.lab11_result=l.LABRESULT
	WHERE s.cid=l.cid AND l.LABTEST=11 AND l.DATE_SERV BETWEEN @start_d AND @end_d;

	UPDATE t_ckd_screen s ,report_labdmht l SET s.lab15_date=l.DATE_SERV,s.lab15_hosp=l.HOSPCODE ,s.lab15_result=l.LABRESULT
	WHERE s.cid=l.cid AND l.LABTEST=15 AND l.DATE_SERV BETWEEN @start_d AND @end_d;

	UPDATE t_ckd_screen SET lab15_ok_result =lab15_result;

	UPDATE t_ckd_screen SET lab15_ok_result =egfr_fnc(lab11_result,age_y,sex)
	WHERE lab11_result IS NOT NULL AND lab11_result>0 ;

	UPDATE t_ckd_screen SET minlab_date =IF(lab12_date is NULL OR lab14_date is NULL 
	,COALESCE(lab12_date,lab14_date),LEAST(lab12_date,lab14_date));

	UPDATE t_ckd_screen SET minlab_date =IF(lab15_date is NULL OR minlab_date is NULL 
	,COALESCE(lab15_date,minlab_date),LEAST(lab15_date,minlab_date));

	UPDATE t_ckd_screen SET minlab_date =IF(lab11_date is NULL OR minlab_date is NULL 
	,COALESCE(lab11_date,minlab_date),LEAST(lab11_date,minlab_date));

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_cvd_screen` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_cvd_screen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_cvd_screen`()
BEGIN
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d_tc:=CONCAT(@b_year-2,'1001');
	SET @end_d_tc:=CONCAT(@b_year,'0930');

DROP TABLES IF EXISTS t_cvd_screen;
CREATE TABLE IF NOT EXISTS t_cvd_screen (
		id INT(15) NOT NULL AUTO_INCREMENT
		,hospcode VARCHAR(5) DEFAULT NULL 
		,pid VARCHAR(15)  DEFAULT NULL 
		,vhid VARCHAR(8) DEFAULT NULL 
		,typearea VARCHAR(1) DEFAULT NULL 
		,cid VARCHAR(13) NOT NULL
		,birth DATE
		,age_y INT(3) DEFAULT 0
		,sex VARCHAR(1) DEFAULT NULL 
		,nation VARCHAR(3) DEFAULT NULL 
		,source_tb VARCHAR(255) DEFAULT NULL 
		,mix_dx VARCHAR(255) DEFAULT NULL 	
		,t_mix_dx VARCHAR(255) DEFAULT NULL 	
		,type_dx VARCHAR(2) DEFAULT NULL 
		,ld_tc DATE  DEFAULT NULL 
		,rs_tc VARCHAR(10) DEFAULT NULL
		,ih_tc  VARCHAR(5) DEFAULT NULL
		,ld_bp1 DATE DEFAULT NULL 
		,ih_bp1 VARCHAR(5) DEFAULT NULL 
		,rs_bps1 VARCHAR(10) DEFAULT NULL 
		,rs_bpd1 VARCHAR(10) DEFAULT NULL 
		,ld_bp2 DATE DEFAULT NULL 
		,ih_bp2 VARCHAR(5) DEFAULT NULL 
		,rs_bps2 VARCHAR(10) DEFAULT NULL 
		,rs_bpd2 VARCHAR(10) DEFAULT NULL 
		,`height` SMALLINT(6) DEFAULT '0'
		,`weight` MEDIUMINT(9) DEFAULT '0'
		,`waist_cm` SMALLINT(6) NULL DEFAULT 0 
        ,`smoking` INT(1) NULL DEFAULT 0
        ,`cvdrisk_color` INT(1) NULL DEFAULT 0
        ,complication VARCHAR(1) DEFAULT NULL,
	PRIMARY KEY (id)
	,KEY (cid)
	,KEY (type_dx)

) ENGINE=MYISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO t_cvd_screen(
	hospcode,vhid,typearea,cid,birth,age_y,sex,nation,source_tb,mix_dx,t_mix_dx,type_dx
    ,ld_bp1,ih_bp1,rs_bps1,rs_bpd1,ld_bp2,ih_bp2,rs_bps2,rs_bpd2
    ,height,weight,waist_cm  
)(
SELECT hospcode,vhid,typearea,cid,birth,age_y,sex,nation,source_tb,mix_dx,t_mix_dx,type_dx
    ,ld_bp1,ih_bp1,rs_bps1,rs_bpd1,ld_bp2,ih_bp2,rs_bps2,rs_bpd2
    ,height,weight,waist_cm  
FROM t_dmht
);

/*up_tc*/
UPDATE t_cvd_screen d ,(SELECT * FROM (SELECT HOSPCODE,cid,DATE_SERV,LABRESULT FROM report_labdmht WHERE labtest='07' ORDER BY date_serv DESC) t1 GROUP BY cid) l
	SET ld_tc =l.date_serv,rs_tc =l.labresult ,ih_tc=l.HOSPCODE
WHERE d.cid=l.cid ;  

/*smoking*/ 
UPDATE t_cvd_screen d,
    (SELECT 
        c.cid, c.DATE_SERV, c.smoking, c.HOSPCODE
    FROM
        report_chronicfu c
    WHERE
        c.smoking = 1
            AND c.DATE_SERV = (SELECT 
                c1.DATE_SERV
            FROM
                report_chronicfu c1
            WHERE
                c1.cid = c.cid AND c.smoking = 1
            GROUP BY c1.cid , c1.DATE_SERV
            ORDER BY c1.date_serv DESC
            LIMIT 0 , 1)
    GROUP BY cid) AS t 
SET 
    d.smoking = t.smoking
WHERE
    d.cid = t.cid;  

/*screen thaicvdrisk  มีผล Lab*/     
UPDATE t_cvd_screen d,
    (SELECT 
	c.color,s.cid
		FROM 
		t_cvd_screen s 
		LEFT JOIN colorchart_th c on 
        IF(s.age_y>=65,65,IF(s.age_y>=60,60,IF(s.age_y>=55,55,IF(s.age_y>=50,50,40)))) = age
		 AND IF(s.type_dx IN ('02','03'),'Y','N') = chronic
		 AND IF(s.smoking = 1,'Y','N') = smoke
		 AND 'Y' = has
		 AND IF(ifnull(s.rs_tc,0) >= 320, 320, IF(ifnull(s.rs_tc,0) >= 280, 280, IF(ifnull(s.rs_tc,0) >= 240, 240, IF(ifnull(s.rs_tc,0) >= 200, 200,IF(ifnull(s.rs_tc,0) < 200 && ifnull(s.rs_tc,0) > 0,160,0))))) = cholesterol
		 AND IF(ifnull(s.rs_bps1,0) >= 180, 180, IF(ifnull(s.rs_bps1,0) >= 160, 160, IF(ifnull(s.rs_bps1,0) >= 140, 140,IF(ifnull(s.rs_bps1,0) < 140 &&ifnull(s.rs_bps1,0) > 0,120,0)))) = bp
		 AND s.sex = c.sex
         WHERE ifnull(s.rs_tc,0) > 0 AND s.ld_tc BETWEEN @start_d_tc AND @end_d_tc
		 ) AS t 
		SET d.cvdrisk_color = t.color
		WHERE
			d.cid = t.cid;   
            
 /*screen thaicvdrisk ไม่มีผล Lab*/     
UPDATE t_cvd_screen d,
    (SELECT 
	c.color,s.cid
		FROM 
		t_cvd_screen s 
		LEFT JOIN colorchart_th c on 
        IF(ifnull(s.waist_cm,0) > (ifnull(s.height,0) / 2) AND ifnull(s.waist_cm,0) > 0 AND ifnull(s.height,0) > 0, 'M',IF(ifnull(s.waist_cm,0) < (ifnull(s.height,0) / 2) AND ifnull(s.waist_cm,0) > 0 AND ifnull(s.height,0) > 0, 'L',IF(ifnull(s.waist_cm,0) > 0 AND ifnull(s.height,0) > 0, 'N',''))) = wh_2
		 AND IF(s.age_y>=65,65,IF(s.age_y>=60,60,IF(s.age_y>=55,55,IF(s.age_y>=50,50,40)))) = age
		 AND IF(s.type_dx IN ('02','03'),'Y','N') = chronic
		 AND IF(s.smoking = 1,'Y','N') = smoke
		 AND 'N' = has
		 AND IF(ifnull(s.rs_bps1,0) >= 180, 180, IF(ifnull(s.rs_bps1,0) >= 160, 160, IF(ifnull(s.rs_bps1,0) >= 140, 140,IF(ifnull(s.rs_bps1,0) < 140 &&ifnull(s.rs_bps1,0) > 0,120,0)))) = bp
		 AND s.sex = c.sex
         WHERE (ifnull(s.rs_tc,0) = 0 OR s.rs_tc IS NULL OR s.ld_tc NOT BETWEEN @start_d_tc AND @end_d_tc)
		 ) AS t 
		SET d.cvdrisk_color = t.color
		WHERE
			d.cid = t.cid ;              
    
 
/*หัวใจและหลอดเลือด*/
UPDATE t_cvd_screen t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE ((diagcode BETWEEN 'I600' AND 'I698') OR (diagcode BETWEEN 'I200' AND 'I259') OR (diagcode LIKE 'I500') OR (diagcode LIKE 'I517'))
)  d SET complication='1' WHERE t.cid=d.cid AND d.cid is not null ;

/*โรคความดันที่เป็นไตและหัวใจ*/
UPDATE t_cvd_screen t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE ((diagcode BETWEEN 'I130' AND 'I132') OR (diagcode BETWEEN 'I110' AND 'I119') OR (diagcode LIKE 'I139'))
)  d SET complication='2' WHERE t.cid=d.cid AND d.cid is not null ;

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_diag_opd_ipd` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_diag_opd_ipd` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_diag_opd_ipd`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow ;#WHERE hospcode=hospcode_cup;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

/* ข้อมูลใช้ในสาขาไต*/
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '9';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @prov_c := '72';
	SET	@start_d:=concat(@b_year-1,'0701');
	SET @end_d:=concat(@b_year,'0930');
    
    
    DROP TABLE IF EXISTS t_diag_opd_ipd;

CREATE TABLE `t_diag_opd_ipd` (
   `hospcode` varchar(5) DEFAULT NULL,
   `pid` VARCHAR(13) DEFAULT NULL,
   `cid` varchar(13) DEFAULT NULL,
   `date_serv` date DEFAULT NULL,
   `diagtype` varchar(2) DEFAULT NULL,
   `diagcode` varchar(20) DEFAULT NULL,
   `vn` varchar(20) DEFAULT NULL,
   `hn` varchar(20) DEFAULT NULL,
   `proced` varchar(1) DEFAULT NULL,
   
	KEY (hospcode),
	KEY (pid),
	KEY (cid),
	KEY (date_serv),
	KEY (proced),
	KEY (diagcode)
 ) ENGINE=MyISAM ;
 
 
  
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*t_diag_opd_ipd ",db," */
     INSERT INTO t_diag_opd_ipd
     SELECT * FROM
     (SELECT 
    '",db,"' AS hospcode,
    '' AS pid,
    p.cid,
    vstdate AS date_serv,
    diagtype,
    icd10 AS diagcode,
    o2.vn,
    o2.hn,
    IF(LEFT(icd10, 1) BETWEEN 'A' AND 'Z',
        0,
        1) AS proced
FROM
    dw_",db,".ovstdiag o2
		INNER JOIN dw_",db,".patient p ON p.hn = o2.hn
WHERE
    vstdate BETWEEN @start_d AND @end_d
        AND (LEFT(icd10, 4) BETWEEN 'I210' AND 'I213'
        OR LEFT(icd10, 4) BETWEEN 'S060' AND 'S069'
        OR LEFT(icd10, 4) = '9910'
        OR LEFT(icd10, 4) = '3768')
        
  UNION
  
	SELECT 
    '",db,"' AS hospcode,
    '' AS pid,
    p.cid,
    o1.regdate AS date_serv,
    diagtype,
    icd10 AS diagcode,
    o1.an,
    o1.hn,
    IF(LEFT(icd10, 1) BETWEEN 'A' AND 'Z',
        0,
        1) AS proced
FROM
    dw_",db,".iptdiag o2
	INNER JOIN dw_",db,".ipt o1 ON o1.an = o2.an  
	INNER JOIN dw_",db,".patient p ON p.hn = o2.hn
WHERE
    o1.regdate BETWEEN @start_d AND @end_d
        AND (LEFT(icd10, 4) BETWEEN 'I210' AND 'I213'
        OR LEFT(icd10, 4) BETWEEN 'S060' AND 'S069'
        OR LEFT(icd10, 4) = '9910'
        OR LEFT(icd10, 4) = '3768')
) t 
     ");
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_dmht` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_dmht` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_dmht`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@start_d:=concat(@b_year-2,'1001');
SET	@start_d1:=concat(@b_year-1,'0701');
SET	@start_d2:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');
DROP TABLES IF EXISTS tmp_labfu;
CREATE TABLE IF NOT EXISTS tmp_labfu( 
  `HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `SEQ` varchar(16) NOT NULL,
  `DATE_SERV` date NOT NULL,
  `LABTEST` varchar(7) NOT NULL DEFAULT '',
  `LABRESULT` double(6,2) NOT NULL,
  `D_UPDATE` datetime NOT NULL,
  `CID` varchar(13) DEFAULT NULL,
  `LABTEST_SEND` varchar(7) DEFAULT NULL,
  `LABTEST_NEW` varchar(7) DEFAULT NULL,
KEY (hospcode),KEY (pid),KEY (seq),KEY (cid),
KEY (date_serv),KEY (labtest),KEY (labresult),
KEY (LABTEST_SEND), KEY (LABTEST_NEW)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO tmp_labfu (HOSPCODE,PID,SEQ,DATE_SERV,LABTEST_SEND,LABRESULT,D_UPDATE,CID)
(SELECT SQL_BIG_RESULT 
				l.HOSPCODE,l.PID,null as SEQ,l.DATE_SERV,l.LABTEST,l.LABRESULT,NULL AS D_UPDATE,CID
FROM
	report_labfu l
WHERE	DATE_SERV BETWEEN @start_d AND @end_d
);

UPDATE tmp_labfu l SET l.LABTEST=l.LABTEST_SEND WHERE LENGTH(TRIM(l.LABTEST_SEND)) = 2;

UPDATE tmp_labfu l INNER JOIN clabtest_new c ON l.LABTEST=c.old_code 
SET l.LABTEST_NEW=c.`code`
WHERE LENGTH(TRIM(l.LABTEST)) =2;

UPDATE tmp_labfu l INNER JOIN clabtest_new c ON l.LABTEST_SEND=c.`code` 
SET l.LABTEST=c.old_code , l.LABTEST_NEW=c.`code`
WHERE LENGTH(TRIM(l.LABTEST_SEND)) > 2;

DROP TABLES IF EXISTS tmp_chronicfu;
CREATE TABLE IF NOT EXISTS tmp_chronicfu (
KEY (hospcode),
KEY (pid),
KEY (seq),
KEY (cid),
KEY (date_serv),
KEY (sbp),
KEY (dbp),
KEY (foot),
KEY (retina)
)ENGINE=MyISAM  AS(
SELECT SQL_BIG_RESULT 
		c.*
FROM
	report_chronicfu c 
WHERE DATE_SERV BETWEEN @start_d AND @end_d
);

DROP TABLE IF EXISTS t_chronicfu;
CREATE  TABLE IF NOT EXISTS t_chronicfu(
hospcode VARCHAR(5) NOT NULL,
pid VARCHAR(15) NOT NULL,
cid VARCHAR(13) NOT NULL,
ld_bp1 date DEFAULT NULL,
ld_bp2 date DEFAULT NULL,
sbp_1 VARCHAR(10) DEFAULT NULL,
dbp_1 VARCHAR(10) DEFAULT NULL,
sbp_2 VARCHAR(10) DEFAULT NULL,
dbp_2 VARCHAR(10) DEFAULT NULL,
ld_hba1c date DEFAULT NULL,
hba1c  VARCHAR(10) DEFAULT NULL,
ld_foot date DEFAULT NULL ,
foot VARCHAR(10)  DEFAULT NULL,
ld_retina date DEFAULT NULL, 
retina VARCHAR(10)  DEFAULT NULL ,
control_dm int(1) DEFAULT '0',
control_ht int(1) DEFAULT '0',
PRIMARY KEY (cid,hospcode),
KEY (cid),
KEY (hospcode)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AS
(
SELECT hospcode,pid,cid,null as sbp_1 ,null as dbp_1,null as sbp_2,null as dbp_2,null as hba1c
,null as ld_foot,null as foot,null as ld_retina,null as retina,0 as control_dm ,0 as control_ht
FROM tmp_chronicfu 
WHERE LENGTH(cid)=13  AND DATE_SERV BETWEEN @start_d2 AND @end_d
GROUP BY HOSPCODE,cid
);
UPDATE t_chronicfu f INNER JOIN (
	SELECT hospcode , pid ,max(date_serv) date_serv 
	FROM tmp_labfu WHERE labtest in(5) 
	GROUP BY hospcode,PID
) l ON f.hospcode=l.hospcode AND f.pid=l.pid
SET f.ld_hba1c=l.date_serv;
UPDATE t_chronicfu f INNER JOIN tmp_labfu l ON f.hospcode=l.hospcode AND f.pid=l.pid AND f.ld_hba1c=l.DATE_SERV 
SET f.hba1c=l.LABRESULT
WHERE l.LABTEST in(5);
UPDATE t_chronicfu SET control_dm='1' WHERE  (hba1c BETWEEN 0.1  AND 6.99)	AND ld_hba1c BETWEEN @start_d2 AND @end_d	;
UPDATE t_chronicfu d ,	
								(SELECT c.HOSPCODE, c.PID ,c.DATE_SERV,c.SBP,c.DBP
								FROM tmp_chronicfu c
								WHERE c.DATE_SERV =
								(SELECT c1.DATE_SERV FROM tmp_chronicfu c1 WHERE c1.HOSPCODE=c.HOSPCODE  AND c1.pid=c.pid 
									and c1.SBP >0 AND c1.DBP>0  GROUP BY c1.HOSPCODE,c1.PID,c1.DATE_SERV 
									ORDER BY c1.date_serv desc LIMIT 0,1)
								GROUP BY hospcode,PID) as t
		SET ld_bp1 =t.DATE_SERV,sbp_1 =t.SBP,dbp_1 =t.DBP
WHERE		d.HOSPCODE=t.HOSPCODE  AND d.pid=t.pid  ;
/*last_bp2*/
UPDATE t_chronicfu d ,	
								(SELECT c.HOSPCODE, c.PID ,c.DATE_SERV,c.SBP,c.DBP
								FROM tmp_chronicfu c
								WHERE c.DATE_SERV =
								(SELECT c1.DATE_SERV FROM tmp_chronicfu c1 WHERE c1.HOSPCODE=c.HOSPCODE  AND c1.pid=c.pid 
									and c1.SBP >0 AND c1.DBP>0  GROUP BY c1.HOSPCODE,c1.PID,c1.DATE_SERV 
									ORDER BY c1.date_serv desc LIMIT 1,1)
								GROUP BY hospcode,PID) as t
		SET ld_bp2 =t.DATE_SERV,sbp_2 =t.SBP,dbp_2 =t.DBP
WHERE		d.HOSPCODE=t.HOSPCODE  AND d.pid=t.pid  ;
UPDATE t_chronicfu SET control_ht ='1'	 WHERE 		
 (sbp_1  BETWEEN 50 AND 139) AND (sbp_2  BETWEEN 50 AND 139 )
AND (dbp_1 BETWEEN 50 AND 89) AND (dbp_1 BETWEEN 50 AND 89) AND ld_bp1 BETWEEN @start_d2 AND @end_d ;
UPDATE t_chronicfu f INNER JOIN (
	SELECT hospcode , pid ,max(date_serv) date_serv 
	FROM tmp_chronicfu WHERE foot in(1,3) 
	GROUP BY hospcode,PID
) l ON f.hospcode=l.hospcode AND f.pid=l.pid
SET f.ld_foot=l.date_serv;
UPDATE t_chronicfu f INNER JOIN tmp_chronicfu l ON f.hospcode=l.hospcode AND f.pid=l.pid AND f.ld_foot=l.DATE_SERV 
SET f.foot=l.foot;
UPDATE t_chronicfu f INNER JOIN (
	SELECT hospcode , pid ,max(date_serv) date_serv 
	FROM tmp_chronicfu WHERE retina in(1,2,3,4) 
	GROUP BY hospcode,PID
) l ON f.hospcode=l.hospcode AND f.pid=l.pid
SET f.ld_retina=l.date_serv;
UPDATE t_chronicfu f INNER JOIN tmp_chronicfu l ON f.hospcode=l.hospcode AND f.pid=l.pid AND f.ld_retina=l.DATE_SERV 
SET f.retina=l.retina;
DROP TABLES IF EXISTS t_dmht;
CREATE TABLE IF NOT EXISTS t_dmht (
		id int(15) NOT NULL AUTO_INCREMENT
		,hospcode VARCHAR(5) DEFAULT NULL 
		,pid VARCHAR(15)  DEFAULT NULL 
		,vhid VARCHAR(8) DEFAULT NULL 
		,typearea VARCHAR(1) DEFAULT NULL 
		,cid VARCHAR(13) NOT NULL
		,birth date
		,age_y INT(3) DEFAULT 0
		,groupcode1560 VARCHAR(100) DEFAULT NULL 
		,groupname1560 VARCHAR(100) DEFAULT NULL 
		,sex VARCHAR(1) DEFAULT NULL 
		,nation VARCHAR(3) DEFAULT NULL 
		,source_tb VARCHAR(255) DEFAULT NULL 
		,mix_dx VARCHAR(255) DEFAULT NULL 	
		,t_mix_dx VARCHAR(255) DEFAULT NULL 	
		,type_dx VARCHAR(2) DEFAULT NULL 
		,date_dx VARCHAR(255) DEFAULT NULL 
		,hosp_dx varchar(255) DEFAULT NULL 
		,minscl VARCHAR(5) DEFAULT NULL 
		,inscl VARCHAR(3) DEFAULT NULL 
		,ld_hba1c date  DEFAULT NULL 
		,rs_hba1c VARCHAR(10)  DEFAULT NULL
		,ih_hba1c  VARCHAR(5)  DEFAULT NULL
		,ld_fpg1 date DEFAULT NULL 
		,rs_fpg1 VARCHAR(10)  DEFAULT NULL 
		,ih_fpg1  VARCHAR(5)  DEFAULT NULL
		,ld_fpg2 date DEFAULT NULL 
		,rs_fpg2 VARCHAR(10)  DEFAULT NULL 
		,ih_fpg2  VARCHAR(5)  DEFAULT NULL
		,ld_fpg3 date DEFAULT NULL 
		,rs_fpg3 VARCHAR(10)  DEFAULT NULL 
		,ih_fpg3  VARCHAR(5)  DEFAULT NULL
		,ld_creatinine date DEFAULT NULL 
		,rs_creatinine VARCHAR(10)  DEFAULT NULL 
		,ih_creatinine VARCHAR(5)  DEFAULT NULL
		,ld_lipid date DEFAULT NULL 
		,rs_lipid VARCHAR(10)  DEFAULT NULL 
		,ih_lipid VARCHAR(5)  DEFAULT NULL
		,ld_foot date DEFAULT NULL 
		,rs_foot VARCHAR(10)  DEFAULT NULL
		,ih_foot VARCHAR(5)  DEFAULT NULL 
		,ld_retina date DEFAULT NULL 
		,rs_retina VARCHAR(10)  DEFAULT NULL 
		,ih_retina VARCHAR(5)  DEFAULT NULL 
		,ld_bp1 date DEFAULT NULL 
		,ih_bp1 VARCHAR(5)  DEFAULT NULL 
		,rs_bps1 VARCHAR(10)  DEFAULT NULL 
		,rs_bpd1 VARCHAR(10)  DEFAULT NULL 
		,ld_bp2 date  DEFAULT NULL 
		,ih_bp2 VARCHAR(5)  DEFAULT NULL 
		,rs_bps2 VARCHAR(10)  DEFAULT NULL 
		,rs_bpd2 VARCHAR(10)  DEFAULT NULL 
		,`complication_dm` varchar(20) DEFAULT '0',
  `complication_ht` varchar(20) DEFAULT '0',
  `control_dm` int(1) DEFAULT '0',
  `control_ht` int(1) DEFAULT '0',
  `bmi` decimal(10,2) DEFAULT '0',
  `obes` int(1) DEFAULT '0',
  `height` smallint(6) DEFAULT '0',
  `weight` mediumint(9) DEFAULT '0',
	`waist_cm`  smallint(6) NULL DEFAULT 0 ,
	lookup VARCHAR(20) DEFAULT NULL,
	lookup_update DATE,
	follow_up int(1),
	PRIMARY KEY (cid)
	,KEY (cid)
  ,KEY (id)
	,KEY (type_dx)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO t_dmht(
	hospcode,vhid,typearea,cid,birth,age_y,groupcode1560,groupname1560,sex,nation,minscl,inscl,source_tb,hosp_dx,mix_dx,t_mix_dx,date_dx
)
(
	SELECT SQL_BIG_RESULT 
			p.check_hosp,p.check_vhid,p.check_typearea,p.cid,p.birth,p.age_y,a.groupcode1560,a.groupname1560,p.sex,p.nation
			,p.maininscl,p.inscl
			,GROUP_CONCAT(c.source_tb ORDER BY c.date_dx ) source_tb
			,GROUP_CONCAT(c.hosp_dx ORDER BY c.date_dx ) hosp_dx
			,GROUP_CONCAT(c.diagcode ORDER BY c.date_dx  ) diagcode
			,GROUP_CONCAT(DISTINCT  substr(c.diagcode,1,1) ORDER BY SUBSTR(c.diagcode,1,1)  ) 
			,GROUP_CONCAT(c.date_dx  ORDER BY c.date_dx ) date_dx
FROM
(SELECT * FROM t_chronic 
WHERE  (SUBSTR(UPPER(diagcode),1,3) BETWEEN  'E10' and 'E14'  OR 	SUBSTR(UPPER(diagcode),1,3) BETWEEN  'I10' and 'I15')  
GROUP BY concat(cid,'-',diagcode) ) c 
INNER JOIN t_person_cid  p ON c.cid = p.cid
LEFT JOIN cage a ON	 p.age_y=a.age
WHERE p.nation IN(99)  AND p.DISCHARGE  IN(9)
GROUP BY p.cid
);
/*update pid*/
UPDATE t_dmht d,t_person_cid p  SET d.pid=p.pid WHERE d.cid=p.cid AND d.hospcode=p.hospcode;
/*up_mixdiag*/
UPDATE t_dmht 
	SET type_dx = if(t_mix_dx ='I' ,'01'  
							,if(t_mix_dx ='E' ,'02'
							,if(t_mix_dx ='E,I','03',NULL)));
/*up_hba1c*/
UPDATE IGNORE t_dmht d INNER JOIN 
(SELECT cid,MAX(date_serv) date_serv FROM  tmp_labfu WHERE labtest IN(5) GROUP BY cid) l ON d.cid=l.cid 
SET d.ld_hba1c =l.date_serv;
UPDATE IGNORE t_dmht d INNER JOIN tmp_labfu l ON d.cid=l.cid  AND d.ld_hba1c =l.date_serv
SET d.rs_hba1c =l.labresult ,d.ih_hba1c=l.HOSPCODE
WHERE l.labtest IN(5);
/*up_fpg1*/
UPDATE t_dmht d ,
								(SELECT l.cid,l.HOSPCODE,l.DATE_SERV,l.LABRESULT 
								FROM tmp_labfu l
								WHERE l.labtest in(1,3) 
								    AND l.DATE_SERV =
								(SELECT l1.DATE_SERV FROM tmp_labfu l1 WHERE l1.labtest in(1,3) AND l1.cid=l.cid GROUP BY l1.cid,l1.DATE_SERV ORDER BY l1.date_serv desc LIMIT 0,1)
								GROUP BY cid) as t
		SET ld_fpg1 =t.DATE_SERV,rs_fpg1 =t.LABRESULT ,ih_fpg1=t.hospcode
WHERE
		d.cid=t.cid ;
/*up_fpg2*/
UPDATE t_dmht d ,
								(SELECT l.cid,l.DATE_SERV,l.LABRESULT,l.HOSPCODE
								FROM tmp_labfu l
								WHERE l.labtest in(1,3) 
								    AND l.DATE_SERV =
								(SELECT l1.DATE_SERV FROM tmp_labfu l1 WHERE l1.labtest in(1,3) AND l1.cid=l.cid GROUP BY l1.cid,l1.DATE_SERV ORDER BY l1.date_serv desc LIMIT 1,1)
								GROUP BY cid) as t
		SET ld_fpg2 =t.DATE_SERV,rs_fpg2 =t.LABRESULT ,ih_fpg2=t.hospcode
WHERE
		d.cid=t.cid ;
/*up_fpg3*/
UPDATE t_dmht d ,
								(SELECT l.cid,l.DATE_SERV,l.LABRESULT,l.HOSPCODE
								FROM tmp_labfu l
								WHERE l.labtest in(1,3) 
								    AND l.DATE_SERV =
								(SELECT l1.DATE_SERV FROM tmp_labfu l1 WHERE l1.labtest in(1,3) AND l1.cid=l.cid GROUP BY l1.cid,l1.DATE_SERV ORDER BY l1.date_serv desc LIMIT 2,1)
								GROUP BY cid) as t
		SET ld_fpg3 =t.DATE_SERV,rs_fpg3 =t.LABRESULT,ih_fpg3=t.hospcode
WHERE
		d.cid=t.cid ;
/*Creatinine*/ 
UPDATE t_dmht d ,	
								(SELECT l.cid,l.DATE_SERV,l.LABRESULT,l.HOSPCODE
								FROM tmp_labfu l
								WHERE l.labtest in(11,13) 
								    AND l.DATE_SERV =
								(SELECT l1.DATE_SERV FROM tmp_labfu l1 WHERE l1.labtest in(11,13) AND l1.cid=l.cid GROUP BY l1.cid,l1.DATE_SERV ORDER BY l1.date_serv desc LIMIT 0,1)
								GROUP BY cid) as t
		SET ld_creatinine =t.DATE_SERV,rs_creatinine =t.LABRESULT,ih_creatinine=t.hospcode 
WHERE
		d.cid=t.cid ;
/*lipid TotalCholesterol*/
UPDATE t_dmht d ,	
								(SELECT l.cid,l.DATE_SERV,l.LABRESULT,l.HOSPCODE 
								FROM tmp_labfu l
								WHERE l.labtest in(7) 
								    AND l.DATE_SERV =
								(SELECT l1.DATE_SERV FROM tmp_labfu l1 WHERE l1.labtest in(7) AND l1.cid=l.cid GROUP BY l1.cid,l1.DATE_SERV ORDER BY l1.date_serv desc LIMIT 0,1)
								GROUP BY cid) as t
		SET ld_lipid =t.DATE_SERV,rs_lipid =t.LABRESULT ,ih_lipid=t.hospcode 
WHERE
		d.cid=t.cid ;
/*foot*/
UPDATE t_dmht d ,	
								(SELECT c.cid,c.DATE_SERV,c.FOOT,c.HOSPCODE
								FROM tmp_chronicfu c
								WHERE c.DATE_SERV =
								(SELECT c1.DATE_SERV FROM tmp_chronicfu c1 WHERE c1.cid=c.cid and c1.foot in(1,3) GROUP BY c1.cid,c1.DATE_SERV ORDER BY c1.date_serv desc LIMIT 0,1)
								GROUP BY cid) as t
		SET ld_foot =t.DATE_SERV,rs_foot =t.FOOT,ih_foot=t.hospcode
WHERE
		d.cid=t.cid ;
/*retina*/ 
UPDATE t_dmht d ,	
								(SELECT c.cid,c.DATE_SERV,c.RETINA,c.HOSPCODE
								FROM tmp_chronicfu c
								WHERE c.RETINA in(1,2,3,4)  AND c.DATE_SERV =
								(SELECT c1.DATE_SERV FROM tmp_chronicfu c1 WHERE c1.cid=c.cid and c1.RETINA in(1,2,3,4) GROUP BY c1.cid,c1.DATE_SERV ORDER BY c1.date_serv desc LIMIT 0,1)
								GROUP BY cid) as t
		SET ld_retina =t.DATE_SERV,rs_retina =t.RETINA ,ih_retina=t.hospcode
WHERE
		d.cid=t.cid ;
/*last_bp1*/ 
UPDATE t_dmht d ,	
								(SELECT c.cid,c.DATE_SERV,c.SBP,c.DBP,c.HOSPCODE
								FROM tmp_chronicfu c
								WHERE c.DATE_SERV =
								(SELECT c1.DATE_SERV FROM tmp_chronicfu c1 WHERE c1.cid=c.cid and c1.SBP >0 AND c1.DBP>0  GROUP BY c1.cid,c1.DATE_SERV ORDER BY c1.date_serv desc LIMIT 0,1)
								GROUP BY cid) as t
		SET ld_bp1 =t.DATE_SERV,rs_bps1 =t.SBP,rs_bpd1 =t.DBP,ih_bp1=t.hospcode
WHERE
		d.cid=t.cid ;
/*last_bp2*/
UPDATE t_dmht d ,	
								(SELECT c.cid,c.DATE_SERV,c.SBP,c.DBP,c.HOSPCODE
								FROM tmp_chronicfu c
								WHERE c.DATE_SERV =
								(SELECT c1.DATE_SERV FROM tmp_chronicfu c1 WHERE c1.cid=c.cid and c1.SBP >0 AND c1.DBP>0 GROUP BY c1.cid,c1.DATE_SERV ORDER BY c1.date_serv desc LIMIT 1,1)
								GROUP BY cid) as t
		SET ld_bp2 =t.DATE_SERV,rs_bps2 =t.SBP,rs_bpd2 =t.DBP,ih_bp2=t.hospcode
WHERE
		d.cid=t.cid ;
/*ภาวะแทรกซ้อนทางตา*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('E103','E113','E123','E133','E143','H360','H280')
)  d SET complication_dm='1' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(2,3);
/*ไต*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('E102','E112','E122','E132','E142','N083')
)  d SET complication_dm='2' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(2,3);
/*เท้า*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('E104','E114','E124','E134','E144','I792','E105','E115','E125','E135','E145' )
)  d SET complication_dm='3' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(2,3);
/*หลายอย่าง*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('E107','E117','E127','E137','E147')
)  d SET complication_dm='4' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(2,3);
/*ภาวะนำ้ตาลตำ่*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('E16')
)  d SET complication_dm='5' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(2,3);
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('E131')
)  d SET complication_dm='6' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(2,3);
/*หัวใจ*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('I110','I119')
)  d SET complication_ht='1' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(1,3);
/*ไต*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('I120','I129')
)  d SET complication_ht='2' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(1,3);
/*ไตหัวใจ*/
UPDATE t_dmht t , (
					SELECT 
							cid
					FROM
					report_chronic_opd_ipd 
					WHERE diagcode in('I130','I131','I132','I139')
)  d SET complication_ht='3' WHERE t.cid=d.cid AND d.cid is not null AND t.type_dx in(1,3);
/*w,h*/
UPDATE t_dmht t , (
				SELECT
				*
				FROM
				(SELECT 
							cid,weight,height,WAIST_CM
					FROM
					tmp_chronicfu
					WHERE  weight is not null  and height is not null
					ORDER BY DATE_SERV DESC
					) pre
					GROUP BY cid
)  d SET t.weight=d.weight ,t.height=d.height,t.waist_cm=d.waist_cm  WHERE t.cid=d.cid AND d.cid is not null ;

/*up control dm 1 ok 0 not ok*/
UPDATE t_dmht SET control_dm='1' WHERE type_dx in(2,3) AND 
			(rs_hba1c BETWEEN 0.1  AND 6.99) AND ld_hba1c BETWEEN @start_d2 AND @end_d	;
/*bp control*/
UPDATE t_dmht SET control_ht ='1'	 WHERE 		
type_dx in(1,3) AND (rs_bps1  BETWEEN 50 AND 139) AND (rs_bps2  BETWEEN 50 AND 139 )
AND (rs_bpd1 BETWEEN 50 AND 89) AND (rs_bpd2 BETWEEN 50 AND 89) AND ld_bp1 BETWEEN @start_d2 AND @end_d ;

UPDATE t_dmht SET bmi=round(WEIGHT/((HEIGHT/100)*(HEIGHT/100)),2) ;
UPDATE t_dmht SET obes =1 WHERE
(sex='1' AND round(WAIST_CM)>90) OR (sex='2' AND round(WAIST_CM)>80)
OR bmi>=25;
#follow_up คนในเขตรับผิดชอบมาขึ้นทะเบียนติดตาม
UPDATE t_dmht t SET follow_up = 1 
WHERE CONCAT(t.hospcode,t.cid) NOT IN 
(SELECT * FROM (SELECT CONCAT(a.p_hospcode,a.cid) FROM t_chronic a GROUP BY CONCAT(a.p_hospcode,a.cid)) t );

#ex_tdmht for HDC
call ex_tdmht;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_ncdscreen` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_ncdscreen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_ncdscreen`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=CONCAT(@b_year-2,'1001');
SET @start_d1:=CONCAT(@b_year-1,'1001');
SET @end_d:=CONCAT(@b_year,'0930');
SET @end_d1:=CONCAT(@b_year-1,'0930');
DROP TABLES IF EXISTS tmp_ncdscreen;
CREATE TABLE IF NOT EXISTS tmp_ncdscreen (error_code VARCHAR(255) DEFAULT NULL, KEY(cid)) ENGINE=MYISAM  AS(
SELECT SQL_BIG_RESULT 
		n.*,p.CID,NULL AS error_code
FROM
	report_ncdscreen n LEFT JOIN t_person p ON n.HOSPCODE=p.HOSPCODE AND n.PID=p.PID
WHERE	DATE_SERV BETWEEN @start_d AND @end_d
);
UPDATE tmp_ncdscreen 
SET error_code =IF(ISNULL(error_code),'NCD0001',CONCAT(error_code,',','NCD0001') ) 
WHERE  DATE_SERV BETWEEN @start_d1 AND @end_d AND HEIGHT NOT BETWEEN 30 AND 250;
UPDATE tmp_ncdscreen 
SET error_code =IF(ISNULL(error_code),'NCD0002',CONCAT(error_code,',','NCD0002') ) 
WHERE  DATE_SERV BETWEEN @start_d1 AND @end_d AND WEIGHT NOT BETWEEN  10 AND 300;
UPDATE tmp_ncdscreen n INNER JOIN t_person p  ON n.HOSPCODE=p.HOSPCODE AND n.PID=p.PID
SET n.error_code =IF(ISNULL(n.error_code),'NCD0003',CONCAT(n.error_code,',','NCD0003') ) 
WHERE  DATE_SERV BETWEEN @start_d1 AND @end_d AND n.DATE_SERV < p.BIRTH;
DROP TABLES IF EXISTS t_ncdscreen;
CREATE TABLE IF NOT EXISTS t_ncdscreen (
KEY(hospcode),KEY(check_hosp),KEY(cid),KEY(date_serv),KEY(bslevel),KEY(bstest),KEY(sbp_1,dbp_1),KEY(sbp_2,dbp_2),KEY(sex)
) ENGINE=MYISAM  AS(
SELECT SQL_BIG_RESULT 
ns.*,c.groupcode3560,c.groupname3560
FROM
		(SELECT
				n.*,age(n.DATE_SERV,p.BIRTH,'y') AS age_y,p.check_hosp,p.check_typearea,p.TYPEAREA,p.check_vhid,p.vhid,p.nation,p.sex
		FROM
			tmp_ncdscreen n LEFT JOIN t_person_cid p ON n.cid=p.cid
		WHERE	DATE_SERV BETWEEN @start_d AND @end_d
		) AS ns,cage c 
WHERE ns.age_y=c.age
);
/*เบาหวาน*/
DROP  TABLE IF EXISTS  t_person_dm_screen;
CREATE  TABLE IF NOT EXISTS t_person_dm_screen (
  hospcode VARCHAR(5) DEFAULT NULL,
  areacode VARCHAR(8) DEFAULT NULL,
  cid VARCHAR(13) NOT NULL,
  pid VARCHAR(15) DEFAULT NULL,
	age_y INT(3) DEFAULT '0',
	typearea  VARCHAR(1) DEFAULT NULL,
	date_screen DATE ,
  bslevel INT(6)  DEFAULT '0',
	bstest  VARCHAR(1) DEFAULT NULL,
  ill VARCHAR(1) DEFAULT NULL,
  risk VARCHAR(1) DEFAULT NULL,
PRIMARY KEY (cid),
	KEY (hospcode),
	KEY (areacode),
	KEY (pid),
	KEY (typearea),
  KEY (risk)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO t_person_dm_screen(
  hospcode,areacode,cid,pid,age_y,typearea
)
SELECT pe.check_hosp HOSPCODE
								,pe.check_vhid AS areacode
								,pe.CID,pe.PID,pe.age_y,pe.check_typearea TYPEAREA
				FROM
						t_person_cid pe
				WHERE
						SUBSTR(pe.check_vhid,1,2)=@prov_c
						AND pe.nation=99 
						AND pe.DISCHARGE=9 
						AND pe.age_y>=15 
						AND pe.check_typearea IN(1,3)
						AND cid NOT IN(SELECT cid FROM t_dmht WHERE type_dx IN(2,3))
ORDER BY check_hosp,check_typearea
;
UPDATE t_person_dm_screen p,t_ncdscreen n SET p.date_screen=n.DATE_SERV  ,p.bslevel=n.BSLEVEL, p.bstest=n.bstest
WHERE p.cid=n.cid AND n.DATE_SERV BETWEEN @start_d1 AND @end_d;
UPDATE t_person_dm_screen p INNER JOIN t_dmht d 
SET ill='1'
WHERE p.cid=d.cid AND d.type_dx IN(2,3);
UPDATE t_person_dm_screen SET risk='0'
WHERE (((bstest IN('1','3') OR bstest IS NULL) AND bslevel BETWEEN 70 AND 99 ) OR
(bstest IN('2','4') AND bslevel BETWEEN 70 AND 139));
UPDATE t_person_dm_screen SET risk='1'
WHERE (((bstest IN('1','3') OR bstest IS NULL) AND bslevel BETWEEN 100 AND 125) OR 
(bstest IN('2','4') AND bslevel BETWEEN 140 AND 199));
UPDATE t_person_dm_screen SET risk='2'
WHERE (((bstest IN('1','3') OR bstest IS NULL) AND bslevel >125) OR
(bstest IN('2','4') AND bslevel > 199));
/*ความดัน*/
DROP  TABLE IF EXISTS  t_person_ht_screen;
CREATE  TABLE IF NOT EXISTS t_person_ht_screen (
  hospcode VARCHAR(5) DEFAULT NULL,
  areacode VARCHAR(8) DEFAULT NULL,
  cid VARCHAR(13) NOT NULL,
  pid VARCHAR(15) DEFAULT NULL,
	age_y INT(3) DEFAULT '0',
	typearea  VARCHAR(1) DEFAULT NULL,
	date_screen DATE ,
  sbp_1 INT(3)  DEFAULT 0,
	dbp_1 INT(3)  DEFAULT 0,
	sbp_2 INT(3)  DEFAULT 0,
	dbp_2 INT(3)  DEFAULT 0,
  ill VARCHAR(1) DEFAULT NULL,
	sbp INT(3)  DEFAULT 0,
	dbp INT(3)  DEFAULT 0,
	risk VARCHAR(1) DEFAULT NULL,
PRIMARY KEY (cid),
	KEY (hospcode),
	KEY (areacode),
	KEY (pid),
	KEY (typearea),
	KEY (risk)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO t_person_ht_screen(
  hospcode,areacode,cid,pid,age_y,typearea
)
SELECT pe.check_hosp HOSPCODE
								,pe.check_vhid AS areacode
								,pe.CID,pe.PID,pe.age_y,pe.check_typearea TYPEAREA
				FROM
						t_person_cid pe
				WHERE
						SUBSTR(pe.check_vhid,1,2)=@prov_c
						AND pe.nation=99 
						AND pe.DISCHARGE=9 
						AND pe.age_y>=15 
						AND pe.check_typearea IN(1,3)
						AND cid NOT IN(SELECT cid FROM t_dmht WHERE type_dx IN(1,3))
ORDER BY check_hosp,check_typearea
;
UPDATE t_person_ht_screen p,t_ncdscreen n SET p.date_screen=n.DATE_SERV  ,p.sbp_1=n.SBP_1,p.sbp_2=n.SBP_2,p.dbp_1=n.dBP_1,p.dbp_2=n.dBP_2
WHERE p.cid=n.cid AND n.DATE_SERV BETWEEN @start_d1 AND @end_d;
UPDATE t_person_ht_screen p INNER JOIN t_dmht d 
SET ill='1'
WHERE p.cid=d.cid AND d.type_dx IN(1,3);
UPDATE t_person_ht_screen SET sbp=sbp_2 ,dbp=dbp_2
WHERE sbp_2 >0  ; 
UPDATE t_person_ht_screen SET sbp=sbp_1 ,dbp=dbp_1
WHERE sbp =0 AND sbp_1>0  ;
UPDATE t_person_ht_screen SET risk='0'
WHERE (sbp BETWEEN 50 AND 119) AND  (dbp  BETWEEN 50 AND 79);
UPDATE t_person_ht_screen SET risk='1'
WHERE (sbp BETWEEN 120 AND 139) OR (dbp BETWEEN 80 AND 89);
UPDATE t_person_ht_screen SET risk='2'
WHERE sbp >=140 OR dbp >=90;
DROP TABLE IF EXISTS tmp_ncdscreen_last;
CREATE TABLE IF NOT EXISTS tmp_ncdscreen_last(
  `HOSPCODE` VARCHAR(5) DEFAULT NULL,
  `PID` VARCHAR(15)  DEFAULT NULL,
  `SEQ` VARCHAR(16) DEFAULT NULL,
  `DATE_SERV` DATE NOT NULL,
  `BSLEVEL` INT(6) DEFAULT NULL,
  `BSTEST` CHAR(1) DEFAULT NULL,
  `SCREENPLACE` VARCHAR(5) DEFAULT NULL,
  `CID` VARCHAR(13) NOT NULL,
  `age_y` INT(3) DEFAULT NULL,
  `pcheck_hosp` VARCHAR(5) DEFAULT '',
  `pcheck_typearea` VARCHAR(1) DEFAULT '',
  `pcheck_vhid` VARCHAR(8) DEFAULT NULL,
  `nation` VARCHAR(3) DEFAULT '',
  `sex` VARCHAR(1) DEFAULT '',
	diagcode VARCHAR(8) DEFAULT NULL,
	diag_hospcode VARCHAR(5) DEFAULT NULL,
	diag_date DATE DEFAULT NULL,
PRIMARY KEY (cid),
	KEY (hospcode),
	KEY (pcheck_hosp),
	KEY (pcheck_typearea),
	KEY (pcheck_vhid)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
INSERT INTO tmp_ncdscreen_last (cid,date_serv)
(SELECT cid,MAX(DATE_SERV) DATE_SERV  
FROM t_ncdscreen WHERE DATE_SERV BETWEEN @start_d AND @end_d1 AND BSLEVEL > 70
GROUP BY cid
);
UPDATE tmp_ncdscreen_last l INNER JOIN t_ncdscreen n ON l.cid=n.cid AND l.date_serv=n.date_serv
SET l.HOSPCODE = n.HOSPCODE ,l.PID=n.PID ,l.SEQ =n.SEQ ,l.BSLEVEL=n.BSLEVEL ,l.BSTEST=n.BSTEST
,l.SCREENPLACE=n.SCREENPLACE,l.age_y=n.age_y ,l.pcheck_hosp =n.check_hosp , l.pcheck_typearea=n.check_typearea 
,l.pcheck_vhid = n.check_vhid,l.nation=n.nation,l.sex=n.sex;
UPDATE tmp_ncdscreen_last l INNER JOIN  t_chronic  c ON l.cid=c.cid
SET l.diagcode=c.diagcode , l.diag_hospcode=IFNULL(c.hosp_dx,c.input_hosp) ,l.diag_date=c.date_dx
WHERE  SUBSTR(c.diagcode ,1,3) BETWEEN 'E10' AND 'E14' AND c.date_dx>l.date_serv;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_newborn` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_newborn` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_newborn`()
BEGIN
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET	@id:= '17';
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET	@start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');

	DROP TABLES IF EXISTS t_newborn;
	CREATE TABLE IF NOT EXISTS t_newborn (
	KEY(cid),
	KEY(hospcode),
	KEY(pid),
	KEY(BDATE)
	) ENGINE=MyISAM  AS(
	SELECT SQL_BIG_RESULT 
			a.*,p.nation,p.sex,p.check_hosp,p.check_vhid,p.check_typearea,p.vhid,p.typearea
	FROM
		report_newborn a LEFT JOIN t_person p ON  a.HOSPCODE=p.HOSPCODE AND a.PID=p.PID 
	WHERE BDATE BETWEEN @start_d AND @end_d 
			AND p.check_typearea in(1,3)
	);


END */$$
DELIMITER ;

/* Procedure structure for procedure `t_nutrition05` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_nutrition05` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_nutrition05`()
BEGIN
SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '41';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');
SET @start_t1=concat(@b_year-1,'1001');
SET @start_t2=concat(@b_year,'0101');
SET @start_t3=concat(@b_year,'0401');
SET @start_t4=concat(@b_year,'0701');
SET @end_t1=concat(@b_year-1,'1231');
SET @end_t2=concat(@b_year,'0331');
SET @end_t3=concat(@b_year,'0630');
SET @end_t4=concat(@b_year,'0930');

DROP TABLE IF EXISTS t_nutrition05;
CREATE TABLE IF NOT EXISTS t_nutrition05( 
		CID VARCHAR(13) NOT NULL,
		SEX VARCHAR(1) NOT NULL,
		BIRTH DATE  DEFAULT NULL,
		AGE_T1 VARCHAR(5)  DEFAULT NULL,
		AGE_T2 VARCHAR(5)  DEFAULT NULL,
		AGE_T3 VARCHAR(5)  DEFAULT NULL,
		AGE_T4 VARCHAR(5)  DEFAULT NULL,
		DATE_SERV1 DATE DEFAULT NULL,
		DATE_SERV2 DATE DEFAULT NULL,
		DATE_SERV3 DATE DEFAULT NULL,
		DATE_SERV4 DATE DEFAULT NULL,
		AGE_MS1 VARCHAR(5)  DEFAULT NULL,
		AGE_MS2 VARCHAR(5)  DEFAULT NULL,
		AGE_MS3 VARCHAR(5)  DEFAULT NULL,
		AGE_MS4 VARCHAR(5)  DEFAULT NULL,
		WEIGHT1 DECIMAL(5,1)  DEFAULT 0,
		WEIGHT2 DECIMAL(5,1)  DEFAULT 0,
		WEIGHT3 DECIMAL(5,1)  DEFAULT 0,
		WEIGHT4 DECIMAL(5,1)  DEFAULT 0,
		HEIGHT1 INT(3)  DEFAULT 0,
		HEIGHT2 INT(3)  DEFAULT 0,
		HEIGHT3 INT(3)  DEFAULT 0,
		HEIGHT4 INT(3)  DEFAULT 0,
		W_S1 VARCHAR(1)  DEFAULT NULL,
		W_S2 VARCHAR(1)  DEFAULT NULL,
		W_S3 VARCHAR(1)  DEFAULT NULL,
		W_S4 VARCHAR(1)  DEFAULT NULL,
		H_S1 VARCHAR(1)  DEFAULT NULL,
		H_S2 VARCHAR(1)  DEFAULT NULL,
		H_S3 VARCHAR(1)  DEFAULT NULL,
		H_S4 VARCHAR(1)  DEFAULT NULL,
		WH1 VARCHAR(1)  DEFAULT NULL,
		WH2 VARCHAR(1)  DEFAULT NULL,
		WH3 VARCHAR(1)  DEFAULT NULL,
		WH4 VARCHAR(1)  DEFAULT NULL,
		hospcode VARCHAR(5)  DEFAULT NULL,
		typearea VARCHAR(1)  DEFAULT NULL,
		PRIMARY KEY (CID)
) ENGINE MyISAM DEFAULT CHARACTER SET=utf8;
/*เพิ่มข้อมูลคน*/
INSERT IGNORE INTO t_nutrition05 (cid,birth,sex,AGE_T1,AGE_T2,AGE_T3,AGE_T4,hospcode,typearea)
SELECT
		p.cid,p.BIRTH,p.SEX
		,TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t1,'%Y%m%d')) AGE_T1
		,TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t2,'%Y%m%d')) AGE_T2
		,TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t3,'%Y%m%d')) AGE_T3
		,TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t4,'%Y%m%d')) AGE_T4
		,check_hosp,check_typearea
FROM  t_person_cid p 
WHERE   TIMESTAMPDIFF(day,p.BIRTH,NOW())>1  AND 
		(
			TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t1,'%Y%m%d'))  <6 OR
			TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t2,'%Y%m%d'))  <6 OR
			TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t3,'%Y%m%d'))  <6 OR
			TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_t4,'%Y%m%d'))  <6 
		)
GROUP BY p.cid;

/*เพิ่มบริการตามไตรมาส*/
UPDATE t_nutrition05 p INNER JOIN 
(SELECT * FROM 
			(SELECT cid,DATE_SERV,WEIGHT,HEIGHT FROM report_nutrition 
				WHERE DATE_SERV BETWEEN @start_t1 AND @end_t1 
				ORDER BY DATE_SERV DESC ) as t1 GROUP BY cid) as n
ON p.cid=n.cid  SET p.DATE_SERV1=n.DATE_SERV ,p.HEIGHT1=n.height ,p.WEIGHT1=n.weight;

UPDATE t_nutrition05 p INNER JOIN 
(SELECT * FROM 
			(SELECT cid,DATE_SERV,WEIGHT,HEIGHT FROM report_nutrition 
				WHERE DATE_SERV BETWEEN @start_t2 AND @end_t2
				ORDER BY DATE_SERV DESC ) as t1 GROUP BY cid) as n
ON p.cid=n.cid  SET p.DATE_SERV2=n.DATE_SERV ,p.HEIGHT2=n.height ,p.WEIGHT2=n.weight;

UPDATE t_nutrition05 p INNER JOIN 
(SELECT * FROM 
			(SELECT cid,DATE_SERV,WEIGHT,HEIGHT FROM report_nutrition 
				WHERE DATE_SERV BETWEEN @start_t3 AND @end_t3
				ORDER BY DATE_SERV DESC ) as t1 GROUP BY cid) as n
ON p.cid=n.cid  SET p.DATE_SERV3=n.DATE_SERV ,p.HEIGHT3=n.height ,p.WEIGHT3=n.weight;

UPDATE t_nutrition05 p INNER JOIN 
(SELECT * FROM 
			(SELECT cid,DATE_SERV,WEIGHT,HEIGHT FROM report_nutrition 
				WHERE DATE_SERV BETWEEN @start_t4 AND @end_t4
				ORDER BY DATE_SERV DESC ) as t1 GROUP BY cid) as n
ON p.cid=n.cid  SET p.DATE_SERV4=n.DATE_SERV ,p.HEIGHT4=n.height ,p.WEIGHT4=n.weight;
/*คำนวนอายุเป็นเดือนณวันรับบริการ*/
UPDATE t_nutrition05  SET AGE_MS1 = TIMESTAMPDIFF(MONTH,BIRTH,DATE_SERV1)
		,AGE_MS2 = TIMESTAMPDIFF(MONTH,BIRTH,DATE_SERV2)
		,AGE_MS3 = TIMESTAMPDIFF(MONTH,BIRTH,DATE_SERV3)
		,AGE_MS4 = TIMESTAMPDIFF(MONTH,BIRTH,DATE_SERV4);
/*คำนวน Nutrition_CAL*/
UPDATE t_nutrition05 SET W_S1=nutri_cal(AGE_MS1,SEX,'1',HEIGHT1,WEIGHT1) WHERE AGE_MS1 >0 AND WEIGHT1 >0;
UPDATE t_nutrition05 SET W_S2=nutri_cal(AGE_MS2,SEX,'1',HEIGHT2,WEIGHT2) WHERE AGE_MS2 >0 AND WEIGHT2 >0;
UPDATE t_nutrition05 SET W_S3=nutri_cal(AGE_MS3,SEX,'1',HEIGHT3,WEIGHT3) WHERE AGE_MS3 >0 AND WEIGHT3 >0;
UPDATE t_nutrition05 SET W_S4=nutri_cal(AGE_MS4,SEX,'1',HEIGHT4,WEIGHT4) WHERE AGE_MS4 >0 AND WEIGHT4 >0;

UPDATE t_nutrition05 SET H_S1=nutri_cal(AGE_MS1,SEX,'2',HEIGHT1,WEIGHT1) WHERE AGE_MS1 >0  AND HEIGHT1 >0;
UPDATE t_nutrition05 SET H_S2=nutri_cal(AGE_MS2,SEX,'2',HEIGHT2,WEIGHT2) WHERE AGE_MS2 >0  AND HEIGHT2 >0;
UPDATE t_nutrition05 SET H_S3=nutri_cal(AGE_MS3,SEX,'2',HEIGHT3,WEIGHT3) WHERE AGE_MS3 >0  AND HEIGHT3 >0;
UPDATE t_nutrition05 SET H_S4=nutri_cal(AGE_MS4,SEX,'2',HEIGHT4,WEIGHT4) WHERE AGE_MS4 >0  AND HEIGHT4 >0;

UPDATE t_nutrition05 SET WH1=nutri_cal(AGE_MS1,SEX,'3',HEIGHT1,WEIGHT1) WHERE AGE_MS1 >0 AND WEIGHT1 >0 AND HEIGHT1 >0 ; 
UPDATE t_nutrition05 SET WH2=nutri_cal(AGE_MS2,SEX,'3',HEIGHT2,WEIGHT2) WHERE AGE_MS2 >0 AND WEIGHT2 >0 AND HEIGHT2 >0 ; 
UPDATE t_nutrition05 SET WH3=nutri_cal(AGE_MS3,SEX,'3',HEIGHT3,WEIGHT3) WHERE AGE_MS3 >0 AND WEIGHT3 >0 AND HEIGHT3 >0 ; 
UPDATE t_nutrition05 SET WH4=nutri_cal(AGE_MS4,SEX,'3',HEIGHT4,WEIGHT4) WHERE AGE_MS4 >0 AND WEIGHT4 >0 AND HEIGHT4 >0 ; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_nutrition6` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_nutrition6` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `t_nutrition6`()
BEGIN
SET	@id:= '42';
SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');
SET @start_te1=concat(@b_year-1,'1001');
SET @start_te2=concat(@b_year,'0501');
SET @end_te1=concat(@b_year-1,'1231');
SET @end_te2=concat(@b_year,'0731');

DROP TABLE IF EXISTS t_nutrition6up;
CREATE TABLE IF NOT EXISTS t_nutrition6up( 
		CID VARCHAR(13) NOT NULL,
		SEX VARCHAR(1) NOT NULL,
		BIRTH DATE  DEFAULT NULL,
		AGE_T1 VARCHAR(5)  DEFAULT NULL,
		AGE_T2 VARCHAR(5)  DEFAULT NULL,
		DATE_SERV1 DATE DEFAULT NULL,
		DATE_SERV2 DATE DEFAULT NULL,
		AGE_MS1 VARCHAR(5)  DEFAULT NULL,
		AGE_MS2 VARCHAR(5)  DEFAULT NULL,
		WEIGHT1 DECIMAL(5,1)  DEFAULT 0,
		WEIGHT2 DECIMAL(5,1)  DEFAULT 0,
		HEIGHT1 INT(3)  DEFAULT 0,
		HEIGHT2 INT(3)  DEFAULT 0,
		W_S1 VARCHAR(1)  DEFAULT NULL,
		W_S2 VARCHAR(1)  DEFAULT NULL,
		H_S1 VARCHAR(1)  DEFAULT NULL,
		H_S2 VARCHAR(1)  DEFAULT NULL,
		WH1 VARCHAR(1)  DEFAULT NULL,
		WH2 VARCHAR(1)  DEFAULT NULL,
		hospcode VARCHAR(5)  DEFAULT NULL,
		typearea VARCHAR(1)  DEFAULT NULL,
		PRIMARY KEY (CID)
) ENGINE MyISAM DEFAULT CHARACTER SET=utf8;
/*เพิ่มข้อมูลคน*/
INSERT IGNORE INTO t_nutrition6up (cid,birth,sex,AGE_T1,AGE_T2,hospcode,typearea)
SELECT
		p.cid,p.BIRTH,p.SEX
		,TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_te1,'%Y%m%d')) AGE_T1
		,TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_te2,'%Y%m%d')) AGE_T2
		,check_hosp,check_typearea
FROM  t_person_cid p 
WHERE  
		(
			TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_te1,'%Y%m%d'))  BETWEEN 6 AND 18 OR
			TIMESTAMPDIFF(YEAR,p.birth,DATE_FORMAT(@end_te2,'%Y%m%d'))  BETWEEN 6 AND 18 
		)
 GROUP BY p.cid;

/*เพิ่มบริการตามไตรมาส*/
UPDATE t_nutrition6up p INNER JOIN 
(SELECT * FROM 
			(SELECT cid,DATE_SERV,WEIGHT,HEIGHT FROM report_nutrition 
				WHERE DATE_SERV BETWEEN @start_te1 AND @end_te1 
				ORDER BY DATE_SERV DESC ) as t1 GROUP BY cid) as n
ON p.cid=n.cid  SET p.DATE_SERV1=n.DATE_SERV ,p.HEIGHT1=n.height ,p.WEIGHT1=n.weight ;


UPDATE t_nutrition6up p INNER JOIN 
(SELECT * FROM 
			(SELECT cid,DATE_SERV,WEIGHT,HEIGHT FROM report_nutrition 
				WHERE DATE_SERV BETWEEN @start_te2 AND @end_te2
				ORDER BY DATE_SERV DESC ) as t1 GROUP BY cid) as n
ON p.cid=n.cid  SET p.DATE_SERV2=n.DATE_SERV ,p.HEIGHT2=n.height ,p.WEIGHT2=n.weight;

/*คำนวนอายุเป็นเดือนณวันรับบริการ*/
UPDATE t_nutrition6up  SET AGE_MS1 = TIMESTAMPDIFF(MONTH,BIRTH,DATE_SERV1)
		,AGE_MS2 = TIMESTAMPDIFF(MONTH,BIRTH,DATE_SERV2);
/*คำนวน Nutrition_CAL*/
UPDATE t_nutrition6up SET W_S1=nutri_cal(AGE_MS1,SEX,'1',HEIGHT1,WEIGHT1) WHERE AGE_MS1 >1;
UPDATE t_nutrition6up SET W_S2=nutri_cal(AGE_MS2,SEX,'1',HEIGHT2,WEIGHT2) WHERE AGE_MS2 >1;

UPDATE t_nutrition6up SET H_S1=nutri_cal(AGE_MS1,SEX,'2',HEIGHT1,WEIGHT1) WHERE AGE_MS1 >1;
UPDATE t_nutrition6up SET H_S2=nutri_cal(AGE_MS2,SEX,'2',HEIGHT2,WEIGHT2) WHERE AGE_MS2 >1;

UPDATE t_nutrition6up SET WH1=nutri_cal(AGE_MS1,SEX,'3',HEIGHT1,WEIGHT1) WHERE AGE_MS1 >1;
UPDATE t_nutrition6up SET WH2=nutri_cal(AGE_MS2,SEX,'3',HEIGHT2,WEIGHT2) WHERE AGE_MS2 >1;

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_nutrition_service` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_nutrition_service` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_nutrition_service`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '56';
SET	@b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');
DROP TABLE IF EXISTS t_nutrition_service;
CREATE TABLE IF NOT EXISTS t_nutrition_service(
hospcode VARCHAR(5) NOT NULL,
pid VARCHAR(15) NOT NULL,
seq VARCHAR(16) NOT NULL,
date_serv date,
weight decimal(5,1) NOT NULL,
height  int(3) NOT NULL,
HEADCIRCUM int(3) DEFAULT NULL,
FOOD varchar(1) DEFAULT NULL,
BOTTLE varchar(1) DEFAULT NULL,
BIRTH date,
SEX varchar(1) NOT NULL,
NATION varchar(3) DEFAULT NULL,
quarter_m int(1) DEFAULT 0,
nutri1 int(1) DEFAULT 0,
nutri2 int(1) DEFAULT 0,
nutri3 int(1) DEFAULT 0,
PRIMARY KEY (hospcode,pid,quarter_m)
)  ENGINE MyISAM DEFAULT CHARACTER SET=utf8;
INSERT IGNORE INTO t_nutrition_service (HOSPCODE,PID,SEQ,DATE_SERV,WEIGHT,HEIGHT,HEADCIRCUM,FOOD,BOTTLE
,BIRTH,SEX,NATION,quarter_m)
(
SELECT n.HOSPCODE,n.PID,'' as SEQ,n.DATE_SERV,n.WEIGHT,n.HEIGHT,'' AS HEADCIRCUM,'' AS FOOD,'' AS BOTTLE
,p.BIRTH,p.SEX,p.NATION, IF(DATE_FORMAT(n.DATE_SERV,'%m') BETWEEN 10 AND 12,1,
IF(DATE_FORMAT(n.DATE_SERV,'%m') BETWEEN 1 AND 3,2,
IF(DATE_FORMAT(n.DATE_SERV,'%m') BETWEEN 4 AND 6,3,
IF(DATE_FORMAT(n.DATE_SERV,'%m') BETWEEN 7 AND 9,4,0
 )))) as quarter_m
FROM
report_nutrition n INNER JOIN t_person p ON n.HOSPCODE=p.HOSPCODE AND n.PID=p.PID
WHERE WEIGHT BETWEEN 0.1  AND 300 AND HEIGHT   BETWEEN 40 AND 250 
AND n.DATE_SERV >= p.birth
AND n.DATE_SERV BETWEEN  @start_d AND @end_d
AND p.NATION in(99) 
ORDER BY n.HOSPCODE ASC ,n.PID ASC ,n.DATE_SERV DESC 
);
UPDATE t_nutrition_service SET nutri1=nutri_cal(TIMESTAMPDIFF(month,birth,date_serv),sex,1,height,weight)
,nutri2=nutri_cal(TIMESTAMPDIFF(month,birth,date_serv),sex,2,height,weight)
,nutri3=nutri_cal(TIMESTAMPDIFF(month,birth,date_serv),sex,3,height,weight);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `t_person` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_person` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_person`()
BEGIN
  DECLARE done INT;
  DECLARE db VARCHAR(255);
  DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;# WHERE hospcode = '08215';
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  
  SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
  SET @id:= '9';
  SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
  
DROP TABLE IF EXISTS t_person;
CREATE TABLE IF NOT EXISTS t_person (
                `HOSPCODE` VARCHAR(5) NOT NULL DEFAULT '',
                `CID` VARCHAR(13) DEFAULT NULL,
                `PID` VARCHAR(15) NOT NULL DEFAULT '',
                `HID` VARCHAR(14) DEFAULT NULL,
                `PRENAME` VARCHAR(3) NOT NULL DEFAULT '',
                `NAME` VARCHAR(50) NOT NULL DEFAULT '',
                `LNAME` VARCHAR(50) NOT NULL DEFAULT '',
                `HN` VARCHAR(15) DEFAULT NULL,
                `SEX` VARCHAR(1) NOT NULL DEFAULT '',
                `BIRTH` DATE NOT NULL DEFAULT '0000-00-00',
                `MSTATUS` CHAR(1) DEFAULT NULL,
                `OCCUPATION_OLD` VARCHAR(3) DEFAULT NULL,
                `OCCUPATION_NEW` VARCHAR(4) DEFAULT NULL,
                `RACE` VARCHAR(3) DEFAULT NULL,
                `NATION` VARCHAR(3) NOT NULL DEFAULT '',
                `RELIGION` VARCHAR(2) DEFAULT NULL,
                `EDUCATION` VARCHAR(2) DEFAULT NULL,
                `FSTATUS` VARCHAR(1) DEFAULT NULL,
                `FATHER` VARCHAR(13) DEFAULT NULL,
                `MOTHER` VARCHAR(13) DEFAULT NULL,
                `COUPLE` VARCHAR(13) DEFAULT NULL,
                `VSTATUS` VARCHAR(1) DEFAULT NULL,
                `MOVEIN` DATE DEFAULT NULL,
                `DISCHARGE` VARCHAR(1) DEFAULT NULL,
                `DDISCHARGE` DATE DEFAULT NULL,
                `ABOGROUP` VARCHAR(1) DEFAULT NULL,
                `RHGROUP` VARCHAR(1) DEFAULT NULL,
                `LABOR` VARCHAR(2) DEFAULT NULL,
                `PASSPORT` VARCHAR(8) DEFAULT NULL,
                `TYPEAREA` VARCHAR(1) NOT NULL DEFAULT '',
                `D_UPDATE` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
                `CHECK_HOSP` VARCHAR(5) NOT NULL DEFAULT '',
                `CHECK_TYPEAREA` VARCHAR(1) NOT NULL DEFAULT '',
                `VHID` VARCHAR(8) DEFAULT NULL,
                `CHECK_VHID` VARCHAR(8) DEFAULT NULL,
                `MAININSCL` VARCHAR(5) DEFAULT NULL,
                `INSCL` VARCHAR(5) DEFAULT NULL,
                `LAT` VARCHAR(100) DEFAULT NULL,
                `LNG` VARCHAR(100) DEFAULT NULL,
                `ADDRESS` VARCHAR(255) DEFAULT NULL,
                 ERROR_CODE VARCHAR(255) DEFAULT NULL,
                
                #PRIMARY KEY (`HOSPCODE`,`PID`),
                KEY `HOSPCODE` (`HOSPCODE`),
                KEY `CID` (`CID`),
                KEY `PID` (`PID`),
                KEY `TYPEAREA` (`TYPEAREA`),
                KEY `CHECK_TYPEAREA` (`CHECK_TYPEAREA`),
                KEY `LABOR` (`LABOR`),
                KEY `NATION` (`NATION`),
                KEY `BIRTH` (`BIRTH`)
              ) ENGINE=MYISAM DEFAULT CHARSET=utf8;
              
              ALTER TABLE t_person DISABLE KEYS;  
              
  OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
    IF NOT done THEN
            SET @output = CONCAT("/*t-person-",db,"*/INSERT INTO t_person SELECT '",db,"' AS hospcode,
                    cid,
                    p.person_id as pid,
                    p.house_id as hid,
                    pname as prename,
                    fname as name,
                    lname,
                    patient_hn as hn,
                    sex,
                    birthdate as birth,
                    marrystatus as mstatus,
                    occupation as occupation_old,
                    null as occupation_new,
                    citizenship as race,
                    nationality as nation,
                    religion,
                    education,
                    null as fstatus,
                    #father_cid as father,
                    #mother_cid as mother,
                    null as father,
                    null as mother,
                    null as couple,
                    null as vstatus,
                    #movein_date as movein,
                    null as movein,
                    person_discharge_id as discharge,
                    discharge_date as ddischarge,
                    null as abogroup,
                    null as rhgroup,
                    l.nhso_code as labor,
                    null as passport,
                    house_regist_type_id as typearea,
                    p.last_update as d_update,
                    '",db,"' as check_hosp,
                    house_regist_type_id as check_typearea,
                    IF(village_code IS NOT NULL,village_code,NULL)  as vhid,
                    IF(village_code IS NOT NULL,village_code,NULL)  as check_vhid,
                    pttype_hospmain as maininscl,
                    null as inscl,
                    ifnull(h.latitude,null) as lat,
                    ifnull(h.longitude,null) as lng,
                    CONVERT(concat(h.address,' หมู่ ',village_moo,' ',v.village_name) USING utf8) as address,
                    null as error_code
                    FROM dw_",db,".person p 
                    LEFT OUTER JOIN dw_",db,".person_labor_type l ON p.person_labor_type_id = l.person_labor_type_id
                    LEFT OUTER JOIN dw_",db,".house h ON p.house_id = h.house_id
                    LEFT OUTER JOIN dw_",db,".village v ON v.village_id = h.village_id
            
            ");            
	
	PREPARE output FROM @output;
	EXECUTE output;
     END IF;
  UNTIL done END REPEAT;
  CLOSE appDBs;			
				
ALTER TABLE t_person ENABLE KEYS;
update t_person 
SET nation = 99 
WHERE 1#typearea IN (1,3)
AND (nation = '' OR nation IS NULL)
AND discharge = 9;
UPDATE t_person t,chospital h
			SET t.vhid=CONCAT(h.provcode,h.distcode,h.subdistcode,SUBSTR(CONCAT('00',h.mu),-2))
			,t.check_vhid=CONCAT(h.provcode,h.distcode,h.subdistcode,SUBSTR(CONCAT('00',h.mu),-2))
WHERE t.hospcode=h.hoscode AND (t.vhid IS NULL OR t.check_vhid IS NULL OR t.vhid = '' OR t.check_vhid = '' OR LENGTH(TRIM(t.vhid)) < 8 OR LENGTH(TRIM(t.check_vhid)) < 8 OR t.vhid = '00000000' OR t.check_vhid = '00000000') ;
UPDATE t_person 
SET error_code =IF(ISNULL(error_code),'PE0001',CONCAT(error_code,',','PE0001') ) 
WHERE  NATION IN(99) AND DISCHARGE IN(9) AND (cid IS NULL OR LENGTH(TRIM(cid))=0);
UPDATE t_person p LEFT JOIN chospital h ON p.HOSPCODE=h.hoscode 
SET error_code =IF(ISNULL(error_code),'PE0002',CONCAT(error_code,',','PE0002') ) 
WHERE  NATION IN(99) AND DISCHARGE IN(9) AND (
SUBSTR(cid,1,5) IN(hoscode)
OR
CONCAT('0',SUBSTR(cid,2,5)) = CONCAT('0',hoscode)
);
UPDATE t_person 
SET error_code =IF(ISNULL(error_code),'PE0003',CONCAT(error_code,',','PE0003') ) 
WHERE  NATION IN(99) AND DISCHARGE IN(9) AND mod11(cid)=0 AND (cid IS NOT NULL OR LENGTH(TRIM(cid)) >0 );
UPDATE t_person p LEFT JOIN chospital h ON p.HOSPCODE=h.hoscode 
SET error_code =IF(ISNULL(error_code),'PE0004',CONCAT(error_code,',','PE0004') ) 
WHERE  NATION IN(99) AND DISCHARGE IN(9) 
AND (`NAME`  LIKE '%เธเธกเนเธฒ%' OR LNAME  LIKE '%เธเธกเนเธฒ%' 
					OR `NAME`  LIKE '%เธฅเธฒเธง%' OR LNAME  LIKE '%เธฅเธฒเธง%'  
				 OR `NAME`  LIKE '%เนเธเธกเธฃ%' OR LNAME  LIKE '%เนเธเธกเธฃ%'  
				 OR `NAME`  LIKE '%เธเธฑเธกเธเธนเธเธฒ%' OR LNAME  LIKE '%เธเธฑเธกเธเธนเธเธฒ%'  
				 OR UPPER(`NAME`) REGEXP '^[A-Z]' OR UPPER(LNAME) REGEXP '^[A-Z]' 
				)
AND (
SUBSTR(cid,1,5) IN(hoscode)
OR
CONCAT('0',SUBSTR(cid,2,5)) = CONCAT('0',hoscode)
);
/*
UPDATE t_person p LEFT JOIN home h ON p.HOSPCODE=h.HOSPCODE AND p.HID=h.HID
SET error_code =IF(ISNULL(error_code),'PE0005',CONCAT(error_code,',','PE0005') ) 
WHERE   DISCHARGE IN(9) AND TYPEAREA IN(1,3) AND h.HOSPCODE IS NULL;
*/
UPDATE t_person 
SET error_code =IF(ISNULL(error_code),'PE0006',CONCAT(error_code,',','PE0006') ) 
WHERE   DISCHARGE IN(9) AND (sex NOT IN(1,2) OR sex IS NULL);
UPDATE t_person 
SET error_code =IF(ISNULL(error_code),'PE0007',CONCAT(error_code,',','PE0007') ) 
WHERE   DISCHARGE IN(9) AND TYPEAREA IN(1,3)  
AND ( TIMESTAMPDIFF(YEAR,BIRTH,NOW()) >100  
	OR BIRTH > NOW()  );
UPDATE t_person 
SET error_code =IF(ISNULL(error_code),'PE0008',CONCAT(error_code,',','PE0008') ) 
WHERE   DISCHARGE IN(9) AND NATION NOT IN(99) AND (LENGTH(TRIM(LABOR)) =0   OR LABOR IS NULL);
UPDATE t_person p LEFT JOIN chospital h ON p.HOSPCODE=h.hoscode 
SET error_code =IF(ISNULL(error_code),'PE0009',CONCAT(error_code,',','PE0009') ) 
WHERE   h.hoscode IS NULL;
/*t_person_cid*/
DROP TABLE IF EXISTS t_person_cid;
CREATE TABLE t_person_cid (
  HOSPCODE VARCHAR(5) NOT NULL DEFAULT '',
  CID VARCHAR(13) NOT NULL,
  PID VARCHAR(15) NOT NULL DEFAULT '',
  HID VARCHAR(14) DEFAULT NULL,
  PRENAME VARCHAR(3) NOT NULL DEFAULT '',
  NAME VARCHAR(50) NOT NULL DEFAULT '',
  LNAME VARCHAR(50) NOT NULL DEFAULT '',
  HN VARCHAR(15) DEFAULT NULL,
  SEX VARCHAR(1) NOT NULL DEFAULT '',
  BIRTH DATE NOT NULL DEFAULT '0000-00-00',
  MSTATUS CHAR(1) DEFAULT NULL,
  OCCUPATION_OLD VARCHAR(3) DEFAULT NULL,
  OCCUPATION_NEW VARCHAR(4) DEFAULT NULL,
  RACE VARCHAR(3) DEFAULT NULL,
  NATION VARCHAR(3) NOT NULL DEFAULT '',
  RELIGION VARCHAR(2) DEFAULT NULL,
  EDUCATION VARCHAR(2) DEFAULT NULL,
  FSTATUS VARCHAR(1) DEFAULT NULL,
  FATHER VARCHAR(13) DEFAULT NULL,
  MOTHER VARCHAR(13) DEFAULT NULL,
  COUPLE VARCHAR(13) DEFAULT NULL,
  VSTATUS VARCHAR(1) DEFAULT NULL,
  MOVEIN DATE DEFAULT NULL,
  DISCHARGE VARCHAR(1) DEFAULT NULL,
  DDISCHARGE DATE DEFAULT NULL,
  ABOGROUP VARCHAR(1) DEFAULT NULL,
  RHGROUP VARCHAR(1) DEFAULT NULL,
  LABOR VARCHAR(2) DEFAULT NULL,
  PASSPORT VARCHAR(8) DEFAULT NULL,
  TYPEAREA VARCHAR(1) NOT NULL DEFAULT '',
  D_UPDATE DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  check_hosp VARCHAR(5) NOT NULL DEFAULT '',
  check_typearea VARCHAR(1) NOT NULL DEFAULT '',
  vhid VARCHAR(8) DEFAULT NULL,
  check_vhid VARCHAR(8) DEFAULT NULL,
  maininscl VARCHAR(5) DEFAULT NULL,
  inscl VARCHAR(5) DEFAULT NULL,
  age_y INT(3) DEFAULT NULL,
  PRIMARY KEY (CID),
  KEY HOSPCODE_PID (HOSPCODE,PID),
  KEY HOSPCODE (HOSPCODE),
  KEY PID (PID),
  KEY TYPEAREA (TYPEAREA),
  KEY vhid (vhid),
  KEY check_vhid (check_vhid),
  KEY check_typearea (check_typearea),
  KEY check_hosp (check_hosp),
  KEY BIRTH (BIRTH),
  KEY LABOR (LABOR),
  KEY NATION (NATION)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO t_person_cid
(
		SELECT SQL_BIG_RESULT 
				p.HOSPCODE,p.CID,p.PID,p.HID,p.PRENAME,p.NAME,p.LNAME,p.HN,p.SEX,p.BIRTH
				,p.MSTATUS,p.OCCUPATION_OLD,p.OCCUPATION_NEW,p.RACE,p.NATION,p.RELIGION,p.EDUCATION,p.FSTATUS
				,p.FATHER,p.MOTHER,p.COUPLE,p.VSTATUS,p.MOVEIN,p.DISCHARGE
				,p.DDISCHARGE,p.ABOGROUP,p.RHGROUP,p.LABOR,p.PASSPORT,p.TYPEAREA,p.D_UPDATE,
				p.HOSPCODE AS check_hosp	,p.TYPEAREA AS check_typearea ,vhid,check_vhid,maininscl,inscl
				,age(DATE_FORMAT(CONCAT(@b_year,'0101'),'%Y%m%d'),birth,'y') AS age_y
		FROM
			t_person p
		WHERE LENGTH(TRIM(p.cid))=13 AND p.TYPEAREA IN('1','3')
		ORDER BY  p.D_UPDATE DESC ,p.TYPEAREA ASC
);
INSERT IGNORE INTO t_person_cid
(
		SELECT SQL_BIG_RESULT 
				p.HOSPCODE,p.CID,p.PID,p.HID,p.PRENAME,p.NAME,p.LNAME,p.HN,p.SEX,p.BIRTH
				,p.MSTATUS,p.OCCUPATION_OLD,p.OCCUPATION_NEW,p.RACE,p.NATION,p.RELIGION,p.EDUCATION,p.FSTATUS
				,p.FATHER,p.MOTHER,p.COUPLE,p.VSTATUS,p.MOVEIN,p.DISCHARGE
				,p.DDISCHARGE,p.ABOGROUP,p.RHGROUP,p.LABOR,p.PASSPORT,p.TYPEAREA,p.D_UPDATE,
				p.HOSPCODE AS check_hosp	,p.TYPEAREA AS check_typearea ,vhid,check_vhid,maininscl,inscl
				,age(DATE_FORMAT(CONCAT(@b_year,'0701'),'%Y%m%d'),birth,'y') AS age_y
		FROM
			t_person p
		WHERE LENGTH(TRIM(p.cid))= 13 AND p.TYPEAREA IN('2','4','5')
		ORDER BY p.TYPEAREA ASC
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_person_anc` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_person_anc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_person_anc`()
BEGIN
    SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
    SET	@id:= '3';
    SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
	SET @date_3:=CONCAT(@b_year-2,'1001');
    #-------------------------------------------------------------------------------------------------------------------------------------------------------
    DROP TABLE IF EXISTS tmp_anc;

	CREATE TABLE IF NOT EXISTS tmp_anc (
	KEY (cid),
	KEY (hospcode,pid),
	KEY (date_serv),
	KEY (ga),
	KEY (gravida)
	)ENGINE=MyISAM  AS(
	SELECT  SQL_BIG_RESULT 
            #tt.HOSPCODE,tt.PID,tt.SEQ,tt.DATE_SERV,tt.GRAVIDA,tt.ancno,tt.GA,tt.ANCRESULT,tt.ANCPLACE,tt.PROVIDER,tt.D_UPDATE,pe.cid,pe.nation,pe.birth,pe.sex
		    tt.hospcode,
		    tt.pid,
		    tt.cid,
		    labor_date AS birth,
            service_date AS date_serv,
		    '2' AS sex,
		    nation,
		    preg_no AS gravida,
            precare_hospcode AS ancplace,
		    pa_week AS ga
		FROM
		    report_service_anc tt
		LEFT JOIN t_person as pe ON tt.cid = pe.cid 
		WHERE
		    service_date BETWEEN @date_3 AND @end_d
	);
    
    DROP TABLE IF EXISTS tmp_labor;
	CREATE TABLE IF NOT EXISTS tmp_labor (
	KEY (cid),
	KEY (hospcode,pid),
	KEY (bdate)
	) ENGINE=MyISAM  AS(
	SELECT  SQL_BIG_RESULT
		    pe.hospcode,
		    pe.pid,
		    tt.cid,
		    labor_date AS bdate,
            pe.birth,
			bresult,
            labour_hospcode AS bhosp,
            if((bresult in('O021','O364') OR SUBSTR(bresult,1,3) in('O03','O06','O08')) and (labour_type is null OR labour_type = '') ,6,labour_type) as btype,
		    preg_no AS gravida,
            age(labor_date,pe.birth,'y') as age_y
		FROM
		    report_person_anc tt
		LEFT JOIN t_person pe ON tt.regplace=pe.hospcode AND tt.pid=pe.pid 
		WHERE
		    labor_date BETWEEN @date_3 AND @end_d

	);
    
    DROP TABLE IF EXISTS t_labor;
	CREATE TABLE IF NOT EXISTS t_labor (
	PRIMARY KEY (CID,BDATE)
	) ENGINE=MyISAM  IGNORE AS
	SELECT l.* FROM tmp_labor l INNER JOIN chospital h ON l.hospcode=h.hoscode WHERE  h.hostype in(5,6,7,11);

	INSERT IGNORE t_labor (SELECT * FROM tmp_labor);
    
    
    DROP TABLE IF EXISTS t_person_anc;

CREATE TABLE IF NOT EXISTS t_person_anc(
		id int(15) NOT NULL AUTO_INCREMENT
		,hospcode varchar(5) NOT NULL
	  ,pid varchar(15) NOT NULL 
		,typearea varchar(1) NOT NULL 
		,cid VARCHAR(13) NOT NULL
		,birth date
		,sex VARCHAR(1) DEFAULT NULL 
		,nation VARCHAR(3) DEFAULT NULL 
		,occupat_new VARCHAR(4) DEFAULT NULL 
		,gravida VARCHAR(2) DEFAULT NULL 
		,bdate date
		,bhosp VARCHAR(5) DEFAULT NULL
		,input_bhosp VARCHAR(5) DEFAULT NULL 
		,g1_ga VARCHAR(2) DEFAULT NULL 
		,g1_date date
		,g1_hospcode VARCHAR(5) DEFAULT NULL 
		,g1_input_hosp VARCHAR(5) DEFAULT NULL 
		
		,g2_ga VARCHAR(2) DEFAULT NULL 
		,g2_date date
		,g2_hospcode VARCHAR(5) DEFAULT NULL 
		,g2_input_hosp VARCHAR(5) DEFAULT NULL 

		,g3_ga VARCHAR(2) DEFAULT NULL 
		,g3_date date
		,g3_hospcode VARCHAR(5) DEFAULT NULL 
		,g3_input_hosp VARCHAR(5) DEFAULT NULL 

		,g4_ga VARCHAR(2) DEFAULT NULL 
		,g4_date date
		,g4_hospcode VARCHAR(5) DEFAULT NULL 
		,g4_input_hosp VARCHAR(5) DEFAULT NULL 

		,g5_ga VARCHAR(2) DEFAULT NULL 
		,g5_date date
		,g5_hospcode VARCHAR(5) DEFAULT NULL 
		,g5_input_hosp VARCHAR(5) DEFAULT NULL 
		,lookup VARCHAR(20) DEFAULT NULL
        
		,lookup_update DATE
	,PRIMARY KEY (id)
	,KEY cid (cid)
,KEY  (hospcode)
,KEY  (pid)
,KEY  (typearea)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

TRUNCATE TABLE t_person_anc;

/*GROUP BY CID Gravida */
INSERT IGNORE INTO t_person_anc
(
hospcode,pid,typearea,cid,birth,sex,nation,occupat_new,gravida
)
(
SELECT	pe.hospcode,pe.pid,pe.check_typearea,pe.cid,pe.BIRTH,pe.SEX,pe.NATION,pe.OCCUPATION_NEW,tt.GRAVIDA
FROM		tmp_anc as tt LEFT JOIN t_person_cid as pe ON tt.CID=pe.CID 
WHERE	 tt.DATE_SERV BETWEEN @date_3 AND @end_d AND LENGTH(pe.cid) = 13
GROUP BY pe.CID,tt.GRAVIDA
ORDER BY  pe.CID
);

UPDATE t_person_anc a INNER JOIN
	(
	SELECT 			cid,date_serv ,gravida,ancplace,ga,hospcode
	FROM		tmp_anc	WHERE			ga <= 12 
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.g1_ga= g.ga 		,a.g1_date=g.date_serv ,a.g1_hospcode =g.ancplace 			,a.g1_input_hosp= g.hospcode;

UPDATE t_person_anc a INNER JOIN
	(
	SELECT 	cid,date_serv ,gravida,ancplace,ga,hospcode
	FROM		tmp_anc	WHERE		ga BETWEEN 16 AND 20 
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.g2_ga= g.ga  ,a.g2_date=g.date_serv 	,a.g2_hospcode =g.ancplace 		,a.g2_input_hosp= g.hospcode;

UPDATE t_person_anc a INNER JOIN
	(
	SELECT 	cid,date_serv ,gravida,ancplace,ga,hospcode
	FROM		tmp_anc	WHERE		ga BETWEEN 24 AND 28 
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.g3_ga= g.ga  	,a.g3_date=g.date_serv 	,a.g3_hospcode =g.ancplace 		,a.g3_input_hosp= g.hospcode;

UPDATE t_person_anc a INNER JOIN
	(
	SELECT 	cid,date_serv ,gravida,ancplace,ga,hospcode
	FROM		tmp_anc	WHERE		 ga BETWEEN 30 AND 34 
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.g4_ga= g.ga 	,a.g4_date=g.date_serv 		,a.g4_hospcode =g.ancplace 		,a.g4_input_hosp= g.hospcode;

UPDATE t_person_anc a INNER JOIN
	(	
  SELECT 			cid,date_serv ,gravida,ancplace,ga,hospcode
	FROM		tmp_anc	WHERE			ga BETWEEN 36 AND 40 
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.g5_ga= g.ga  	,a.g5_date=g.date_serv 		,a.g5_hospcode =g.ancplace 		,a.g5_input_hosp= g.hospcode;

UPDATE t_person_anc a INNER JOIN
	(
	SELECT cid,bdate,gravida,bhosp,hospcode 	FROM	tmp_labor l INNER JOIN chospital h ON l.hospcode=h.hoscode AND h.hostype IN(5,6,7,11)
	WHERE	bdate BETWEEN @start_d AND @end_d AND  BHOSP=HOSPCODE
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.bdate=g.bdate	,a.bhosp=g.bhosp	,a.input_bhosp=g.hospcode;

UPDATE t_person_anc a INNER JOIN
	(
	SELECT cid,bdate,gravida,bhosp,hospcode 	FROM	tmp_labor
	WHERE	bdate BETWEEN @start_d AND @end_d 
	GROUP BY cid,gravida
	)	 as g ON a.cid=g.cid AND g.gravida=a.gravida
SET a.bdate=g.bdate	,a.bhosp=g.bhosp	,a.input_bhosp=g.hospcode
WHERE ISNULL(a.bdate);

	#-------------------------------------------------------------------------------------------------------------------------------------------------------
	
/*
    DROP TABLE IF EXISTS t_person_anc;
	CREATE TABLE IF NOT EXISTS t_person_anc(
			id INT(15) NOT NULL AUTO_INCREMENT
			,hospcode VARCHAR(5) NOT NULL
			,pid VARCHAR(15) NOT NULL 
			,typearea VARCHAR(1) NOT NULL 
			,cid VARCHAR(13) NOT NULL
			,birth DATE
			,sex VARCHAR(1) DEFAULT NULL 
			,nation VARCHAR(3) DEFAULT NULL 
			,occupat_new VARCHAR(4) DEFAULT NULL 
			,gravida VARCHAR(2) DEFAULT NULL 
			,bdate DATE
			,bhosp VARCHAR(5) DEFAULT NULL
			,input_bhosp VARCHAR(5) DEFAULT NULL 
			,g1_ga VARCHAR(2) DEFAULT NULL 
			,g1_date DATE
			,g1_hospcode VARCHAR(5) DEFAULT NULL 
			,g1_input_hosp VARCHAR(5) DEFAULT NULL 
			
			,g2_ga VARCHAR(2) DEFAULT NULL 
			,g2_date DATE
			,g2_hospcode VARCHAR(5) DEFAULT NULL 
			,g2_input_hosp VARCHAR(5) DEFAULT NULL 
			,g3_ga VARCHAR(2) DEFAULT NULL 
			,g3_date DATE
			,g3_hospcode VARCHAR(5) DEFAULT NULL 
			,g3_input_hosp VARCHAR(5) DEFAULT NULL 
			,g4_ga VARCHAR(2) DEFAULT NULL 
			,g4_date DATE
			,g4_hospcode VARCHAR(5) DEFAULT NULL 
			,g4_input_hosp VARCHAR(5) DEFAULT NULL 
			,g5_ga VARCHAR(2) DEFAULT NULL 
			,g5_date DATE
			,g5_hospcode VARCHAR(5) DEFAULT NULL 
			,g5_input_hosp VARCHAR(5) DEFAULT NULL 
			,lookup VARCHAR(20) DEFAULT NULL
			,lookup_update DATE
		
		,PRIMARY KEY (id)
		,KEY cid (cid)
	,KEY  (hospcode)
	,KEY  (pid)
	,KEY  (typearea)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8;
	TRUNCATE TABLE t_person_anc;
	
	
	INSERT IGNORE INTO t_person_anc
	(
	hospcode,pid,typearea,cid,birth,sex,nation,occupat_new,gravida
	)
	(
		SELECT 
		    pe.hospcode,
		    pe.pid,
		    pe.check_typearea,
		    pe.cid,
		    labor_date AS  birth,
		    '2' AS sex,
		    nationality AS nation,
		    '' AS occupation_new,
		    preg_no AS gravida
		FROM
		    report_person_anc tt
		LEFT JOIN t_person_cid as pe ON tt.cid = pe.cid 
		WHERE
		    labor_date BETWEEN @date_3 AND @end_d
		GROUP BY pe.cid,preg_no
		ORDER BY pe.cid
	);
	
	UPDATE t_person_anc a
		INNER JOIN
	    (SELECT 
		cid, date_serv, gravida, ancplace, ga, hospcode
	    FROM
		(SELECT 
		cid,
		    service_date AS date_serv,
		    preg_no AS gravida,
		    precare_hospcode AS ancplace,
		    pa_week AS ga,
		    hospcode
	    FROM
		report_service_anc
	    WHERE
		service_date BETWEEN @date_3 AND @end_d) tmp
	    WHERE
		ga <= 12
	    GROUP BY cid , gravida) AS g ON a.cid = g.cid AND g.gravida = a.gravida 
	SET 
	    a.g1_ga = g.ga,
	    a.g1_date = g.date_serv,
	    a.g1_hospcode = g.ancplace,
	    a.g1_input_hosp = g.hospcode;
	    
	    
	UPDATE t_person_anc a
		INNER JOIN
	    (SELECT 
		cid, date_serv, gravida, ancplace, ga, hospcode
	    FROM
		(SELECT 
		cid,
		    service_date AS date_serv,
		    preg_no AS gravida,
		    precare_hospcode AS ancplace,
		    pa_week AS ga,
		    hospcode
	    FROM
		report_service_anc
	    WHERE
		service_date BETWEEN @date_3 AND @end_d) tmp
	    WHERE
		ga BETWEEN 13 AND 20 
	    GROUP BY cid , gravida) AS g ON a.cid = g.cid AND g.gravida = a.gravida 
	SET 
	    a.g2_ga = g.ga,
	    a.g2_date = g.date_serv,
	    a.g2_hospcode = g.ancplace,
	    a.g2_input_hosp = g.hospcode;
	    
	    
	    UPDATE t_person_anc a
		INNER JOIN
	    (SELECT 
		cid, date_serv, gravida, ancplace, ga, hospcode
	    FROM
		(SELECT 
		cid,
		    service_date AS date_serv,
		    preg_no AS gravida,
		    precare_hospcode AS ancplace,
		    pa_week AS ga,
		    hospcode
	    FROM
		report_service_anc
	    WHERE
		service_date BETWEEN @date_3 AND @end_d) tmp
	    WHERE
		ga BETWEEN 21 AND 28 
	    GROUP BY cid , gravida) AS g ON a.cid = g.cid AND g.gravida = a.gravida 
	SET 
	    a.g3_ga = g.ga,
	    a.g3_date = g.date_serv,
	    a.g3_hospcode = g.ancplace,
	    a.g3_input_hosp = g.hospcode;
	    
	    UPDATE t_person_anc a
		INNER JOIN
	    (SELECT 
		cid, date_serv, gravida, ancplace, ga, hospcode
	    FROM
		(SELECT 
		cid,
		    service_date AS date_serv,
		    preg_no AS gravida,
		    precare_hospcode AS ancplace,
		    pa_week AS ga,
		    hospcode
	    FROM
		report_service_anc
	    WHERE
		service_date BETWEEN @date_3 AND @end_d) tmp
	    WHERE
		 ga BETWEEN 29 AND 35 
	    GROUP BY cid , gravida) AS g ON a.cid = g.cid AND g.gravida = a.gravida 
	SET 
	    a.g4_ga = g.ga,
	    a.g4_date = g.date_serv,
	    a.g4_hospcode = g.ancplace,
	    a.g4_input_hosp = g.hospcode;
	    
	    UPDATE t_person_anc a
		INNER JOIN
	    (SELECT 
		cid, date_serv, gravida, ancplace, ga, hospcode
	    FROM
		(SELECT 
		cid,
		    service_date AS date_serv,
		    preg_no AS gravida,
		    precare_hospcode AS ancplace,
		    pa_week AS ga,
		    hospcode
	    FROM
		report_service_anc
	    WHERE
		service_date BETWEEN @date_3 AND @end_d) tmp
	    WHERE
		ga BETWEEN 36 AND 40 
	    GROUP BY cid , gravida) AS g ON a.cid = g.cid AND g.gravida = a.gravida 
	SET 
	    a.g5_ga = g.ga,
	    a.g5_date = g.date_serv,
	    a.g5_hospcode = g.ancplace,
	    a.g5_input_hosp = g.hospcode;
	    
	    UPDATE t_person_anc a
		INNER JOIN
		    (SELECT 
			regplace AS hospcode,
			    pid,
			    preg_no AS gravida,
			    labor_date AS bdate,
			    labour_hospcode AS bhosp,
			    cid,
			    AGE(labor_date, birthdate, 'y') AS age_y
		    FROM
			report_person_anc
		    WHERE
			labor_date BETWEEN @date_3 AND @end_d
		    GROUP BY cid , preg_no) AS g ON a.cid = g.cid AND g.gravida = a.gravida 
		SET 
		    a.bdate = g.bdate,
		    a.bhosp = g.bhosp,
		    a.input_bhosp = g.hospcode;
		    
	
CREATE TABLE IF NOT EXISTS ws_kpi_anc12(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(7) DEFAULT 0,
result int(7) DEFAULT 0,
target1 int(7) DEFAULT 0,
result1 int(7) DEFAULT 0,
target2 int(7) DEFAULT 0,
result2 int(7) DEFAULT 0,
target3 int(7) DEFAULT 0,
result3 int(7) DEFAULT 0,
target4 int(7) DEFAULT 0,
result4 int(7) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELETE FROM ws_kpi_anc12 WHERE id=@id AND b_year=(@b_year+543);
INSERT IGNORE INTO ws_kpi_anc12
(SELECT 
    @id,
    tb1.hospcode,
    CONCAT(h.provcode,
            SUBSTR(CONCAT('00', h.distcode), - 2),
            SUBSTR(CONCAT('00', h.subdistcode), - 2),
            SUBSTR(CONCAT('00', h.mu), - 2)) AS areacode,
    @send,
    DATE_FORMAT(NOW(), '%Y%m%d%H%i') AS d_com,
    @b_year + 543,
    COUNT(tb1.hospcode) btotal,
    SUM(IF(ROUND(tb1.g1_ga) <= 12, 1, 0)) atotal,
    SUM(IF(tb1.m BETWEEN '10' AND '12', 1, 0)) b1,
    SUM(IF(tb1.m BETWEEN '10' AND '12'
            AND ROUND(tb1.g1_ga) <= 12,
        1,
        0)) a1,
    SUM(IF(tb1.m BETWEEN '01' AND '03', 1, 0)) b2,
    SUM(IF(tb1.m BETWEEN '01' AND '03'
            AND ROUND(tb1.g1_ga) <= 12,
        1,
        0)) a2,
    SUM(IF(tb1.m BETWEEN '04' AND '06', 1, 0)) b3,
    SUM(IF(tb1.m BETWEEN '04' AND '06'
            AND ROUND(tb1.g1_ga) <= 12,
        1,
        0)) a3,
    SUM(IF(tb1.m BETWEEN '07' AND '09', 1, 0)) b4,
    SUM(IF(tb1.m BETWEEN '07' AND '09'
            AND ROUND(tb1.g1_ga) <= 12,
        1,
        0)) a4
FROM
    (SELECT 
        tb2.hospcode, tb2.cid, tb2.gravida, tb2.m, a.g1_ga
    FROM
        (SELECT 
        l.hospcode,
            l.cid,
            l.gravida,
            l.bdate,
            DATE_FORMAT(l.bdate, '%m') m
    FROM
        (SELECT 
    regplace AS hospcode,
    pid,
    preg_no AS gravida,
    labor_date AS bdate,
    labour_hospcode AS bhosp,
    cid,
    AGE(labor_date, birthdate, 'y') AS age_y
FROM
    report_person_anc
WHERE
    labor_date BETWEEN @date_3 AND @end_d
) l
    WHERE
        l.bdate BETWEEN @start_d AND @end_d
            AND l.hospcode = l.bhosp
    GROUP BY l.cid , l.gravida) tb2
    LEFT JOIN t_person_anc a ON tb2.cid = a.cid
        AND ROUND(tb2.gravida) = ROUND(a.gravida)
    GROUP BY tb2.hospcode , tb2.cid , tb2.gravida
    ORDER BY cid) tb1
        INNER JOIN
    chospital h ON tb1.hospcode = h.hoscode
WHERE
    h.provcode = @prov_c
GROUP BY tb1.hospcode);	  
  
	#DROP TABLE IF EXISTS s_anc;
CREATE TABLE IF NOT EXISTS ws_anc(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(7) DEFAULT 0,
result int(7) DEFAULT 0,
result10 int(7) DEFAULT 0,
result11 int(7) DEFAULT 0,
result12 int(7) DEFAULT 0,
result01 int(7) DEFAULT 0,
result02 int(7) DEFAULT 0,
result03 int(7) DEFAULT 0,
result04 int(7) DEFAULT 0,
result05 int(7) DEFAULT 0,
result06 int(7) DEFAULT 0,
result07 int(7) DEFAULT 0,
result08 int(7) DEFAULT 0,
result09 int(7) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELETE FROM ws_anc WHERE id=@id AND b_year=(@b_year+543);
INSERT IGNORE INTO ws_anc 
(
id,hospcode,areacode,flag_sent,date_com,b_year,target,result,result10,result11,result12,result01,result02,result03
,result04,result05,result06,result07,result08,result09
)
(
SELECT 
@id,t1.check_hosp,t1.areacode	,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(DISTINCT t1.cid) as target
,SUM(CASE WHEN 
t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year-1,'1001') AND CONCAT(@b_year-1,'1031')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result10'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year-1,'1101') AND CONCAT(@b_year-1,'1131')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result11'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year-1,'1201') AND CONCAT(@b_year-1,'1231')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result12'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0101') AND CONCAT(@b_year,'0131')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result01'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0201') AND CONCAT(@b_year,'0231')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result02'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0301') AND CONCAT(@b_year,'0331')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result03'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0401') AND CONCAT(@b_year,'0431')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result04'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0501') AND CONCAT(@b_year,'0531')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result05'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0601') AND CONCAT(@b_year,'0631')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result06'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0701') AND CONCAT(@b_year,'0731')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result07'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0801') AND CONCAT(@b_year,'0831')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result08'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0901') AND CONCAT(@b_year,'0931')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result09'
FROM
(
SELECT 
*
FROM
(SELECT
a.*,p.check_hosp,p.check_vhid as areacode
FROM
t_person_anc a
LEFT JOIN t_person_cid p ON a.cid=p.cid
WHERE
p.check_typearea in(1,3) AND p.DISCHARGE =9 
AND (a.bdate BETWEEN @start_d AND @end_d)
ORDER BY p.check_typearea
) as t3
GROUP BY t3.check_hosp,t3.cid
) as t1 
LEFT JOIN
(SELECT
*
FROM
(SELECT
a.*,p.check_hosp,p.check_vhid as areacode
FROM
t_person_anc a
LEFT JOIN t_person_cid p ON a.cid=p.cid
WHERE
p.check_typearea in(1,3) AND p.DISCHARGE =9 
AND (a.bdate BETWEEN @start_d AND @end_d) AND a.g1_date is not null 
AND a.g2_date is not null AND a.g3_date is not null AND a.g4_date is not null AND a.g5_date is not null
ORDER BY p.check_typearea
) as t4
GROUP BY t4.check_hosp,t4.cid
) as t2 ON t1.cid=t2.cid
LEFT JOIN chospital h ON t1.check_hosp=h.hoscode
WHERE h.provcode = @prov_c
GROUP BY t1.check_hosp,t1.areacode
);	   

*/


#รายชื่อ ANC ที่ต้องติดตาม
DROP TABLE IF EXISTS t_person_ancfu;
	CREATE TABLE IF NOT EXISTS t_person_ancfu(
			id INT(15) NOT NULL AUTO_INCREMENT
			,hospcode VARCHAR(5) NOT NULL
			,pid VARCHAR(15) NOT NULL 
			,typearea VARCHAR(1) NOT NULL 
			,cid VARCHAR(13) NOT NULL
			,birth DATE
            ,regdate DATE
			,g_regplace TEXT DEFAULT NULL 
            ,g_typearea TEXT DEFAULT NULL
            
            
			,sex VARCHAR(1) DEFAULT NULL 
			,nation VARCHAR(3) DEFAULT NULL 
			,occupat_new VARCHAR(4) DEFAULT NULL 
            
			,gravida VARCHAR(2) DEFAULT NULL 
			,bdate DATE
			,bhosp VARCHAR(5) DEFAULT NULL
			,input_bhosp VARCHAR(5) DEFAULT NULL 
            
			,g1_ga VARCHAR(2) DEFAULT NULL 
			,g1_date DATE
			,g1_hospcode VARCHAR(5) DEFAULT NULL 
			,g1_input_hosp VARCHAR(5) DEFAULT NULL 
			
			,g2_ga VARCHAR(2) DEFAULT NULL 
			,g2_date DATE
			,g2_hospcode VARCHAR(5) DEFAULT NULL 
			,g2_input_hosp VARCHAR(5) DEFAULT NULL 
			,g3_ga VARCHAR(2) DEFAULT NULL 
			,g3_date DATE
			,g3_hospcode VARCHAR(5) DEFAULT NULL 
			,g3_input_hosp VARCHAR(5) DEFAULT NULL 
			,g4_ga VARCHAR(2) DEFAULT NULL 
			,g4_date DATE
			,g4_hospcode VARCHAR(5) DEFAULT NULL 
			,g4_input_hosp VARCHAR(5) DEFAULT NULL 
			,g5_ga VARCHAR(2) DEFAULT NULL 
			,g5_date DATE
			,g5_hospcode VARCHAR(5) DEFAULT NULL 
			,g5_input_hosp VARCHAR(5) DEFAULT NULL 
            
		,PRIMARY KEY (id)
		,KEY cid (cid)
	,KEY  (hospcode)
	,KEY  (pid)
	,KEY  (typearea)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8;
	TRUNCATE TABLE t_person_ancfu;
	INSERT IGNORE INTO t_person_ancfu
	(
	hospcode,pid,typearea,cid,birth,regdate,sex,nation,occupat_new,gravida,g_regplace,g_typearea
	)
	(SELECT * FROM
(SELECT 
			p.hospcode,
            p.pid,
			check_typearea AS typearea,
		    a.cid,
		    a.labor_date AS birth,
            a.anc_register_date AS regdate,
		    '2' AS sex,
		    p.nation,
		    '' AS occupation_new,
		    a.preg_no AS gravida
            ,group_concat(a.regplace) as g_regplace
            ,group_concat(a.typearea) as g_typearea
		FROM
		    report_person_anc a
            LEFT JOIN t_person_cid p on p.cid = a.cid
		WHERE
		    (a.labor_date BETWEEN @start_d AND @end_d
            OR
            a.anc_register_date BETWEEN @start_d AND @end_d)
            #and p.nation = 99
            AND p.check_typearea in(1,3) 
            AND p.DISCHARGE = 9 
		GROUP BY a.cid,a.preg_no) t
        WHERE g_regplace not like concat('%',hospcode,'%')
	);
    
    	UPDATE t_person_ancfu a
		INNER JOIN t_person_anc g ON a.cid = g.cid AND g.gravida = a.gravida 
	SET 
		a.bdate = g.bdate,
		a.bhosp = g.bhosp,
		a.input_bhosp = g.input_bhosp,
        
		a.g1_ga = g.g1_ga,
	    a.g1_date = g.g1_date,
	    a.g1_hospcode = g.g1_hospcode,
	    a.g1_input_hosp = g.g1_input_hosp,
    
		a.g2_ga = g.g2_ga,
	    a.g2_date = g.g2_date,
	    a.g2_hospcode = g.g2_hospcode,
	    a.g2_input_hosp = g.g2_input_hosp,
    
		a.g3_ga = g.g3_ga,
	    a.g3_date = g.g3_date,
	    a.g3_hospcode = g.g3_hospcode,
	    a.g3_input_hosp = g.g3_input_hosp,
    
		a.g4_ga = g.g4_ga,
	    a.g4_date = g.g4_date,
	    a.g4_hospcode = g.g4_hospcode,
	    a.g4_input_hosp = g.g4_input_hosp,
        
	    a.g5_ga = g.g5_ga,
	    a.g5_date = g.g5_date,
	    a.g5_hospcode = g.g5_hospcode,
	    a.g5_input_hosp = g.g5_input_hosp;
        
        #HDC
		CALL ex_tperson_anc;
 
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_person_epi` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_person_epi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_person_epi`()
BEGIN
  SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1) ;
  SET @id := '4' ;
  SET @b_year := 
  (SELECT 
    yearprocess 
  FROM
    wmc_config 
  LIMIT 1) ;
  SET @start_d := concat(@b_year - 1, '1001') ;
  SET @end_d := concat(@b_year, '0930') ;
  SET @date_3 := concat(@b_year - 14, '1001') ;
  DROP TABLE IF EXISTS tmp_epi ;
  CREATE TABLE tmp_epi (
    KEY (cid)
    , KEY (hospcode, pid)
    , KEY (vaccinetype)
  ) ENGINE = MyISAM AS 
  (SELECT 
    SQL_BIG_RESULT tt.hospcode
    , tt.PID
    , NULL AS seq
    , service_date AS date_serv
    , vaccine_type AS vaccinetype
    , NULL AS vaccineplace
    , NULL AS provider
    , NULL AS d_update
    , cid 
  FROM
    report_epi tt 
  WHERE service_date BETWEEN @date_3 
    AND @end_d) ;
  DROP TABLE IF EXISTS tmp_bcg ;
  CREATE TABLE tmp_bcg (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('010') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_hbv1 ;
  CREATE TABLE tmp_hbv1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('041', '091', 'D51', 'H31') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_hbv2 ;
  CREATE TABLE tmp_hbv2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('042', '092', 'D52', 'H32') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_hbv3 ;
  CREATE TABLE tmp_hbv3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('043', '093', 'D53', 'H33') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opv1 ;
  CREATE TABLE tmp_opv1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('081', 'D31', 'D41', 'D51', 'I11') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opv2 ;
  CREATE TABLE tmp_opv2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('082', 'D32', 'D42', 'D52', 'I12') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opv3 ;
  CREATE TABLE tmp_opv3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('083', 'D33', 'D43', 'D53', 'I13') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opv4 ;
  CREATE TABLE tmp_opv4 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('084', 'D34', 'D44', 'D54', 'I14') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opv5 ;
  CREATE TABLE tmp_opv5 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('085', 'D35', 'D45', 'D55', 'I15') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opvs1 ;
  CREATE TABLE tmp_opvs1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('086') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opvs2 ;
  CREATE TABLE tmp_opvs2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('087') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_opvs3 ;
  CREATE TABLE tmp_opvs3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('088') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dtp1 ;
  CREATE TABLE tmp_dtp1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in (
      '031'
      , '091'
      , 'D11'
      , 'D21'
      , 'D31'
      , 'D41'
      , 'D51'
    ) 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dtp2 ;
  CREATE TABLE tmp_dtp2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in (
      '032'
      , '092'
      , 'D12'
      , 'D22'
      , 'D32'
      , 'D42'
      , 'D52'
    ) 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dtp3 ;
  CREATE TABLE tmp_dtp3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in (
      '033'
      , '093'
      , 'D13'
      , 'D23'
      , 'D33'
      , 'D43'
      , 'D53'
    ) 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dtp4 ;
  CREATE TABLE tmp_dtp4 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in (
      '034'
      , 'D14'
      , 'D24'
      , 'D34'
      , 'D44'
      , 'D54'
    ) 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dtp5 ;
  CREATE TABLE tmp_dtp5 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('035', 'D35', 'D45', 'D55') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_bcgs ;
  CREATE TABLE tmp_bcgs (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('011') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dts1 ;
  CREATE TABLE tmp_dts1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('021') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dts2 ;
  CREATE TABLE tmp_dts2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('022') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dts3 ;
  CREATE TABLE tmp_dts3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('023') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_dts4 ;
  CREATE TABLE tmp_dts4 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('024') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_je1 ;
  CREATE TABLE tmp_je1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('051') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_je2 ;
  CREATE TABLE tmp_je2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('052') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_je3 ;
  CREATE TABLE tmp_je3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('053') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_j11 ;
  CREATE TABLE tmp_j11 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('J11') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_j12 ;
  CREATE TABLE tmp_j12 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('J12') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_mmr1 ;
  CREATE TABLE tmp_mmr1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('061', 'M11') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_mmr2 ;
  CREATE TABLE tmp_mmr2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('073', 'M12') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_mmrs ;
  CREATE TABLE tmp_mmrs (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('072') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_hpv1 ;
  CREATE TABLE tmp_hpv1 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('H31') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_hpv2 ;
  CREATE TABLE tmp_hpv2 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('H32') 
  GROUP BY cid) ;
  DROP TABLE IF EXISTS tmp_hpv3 ;
  CREATE TABLE tmp_hpv3 (KEY (cid)) ENGINE = MyISAM AS 
  (SELECT 
    cid
    , DATE_SERV
    , VACCINEPLACE
    , hospcode 
  FROM
    tmp_epi 
  WHERE VACCINETYPE in ('H33') 
  GROUP BY cid) ;
  
  /*
  DROP TABLE IF EXISTS tmp_newborn ;
  CREATE TABLE tmp_newborn (
    KEY (cid)
    , KEY (hospcode, pid)
    , KEY (bweight)
  ) ENGINE = MyISAM AS 
  (SELECT 
    t.HOSPCODE
    , t.PID
    , t.MPID
    , t.GRAVIDA
    , t.GA
    , t.BDATE
    , t.BTIME
    , t.BPLACE
    , t.bhosp
    , t.BIRTHNO
    , t.btype
    , t.bdoctor
    , t.BWEIGHT
    , t.ASPHYXIA
    , t.VITK
    , t.TSH
    , t.TSHRESULT
    , t.D_UPDATE
    , pe.cid 
  FROM
    newborn t 
    LEFT JOIN t_person pe 
      ON t.HOSPCODE = pe.HOSPCODE 
      AND t.pid = pe.pid 
  WHERE t.bdate BETWEEN @date_3 
    AND @end_d 
  GROUP BY pe.cid) ;
  DROP TABLE IF EXISTS tmp_nutrition ;
  CREATE TABLE tmp_nutrition (
    KEY (cid)
    , KEY (hospcode, pid)
    , KEY (food, childdevelop)
  ) ENGINE = MyISAM AS 
  (SELECT 
    t.HOSPCODE
    , t.PID
    , t.SEQ
    , t.DATE_SERV
    , t.NUTRITIONPLACE
    , t.WEIGHT
    , t.HEIGHT
    , t.HEADCIRCUM
    , t.CHILDDEVELOP
    , t.FOOD
    , t.BOTTLE
    , t.PROVIDER
    , t.D_UPDATE
    , pe.cid 
  FROM
    nutrition t 
    LEFT JOIN t_person pe 
      ON t.HOSPCODE = pe.HOSPCODE 
      AND t.pid = pe.pid 
  WHERE t.date_serv BETWEEN @date_3 
    AND @end_d 
  GROUP BY pe.cid) ;
  */
  
  DROP TABLE IF EXISTS t_person_epi ;
  CREATE TABLE IF NOT EXISTS t_person_epi (
    id int (15) NOT NULL AUTO_INCREMENT
    , hospcode varchar (5) NOT NULL
    , pid varchar (15) NOT NULL
    , typearea varchar (1) NOT NULL
    , cid VARCHAR (13) NOT NULL
    , birth date
    , sex VARCHAR (1) DEFAULT NULL
    , nation VARCHAR (3) DEFAULT NULL
    , bweight int (4) DEFAULT 0
    , bw_input_hosp VARCHAR (5) DEFAULT NULL
    , food VARCHAR (1) DEFAULT NULL
    , food_date date
    , food_input_hosp VARCHAR (5) DEFAULT NULL
    , childdevelop VARCHAR (1) DEFAULT NULL
    , childdevelop_date date
    , childdevelop_input_hosp VARCHAR (5) DEFAULT NULL
    , bcg_date date
    , bcg_hospcode VARCHAR (5) DEFAULT NULL
    , bcg_input_hosp VARCHAR (5) DEFAULT NULL
    , hbv1_date date
    , hbv1_hospcode VARCHAR (5) DEFAULT NULL
    , hbv1_input_hosp VARCHAR (5) DEFAULT NULL
    , hbv2_date date
    , hbv2_hospcode VARCHAR (5) DEFAULT NULL
    , hbv2_input_hosp VARCHAR (5) DEFAULT NULL
    , hbv3_date date
    , hbv3_hospcode VARCHAR (5) DEFAULT NULL
    , hbv3_input_hosp VARCHAR (5) DEFAULT NULL
    , opv1_date date
    , opv1_hospcode VARCHAR (5) DEFAULT NULL
    , opv1_input_hosp VARCHAR (5) DEFAULT NULL
    , opv2_date date
    , opv2_hospcode VARCHAR (5) DEFAULT NULL
    , opv2_input_hosp VARCHAR (5) DEFAULT NULL
    , opv3_date date
    , opv3_hospcode VARCHAR (5) DEFAULT NULL
    , opv3_input_hosp VARCHAR (5) DEFAULT NULL
    , opv4_date date
    , opv4_hospcode VARCHAR (5) DEFAULT NULL
    , opv4_input_hosp VARCHAR (5) DEFAULT NULL
    , opv5_date date
    , opv5_hospcode VARCHAR (5) DEFAULT NULL
    , opv5_input_hosp VARCHAR (5) DEFAULT NULL
    , opvs1_date date
    , opvs1_hospcode VARCHAR (5) DEFAULT NULL
    , opvs1_input_hosp VARCHAR (5) DEFAULT NULL
    , opvs2_date date
    , opvs2_hospcode VARCHAR (5) DEFAULT NULL
    , opvs2_input_hosp VARCHAR (5) DEFAULT NULL
    , opvs3_date date
    , opvs3_hospcode VARCHAR (5) DEFAULT NULL
    , opvs3_input_hosp VARCHAR (5) DEFAULT NULL
    , dtp1_date date
    , dtp1_hospcode VARCHAR (5) DEFAULT NULL
    , dtp1_input_hosp VARCHAR (5) DEFAULT NULL
    , dtp2_date date
    , dtp2_hospcode VARCHAR (5) DEFAULT NULL
    , dtp2_input_hosp VARCHAR (5) DEFAULT NULL
    , dtp3_date date
    , dtp3_hospcode VARCHAR (5) DEFAULT NULL
    , dtp3_input_hosp VARCHAR (5) DEFAULT NULL
    , dtp4_date date
    , dtp4_hospcode VARCHAR (5) DEFAULT NULL
    , dtp4_input_hosp VARCHAR (5) DEFAULT NULL
    , dtp5_date date
    , dtp5_hospcode VARCHAR (5) DEFAULT NULL
    , dtp5_input_hosp VARCHAR (5) DEFAULT NULL
    , bcgs_date date
    , bcgs_hospcode VARCHAR (5) DEFAULT NULL
    , bcgs_input_hosp VARCHAR (5) DEFAULT NULL
    , dts1_date date
    , dts1_hospcode VARCHAR (5) DEFAULT NULL
    , dts1_input_hosp VARCHAR (5) DEFAULT NULL
    , dts2_date date
    , dts2_hospcode VARCHAR (5) DEFAULT NULL
    , dts2_input_hosp VARCHAR (5) DEFAULT NULL
    , dts3_date date
    , dts3_hospcode VARCHAR (5) DEFAULT NULL
    , dts3_input_hosp VARCHAR (5) DEFAULT NULL
    , dts4_date date
    , dts4_hospcode VARCHAR (5) DEFAULT NULL
    , dts4_input_hosp VARCHAR (5) DEFAULT NULL
    , je1_date date
    , je1_hospcode VARCHAR (5) DEFAULT NULL
    , je1_input_hosp VARCHAR (5) DEFAULT NULL
    , je2_date date
    , je2_hospcode VARCHAR (5) DEFAULT NULL
    , je2_input_hosp VARCHAR (5) DEFAULT NULL
    , je3_date date
    , je3_hospcode VARCHAR (5) DEFAULT NULL
    , je3_input_hosp VARCHAR (5) DEFAULT NULL
    , j11_date date
    , j11_hospcode VARCHAR (5) DEFAULT NULL
    , j11_input_hosp VARCHAR (5) DEFAULT NULL
    , j12_date date
    , j12_hospcode VARCHAR (5) DEFAULT NULL
    , j12_input_hosp VARCHAR (5) DEFAULT NULL
    , mmr1_date date
    , mmr1_hospcode VARCHAR (5) DEFAULT NULL
    , mmr1_input_hosp VARCHAR (5) DEFAULT NULL
    , mmr2_date date
    , mmr2_hospcode VARCHAR (5) DEFAULT NULL
    , mmr2_input_hosp VARCHAR (5) DEFAULT NULL
    , mmrs_date date
    , mmrs_hospcode VARCHAR (5) DEFAULT NULL
    , mmrs_input_hosp VARCHAR (5) DEFAULT NULL
    , hpv1_date date
    , hpv1_hospcode VARCHAR (5) DEFAULT NULL
    , hpv1_input_hosp VARCHAR (5) DEFAULT NULL
    , hpv2_date date
    , hpv2_hospcode VARCHAR (5) DEFAULT NULL
    , hpv2_input_hosp VARCHAR (5) DEFAULT NULL
    , hpv3_date date
    , hpv3_hospcode VARCHAR (5) DEFAULT NULL
    , hpv3_input_hosp VARCHAR (5) DEFAULT NULL
    , PRIMARY KEY (id)
    , KEY cid (cid)
    , KEY (hospcode)
    , KEY (typearea)
  ) ENGINE = MyISAM DEFAULT CHARSET = utf8 ;
  TRUNCATE TABLE t_person_epi ;
  INSERT INTO t_person_epi (
    hospcode
    , pid
    , typearea
    , cid
    , birth
    , sex
    , nation
    , bweight
    , bw_input_hosp
    , food
    , food_date
    , food_input_hosp
    , childdevelop
    , childdevelop_date
    , childdevelop_input_hosp
    , bcg_date
    , bcg_hospcode
    , bcg_input_hosp
    , hbv1_date
    , hbv1_hospcode
    , hbv1_input_hosp
    , hbv2_date
    , hbv2_hospcode
    , hbv2_input_hosp
    , hbv3_date
    , hbv3_hospcode
    , hbv3_input_hosp
    , opv1_date
    , opv1_hospcode
    , opv1_input_hosp
    , opv2_date
    , opv2_hospcode
    , opv2_input_hosp
    , opv3_date
    , opv3_hospcode
    , opv3_input_hosp
    , opv4_date
    , opv4_hospcode
    , opv4_input_hosp
    , opv5_date
    , opv5_hospcode
    , opv5_input_hosp
    , opvs1_date
    , opvs1_hospcode
    , opvs1_input_hosp
    , opvs2_date
    , opvs2_hospcode
    , opvs2_input_hosp
    , opvs3_date
    , opvs3_hospcode
    , opvs3_input_hosp
    , dtp1_date
    , dtp1_hospcode
    , dtp1_input_hosp
    , dtp2_date
    , dtp2_hospcode
    , dtp2_input_hosp
    , dtp3_date
    , dtp3_hospcode
    , dtp3_input_hosp
    , dtp4_date
    , dtp4_hospcode
    , dtp4_input_hosp
    , dtp5_date
    , dtp5_hospcode
    , dtp5_input_hosp
    , bcgs_date
    , bcgs_hospcode
    , bcgs_input_hosp
    , dts1_date
    , dts1_hospcode
    , dts1_input_hosp
    , dts2_date
    , dts2_hospcode
    , dts2_input_hosp
    , dts3_date
    , dts3_hospcode
    , dts3_input_hosp
    , dts4_date
    , dts4_hospcode
    , dts4_input_hosp
    , je1_date
    , je1_hospcode
    , je1_input_hosp
    , je2_date
    , je2_hospcode
    , je2_input_hosp
    , je3_date
    , je3_hospcode
    , je3_input_hosp
    , j11_date
    , j11_hospcode
    , j11_input_hosp
    , j12_date
    , j12_hospcode
    , j12_input_hosp
    , mmr1_date
    , mmr1_hospcode
    , mmr1_input_hosp
    , mmr2_date
    , mmr2_hospcode
    , mmr2_input_hosp
    , mmrs_date
    , mmrs_hospcode
    , mmrs_input_hosp
    , hpv1_date
    , hpv1_hospcode
    , hpv1_input_hosp
    , hpv2_date
    , hpv2_hospcode
    , hpv2_input_hosp
    , hpv3_date
    , hpv3_hospcode
    , hpv3_input_hosp
  ) 
  (SELECT 
    p.check_hosp
    , p.pid
    , p.check_typearea
    , p.cid
    , p.birth
    , p.sex
    , p.nation
    , null#n.bweight
    , null#n.HOSPCODE
    , null#nu.food
    , null#nu.DATE_SERV
    , null#nu.HOSPCODE
    , null#nu.childdevelop
    , null#nu.DATE_SERV
    , null#nu.HOSPCODE
    , b.date_serv
    , b.vaccineplace
    , b.hospcode
    , hbv1.date_serv
    , hbv1.vaccineplace
    , hbv1.hospcode
    , hbv2.date_serv
    , hbv2.vaccineplace
    , hbv2.hospcode
    , hbv3.date_serv
    , hbv3.vaccineplace
    , hbv3.hospcode
    , o1.date_serv
    , o1.vaccineplace
    , o1.hospcode
    , o2.date_serv
    , o2.vaccineplace
    , o2.hospcode
    , o3.date_serv
    , o3.vaccineplace
    , o3.hospcode
    , o4.date_serv
    , o4.vaccineplace
    , o4.hospcode
    , o5.date_serv
    , o5.vaccineplace
    , o5.hospcode
    , os1.date_serv
    , os1.vaccineplace
    , os1.hospcode
    , os2.date_serv
    , os2.vaccineplace
    , os2.hospcode
    , os3.date_serv
    , os3.vaccineplace
    , os3.hospcode
    , d1.date_serv
    , d1.vaccineplace
    , d1.hospcode
    , d2.date_serv
    , d2.vaccineplace
    , d2.hospcode
    , d3.date_serv
    , d3.vaccineplace
    , d3.hospcode
    , d4.date_serv
    , d4.vaccineplace
    , d4.hospcode
    , d5.date_serv
    , d5.vaccineplace
    , d5.hospcode
    , bcgs.date_serv
    , bcgs.vaccineplace
    , bcgs.hospcode
    , dts1.date_serv
    , dts1.vaccineplace
    , dts1.hospcode
    , dts2.date_serv
    , dts2.vaccineplace
    , dts2.hospcode
    , dts3.date_serv
    , dts3.vaccineplace
    , dts3.hospcode
    , dts4.date_serv
    , dts4.vaccineplace
    , dts4.hospcode
    , je1.date_serv
    , je1.vaccineplace
    , je1.hospcode
    , je2.date_serv
    , je2.vaccineplace
    , je2.hospcode
    , je3.date_serv
    , je3.vaccineplace
    , je3.hospcode
    , j11.date_serv
    , j11.vaccineplace
    , j11.hospcode
    , j12.date_serv
    , j12.vaccineplace
    , j12.hospcode
    , mmr1.date_serv
    , mmr1.vaccineplace
    , mmr1.hospcode
    , mmr2.date_serv
    , mmr2.vaccineplace
    , mmr2.hospcode
    , mmrs.date_serv
    , mmrs.vaccineplace
    , mmrs.hospcode
    , hpv1.date_serv
    , hpv1.vaccineplace
    , hpv1.hospcode
    , hpv2.date_serv
    , hpv2.vaccineplace
    , hpv2.hospcode
    , hpv3.date_serv
    , hpv3.vaccineplace
    , hpv3.hospcode 
  FROM
    (SELECT 
      pe.cid
      , pe.check_hosp
      , pe.pid
      , pe.check_typearea
      , pe.BIRTH
      , pe.SEX
      , pe.NATION 
    FROM
      tmp_epi as tt 
      LEFT JOIN t_person_cid as pe 
        ON tt.CID = pe.CID 
    WHERE pe.age_y < 14 
    GROUP BY pe.CID) as p 
    LEFT JOIN tmp_bcg as b 
      on p.cid = b.cid 
    LEFT JOIN tmp_hbv1 as hbv1 
      on p.cid = hbv1.cid 
    LEFT JOIN tmp_hbv2 as hbv2 
      on p.cid = hbv2.cid 
    LEFT JOIN tmp_hbv3 as hbv3 
      on p.cid = hbv3.cid 
    LEFT JOIN tmp_opv1 as o1 
      on p.cid = o1.cid 
    LEFT JOIN tmp_opv2 as o2 
      on p.cid = o2.cid 
    LEFT JOIN tmp_opv3 as o3 
      on p.cid = o3.cid 
    LEFT JOIN tmp_opv4 as o4 
      on p.cid = o4.cid 
    LEFT JOIN tmp_opv5 as o5 
      on p.cid = o5.cid 
    LEFT JOIN tmp_opvs1 as os1 
      on p.cid = os1.cid 
    LEFT JOIN tmp_opvs2 as os2 
      on p.cid = os2.cid 
    LEFT JOIN tmp_opvs3 as os3 
      on p.cid = os3.cid 
    LEFT JOIN tmp_dtp1 as d1 
      on p.cid = d1.cid 
    LEFT JOIN tmp_dtp2 as d2 
      on p.cid = d2.cid 
    LEFT JOIN tmp_dtp3 as d3 
      on p.cid = d3.cid 
    LEFT JOIN tmp_dtp4 as d4 
      on p.cid = d4.cid 
    LEFT JOIN tmp_dtp5 as d5 
      on p.cid = d5.cid 
    LEFT JOIN tmp_dts1 as dts1 
      on p.cid = dts1.cid 
    LEFT JOIN tmp_dts2 as dts2 
      on p.cid = dts2.cid 
    LEFT JOIN tmp_dts3 as dts3 
      on p.cid = dts3.cid 
    LEFT JOIN tmp_dts4 as dts4 
      on p.cid = dts4.cid 
    LEFT JOIN tmp_bcgs as bcgs 
      on p.cid = bcgs.cid 
    LEFT JOIN tmp_je1 as je1 
      on p.cid = je1.cid 
    LEFT JOIN tmp_je2 as je2 
      on p.cid = je2.cid 
    LEFT JOIN tmp_je3 as je3 
      on p.cid = je3.cid 
    LEFT JOIN tmp_j11 as j11 
      on p.cid = j11.cid 
    LEFT JOIN tmp_j12 as j12 
      on p.cid = j12.cid 
    LEFT JOIN tmp_mmr1 as mmr1 
      on p.cid = mmr1.cid 
    LEFT JOIN tmp_mmr2 as mmr2 
      on p.cid = mmr2.cid 
    LEFT JOIN tmp_mmrs as mmrs 
      on p.cid = mmrs.cid 
    LEFT JOIN tmp_hpv1 as hpv1 
      on p.cid = hpv1.cid 
    LEFT JOIN tmp_hpv2 as hpv2 
      on p.cid = hpv2.cid 
    LEFT JOIN tmp_hpv3 as hpv3 
      on p.cid = hpv3.cid 
    /*  
    LEFT JOIN tmp_newborn as n 
      ON p.cid = n.cid 
      
    LEFT JOIN tmp_nutrition as nu 
      ON p.cid = nu.cid 
      */
  WHERE p.cid is not null) ;
  DROP TABLE IF EXISTS tmp_bcg ;
  DROP TABLE IF EXISTS tmp_bcgs ;
  DROP TABLE IF EXISTS tmp_opv1 ;
  DROP TABLE IF EXISTS tmp_opv2 ;
  DROP TABLE IF EXISTS tmp_opv3 ;
  DROP TABLE IF EXISTS tmp_opv4 ;
  DROP TABLE IF EXISTS tmp_opv5 ;
  DROP TABLE IF EXISTS tmp_opvs1 ;
  DROP TABLE IF EXISTS tmp_opvs2 ;
  DROP TABLE IF EXISTS tmp_opvs3 ;
  DROP TABLE IF EXISTS tmp_dtp1 ;
  DROP TABLE IF EXISTS tmp_dtp2 ;
  DROP TABLE IF EXISTS tmp_dtp3 ;
  DROP TABLE IF EXISTS tmp_dtp4 ;
  DROP TABLE IF EXISTS tmp_dtp5 ;
  DROP TABLE IF EXISTS tmp_dts1 ;
  DROP TABLE IF EXISTS tmp_dts2 ;
  DROP TABLE IF EXISTS tmp_dts3 ;
  DROP TABLE IF EXISTS tmp_dts4 ;
  DROP TABLE IF EXISTS tmp_je1 ;
  DROP TABLE IF EXISTS tmp_je2 ;
  DROP TABLE IF EXISTS tmp_je3 ;
  DROP TABLE IF EXISTS tmp_j11 ;
  DROP TABLE IF EXISTS tmp_j12 ;
  DROP TABLE IF EXISTS tmp_mmr1 ;
  DROP TABLE IF EXISTS tmp_mmr2 ;
  DROP TABLE IF EXISTS tmp_mmrs ;
  DROP TABLE IF EXISTS tmp_hpv1 ;
  DROP TABLE IF EXISTS tmp_hpv2 ;
  DROP TABLE IF EXISTS tmp_hpv3 ;
  DROP TABLE IF EXISTS tmp_hbv1 ;
  DROP TABLE IF EXISTS tmp_hbv2 ;
  DROP TABLE IF EXISTS tmp_hbv3 ;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_postnatal` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_postnatal` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_postnatal`()
BEGIN

SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '55';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

DROP TABLE IF EXISTS t_postnatal;
CREATE TABLE IF NOT EXISTS t_postnatal(
`HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `GRAVIDA` varchar(2) NOT NULL,
  `BDATE` date NOT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `nation` varchar(3) DEFAULT '',
  `occupat` varchar(4) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `vhid` varchar(8) DEFAULT NULL,
  `ppcare1` date DEFAULT NULL,
  `ppcare1_hosp` varchar(5) DEFAULT NULL,
	`ppcare1_input_hosp` varchar(5) DEFAULT NULL,
  `ppcare2` date DEFAULT NULL,
  `ppcare2_hosp` varchar(5) DEFAULT NULL,
	`ppcare2_input_hosp` varchar(5) DEFAULT NULL,
  `ppcare3` date DEFAULT NULL,
  `ppcare3_hosp` varchar(5) DEFAULT NULL,
	`ppcare3_input_hosp` varchar(5) DEFAULT NULL,
  #PRIMARY KEY (`CID`,bdate),
  KEY  (`cid`),
	KEY `HOSPCODE` (`HOSPCODE`,`PID`),
  KEY `BDATE` (`BDATE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO t_postnatal (HOSPCODE,PID,GRAVIDA,BDATE,cid,nation,occupat,birth,vhid)
(SELECT 
p.HOSPCODE,p.PID,GRAVIDA,BDATE,p.cid,'' as nation,'' as occupat,'' as birth,'' as vhid
FROM report_postnatal p
WHERE  p.BDATE BETWEEN @start_d AND @end_d
GROUP BY cid,BDATE
);

UPDATE IGNORE  t_postnatal p INNER JOIN (
SELECT min(PPCARE) PPCARE,BDATE,cid 
FROM report_postnatal WHERE TIMESTAMPDIFF(day,bdate,ppcare) <=7
GROUP BY cid,BDATE
) l ON p.cid=l.cid AND p.bdate=l.bdate 
SET p.ppcare1=l.ppcare;

UPDATE IGNORE  t_postnatal p INNER JOIN (
SELECT PPCARE,PPPLACE,BDATE,HOSPCODE,cid FROM report_postnatal 
) l ON p.cid=l.cid AND p.bdate=l.bdate AND  p.ppcare1=l.ppcare
SET p.ppcare1_hosp=l.PPPLACE , p.ppcare1_input_hosp=l.HOSPCODE;

UPDATE IGNORE  t_postnatal p INNER JOIN (
SELECT min(PPCARE) PPCARE,BDATE,cid 
FROM report_postnatal WHERE TIMESTAMPDIFF(day,bdate,ppcare) BETWEEN 8 AND 15
GROUP BY cid,BDATE
) l ON p.cid=l.cid AND p.bdate=l.bdate 
SET p.ppcare2=l.ppcare;

UPDATE IGNORE  t_postnatal p INNER JOIN (
SELECT PPCARE,PPPLACE,BDATE,HOSPCODE,cid FROM report_postnatal 
) l ON p.cid=l.cid AND p.bdate=l.bdate AND  p.ppcare2=l.ppcare
SET p.ppcare2_hosp=l.PPPLACE , p.ppcare2_input_hosp=l.HOSPCODE;

UPDATE IGNORE  t_postnatal p INNER JOIN (
SELECT min(PPCARE) PPCARE,BDATE,cid 
FROM report_postnatal WHERE TIMESTAMPDIFF(day,bdate,ppcare) BETWEEN 16 AND 42
GROUP BY cid,BDATE
) l ON p.cid=l.cid AND p.bdate=l.bdate 
SET p.ppcare3=l.ppcare;

UPDATE IGNORE  t_postnatal p INNER JOIN (
SELECT PPCARE,PPPLACE,BDATE,HOSPCODE,cid FROM report_postnatal 
) l ON p.cid=l.cid AND p.bdate=l.bdate AND  p.ppcare3=l.ppcare
SET p.ppcare3_hosp=l.PPPLACE , p.ppcare3_input_hosp=l.HOSPCODE;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t_specialpp` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_specialpp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_specialpp`()
BEGIN

SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '55';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');
SET @begin_d=DATE_ADD(@start_d,INTERVAL -43 month);
SET @begin_d1=DATE_ADD(@start_d,INTERVAL -1 month);
SET @end_d1:=concat(@b_year,'1030');


/*เตรียมข้อมูล*/
DROP TABLE IF EXISTS tmp_specialpp;
CREATE TABLE IF NOT EXISTS tmp_specialpp(
#PRIMARY KEY (HOSPCODE,PID,DATE_SERV,PPSPECIAL) 
KEY (cid)
,KEY (hospcode,pid)
,KEY (date_serv)
,KEY (ppspecial)
)(
SELECT 
s.*,p.CID
FROM report_specialpp s LEFT JOIN t_person p ON s.HOSPCODE=p.HOSPCODE AND s.PID=p.PID
WHERE DATE_SERV BETWEEN @begin_d1 AND @end_d1
);

/*หาเด็กกลุ่มเป้าหมาย*/
DROP TABLE IF EXISTS t_childdev;
CREATE TABLE  IF NOT EXISTS t_childdev(
  `HOSPCODE` varchar(5) NOT NULL DEFAULT '',
  `PID` varchar(15) NOT NULL DEFAULT '',
  `CID` varchar(13) NOT NULL,
  `BIRTH` date  DEFAULT NULL,
  `SEX` varchar(1) NOT NULL DEFAULT '',
  `AREACODE` varchar(8) DEFAULT NULL,
  `TYPEAREA` varchar(1) NOT NULL DEFAULT '',
  `AGE_9` int(1) NOT NULL DEFAULT '0',
  `AGE_18` int(1) NOT NULL DEFAULT '0',
  `AGE_30` int(1) NOT NULL DEFAULT '0',
  `AGE_42` int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`HOSPCODE`,`PID`),
 KEY (`HOSPCODE`,`PID`,`CID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT IGNORE INTO t_childdev (SELECT
 p.HOSPCODE,p.PID,p.CID,p.BIRTH,p.SEX,p.check_vhid AREACODE,p.check_typearea TYPEAREA,0,0,0,0
FROM t_person_cid  p
WHERE BIRTH BETWEEN @begin_d AND @end_d AND
						check_typearea in('1','3') AND p.DISCHARGE='9' AND LENGTH(trim(p.CID))=13 AND  NATION in(99) 
);

UPDATE t_childdev SET AGE_9=1 WHERE (DATE_ADD(BIRTH,INTERVAL 9 month)  BETWEEN @start_d AND @end_d) 
			OR (DATE_ADD(BIRTH,INTERVAL 10 month)  BETWEEN @start_d AND @end_d);
UPDATE t_childdev SET AGE_18=1 WHERE (DATE_ADD(BIRTH,INTERVAL 18 month)  BETWEEN @start_d AND @end_d)
			OR (DATE_ADD(BIRTH,INTERVAL 19 month)  BETWEEN @start_d AND @end_d);
UPDATE t_childdev SET AGE_30=1 WHERE (DATE_ADD(BIRTH,INTERVAL 30 month)  BETWEEN @start_d AND @end_d)
			OR (DATE_ADD(BIRTH,INTERVAL 31 month)  BETWEEN @start_d AND @end_d);
UPDATE t_childdev SET AGE_42=1 WHERE (DATE_ADD(BIRTH,INTERVAL 42 month)  BETWEEN @start_d AND @end_d)
			OR (DATE_ADD(BIRTH,INTERVAL 43 month)  BETWEEN @start_d AND @end_d);

/*นำเด็กกลุ่มเป้าหมายเข้าตารางคำนวน*/
DROP TABLE IF EXISTS t_childdev_specialpp;
CREATE TABLE  IF NOT EXISTS t_childdev_specialpp(
hospcode VARCHAR(5) NOT NULL,
pid VARCHAR(15) NOT NULL,
cid VARCHAR(15) NOT NULL DEFAULT '',
birth date,
sex VARCHAR(1) NOT NULL,
areacode VARCHAR(8) NOT NULL,
typearea VARCHAR(1) DEFAULT NULL,
agemonth VARCHAR(3) NOT NULL DEFAULT '',
date_start date,
date_end date,
date_serv_first date,
status1 VARCHAR(1) DEFAULT NULL,
date_serv2 date,
sp_first text,
sp_last text,
date_serv_last date,
status2 VARCHAR(1) DEFAULT NULL,
status21 VARCHAR(1) DEFAULT NULL,
status22 VARCHAR(1) DEFAULT NULL,
status23 VARCHAR(1) DEFAULT NULL,
status24 VARCHAR(1) DEFAULT NULL,
status25 VARCHAR(1) DEFAULT NULL,
 PRIMARY KEY(hospcode,pid,cid,agemonth)
,KEY (hospcode,pid,cid)
) ENGINE=MyISAM ;

INSERT IGNORE INTO t_childdev_specialpp (hospcode,pid,cid,birth,sex,areacode,typearea,agemonth)
(
SELECT
p.hospcode,p.pid,p.cid,p.birth,p.sex,p.areacode,p.typearea,'42'
FROM t_childdev p
WHERE AGE_42=1
);
INSERT IGNORE INTO t_childdev_specialpp (hospcode,pid,cid,birth,sex,areacode,typearea,agemonth)
(
SELECT
p.hospcode,p.pid,p.cid,p.birth,p.sex,p.areacode,p.typearea,'30'
FROM t_childdev p
WHERE AGE_30=1
);
INSERT IGNORE INTO t_childdev_specialpp (hospcode,pid,cid,birth,sex,areacode,typearea,agemonth)
(
SELECT
p.hospcode,p.pid,p.cid,p.birth,p.sex,p.areacode,p.typearea,'18'
FROM t_childdev p
WHERE AGE_18=1
);
INSERT IGNORE INTO t_childdev_specialpp (hospcode,pid,cid,birth,sex,areacode,typearea,agemonth)
(
SELECT
p.hospcode,p.pid,p.cid,p.birth,p.sex,p.areacode,p.typearea,'9'
FROM t_childdev p
WHERE AGE_9=1
);



INSERT IGNORE INTO t_childdev_specialpp (hospcode,pid,cid,birth,sex,areacode,typearea,agemonth)
(SELECT
p.hospcode,p.pid,p.cid,p.birth,p.sex,p.areacode,p.typearea
,IF(age_18=1 AND age_9=1 , 18 ,0)
FROM t_childdev p
);
INSERT IGNORE INTO t_childdev_specialpp (hospcode,pid,cid,birth,sex,areacode,typearea,agemonth)
(SELECT
p.hospcode,p.pid,p.cid,p.birth,p.sex,p.areacode,p.typearea
,IF(age_18=1 AND age_9=1 , 9 ,0)
FROM t_childdev p
);
DELETE FROM t_childdev_specialpp WHERE agemonth=0;

/*อัพเดทช่วงวันที่ที่ทำแล้วถือว่าได้รับการคัดกรอง*/
UPDATE  t_childdev_specialpp SET date_start=DATE_ADD(BIRTH,INTERVAL 9 month) ,date_end=DATE_ADD(DATE_ADD(BIRTH,INTERVAL 10 month),INTERVAL -1 DAY)  WHERE agemonth=9;
UPDATE  t_childdev_specialpp SET date_start=DATE_ADD(BIRTH,INTERVAL 18 month) ,date_end=DATE_ADD(DATE_ADD(BIRTH,INTERVAL 19 month),INTERVAL -1 DAY)  WHERE agemonth=18;
UPDATE  t_childdev_specialpp SET date_start=DATE_ADD(BIRTH,INTERVAL 30 month) ,date_end=DATE_ADD(DATE_ADD(BIRTH,INTERVAL 31 month),INTERVAL -1 DAY)  WHERE agemonth=30;
UPDATE  t_childdev_specialpp SET date_start=DATE_ADD(BIRTH,INTERVAL 42 month) ,date_end=DATE_ADD(DATE_ADD(BIRTH,INTERVAL 43 month),INTERVAL -1 DAY)  WHERE agemonth=42;

/*หาวันที่วันแรกที่ได้รับการตรวจเอาวันน้อยที่สุดจากวันเกิดที่มีรหัสที่กำหนด*/
UPDATE t_childdev_specialpp s INNER JOIN 
(
			SELECT s1.cid,s1.date_start, s1.date_end ,MIN(t1.date_serv) min_date_serv
			FROM tmp_specialpp  t1 INNER JOIN t_childdev_specialpp s1 ON  t1.cid=s1.cid
			WHERE t1.date_serv BETWEEN s1.date_start AND s1.date_end 
			AND PPSPECIAL in('1B260','1B261','1B262' ,'1B200'
			,'1B201','1B202','1B209','1B210','1B211','1B212'
			,'1B219','1B220','1B221','1B222','1B229','1B230'
			,'1B231','1B232','1B239','1B240','1B241','1B242','1B249')
			GROUP BY t1.cid,s1.date_start
)
t  ON s.cid=t.cid   AND s.date_start=t.date_start
SET s.date_serv_first= t.min_date_serv
WHERE t.min_date_serv BETWEEN s.date_start AND s.date_end ;

/*อัพเดททgroup รหัสที่ทำวันแรกทั้งหมด*/
UPDATE t_childdev_specialpp s INNER JOIN 
(
			SELECT s1.cid,s1.date_serv_first ,GROUP_CONCAT(t1.PPSPECIAL ORDER BY t1.PPSPECIAL) gr_sp
			FROM tmp_specialpp  t1 INNER JOIN t_childdev_specialpp s1 ON  t1.cid=s1.cid
			WHERE t1.date_serv in(s1.date_serv_first)
			GROUP BY t1.cid,s1.date_serv_first
)
t  ON s.cid=t.cid  AND s.date_serv_first=t.date_serv_first
SET s.sp_first= t.gr_sp	 ;

/*สรุปผลครั้งแรกตามเงื่อนไข*/
UPDATE t_childdev_specialpp SET status1=IF(INSTR(sp_first,'1B260'),1
,IF(INSTR(sp_first,'1B261'),2
,IF(INSTR(sp_first,'1B262'),3
,NULL
)))
WHERE date_serv_first IS NOT NULL;

/*สรุปผลครั้งแรกถ้าลงรหัสแบบที่ละด้านแบบเดิม*/
UPDATE t_childdev_specialpp SET status1=IF(INSTR(sp_first,'1B200,1B210,1B220,1B230,1B240'),1,NULL)
WHERE date_serv_first IS NOT NULL AND status1 IS NULL;

UPDATE t_childdev_specialpp SET status1=IF(
instr(sp_first,'1B201') 
OR instr(sp_first,'1B211') 
OR instr(sp_first,'1B221') 
OR instr(sp_first,'1B231') 
OR instr(sp_first,'1B241') 
,2,NULL)
WHERE date_serv_first IS NOT NULL AND status1 IS NULL;

UPDATE t_childdev_specialpp SET status1=IF(
instr(sp_first,'1B202') 
OR instr(sp_first,'1B212') 
OR instr(sp_first,'1B222') 
OR instr(sp_first,'1B232') 
OR instr(sp_first,'1B242') 
,3,NULL)
WHERE date_serv_first IS NOT NULL AND status1 IS NULL;


/*อัพเดทวันที่ติดตามนับจากวันครั้งแรกถึงวันสุดท้ายที่ไม่เกิน 30 วันที่เป็นไปได้ กรณีผิดปกติ*/
UPDATE  t_childdev_specialpp SET date_serv2=DATE_ADD(date_serv_first,INTERVAL 30 day) 
WHERE date_serv_first  IS NOT NULL AND status1 in(2) ;


/*หาวันที่วันสุดท้ายที่มาตรวจ  ตามช่วง 30 วันที่กำหนด เปลี่ยนได้ตลอดจนกว่าจะเลย 30 วัน*/
UPDATE t_childdev_specialpp s INNER JOIN 
(
			SELECT s1.cid,s1.date_serv_first, s1.date_serv2 ,MAX(t1.date_serv) max_date_serv
			FROM tmp_specialpp  t1 INNER JOIN t_childdev_specialpp s1 ON  t1.cid=s1.cid
			WHERE t1.date_serv BETWEEN s1.date_serv_first AND s1.date_serv2 
			AND PPSPECIAL in('1B260','1B261','1B262' ,'1B200'
			,'1B201','1B202','1B209','1B210','1B211','1B212'
			,'1B219','1B220','1B221','1B222','1B229','1B230'
			,'1B231','1B232','1B239','1B240','1B241','1B242','1B249')
			GROUP BY t1.cid,s1.date_serv2
)
t  ON s.cid=t.cid  AND s.date_serv2=t.date_serv2
SET s.date_serv_last= t.max_date_serv
WHERE t.max_date_serv BETWEEN s.date_serv_first AND s.date_serv2 
AND t.max_date_serv > s.date_serv_first AND s.date_serv2 is not null;


/*อัพเดททgroup รหัสวันสุดท้ายกรณีที่ติดตาม จะเปลี่ยนแปลงได้ตลอดจนกว่าจะเลย 30 วันจึงจะสรุปได้จริง*/
UPDATE t_childdev_specialpp s INNER JOIN 
(
			SELECT s1.cid,s1.date_serv_last ,GROUP_CONCAT(t1.PPSPECIAL) gr_sp
			FROM tmp_specialpp  t1 INNER JOIN t_childdev_specialpp s1 ON  t1.cid=s1.cid
			WHERE t1.date_serv in(s1.date_serv_last)
			GROUP BY t1.cid,s1.date_serv_last
)
t  ON s.cid=t.cid   AND s.date_serv_last=t.date_serv_last
SET s.sp_last= t.gr_sp
WHERE  s.date_serv2 is not null	 ;
/*สรุปผลครั้งสุดท้าย*/
UPDATE t_childdev_specialpp SET status21=IF(INSTR(sp_last,'1B202'),1,null),
status22=IF(INSTR(sp_last,'1B212'),1,null),
status23=IF(INSTR(sp_last,'1B222'),1,null),
status24=IF(INSTR(sp_last,'1B232'),1,null),
status25= IF(INSTR(sp_last,'1B242'),1,null)
WHERE date_serv_last IS NOT NULL AND  INSTR(sp_last,'1B260')=0  
AND date_serv_last > date_serv_first  
AND NOW() > date_serv2 
AND date_serv2 is not null;

UPDATE t_childdev_specialpp SET status2=IF(INSTR(sp_last,'1B260'),1,NULL)
 WHERE date_serv_last IS NOT NULL AND date_serv_last > date_serv_first AND status2 IS NULL
AND date_serv2 is not null;

/*สรุปผลครั้งสุดท้ายถ้าลงรหัสแบบที่ละด้านแบบเดิม*/
UPDATE t_childdev_specialpp SET status2=IF(INSTR(sp_first,'1B200,1B210,1B220,1B230,1B240'),1,NULL)
WHERE date_serv_last IS NOT NULL AND date_serv_last > date_serv_first AND status2 IS NULL
AND date_serv2 is not null;

END */$$
DELIMITER ;

/* Procedure structure for procedure `t_target_childdev9183042` */

/*!50003 DROP PROCEDURE IF EXISTS  `t_target_childdev9183042` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `t_target_childdev9183042`()
BEGIN

SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=CONCAT(@b_year-1,'1001');
SET @end_d:=CONCAT(@b_year,'0930');
SET @begin_d=DATE_ADD(@start_d,INTERVAL -30 MONTH);
SET @begin_d1=DATE_ADD(@start_d,INTERVAL -1 MONTH);
SET @end_d1:=CONCAT(@b_year,'1030');
DROP TABLE IF EXISTS t_target_childdev9183042;
CREATE TABLE  IF NOT EXISTS t_target_childdev9183042(INDEX (hospcode,pid,cid)) ENGINE=MYISAM  AS  
(SELECT
 p.HOSPCODE,p.PID,p.CID,p.BIRTH,p.check_vhid AREACODE,p.check_typearea TYPEAREA

,IF(p.BIRTH between '2015-09-12' and '2015-10-15',1,0)  AGE_9
,IF(p.BIRTH between '2014-12-12' and '2015-01-15',1,0)  AGE_18
,IF(p.BIRTH between '2013-12-12' and '2014-01-15',1,0)  AGE_30
,IF(p.BIRTH between '2012-12-12' and '2013-01-15',1,0)  AGE_42
   
, STR_TO_DATE('0000000','%Y%m%d') DATE_SERV
,0 AGE_SERV
,0 PASS
, STR_TO_DATE('20160704','%Y%m%d') DATE_START
, STR_TO_DATE('20160708','%Y%m%d') DATE_END
FROM t_person_cid  p
WHERE check_typearea IN('1','3') AND p.DISCHARGE='9' AND LENGTH(TRIM(p.CID))=13 AND  
						(
                        p.BIRTH between '2015-09-12' and '2015-10-15'
						OR p.BIRTH between '2014-12-12' and '2015-01-15'
						OR p.BIRTH between '2013-12-12' and '2014-01-15'
						OR p.BIRTH between '2012-12-12' and '2013-01-15' 
						)
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_anc` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_anc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_anc`()
BEGIN
    SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
    SET	@id:= '9';
    SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
	SET @date_3:=CONCAT(@b_year-2,'1001');
    CREATE TABLE IF NOT EXISTS ws_anc(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(7) DEFAULT 0,
result int(7) DEFAULT 0,
result10 int(7) DEFAULT 0,
result11 int(7) DEFAULT 0,
result12 int(7) DEFAULT 0,
result01 int(7) DEFAULT 0,
result02 int(7) DEFAULT 0,
result03 int(7) DEFAULT 0,
result04 int(7) DEFAULT 0,
result05 int(7) DEFAULT 0,
result06 int(7) DEFAULT 0,
result07 int(7) DEFAULT 0,
result08 int(7) DEFAULT 0,
result09 int(7) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELETE FROM ws_anc WHERE id=@id AND b_year=(@b_year+543);
INSERT IGNORE INTO ws_anc 
(
id,hospcode,areacode,flag_sent,date_com,b_year,target,result,result10,result11,result12,result01,result02,result03
,result04,result05,result06,result07,result08,result09
)
(
SELECT 
@id,t1.check_hosp,t1.areacode	,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(DISTINCT t1.cid) as target
,SUM(CASE WHEN 
t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year-1,'1001') AND CONCAT(@b_year-1,'1031')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result10'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year-1,'1101') AND CONCAT(@b_year-1,'1131')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result11'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year-1,'1201') AND CONCAT(@b_year-1,'1231')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result12'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0101') AND CONCAT(@b_year,'0131')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result01'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0201') AND CONCAT(@b_year,'0231')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result02'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0301') AND CONCAT(@b_year,'0331')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result03'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0401') AND CONCAT(@b_year,'0431')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result04'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0501') AND CONCAT(@b_year,'0531')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result05'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0601') AND CONCAT(@b_year,'0631')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result06'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0701') AND CONCAT(@b_year,'0731')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result07'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0801') AND CONCAT(@b_year,'0831')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result08'
,SUM(CASE WHEN 
(t1.bdate BETWEEN CONCAT(@b_year,'0901') AND CONCAT(@b_year,'0931')) 
AND t2.g1_date is not null AND t2.g2_date is not null AND t2.g3_date is not null 
AND t2.g4_date is not null AND t2.g5_date is not null
THEN 1 ELSE 0 END) as 'result09'
FROM
(
SELECT 
*
FROM
(SELECT
a.*,p.check_hosp,p.check_vhid as areacode
FROM
t_person_anc a
LEFT JOIN t_person_cid p ON a.cid=p.cid
WHERE
p.check_typearea in(1,3) AND p.DISCHARGE =9 
AND (a.bdate BETWEEN @start_d AND @end_d)
ORDER BY p.check_typearea
) as t3
GROUP BY t3.check_hosp,t3.cid
) as t1 
LEFT JOIN
(SELECT
*
FROM
(SELECT
a.*,p.check_hosp,p.check_vhid as areacode
FROM
t_person_anc a
LEFT JOIN t_person_cid p ON a.cid=p.cid
WHERE
p.check_typearea in(1,3) AND p.DISCHARGE =9 
AND (a.bdate BETWEEN @start_d AND @end_d) AND a.g1_date is not null 
AND a.g2_date is not null AND a.g3_date is not null AND a.g4_date is not null AND a.g5_date is not null
ORDER BY p.check_typearea
) as t4
GROUP BY t4.check_hosp,t4.cid
) as t2 ON t1.cid=t2.cid
LEFT JOIN chospital h ON t1.check_hosp=h.hoscode
WHERE h.provcode = @prov_c
GROUP BY t1.check_hosp,t1.areacode
);	   

END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_anc5` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_anc5` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_anc5`()
BEGIN
    SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
    SET	@id:= '9';
    SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET	@start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');
    
CREATE TABLE IF NOT EXISTS ws_anc5(
 id varchar(32) NOT NULL,
  hospcode varchar(5) NOT NULL,
  areacode varchar(8) NOT NULL,
  flag_sent varchar(1) DEFAULT NULL,
  date_com varchar(14) DEFAULT NULL,
  b_year varchar(4) NOT NULL,
  target int(7) DEFAULT 0,
  result int(7) DEFAULT 0,
  target1 int(7) DEFAULT 0,
  result1 int(7) DEFAULT 0,
  target2 int(7) DEFAULT 0,
  result2 int(7) DEFAULT 0,
  target3 int(7) DEFAULT 0,
  result3 int(7) DEFAULT 0,
  target4 int(7) DEFAULT 0,
  result4 int(7) DEFAULT 0,
	PRIMARY KEY (id,hospcode,areacode,b_year),
	KEY (hospcode),
	KEY (areacode),
	KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_anc5 WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_anc5 
(SELECT  @id,p.check_hosp,p.check_vhid
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
,COUNT(DISTINCT CONCAT(l.cid,'-',l.bdate)) target
,COUNT(DISTINCT IF(a.g1_date is not null AND a.g2_date is not null AND a.g3_date is not null 
			AND a.g4_date is not null AND a.g5_date is not null
, CONCAT(a.cid,'-',a.bdate),NULL)) result
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(10,11,12), CONCAT(l.cid,'-',l.bdate),NULL)) targetq1
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(10,11,12) AND a.g1_date is not null AND a.g2_date is not null 
			AND a.g3_date is not null AND a.g4_date is not null AND a.g5_date is not null
, CONCAT(a.cid,'-',a.bdate),NULL)) resultq1
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(1,2,3), CONCAT(l.cid,'-',l.bdate),NULL)) targetq2
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(1,2,3) AND a.g1_date is not null AND a.g2_date is not null 
			AND a.g3_date is not null AND a.g4_date is not null AND a.g5_date is not null
, CONCAT(a.cid,'-',a.bdate),NULL)) resultq2
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(4,5,6), CONCAT(l.cid,'-',l.bdate),NULL)) target3
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(4,5,6) AND a.g1_date is not null AND a.g2_date is not null 
			AND a.g3_date is not null AND a.g4_date is not null AND a.g5_date is not null
, CONCAT(a.cid,'-',a.bdate),NULL)) resultq3
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(7,8,9), CONCAT(l.cid,'-',l.bdate),NULL)) target4
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(7,8,9) AND a.g1_date is not null AND a.g2_date is not null 
			AND a.g3_date is not null AND a.g4_date is not null AND a.g5_date is not null
, CONCAT(a.cid,'-',a.bdate),NULL)) resultq4
FROM	t_labor l 
	INNER JOIN t_person_cid p ON l.cid=p.cid
	INNER JOIN chospital h ON p.check_hosp=h.hoscode
  LEFT JOIN t_person_anc a ON l.cid=a.cid AND l.bdate =a.bdate
WHERE  l.BDATE BETWEEN @start_d AND @end_d AND l.BTYPE NOT IN(6)
 AND p.check_typearea in(1,3) AND p.nation in(99) AND h.provcode in(@prov_c) AND p.discharge IN(9)
GROUP BY p.check_hosp,p.check_vhid
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_cervix_screen60` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_cervix_screen60` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_cervix_screen60`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= 'f50124b9cbc6636272844273980ca42e';
SET @cat_id := '1ed90bc32310b503b7ca9b32af425ae5';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');


CREATE TABLE IF NOT EXISTS ws_cervix_screen60(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(7) DEFAULT 0,
r11 int(7) DEFAULT 0,
r12 int(7) DEFAULT 0,
r13 int(7) DEFAULT 0,
r21 int(7) DEFAULT 0,
r22 int(7) DEFAULT 0,
r23 int(7) DEFAULT 0,
r24 int(7) DEFAULT 0,
r31 int(7) DEFAULT 0,
r32 int(7) DEFAULT 0,
r33 int(7) DEFAULT 0,
r34 int(7) DEFAULT 0,
r41 int(7) DEFAULT 0,
r42 int(7) DEFAULT 0,
r43 int(7) DEFAULT 0,
r44 int(7) DEFAULT 0,
r51 int(7) DEFAULT 0,
r52 int(7) DEFAULT 0,
r53 int(7) DEFAULT 0,
r54 int(7) DEFAULT 0,
p11 int(7) DEFAULT 0,
p12 int(7) DEFAULT 0,
p13 int(7) DEFAULT 0,
p21 int(7) DEFAULT 0,
p22 int(7) DEFAULT 0,
p23 int(7) DEFAULT 0,
p24 int(7) DEFAULT 0,
p31 int(7) DEFAULT 0,
p32 int(7) DEFAULT 0,
p33 int(7) DEFAULT 0,
p34 int(7) DEFAULT 0,
p41 int(7) DEFAULT 0,
p42 int(7) DEFAULT 0,
p43 int(7) DEFAULT 0,
p44 int(7) DEFAULT 0,
p51 int(7) DEFAULT 0,
p52 int(7) DEFAULT 0,
p53 int(7) DEFAULT 0,
p54 int(7) DEFAULT 0,
v11 int(7) DEFAULT 0,
v12 int(7) DEFAULT 0,
v13 int(7) DEFAULT 0,
v21 int(7) DEFAULT 0,
v22 int(7) DEFAULT 0,
v23 int(7) DEFAULT 0,
v24 int(7) DEFAULT 0,
v31 int(7) DEFAULT 0,
v32 int(7) DEFAULT 0,
v33 int(7) DEFAULT 0,
v34 int(7) DEFAULT 0,
v41 int(7) DEFAULT 0,
v42 int(7) DEFAULT 0,
v43 int(7) DEFAULT 0,
v44 int(7) DEFAULT 0,
v51 int(7) DEFAULT 0,
v52 int(7) DEFAULT 0,
v53 int(7) DEFAULT 0,
v54 int(7) DEFAULT 0,

PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_cervix_screen60 WHERE id=@id AND b_year=(@b_year+543);

/*
PAP '1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124'
VIA '1B0040','1B0041','1B0042','1B0043','1B0045'
*/

SET @b_year_start:='2015';

INSERT IGNORE INTO ws_cervix_screen60 
(
SELECT
@id,p.check_hosp,p.check_vhid,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(DISTINCT IF(TIMESTAMPDIFF(YEAR,p.birth, CONCAT(@b_year_start,'0101')) BETWEEN 30 AND 60 , p.CID , NULL)) target

,COUNT(DISTINCT IF(s.screen_status IN(11) , p.CID , NULL)) r11
,COUNT(DISTINCT IF(s.screen_status IN(12) , p.CID , NULL)) r12
,COUNT(DISTINCT IF(s.screen_status IN(13) , p.CID , NULL)) r13

,COUNT(DISTINCT IF(s.screen_status IN(21) , p.CID , NULL)) r21
,COUNT(DISTINCT IF(s.screen_status IN(22) , p.CID , NULL)) r22
,COUNT(DISTINCT IF(s.screen_status IN(23) , p.CID , NULL)) r23
,COUNT(DISTINCT IF(s.on_repleate IN(24) , p.CID , NULL)) r24

,COUNT(DISTINCT IF(s.screen_status IN(31) , p.CID , NULL)) r31
,COUNT(DISTINCT IF(s.screen_status IN(32) , p.CID , NULL)) r32
,COUNT(DISTINCT IF(s.screen_status IN(33) , p.CID , NULL)) r33
,COUNT(DISTINCT IF(s.on_repleate IN(34) , p.CID , NULL)) r34

,COUNT(DISTINCT IF(s.screen_status IN(41) , p.CID , NULL)) r41
,COUNT(DISTINCT IF(s.screen_status IN(42) , p.CID , NULL)) r42
,COUNT(DISTINCT IF(s.screen_status IN(43) , p.CID , NULL)) r43
,COUNT(DISTINCT IF(s.on_repleate IN(44) , p.CID , NULL)) r44

,COUNT(DISTINCT IF(s.screen_status IN(51) , p.CID , NULL)) r51
,COUNT(DISTINCT IF(s.screen_status IN(52) , p.CID , NULL)) r52
,COUNT(DISTINCT IF(s.screen_status IN(53) , p.CID , NULL)) r53
,COUNT(DISTINCT IF(s.on_repleate IN(54) , p.CID , NULL)) r54



,COUNT(DISTINCT IF(s.screen_status IN(11) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p11
,COUNT(DISTINCT IF(s.screen_status IN(12) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p12
,COUNT(DISTINCT IF(s.screen_status IN(13) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p13
,COUNT(DISTINCT IF(s.screen_status IN(21) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p21
,COUNT(DISTINCT IF(s.screen_status IN(22) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p22
,COUNT(DISTINCT IF(s.screen_status IN(23) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p23
,COUNT(DISTINCT IF(s.on_repleate IN(24) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p24

,COUNT(DISTINCT IF(s.screen_status IN(31) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p31
,COUNT(DISTINCT IF(s.screen_status IN(32) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p32
,COUNT(DISTINCT IF(s.screen_status IN(33) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p33
,COUNT(DISTINCT IF(s.on_repleate IN(34) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p34

,COUNT(DISTINCT IF(s.screen_status IN(41) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p41
,COUNT(DISTINCT IF(s.screen_status IN(42) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p42
,COUNT(DISTINCT IF(s.screen_status IN(43) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p43
,COUNT(DISTINCT IF(s.on_repleate IN(44) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p44

,COUNT(DISTINCT IF(s.screen_status IN(51) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p51
,COUNT(DISTINCT IF(s.screen_status IN(52) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p52
,COUNT(DISTINCT IF(s.screen_status IN(53) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p53
,COUNT(DISTINCT IF(s.on_repleate IN(54) AND s.screen_code IN('1B0044','1B0048','1B0049','1B30','1B40','Z014','Z124') , p.CID , NULL)) p54


,COUNT(DISTINCT IF(s.screen_status IN(11) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v11
,COUNT(DISTINCT IF(s.screen_status IN(12) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') ,p.CID , NULL)) v12
,COUNT(DISTINCT IF(s.screen_status IN(13) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v13
,COUNT(DISTINCT IF(s.screen_status IN(21) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v21
,COUNT(DISTINCT IF(s.screen_status IN(22) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v22
,COUNT(DISTINCT IF(s.screen_status IN(23) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v23
,COUNT(DISTINCT IF(s.on_repleate IN(24) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v24

,COUNT(DISTINCT IF(s.screen_status IN(31) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v31
,COUNT(DISTINCT IF(s.screen_status IN(32) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v32
,COUNT(DISTINCT IF(s.screen_status IN(33) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v33
,COUNT(DISTINCT IF(s.on_repleate IN(34) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v34

,COUNT(DISTINCT IF(s.screen_status IN(41) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v41
,COUNT(DISTINCT IF(s.screen_status IN(42) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v42
,COUNT(DISTINCT IF(s.screen_status IN(43) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v43
,COUNT(DISTINCT IF(s.on_repleate IN(44) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v44

,COUNT(DISTINCT IF(s.screen_status IN(51) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v51
,COUNT(DISTINCT IF(s.screen_status IN(52) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v52
,COUNT(DISTINCT IF(s.screen_status IN(53) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v53
,COUNT(DISTINCT IF(s.on_repleate IN(54) 
AND s.screen_code IN('1B0040','1B0041','1B0042','1B0043','1B0045') , p.CID , NULL)) v54

FROM t_person_cid p LEFT JOIN t_cervix_screen s ON p.CID=s.CID
WHERE	p.sex IN(2) AND p.DISCHARGE IN(9) AND p.nation IN(99)
AND p.check_typearea in(1,3)	AND substr(p.check_vhid,1,2)=@prov_c
GROUP BY	p.check_hosp,p.check_vhid
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_childdev_specialpp` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_childdev_specialpp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_childdev_specialpp`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @id:= '2238b7879f442749bd1804032119e824';
SET @cat_id := '1ed90bc32310b503b7ca9b32af425ae5';
SET @send := '';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_childdev_specialpp (
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) NOT NULL,
date_com varchar(14) NOT NULL,
b_year varchar(4) NOT NULL,
monthly varchar(2) NOT NULL,

target INT(10) DEFAULT 0,
result INT(10) DEFAULT 0,

target9 INT(10) DEFAULT 0,
result9_1 INT(10) DEFAULT 0,
result9_2 INT(10) DEFAULT 0,
result9_3 INT(10) DEFAULT 0,
result9_4 INT(10) DEFAULT 0,
result9_5 INT(10) DEFAULT 0,
result9_6 INT(10) DEFAULT 0,
result9_7 INT(10) DEFAULT 0,
result9_8 INT(10) DEFAULT 0,
result9_9 INT(10) DEFAULT 0,
target18 INT(10) DEFAULT 0,
result18_1 INT(10) DEFAULT 0,
result18_2 INT(10) DEFAULT 0,
result18_3 INT(10) DEFAULT 0,
result18_4 INT(10) DEFAULT 0,
result18_5 INT(10) DEFAULT 0,
result18_6 INT(10) DEFAULT 0,
result18_7 INT(10) DEFAULT 0,
result18_8 INT(10) DEFAULT 0,
result18_9 INT(10) DEFAULT 0,
target30 INT(10) DEFAULT 0,
result30_1 INT(10) DEFAULT 0,
result30_2 INT(10) DEFAULT 0,
result30_3 INT(10) DEFAULT 0,
result30_4 INT(10) DEFAULT 0,
result30_5 INT(10) DEFAULT 0,
result30_6 INT(10) DEFAULT 0,
result30_7 INT(10) DEFAULT 0,
result30_8 INT(10) DEFAULT 0,
result30_9 INT(10) DEFAULT 0,
target42 INT(10) DEFAULT 0,
result42_1 INT(10) DEFAULT 0,
result42_2 INT(10) DEFAULT 0,
result42_3 INT(10) DEFAULT 0,
result42_4 INT(10) DEFAULT 0,
result42_5 INT(10) DEFAULT 0,
result42_6 INT(10) DEFAULT 0,
result42_7 INT(10) DEFAULT 0,
result42_8 INT(10) DEFAULT 0,
result42_9 INT(10) DEFAULT 0,
improper9 INT(10) DEFAULT 0,
improper18 INT(10) DEFAULT 0,
improper30 INT(10) DEFAULT 0,
improper42 INT(10) DEFAULT 0,

PRIMARY KEY (hospcode,areacode,b_year,monthly)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_childdev_specialpp WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_childdev_specialpp(
SELECT
@id,p.check_hosp hospcode,IFNULL(p.check_vhid,concat(h.provcode,h.distcode,h.subdistcode,SUBSTR(CONCAT('00',h.mu),-2)))
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,DATE_FORMAT(s.date_start,'%m') mm

,COUNT(DISTINCT IF(s.agemonth in(9,18,30,42),CONCAT(s.cid),NULL)) target
,COUNT(DISTINCT IF(s.status1 in(1,2,3) AND s.agemonth in(9,18,30,42) ,CONCAT(s.cid),NULL )) result

,COUNT(DISTINCT IF(s.agemonth in(9),CONCAT(s.cid,'-',s.agemonth),NULL )) target9
,COUNT(DISTINCT IF(s.status1 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_1
,COUNT(DISTINCT IF(s.status1 in(2) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_2
,COUNT(DISTINCT IF(s.status1 in(3) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_3
,COUNT(DISTINCT IF(s.status2 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_4
,COUNT(DISTINCT IF(s.status21 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_5
,COUNT(DISTINCT IF(s.status22 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_6
,COUNT(DISTINCT IF(s.status23 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_7
,COUNT(DISTINCT IF(s.status24 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_8
,COUNT(DISTINCT IF(s.status25 in(1) AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result9_9
,COUNT(DISTINCT IF(s.agemonth in(18),CONCAT(s.cid,'-',s.agemonth),NULL )) target18
,COUNT(DISTINCT IF(s.status1 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_1
,COUNT(DISTINCT IF(s.status1 in(2) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_2
,COUNT(DISTINCT IF(s.status1 in(3) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_3
,COUNT(DISTINCT IF(s.status2 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_4
,COUNT(DISTINCT IF(s.status21 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_5
,COUNT(DISTINCT IF(s.status22 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_6
,COUNT(DISTINCT IF(s.status23 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_7
,COUNT(DISTINCT IF(s.status24 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_8
,COUNT(DISTINCT IF(s.status25 in(1) AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result18_9
,COUNT(DISTINCT IF(s.agemonth in(30),CONCAT(s.cid,'-',s.agemonth),NULL )) target30
,COUNT(DISTINCT IF(s.status1 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_1
,COUNT(DISTINCT IF(s.status1 in(2) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_2
,COUNT(DISTINCT IF(s.status1 in(3) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_3
,COUNT(DISTINCT IF(s.status2 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_4
,COUNT(DISTINCT IF(s.status21 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_5
,COUNT(DISTINCT IF(s.status22 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_6
,COUNT(DISTINCT IF(s.status23 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_7
,COUNT(DISTINCT IF(s.status24 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_8
,COUNT(DISTINCT IF(s.status25 in(1) AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result30_9
,COUNT(DISTINCT IF(s.agemonth in(42),CONCAT(s.cid,'-',s.agemonth),NULL )) target42
,COUNT(DISTINCT IF(s.status1 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_1
,COUNT(DISTINCT IF(s.status1 in(2) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_2
,COUNT(DISTINCT IF(s.status1 in(3) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_3
,COUNT(DISTINCT IF(s.status2 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_4
,COUNT(DISTINCT IF(s.status21 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_5
,COUNT(DISTINCT IF(s.status22 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_6
,COUNT(DISTINCT IF(s.status23 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_7
,COUNT(DISTINCT IF(s.status24 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_8
,COUNT(DISTINCT IF(s.status25 in(1) AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) result42_9
,COUNT(DISTINCT IF((s.status21 in(1) OR s.status22 in(1) OR s.status23 in(1) OR s.status24 in(1) OR s.status25 in(1)) 
AND s.agemonth in(9) ,CONCAT(s.cid,'-',s.agemonth),NULL )) improper9
,COUNT(DISTINCT IF((s.status21 in(1) OR s.status22 in(1) OR s.status23 in(1) OR s.status24 in(1) OR s.status25 in(1)) 
AND s.agemonth in(18) ,CONCAT(s.cid,'-',s.agemonth),NULL )) improper18
,COUNT(DISTINCT IF((s.status21 in(1) OR s.status22 in(1) OR s.status23 in(1) OR s.status24 in(1) OR s.status25 in(1)) 
AND s.agemonth in(30) ,CONCAT(s.cid,'-',s.agemonth),NULL )) improper30
,COUNT(DISTINCT IF((s.status21 in(1) OR s.status22 in(1) OR s.status23 in(1) OR s.status24 in(1) OR s.status25 in(1)) 
AND s.agemonth in(42) ,CONCAT(s.cid,'-',s.agemonth),NULL )) improper42

FROM
t_childdev_specialpp s INNER JOIN t_person_cid p ON s.cid=p.cid
INNER JOIN chospital h ON p.HOSPCODE=h.hoscode
WHERE p.check_typearea in(1,3) AND p.NATION in(99) AND p.DISCHARGE in(9)
AND s.date_start BETWEEN @start_d AND @end_d AND substr(p.check_vhid ,1,2) in(@prov_c)
AND h.provcode in(@prov_c)
GROUP BY p.check_hosp,p.check_vhid,DATE_FORMAT(date_start,'%m')
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_dm_control` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_dm_control` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_dm_control`()
BEGIN

SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= '137a726340e4dfde7bbbc5d8aeee3ac3';
SET @cat_id := 'cf7d9da207c0f9a7ee6c4fe3f09f67dd';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');


CREATE TABLE IF NOT EXISTS ws_dm_control(
  id varchar(32) NOT NULL,
  hospcode varchar(5) NOT NULL,
  areacode varchar(8) NOT NULL,
  flag_sent varchar(1) DEFAULT NULL,
  date_com varchar(14) DEFAULT NULL,
  b_year varchar(4) NOT NULL,
  target int(9) DEFAULT 0,
  result int(9) DEFAULT 0,
  hba1c int(9) DEFAULT 0,
  target1 int(9) DEFAULT 0,
  result1 int(9) DEFAULT 0,
	hba1c1 int(9) DEFAULT 0,
	PRIMARY KEY (id,hospcode,areacode,b_year),
	KEY (hospcode),
	KEY (areacode),
	KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_dm_control WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_dm_control 
(
SELECT @id,b.hospcode,b.areacode
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
,b.target,b.result,b.hba1c,a.target target1,a.result result1,a.hba1c hba1c1
FROM
(SELECT
p.check_hosp hospcode,p.check_vhid areacode
,COUNT(DISTINCT d.cid) target
,COUNT(DISTINCT IF(d.control_dm IN(1),d.cid,NULL )) result
,COUNT(DISTINCT IF(d.ld_hba1c BETWEEN @start_d AND @end_d ,d.cid,NULL )) hba1c
FROM
t_dmht d 
INNER JOIN t_person_cid p ON d.cid=p.CID
WHERE d.cid IS NOT NULL AND d.type_dx in(2,3) AND p.check_typearea IN(1,3) 
AND p.NATION IN(99) AND p.DISCHARGE IN(9)
AND substr(p.check_vhid,1,2) IN(@prov_c)
GROUP BY p.check_hosp,p.check_vhid
) b LEFT JOIN (
	SELECT
		f.hospcode,concat(h.provcode,h.distcode,SUBSTR(CONCAT('00',h.subdistcode),-2) ,SUBSTR(CONCAT('00',h.mu),-2)) as areacode
		,COUNT(DISTINCT CONCAT(f.hospcode,'-',f.pid)) target
		,COUNT(DISTINCT IF(f.control_dm IN(1), CONCAT(f.hospcode,'-',f.pid),NULL)) result
		,COUNT(DISTINCT IF(f.ld_hba1c BETWEEN @start_d AND @end_d ,CONCAT(f.hospcode,'-',f.pid),NULL )) hba1c
  FROM
	t_chronicfu f INNER JOIN t_dmht d ON f.cid=d.cid
	INNER JOIN chospital h ON f.hospcode=h.hoscode
	WHERE h.provcode in(@prov_c)  AND f.cid IS NOT NULL AND  d.type_dx in(2,3) AND d.NATION IN(99) 
	GROUP BY h.hoscode,areacode
) a ON b.hospcode = a.hospcode AND b.areacode=a.areacode
);

INSERT IGNORE INTO ws_dm_control 
(
SELECT 
	@id,f.hospcode,concat(h.provcode,h.distcode,SUBSTR(CONCAT('00',h.subdistcode),-2) ,SUBSTR(CONCAT('00',h.mu),-2)) as areacode
		,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
		,NULL,NULL,NULL
		,COUNT(DISTINCT CONCAT(f.hospcode,'-',f.pid)) target
		,COUNT(DISTINCT IF(f.control_dm IN(1), CONCAT(f.hospcode,'-',f.pid),NULL)) result
		,COUNT(DISTINCT IF(f.ld_hba1c BETWEEN @start_d AND @end_d ,CONCAT(f.hospcode,'-',f.pid),NULL )) hba1c
  FROM
	t_chronicfu f INNER JOIN t_dmht d ON f.cid=d.cid
	INNER JOIN chospital h ON f.hospcode=h.hoscode
	WHERE h.provcode in(@prov_c)  AND f.cid IS NOT NULL AND  d.type_dx in(2,3) AND d.NATION IN(99) 
	GROUP BY h.hoscode,areacode
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_dm_retina` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_dm_retina` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_dm_retina`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= '8588a1f1db93c9e19c6d5cc11bbfc930';
SET @cat_id := '6a1fdf282fd28180eed7d1cfe0155e11';
SET @send := '';
SET	@start_d:=concat(@b_year-2,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_dm_retina(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(7) DEFAULT 0,
result int(7) DEFAULT 0,
result10 int(7) DEFAULT 0,
result11 int(7) DEFAULT 0,
result12 int(7) DEFAULT 0,
result01 int(7) DEFAULT 0,
result02 int(7) DEFAULT 0,
result03 int(7) DEFAULT 0,
result04 int(7) DEFAULT 0,
result05 int(7) DEFAULT 0,
result06 int(7) DEFAULT 0,
result07 int(7) DEFAULT 0,
result08 int(7) DEFAULT 0,
result09 int(7) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)


) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_dm_retina WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_dm_retina 
(
SELECT
@id,hospcode,vhid,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(DISTINCT cid)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year-1,'1001') AND concat(@b_year,'0931') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)

,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year-1,'1001') AND concat(@b_year-1,'1031') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year-1,'1101') AND concat(@b_year-1,'1131') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year-1,'1201') AND concat(@b_year-1,'1231') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0101') AND concat(@b_year,'0131') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0201') AND concat(@b_year,'0231') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0301') AND concat(@b_year,'0331') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0401') AND concat(@b_year,'0431') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0501') AND concat(@b_year,'0531') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0601') AND concat(@b_year,'0631') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0701') AND concat(@b_year,'0731') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0801') AND concat(@b_year,'0831') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)
,SUM(CASE WHEN ld_retina BETWEEN concat(@b_year,'0901') AND concat(@b_year,'0931') AND rs_retina in(1,2,3,4) THEN 1 ELSE 0 END)

FROM
t_dmht 
WHERE
type_dx in(2,3)
AND substr(vhid,1,2)=@prov_c
GROUP BY
hospcode,vhid
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_dm_screen_pop_age` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_dm_screen_pop_age` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_dm_screen_pop_age`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @id := '99';
SET @cat_id := '';
SET	@send := '';
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_dm_screen_pop_age(
  id varchar(32) NOT NULL,
  hospcode varchar(5) NOT NULL,
  areacode varchar(8) NOT NULL,
  flag_sent varchar(1) DEFAULT NULL,
  date_com varchar(14) DEFAULT NULL,
  b_year varchar(4) NOT NULL,
	target int(9) DEFAULT 0,
	result int(9) DEFAULT 0,
	pop_group2 int(9) DEFAULT 0,
	result_group2 int(9) DEFAULT 0,
	pop_group3 int(9) DEFAULT 0,
	result_group3 int(9) DEFAULT 0,
	pop_group4 int(9) DEFAULT 0,
	result_group4 int(9) DEFAULT 0,
	PRIMARY KEY (id,hospcode,areacode,b_year),
	KEY (hospcode),
	KEY (areacode),
	KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_dm_screen_pop_age WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_dm_screen_pop_age 
(
SELECT
	@id,p.hospcode,p.areacode,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
	,b,a,b2,a2,b3,a3,b4,a4
FROM
(SELECT
	hospcode,areacode
						
                        ,COUNT(DISTINCT if(ca.groupcode3560 IN (3,4), cid,null)) as b
                        ,COUNT(DISTINCT if(groupcode3560 IN (3,4) AND date_screen is not null AND bslevel >70 , cid,null)) as a
						,COUNT(DISTINCT if(ca.groupcode3560 ='2', cid,null)) as b2
						,COUNT(DISTINCT if(ca.groupcode3560 ='3', cid,null)) as b3
						,COUNT(DISTINCT if(ca.groupcode3560 ='4', cid,null)) as b4
						,COUNT(DISTINCT if(groupcode3560='2' AND date_screen is not null AND bslevel >70 , cid,null))  as a2
						,COUNT(DISTINCT if(groupcode3560='3' AND date_screen is not null AND bslevel >70 , cid,null)) as a3
						,COUNT(DISTINCT if(groupcode3560='4' AND date_screen is not null AND bslevel >70 , cid,null)) as a4
	FROM
	t_person_dm_screen s
		LEFT JOIN cage ca ON s.age_y=ca.age
	WHERE substr(areacode,1,2)=@prov_c
	GROUP BY hospcode,areacode
) p
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_epi3` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_epi3` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_epi3`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year := (SELECT yearprocess FROM wmc_config LIMIT 1);
SET @id:= '267ce09f2a704eb7783997e25d1f18ba';
SET @cat_id := '4df360514655f79f13901ef1181ca1c7';
SET @send := '';
SET @start_d:=concat(@b_year-4,'1001');
SET @end_d:=concat(@b_year-3,'0930');

CREATE TABLE IF NOT EXISTS ws_epi3(
id varchar(32) NOT NULL
,hospcode varchar(5) NOT NULL
,areacode varchar(8) NOT NULL
,flag_sent varchar(1) DEFAULT NULL
,date_com varchar(14) DEFAULT NULL
,b_year varchar(4) NOT NULL
,target10 int(7) DEFAULT 0,target11 int(7) DEFAULT 0,target12 int(7) DEFAULT 0,target01 int(7) DEFAULT 0
,target02 int(7) DEFAULT 0,target03 int(7) DEFAULT 0,target04 int(7) DEFAULT 0,target05 int(7) DEFAULT 0
,target06 int(7) DEFAULT 0,target07 int(7) DEFAULT 0,target08 int(7) DEFAULT 0,target09 int(7) DEFAULT 0
,je3_10 int(7) DEFAULT 0,je3_11 int(7) DEFAULT 0,je3_12 int(7) DEFAULT 0,je3_01 int(7) DEFAULT 0
,je3_02 int(7) DEFAULT 0,je3_03 int(7) DEFAULT 0,je3_04 int(7) DEFAULT 0,je3_05 int(7) DEFAULT 0
,je3_06 int(7) DEFAULT 0,je3_07 int(7) DEFAULT 0,je3_08 int(7) DEFAULT 0,je3_09 int(7) DEFAULT 0
,mmr2_10 int(7) DEFAULT 0,mmr2_11 int(7) DEFAULT 0,mmr2_12 int(7) DEFAULT 0,mmr2_01 int(7) DEFAULT 0
,mmr2_02 int(7) DEFAULT 0,mmr2_03 int(7) DEFAULT 0,mmr2_04 int(7) DEFAULT 0,mmr2_05 int(7) DEFAULT 0
,mmr2_06 int(7) DEFAULT 0,mmr2_07 int(7) DEFAULT 0,mmr2_08 int(7) DEFAULT 0,mmr2_09 int(7) DEFAULT 0

,PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_epi3 WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_epi3
(
id,hospcode,areacode,flag_sent,date_com,b_year
,target10,target11,target12,target01,target02,target03,target04,target05,target06,target07,target08,target09
,je3_10,je3_11,je3_12,je3_01,je3_02,je3_03,je3_04,je3_05,je3_06,je3_07,je3_08,je3_09
,mmr2_10,mmr2_11,mmr2_12,mmr2_01,mmr2_02,mmr2_03,mmr2_04,mmr2_05,mmr2_06,mmr2_07,mmr2_08,mmr2_09
)
(

SELECT
@id,t1.check_hosp,t1.areacode ,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
#target all month
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1001') AND concat(@b_year-4,'1031')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1101') AND concat(@b_year-4,'1131')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1201') AND concat(@b_year-4,'1231')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0101') AND concat(@b_year-3,'0131')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0201') AND concat(@b_year-3,'0231')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0301') AND concat(@b_year-3,'0331')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0401') AND concat(@b_year-3,'0431')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0501') AND concat(@b_year-3,'0531')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0601') AND concat(@b_year-3,'0631')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0701') AND concat(@b_year-3,'0731')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0801') AND concat(@b_year-3,'0831')
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0901') AND concat(@b_year-3,'0931')
THEN 1 ELSE 0 END)
#result je3 all month
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1001') AND concat(@b_year-4,'1031')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1101') AND concat(@b_year-4,'1131')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1201') AND concat(@b_year-4,'1231')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0101') AND concat(@b_year-3,'0131')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0201') AND concat(@b_year-3,'0231')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0301') AND concat(@b_year-3,'0331')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0401') AND concat(@b_year-3,'0431')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0501') AND concat(@b_year-3,'0531')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0601') AND concat(@b_year-3,'0631')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0701') AND concat(@b_year-3,'0731')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0801') AND concat(@b_year-3,'0831')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0901') AND concat(@b_year-3,'0931')
AND ((je1_date is not null AND je2_date is not null AND je3_date is not null
AND je3_date > je2_date AND je2_date > je1_date)
or (je1_date is not null AND je2_date is not null AND j11_date is not null AND je2_date > je1_date AND j11_date > je2_date)
or (j11_date is not null AND j12_date is not null AND j12_date > j11_date)
or (j11_date is not null AND je1_date is not null AND je1_date > j11_date ))
THEN 1 ELSE 0 END)
#mmr2
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1001') AND concat(@b_year-4,'1031')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1101') AND concat(@b_year-4,'1131')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-4,'1201') AND concat(@b_year-4,'1231')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0101') AND concat(@b_year-3,'0131')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0201') AND concat(@b_year-3,'0231')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0301') AND concat(@b_year-3,'0331')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0401') AND concat(@b_year-3,'0431')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0501') AND concat(@b_year-3,'0531')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0601') AND concat(@b_year-3,'0631')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0701') AND concat(@b_year-3,'0731')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0801') AND concat(@b_year-3,'0831')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)
,SUM(CASE WHEN DATE_FORMAT(t1.birth,'%Y%m%d') BETWEEN concat(@b_year-3,'0901') AND concat(@b_year-3,'0931')
AND t1.mmr2_date is not null
THEN 1 ELSE 0 END)


FROM
(
SELECT
*
FROM
(SELECT
a.*,p.check_hosp,p.check_vhid as areacode,p.check_typearea
FROM
t_person_cid p
LEFT JOIN t_person_epi a ON a.cid=p.cid
WHERE
p.check_typearea in(1,3) AND p.DISCHARGE =9
AND (p.birth BETWEEN @start_d AND @end_d)
ORDER BY p.check_typearea
) as t3
GROUP BY t3.check_hosp,t3.cid
) as t1
LEFT JOIN chospital h ON t1.check_hosp=h.hoscode
WHERE h.provcode = @prov_c
GROUP BY t1.check_hosp,t1.areacode
); 
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_ht_control` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_ht_control` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_ht_control`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= '137a726340e4dfde7bbbc5d8aeee3ac3';
SET @cat_id := 'cf7d9da207c0f9a7ee6c4fe3f09f67dd';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_ht_control(
  id varchar(32) NOT NULL,
  hospcode varchar(5) NOT NULL,
  areacode varchar(8) NOT NULL,
  flag_sent varchar(1) DEFAULT NULL,
  date_com varchar(14) DEFAULT NULL,
  b_year varchar(4) NOT NULL,
  target int(9) DEFAULT 0,
  result int(9) DEFAULT 0,
	bp int(9) DEFAULT 0,
  target1 int(9) DEFAULT 0,
  result1 int(9) DEFAULT 0,
	bp1 int(9) DEFAULT 0,
	PRIMARY KEY (id,hospcode,areacode,b_year),
	KEY (hospcode),
	KEY (areacode),
	KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_ht_control WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_ht_control 
(
SELECT @id,b.hospcode,b.areacode
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
,b.target,b.result,b.bp,a.target target1,a.result result1,a.bp bp1
FROM
(SELECT
p.check_hosp hospcode,p.check_vhid areacode
,COUNT(DISTINCT d.cid) target
,COUNT(DISTINCT IF(d.control_ht IN(1),d.cid,NULL )) result
,COUNT(DISTINCT IF(d.ld_bp1 BETWEEN @start_d AND @end_d ,d.cid,NULL )) bp
FROM
t_dmht d 
INNER JOIN t_person_cid p ON d.cid=p.CID
WHERE d.cid IS NOT NULL AND d.type_dx in(1,3) AND p.check_typearea IN(1,3) 
AND p.NATION IN(99) AND p.DISCHARGE IN(9)
AND substr(p.check_vhid,1,2) IN(@prov_c)
GROUP BY p.check_hosp,p.check_vhid
) b LEFT JOIN (
	SELECT
		f.hospcode,concat(h.provcode,h.distcode,SUBSTR(CONCAT('00',h.subdistcode),-2) ,SUBSTR(CONCAT('00',h.mu),-2)) as areacode
		,COUNT(DISTINCT CONCAT(f.hospcode,'-',f.pid)) target
		,COUNT(DISTINCT IF(f.control_ht IN(1), CONCAT(f.hospcode,'-',f.pid),NULL)) result
		,COUNT(DISTINCT IF(f.ld_bp1 BETWEEN @start_d AND @end_d ,CONCAT(f.hospcode,'-',f.pid),NULL )) bp
  FROM
	t_chronicfu f INNER JOIN t_dmht d ON f.cid=d.cid
	INNER JOIN chospital h ON f.hospcode=h.hoscode
	WHERE h.provcode in(@prov_c)  AND f.cid IS NOT NULL AND  d.type_dx in(1,3) AND d.NATION IN(99) 
	GROUP BY h.hoscode,areacode
) a ON b.hospcode = a.hospcode AND b.areacode=a.areacode
);

INSERT IGNORE INTO ws_ht_control 
(
SELECT 
	@id,f.hospcode,concat(h.provcode,h.distcode,SUBSTR(CONCAT('00',h.subdistcode),-2) ,SUBSTR(CONCAT('00',h.mu),-2)) as areacode
		,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
		,NULL,NULL,NULL
		,COUNT(DISTINCT CONCAT(f.hospcode,'-',f.pid)) target
		,COUNT(DISTINCT IF(f.control_ht IN(1), CONCAT(f.hospcode,'-',f.pid),NULL)) result
		,COUNT(DISTINCT IF(f.ld_bp1 BETWEEN @start_d AND @end_d ,CONCAT(f.hospcode,'-',f.pid),NULL )) hba1c
  FROM
	t_chronicfu f INNER JOIN t_dmht d ON f.cid=d.cid
	INNER JOIN chospital h ON f.hospcode=h.hoscode
	WHERE h.provcode in(@prov_c)  AND f.cid IS NOT NULL AND  d.type_dx in(1,3) AND d.NATION IN(99) 
	GROUP BY h.hoscode,areacode
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_ht_screen_pop_age` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_ht_screen_pop_age` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_ht_screen_pop_age`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @id := '99';
SET @cat_id := '';
SET	@send := '';
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_ht_screen_pop_age(
  id varchar(32) NOT NULL,
  hospcode varchar(5) NOT NULL,
  areacode varchar(8) NOT NULL,
  flag_sent varchar(1) DEFAULT NULL,
  date_com varchar(14) DEFAULT NULL,
  b_year varchar(4) NOT NULL,
  
	target int(9) DEFAULT 0,
	result int(9) DEFAULT 0,
    
	pop_group2 int(9) DEFAULT 0,
	result_group2 int(9) DEFAULT 0,
	pop_group3 int(9) DEFAULT 0,
	result_group3 int(9) DEFAULT 0,
	pop_group4 int(9) DEFAULT 0,
	result_group4 int(9) DEFAULT 0,
	PRIMARY KEY (id,hospcode,areacode,b_year),
	KEY (hospcode),
	KEY (areacode),
	KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_ht_screen_pop_age WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_ht_screen_pop_age 
(
SELECT
	@id,p.hospcode,p.areacode,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
	,b,a,b2,a2,b3,a3,b4,a4
FROM
(SELECT
	hospcode,areacode
						,COUNT(DISTINCT if(ca.groupcode3560 IN (3,4), cid,null)) as b
                        ,COUNT(DISTINCT if(groupcode3560 IN (3,4) AND  sbp_1>50 AND dbp_1 >50 ,cid,null))  as a
                        
						,COUNT(DISTINCT if(ca.groupcode3560 ='2', cid,null)) as b2
						,COUNT(DISTINCT if(ca.groupcode3560 ='3', cid,null)) as b3
						,COUNT(DISTINCT if(ca.groupcode3560 ='4', cid,null)) as b4
                        
						,COUNT(DISTINCT if(groupcode3560='2' AND  sbp_1>50 AND dbp_1 >50 ,cid,null))  as a2
						,COUNT(DISTINCT if(groupcode3560='3' AND  sbp_1>50 AND dbp_1 >50 ,cid,null)) as a3
						,COUNT(DISTINCT if(groupcode3560='4' AND  sbp_1>50 AND dbp_1 >50 ,cid,null)) as a4
	FROM
	t_person_ht_screen s
		LEFT JOIN cage ca ON s.age_y=ca.age
	WHERE substr(areacode,1,2)=@prov_c
	GROUP BY hospcode,areacode
) p
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_kpi_anc12` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_kpi_anc12` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_kpi_anc12`()
BEGIN
    SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
    SET	@id:= '9';
    SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @start_d:=CONCAT(@b_year-1,'1001');
	SET @end_d:=CONCAT(@b_year,'0930');
	SET @date_3:=CONCAT(@b_year-2,'1001');
    
    CREATE TABLE IF NOT EXISTS ws_kpi_anc12(
  id varchar(32) NOT NULL,
  hospcode varchar(5) NOT NULL,
  areacode varchar(8) NOT NULL,
  flag_sent varchar(1) DEFAULT NULL,
  date_com varchar(14) DEFAULT NULL,
  b_year varchar(4) NOT NULL,
  target int(7) DEFAULT 0,
  result int(7) DEFAULT 0,
  target1 int(7) DEFAULT 0,
  result1 int(7) DEFAULT 0,
  target2 int(7) DEFAULT 0,
  result2 int(7) DEFAULT 0,
  target3 int(7) DEFAULT 0,
  result3 int(7) DEFAULT 0,
  target4 int(7) DEFAULT 0,
 result4 int(7) DEFAULT 0,

	PRIMARY KEY (id,hospcode,areacode,b_year),
	KEY (hospcode),
	KEY (areacode),
	KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_kpi_anc12 WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_kpi_anc12
(
SELECT @id,p.check_hosp,p.check_vhid
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
,COUNT(DISTINCT CONCAT(l.cid,'-',l.bdate)) traget
,COUNT(DISTINCT IF( a.g1_ga <=12, CONCAT(a.cid,'-',a.bdate),NULL)) result
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(10,11,12), CONCAT(l.cid,'-',l.bdate) ,NULL)) tragetq1
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(10,11,12) AND a.g1_ga <=12, CONCAT(a.cid,'-',a.bdate),NULL)) resultq1
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(1,2,3), CONCAT(l.cid,'-',l.bdate) ,NULL)) tragetq2
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(1,2,3) AND a.g1_ga <=12, CONCAT(a.cid,'-',a.bdate),NULL)) resultq2
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(4,5,6), CONCAT(l.cid,'-',l.bdate) ,NULL)) tragetq3
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(4,5,6) AND a.g1_ga <=12, CONCAT(a.cid,'-',a.bdate),NULL)) resultq3
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(7,8,9), CONCAT(l.cid,'-',l.bdate) ,NULL)) tragetq4
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') IN(7,8,9) AND a.g1_ga <=12, CONCAT(a.cid,'-',a.bdate),NULL)) resultq4
FROM t_labor l 
	INNER JOIN t_person_cid p ON l.cid=p.cid
	INNER JOIN chospital h ON p.check_hosp=h.hoscode
  LEFT JOIN t_person_anc a ON l.cid=a.cid AND l.bdate =a.bdate
WHERE l.BDATE BETWEEN @start_d AND @end_d AND p.check_typearea in(1,3) AND p.discharge IN(9)
 AND p.nation in(99) AND h.provcode in(@prov_c) 
GROUP BY p.check_hosp,p.check_vhid

);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_kpi_childev_prov` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_kpi_childev_prov` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_kpi_childev_prov`()
BEGIN
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
	SET @id := '99';
	SET @cat_id := '1ed90bc32310b503b7ca9b32af425ae5';
	SET @send := '';
	SET @start_d:=concat(@b_year-1,'1001');
	SET @end_d:=concat(@b_year,'0930');
CREATE TABLE IF NOT EXISTS ws_kpi_childev_prov(
id varchar(32) NOT NULL,
hospcode varchar(5) DEFAULT NULL,
areacode varchar(8) DEFAULT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) DEFAULT NULL,
target int(7) DEFAULT 0,
result int(7) DEFAULT 0,
target1 int(7) DEFAULT 0,
result1 int(7) DEFAULT 0,
target2 int(7) DEFAULT 0,
result2 int(7) DEFAULT 0,
target3 int(7) DEFAULT 0,
result3 int(7) DEFAULT 0,
target4 int(7) DEFAULT 0,
result4 int(7) DEFAULT 0,
UNIQUE KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELETE FROM ws_kpi_childev_prov WHERE id=@id AND b_year=(@b_year+543);
INSERT IGNORE INTO ws_kpi_childev_prov 
(
SELECT @id,tb1.HOSPCODE,tb1.areacode,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
,count(DISTINCT tb1.HOSPCODE,tb1.cid) b
,count(DISTINCT IF(tb1.pass=1 ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL))
,count(DISTINCT IF((tb1.m10=1 OR tb1.m11=1 OR tb1.m12=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL)) 
,count(DISTINCT IF(tb1.pass=1 AND (tb1.m10=1 OR tb1.m11=1 OR tb1.m12=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL))
,count(DISTINCT IF((tb1.m01=1 OR tb1.m02=1 OR tb1.m03=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL)) 
,count(DISTINCT IF(tb1.pass=1 AND (tb1.m01=1 OR tb1.m02=1 OR tb1.m03=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL))
,count(DISTINCT IF((tb1.m04=1 OR tb1.m05=1 OR tb1.m06=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL)) 
,count(DISTINCT IF(tb1.pass=1 AND (tb1.m04=1 OR tb1.m05=1 OR tb1.m06=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL))
,count(DISTINCT IF((tb1.m07=1 OR tb1.m08=1 OR tb1.m09=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL)) 
,count(DISTINCT IF(tb1.pass=1 AND (tb1.m07=1 OR tb1.m08=1 OR tb1.m09=1) ,CONCAT(tb1.hospcode,'-',tb1.cid),NULL))
FROM t_childdev1830 tb1
INNER JOIN chospital h ON tb1.HOSPCODE=h.hoscode
WHERE h.provcode=@prov_c
AND (age_18 = 1 OR age_30=1)
GROUP BY tb1.HOSPCODE,tb1.areacode
);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_kpi_ckd_screen` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_kpi_ckd_screen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_kpi_ckd_screen`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= '9';
SET @cat_id := 'e71a73a77b1474e63b71bccf727009ce';
SET @send := '';
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_kpi_ckd_screen(
id varchar(32) NOT NULL,
hospcode varchar(5) DEFAULT NULL,
areacode varchar(8) DEFAULT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) DEFAULT NULL,
target int(10) NOT NULL DEFAULT 0,
result int(10) NOT NULL DEFAULT 0,
result1 int(10) NOT NULL DEFAULT 0,
result2 int(10) NOT NULL DEFAULT 0,
result3 int(10) NOT NULL DEFAULT 0,
result4 int(10) NOT NULL DEFAULT 0,
UNIQUE KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELETE FROM ws_kpi_ckd_screen WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_kpi_ckd_screen 
(
SELECT
@id,hospcode,CONCAT(h.provcode,h.distcode,h.subdistcode,SUBSTR(CONCAT('00',h.mu),-2)) areacode
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(1) target
,SUM(IF(s.minlab_date is not null,1,0) ) result
,SUM(IF(month(s.minlab_date) in (10,11,12),1,0) ) result1
,SUM(IF(month(s.minlab_date) in (1,2,3),1,0) ) result2
,SUM(IF(month(s.minlab_date) in (4,5,6),1,0) ) result3
,SUM(IF(month(s.minlab_date) in (7,8,9),1,0) ) result4
FROM
t_ckd_screen s
INNER JOIN chospital h ON s.hospcode=h.hoscode
WHERE h.provcode in(@prov_c)
GROUP BY s.hospcode
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_kpi_slender6_14` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_kpi_slender6_14` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_kpi_slender6_14`()
BEGIN
SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @id := '1125b85d4faa63e6769794336caed049';
SET @cat_id := 'bfad95ca5ed9f41077bc1cf211ad1347';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_kpi_slender6_14(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target1 int(10) DEFAULT 0,
result1 int(7) DEFAULT 0,
target2 int(10) DEFAULT 0,
result2 int(7) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_kpi_slender6_14 WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_kpi_slender6_14
(
SELECT @id,tb1.HOSPCODE,concat(h.provcode,SUBSTR(CONCAT('00',h.distcode),-2),SUBSTR(CONCAT('00',h.subdistcode),-2),SUBSTR(CONCAT('00',h.mu),-2)) as areacode
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543

,sum(if(tb1.m BETWEEN '10' and '12' ,1,0)) b1
,sum(if(tb1.m BETWEEN '10' and '12' AND tb1.a=1,1,0)) a1
,sum(if(tb1.m BETWEEN '05' and '07' ,1,0)) b2
,sum(if(tb1.m BETWEEN '05' and '07' AND tb1.a=1,1,0)) a2
FROM (
SELECT t01.HOSPCODE,t01.PID,t01.m,if(t01.h_rs in('3','4','5') AND t01.wh_rs=3,1,0) a
FROM (

SELECT n.HOSPCODE,n.PID,n.DATE_SERV ,TIMESTAMPDIFF(MONTH,p.BIRTH,n.DATE_SERV) agem,p.SEX,n.HEIGHT,n.WEIGHT,DATE_FORMAT(n.DATE_SERV,'%m') m
,nutri_cal(TIMESTAMPDIFF(MONTH,p.BIRTH,max(n.DATE_SERV)),p.SEX,2,n.HEIGHT,n.WEIGHT) h_rs
,nutri_cal(TIMESTAMPDIFF(MONTH,p.BIRTH,max(n.DATE_SERV)),p.SEX,3,n.HEIGHT,n.WEIGHT) wh_rs
FROM report_nutrition n INNER JOIN t_person p ON n.HOSPCODE=p.HOSPCODE AND n.PID=p.PID
INNER JOIN 
( SELECT HOSPCODE,PID,max(DATE_SERV) DATE_SERV 
FROM report_nutrition 
WHERE DATE_SERV BETWEEN @start_d AND @end_d 
GROUP BY HOSPCODE,PID
) n1 ON n.HOSPCODE=n1.HOSPCODE AND n.PID=n1.PID AND n.DATE_SERV=n1.DATE_SERV
WHERE n.DATE_SERV BETWEEN @start_d AND @end_d AND TIMESTAMPDIFF(YEAR,p.BIRTH,n.DATE_SERV) BETWEEN 6 AND 14 
GROUP BY n.HOSPCODE,n.PID
ORDER BY HOSPCODE,PID

)t01 
GROUP BY t01.HOSPCODE,t01.PID,t01.m
) tb1
INNER JOIN chospital h ON tb1.HOSPCODE=h.hoscode
WHERE h.provcode=@prov_c
GROUP BY tb1.HOSPCODE
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_kpi_slender6_14_1` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_kpi_slender6_14_1` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_kpi_slender6_14_1`()
BEGIN
SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @id := '2aa9112b2c71abb46da96a99b78ead5e';
SET @cat_id := 'bfad95ca5ed9f41077bc1cf211ad1347';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_kpi_slender6_14_1(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(10) DEFAULT 0,
result1 int(7) DEFAULT 0,
result2 int(7) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_kpi_slender6_14_1 WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_kpi_slender6_14_1
(
SELECT @id,tb1.HOSPCODE,concat(h.provcode,SUBSTR(CONCAT('00',h.distcode),-2),SUBSTR(CONCAT('00',h.subdistcode),-2),SUBSTR(CONCAT('00',h.mu),-2)) as areacode
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543

,count(tb1.HOSPCODE) btotal
,sum(if(tb1.m BETWEEN '10' and '12' ,1,0)) a1
,sum(if(tb1.m BETWEEN '05' and '07' ,1,0)) a2
FROM (
SELECT pe.check_hosp HOSPCODE,pe.CID ,t01.CID cid1,t01.m
FROM 
t_person_cid pe LEFT JOIN 
(
SELECT p.cid,DATE_FORMAT(n.DATE_SERV,'%m') m
FROM report_nutrition n 
INNER JOIN t_person_cid p ON n.CID=p.CID
INNER JOIN ( SELECT cid,max(DATE_SERV) DATE_SERV 
FROM report_nutrition 
WHERE DATE_SERV BETWEEN @start_d AND @end_d 
GROUP BY HOSPCODE,PID
) n1 ON n.cid=n1.cid AND n.DATE_SERV=n1.DATE_SERV
WHERE n.DATE_SERV BETWEEN @start_d AND @end_d AND TIMESTAMPDIFF(YEAR,p.BIRTH,n.DATE_SERV) BETWEEN 6 AND 14 
GROUP BY n.CID
)t01 ON pe.CID=t01.cid
WHERE pe.check_typearea in(1,3) AND pe.DISCHARGE in(9) AND
(TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 1 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 2 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 3 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 4 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 5 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 6 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 7 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 8 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 9 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 10 MONTH) BETWEEN 6 AND 14 OR
TIMESTAMPDIFF(YEAR,pe.BIRTH,@start_d+ INTERVAL 11 MONTH) BETWEEN 6 AND 14 )

GROUP BY pe.check_hosp,pe.CID,t01.m
) tb1
INNER JOIN chospital h ON tb1.HOSPCODE=h.hoscode
WHERE h.provcode=@prov_c
GROUP BY tb1.HOSPCODE);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_nutrition05` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_nutrition05` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_nutrition05`()
BEGIN
SET @prov_c :=(SELECT proviscode FROM wmc_config LIMIT 1);
SET @id:= '7e6f1236e3c26f248a5a2f1e2304685c';
SET @cat_id := '46522b5bd1e06d24a5bd81917257a93c';
SET @send := '';
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET @start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_nutrition05 (
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target1 int(10) DEFAULT 0,
result1 int(10) DEFAULT 0,
ws1 int(10) DEFAULT 0,
hs1 int(10) DEFAULT 0,
wh1 int(10) DEFAULT 0,
fit1 int(10) DEFAULT 0,

target2 int(10) DEFAULT 0,
result2 int(10) DEFAULT 0,
ws2 int(10) DEFAULT 0,
hs2 int(10) DEFAULT 0,
wh2 int(10) DEFAULT 0,
fit2 int(10) DEFAULT 0,

target3 int(10) DEFAULT 0,
result3 int(10) DEFAULT 0,
ws3 int(10) DEFAULT 0,
hs3 int(10) DEFAULT 0,
wh3 int(10) DEFAULT 0,
fit3 int(10) DEFAULT 0,

target4 int(10) DEFAULT 0,
result4 int(10) DEFAULT 0,
ws4 int(10) DEFAULT 0,
hs4 int(10) DEFAULT 0,
wh4 int(10) DEFAULT 0,
fit4 int(10) DEFAULT 0,

PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DELETE FROM ws_nutrition05 WHERE id=@id AND b_year=(@b_year+543);
INSERT IGNORE INTO ws_nutrition05 
(
SELECT
@id,HOSPCODE,CONCAT(h.provcode,h.distcode,h.subdistcode,SUBSTR(CONCAT('00',h.mu),-2)) areacode
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543 as b_year
,COUNT(DISTINCT if(age_t1 < 6 ,n.cid,NULL)) t1
,COUNT(DISTINCT if(age_ms1 < 72 ,n.cid,NULL)) r1
,COUNT(DISTINCT if(age_ms1 < 72 AND w_s1 in(3) ,n.cid,NULL)) ws1
,COUNT(DISTINCT if(age_ms1 < 72 AND h_s1 in(3) ,n.cid,NULL)) hs1
,COUNT(DISTINCT if(age_ms1 < 72 AND wh1 in(3) ,n.cid,NULL)) wh1
,COUNT(DISTINCT if(age_ms1 < 72 AND h_s1 in(3,4,5) AND wh1 in(3) ,n.cid,NULL)) fit1

,COUNT(DISTINCT if(age_t2 < 6 ,n.cid,NULL)) t2
,COUNT(DISTINCT if(age_ms2 < 72 ,n.cid,NULL)) r2
,COUNT(DISTINCT if(age_ms2 < 72 AND w_s2 in(3) ,n.cid,NULL)) ws2
,COUNT(DISTINCT if(age_ms2 < 72 AND h_s2 in(3) ,n.cid,NULL)) hs2
,COUNT(DISTINCT if(age_ms2 < 72 AND wh2 in(3) ,n.cid,NULL)) wh2
,COUNT(DISTINCT if(age_ms2 < 72 AND h_s2 in(3,4,5) AND wh2 in(3) ,n.cid,NULL)) fit2

,COUNT(DISTINCT if(age_t3 < 6 ,n.cid,NULL)) t3
,COUNT(DISTINCT if(age_ms3 < 72 ,n.cid,NULL)) r3
,COUNT(DISTINCT if(age_ms3 < 72 AND w_s3 in(3) ,n.cid,NULL)) ws3
,COUNT(DISTINCT if(age_ms3 < 72 AND h_s3 in(3) ,n.cid,NULL)) hs3
,COUNT(DISTINCT if(age_ms3 < 72 AND wh3 in(3) ,n.cid,NULL)) wh3
,COUNT(DISTINCT if(age_ms3 < 72 AND h_s3 in(3,4,5) AND wh3 in(3) ,n.cid,NULL)) fit3

,COUNT(DISTINCT if(age_t4 < 6 ,n.cid,NULL)) t4
,COUNT(DISTINCT if(age_ms4 < 72 ,n.cid,NULL)) r4
,COUNT(DISTINCT if(age_ms4 < 72 AND w_s4 in(3) ,n.cid,NULL)) ws4
,COUNT(DISTINCT if(age_ms4 < 72 AND h_s4 in(3) ,n.cid,NULL)) hs4
,COUNT(DISTINCT if(age_ms4 < 72 AND wh4 in(3) ,n.cid,NULL)) wh4
,COUNT(DISTINCT if(age_ms4 < 72 AND h_s4 in(3,4,5) AND wh4 in(3) ,n.cid,NULL)) fit4
FROM
t_nutrition05 n
INNER JOIN chospital h ON h.hoscode=n.HOSPCODE
WHERE h.hdc_regist=1 AND h.provcode in(@prov_c) AND typearea in(1,3) 
GROUP BY hospcode
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ws_postnatal` */

/*!50003 DROP PROCEDURE IF EXISTS  `ws_postnatal` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `ws_postnatal`()
BEGIN
SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
SET @b_year:=(SELECT yearprocess FROM wmc_config LIMIT 1);
SET	@id:= 'f50124b9cbc6636272844273980ca42e';
SET @cat_id := '1ed90bc32310b503b7ca9b32af425ae5';
SET	@send := '';
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

CREATE TABLE IF NOT EXISTS ws_postnatal(
id varchar(32) NOT NULL,
hospcode varchar(5) NOT NULL,
areacode varchar(8) NOT NULL,
flag_sent varchar(1) DEFAULT NULL,
date_com varchar(14) DEFAULT NULL,
b_year varchar(4) NOT NULL,
target int(9) DEFAULT 0,
result int(9) DEFAULT 0,
target10 int(9) DEFAULT 0,
result10 int(9) DEFAULT 0,
target11 int(9) DEFAULT 0,
result11 int(9) DEFAULT 0,
target12 int(9) DEFAULT 0,
result12 int(9) DEFAULT 0,
target01 int(9) DEFAULT 0,
result01 int(9) DEFAULT 0,
target02 int(9) DEFAULT 0,
result02 int(9) DEFAULT 0,
target03 int(9) DEFAULT 0,
result03 int(9) DEFAULT 0,
target04 int(9) DEFAULT 0,
result04 int(9) DEFAULT 0,
target05 int(9) DEFAULT 0,
result05 int(9) DEFAULT 0,
target06 int(9) DEFAULT 0,
result06 int(9) DEFAULT 0,
target07 int(9) DEFAULT 0,
result07 int(9) DEFAULT 0,
target08 int(9) DEFAULT 0,
result08 int(9) DEFAULT 0,
target09 int(9) DEFAULT 0,
result09 int(9) DEFAULT 0,
PRIMARY KEY (id,hospcode,areacode,b_year),
KEY (hospcode),
KEY (areacode),
KEY (b_year)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DELETE FROM ws_postnatal WHERE id=@id AND b_year=(@b_year+543);

INSERT IGNORE INTO ws_postnatal 
(
SELECT @id,p.check_hosp,p.check_vhid
,@send,DATE_FORMAT(now(),'%Y%m%d%H%i') as d_com,@b_year+543
,COUNT(DISTINCT CONCAT(l.cid,'-',l.bdate)) target
,COUNT(DISTINCT IF(a.ppcare1 is not null AND a.ppcare2 is not null AND a.ppcare3 is not null 
, CONCAT(a.cid,'-',a.bdate),NULL)) result
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(10), CONCAT(l.cid,'-',l.bdate),NULL)) target10
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(10) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result10
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(11), CONCAT(l.cid,'-',l.bdate),NULL)) target11
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(11) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result11
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(12), CONCAT(l.cid,'-',l.bdate),NULL)) target12
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(12) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result12
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(1), CONCAT(l.cid,'-',l.bdate),NULL)) target1
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(1) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result1
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(2), CONCAT(l.cid,'-',l.bdate),NULL)) target2
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(2) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result2
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(3), CONCAT(l.cid,'-',l.bdate),NULL)) target3
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(3) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result3
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(4), CONCAT(l.cid,'-',l.bdate),NULL)) target4
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(4) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result4
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(5), CONCAT(l.cid,'-',l.bdate),NULL)) target5
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(5) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result5
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(6), CONCAT(l.cid,'-',l.bdate),NULL)) target6
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(6) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result6
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(7), CONCAT(l.cid,'-',l.bdate),NULL)) target7
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(7) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result7
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(8), CONCAT(l.cid,'-',l.bdate),NULL)) target8
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(8) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result8
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(9), CONCAT(l.cid,'-',l.bdate),NULL)) target9
,COUNT(DISTINCT IF(DATE_FORMAT(l.bdate,'%m') in(9) AND a.ppcare1 is not null AND a.ppcare2 is not null 
AND a.ppcare3 is not null , CONCAT(a.cid,'-',a.bdate),NULL)) result9
FROM	t_labor l 
INNER JOIN t_person_cid p ON l.cid=p.cid
INNER JOIN chospital h ON p.check_hosp=h.hoscode
LEFT JOIN t_postnatal a ON l.cid=a.cid AND l.bdate =a.bdate
WHERE l.BDATE BETWEEN @start_d AND @end_d AND l.BTYPE NOT IN(6)
AND p.check_typearea in(1,3) AND p.nation in(99) AND h.provcode in(@prov_c) AND p.discharge IN(9)
GROUP BY p.check_hosp,p.check_vhid
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `xalert` */

/*!50003 DROP PROCEDURE IF EXISTS  `xalert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xalert`()
BEGIN
	DECLARE done INT;
	DECLARE eid,querytype VARCHAR(255);
    DECLARE xquerystring TEXT;
	DECLARE appDBs CURSOR FOR SELECT wmc_xalert_id,wmc_xalert_query,IF(wmc_xalert_querytype IS NULL OR trim(wmc_xalert_querytype) = '',1,0) AS querytype FROM wmc_xalert WHERE wmc_xalert_active = 1;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION UPDATE wmc_xalert SET wmc_xalert_message = CONCAT('ERROR-',now()) WHERE wmc_xalert_id = eid;
  
    OPEN appDBs;
	SET done = 0;
	REPEAT
		FETCH appDBs INTO eid,xquerystring,querytype;
		IF NOT done THEN
        	UPDATE wmc_xalert SET wmc_xalert_start = NOW(),wmc_xalert_status = 'running...',wmc_xalert_message = '' WHERE wmc_xalert_id = eid;

            IF querytype = 1  THEN
				CALL xalertloop(eid,xquerystring);
            ELSE
				SET @output = CONCAT("/*",eid,"*/ DROP TABLE IF EXISTS ",eid);
				PREPARE output FROM @output;
				EXECUTE output;
                SET xquerystring = REPLACE(xquerystring,'{eid}',eid);
				SET @q = CONCAT("/*",eid,"*/ CREATE TABLE IF NOT EXISTS ",eid," ",xquerystring);
				PREPARE q FROM @q;
				EXECUTE q;
			END IF;
            
			UPDATE wmc_xalert SET wmc_xalert_finish = NOW(),wmc_xalert_status = 'finished' WHERE wmc_xalert_id = eid;

		END IF;
		UNTIL done END REPEAT;
	CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xalertdb` */

/*!50003 DROP PROCEDURE IF EXISTS  `xalertdb` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xalertdb`()
BEGIN
	DECLARE done INT;
	DECLARE eid VARCHAR(255);
    DECLARE xquerystring,text TEXT;
	DECLARE appDBs CURSOR FOR SELECT wmc_xalert_id,wmc_xalert_query FROM wmc_xalert WHERE wmc_xalert_active = 1;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION 
    BEGIN
		UPDATE wmc_xalert SET wmc_xalert_message = CONCAT('ERROR-',now()) WHERE wmc_xalert_id = eid;
    END;

    OPEN appDBs;
	SET done = 0;
	REPEAT
		FETCH appDBs INTO eid,xquerystring;
		IF NOT done THEN
        	UPDATE wmc_xalert SET wmc_xalert_start = NOW(),wmc_xalert_status = 'running...',wmc_xalert_message = '' WHERE wmc_xalert_id = eid;
          
            SET @output = CONCAT("/*",eid,"*/ DROP TABLE IF EXISTS ",eid);
			PREPARE output FROM @output;
			EXECUTE output;
            
			SET @output2 = CONCAT("/*",eid,"*/ CREATE TABLE IF NOT EXISTS ",eid," ",xquerystring);
			PREPARE output2 FROM @output2;
			EXECUTE output2;
       
			UPDATE wmc_xalert SET wmc_xalert_finish = NOW(),wmc_xalert_status = 'finished' WHERE wmc_xalert_id = eid;

		END IF;
		UNTIL done END REPEAT;
	CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xalertloop` */

/*!50003 DROP PROCEDURE IF EXISTS  `xalertloop` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xalertloop`(tableName VARCHAR(255),sqlString text)
BEGIN
	DECLARE finish INT;
	DECLARE hcode VARCHAR(255);
	DECLARE queryString TEXT;
	DECLARE loopColumn CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finish = 1;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION SHOW ERRORS;
    
	SET @xquery11 = CONCAT("DROP TABLE IF EXISTS ",tableName);
	PREPARE xquery11 FROM @xquery11;
	EXECUTE xquery11; 
	
	SET @cindex = SUBSTRING_INDEX(SUBSTRING_INDEX(sqlString, '<QUERY>', 1), '<QUERY>', -1);
	SET @cquery = SUBSTRING_INDEX(SUBSTRING_INDEX(sqlString, '<QUERY>', 2), '<QUERY>', -1);

	OPEN loopColumn;
	  SET finish = 0;
	  REPEAT
		FETCH loopColumn INTO hcode ;
		 IF NOT finish THEN
		 
			SET queryString = REPLACE(REPLACE(@cquery,'{db}',hcode),'{eid}',tableName);
			
			SET @xquery12 = CONCAT("CREATE TABLE IF NOT EXISTS ",tableName," ",@cindex," ",queryString," LIMIT 0");
			PREPARE xquery12 FROM @xquery12;
			EXECUTE xquery12;
         
			
			SET @xquery = CONCAT("/* ",tableName," ",hcode," */ INSERT IGNORE INTO ",tableName," ", queryString);
			PREPARE xquery FROM @xquery;
			EXECUTE xquery;
			
		 END IF;
		UNTIL finish END REPEAT;
	CLOSE loopColumn;

END */$$
DELIMITER ;

/* Procedure structure for procedure `xalertSummary` */

/*!50003 DROP PROCEDURE IF EXISTS  `xalertSummary` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xalertSummary`()
BEGIN
	DECLARE done INT;
	DECLARE eid VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT wmc_xalert_id FROM wmc_xalert WHERE wmc_xalert_active = 1;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SHOW ERRORS;
	SET @prov_c := (SELECT proviscode FROM wmc_config LIMIT 1);
	SET @b_year:= (SELECT yearprocess FROM wmc_config LIMIT 1);


	CREATE TABLE IF NOT EXISTS `xalertsummary` (
	  `eid` varchar(36) CHARACTER SET utf8 NOT NULL DEFAULT '',
	  `vhid` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
	  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
	  `cc` bigint(21) NOT NULL DEFAULT '0',
	  `b_year` int(3) NOT NULL DEFAULT '0',
	  `dtstmp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      KEY(eid),KEY(vhid),KEY(hospcode)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	
    OPEN appDBs;
	SET done = 0;
	REPEAT
		FETCH appDBs INTO eid;
		IF NOT done THEN
        
				SET @output = CONCAT("/*xalertSummary*/ DELETE FROM xalertsummary WHERE eid='",eid,"';");
				PREPARE output FROM @output;
				EXECUTE output;
    
                SET @qString = CONCAT("(SELECT
						eid
						,CONCAT(h.provcode,h.distcode,h.subdistcode,SUBSTR(CONCAT('00',h.mu),-2)) AS vhid
						,e.hospcode
						,COUNT(*) AS cc 
                        ,@b_year+543 AS b_year
                        ,NOW() AS dtstmp 
						FROM ",eid," e,chospital h
						WHERE e.hospcode = h.hoscode
						GROUP BY eid,e.hospcode)");
                        
				SET @q = CONCAT("/*xalertSummary_",eid,"*/ INSERT INTO xalertsummary ",@qString);
				PREPARE q FROM @q;
				EXECUTE q;
			
		END IF;
		UNTIL done END REPEAT;
	CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xcheck` */

/*!50003 DROP PROCEDURE IF EXISTS  `xcheck` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xcheck`()
BEGIN

UPDATE wmc_config SET event_scheduler = 
(SELECT IF(user = 'event_scheduler',CONCAT('{"status":"ON","exectime":"',now(),'"}'),'{"status":"OFF"}') as event_scheduler 
FROM INFORMATION_SCHEMA.PROCESSLIST 
WHERE user = 'event_scheduler');



END */$$
DELIMITER ;

/* Procedure structure for procedure `xdatacheck_person_change_typearea` */

/*!50003 DROP PROCEDURE IF EXISTS  `xdatacheck_person_change_typearea` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xdatacheck_person_change_typearea`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow where hospcode = hospcode_cup;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

DROP TABLE xdatacheck_person_change_typearea ;

CREATE TABLE IF NOT EXISTS xdatacheck_person_change_typearea(
  hospcode varchar(5) NOT NULL,
  send_to_pcu_hcode varchar(5) NOT NULL,
  send_to_pcu_date date NOT NULL DEFAULT '0000-00-00',
  cid varchar(13) DEFAULT NULL,
  typearea varchar(1) NOT NULL,
	KEY (hospcode),
	KEY (cid),
	KEY (typearea)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     SET @output = CONCAT("/*xdatacheck_person_change_typearea ",db," */
		
        insert into xdatacheck_person_change_typearea
        (SELECT 
			'",db,"' AS hospcode
			,send_to_pcu_hcode
			,send_to_pcu_date
			,p.cid	
			,p.house_regist_type_id AS typearea
			FROM dw_",db,".clinicmember c 
			LEFT JOIN dw_",db,".person p ON c.hn = p.patient_hn
			WHERE send_to_pcu = 'Y'
			AND send_to_pcu_hcode NOT IN (SELECT hospcode FROM pcu_hos_allow where hospcode = hospcode_cup)
			AND house_regist_type_id IN (1,3)
			AND clinic IN ('001','002')
		);
     ");
     
     PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xdesc_tables` */

/*!50003 DROP PROCEDURE IF EXISTS  `xdesc_tables` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xdesc_tables`()
BEGIN
	DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	#DECLARE CONTINUE HANDLER FOR sqlexception SHOW ERRORS;
	
	DROP TABLES IF EXISTS xdesc_tables;
	
	CREATE TABLE `xdesc_tables` (
	  `table_schema` VARCHAR(100) NOT NULL DEFAULT '',
	  `table_name` VARCHAR(100) NOT NULL DEFAULT '',
	  `column_name` VARCHAR(100) NOT NULL DEFAULT '',
	  `column_key` VARCHAR(3) NOT NULL DEFAULT '',
	  KEY `table_schema` (`table_schema`),
	  KEY `table_name` (`table_name`),
	  KEY `column_name` (`column_name`),
	  KEY `column_key` (`column_key`)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8;
	
	
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET @output = CONCAT("/*xdesc_tables ",db," */
		INSERT INTO xdesc_tables 
		(SELECT table_schema,table_name,column_name,column_key FROM information_schema.columns WHERE table_schema = 'dw_",db,"');
     ");
     
	PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xdwsync_report` */

/*!50003 DROP PROCEDURE IF EXISTS  `xdwsync_report` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xdwsync_report`()
BEGIN

DROP TABLE IF EXISTS xdwsync_report;

/*Datacenter Hosxp*/
CREATE TABLE xdwsync_report
(
key(hospcode),
key(last_update),
key(amp),
key(dreport)
)
(SELECT 
    d.hospcode,
    hosxp_version,
    last_update,
    send_status,
    complete_percent,
    IF(TIMEDIFF(etl_end_time, etl_begin_time) > '00:00:00',
        TIMEDIFF(etl_end_time, etl_begin_time),
        '-') AS usetime,
	(TO_DAYS(CURDATE()) - TO_DAYS(e.last_full_sync_date))  AS dd,
    CONCAT(h.hosptype, ' ', h.name) AS hname,
    hospcode_amp as amp
    ,now() as dreport
FROM
    datacenter.dw_hospcode_allow d
        LEFT OUTER JOIN
    hospcode h ON h.hospcode = d.hospcode
        INNER JOIN
    pcu_hos_allow pha ON pha.hospcode = d.hospcode
        LEFT OUTER JOIN
    datacenter.online_etl e ON e.hospcode = d.hospcode
WHERE
    pha.hospcode <> pha.hospcode_cup
);

END */$$
DELIMITER ;

/* Procedure structure for procedure `xoptimize_table` */

/*!50003 DROP PROCEDURE IF EXISTS  `xoptimize_table` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xoptimize_table`()
BEGIN
DECLARE done INT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	#DECLARE EXIT HANDLER FOR SQLEXCEPTION SELECT "SQLException Error Code: 1061. Duplicate key name 'ix_vn'";
	DECLARE CONTINUE HANDLER FOR 1061 SELECT "MySQL error code 1061 Duplicate key name 'ix_vn'";
    
    
    

    
    /*
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     SET @output = CONCAT("/*add_ix_vn ",db," */
		#OPTIMIZE TABLE `dw_",db,"`.`clinicmember_cormobidity_screen` ADD INDEX `ix_vn` (`vn` ASC) ;
     #");
     /*
		PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
  */

END */$$
DELIMITER ;

/* Procedure structure for procedure `xprocedure_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `xprocedure_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xprocedure_update`()
BEGIN

UPDATE wmc_procedure SET wmc_procedure_querystring = 
(
	SELECT 
		CONCAT('DROP PROCEDURE IF EXISTS `',wmc_procedure_name,'`;\nDELIMITER $$ \nCREATE DEFINER=`root`@`localhost` PROCEDURE `',wmc_procedure_name,'`() \n' ,routine_definition,'$$ \nDELIMITER ;') AS procedure_string 		
        FROM information_schema.routines 
        WHERE specific_name = wmc_procedure_name 
        );

END */$$
DELIMITER ;

/* Procedure structure for procedure `xquery` */

/*!50003 DROP PROCEDURE IF EXISTS  `xquery` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xquery`(queryString text)
BEGIN
	DECLARE done INT;
	DECLARE sqlString TEXT;
	DECLARE db VARCHAR(255);
	DECLARE appDBs CURSOR FOR SELECT hospcode FROM pcu_hos_allow;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	#DECLARE CONTINUE HANDLER FOR sqlexception SHOW ERRORS;
OPEN appDBs;
  SET done = 0;
  REPEAT
    FETCH appDBs INTO db;
     IF NOT done THEN
     
     SET sqlString = REPLACE(queryString,'{db}',db);
     SET @output = CONCAT("/*xquery ",db," */
		",sqlString,"
		");
     
	PREPARE output FROM @output;
        EXECUTE output;
        	
        END IF;
	UNTIL done END REPEAT;
  CLOSE appDBs;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xrunscript` */

/*!50003 DROP PROCEDURE IF EXISTS  `xrunscript` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xrunscript`()
BEGIN
	DECLARE doneLoop INT;
	DECLARE procedure_name VARCHAR(255);
	DECLARE loops CURSOR FOR SELECT trim(wmc_procedure_name) as wmc_procedure_name FROM wmc_procedure WHERE wmc_procedure_active = 1  ORDER BY wmc_procedure_seq ASC,wmc_procedure_name ASC;
	#DECLARE CONTINUE HANDLER FOR NOT FOUND SET doneLoop = 1;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION UPDATE wmc_procedure SET wmc_procedure_message = CONCAT('ERROR-',now()) WHERE wmc_procedure_name = procedure_name;
	
	OPEN loops;
		SET doneLoop = 0;
			REPEAT
				FETCH loops INTO procedure_name;
				IF NOT doneLoop THEN
					UPDATE wmc_procedure SET wmc_procedure_startprocess = NOW(),wmc_procedure_status = 'running...',wmc_procedure_message = '' WHERE wmc_procedure_name = procedure_name;
					SET @querystring = CONCAT('CALL ', procedure_name,';');
					PREPARE querystring FROM @querystring;
					EXECUTE querystring;
                    UPDATE wmc_procedure SET wmc_procedure_finishprocess = NOW(),wmc_procedure_status = 'finished' WHERE wmc_procedure_name = procedure_name;
				END IF;
			UNTIL doneLoop END REPEAT; 
    CLOSE loops;
END */$$
DELIMITER ;

/* Procedure structure for procedure `xws_summary` */

/*!50003 DROP PROCEDURE IF EXISTS  `xws_summary` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xws_summary`()
BEGIN
	DECLARE done INT;
	DECLARE wmc_md5,procedure_name VARCHAR(255);
    DECLARE xquerystring TEXT;
	DECLARE appDBs CURSOR FOR SELECT wmc_procedure_name FROM wmc_procedure WHERE LEFT(wmc_procedure_name,3) = 'ws_' AND wmc_procedure_active = 1;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SHOW ERRORS;
  
    DROP TABLES IF EXISTS xws_summary;
  
    CREATE TABLE IF NOT EXISTS `xws_summary` (
	  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL,
	  `ws_md5` varbinary(32) NOT NULL DEFAULT '',
	  `p` decimal(8,2) DEFAULT NULL,
	  `ss_target` INT(11) DEFAULT NULL,
	  `ss_result` INT(11) DEFAULT NULL,
      `b_year` INT(4) DEFAULT NULL,
		KEY (hospcode),
		KEY (ws_md5),
		KEY (b_year)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    
  
   OPEN appDBs;
	SET done = 0;
	REPEAT
		FETCH appDBs INTO procedure_name;
		IF NOT done THEN
        
        SET @q = CONCAT("/*xws_summary*/ INSERT INTO xws_summary SELECT 
													hospcode
													,MD5('",procedure_name,"') AS ws_md5
													,ROUND((SUM(result)/SUM(target))*100,2) AS p
													,SUM(target) AS ss_target
													,SUM(result) AS ss_result
                                                    ,b_year
													FROM ",procedure_name," 
													GROUP BY hospcode,b_year");
		PREPARE q FROM @q;
		EXECUTE q;
        
        END IF;
		UNTIL done END REPEAT;
	CLOSE appDBs;
  
END */$$
DELIMITER ;

/* Procedure structure for procedure `xws_summary_hdc` */

/*!50003 DROP PROCEDURE IF EXISTS  `xws_summary_hdc` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`ptaung`@`%` PROCEDURE `xws_summary_hdc`()
BEGIN

DROP TABLES IF EXISTS xws_summary_hdc;
    CREATE TABLE IF NOT EXISTS `xws_summary_hdc` (
	  `hospcode` varchar(5) CHARACTER SET utf8 NOT NULL,
	  `ws_md5` varbinary(32) NOT NULL DEFAULT '',
	  `p` decimal(8,2) DEFAULT NULL,
	  `ss_target` INT(11) DEFAULT NULL,
	  `ss_result` INT(11) DEFAULT NULL,
      `b_year` INT(4) DEFAULT NULL,
		KEY (hospcode),
		KEY (ws_md5),
		KEY (b_year)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    
    
    INSERT INTO xws_summary_hdc 
    SELECT 
			hospcode
			,MD5('ws_kpi_ckd_screen') AS ws_md5
			,ROUND((SUM(result)/SUM(target))*100,2) AS p
			,SUM(target) AS ss_target
			,SUM(result) AS ss_result
            ,b_year
			FROM s_kpi_ckd_screen
			GROUP BY hospcode,b_year
	UNION
	SELECT 
			hospcode
			,MD5('ws_kpi_anc12') AS ws_md5
			,ROUND((SUM(result)/SUM(target))*100,2) AS p
			,SUM(target) AS ss_target
			,SUM(result) AS ss_result
            ,b_year
			FROM s_kpi_anc12
			GROUP BY hospcode,b_year
     UNION
     SELECT 
			hospcode
			,MD5('ws_anc5') AS ws_md5
			,ROUND((SUM(result)/SUM(target))*100,2) AS p
			,SUM(target) AS ss_target
			,SUM(result) AS ss_result
            ,b_year
			FROM s_anc5
			GROUP BY hospcode,b_year
     UNION
     SELECT 
			hospcode
			,MD5('ws_postnatal') AS ws_md5
			,ROUND((SUM(result)/SUM(target))*100,2) AS p
			,SUM(target) AS ss_target
			,SUM(result) AS ss_result
            ,b_year
			FROM s_postnatal
			GROUP BY hospcode,b_year
     UNION       
     SELECT 
			hospcode
			,MD5('ws_ht_screen_pop_age') AS ws_md5
			,ROUND((SUM(result_group3+result_group4)/SUM(pop_group3+pop_group4))*100,2) AS p
			,SUM(pop_group3+pop_group4) AS ss_target
			,SUM(result_group3+result_group4) AS ss_result
            ,b_year
			FROM s_ht_screen_pop_age
			GROUP BY hospcode,b_year
     UNION       
     SELECT 
			hospcode
			,MD5('ws_dm_screen_pop_age') AS ws_md5
			,ROUND((SUM(result_group3+result_group4)/SUM(pop_group3+pop_group4))*100,2) AS p
			,SUM(pop_group3+pop_group4) AS ss_target
			,SUM(result_group3+result_group4) AS ss_result
            ,b_year
			FROM s_dm_screen_pop_age
			GROUP BY hospcode,b_year  
     UNION       
     SELECT 
			hospcode
			,MD5('ws_childdev_specialpp') AS ws_md5
			,ROUND((SUM(result9_1+result9_2+result9_3+result18_1+result18_2+result18_3+result30_1+result30_2+result30_3+result42_1+result42_2+result42_3)/SUM(target9+target18+target30+target42))*100,2) AS p
			,SUM(target9+target18+target30+target42) AS ss_target
			,SUM(result9_1+result9_2+result9_3+result18_1+result18_2+result18_3+result30_1+result30_2+result30_3+result42_1+result42_2+result42_3) AS ss_result
            ,b_year
			FROM s_childdev_specialpp
			GROUP BY hospcode,b_year  
     UNION
     SELECT 
			hospcode
			,MD5('ws_ht_control') AS ws_md5
			,ROUND((SUM(result)/SUM(target))*100,2) AS p
			,SUM(target) AS ss_target
			,SUM(result) AS ss_result
            ,b_year
			FROM s_ht_control
			GROUP BY hospcode,b_year
     UNION
     SELECT 
			hospcode
			,MD5('ws_dm_control') AS ws_md5
			,ROUND((SUM(result)/SUM(target))*100,2) AS p
			,SUM(target) AS ss_target
			,SUM(result) AS ss_result
            ,b_year
			FROM s_dm_control
			GROUP BY hospcode,b_year       
	;
    
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
