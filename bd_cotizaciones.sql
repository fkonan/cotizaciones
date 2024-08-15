/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 5.7.24 : Database - cotizaciones
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cotizaciones` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`documento`,`nombres`,`apellidos`,`correo`,`telefono`,`direccion`,`created_at`,`updated_at`) values 
(3,'1098643625','Fabian','hernandez','fstarblack@gmail.com','3125178877','Cra 32 C 14 51','2024-08-08 22:14:32','2024-08-08 22:14:32');

/*Table structure for table `cotizacion` */

DROP TABLE IF EXISTS `cotizacion`;

CREATE TABLE `cotizacion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'es el asesor',
  `cliente_id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pdf` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coti_user` (`user_id`),
  KEY `fk_coti_cli` (`cliente_id`),
  CONSTRAINT `fk_coti_cli` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_coti_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizacion` */

insert  into `cotizacion`(`id`,`user_id`,`cliente_id`,`fecha`,`subtotal`,`descuento`,`total`,`pdf`,`created_at`,`updated_at`) values 
(7,1,3,'2024-08-09',250000,10000,240000,NULL,'2024-08-09 05:30:59','2024-08-09 05:30:59'),
(8,1,3,'2024-08-09',550000,20000,530000,NULL,'2024-08-09 13:46:49','2024-08-09 13:46:49'),
(9,1,3,'2024-08-09',550000,20000,530000,NULL,'2024-08-09 13:47:32','2024-08-09 13:47:32'),
(10,1,3,'2024-08-09',550000,20000,530000,NULL,'2024-08-09 13:48:57','2024-08-09 13:48:57'),
(11,1,3,'2024-08-09',550000,20000,530000,NULL,'2024-08-09 13:49:31','2024-08-09 13:49:31'),
(12,1,3,'2024-08-09',250000,20000,230000,NULL,'2024-08-09 13:50:09','2024-08-09 13:50:09'),
(13,1,3,'2024-08-09',550000,20000,530000,'cotizaciones/cotizacion_13.pdf','2024-08-09 13:51:25','2024-08-09 13:51:26'),
(14,1,3,'2024-08-09',60000,0,60000,'cotizaciones/cotizacion_14.pdf','2024-08-09 13:55:23','2024-08-09 13:55:24'),
(15,1,3,'2024-08-09',505000,5000,500000,'cotizaciones/cotizacion_15.pdf','2024-08-09 13:59:02','2024-08-09 13:59:02'),
(16,1,3,'2024-08-09',5000,0,5000,'cotizaciones/cotizacion_16.pdf','2024-08-09 14:06:17','2024-08-09 14:06:18'),
(17,1,3,'2024-08-09',20000,1000,19000,'cotizaciones/cotizacion_17.pdf','2024-08-09 14:16:19','2024-08-09 14:16:20'),
(18,1,3,'2024-08-09',10000,0,10000,'cotizaciones/cotizacion_18.pdf','2024-08-09 14:19:05','2024-08-09 14:19:06'),
(19,1,3,'2024-08-09',10000,0,10000,'cotizaciones/cotizacion_19.pdf','2024-08-09 14:19:58','2024-08-09 14:19:59'),
(20,1,3,'2024-08-09',15000,0,15000,'cotizaciones/cotizacion_20.pdf','2024-08-09 14:22:52','2024-08-09 14:22:53'),
(21,1,3,'2024-08-09',250000,20000,230000,'cotizaciones/cotizacion_21.pdf','2024-08-09 14:25:50','2024-08-09 14:25:51'),
(22,1,3,'2024-08-09',10000000,100000,9900000,'cotizaciones/cotizacion_22.pdf','2024-08-09 14:28:27','2024-08-09 14:28:28'),
(23,1,3,'2024-08-09',20000,0,20000,'cotizaciones/cotizacion_23.pdf','2024-08-09 14:29:09','2024-08-09 14:29:10'),
(24,1,3,'2024-08-09',550000,20000,530000,'cotizaciones/cotizacion_24.pdf','2024-08-09 14:30:18','2024-08-09 14:30:19');

/*Table structure for table `cotizacion_detalle` */

DROP TABLE IF EXISTS `cotizacion_detalle`;

CREATE TABLE `cotizacion_detalle` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cotizacion_id` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coti_det` (`cotizacion_id`),
  KEY `fk_coti_prod` (`producto_id`),
  CONSTRAINT `fk_coti_det` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_coti_prod` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cotizacion_detalle` */

insert  into `cotizacion_detalle`(`id`,`cotizacion_id`,`producto_id`,`cantidad`,`valor`,`subtotal`,`descuento`,`total`,`iva`) values 
(2,7,2,10,5000,50000,0,50000,0),
(3,7,3,20,10000,200000,10000,190000,0),
(4,8,2,10,5000,50000,0,50000,0),
(5,8,3,50,10000,500000,20000,480000,0),
(6,9,2,10,5000,50000,0,50000,0),
(7,9,3,50,10000,500000,20000,480000,0),
(8,10,2,10,5000,50000,0,50000,0),
(9,10,3,50,10000,500000,20000,480000,0),
(10,11,2,10,5000,50000,0,50000,0),
(11,11,3,50,10000,500000,20000,480000,0),
(12,12,2,10,5000,50000,0,50000,0),
(13,12,3,20,10000,200000,20000,180000,0),
(14,13,2,10,5000,50000,0,50000,0),
(15,13,3,50,10000,500000,20000,480000,0),
(16,14,2,12,5000,60000,0,60000,0),
(17,15,2,1,5000,5000,0,5000,0),
(18,15,3,50,10000,500000,5000,495000,0),
(19,16,2,1,5000,5000,0,5000,0),
(20,17,3,2,10000,20000,1000,19000,0),
(21,18,2,2,5000,10000,0,10000,0),
(22,19,2,2,5000,10000,0,10000,0),
(23,20,2,3,5000,15000,0,15000,0),
(24,21,2,50,5000,250000,20000,230000,0),
(25,22,3,1000,10000,10000000,100000,9900000,0),
(26,23,3,2,10000,20000,0,20000,0),
(27,24,2,10,5000,50000,0,50000,0),
(28,24,3,50,10000,500000,20000,480000,0);

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representante` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`nit`,`razon_social`,`representante`,`direccion`,`ciudad`,`telefono`,`web`,`correo`,`logo`) values 
(1,'900818901','ITICA','fabian hernandez','Cra 32 C 14 51','Bucaramanga','3125178877',NULL,'fabian@gmail.com','66b53d8a7647f.png');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2014_10_12_100000_create_password_resets_table',2);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`producto`,`valor`,`foto`) values 
(2,'carpeta',5000,'66b53590252f9.png'),
(3,'calculadora',10000,'66b535af05aeb.png');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`documento`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,NULL,'admin','admin@gmail.com',NULL,'$2y$12$5IyCcTN.jrjtqNv6ZsYQvejfnq0cjXWcxgt7Z3iuzUhQOiPKv38hu',NULL,'2024-07-28 00:09:53','2024-07-28 00:09:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
