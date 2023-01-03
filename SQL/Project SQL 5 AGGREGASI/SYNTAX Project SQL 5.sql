-- latihan

-- Nomer 5
-- buku
SELECT transaksi.tanggal, transaksi.jenis_transaksi, transaksi.jumlah FROM nasabah, transaksi WHERE nasabah.id_nasabah = transaksi.id_nasabahFK AND nasabah.nama_nasabah IN ('Sutopo', 'Canka Lokananta') ORDER BY transaksi.tanggal;
-- mandiri
SELECT transaksi.tanggal, transaksi.jenis_transaksi, transaksi.jumlah FROM nasabah INNER JOIN transaksi ON  nasabah.id_nasabah = transaksi.id_nasabahFK WHERE nasabah.nama_nasabah IN ('Sutopo', 'Canka Lokananta') ORDER BY transaksi.tanggal;


-- Nomer 6
-- mandiri
SELECT transaksi.tanggal, nasabah.nama_nasabah, transaksi.jenis_transaksi, transaksi.jumlah FROM nasabah INNER JOIN transaksi ON nasabah.id_nasabah = transaksi.id_nasabahFK WHERE transaksi.tanggal BETWEEN '2009-11-15' AND '2009-11-20' ORDER BY transaksi.tanggal, nasabah.nama_nasabah;

-- buku
SELECT transaksi.tanggal, nasabah.nama_nasabah, transaksi.jenis_transaksi, transaksi.jumlah FROM nasabah, transaksi WHERE nasabah.id_nasabah = transaksi.id_nasabahFK AND transaksi.tanggal BETWEEN '2009-11-15' AND '2009-11-20' ORDER BY transaksi.tanggal, nasabah.nama_nasabah;

-- Nomer 7
SELECT jenis_transaksi, SUM(jumlah) AS 'Jumlah (Rp)' FROM transaksi GROUP BY  jenis_transaksi ORDER BY jenis_transaksi;

-- Nomer 8
SELECT jenis_transaksi, MAX(jumlah), MIN(jumlah) FROM transaksi GROUP BY jumlah ORDER BY jenis_transaksi;

-- Nomer 9
SELECT jenis_transaksi, SUM(jumlah) AS 'Jumlah (Rp)', COUNT(jumlah) FROM transaksi WHERE tanggal BETWEEN '2009-11-1' AND '2009-11-30' GROUP BY jenis_transaksi ORDER BY jenis_transaksi;

-- TUGAS

-- NOMER 1
SELECT transaksi.jenis_transaksi, transaksi.jumlah AS 'Jumlah (RP)', COUNT(jumlah) FROM nasabah, transaksi WHERE nasabah.id_nasabah = transaksi.id_nasabahFK AND nasabah.nama_nasabah LIKE '%Kartika Padmasari' GROUP BY transaksi.jenis_transaksi;

-- NOMER 2
SELECT SUM(transaksi.jumlah) AS 'Total saldo Maryati' FROM nasabah INNER JOIN transaksi ON nasabah.id_nasabah = transaksi.id_nasabahFK WHERE nasabah.nama_nasabah LIKE 'Maryati%';

-- NOMER 3
SELECT cabang_bank.nama_cabang AS 'Cabang Bank', COUNT(transaksi.no_transaksi) AS 'Jumlah Transaksi' FROM cabang_bank, rekening, transaksi WHERE cabang_bank.kode_cabang = rekening.kode_cabangFK AND rekening.no_rekening = transaksi.no_rekeningFK GROUP BY cabang_bank.kode_cabang;

-- NOMER 4
SELECT nasabah.nama_nasabah, SUM(transaksi.jumlah) AS 'Jumlah Saldo (RP)' FROM nasabah INNER JOIN transaksi ON nasabah.id_nasabah = transaksi.id_nasabahFK WHERE SUM(transaksi.jumlah) BETWEEN 500000 AND 2000000 GROUP BY nasabah.nama_nasabah;

SELECT nasabah.nama_nasabah, SUM(transaksi.jumlah) AS 'Jumlah' FROM nasabah INNER JOIN transaksi ON nasabah.id_nasabah = transaksi.id_nasabahFK WHERE Jumlah BETWEEN 500000 AND 2000000 GROUP BY nasabah.nama_nasabah;

-- dua diatas salah semua yang benar dibawah
SELECT nasabah.nama_nasabah, rekening.saldo FROM nasabah, nasabah_has_rekening, rekening WHERE nasabah.id_nasabah = nasabah_has_rekening.id_nasabahFK AND rekening.no_rekening = nasabah_has_rekening.no_rekeningFK AND rekening.saldo BETWEEN 500000 AND 2000000 ORDER BY rekening.saldo DESC;

-- NOMER 5
SELECT nasabah.nama_nasabah, transaksi.tanggal, transaksi.jumlah FROM nasabah INNER JOIN TRANSAKSi ON nasabah.id_nasabah = transaksi.id_nasabahFK WHERE transaksi.jumlah > 100000 ORDER BY transaksi.jumlah DESC;

