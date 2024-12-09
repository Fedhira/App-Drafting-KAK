-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drafting`
--

-- --------------------------------------------------------

--
-- Table structure for table `kak`
--

CREATE TABLE `kak` (
  `kak_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `no_doc_mak` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `status` enum('pending','disetujui','ditolak','draft') NOT NULL,
  `latar_belakang` text NOT NULL,
  `dasar_hukum` text NOT NULL,
  `gambaran_umum` text NOT NULL,
  `tujuan` text NOT NULL,
  `target_sasaran` text NOT NULL,
  `unit_kerja` text NOT NULL,
  `ruang_lingkup` text NOT NULL,
  `produk_jasa_dihasilkan` text NOT NULL,
  `waktu_pelaksanaan` text NOT NULL,
  `tenaga_ahli_terampil` text NOT NULL,
  `peralatan` text NOT NULL,
  `metode_kerja` text NOT NULL,
  `manajemen_resiko` text NOT NULL,
  `laporan_pengajuan_pekerjaan` text NOT NULL,
  `sumber_dana_prakiraan_biaya` text NOT NULL,
  `penutup` text NOT NULL,
  `lampiran` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kak`
--

INSERT INTO `kak` (`kak_id`, `user_id`, `kategori_id`, `no_doc_mak`, `judul`, `status`, `latar_belakang`, `dasar_hukum`, `gambaran_umum`, `tujuan`, `target_sasaran`, `unit_kerja`, `ruang_lingkup`, `produk_jasa_dihasilkan`, `waktu_pelaksanaan`, `tenaga_ahli_terampil`, `peralatan`, `metode_kerja`, `manajemen_resiko`, `laporan_pengajuan_pekerjaan`, `sumber_dana_prakiraan_biaya`, `penutup`, `lampiran`, `created_at`, `updated_at`) VALUES
(20, 5, 4, '3545867', 'ahshjs', 'ditolak', '<p>&nbsp;</p><p>sdhks</p>', '<p>shdhj</p>', '<p>sdhjhjsd</p>', '<p>i0zixx</p>', '<p>ls smxnm</p>', '<p>znxsjxhjs</p>', '<p>sxhhjxhsb</p>', '<p>xgshjxuis</p>', '<p>sjshjxs</p>', '<p>sbxbssn</p>', '<p>shxbs</p>', '<p>xhshjxs</p>', '<p>xsbxhjss</p>', '<p>shxhsxb</p>', '<p>cbdjcx</p>', '<p>sdhbd</p>', '', '2024-11-21 10:22:46', '2024-12-03 08:45:36'),
(22, 5, 1, '465768787', 'hhhjkh', 'disetujui', '<p>kjhbvb</p>', '<p>jbhbjn</p>', '<p>nkbjn</p>', '<p>nbn</p>', '<p>jnjbjjk</p>', '<p>nbnk</p>', '<p>nbjkn</p>', '<p>bjkbn</p>', '<p>nknb nk</p>', '<p>njhjjnk</p>', '<p>mknjhb</p>', '<p>njbhvbj</p>', '<p>njhbkjn</p>', '<p>jbjnkm</p>', '<p>mn nkm</p>', '<p>mb nj</p>', 'Acer_Wallpaper_02_5000x2813.jpg', '2024-11-26 12:05:15', '2024-11-26 13:56:07'),
(23, 5, 4, '465768787', ' jbnkj', 'ditolak', '<p>klnjknk</p>', '<p>njkhbjkj</p>', '<p>m knbjk</p>', '<p>kljbjk</p>', '<p>mnnbjkj</p>', '<p>ljkbjhk</p>', '<p>jbh</p>', '<p>m nbjb</p>', '<p>jknm</p>', '<p>ljhbjk</p>', '<p>mnbk</p>', '<p>kljbkjn</p>', '<p>nlnjkbjn</p>', '<p>jnb&nbsp;</p>', '<p>jknbjhnm</p>', '<p>kjhbjkjn</p>', '', '2024-11-26 12:23:46', '2024-11-26 12:24:00'),
(28, 5, 5, 'hjvbj', 'hvbb', 'pending', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-12-01 14:06:28', '2024-12-01 14:06:48'),
(31, 5, 4, 'nbnm', 'khjbvkb', 'draft', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-01 14:10:49', '2024-12-01 14:10:49'),
(32, 5, 4, 'hshah', 'xhssb', 'ditolak', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-01 15:53:37', '2024-12-01 15:53:37'),
(34, 5, 4, '3545867', 'jk', 'pending', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-12-02 11:26:09', '2024-12-02 11:27:26'),
(35, 5, 4, '3545867', 'hbhb', 'ditolak', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-02 11:40:02', '2024-12-02 11:40:02'),
(36, 5, 4, 'waredf354678', 'vhjvb', 'draft', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-02 11:44:00', '2024-12-02 11:44:00'),
(37, 5, 2, '3545867', 'jh', 'draft', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-02 11:48:28', '2024-12-02 11:48:28'),
(38, 5, 2, '3545867', 'jh', 'draft', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-02 13:31:51', '2024-12-02 13:31:51'),
(39, 18, 5, '35458672', 'apajadeh', 'pending', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Array', '2024-12-03 13:48:21', '2024-12-03 13:48:21'),
(42, 5, 7, '2024-001', 'Pengadaan Perangkat Keras dan Perangkat Lunak untuk Kebutuhan Divisi', 'draft', '<p>Seiring dengan perkembangan kebutuhan teknologi yang semakin kompleks di lingkungan divisi pengadaan dan sistem informasi, diperlukan perangkat keras dan perangkat lunak yang mendukung operasional kerja secara optimal. Pengadaan ini bertujuan untuk meningkatkan efisiensi, efektivitas, serta kapasitas kerja divisi dalam melaksanakan tugas-tugasnya.</p>', '<p>Pengadaan perangkat keras dan perangkat lunak ini mengacu pada:</p><ul><li>Peraturan Pemerintah No. XX/XXXX tentang Pengadaan Barang/Jasa</li><li>Peraturan Menteri terkait pengadaan di instansi pemerintah</li><li>Pedoman pengadaan dan kebijakan terkait dari lembaga terkait.</li></ul>', '<p>Pengadaan ini meliputi pembelian dan pemasangan perangkat keras (seperti komputer, server, dan jaringan) serta perangkat lunak (sistem operasi, aplikasi produktivitas, dan software pendukung lainnya) untuk menunjang kegiatan operasional divisi.</p>', '<p>Maksud dari pengadaan ini adalah untuk meningkatkan kualitas dan kapasitas teknologi yang digunakan oleh divisi. Tujuannya adalah mendukung kelancaran pekerjaan dan pelayanan yang lebih baik melalui penerapan teknologi yang tepat dan efisien.</p>', '<p>Sasaran dari pengadaan ini adalah memastikan semua unit kerja dalam divisi memiliki perangkat yang memadai untuk melaksanakan tugas-tugasnya dengan baik.</p>', '<p>Divisi pengadaan dan sistem informasi</p>', '<ol><li>Pengadaan dan pengiriman perangkat keras dan perangkat lunak.</li><li>Instalasi dan konfigurasi perangkat yang diperlukan.</li><li>Pelatihan pemanfaatan perangkat untuk staf.</li></ol>', '<ol><li>Perangkat keras dan perangkat lunak yang siap digunakan.</li><li>Dokumen panduan penggunaan perangkat.</li></ol>', '<p>Pengadaan diharapkan selesai dalam jangka waktu [jumlah waktu, misalnya: 3 bulan] sejak tanggal pengesahan KAK.</p>', '<ul><li>Tim teknis dari divisi IT.</li><li>Konsultan pihak ketiga yang memiliki sertifikasi terkait.</li></ul>', '<ol><li>Peralatan tambahan yang diperlukan untuk instalasi (misalnya: kabel, switch, dll).Pengadaan dan evaluasi vendor melalui tender atau proses seleksi.</li><li>Pengadaan barang melalui proses pembelian di marketplace resmi atau penyedia terpercaya.</li><li>Instalasi perangkat dan verifikasi fungsi.</li></ol>', '<ul><li>Risiko keterlambatan pengiriman.</li><li>Risiko kompatibilitas perangkat dengan sistem lama.</li><li>Risiko keamanan data saat proses pengiriman dan instalasi.</li></ul>', '<p>Laporan harus mencakup rincian anggaran, kontrak kerja, dan progres pengadaan.</p>', '<p>Dana untuk pengadaan ini bersumber dari [sumber dana, misalnya: Anggaran Divisi, APBN/APBD, dsb].</p>', '<p>Diharapkan pengadaan ini dapat memperkuat kapasitas divisi dan mendukung pencapaian target kerja yang lebih baik.</p>', '<p>Diharapkan pengadaan ini dapat memperkuat kapasitas divisi dan mendukung pencapaian target kerja yang lebih baik.</p>', 'Contoh-Surat-Pengajuan-Barang-3_page-0001-scaled-e1683773397994.jpg', '2024-12-09 17:53:13', '2024-12-09 17:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_program`
--

CREATE TABLE `kategori_program` (
  `kategori_id` int(11) NOT NULL,
  `nama_divisi` char(100) NOT NULL,
  `status` enum('plt','definitif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_program`
--

INSERT INTO `kategori_program` (`kategori_id`, `nama_divisi`, `status`) VALUES
(1, 'Direktur Utama', 'definitif'),
(2, 'Kepala Satuan Pemeriksa Intern', 'plt'),
(3, 'Direktur Sumber Daya Administrasi', 'plt'),
(4, 'Kepala Divisi Perencanaan Strategis', 'definitif'),
(5, 'Kepala Divisi Sumber Daya Manusia dan Hubungan Masyarakat', 'definitif'),
(6, 'Kepala Divisi Hukum', 'definitif'),
(7, 'Kepada Divisi Pengadaan dan Sistem Informasi', 'definitif'),
(9, 'Direktur Keuangan', 'plt'),
(10, 'Kepala Divisi Pengelolaan Pendapatan', 'plt'),
(11, 'Kepala Divisi Perbendaharaan dan Investasi', 'definitif'),
(12, 'Kepala Divisi Penyusunan Anggaran dan Akuntansi', 'definitif'),
(13, 'Kepala Divisi Manajemen Resiko', 'definitif'),
(14, 'Direktur Infrastruktur', 'definitif'),
(15, 'Kepala Divisi Satelit', 'definitif'),
(16, 'Kepala Divisi Infrastruktur Lastmile/Backhaul', 'plt'),
(17, 'Kepala Divisi Infrastruktur Backbone', 'definitif'),
(18, 'Direktur Layanan Telekomunikasi dan Informasi Masyarakat dan Pemerintah', 'plt'),
(19, 'Kepala Divisi Layanan Telekomunikasi dan Informasi Masyarakat', 'definitif'),
(20, 'Kepala Divisi Layanan Telekomunikasi dan Informasi Pemerintah', 'definitif'),
(21, 'Direktur Layanan Telekomunikasi dan Informasi Badan Usaha', 'plt'),
(22, 'Kepala Divisi Layanan Telekomunikasi dan Informasi Badan Usaha I', 'definitif'),
(23, 'Kepala Divisi Layanan Telekomunikasi dan Informasi Badan Usaha II\r\n', 'plt'),
(26, 'Kepala Divisi Sumber Daya Manusia dan Hubungan Masyarakat', 'plt');

-- --------------------------------------------------------

--
-- Table structure for table `revisi`
--

CREATE TABLE `revisi` (
  `revisi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kak_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `alasan_penolakan` text NOT NULL,
  `saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `revisi`
--

INSERT INTO `revisi` (`revisi_id`, `user_id`, `kak_id`, `kategori_id`, `alasan_penolakan`, `saran`) VALUES
(1, 0, 0, 0, 'hhh', 'hh'),
(2, 0, 0, 0, 'shhs', 'shhs'),
(3, 0, 0, 0, 'lll', 'ksk'),
(4, 5, 20, 4, 'ahah', 'ahah'),
(5, 5, 22, 1, 'nan', 'jaja'),
(6, 0, 20, 0, 'jh', 'hgh'),
(7, 0, 22, 0, 'ahha', 'ahah'),
(8, 0, 20, 0, 'hjb', 'jelek'),
(9, 0, 32, 0, 'hh', 'jjj'),
(10, 0, 32, 0, 'hdhd', 'hha'),
(11, 0, 23, 0, 'ahaha', 'aahha'),
(12, 0, 22, 0, 'ahaha', 'aaha'),
(13, 0, 20, 0, 'jfjfj', 'ffjf'),
(14, 0, 22, 0, 'fufjf', 'ffkf'),
(15, 0, 23, 0, 'fufjffjfj', 'fff'),
(16, 0, 32, 0, 'fjfjf', 'fkfkf'),
(17, 0, 35, 0, 'gagaga', 'males'),
(18, 5, 23, 4, 'jwheh', 'ejej'),
(19, 5, 20, 4, 'sjs', 'yaya'),
(20, 0, 0, 0, ' m m', 'cdmke');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `kategori_id` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(17) NOT NULL,
  `role` enum('admin','user','supervisor') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `kategori_id`, `username`, `email`, `password`, `nik`, `role`, `created_at`, `updated_at`) VALUES
(1, 22, 'admin', 'admin@gmail.com', '$2y$10$X1rDHMbTbOL7dzQg1SIc8eJmdGLt8AJLVeqlqXr06mdAsM/0Rpxe2', '1214673268290789', 'admin', '2024-10-21 04:44:38', '2024-12-02 14:32:45'),
(4, 16, 'sandiii', 'sandi@gmail.com', '$2y$10$Hz93CSF1zG0MxwN8NRVEZ.NestendrNEcwlZFsXSheeiqfjdP0IBu', '16533263263', 'user', '2024-10-26 14:17:06', '2024-12-02 10:50:56'),
(5, 15, 'fedhira', 'fedhira@gmail.com', '$2y$10$II.zk.mNp2KshzZ9.Ph8MOVDhxcmEBL32KwgGrKmrRVheIkNLLnIC', '12455762276172175', 'user', '2024-10-28 10:35:11', '2024-10-28 10:35:20'),
(7, 13, 'dupi', 'dupi@gmail.com', '$2y$10$gpZfHOtyMShcHnjF3B6bGuBJcLGTkoVbCKtPkDKWGKGHKKJ0GgiTu', '124356272773', 'supervisor', '2024-10-28 10:47:50', '2024-10-28 11:02:55'),
(13, 2, 'lala', 'lala@gmail.com', '$2y$10$zU61aRbKB9cxeVH1rBgerOsFywoscrWBPjXAyymdCTnyr6voK7uTy', '2536237223723', 'supervisor', '2024-12-02 11:23:16', '2024-12-02 14:32:39'),
(15, 4, 'yelloween', 'test@gmail.com', '$2y$10$gSPURn6OH/xLoXP7ELwhX.JeQOO7Ls2oXAJGnbZ4nVT6KftSUHMiS', '12146732682907805', 'user', '2024-12-02 11:45:09', '2024-12-02 11:45:09'),
(18, 9, 'renjun', 'renjun@gmail.com', '$2y$10$XSZDMGilNQRvYJloEwr80uGPcfL00DOTH2NgQUjH7NoEIqHlUmqkm', '2565336268', 'user', '2024-12-03 11:00:31', '2024-12-03 11:00:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kak`
--
ALTER TABLE `kak`
  ADD PRIMARY KEY (`kak_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `kategori_program`
--
ALTER TABLE `kategori_program`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `revisi`
--
ALTER TABLE `revisi`
  ADD PRIMARY KEY (`revisi_id`),
  ADD KEY `kak_id` (`kak_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kak`
--
ALTER TABLE `kak`
  MODIFY `kak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `kategori_program`
--
ALTER TABLE `kategori_program`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `revisi`
--
ALTER TABLE `revisi`
  MODIFY `revisi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kak`
--
ALTER TABLE `kak`
  ADD CONSTRAINT `kak_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kak_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_program` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_program` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
