-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 02:44 PM
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
-- Database: `toko_gadget`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `no_hp`, `email`) VALUES
(2, 'Zikri', '0823867747', 'muhammadzikri12@gmail.com'),
(3, 'Sarah Wijaya', '089876543210', 'sarah.wijaya@mail.com'),
(4, 'Ali Akbar', '081345672345', 'akbar@yahoo.com'),
(5, 'Aldan Haposan', '085678912345', 'aldan.haposan@gmail.com'),
(6, 'Imaniatul Jahroh', '087812345678', 'imaniatul@mail.com'),
(7, 'Reiva Damayanti', '081276543210', 'reiva.damayanti@gmail.com'),
(17, 'Nuril', '123456', 'nuril@gmail.com'),
(18, 'Divan', '09876', 'divana@gmail.com'),
(19, 'Aryan', '123456', 'aryan@yahoo.com'),
(20, 'Raditya', '123456', 'raditya@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `qty`, `harga_satuan`) VALUES
(10, 9, 38, 1, 10000000.00),
(11, 10, 41, 1, 8200000.00),
(12, 11, 41, 22, 8200000.00),
(13, 11, 38, 1, 10000000.00),
(14, 11, 5, 1, 2900000.00),
(15, 12, 2, 1, 13000000.00),
(18, 15, 2, 2, 13000000.00),
(19, 15, 38, 1, 10000000.00),
(20, 16, 2, 1, 13000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Smartphone'),
(2, 'Laptop'),
(3, 'Aksesoris'),
(4, 'Tablet'),
(5, 'Smartwatch');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id_merek` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id_merek`, `nama`) VALUES
(1, 'Samsung'),
(2, 'Apple'),
(3, 'ASUS'),
(4, 'Lenovo'),
(5, 'Xiaomi'),
(6, 'HP'),
(8, 'Infinix'),
(9, 'Acer'),
(10, 'OPPO'),
(11, 'Nokia');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_merek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `gambar`, `nama_produk`, `harga`, `stok`, `id_kategori`, `id_merek`) VALUES
(1, 'samsung-a14.jpg', 'Samsung Galaxy A14', 2500000.00, 11, 1, 1),
(2, 'iphone-13.jpg', 'iPhone 13', 13000000.00, 0, 1, 10),
(4, 'lenovo-ideapad-3.jpg', 'Lenovo IdeaPad 3', 6800000.00, 12, 2, 4),
(5, 'xiaomi-redmi-12.jpg', 'Xiaomi Redmi Note 12', 2900000.00, 19, 1, 5),
(38, '683011240c77d.jpg', 'OPPO F11 Pro', 10000000.00, 4, 1, 10),
(39, '6830344a616ca.webp', 'iPhone XR', 7000000.00, 12, 1, 2),
(41, '68329150a1218.jpg', 'HP Pavilion Plus 14', 8200000.00, 2, 2, 6),
(52, '685402e7f0df9.webp', 'Samsung A 54 5g', 5000000.00, 12, 1, 1),
(53, '6854034b0c99b.jpg', 'ASUS Vivobook 14', 7500000.00, 20, 2, 3),
(54, '685405625a5aa.jpg', 'Nokia', 250000.00, 100, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_customer`, `tanggal`, `total`) VALUES
(1, 1, 5, '2025-05-27', 7500000.00),
(4, 1, 2, '2025-06-05', 25000000.00),
(9, 1, 4, '2025-06-14', 10000000.00),
(10, 1, 3, '2025-06-14', 8200000.00),
(11, 1, 6, '2025-06-14', 193300000.00),
(12, 1, 2, '2025-06-17', 13000000.00),
(13, 1, 7, '2025-06-17', 11.00),
(15, 1, 5, '2025-06-19', 36000000.00),
(16, 1, 6, '2025-06-19', 13000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'danis', 'daniswararaditya.mdr@gmail.com', '$2y$10$XV9I81vnXPLDVHWlCRPRsenUNZHJ9su.H284HHisNpOh2axe5F7wa', 'admin'),
(2, 'admin', 'admin@gmail.com', '$2y$10$LWR5WUL5jLhtHz4TjB0Xz.DGRjl/VUXpy83VANVEVGol52fzcB1k6', 'admin'),
(7, 'blikar', 'blikar@gmail.com', '$2y$10$nkqJhPwcXboX9dI12oG1puqMKioAE9nFGNn5bA/d5SP.A1OUdN9SC', ''),
(8, 'amanda', '', '$2y$10$tgwfrNvRYG1bvsWWLpwUhuBVCTDJHYVP325BVvfO6XbOksxrWinye', ''),
(9, 'someone', '', '$2y$10$yksCqpUZkmqVAK51SDZkNup.hVA5mKQwoMuW14lFrq0Uz3Qf9Snb.', ''),
(10, 'apa', '', '$2y$10$2rr5uZivJ1/7zf/i2ZHR0eNmxvXGn8Otf2Ontto.l.lJckOEQbi6q', ''),
(11, 'rismon', '', '$2y$10$qVvTJZ97AfuIX6MMSGyrduohe7SrxwMQBYTH6rCHr23a1HcFsafh2', ''),
(12, 'roy', 'roy@gmail.com', '$2y$10$pQk/OXkDb3E7qwFnLyt5PeceEqNIQ9kOKWmbMyl5gELcMkF2iLDX6', ''),
(13, 'zikri', 'zikri@gmail.com', '$2y$10$eSlk7ER3q0ffCxPKU3U.aujuTDHM4EXG/mx.u3FSwuRBidZyZ.8Ya', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_merek` (`id_merek`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_merek`) REFERENCES `merek` (`id_merek`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
