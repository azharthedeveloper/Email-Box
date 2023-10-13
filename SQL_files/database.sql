/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - email_box
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`email_box` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `email_box`;

/*Table structure for table `emails` */

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `email_to` varchar(100) DEFAULT NULL,
  `email_subject` varchar(200) DEFAULT NULL,
  `email_cc` varchar(200) DEFAULT NULL,
  `email_message` text DEFAULT NULL,
  `sender_status` enum('sent','trash','draft','inbox','delete') DEFAULT NULL,
  `receiver_status` enum('inbox','trash','draft','sent','delete') DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `emails` */

insert  into `emails`(`email_id`,`sender_id`,`email_to`,`email_subject`,`email_cc`,`email_message`,`sender_status`,`receiver_status`,`receiver_id`) values 
(1,1,NULL,'testing subject','ahmed123@gmail.com','demo message','sent','delete',3),
(2,1,'salar123@gmail.com','testing subject',NULL,'demo message','sent','inbox',2),
(3,1,NULL,'testing','salar123@gmail.com','this is testing message','sent','inbox',2),
(4,1,'ahmed123@gmail.com','testing',NULL,'this is testing message','sent','trash',3),
(5,1,NULL,'testing','salar123@gmail.com','this is testing message','sent','inbox',2),
(6,1,'ahmed123@gmail.com','testing',NULL,'this is testing message','sent','delete',3),
(7,1,NULL,'testing','salar123@gmail.com','message demo','sent','inbox',2),
(8,1,'ahmed123@gmail.com','testing',NULL,'message demo','sent','delete',3),
(9,1,NULL,'subject ','salar123@gmail.com','demo message','sent','inbox',2),
(10,1,'ahmed123@gmail.com','subject ',NULL,'demo message','sent','delete',3),
(11,1,NULL,'testing','salar123@gmail.com','demo message testing','sent','inbox',2),
(12,1,'ahmed123@gmail.com','testing',NULL,'demo message testing','sent','trash',3),
(13,1,'ahmed123@gmail.com','testing subject',NULL,'message demo testing','sent','trash',3),
(15,1,'salar123@gmail.com','testing',NULL,'message','sent','inbox',2),
(16,1,NULL,'subject testing','ahmed123@gmail.com','message testing','sent','delete',3),
(17,1,'salar123@gmail.com','subject testing',NULL,'message testing','sent','inbox',2),
(18,1,NULL,'subject testing','ahmed123@gmail.com','message testing','sent','delete',3),
(19,1,'salar123@gmail.com','subject testing',NULL,'message testing','sent','inbox',2),
(20,1,NULL,'subject testing','ahmed123@gmail.com','message testing','sent','trash',3),
(21,1,'salar123@gmail.com','subject testing',NULL,'message testing','sent','inbox',2),
(22,1,NULL,'subject testing','ahmed123@gmail.com','message testing','sent','inbox',3),
(23,1,'salar123@gmail.com','subject testing',NULL,'message testing','sent','inbox',2),
(24,1,NULL,'subject','salar123@gmail.com','message','sent','inbox',2),
(25,1,'ahmed123@gmail.com','subject',NULL,'message','sent','inbox',3),
(26,1,'ahmed123@gmail.com','subject',NULL,'message','sent','inbox',3),
(27,1,'salar123@gmail.com','testing',NULL,'testing message','sent','inbox',2),
(28,2,'muqtadir123@gmail.com','testing',NULL,'Hey Muqtadir','sent','inbox',1),
(29,2,NULL,'demo testing','ahmed123@gmail.com','message demo testing','sent','inbox',3),
(30,2,'muqtadir123@gmail.com','demo testing',NULL,'message demo testing','sent','inbox',1),
(31,3,'salar123@gmail.com','testing',NULL,'demo messaging','delete','inbox',2),
(38,3,NULL,'testing draft',NULL,'draft message','trash',NULL,2),
(39,3,NULL,'draft',NULL,'draft','delete',NULL,2),
(40,4,'salar123@gmail.com','introducing myself',NULL,'hello, salar i am haider new member here','sent','inbox',2),
(41,1,NULL,'Demo 1','ahmed123@gmail.com','lorem12345','sent','inbox',3),
(42,1,'salar123@gmail.com','Demo 1',NULL,'lorem12345','sent','inbox',2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`last_name`,`email`,`password`) values 
(1,'Azhar','Shah','azhar12@gmail.com','123'),
(2,'Salar','Khan','salar123@gmail.com','123'),
(3,'Ahmed','Khan','ahmed123@gmail.com','123'),
(4,'Haider','Khan','haider123@gmail.com','123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
