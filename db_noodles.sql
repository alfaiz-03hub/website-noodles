-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2024 pada 21.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_noodles`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_list_order`
--

CREATE TABLE `tb_list_order` (
  `list_order_id` int(11) NOT NULL,
  `menu` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `kategori` int(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `foto`, `nama_menu`, `keterangan`, `kategori`, `harga`, `status`) VALUES
(1, 'mieyamin.png', 'Mie Yamin', ' mi yamin adalah mi ayam tanpa kuah yang dilumuri kecap.', 1, 13000, 1),
(2, 'ramen.png', 'ramen', 'sebuah mie khas jepang', 2, 17000, 1),
(3, 'pasta.png', 'spageti', 'sebuah mie dari benua eropa', 3, 17000, 1),
(4, 'tehmanis.png', 'es teh manis', 'sebuah minuman yang manis dan menyegarkan', 4, 5000, 1),
(18, '424195-jus.png', 'jus alpukat', 'jus dari buah alpukat', 4, 7000, 0),
(19, '63788-mie-yamin.png', 'mie kotok', 'mie tampa mie', 1, 17500, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `pelanggan` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `waktu_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `pelanggan`, `status`, `waktu_order`) VALUES
(1, 'amin', 'pasan', '2024-06-27 14:59:12'),
(2, 'uca', 'pesan', '2024-06-27 16:19:23'),
(3, 'payu', 'pesan', '2024-06-27 16:19:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(1) NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `level`, `nohp`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 1, '0001312267675'),
(2, 'kasir', 'kasir@kasir.com', 'kasir', 2, '0017739273'),
(3, 'koki', 'koki@koki.com', 'koki', 3, '2113432232'),
(5, 'alfa', 'ab@ab.com', '12345', 1, '081262162'),
(19, 'coba', 'coba@coba.com', 'coba', 3, '323352346632');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD PRIMARY KEY (`list_order_id`),
  ADD KEY `menu` (`menu`) USING BTREE,
  ADD KEY `order` (`order`) USING BTREE;

--
-- Indeks untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `status` (`status`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_list_order`
--
ALTER TABLE `tb_list_order`
  MODIFY `list_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD CONSTRAINT `tb_list_order_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `tb_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_list_order_ibfk_2` FOREIGN KEY (`order`) REFERENCES `tb_order` (`id_order`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
