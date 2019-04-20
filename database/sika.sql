/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.21 : Database - sika
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`sika` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sika`;

/*Table structure for table `tb_kas` */

DROP TABLE IF EXISTS `tb_kas`;

CREATE TABLE `tb_kas` (
  `id_kas` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `jenis` varchar(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `debit` varchar(30) DEFAULT NULL,
  `kredit` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kas` */

insert  into `tb_kas`(id_kas,keterangan,jenis,tanggal,debit,kredit) values (1,'investor','debit','2019-04-01','25000000',''),(2,'cuci gudang','kredit','2019-04-22','','500000'),(3,'sewa gedung, dekorasi, rias pengantin, penghulu, mahar, cincin kawin','kredit','2019-04-21',NULL,'10000000'),(4,'kas','debit','2019-04-22','10000000',NULL);

/*Table structure for table `tb_users` */

DROP TABLE IF EXISTS `tb_users`;

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_users` */

insert  into `tb_users`(id_users,nama,email,password) values (1,'mama','ma@ma.com','9dec82f91abcae071b6e01ea5e5474bd45264565a5d3bd7ef7d055b44db68941'),(2,'admin','admin@admin.com','bd8f9e7117de2ccc5b023bdad58c23ac6bf900e549ba7872202cd3e0831e7978');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
