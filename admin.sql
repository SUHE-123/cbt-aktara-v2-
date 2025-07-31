-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Jul 2025 pada 09.50
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_soal`
--

CREATE TABLE `analisa_soal` (
  `id_analisa` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `id_nomor` int NOT NULL,
  `id_soal` int NOT NULL,
  `jawaban_siswa` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id_bank` int NOT NULL,
  `bank_code` varchar(50) NOT NULL,
  `id_mapel` int NOT NULL,
  `jumlah_soal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `mata_pelajaran` varchar(100) DEFAULT NULL,
  `alamat` text,
  `kontak` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_akun` enum('aktif','nonaktif') DEFAULT 'aktif',
  `sekolah_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nama_lengkap`, `nip`, `jenis_kelamin`, `mata_pelajaran`, `alamat`, `kontak`, `email`, `status_akun`, `sekolah_id`, `created_at`, `updated_at`) VALUES
(3, 8, 'adam', '2222222222', 'Perempuan', 'sejarah', 'rancaekek', '111111111', 'Iyoo@gmail.com', 'aktif', 1, '2025-06-26 08:50:58', '2025-06-26 09:12:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_ujian`
--

CREATE TABLE `hasil_ujian` (
  `id_hasil` int NOT NULL,
  `id_status_ujian` int NOT NULL,
  `id_analisa` int NOT NULL,
  `id_soal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian`
--

CREATE TABLE `jadwal_ujian` (
  `id_jadwal` int NOT NULL,
  `id_mapel` int NOT NULL,
  `id_bank` int NOT NULL,
  `id_jenis_ujian` int NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_tenggat` datetime NOT NULL,
  `durasi` int NOT NULL,
  `durasi_minimal` int DEFAULT '0',
  `acak_soal` tinyint(1) DEFAULT '0',
  `token` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `id_sekolah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_buku`
--

CREATE TABLE `jenis_buku` (
  `id` int NOT NULL,
  `nama_jenis_buku` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jenis_buku`
--

INSERT INTO `jenis_buku` (`id`, `nama_jenis_buku`) VALUES
(1, 'Novel'),
(2, 'komik'),
(3, 'Biografi'),
(4, 'Dongeng'),
(5, 'Antologi'),
(6, 'Nomik'),
(7, 'Ensiklopedi'),
(8, 'Cergam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_ujian`
--

CREATE TABLE `jenis_ujian` (
  `id_jenis_ujian` int NOT NULL,
  `jenis_ujian` varchar(100) NOT NULL,
  `kode_ujian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jenis_ujian`
--

INSERT INTO `jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`, `kode_ujian`) VALUES
(1, 'Penilaian Harian', 'PH'),
(2, 'Penilaian Tengah Semester', 'PTS'),
(3, 'Penilaian Akhir Semester', 'PAS'),
(4, 'Penilaian Akhir Tahun', 'PAT'),
(5, 'Ujian Madarasah Berbasis Komputer', 'UMBK'),
(6, 'Try Out', 'TO'),
(7, 'Simulasi', 'SIML'),
(8, 'Ujian Tulis Berbasis Komputer', 'UTBK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksi_buku`
--

CREATE TABLE `koleksi_buku` (
  `id_buku` int NOT NULL,
  `id_jenis_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `status` enum('tampil','tidak_tampil') DEFAULT 'tampil',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `koleksi_buku`
--

INSERT INTO `koleksi_buku` (`id_buku`, `id_jenis_buku`, `judul`, `deskripsi`, `pengarang`, `penerbit`, `tahun_terbit`, `file_pdf`, `cover`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Siroh Nabawiyah', 'Buku ini mengisahkan perjalanan Nabi Muhammad SAW', 'Asep Suhendar', 'Asep Suhendar', '2025', '1751706948_132d72dd5da6268dc132.pdf', '1751706948_b2c162f33bf9bebceae5.jpg', 'tampil', '2025-07-05 02:15:48', '2025-07-05 03:45:40'),
(2, 1, 'Agama Tanpa Tuhan', 'Novel ini mengajarkan kita untuk tidak ateis', 'Bapak Abi', 'Bapak Abi', '2020', '1751711350_2d0009a3714b7cb84d2f.pdf', '1751711350_a79fa2754c4a3fb6e793.jpg', 'tampil', '2025-07-05 03:29:10', '2025-07-05 03:29:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `kode_mapel` varchar(30) NOT NULL,
  `jenjang` varchar(10) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `guru_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama_mapel`, `kode_mapel`, `jenjang`, `jurusan`, `status`, `guru_id`, `created_at`, `updated_at`) VALUES
(1, 'SKI', '2', 'SMK', 'TKJ', 'aktif', 3, '2025-06-22 15:17:00', '2025-06-26 09:57:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_peserta`
--

CREATE TABLE `nomor_peserta` (
  `id_peserta` int NOT NULL,
  `id_siswa` int NOT NULL,
  `nomor_peserta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int NOT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `jenjang` enum('SD','SMP','SMA','SMK','MA') NOT NULL,
  `status` enum('Negeri','Swasta') DEFAULT 'Swasta',
  `alamat` text,
  `desa_kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kab_kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `kontak` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kepala_sekolah` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `npsn`, `nama_sekolah`, `jenjang`, `status`, `alamat`, `desa_kelurahan`, `kecamatan`, `kab_kota`, `provinsi`, `kode_pos`, `kontak`, `email`, `kepala_sekolah`, `created_at`, `updated_at`) VALUES
(1, '2324', 'SMK Yayasan Islam', 'SMK', 'Swasta', 'bojong', 'cipedes', 'cipedes', 'kota tasikmalaya', 'jawabarat', '2343545', '09897798789', 'asepsuhendaralidzkar@gmail.com', 'Asep Suhendar', '2025-06-21 08:05:00', '2025-06-21 08:05:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi_ujian`
--

CREATE TABLE `sesi_ujian` (
  `id_sesi` int NOT NULL,
  `sesi` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sesi_ujian`
--

INSERT INTO `sesi_ujian` (`id_sesi`, `sesi`, `kode`, `waktu_mulai`, `waktu_selesai`) VALUES
(3, 'Sesi Pagi', 'SPG', '08:00:00', '12:00:00'),
(4, 'Sesi Siang', 'SSG', '13:00:00', '15:00:00'),
(5, 'Sesi Sore', 'SSE', '15:00:00', '17:00:00'),
(6, 'Sesi Full', 'SF', '07:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `alamat` text,
  `kontak` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_akun` enum('aktif','nonaktif') DEFAULT 'aktif',
  `sekolah_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nama_lengkap`, `nis`, `jenis_kelamin`, `kelas`, `alamat`, `kontak`, `email`, `status_akun`, `sekolah_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'asep', '2310614003', 'L', '12', 'Perumahan Buana Suites Sukarindik No. B6', '09897798789', 'asepsuhendaralidzkar@gmail.com', 'aktif', 1, 7, '2025-06-26 01:01:40', '2025-06-26 01:15:43'),
(6, 'nooyouu', '123456767', 'P', '11', 'mitrabatik', '4324342342', 'Udin@gmail.com', 'aktif', 1, 6, '2025-06-26 01:17:36', '2025-06-26 01:19:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int NOT NULL,
  `id_bank` int NOT NULL,
  `soal` text NOT NULL,
  `opsi_a` text,
  `opsi_b` text,
  `opsi_c` text,
  `opsi_d` text,
  `opsi_e` text,
  `jawaban` char(1) NOT NULL,
  `file_soal` varchar(255) DEFAULT NULL,
  `file_a` varchar(255) DEFAULT NULL,
  `file_b` varchar(255) DEFAULT NULL,
  `file_c` varchar(255) DEFAULT NULL,
  `file_d` varchar(255) DEFAULT NULL,
  `file_e` varchar(255) DEFAULT NULL,
  `bobot` float DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_ujian`
--

CREATE TABLE `status_ujian` (
  `id_status_ujian` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `id_peserta` int NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `lama_ujian` int DEFAULT NULL,
  `ulangi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_ujian`
--

CREATE TABLE `token_ujian` (
  `id` int NOT NULL,
  `token` varchar(10) NOT NULL,
  `waktu_dibuat` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `token_ujian`
--

INSERT INTO `token_ujian` (`id`, `token`, `waktu_dibuat`) VALUES
(1, 'NYJVIQ', '2025-06-21 00:16:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `guru_id` int DEFAULT NULL,
  `siswa_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `no_hp`, `foto`, `role`, `guru_id`, `siswa_id`, `created_at`, `updated_at`) VALUES
(4, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'suhe', 'admin@mail.com', '08123456789', '1752093833_00d4c6687b92ea54656b.jpg', 'admin', NULL, NULL, '2025-06-25 08:55:10', '2025-07-09 20:43:55'),
(6, 'noyou', '18138372fad4b94533cd4881f03dc6c69296dd897234e0cee83f727e2e6b1f63', 'yudin', 'Iyoo@gmail.com', '01234567892', '1750900578_5e57565f6181a0ebf87b.png', 'siswa', NULL, NULL, '2025-06-25 02:14:59', '2025-06-26 01:16:18'),
(7, 'siswa', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'siswabaru', 'alfathsilmi7@gmail.com', '0123456789', '1750898015_1c4435ef7dc96d9ddafd.jpg', 'siswa', NULL, NULL, '2025-06-26 00:33:35', '2025-06-26 00:33:35'),
(8, 'gurubaru', '54d5cb2d332dbdb4850293caae4559ce88b65163f1ea5d4e4b3ac49d772ded14', 'guru', 'admin@mail.com', '234234234234', '1750902503_e6dd415922dec67140e1.jpg', 'guru', NULL, NULL, '2025-06-26 01:48:23', '2025-06-26 01:48:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `analisa_soal`
--
ALTER TABLE `analisa_soal`
  ADD PRIMARY KEY (`id_analisa`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_nomor` (`id_nomor`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indeks untuk tabel `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id_bank`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `fk_user_guru` (`user_id`);

--
-- Indeks untuk tabel `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_status_ujian` (`id_status_ujian`),
  ADD KEY `id_analisa` (`id_analisa`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indeks untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indeks untuk tabel `jenis_buku`
--
ALTER TABLE `jenis_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_ujian`
--
ALTER TABLE `jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indeks untuk tabel `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_jenis_buku` (`id_jenis_buku`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_mapel` (`kode_mapel`),
  ADD KEY `fk_mata_pelajaran_guru` (`guru_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nomor_peserta`
--
ALTER TABLE `nomor_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npsn` (`npsn`);

--
-- Indeks untuk tabel `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  ADD PRIMARY KEY (`id_sesi`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `fk_user_siswa` (`user_id`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_bank` (`id_bank`);

--
-- Indeks untuk tabel `status_ujian`
--
ALTER TABLE `status_ujian`
  ADD PRIMARY KEY (`id_status_ujian`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `token_ujian`
--
ALTER TABLE `token_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `analisa_soal`
--
ALTER TABLE `analisa_soal`
  MODIFY `id_analisa` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id_bank` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  MODIFY `id_hasil` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_buku`
--
ALTER TABLE `jenis_buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis_ujian`
--
ALTER TABLE `jenis_ujian`
  MODIFY `id_jenis_ujian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nomor_peserta`
--
ALTER TABLE `nomor_peserta`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  MODIFY `id_sesi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_ujian`
--
ALTER TABLE `status_ujian`
  MODIFY `id_status_ujian` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `analisa_soal`
--
ALTER TABLE `analisa_soal`
  ADD CONSTRAINT `analisa_soal_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_ujian` (`id_jadwal`),
  ADD CONSTRAINT `analisa_soal_ibfk_2` FOREIGN KEY (`id_nomor`) REFERENCES `nomor_peserta` (`id_peserta`),
  ADD CONSTRAINT `analisa_soal_ibfk_3` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`);

--
-- Ketidakleluasaan untuk tabel `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD CONSTRAINT `bank_soal_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_user_guru` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD CONSTRAINT `hasil_ujian_ibfk_1` FOREIGN KEY (`id_status_ujian`) REFERENCES `status_ujian` (`id_status_ujian`),
  ADD CONSTRAINT `hasil_ujian_ibfk_2` FOREIGN KEY (`id_analisa`) REFERENCES `analisa_soal` (`id_analisa`),
  ADD CONSTRAINT `hasil_ujian_ibfk_3` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`);

--
-- Ketidakleluasaan untuk tabel `jadwal_ujian`
--
ALTER TABLE `jadwal_ujian`
  ADD CONSTRAINT `jadwal_ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `jadwal_ujian_ibfk_2` FOREIGN KEY (`id_bank`) REFERENCES `bank_soal` (`id_bank`),
  ADD CONSTRAINT `jadwal_ujian_ibfk_3` FOREIGN KEY (`id_jenis_ujian`) REFERENCES `jenis_ujian` (`id_jenis_ujian`),
  ADD CONSTRAINT `jadwal_ujian_ibfk_4` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`);

--
-- Ketidakleluasaan untuk tabel `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  ADD CONSTRAINT `koleksi_buku_ibfk_1` FOREIGN KEY (`id_jenis_buku`) REFERENCES `jenis_buku` (`id`);

--
-- Ketidakleluasaan untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `fk_mata_pelajaran_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nomor_peserta`
--
ALTER TABLE `nomor_peserta`
  ADD CONSTRAINT `nomor_peserta_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_user_siswa` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank_soal` (`id_bank`);

--
-- Ketidakleluasaan untuk tabel `status_ujian`
--
ALTER TABLE `status_ujian`
  ADD CONSTRAINT `status_ujian_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_ujian` (`id_jadwal`),
  ADD CONSTRAINT `status_ujian_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `nomor_peserta` (`id_peserta`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
