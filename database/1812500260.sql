# Host: localhost  (Version 5.5.5-10.4.19-MariaDB)
# Date: 2022-07-28 09:08:30
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "kriteria"
#

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(50) NOT NULL DEFAULT '',
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "kriteria"
#

INSERT INTO `kriteria` VALUES (1,'C1','Absensi','benefit',25),(2,'C2','Pengetahuan Pekerjaan','benefit',15),(3,'C3','Kerjasama','benefit',10),(4,'C4','Loyalitas','benefit',25),(5,'C5','Pemecahan Masalah','benefit',15),(6,'C6','Jumlah Pelanggaran','cost',20);

#
# Structure for table "nilai"
#

DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `id_nilai` int(6) NOT NULL AUTO_INCREMENT,
  `ket_nilai` varchar(45) NOT NULL,
  `jum_nilai` double NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "nilai"
#

INSERT INTO `nilai` VALUES (1,'Sangat Baik',5),(2,'Cukup Baik',4),(3,'Baik',3),(4,'Buruk',2),(5,'Sangat Buruk',1);

#
# Structure for table "pegawai"
#

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pegawai` varchar(50) NOT NULL DEFAULT '',
  `nik` varchar(40) NOT NULL DEFAULT '',
  `nama_pegawai` varchar(255) NOT NULL,
  `jk_pegawai` varchar(19) NOT NULL DEFAULT '',
  `jabatan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `hasil_pegawai` double NOT NULL,
  PRIMARY KEY (`id_pegawai`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "pegawai"
#

INSERT INTO `pegawai` VALUES (1,'A1','2013054980','Enik Susilowati','Perempuan','Store Sr. Leader','',0),(2,'A2','2015076755','Rahmat Jaya','Laki-Laki','Store Sr. Leader','',0),(3,'A3','2015129724','Dea Arfadilah','Perempuan','Crew Store Girl','',0),(4,'A4','2015153334','Syahrul Ramadhan','Laki-Laki','Crew Store Boy','',0),(5,'A5','2015179864','Syaihumul Fattah','Laki-Laki','Crew Store Boy','',0);

#
# Structure for table "pengguna"
#

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "pengguna"
#

INSERT INTO `pengguna` VALUES (1,'Admin','admin','21232f297a57a5a743894a0e4a801fc3');

#
# Structure for table "perhitungan_saw"
#

DROP TABLE IF EXISTS `perhitungan_saw`;
CREATE TABLE `perhitungan_saw` (
  `id_perhitungan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_perhitungan`,`id_pegawai`,`id_kriteria`,`id_tahun`,`id_nilai`) USING BTREE,
  KEY `id_kriteria` (`id_kriteria`) USING BTREE,
  KEY `id_tahun` (`id_tahun`) USING BTREE,
  KEY `id_nilai` (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

#
# Data for table "perhitungan_saw"
#

INSERT INTO `perhitungan_saw` VALUES (1,1,1,1,3),(2,1,2,1,3),(3,1,3,1,2),(4,1,4,1,1),(5,1,5,1,2),(6,1,6,1,3),(7,2,1,1,2),(8,2,2,1,1),(9,2,3,1,3),(10,2,4,1,2),(11,2,5,1,5),(12,2,6,1,5),(13,3,1,1,1),(14,3,2,1,4),(15,3,3,1,5),(16,3,4,1,2),(17,3,5,1,1),(18,3,6,1,4),(19,4,1,1,2),(20,4,2,1,5),(21,4,3,1,4),(22,4,4,1,5),(23,4,5,1,2),(24,4,6,1,3),(25,5,1,1,3),(26,5,2,1,1),(27,5,3,1,2),(28,5,4,1,2),(29,5,5,1,5),(30,5,6,1,3);

#
# Structure for table "rangking"
#

DROP TABLE IF EXISTS `rangking`;
CREATE TABLE `rangking` (
  `id_rangking` int(11) NOT NULL AUTO_INCREMENT,
  `id_perhitungan` int(11) NOT NULL,
  `nilai_rangking` double DEFAULT NULL,
  `nilai_normalisasi` double DEFAULT NULL,
  `bobot_normalisasi` double DEFAULT NULL,
  PRIMARY KEY (`id_rangking`,`id_perhitungan`) USING BTREE,
  KEY `id_perhitungan` (`id_perhitungan`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

#
# Data for table "rangking"
#

INSERT INTO `rangking` VALUES (1,1,3,0.6,15),(2,2,3,0.6,9),(3,3,4,1,10),(4,4,5,1,25),(5,5,4,0.8,12),(6,6,3,0.33333333333333,6.6666666666667),(7,7,4,0.8,20),(8,8,5,1,15),(9,9,3,0.75,7.5),(10,10,4,0.8,20),(11,11,1,0.2,3),(12,12,1,1,20),(13,13,5,1,25),(14,14,2,0.4,6),(15,15,1,0.25,2.5),(16,16,4,0.8,20),(17,17,5,1,15),(18,18,2,0.5,10),(19,19,4,0.8,20),(20,20,1,0.2,3),(21,21,2,0.5,5),(22,22,1,0.2,5),(23,23,4,0.8,12),(24,24,3,0.33333333333333,6.6666666666667),(25,25,3,0.6,15),(26,26,5,1,15),(27,27,4,1,10),(28,28,4,0.8,20),(29,29,1,0.2,3),(30,30,3,0.33333333333333,6.6666666666667);

#
# Structure for table "surat_keputusan"
#

DROP TABLE IF EXISTS `surat_keputusan`;
CREATE TABLE `surat_keputusan` (
  `kode_sk` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_sk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_tahun` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  PRIMARY KEY (`kode_sk`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

#
# Data for table "surat_keputusan"
#

INSERT INTO `surat_keputusan` VALUES (1,'2022-07-06 21:51:26',1,2),(2,'2022-07-06 21:51:26',1,1),(3,'2022-07-06 21:53:19',1,2),(4,'2022-07-06 21:53:19',1,1),(5,'2022-07-07 14:42:25',1,2),(6,'2022-07-12 09:02:34',1,2),(7,'2022-07-12 09:02:35',1,3),(8,'2022-07-12 09:44:48',1,2),(9,'2022-07-12 09:44:48',1,3),(10,'2022-07-12 20:57:22',1,3),(11,'2022-07-12 20:57:23',1,1),(12,'2022-07-23 10:51:28',1,2),(13,'2022-07-23 10:51:29',1,3),(14,'2022-07-23 10:55:54',1,2),(15,'2022-07-23 10:55:54',1,3),(16,'2022-07-23 10:55:59',1,2),(17,'2022-07-23 10:55:59',1,3),(18,'2022-07-23 11:09:41',1,2),(19,'2022-07-23 11:09:42',1,3);

#
# Structure for table "tahun"
#

DROP TABLE IF EXISTS `tahun`;
CREATE TABLE `tahun` (
  `id_tahun` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# Data for table "tahun"
#

INSERT INTO `tahun` VALUES (1,'2021/2022'),(2,'2020/2021'),(3,'2019/2020');
