-- masukkan data-data kedalam tabel database perbankan

INSERT INTO nasabah (id_nasabah, nama_nasabah, alamat_nasabah) VALUES 
    (1, 'Sutopo', 'Jl. Jendral Sudirman 12'),
    (2, 'Maryati', 'Jl. MT. Haryono 31'),
    (3, 'Suparman', 'Jl. Hasanudin 81'),
    (4, 'Kartika Padmasari', 'Jl. Manggis 15'),
    (5, 'Budi Eko Prayogo', 'Jl. Kantil 30'),
    (6, 'Satria Eka Jaya', 'Jl. Slamet Riyadi 45'),
    (7, 'Indri Hapsari', 'Jl. Sutoyo 5'),
    (8, 'Sari Murti', 'Jl. Pangandaran 11'),
    (9, 'Canka Lokananta', 'Jl. Tidar 86'),
    (10, 'Budi Murtono', 'Jl. Merak 22');

INSERT INTO cabang_bank (kode_cabang, nama_cabang, alamat_cabang) VALUES
    ('BRUS', 'Bank Rut Unit Surakarta', 'jl. Slamet Riyadi 18'),
    ('BRUM', 'Bank Rut Unit Magelang', 'jl. P.Tendean 63'),
    ('BRUB', 'Bank Rut Unit Boyolali', 'jl. Ahmad yani 45'),
    ('BRUK', 'Bank Rut Unit Klaten', 'jl. Suparman 23'),
    ('BRUY', 'Bank Rut Unit Yogyakarta', 'jl. Anggrek 21'),
    ('BRUW', 'Bank Rut Unit Wonogiri', 'jl. Untung Sutropati 12');

INSERT INTO rekening (no_rekening, kode_cabangFK, pin, saldo) VALUES
(101, 'BRUS', '1111', 500000),
(102, 'BRUS', '2222', 350000),
(103, 'BRUS', '3333', 750000),
(104, 'BRUM', '4444', 900000),
(105, 'BRUW', '5555', 200000),
(106, 'BRUS', '6666', 300000),
(107, 'BRUS', '7777', 100000),
(108, 'BRUB', '0000', 500000),
(109, 'BRUS', '9999', 0),
(110, 'BRUY', '1234', 550000),
(111, 'BRUK', '4321', 150000),
(112, 'BRUK', '0123', 300000),
(113, 'BRUY', '8888', 255000);


INSERT INTO nasabah_has_rekening (id_nasabahFK, no_rekeningFK) VALUES
(1, 104),
(2, 103),
(3, 105),
(3, 106),
(4, 101),
(4, 107),
(5, 102),
(5, 107),
(6, 109),
(7, 111),
(8, 112),
(9, 110),
(10, 108),
(10, 113);


INSERT INTO nasabah_has_rekening (id_nasabahFK, no_rekeningFK) VALUES
(1, 104),
(2, 103),
(3, 105),
(3, 106),
(4, 101),
(4, 107),
(5, 102),
(5, 107),
(6, 109),
(7, 109),
(8, 111),
(9, 110),
(10, 113),
(8, 112),
(10, 108);



CREATE TABLE IF NOT EXISTS `transaksi` (
`no_transaksi` bigint(20) unsigned NOT NULL,
  `id_nasabahFK` int(11) DEFAULT NULL,
  `no_rekeningFK` int(11) DEFAULT NULL,
  `jenis_transaksi` varchar(20) NOT NULL DEFAULT 'debit',
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

CREATE TABLE transaksi (
    no_transaksi SERIAL PRIMARY KEY,
    id_nasabahFK INTEGER REFERENCES nasabah(id_nasabah) ON DELETE SET NULL ON UPDATE CASCADE, 
    jenis_transaksi VARCHAR(20) DEFAULT 'debit' NOT NULL,
    tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    jumlah INTEGER NOT NULL CHECK (jumlah>=20000)
);

INSERT INTO transaksi (no_transaksi,no_rekeningFK, id_nasabahFK, jenis_transaksi, tanggal, jumlah) VALUES
('', 105, 3, 'debit', '2009-11-10 00:00:00', 50000),
('', 103, 2, 'debit', '2009-11-10 00:00:00', 40000),
('', 101, 4, 'kredit', '2009-11-12 00:00:00', 20000),
('', 106, 3, 'debit', '2009-11-13 00:00:00', 50000),
('', 107, 5, 'kredit', '2009-11-13 00:00:00', 30000),
('', 104, 1, 'kredit', '2009-11-15 00:00:00', 200000),
('', 110, 9, 'kredit', '2009-11-15 00:00:00', 150000),
('', 102, 5, 'debit', '2009-11-16 00:00:00', 20000),
('', 105, 3, 'kredit', '2009-11-18 00:00:00', 50000),
('', 107, 4, 'debit', '2009-11-19 00:00:00', 100000),
('', 103, 2, 'debit', '2009-11-19 00:00:00', 100000),
('', 104, 1, 'debit', '2009-11-19 00:00:00', 50000),
('', 107, 4, 'kredit', '2009-11-20 00:00:00', 200000),
('', 105, 3, 'debit', '2009-11-21 00:00:00', 40000),
('', 104, 1, 'kredit', '2009-11-22 00:00:00', 100000),
('', 101, 4, 'kredit', '2009-11-22 00:00:00', 20000),
('', 103, 2, 'debit', '2009-11-22 00:00:00', 50000),
('', 102, 5, 'debit', '2009-11-25 00:00:00', 50000),
('', 108, 10, 'debit', '2009-11-26 00:00:00', 100000),
('', 106, 3, 'kredit', '2009-11-27 00:00:00', 50000),
('', 103, 2, 'kredit', '2009-11-28 00:00:00', 200000),
('', 105, 3, 'kredit', '2009-11-28 00:00:00', 100000),
('', 102, 5, 'debit', '2009-11-30 00:00:00', 20000),
('', 104, 1, 'debit', '2009-12-1 00:00:00', 50000),
('', 103, 2, 'debit', '2009-12-2 00:00:00', 40000),
('', 101, 4, 'debit', '2009-12-4 00:00:00', 50000),
('', 103, 2, 'kredit', '2009-12-5 00:00:00', 100000),
('', 102, 5, 'kredit', '2009-12-5 00:00:00', 200000),
('', 109, 7, 'debit', '2009-12-5 00:00:00', 100000),
('', 110, 9, 'debit', '2009-12-6 00:00:00', 20000);

INSERT INTO transaksi (no_transaksi, no_rekeningFK, id_nasabahFK, jenis_transaksi, tanggal, jumlah) VALUES
(32, , 3, 105, 'debit', '2009-11-10 00:00:00', 50000),
(33, , 2, 103, 'debit', '2009-11-10 00:00:00', 40000),
(34, , 4, 101, 'kredit', '2009-11-12 00:00:00', 20000),
(35, , 3, 106, 'debit', '2009-11-13 00:00:00', 50000),
(36, , 5, 107, 'kredit', '2009-11-13 00:00:00', 30000),
(37, , 1, 104, 'kredit', '2009-11-15 00:00:00', 200000),
(38, , 9, 110, 'kredit', '2009-11-15 00:00:00', 150000),
(39, , 5, 102, 'debit', '2009-11-16 00:00:00', 20000),
(40, , 3, 105, 'kredit', '2009-11-18 00:00:00', 50000),
(41, , 4, 107, 'debit', '2009-11-19 00:00:00', 100000),
(42, , 2, 103, 'debit', '2009-11-19 00:00:00', 100000),
(43, , 1, 104, 'debit', '2009-11-19 00:00:00', 50000),
(44, , 4, 107, 'kredit', '2009-11-20 00:00:00', 200000),
(45, , 3, 105, 'debit', '2009-11-21 00:00:00', 40000),
(46, , 1, 104, 'kredit', '2009-11-22 00:00:00', 100000),
(47, , 4, 101, 'kredit', '2009-11-22 00:00:00', 20000),
(48, , 2, 103, 'debit', '2009-11-22 00:00:00', 50000),
(49, , 5, 102, 'debit', '2009-11-25 00:00:00', 50000),
(50, , 10, 108, 'debit', '2009-11-26 00:00:00', 100000),
(51, , 3, 106, 'kredit', '2009-11-27 00:00:00', 50000),
(52, , 2, 103, 'kredit', '2009-11-28 00:00:00', 200000),
(53, , 3, 105, 'kredit', '2009-11-28 00:00:00', 100000),
(54, , 5, 102, 'debit', '2009-11-30 00:00:00', 20000),
(55, , 1, 104, 'debit', '2009-12-01 00:00:00', 50000),
(56, , 2, 103, 'debit', '2009-12-02 00:00:00', 40000),
(57, , 4, 101, 'debit', '2009-12-04 00:00:00', 50000),
(58, , 2, 103, 'kredit', '2009-12-05 00:00:00', 100000),
(59, , 5, 102, 'kredit', '2009-12-05 00:00:00', 200000),
(60, , 7, 109, 'debit', '2009-12-05 00:00:00', 100000),
(61, , 9, 110, 'debit', '2009-12-06 00:00:00', 20000),
(62, , 19, 110, 'kredit', '2017-05-24 00:00:00', 50000);

--update data
UPDATE nasabah SET alamat_nasabah = 'Jalan Slamet Riyadi No.34' WHERE nama_nasabah='Indri Hapsari';

UPDATE cabang_bank SET alamat_cabang = 'Jalan A. Yani No.23' WHERE kode_cabang = 'BRUW';

-- Delete Data
DELETE FROM nasabah WHERE id_nasabah = 7;

DELETE FROM cabang_bank WHERE nama_cabang = 'Bank Rut Unit Magelang';