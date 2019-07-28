-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2019 pada 09.36
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zadmin_akuntansi`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ExtractNumber` (`in_string` VARCHAR(50)) RETURNS INT(11) NO SQL
BEGIN
    DECLARE ctrNumber VARCHAR(50);
    DECLARE finNumber VARCHAR(50) DEFAULT '';
    DECLARE sChar VARCHAR(1);
    DECLARE inti INTEGER DEFAULT 1;

    IF LENGTH(in_string) > 0 THEN
        WHILE(inti <= LENGTH(in_string)) DO
            SET sChar = SUBSTRING(in_string, inti, 1);
            SET ctrNumber = FIND_IN_SET(sChar, '0,1,2,3,4,5,6,7,8,9'); 
            IF ctrNumber > 0 THEN
                SET finNumber = CONCAT(finNumber, sChar);
            END IF;
            SET inti = inti + 1;
        END WHILE;
        RETURN CAST(finNumber AS UNSIGNED);
    ELSE
        RETURN 0;
    END IF;    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `kode_akun` varchar(10) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `kategori_akun` varchar(30) NOT NULL,
  `pajak` varchar(20) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kode_akun`, `nama_akun`, `kategori_akun`, `pajak`, `saldo`) VALUES
('1-10000', 'Kas', 'Kas & Bank', '0', 0),
('1-10002', 'Rekening Bank', 'Kas & Bank', '0', 0),
('1-10003', 'Giro', 'Kas & Bank', '0', 0),
('1-10100', 'Piutang Usaha', 'Akun Piutang', '0', 0),
('1-10101', 'Piutang Belum Ditagih', 'Akun Piutang', '0', 0),
('1-10102', 'Cadangan Kerugian Piutang', 'Akun Piutang', '0', 0),
('1-10200', 'Persediaan Barang', 'Persediaan', '0', 0),
('1-10300', 'Piutang Lainnya', 'Aktiva Lancar Lainnya', '0', 0),
('1-10301', 'Piutang Karyawan', 'Aktiva Lancar Lainnya', '0', 0),
('1-10400', 'Dana Belum Disetor', 'Aktiva Lancar Lainnya', '0', 0),
('1-10401', 'Aset Lancar Lainnya', 'Aktiva Lancar Lainnya', '0', 0),
('1-10402', 'Biaya Dibayar Di Muka', 'Aktiva Lancar Lainnya', '0', 0),
('1-10403', 'Uang Muka', 'Aktiva Lancar Lainnya', '0', 0),
('1-10500', 'PPN Masukan', 'Aktiva Lancar Lainnya', '0', 0),
('1-10501', 'Pajak Dibayar Di Muka - PPh 22', 'Aktiva Lancar Lainnya', '0', 0),
('1-10502', 'Pajak Dibayar Di Muka - PPh 23', 'Aktiva Lancar Lainnya', '0', 0),
('1-10503', 'Pajak Dibayar Di Muka - PPh 25', 'Aktiva Lancar Lainnya', '0', 0),
('1-10700', 'Aset Tetap - Tanah', 'Aktiva Tetap', '0', 0),
('1-10701', 'Aset Tetap - Bangunan', 'Aktiva Tetap', '0', 0),
('1-10702', 'Aset Tetap - Building Improvem', 'Aktiva Tetap', '0', 0),
('1-10703', 'Aset Tetap - Kendaraan', 'Aktiva Tetap', '0', 0),
('1-10704', 'Aset Tetap - Mesin & Peralatan', 'Aktiva Tetap', '0', 0),
('1-10705', 'Aset Tetap - Perlengkapan Kant', 'Aktiva Tetap', '0', 0),
('1-10706', 'Aset Tetap - Aset Sewa Guna Usaha', 'Aktiva Tetap', '0', 0),
('1-10707', 'Aset Tak Berwujud', 'Aktiva Tetap', '0', 0),
('1-10708', 'Hak Merek Dagang', 'Aktiva Tetap', '0', 0),
('1-10709', 'Hak Cipta', 'Aktiva Tetap', '0', 0),
('1-10710', 'Good Will', 'Aktiva Tetap', '0', 0),
('1-10751', 'Akumulasi Penyusutan - Bangunan', 'Depresiasi & Amortisasi', '0', 0),
('1-10752', 'Akumulasi Penyusutan - Building Improvements', 'Depresiasi & Amortisasi', '0', 0),
('1-10753', 'Akumulasi penyusutan - Kendaraan', 'Depresiasi & Amortisasi', '0', 0),
('1-10754', 'Akumulasi Penyusutan - Mesin & Peralatan', 'Depresiasi & Amortisasi', '0', 0),
('1-10755', 'Akumulasi Penyusutan - Peralatan Kantor', 'Depresiasi & Amortisasi', '0', 0),
('1-10756', 'Akumulasi Penyusutan - Aset Sewa Guna Usaha', 'Depresiasi & Amortisasi', '0', 0),
('1-10757', 'Akumulasi Amortisasi', 'Depresiasi & Amortisasi', '0', 0),
('1-10758', 'Akumulasi Amortisasi : Hak Merek Dagang', 'Depresiasi & Amortisasi', '0', 0),
('1-10759', 'Akumulasi Amortisasi : Hak Cipta', 'Depresiasi & Amortisasi', '0', 0),
('1-10760', 'Akumulasi Amortisasi : Good Will', 'Depresiasi & Amortisasi', '0', 0),
('1-10800', 'Investasi', 'Aktiva Lainnya', '0', 0),
('2-1111', 'Pinjaman Sementara', 'Kewajiban Lancar Lainnya', '', 0),
('2-20100', 'Hutang Usaha', 'Akun Hutang', '0', 0),
('2-20101', 'Hutang Belum Ditagih', 'Akun Hutang', '0', 0),
('2-20200', 'Hutang Lain Lain', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20201', 'Hutang Gaji', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20202', 'Hutang Deviden', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20203', 'Pendapatan Diterima Di Muka', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20301', 'Sarana Kantor Terhutang', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20302', 'Bunga Terhutang', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20399', 'Biaya Terhutang Lainnya', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20400', 'Hutang Bank', ' Kewajiban Lancar Lainnya', '0', 0),
('2-20500', 'PPN Keluaran', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20501', 'Hutang Pajak - PPh 21', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20502', 'Hutang Pajak - PPh 22', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20503', 'Hutang Pajak - PPh 23', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20504', 'Hutang Pajak - PPh 29', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20599', 'Hutang Pajak Lainnya', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20600', 'Hutang dari Pemegang Saham', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20601', 'Kewajiban Lancar Lainnya', 'Kewajiban Lancar Lainnya', '0', 0),
('2-20700', 'Kewajiban Manfaat Karyawan', 'Kewajiban Jangka Panjang', '0', 0),
('2222', 'qrttttt', 'Beban Lainnya', '', 0),
('3-30000', 'Modal Saham', 'Ekuitas', '0', 0),
('3-30001', 'Tambahan Modal Disetor', 'Ekuitas', '0', 0),
('3-30100', 'Laba Ditahan', 'Ekuitas', '0', 0),
('3-30200', 'Deviden', 'Ekuitas', '0', 0),
('3-30300', 'Pendapatan Komprehensif Lainnya', 'Ekuitas', '0', 0),
('3-30999', 'Ekuitas Saldo Awal', 'Ekuitas', '0', 0),
('3333', 'wwww', 'Beban', '', 0),
('4-40000', 'Pendapatan Jasa', 'Pendapatan', '0', 0),
('4-40100', 'Diskon Penjualan', 'Pendapatan', '0', 0),
('4-40200', 'Retur Penjualan', 'Pendapatan', '0', 0),
('4-40201', 'Pendapatan Belum Ditagih', 'Pendapatan', '0', 0),
('45555', 'rrrrr', 'Beban', '', 0),
('5-50000', 'Beban Pokok Pendapatan', 'Harga Pokok Penjualan', '0', 0),
('5-50100', 'Diskon Pembelian', 'Harga Pokok Penjualan', '0', 0),
('5-50200', 'Retur Pembelian', 'Harga Pokok Penjualan', '0', 0),
('5-50300', 'Pengiriman & Pengangkutan', 'Harga Pokok Penjualan', '0', 0),
('5-50400', 'Biaya Impor', 'Harga Pokok Penjualan', '0', 0),
('5-50500', 'Biaya Produksi', 'Harga Pokok Penjualan', '0', 0),
('6-1001', 'Biaya makan dan minum', 'Beban', '', 0),
('6-1002', 'Biaya air pam kantor', 'Beban', '', 0),
('6-1400', 'Biaya alat tulis kantor', 'Beban', '', 0),
('6-1402', 'Biaya Pengembangan dan Pendidikan', 'Beban', '', 0),
('6-1500', 'Biaya Parkir, Transport, Tol, Pengangkutan kantor', 'Beban', '', 0),
('6-1501', 'Biaya Operasional lainnya', 'Beban', '', 0),
('6-1900', 'Biaya administrasi bank', 'Beban', '', 0),
('6-2600', 'Biaya Keperluan Kantor', 'Beban', '', 0),
('6-60000', 'Biaya Penjualan', 'Beban', '0', 0),
('6-60001', 'Iklan dan Promosi', 'Beban', '0', 0),
('6-60002', 'Komisi & Fee', 'Beban', '0', 0),
('6-60003', 'Bensin, Tol dan Parkir - Penjualan', 'Beban', '0', 0),
('6-60004', 'Perjalanan Dinas - Penjualan', 'Beban', '0', 0),
('6-60005', 'Komunikasi - Penjualan', 'Beban', '0', 0),
('6-60006', 'Marketing Lainnya', 'Beban', '0', 0),
('6-60007', 'Seragam Pegawai', 'Beban', '0', 0),
('6-60100', 'Biaya Umum & Administratif', 'Beban', '0', 0),
('6-60216', 'Pengeluaran Barang Rusak', 'Beban', '0', 0),
('7-70000', 'Pendapatan Bunga - Bank', 'Pendapatan Lainnya', '0', 0),
('7-70001', 'Pendapatan Bunga - Deposito', 'Pendapatan Lainnya', '0', 0),
('7-70002', 'Pembulatan', 'Pendapatan Lainnya', '0', 0),
('7-70099', 'Pendapatan Lain - lain', 'Pendapatan Lainnya', '0', 0),
('8-80000', 'Beban Bunga', 'Beban Lainnya', '0', 0),
('8-80001', 'Provisi', 'Beban Lainnya', '0', 0),
('8-80002', '(Laba)/Rugi Pelepasan Aset Tetap', 'Beban Lainnya', '0', 0),
('8-80100', 'Penyesuaian Persediaan', 'Beban Lainnya', '0', 0),
('8-80999', 'Beban Lain - lain', 'Beban Lainnya', '0', 0),
('9-90000', 'Beban Pajak - Kini', 'Beban Lainnya', '0', 0),
('9-90001', 'Beban Pajak - Tangguhan', 'Beban Lainnya', '0', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(12) NOT NULL,
  `user` int(20) NOT NULL,
  `tindakan` int(20) NOT NULL,
  `kode_transaksi` varchar(25) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `nama` varchar(40) NOT NULL,
  `tipe_kontak` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat_penagihan` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`nama`, `tipe_kontak`, `email`, `alamat_penagihan`, `phone`) VALUES
('arep', 'Pelanggan,', 'ada@yahoo.com', 'jalan pod', '09'),
('cishe', 'Pelanggan,Supplier,Karyawan,Lain,', 'cishe@yahoo.com', 'jalan indonesia', '089012312'),
('ewq', 'Supplier,', 'w@yahooo.com', 'jalan w', '0920323'),
('P.oki', 'Lain,', 'sdafgg@gmail.com', 'addghh', '13'),
('poo', 'Pelanggan,', 'poo@yahoo.com', 'jalan poo', '08900'),
('putri', 'Pelanggan,Supplier,Karyawan,Lain,', 'putri@yahoo.com', 'jalan puri', '089000000'),
('qwq', 'Supplier,Karyawan,', 'qw@yahoo.com', 'jalan ind', '123'),
('qwqwqwqwqwqw', 'Pelanggan,', 'ada@yahoo.com', 'jalan pod', '09'),
('Rasyidah', 'Pelanggan', 'rasyidah@yahoo.com', 'jalan penambungan', '081249828858'),
('rew', 'Supplier,', 'rew@yahoo.com', 'jalan jew', '3123213213'),
('ridwan', 'Pelanggan,Supplier,', 'ridwan@yahoo.com', 'jalan ridwan', '09123123'),
('rwwwwwwww', 'Pelanggan,', 'ada@yahoo.com', 'jalan pod', '09'),
('ttt', 'Pelanggan,', 't@yahoo.com', 'asd', '34'),
('uu', 'Supplier,Karyawan,', 'u@yahoo.com', 'jalan uu', '08901'),
('wwwwwwwwwwwwwwwwwww', 'Pelanggan,Lain,', 'ada@yahoo.com', 'jalan pod', '09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `mandatory` varchar(20) NOT NULL,
  `write` varchar(8) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` char(15) NOT NULL,
  `fname` char(20) NOT NULL,
  `lname` char(20) DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `count` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`mandatory`, `write`, `username`, `password`, `fname`, `lname`, `last_activity`, `count`) VALUES
('developer', 'enabled', 'adam', 'samsui91', 'avatar', 'avatar', '2019-03-15 15:11:52', 1),
('developer', 'enabled', 'avatar', 'sparkyu19', 'avatar', 'avatar', '2019-03-08 02:05:56', 1),
('direktur', 'enabled', 'edimanik', 'edimanik', '', 'keuangan', '2019-03-11 02:55:10', 1),
('user', 'disabled', 'user', 'user', 'user', 'user', '2019-03-18 08:50:09', 0),
('Audit', 'enabled', 'yanto', 'yanto', 'yanto', '', '2019-03-08 02:05:56', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pajak`
--

CREATE TABLE `pajak` (
  `nama_pajak` varchar(20) NOT NULL,
  `berapa_persen` int(11) NOT NULL,
  `akun_pajak_penjualan` varchar(80) NOT NULL,
  `akun_pajak_pembelian` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pajak`
--

INSERT INTO `pajak` (`nama_pajak`, `berapa_persen`, `akun_pajak_penjualan`, `akun_pajak_pembelian`) VALUES
('adam', 97, '6-60001 | Iklan dan Promosi', '7-70001 | Pendapatan Bunga - Deposito'),
('PPH', 20, '2-20500 | PPN Keluaran', '1-10500 | PPN Masukan'),
('PPN', 10, '2-20500 | PPN Keluaran', '1-10500 | PPN Masukan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(30) NOT NULL,
  `nama_produk` text NOT NULL,
  `akun_beli` text NOT NULL,
  `akun_jual` text NOT NULL,
  `harga_beli_satuan` int(11) NOT NULL,
  `harga_jual_satuan` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `akun_beli`, `akun_jual`, `harga_beli_satuan`, `harga_jual_satuan`, `qty`) VALUES
('BK-10000', 'mouse', '5-50000 | Beban Pokok Pendapatan', '4-40000 | Pendapatan Jasa', 45000, 55000, 100),
('bk-9122', 'kertas', '5-50000 | Beban Pokok Pendapatan', '4-40000 | Pendapatan Jasa', 20000, 30500, 29),
('mk-099', 'gunting', '5-50000 | Beban Pokok Pendapatan', '4-40000 | Pendapatan Jasa', 20000, 30500, 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_koran`
--

CREATE TABLE `rekening_koran` (
  `id` int(11) NOT NULL,
  `kode` varchar(45) NOT NULL,
  `tgl` date NOT NULL,
  `deskripsi` text NOT NULL,
  `debit` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `pembelian` int(11) NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `lainnya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id`, `nama`, `penjualan`, `pembelian`, `pengeluaran`, `lainnya`) VALUES
(1, 'dipayana', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(80) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `kode_akun` varchar(80) NOT NULL,
  `deskripsi` varchar(90) NOT NULL,
  `kolom` varchar(80) NOT NULL,
  `debit` decimal(65,2) NOT NULL,
  `kredit` decimal(65,2) NOT NULL,
  `no` int(11) NOT NULL,
  `qty_produk` int(11) NOT NULL,
  `jumlah_uang` decimal(65,2) NOT NULL,
  `harga_pajak` decimal(65,2) NOT NULL,
  `nama_pajak` varchar(90) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `nama_pajak_ori` varchar(80) NOT NULL,
  `syarat_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `deskripsi`, `kolom`, `debit`, `kredit`, `no`, `qty_produk`, `jumlah_uang`, `harga_pajak`, `nama_pajak`, `nama_produk`, `nama_pajak_ori`, `syarat_pembayaran`) VALUES
('Bank Withdrawal # 10000', '2019-03-15', '4-40000 | Pendapatan Jasa', '', 'kirim_uang', '1000000.00', '0.00', 85, 0, '0.00', '0.00', '', '', '', ''),
('Bank Withdrawal # 10000', '2019-03-15', '1-10000 | Kas', '', 'kirim_uang', '0.00', '1000000.00', 85, 0, '0.00', '0.00', '', '', '', ''),
('Purchase Invoice # 10000', '2019-03-15', '5-50000 | Beban Pokok Pendapatan', '', 'pembelian', '2000000.00', '0.00', 22, 1, '2000000.00', '0.00', '', 'bk-9122 | kertas', '', ''),
('Purchase Invoice # 10000', '2019-03-15', '2-20100 | Hutang Usaha', '', 'pembelian', '0.00', '2000000.00', 22, 0, '0.00', '0.00', '', '', '', ''),
('Sales Invoice # 10000', '2019-03-15', '1-10100 | Piutang Usaha', '', 'penjualan', '1650000.00', '0.00', 0, 0, '0.00', '0.00', '', '', '', ''),
('Sales Invoice # 10000', '2019-03-15', '2-20500 | PPN Keluaran', '', 'penjualan_pajak', '0.00', '150000.00', 0, 0, '0.00', '0.00', '', '', 'PPN | 10%', ''),
('Sales Invoice # 10000', '2019-03-15', '4-40000 | Pendapatan Jasa', '', 'penjualan', '0.00', '1500000.00', 0, 1, '1500000.00', '150000.00', '2-20500 | PPN Keluaran', 'BK-10000 | mouse', 'PPN | 10%', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_akun`
--

CREATE TABLE `transaksi_akun` (
  `kode_transaksi` varchar(80) NOT NULL,
  `no` int(11) NOT NULL,
  `kontak` varchar(80) NOT NULL,
  `tag` varchar(80) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_tempo` date NOT NULL,
  `syarat_pembayaran` varchar(90) NOT NULL,
  `cara_pembayaran` varchar(90) NOT NULL,
  `kolom` varchar(90) NOT NULL,
  `memo` text NOT NULL,
  `tag_2` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_akun`
--

INSERT INTO `transaksi_akun` (`kode_transaksi`, `no`, `kontak`, `tag`, `tgl_transaksi`, `tgl_tempo`, `syarat_pembayaran`, `cara_pembayaran`, `kolom`, `memo`, `tag_2`) VALUES
('Bank Withdrawal # 10000', 85, 'cishe', '', '2019-03-15', '0000-00-00', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `kode` varchar(70) NOT NULL,
  `akun` varchar(80) NOT NULL,
  `pelanggan` varchar(80) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_tempo` date NOT NULL,
  `syarat_pembayaran` varchar(60) NOT NULL,
  `no_referensi` varchar(60) NOT NULL,
  `memo` text NOT NULL,
  `pesan` text NOT NULL,
  `no` int(11) NOT NULL,
  `sisa_tagihan` decimal(65,2) NOT NULL,
  `total` decimal(65,2) NOT NULL,
  `status` varchar(90) NOT NULL,
  `kolom` varchar(90) NOT NULL,
  `tag_2` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`kode`, `akun`, `pelanggan`, `tgl_transaksi`, `tgl_tempo`, `syarat_pembayaran`, `no_referensi`, `memo`, `pesan`, `no`, `sisa_tagihan`, `total`, `status`, `kolom`, `tag_2`) VALUES
('Purchase Invoice # 10000', '', 'ewq', '2019-03-15', '2019-03-15', '', '', '', '', 22, '2000000.00', '2000000.00', 'open', 'pembelian', ''),
('Sales Invoice # 10000', '', 'cishe', '2019-03-15', '2019-03-15', '', '', '', '', 24, '1650000.00', '1650000.00', 'open', 'penjualan', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`nama`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indeks untuk tabel `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`nama_pajak`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `rekening_koran`
--
ALTER TABLE `rekening_koran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_akun`
--
ALTER TABLE `transaksi_akun`
  ADD UNIQUE KEY `no` (`no`);

--
-- Indeks untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD UNIQUE KEY `no_detail_penjualan` (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekening_koran`
--
ALTER TABLE `rekening_koran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_akun`
--
ALTER TABLE `transaksi_akun`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
