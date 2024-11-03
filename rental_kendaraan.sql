-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk rental_kendaraan
CREATE DATABASE IF NOT EXISTS `rental_kendaraan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rental_kendaraan`;

-- membuang struktur untuk table rental_kendaraan.akun
CREATE TABLE IF NOT EXISTS `akun` (
  `id_akun` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','pengguna') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pengguna',
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rental_kendaraan.akun: ~1 rows (lebih kurang)
INSERT INTO `akun` (`id_akun`, `nama`, `email`, `no_telp`, `username`, `password`, `role`) VALUES
	('1111111111111111', 'Admin', 'admin@admin.com', '08123456789', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
	('1234567890', 'Rizki Saepul Aziz', 'rzxyss@gmail.com', '08123456789', 'rzxyss', 'cf9b7b236cd373ca364aefbff148e3de', 'pengguna');

-- membuang struktur untuk table rental_kendaraan.kendaraan
CREATE TABLE IF NOT EXISTS `kendaraan` (
  `id_kendaraan` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `merk_kendaraan` varchar(50) NOT NULL,
  `model_kendaraan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tarif` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id_kendaraan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rental_kendaraan.kendaraan: ~1 rows (lebih kurang)
INSERT INTO `kendaraan` (`id_kendaraan`, `jenis_kendaraan`, `merk_kendaraan`, `model_kendaraan`, `tarif`, `status`) VALUES
	('DD 1234 KII', 'Mobil', 'Toyota', 'Avanza', '350000', 0);

-- membuang struktur untuk table rental_kendaraan.sewa
CREATE TABLE IF NOT EXISTS `sewa` (
  `id_sewa` varchar(50) NOT NULL,
  `id_kendaraan` varchar(10) NOT NULL,
  `id_akun` varchar(16) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tarif` varchar(50) NOT NULL,
  `lama_sewa` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_sewa`),
  KEY `id_kendaraan` (`id_kendaraan`),
  KEY `id_akun` (`id_akun`),
  CONSTRAINT `FK_Akun` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Kendaraan` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel rental_kendaraan.sewa: ~0 rows (lebih kurang)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
